<?php
class setupbiayasekolah extends CI_Controller
{
    var $folder =   "setupbiayasekolah";
    var $tables =   "app_guru";
    var $pk     =   "guru_id";
    var $title  =   "Biaya Sekolah";
    
    function index()
    {
        $data['title']=  $this->title;
        $this->template->load('template', $this->folder.'/view',$data);
    }
    
    
    function loaddata()
    {
        $tahun          =  $_GET['tahun_akademik'];
        $kelas          =  $this->db->get('akademik_kelas')->result();
        $jenis_bayar    =  $this->db->get('keuangan_jenis_bayar');
        echo "<table class='table table-bordered'>
              <tr>
                <th rowspan='2'>NO</th>
                <th rowspan='2'><div align='center'>Konsentrasi</div></th>
                <th colspan='".$jenis_bayar->num_rows()."'><div align='center'>JENIS BIAYA </div></th>
                </tr>
            <tr>";
                  // foreach jenis bayar
            foreach ($jenis_bayar->result() as $j)
            {
               echo"<th>".  strtoupper($j->keterangan)."</th>";
            }
              echo"</tr>";

            echo"";
            $no=1;
            foreach ($kelas as $p) 
            {
                echo"<tr class='warning'><th>$no</th>
                     <th colspan='".($jenis_bayar->num_rows()+2)."'>".  strtoupper($p->nama_kelas)."</th></tr>";
                // foreach konsentrasi
                $konsentrasi=  $this->db->query("select konsentrasi_id,nama_konsentrasi from akademik_konsentrasi where kelas_id='$p->kelas_id'")->result();
                foreach ($konsentrasi as $ks)
                {
                    echo"<tr>
                    <td>&nbsp;</td>
                    <td>".  strtoupper($ks->nama_konsentrasi)."</td>";
                    // forach jenis bayar
                    foreach ($jenis_bayar->result() as $jb)
                    {
                        $jumlah =   $this->get_biaya_sekolah($tahun, $jb->jenis_bayar_id,$ks->konsentrasi_id,'jumlah');
                       echo"<td>Rp ".$jumlah."</td>";
                    }
                  echo"</tr>";
                }
                // end load konsentrasi
                $no++;
            }
                
          echo"</table>";
    }
    
    function get_biaya_sekolah($tahun_akademik,$jenis_biaya_sekolah,$konsentrasi,$field)
    {
        $where  =   array(  'angkatan_id'=>$tahun_akademik,
                            'jenis_bayar_id'=>$jenis_biaya_sekolah,
                            'konsentrasi_id'=>$konsentrasi);
        $r      =  $this->db->get_where('keuangan_biaya_sekolah',$where);
        if($r->num_rows()>0)
        {
            $r=$r->row_array();
            return $r[$field];
        }
        else
        {
            return '';
        }
       
    }
    
    
    function post()
    {
         $query      ="  SELECT konsentrasi_id,nama_konsentrasi 
                         FROM akademik_konsentrasi 
                         ORDER by kelas_id";
         $query2     ="  SELECT * FROM student_angkatan WHERE aktif='y'";
         $data['konsentrasi']=  $this->db->query($query)->result();
         $data['tahun_ajrn'] = $this->db->query($query2)->row_array();
         $data['title']=  $this->title;
         $this->template->load('template', $this->folder.'/post',$data);
    }
    
    function loadform()
    {
        $konsentrasi            =   $_GET['konsentrasi'];
        $tahun_angkatan_id      =   $this->db->get_where('student_angkatan',array('aktif'=>'y'))->row_array();
        $tahun_ajaran           =   $tahun_angkatan_id['angkatan_id'];
        $no=1;
        $keuangan_jenis_bayar   =   $this->db->get('keuangan_jenis_bayar')->result();
        echo "<table class='table table-bordered'>
            <tr><th width=10>No</th><th>Jenis Biaya Sekolah</th><th width=150>Jumlah Bayar</th></tr>";
        foreach ($keuangan_jenis_bayar as $r)
        {
            $a=$this->chek_data_biaya_sekolah($konsentrasi, $r->jenis_bayar_id);
            $jumlah = $this->get_biaya_sekolah($tahun_ajaran, $r->jenis_bayar_id, $konsentrasi,'jumlah');
            $id     = $this->get_biaya_sekolah($tahun_ajaran, $r->jenis_bayar_id, $konsentrasi,'biaya_sekolah_id');
            echo "<tr>
                    <td>$no</td>
                    <td> ".  strtoupper($r->keterangan)."</td>
                    <td> ".  inputan('text', 'jumlah', 'col-sm-12', '', 1, $jumlah, array('id'=>'test','onkeyup'=>"simpan($id)",'id'=>"jumlah$id"))."</td>
                    </tr>";
            $no++;
        }
        echo"</table>";
    }
    
    function chek_data_biaya_sekolah($konsentrasi,$jenis_bayar)
    {
        $tahun_angkatan_id      =   $this->db->get_where('student_angkatan',array('aktif'=>'y'))->row_array();
        $chek=  $this->db->get_where('keuangan_biaya_sekolah',array('jenis_bayar_id'=>$jenis_bayar,'konsentrasi_id'=>$konsentrasi,'angkatan_id'=>  $tahun_angkatan_id['angkatan_id']));
        if($chek->num_rows()==0)
        {
            $data=array('jenis_bayar_id'=>$jenis_bayar,
                        'konsentrasi_id'=>$konsentrasi,
                        'angkatan_id'=> $tahun_angkatan_id['angkatan_id']);
            $this->db->insert('keuangan_biaya_sekolah',$data);
        }
        //return $chek->num_rows();
    }
    
    
    function test()
    {
        echo $tahun=  get_tahun_akademik();
        //echo $this->chek_data_biaya_sekolah(10, 1);
    }
    
    function simpan()
    {
        $jumlah =   $_GET['jumlah'];
        $id     =   $_GET['id'];
        $this->mcrud->update('keuangan_biaya_sekolah',array('jumlah'=>$jumlah), 'biaya_sekolah_id',$id);
    }
}