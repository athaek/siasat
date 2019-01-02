<?php

class absensi extends CI_Controller{
    
    var $folder =   "absensi";
    var $tables =   "student_absen";
    var $pk     =   "absen_id";
    var $title  =   "Absensi Siswa";
    
    function __construct() {
        parent::__construct();
    }
    
    
    function index()
    {
        $guru  =  $this->session->userdata('keterangan');
        $thn    = get_tahun_ajaran_aktif('tahun_akademik_id');
        $query="SELECT mm.nama_mapel,jk.jadwal_id
                FROM akademik_jadwal_sekolah as jk,mapel_matapelajaran as mm
                WHERE mm.mapel_id=jk.mapel_id and jk.guru_id=$guru and jk.tahun_akademik_id=$thn";
        $data['title']="Absen";
        $data['kelas']=  $this->db->query($query)->result();
        $this->template->load('template', $this->folder.'/view',$data);
    }
    
    
    function load_siswa()
    {
        $jadwal_id=  $_GET['jadwal_id'];
        $tanggal  =$_GET['tanggal'];
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
               <tr class='success'><th colspan=6>DATA SISWA</th></tr>
               <tr><th>No</th><th>NIS</th><th>NAMA SISWA</th><th width=120>Kehadiran</th></tr>";
        $data=  $this->db->query($sql)->result();
        $no=1;
        foreach ($data as $r)
        {
            $absen=array('h'=>'Hadir','a'=>'Alpa','i'=>'Izin');
            echo "<tr>
                <td width='7'>$no</td>
                <td width='70'>".  strtoupper($r->nis)."</td>
                <td>".  strtoupper($r->nama)."</td>
                <td align='center' width='90'><div class='cols-4'>";
                $absensi=  $this->db->get_where('student_absen_detail',array('nis'=>$r->nis,'absen_id'=>  getField('student_absen', 'absen_id', 'tanggal', $tanggal)));
                if($absensi->num_rows()>0)
                {
                    $absensi=$absensi->row_array();
                    echo form_dropdown('absen',$absen,$absensi['kehadiran'],"class='form-control' id='absenid".$absensi['detail_id']."' onChange='simpanabsen(".$absensi['detail_id'].")'");
                    //echo inputan('text', '','col-sm-12','Kehadiran', 0, $r->kehadiran,array('onkeyup'=>'simpankehadiran('.$r->khs_id.')','id'=>'ambilkehadiran'.$r->khs_id)).'</td>';
                }
                else
                {
                    echo form_dropdown('absen',$absen,'',"class='form-control' onChange='belumabsen()'");
                    //echo inputan('text', '','col-sm-12','Kehadiran', 0, $r->kehadiran,array('onkeyup'=>'simpankehadiran('.$r->khs_id.')','id'=>'ambilkehadiran'.$r->khs_id)).'</td>';
                }
                echo"</div></tr>";
            $no++;
        }
        echo"  </table>";
    }
    
    
    function autosave()
    {
        $tanggal    =  $this->input->post('tanggal2');
        $mapel      =  $this->input->post('jadwal');
        $materi     =  $this->input->post('materi');
        $data       =  array('jadwal_id'=>$mapel,'tanggal'=>$tanggal,'keterangan'=>$materi);
        $this->db->insert($this->tables,$data);
        $id=  $this->db->get_where($this->tables,$data)->row_array();
        // foreach siswa yang mengambil mataPelajaran x
        $siswa=$this->db->get_where('akademik_krs',array('jadwal_id'=>$mapel))->result();
        foreach ($siswa as $m)
        {
            $data=array('absen_id'=>$id['absen_id'],'nis'=>$m->nis,'kehadiran'=>'h','keterangan'=>'');
            $this->db->insert('student_absen_detail',$data);
        }
        redirect('absensi');
    }
    
    function chek_absen()
    {
        $tanggal=$_GET['tanggal'];
        $jadwal=$_GET['jadwal'];
        $chek=$this->db->get_where('student_absen',array('tanggal'=>$tanggal,'jadwal_id'=>$jadwal))->num_rows();
        if($chek>0)
        {
            echo "Sudah Absen";
        }
        else
        {
            echo "Belum Absen";
        }
    }
    
    function simpan_absen()
    {
        $id=$_GET['id'];
        $nilai=$_GET['nilai'];
        $this->mcrud->update('student_absen_detail',array('kehadiran'=>$nilai), 'detail_id',$id);
    }
}