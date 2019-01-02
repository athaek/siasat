<?php
class kelas extends CI_Controller{
    
    var $folder =   "kelas";
    var $tables =   "akademik_kelas";
    var $pk     =   "kelas_id";
    var $title  =   "Program Kelas";
    
    function __construct() {
        parent::__construct();
    }
    
    function index()
    {
        $data['title']  = $this->title;
        $data['desc']    =   "";
        $data['record'] =  $this->db->query('select * from akademik_kelas order by nama_kelas')->result();
	$this->template->load('template', $this->folder.'/view',$data);
    }
    function post()
    {
        if(isset($_POST['submit']))
        {
            $nama   =   $this->input->post('nama');
            $ketua  =   $this->input->post('ketua');
            $izin   =   $this->input->post('izin');
            $data   =   array('nama_kelas'=>$nama,'ketua'=>$ketua,'no_izin'=>$izin);
            $this->db->insert($this->tables,$data);
            redirect($this->uri->segment(1));
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
            $nama   =   $this->input->post('nama');
            $ketua  =   $this->input->post('ketua');
            $izin   =   $this->input->post('izin');
            $id     = $this->input->post('id');
            $data   =   array('nama_kelas'=>$nama,'ketua'=>$ketua,'no_izin'=>$izin);
            $this->mcrud->update($this->tables,$data, $this->pk,$id);
            redirect($this->uri->segment(1));
        }
        else
        {
            $data['title']  = $this->title;
            $data['desc']    =   "";
            $id          =  $this->uri->segment(3);
            $data['r']   =  $this->mcrud->getByID($this->tables,  $this->pk,$id)->row_array();
            $this->template->load('template', $this->folder.'/edit',$data);
        }
    }
    
    function delete()
    {
        $id     =  $this->uri->segment(3);
        $chekid = $this->db->get_where($this->tables,array($this->pk=>$id));
        if($chekid->num_rows()>0)
        {
            $this->mcrud->delete($this->tables,  $this->pk,  $this->uri->segment(3));
        }
        redirect($this->uri->segment(1));
    }
    
    
    function pencarian()
    {
        $key=$_GET['key'];
        $query="select * from akademik_kelas where nama_kelas LIKE '%$key%'";

        echo "<table class='table table-bordered'>
            <tr><th width=15>No</th><th>Program Kelas</th><th width=315>Ketua</th><th width=215>No Izin</th><th colspan=3 width=30>Option</th></tr>";
        $data=  $this->db->query($query)->result();
        $no=1;
        foreach ($data as $r)
        {
             echo "<tr>
                 <td>$no</td>
                 <td>".  strtoupper($r->nama_kelas)."</td>
                 <td>".  strtoupper($r->ketua)."</td>
                 <td>".  strtoupper($r->no_izin)."</td>
                 <td width=10><span class='glyphicon glyphicon-trash' onclick='hapus($r->kelas_id)'></span></td>
                 <td width=10>".anchor($this->uri->segment(1).'/edit/'.$r->prodi_id,"<span class='glyphicon glyphicon-edit'></span>")."</td>
                 <td width=10><span class='fa fa-list-alt'></span></td>
                 </tr>";
             $no++;
        }
       
        echo"</table>";
    }
}