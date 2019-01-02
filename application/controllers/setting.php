<?php
class setting extends CI_Controller
{
    
    var $folder =   "setting";
    var $tables =   "setting";
    var $pk     =   "kelompok_id";
    
    function __construct() 
    {
        parent::__construct();
    }
    
    function index()
    {
        
    }
    
    function  profilekampus()
    {
        if(isset($_POST['submit']))
        {
            $nama   =   $this->input->post('nama');
            $alamat =   $this->input->post('alamat');
            $telpon =   $this->input->post('telpon');
            $data   =   array('nama_sekolah'=>$nama,'alamat_sekolah'=>$alamat,'telpon'=>$telpon);
            $this->mcrud->update($this->tables,$data, 'id',1);
            redirect('setting/profilesekolah');
        }
        else
        {
            $data['r']=  $this->db->get_where('setting',array('id'=>1))->row_array();
            $this->template->load('template', $this->folder.'/profile',$data);
        }
    }
}