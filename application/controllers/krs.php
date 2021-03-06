<?php
class krs extends CI_Controller{
    
    var $folder =   "krs";
    var $tables =   "akademik_krs";
    var $pk     =   "krs_id";
    var $title  =   "Kartu Rencana Studi";
    
    function __construct() {
        parent::__construct();
    }
    
    
    function lihat()
    {
        $data['title']=  $this->title;
        $data['tahun_angkatan']=  $this->db->get('akademik_tahun_akademik')->result();
        $this->template->load('template', $this->folder.'/view',$data);
    }
    
    

    
    function loaddata()
    {
        $id             =  $_GET['id_siswa'];
        $mhs            =   "SELECT sm.nis,sm.nama,sm.semester_aktif,ap.nama_kelas,ak.nama_konsentrasi
                            FROM student_siswa as sm,akademik_konsentrasi as ak,akademik_kelas as ap
                            WHERE ap.kelas_id=ak.kelas_id and sm.konsentrasi_id=ak.konsentrasi_id and sm.siswa_id=$id";
        $semester_aktif =  getField('student_siswa', 'semester_aktif', 'siswa_id', $id);
        $thn            =  get_tahun_ajaran_aktif('tahun_akademik_id');
        $d              = $this->db->query($mhs)->row_array();
        $nis            =  getField('student_siswa', 'nis', 'siswa_id', $id);
        $krs            =   "select ak.krs_id,mm.kode_mapel,mm.nama_mapel,mm.sks,ad.nama_lengkap
                            FROM mapel_matapelajaran as mm,akademik_jadwal_sekolah as jk,akademik_krs as ak,app_guru as ad
                            WHERE mm.mapel_id=jk.mapel_id and ad.guru_id=jk.guru_id and jk.jadwal_id=ak.jadwal_id and jk.tahun_akademik_id='1' and ak.nis='$nis' and ak.semester='".$d['semester_aktif']."'";
 
        $data           =  $this->db->query($krs);
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
        <th width='80'>KODE MP</th>
        <th>NAMA MATAPELAJARAN</th>
        <th width=10>SKS</th>
        <th>GURU PENGAJAR</th>
        <th width='10'>Hapus</th></tr>";
        $sks=0;
        if($data->num_rows()<1)
        {
            echo "<tr><td colspan=6>DATA KRS TIDAK DITEMUKAN</td></tr>";
        }
        else
        {
            $no=1;
            
            foreach ($data->result() as $r)
            {
                echo "<tr id='krshide$r->krs_id'>
                    <td>$no</td>
                    <td>".  strtoupper($r->kode_mapel)."</td>
                    <td>".  strtoupper($r->nama_mapel)."</td>
                    <td align='center'>".  $r->sks."</td>
                    <td>".  strtoupper($r->nama_lengkap)."</td>
                    <td align='center'><i class='fa fa-trash-o' onclick='hapus($r->krs_id)'></i></td>
                    </tr>";
                $no++;
                $sks=$sks+$r->sks;
            }
        }
    echo"<tr><td colspan='3' align='right'>Total SKS</td><td>$sks</td><td colspan=2></td></tr><tr>
        <td colspan=6>
        <button onclick='loadtablemapel($id)' class='btn btn-primary btn-sm'><i class='gi gi-shopping_cart'></i> Input KRS</button> ";
        echo anchor('cetak/kum/'.$d['nis'].'/'.$semester_aktif,'<i class="gi gi-print"></i> Cetak KUM',array('class'=>'btn btn-success btn-sm'));
        echo"</td>
        </tr></table>";
    }
    
