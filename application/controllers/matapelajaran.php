<?php
class matapelajaran extends CI_Controller{
    
    var $folder =   "matapelajaran";
    var $tables =   "mapel_matapelajaran";
    var $pk     =   "mapel_id";
    var $title  =   "Mata Pelajaran";
    
    function __construct() {
        parent::__construct();
    }
    
    function index()
    {
        $query="SELECT mm.mapel_id,mm.kode_mapel,mm.nama_mapel,mk.kode_kelompok,mm.sks
                FROM mapel_matapelajaran as mm,mapel_kelompok as mk
                WHERE mk.kelompok_id=mm.kelompok_id";
        $data['title']  = $this->title;
        $data['desc']    =   "";
        $data['mapel']=  $this->db->query($query)->result();
        $data['kelas']=  $this->db->get('akademik_kelas')->result();
	$this->template->load('template', $this->folder.'/view',$data);
    }
    
    
    function tampilkonsentrasi()
    {
        
        $kelas=$_GET['kelas'];
        $data=  $this->db->get_where('akademik_konsentrasi',array('kelas_id'=>$kelas))->result();
        foreach ($data as $r)
        {
            echo "<option value='$r->konsentrasi_id'>".  strtoupper($r->nama_konsentrasi)."</option>";
        }
    }
    
    
    function tampilsemester()
    {
        $konsentrasi=$_GET['konsentrasi'];
        // get semester
        $r=  $this->db->get_where('akademik_konsentrasi',array('konsentrasi_id'=>$konsentrasi))->row_array();
        for($i=1;$i<=$r['jml_semester'];$i++)
        {
            echo "<option value='$i'>SEMESTER $i</option>";
        } 
        echo "<option value='0'>SEMUA SEMESTER</option>";
    }
    
    function jadwalsekolah()
    {
        $query="SELECT mm.mapel_id,mm.kode_mapel,mm.nama_mapel,mk.kode_kelompok,mm.sks
                FROM mapel_matapelajaran as mm,mapel_kelompok as mk
                WHERE mk.kelompok_id=mm.kelompok_id";
        $data['mapel']=  $this->db->query($query)->result();
        $data['kelas']=  $this->db->get('akademik_kelas')->result();
	$this->template->load('template', $this->folder.'/jadwalsekolah',$data);
    }
    
    
    function post()
    {
        if(isset($_POST['submit']))
        {
            $nama   =   $this->input->post('nama');
            $kode   =   $this->input->post('kode');
            $sks    =   $this->input->post('sks');
            $jam    =   $this->input->post('jam');
            $semeste=   $this->input->post('semester');
            $konsen =   $this->input->post('konsentrasi');
            $kelomp =   $this->input->post('kelompok');
            $data   =   array(  'kode_mapel'=>$kode,
                                'semester'=>$semeste,
                                'nama_mapel'=>$nama,
                                'sks'=>$sks,
                                'jam'=>$jam,
                                'konsentrasi_id'=>$konsen,
                                'kelompok_id'=>$kelomp);
            $this->db->insert($this->tables,$data);
            $pesan="<div class='alert alert-success'>Matapelajaran $nama Sudah Disimpan Kedatabase !!</div>";
            $this->session->set_flashdata('pesan', $pesan);
            redirect('matapelajaran/post');
        }
        else
        {
            $data['title']  = $this->title;
            $data['desc']    =   "";
            $this->template->load('template', $this->folder.'/post',$data);
        }
    }
    function edit()
    {
        if(isset($_POST['submit']))
        {
            $id     =   $this->input->post('id');
            $nama   =   $this->input->post('nama');
            $kode   =   $this->input->post('kode');
            $sks    =   $this->input->post('sks');
            $jam    =   $this->input->post('jam');
            $semeste=   $this->input->post('semester');
            $konsen =   $this->input->post('konsentrasi');
            $kelomp =   $this->input->post('kelompok');
            $data   =   array(  'kode_mapel'=>$kode,
                                'semester'=>$semeste,
                                'nama_mapel'=>$nama,
                                'sks'=>$sks,
                                'jam'=>$jam,
                                'konsentrasi_id'=>$konsen,
                                'kelompok_id'=>$kelomp);
            $this->mcrud->update($this->tables,$data, $this->pk,$id);
            $pesan="<div class='alert alert-success'>Matapelajaran $nama Sudah diubah Kedatabase !!</div>";
            $this->session->set_flashdata('pesan', $pesan);
            redirect('matapelajaran/edit/'.$id);
        }
        else
        {
            $data['title']  = $this->title;
            $data['desc']    =   "Edit Matapelajaran";
            $id          =  $this->uri->segment(3);
            $data['r']   =  $this->mcrud->getByID($this->tables,  $this->pk,$id)->row_array();
            $this->template->load('template', $this->folder.'/edit',$data);
        }
    }
    function delete()
    {
        $id     =  $_GET['id'];
        $this->mcrud->delete('mapel_matapelajaran',  'mapel_id',  $id);
    }
    
