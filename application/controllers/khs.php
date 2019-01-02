<?php
class khs extends CI_Controller{
        
    var $folder =   "khs";
    var $tables =   "akademik_khs";
    var $pk     =   "khs_id";
    var $title  =   "Kartu Hasil Studi";
    
    function __construct() {
        parent::__construct();
    }
    
    function index()
    {
        $data['title']=  $this->title;
        $data['tahun_angkatan']=  $this->db->get('akademik_tahun_akademik')->result();
        $this->template->load('template', $this->folder.'/view',$data);
    }
    
    function loaddata()
    {
        $id             =  $_GET['id_siswa'];
        $semester       =  $_GET['semester'];
        $mhs            =   "SELECT sm.nis,sm.nama,sm.semester_aktif,ap.nama_kelas,ak.nama_konsentrasi
                            FROM student_siswa as sm,akademik_konsentrasi as ak,akademik_kelas as ap
                            WHERE ap.kelas_id=ak.kelas_id and sm.konsentrasi_id=ak.konsentrasi_id and sm.siswa_id=$id";
        $semester_aktif =  getField('student_siswa', 'semester_aktif', 'siswa_id', $id);
        $d              = $this->db->query($mhs)->row_array();
        $nis            =  getField('student_siswa', 'nis', 'siswa_id', $id);
        echo "
        <table class='table table-bordered'>
        <tr>
            <td width='150'>NAMA</td><td>".  strtoupper($d['nama'])."</td>
            <td width=100>NIS</td><td>".  strtoupper($d['nis'])."</td><td rowspan='2' width='70'><img src='".  base_url()."assets/images/noprofile.gif' width='50'></td>
        </tr>
        <tr>
            <td>Kelas, Konsentrasi</td><td>".  strtoupper($d['nama_kelas'].' / '.$d['nama_konsentrasi'])."</td>
            <td>Semester</td><td>".$d['semester_aktif']."</td>
        </tr>
        </table>
        
        <table class='table table-bordered' id='daftarkrs'>
        <tr><th width='5'>No</th>
        <th width='90'>KODE MP</th>
        <th>NAMA MATAPELAJARAN</th>
        <th>GURU PENGAJAR</th>
        <th width=10>SKS</th>
         <th width=20>Kehadiran</th>
         <th width=10>Tugas</th>
        <th width=10>Mutu</th>
        <th>Grade</>
        <th width='10'>Konfirm</th>
        <th width='10'></th></tr>";
        if($semester==0)
        {
            // foreach semester dari semester aktif
            for($smt=1;$smt<=$d['semester_aktif'];$smt++)
            {
                echo "<tr class='success'><th colspan='11'>SEMESTER $smt</th></tr>";
                $krs            =   "select kh.grade,mm.kode_mapel,mm.nama_mapel,mm.sks,ad.nama_lengkap,kh.mutu,kh.confirm,kh.khs_id,kh.kehadiran,kh.tugas
                            FROM mapel_matapelajaran as mm,akademik_jadwal_sekolah as jk,akademik_krs as ak,
                            app_guru as ad,akademik_khs as kh
                            WHERE mm.mapel_id=jk.mapel_id and ad.guru_id=jk.guru_id and jk.jadwal_id=ak.jadwal_id 
                            and ak.nis='$nis' and kh.krs_id=ak.krs_id and ak.semester='$smt'";
                $data           =  $this->db->query($krs);
                if($data->num_rows()<1)
                {
                    echo "<tr><td colspan='9'>Data Tidak Ditemukan</td></tr>";
                }
                else
                {
                    $no=1;
                    $sks=0;
                    foreach ($data->result() as $r)
                    {
                        
                        $confirm=$r->confirm==1?'Ya':'Tidak';
                        $btn=$r->confirm==1?'gi gi-disk_remove':'gi gi-disk_saved';
                        echo "<tr id='krshide$r->khs_id'>
                            <td>$no</td>
                            <td>".  strtoupper($r->kode_mapel)."</td>
                            <td>".  strtoupper($r->nama_mapel)."</td>
                            <td>".  strtoupper($r->nama_lengkap)."</td>
                            <td align='center'>".  $r->sks."</td>
                            <td>$r->kehadiran</td>
                            <td>$r->tugas</td>
                            <td>$r->mutu</td>
                            <td>".$r->grade."</td>
                            <td>$confirm</td>
                            <td align='center'><i title='konfirm' class='$btn' onclick='konfirm($r->khs_id)'></i></td>
                            </tr>";
                        $no++;
                        $sks=$sks+$r->sks;
                    }
                    echo"<tr class='success'><td colspan='4' align='right'>Total SKS</td><td>$sks</td><td colspan='2' align='right'>IPK</td><td colspan='4'></td></tr><tr>
            <td colspan=11>".anchor('cetak/cetakkhs/'.$smt.'/'.$id,'<i class="gi gi-print"></i> Cetak KHS',array('title'=>'Cetak KHS','class'=>'btn btn-primary btn-sm'))."
            
            ".anchor('','<i class="gi gi-charts"></i> Grafik',array('Title'=>'Lihat Grafik','class'=>'btn btn-primary btn-sm'))."
            </td></tr>";
                }
            }
            // end foreach
        }
        else
        {
            $krs       =   "select kh.grade,mm.kode_mapel,mm.nama_mapel,mm.sks,ad.nama_lengkap,kh.mutu,kh.confirm,kh.khs_id,kh.tugas,kh.kehadiran
                            FROM mapel_matapelajaran as mm,akademik_jadwal_sekolah as jk,akademik_krs as ak,
                            app_guru as ad,akademik_khs as kh
                            WHERE mm.mapel_id=jk.mapel_id and ad.guru_id=jk.guru_id and jk.jadwal_id=ak.jadwal_id 
                            and ak.nis='$nis' and kh.krs_id=ak.krs_id and ak.semester='$semester' ";
 
            $data      =  $this->db->query($krs);
            $sks=0;
            if($data->num_rows()<1)
            {
                echo "<tr class='danger'><td colspan=11>DATA KHS TIDAK DITEMUKAN</td></tr>";
            }
            else
            {
                $no=1;
                foreach ($data->result() as $r)
                {
                    $confirm=$r->confirm==1?'Ya':'Tidak';
                    $btn=$r->confirm==1?'gi gi-disk_remove':'gi gi-disk_saved';
                    echo "<tr id='krshide$r->khs_id'>
                        <td>$no</td>
                        <td>".  strtoupper($r->kode_mapel)."</td>
                        <td>".  strtoupper($r->nama_mapel)."</td>
                        <td>".  strtoupper($r->nama_lengkap)."</td>
                        <td align='center'>".  $r->sks."</td>
                        <td>$r->kehadiran</td>
                        <td>$r->tugas</td>
                        <td>$r->mutu</td>
                        <td>".$r->grade."</td>
                        <td>$confirm</td>
                        <td align='center'><i title='konfirm' class='$btn' onclick='konfirm($r->khs_id)'></i></td>
                        </tr>";
                    $no++;
                    $sks=$sks+$r->sks;
                }
            }
        echo"<tr class='success'><td colspan='4' align='right'>Total SKS</td><td>$sks</td><td colspan='2' align='right'>IPK</td><td colspan='4'></td></tr><tr>
            <td colspan=11>".anchor('cetak/cetakkhs/'.$semester.'/'.$id,'<i class="gi gi-print"></i> Cetak KHS',array('title'=>'Cetak KHS','class'=>'btn btn-primary btn-sm'))."</td></tr></table>";
    }
    }
    
    
    function semester_mhs()
    {
        $id=$_GET['id_siswa'];
        $sms=  getField('student_siswa', 'semester_aktif', 'siswa_id', $id);
        for($i=1;$i<=$sms;$i++)
        {
            echo "<option value='$i'> Semester $i</option>";
        }
        echo "<option value='0'>Semua Semester</option>";
    }
    