    function post()
    {
        $id_siswa   =   $_GET['siswa_id'];
        $jadwal_id      =   $_GET['jadwal_id'];
        $nis=  getField('student_siswa', 'nis', 'siswa_id', $id_siswa);
        $smt=  getField('student_siswa', 'semester_aktif', 'siswa_id', $id_siswa);
        $data           =   array(  'nis'=>$nis,
                                    'semester'=>$smt,
                                    'jadwal_id'=>$jadwal_id);
        $this->db->insert($this->tables,$data);
        $id_krs= $this->db->get_where('akademik_krs',array('nis'=>$nis,'jadwal_id'=>$jadwal_id))->row_array();
        $this->db->insert('akademik_khs',array('krs_id'=>$id_krs['krs_id'],'mutu'=>0,'confirm'=>'2'));
    }
    
    function tampilkansiswa()
    {
        $konsentrasi    =   $_GET['konsentrasi'];
        $tahun_angkatan =   $_GET['tahun_angkatan']; // tahun_akademik_id
        $query="select siswa_id,nama from student_siswa where angkatan_id='$tahun_angkatan' and konsentrasi_id='$konsentrasi'";
        $data=  $this->db->query($query)->result();
        foreach ($data as $r)
        {
                   echo "<option onclick='loaddata($r->siswa_id)'>".  strtoupper($r->nama)."</option>"; 
        }
    }
    

    
    function loadmapel()
    {
        $konsentrasi = $_GET['konsentrasi'];
        $siswa_id=$_GET['siswa_id'];
        $nis=  getField('student_siswa', 'nis', 'siswa_id', $siswa_id);
        echo"<table class='table table-bordered'>
            <tr class='warning'><th colspan=5>DAFTAR MATAPELAJARAN</th><th colspan=2><button onclick='loaddata($siswa_id)' class='btn btn-primary btn-sm'><i class='fa fa-mail-reply-all'></i> Kembali</button></th></tr>
            <tr><th width=10>No</th><th width=20>Kode</th>
            <th>Nama Matapelajaran</th>
            <th>Guru</th>
            <th width=60>SKS</th><th width=60>JAM</th><th>Ambil</th></tr>";
            // dapatkan jumlah semester dari kosentrasi yang diminta
            $data=  $this->db->get_where('akademik_konsentrasi',array('konsentrasi_id'=>$konsentrasi))->row_array();
            $jmlSemester=$data['jml_semester'];
            for($i=1;$i<=$jmlSemester;$i++)
            {
                            echo"<tr class='success'><td colspan=9>Semester $i</td></tr>";
                            $query          =   "SELECT mm.kode_mapel,mm.sks,mm.jam,mm.kode_mapel,mm.nama_mapel,mm.sks,jk.jadwal_id,ds.nama_lengkap
                                                FROM akademik_jadwal_sekolah as jk,mapel_matapelajaran as mm,app_guru as ds
                                                WHERE mm.mapel_id=jk.mapel_id and mm.konsentrasi_id=$konsentrasi and mm.semester=$i and ds.guru_id=jk.guru_id and jk.jadwal_id not in(select jadwal_id from akademik_krs where nis='$nis')";
                            $mapel          = $this->db->query($query)->result();
                            $no=1;
                            foreach ($mapel as $m)
                            {
                                echo "<tr id='hide$m->jadwal_id'><td>$no</td>
                                                        <td>".  strtoupper($m->kode_mapel)."</td>
                                                        <td>".  strtoupper($m->nama_mapel)."</td>
                                                        <td>".  strtoupper($m->nama_lengkap)."</td>
                                                        <td>$m->sks sks</td>
                                                        <td>$m->jam Jam</td>
                                                        <td width='10' align='center'><i class='fa fa-share-square-o' onclick='ambil($m->jadwal_id,$siswa_id)' title='Ambil Matapelajaran'></i></td>
                                                         </tr>";
                                $no++;
                            }
                            
            }
            echo "<table>";
    }
    
    
    function delete()
    {
        $id=$_GET['krs_id'];
        $this->mcrud->delete($this->tables,  $this->pk,  $id);
        $this->mcrud->delete('akademik_khs',  $this->pk,  $id);
    }
}