    function ubahstatus()
    {
        $id=$_GET['id'];
        // chek status terakhir
        $statuslama=  getField('mapel_matapelajaran', 'aktif', 'mapel_id', $id);
        // simpan status
        $statusbaru=  $statuslama=='y'?'n':'y';
        // ubah status
        $this->mcrud->update($this->tables,array('aktif'=>$statusbaru), $this->pk,$id);
    }
    
    
 
    
    function tampilmapel()
    {
        $konsentrasi    =   $_GET['konsentrasi'];
        $semester       =   $_GET['semester'];
        // apabila request semua semester
        if($semester==0)
        {
            echo"<table class='table table-bordered'>
            <tr><th width=10>No</th><th width=20>Kode</th><th width=40>Kelompok</th>
            <th>Nama Matapelajaran</th><th width=60>SKS</th><th width=60>JAM</th><th colspan=3>Operasi</th></tr>";
            // dapatkan jumlah semester dari kosentrasi yang diminta
            $data=  $this->db->get_where('akademik_konsentrasi',array('konsentrasi_id'=>$konsentrasi))->row_array();
            $jmlSemester=$data['jml_semester'];
            for($i=1;$i<=$jmlSemester;$i++)
            {
                            echo"<tr class='success'><td colspan=9>Semester $i</td></tr>";
                            $query          =   "SELECT mm.jam,mm.aktif,mm.mapel_id,mm.kode_mapel,mm.nama_mapel,mk.kode_kelompok,mm.sks
                                                FROM mapel_matapelajaran as mm,mapel_kelompok as mk
                                                WHERE mk.kelompok_id=mm.kelompok_id and mm.konsentrasi_id='$konsentrasi' and mm.semester='$i' order by mm.kode_mapel asc";
                            $mapel          = $this->db->query($query)->result();
                            $no=1;
                            foreach ($mapel as $m)
                            {
                                echo "<tr id='hide$m->mapel_id'><td>$no</td>
                                                        <td>".  strtoupper($m->kode_mapel)."</td>
                                                        <td>".  strtoupper($m->kode_kelompok)."</td>
                                                            <td>".  strtoupper($m->nama_mapel)."</td>
                                                            <td>$m->sks sks</td>
                                                            <td>$m->jam Jam</td>";
                                                            if($m->aktif=='y')
                                                            {
                                                                echo"<td width=10><i class='fa fa-eye' onclick='ubahstatus($m->mapel_id)'></i></td>";
                                                            }
                                                            else
                                                            {
                                                                echo"<td width='10'><i class='fa fa-eye-slash' onclick='ubahstatus($m->mapel_id)'></i></td>";
                                                            }
                                                             echo"<td width='10'>".anchor("matapelajaran/edit/".$m->mapel_id,"<i class='fa fa-share-square-o'></i>",array('title'=>'Edit'))."</td>
                                                             <td width=10><i class='fa fa-trash-o' onclick='hapus($m->mapel_id)'></i></td>
                                                            </tr>";
                                $no++;
                            }
                            
            }
            echo "<table>";
        }
        else
        {
        $query          =   "SELECT mm.jam,mm.aktif,mm.mapel_id,mm.kode_mapel,mm.nama_mapel,mk.kode_kelompok,mm.sks
                            FROM mapel_matapelajaran as mm,mapel_kelompok as mk
                            WHERE mk.kelompok_id=mm.kelompok_id and mm.konsentrasi_id='$konsentrasi' and mm.semester='$semester' order by mm.kode_mapel asc";
        $mapel          =   $this->db->query($query)->result();
            echo"<table class='table table-bordered'>
            <tr><th width=10>No</th><th width=20>Kode</th><th width=40>Kelompok</th>
            <th>Nama Matapelajaran</th><th width=60>SKS</th><th width=60>JAM</th><th colspan=3>Operasi</th></tr>";
            $no=1;
            foreach ($mapel as $m)
            {
                echo "<tr id='hide$m->mapel_id'><td>$no</td>
                                        <td>".  strtoupper($m->kode_mapel)."</td>
                                        <td>".  strtoupper($m->kode_kelompok)."</td>
                                            <td>".  strtoupper($m->nama_mapel)."</td>
                                            <td>$m->sks sks</td><td>$m->jam Jam</td>";
                                            if($m->aktif=='y')
                                                            {
                                                                echo"<td width=10><i class='fa fa-eye' onclick='ubahstatus($m->mapel_id)'></i></td>";
                                                            }
                                                            else
                                                            {
                                                                echo"<td width='10'><i class='fa fa-eye-slash' onclick='ubahstatus($m->mapel_id)'></i></td>";
                                                            }
                                                             echo"<td width='10'>".anchor("matapelajaran/edit/".$m->mapel_id,"<i class='fa fa-share-square-o'></i>",array('title'=>'Edit'))."</td>
                                                             <td width=10><i class='fa fa-trash-o' onclick='hapus($m->mapel_id)'></i></td>
                                                            </tr>";
                $no++;
            }

            echo "<table>";
        }   
    }
    

}