    function berinilai()
    {
        $guru  =  $this->session->userdata('keterangan');
        $thn    = get_tahun_ajaran_aktif('tahun_akademik_id');
        $query="SELECT mm.nama_mapel,jk.jadwal_id
                FROM akademik_jadwal_sekolah as jk,mapel_matapelajaran as mm
                WHERE mm.mapel_id=jk.mapel_id and jk.guru_id=$guru and jk.tahun_akademik_id=$thn";
        $data['title']="Beri Nilai";
        $data['kelas']=  $this->db->query($query)->result();
        $this->template->load('template', $this->folder.'/berinilai',$data);
    }
    
    function form_berinilai()
    {
        $jadwal_id=  $_GET['jadwal_id'];
        $thn      =  get_tahun_ajaran_aktif('tahun_akademik_id');
        $d        =  $this->db->query("SELECT ad.nama_lengkap,mm.nama_mapel 
                    FROM app_guru as ad,mapel_matapelajaran as mm,akademik_jadwal_sekolah as jk 
                    WHERE jk.mapel_id=mm.mapel_id and jk.guru_id=ad.guru_id and jk.jadwal_id=$jadwal_id")->row_array();
        $sql="  SELECT sm.nis,sm.nama,kh.mutu,kh.khs_id,kh.tugas,kh.kehadiran,kh.grade
                FROM akademik_krs as ak,student_siswa as sm,akademik_khs as kh,akademik_jadwal_sekolah as jk
                WHERE kh.krs_id=ak.krs_id and sm.nis=ak.nis and ak.jadwal_id='$jadwal_id' and jk.jadwal_id=ak.jadwal_id and jk.tahun_akademik_id='$thn'";
        echo " <table class='table table-bordered'>
              <tr class='success'><th colspan=2>MATAPELAJARAN</th></tr>
               <tr><td width=120>Matapelajaran</td><td>".  strtoupper($d['nama_mapel'])."</td></tr>
               <tr><td>Guru Pengajar</td><td>".  strtoupper($d['nama_lengkap'])."</td></tr>
               </table>
               <table class='table table-bordered'>
               <tr class='success'><th colspan=7>FORM NILAI SISWA</th></tr>
               <tr><th>No</th><th>NIS</th><th>NAMA SISWA</th><th width=90>Kehadiran</th><th width=90>Tugas</th><th width=90>Mutu</th><th>Grade</th></tr>";
        $data=  $this->db->query($sql)->result();
        $no=1;
        foreach ($data as $r)
        {
            echo "<tr>
                <td width='7'>$no</td>
                <td width='70'>".  strtoupper($r->nis)."</td>
                <td>".  strtoupper($r->nama)."</td>
                <td align='center' width='90'>";
                echo inputan('text', '','col-sm-12','Kehadiran', 0, $r->kehadiran,array('onkeyup'=>'simpankehadiran('.$r->khs_id.')','id'=>'ambilkehadiran'.$r->khs_id)).'</td><td>';
                echo inputan('text', '','col-sm-12','Tugas ..', 0, $r->tugas,array('onkeyup'=>'simpantugas('.$r->khs_id.')','id'=>'ambiltugas'.$r->khs_id)).'</td><td>';
                echo inputan('text', 'link','col-sm-12','Link ...', 1, $r->mutu,array('onkeyup'=>'simpan('.$r->khs_id.')','id'=>'ambil'.$r->khs_id));
                echo"</td>
                    <td width='80'>";
                echo editcombo('grade','app_nilai_grade','col-sm-14','grade','grade','',array('onChange'=>'simpangrade('.$r->khs_id.')','id'=>'ambilgrade'.$r->khs_id),  $r->grade);
                echo"</td>
                </tr>";
            $no++;
        }
        echo"  </table>";
    }
    
    
    function grade($nilai)
    {
        $set_nilai=  $this->db->get('app_nilai_grade')->result();
        foreach ($set_nilai as $s)
        {
            if($nilai >=$s->dari and $nilai <= $s->sampai)
            {
                return $s->grade;
            }
        }

    }
    
    function simpan_nilai()
    {
        akses_guru();
        $id     =   $_GET['id'];
        $nilai  =   $_GET['nilai'];
        $this->mcrud->update($this->tables,array('mutu'=>$nilai), $this->pk,$id);
    }
    
    function simpan_kehadiran()
    {
        akses_guru();
        $id     =   $_GET['id'];
        $nilai  =   $_GET['nilai'];
        $this->mcrud->update($this->tables,array('kehadiran'=>$nilai), $this->pk,$id);
    }
    
    function simpan_tugas()
    {
        akses_guru();
        $id     =   $_GET['id'];
        $nilai  =   $_GET['nilai'];
        $this->mcrud->update($this->tables,array('tugas'=>$nilai), $this->pk,$id);
    }
    
    function simpan_grade()
    {
        akses_guru();
        $id     =   $_GET['id'];
        $nilai  =   $_GET['nilai'];
        $this->mcrud->update($this->tables,array('grade'=>$nilai), $this->pk,$id);
    }
    
    function tampilkansiswa()
    {
        $konsentrasi    =   $_GET['konsentrasi'];
        $tahun_angkatan =   $_GET['tahun_angkatan']; // tahun_akademik_id
        $query="select siswa_id,nama from student_siswa where angkatan_id='$tahun_angkatan' and konsentrasi_id='$konsentrasi'";
        $data=  $this->db->query($query)->result();
        foreach ($data as $r)
        {
                   echo "<option onclick='tampilkan_semester($r->siswa_id)' value='$r->siswa_id'>".  strtoupper($r->nama)."</option>"; 
        }
    }
    
    function konfirm()
    {
        akses_admin();
        $id=$_GET['khs_id'];
        $this->mcrud->update($this->tables,array('confirm'=>1), $this->pk,$id);
    }

}