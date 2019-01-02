<?php
class cetak extends CI_Controller
{
    function __construct() {
        parent::__construct();
         $this->load->library('cfpdf');
    }
    
    function cetakkhs()
    {
        $siswa  =   $this->uri->segment(4);
        $semester   =   $this->uri->segment(3);
        $sqlMHS     =   "SELECT ap.nama_kelas,ak.nama_konsentrasi,sm.nama,sm.nis,sm.semester_aktif
                        FROM student_siswa as sm,akademik_kelas as ap,akademik_konsentrasi as ak
                        WHERE sm.konsentrasi_id=ak.konsentrasi_id and ak.kelas_id=ap.kelas_id and sm.siswa_id=$siswa";
        $m          =  $this->db->query($sqlMHS)->row_array();
        $khs        =   "select kh.grade,mm.kode_mapel,mm.nama_mapel,mm.sks,ad.nama_lengkap,kh.mutu,kh.confirm,kh.khs_id,kh.tugas,kh.kehadiran
                         FROM mapel_matapelajaran as mm,akademik_jadwal_sekolah as jk,akademik_krs as ak,
                         app_guru as ad,akademik_khs as kh
                         WHERE mm.mapel_id=jk.mapel_id and ad.guru_id=jk.guru_id and jk.jadwal_id=ak.jadwal_id 
                         and ak.nis='$m[nis]' and kh.krs_id=ak.krs_id and ak.semester='$semester' ";
        $pdf = new FPDF('p','mm','A5');
        $pdf->AddPage();
       // head
       $pdf->SetFont('TIMES','',12);
       $pdf->Cell(130, 5, 'SMA NEGERI 1 TUBAN', 0, 1, 'C');
       $pdf->SetFont('TIMES','',10);
       $pdf->Cell(130, 5, 'Jalan Basuki Rahmad No 55 ,Kabupaten Tuban Jawa Timur', 0, 1, 'C');
       $pdf->Cell(130, 5, 'Telp.(0356) 322725 ,Fax(0356 322725)', 0, 1, 'C');
       $pdf->Cell(130, 5, 'E-mail : bankjatimtuban017@gmail.com', 0, 1, 'C');
       $pdf->Line(11, 31, 140, 31);
       
       $pdf->Image(base_url().'/assets/images/logo.png', 10, 10, 20);
       
       $pdf->SetFont('TIMES','B',12);
       $pdf->Cell(1,2,'',0,1);
       $pdf->Cell(100, 5, 'KARTU HASIL STUDI', 0, 1, 'C');
       $pdf->Cell(2, 2,'',0,1);
       $pdf->SetFont('TIMES','B',9);
       // buat tabel disini
       $pdf->SetFont('TIMES','B',9);
       
       $pdf->Cell(30,5,'SEMESTER',0,0);
       $pdf->Cell(20,5,' : '.  strtoupper($m['semester_aktif']),0,1);
       $pdf->Cell(30,5,'KELAS',0,0);
       $pdf->Cell(20,5,' : '.  strtoupper($m['nama_kelas']),0,1);
       $pdf->Cell(30,5,'KONSENTRASI',0,0);
       $pdf->Cell(20,5,' : '.  strtoupper($m['nama_konsentrasi']),0,1);
       $pdf->Cell(30,5,'NAMA ',0,0);
       $pdf->Cell(20,5,' : '.  strtoupper($m['nama']),0,1);
       $pdf->Cell(30,5,'NIS',0,0);
       $pdf->Cell(20,5,' : '.  strtoupper($m['nis']),0,1);
       
       // kasi jarak
       $pdf->Cell(3,2,'',0,1);
       
       $pdf->Cell(7, 5, 'NO', 1, 0);
       $pdf->Cell(15, 5, 'KODE', 1, 0);
       $pdf->Cell(65, 5, 'MATA PELAJARAN', 1, 0);
       $pdf->Cell(15, 5, 'SKS', 1, 0);
       $pdf->Cell(15, 5, 'NILAI', 1, 0);
       $pdf->Cell(15, 5, 'MUTU', 1, 1);
   
       $pdf->SetFont('times','',9);
       $i=1;
       $sks=0;
       $mutu=0;
       foreach ($this->db->query($khs)->result() as $r)
       {
            $pdf->Cell(7, 5, $i, 1, 0);
            $pdf->Cell(15, 5, strtoupper($r->kode_mapel), 1, 0);
            $pdf->Cell(65, 5, strtoupper($r->nama_mapel), 1, 0);
            $pdf->Cell(15, 5, $r->sks, 1, 0,'C');    
            $pdf->Cell(15, 5, $r->grade, 1, 0,'C');
            $pdf->Cell(15, 5, $r->mutu, 1, 1,'C');
            $i++;
            $sks=$sks+$r->sks;
            $mutu=$mutu+$r->mutu;
       }
       
       $pdf->Cell(35, 5, 'SKS Kontrak : '.$sks, 0, 0);
       $pdf->Cell(35, 5, 'SKS Selesai : '.$sks, 0, 0);
       $pdf->Cell(35, 5, 'Mutu : '.$mutu.',00', 0, 0);
       $pdf->Cell(35, 5, 'IP : ' ,0, 1);
       
       // tanda tangan
       $pdf->Cell(95, 5, '', 0, 1);
       $pdf->Cell(95, 15, '', 0, 0);
       $pdf->Cell(25, 5, 'Tuban, '.  tgl_indo(waktu()), 0, 1);
       $pdf->Cell(95, 5, '', 0, 0);
       $pdf->Cell(25, 5, 'Pembantu Kepala Sekolah,', 0, 1);
       $pdf->Cell(95, 10, '', 0, 0);
       $pdf->Cell(25, 10, '', 0, 1);
       $pdf->Cell(95, 5, '', 0, 0);
       $pdf->Cell(25, 5, 'Arta Waluyo,', 0, 0);
       $pdf->Output();
    }
    
    
    function kum()
    {
        $id        =  $this->uri->segment(3);
        $profileSQL=    "SELECT sm.nama,sm.nis,ak.nama_konsentrasi,ap.nama_kelas FROM 
                        student_siswa  as sm,akademik_kelas as ap,akademik_konsentrasi as ak
                        WHERE sm.konsentrasi_id=ak.konsentrasi_id and ap.kelas_id=ak.kelas_id and sm.siswa_id=1";
        $profile   = $this->db->query($profileSQL)->row_array();
        $pdf = new FPDF('L','mm','A5');
        $pdf->AddPage();
        $pdf->SetFont('TIMES','',17);
        $pdf->Cell(100,2,'SMA NEGERI 1 TUBAN',0,1);
        
        $pdf->SetFont('TIMES','',10);
        $pdf->Cell(100, 6, 'Jalan Basuki Rahmad No 50,Kabupaten Tuban ,Jawa Timur, 62362', 0, 1, 'L');
         $pdf->Cell(100, 3, 'E-mail : bankjatimtuban017@gmail.com ; Website : http://www.bankjatim.co.id', 0, 1, 'L');
        $pdf->Cell(100, 5, 'Telp / Fax : (0356) 322725', 0, 1, 'L');
        $pdf->Line(11, 27, 120, 27);
        
        $pdf->Image(base_url().'/assets/images/bgkum.png', 128, 15, 70);
        $pdf->SetFont('TIMES','',12);
        $pdf->Text(131, 23, 'KARTU UJIAN SISWA');
        $pdf->Text(131, 28, 'UJIAN TENGAH SEMESTER');
        $pdf->Text(131, 33, 'SEMESTER GANJIL T.A  2012/2013');
        $pdf->SetFont('TIMES','',10);
        
        // biodata
        $pdf->Cell(0, 3,'',0,1);
        $pdf->Cell(40, 5, 'NAMA', 0, 0);
        $pdf->Cell(40, 5, ' : '. strtoupper($profile['nama']), 0, 1);
        $pdf->Cell(40, 5, 'NIS', 0, 0);
        $pdf->Cell(40, 5, ' : '.  strtoupper($profile['nis']), 0, 1);
        $pdf->Cell(40, 5, 'PROGRAM STUDI', 0, 0);
        $pdf->Cell(40, 5, ' : '.  strtoupper($profile['nama_kelas']), 0, 1);
        $pdf->Cell(40, 5, 'KONSENTRASI', 0, 0);
        $pdf->Cell(40, 5, ' : '.  strtoupper($profile['nama_konsentrasi']), 0, 1);
        
        $pdf->Cell(10, 3,'',0,1);
        $pdf->SetFont('TIMES','B',10);
        $pdf->Cell(40, 5, 'DAFTAR MATA PELAJARAN KONTRAK', 0, 1);
        $pdf->SetFont('TIMES','b',10);
        
        
        // data pelajaran
        // kasi jarak
       $pdf->Cell(20,3,'',0,1);
       
       $pdf->Cell(7, 5, 'NO', 1, 0);
       $pdf->Cell(15, 5, 'SMT', 1, 0,'C');
       $pdf->Cell(75, 5, 'MATA PELAJARAN', 1, 0);
       $pdf->Cell(55, 5, 'GURU', 1, 0);
       $pdf->Cell(30, 5, 'TANDA TANGAN', 1, 1);
   
       $pdf->SetFont('times','',10);
       $i=1;
       $krs            =   "select ak.krs_id,mm.kode_mapel,mm.nama_mapel,mm.sks,ad.nama_lengkap
                            FROM mapel_matapelajaran as mm,akademik_jadwal_sekolah as jk,akademik_krs as ak,app_guru as ad
                            WHERE mm.mapel_id=jk.mapel_id and ad.guru_id=jk.guru_id and jk.jadwal_id=ak.jadwal_id 
                            and jk.tahun_akademik_id='1' and ak.nis='".$this->uri->segment(3)."' and ak.semester='".$this->uri->segment(4)."'";
       foreach ($this->db->query($krs)->result() as $r)
       {
            $pdf->Cell(7, 5, $i, 1, 0);
            $pdf->Cell(15, 5, 'SMT '.$this->uri->segment(4), 1, 0,'C');
            $pdf->Cell(75, 5, strtoupper($r->nama_mapel), 1, 0);
            $pdf->Cell(55, 5, strtoupper($r->nama_lengkap), 1, 0);
            $pdf->Cell(30, 5, '', 1, 1);
            $i++;
       }
       
       $pdf->SetFont('times','b',9);
       $pdf->Cell(300,5,'Catatan : selama ujian berlangsung KUM wajib dibawa dan mintalah tanda tangan kepada guru',0,1);
       $pdf->Cell(300,3,'                 atau pengawas ujian,jika KUM tidak dibawa harus minta surat keterangan dari pihak sekolah.',0,1);
        $pdf->SetFont('times','',10);
       $pdf->Text(155, 110, 'tuban , '.  tgl_indo(waktu()));
       $pdf->Text(155, 115, 'Pembantu Kepala Sekolah');
       
       $pdf->Text(155, 130, 'Arta Waluyo');
       $pdf->Output();
    }
    
}