<?php
class jadwalsekolah extends CI_Controller
{
    var $folder =   "jadwalsekolah";
    var $tables =   "akademik_jadwal_sekolah";
    var $pk     =   "jadwal_id";
    var $title  =   "Jadwal Sekolah";
    
    function __construct() {
        parent::__construct();
    }
    
    function index()
    {
        //akses_admin();
        $data['title']=  $this->title;
        $data['desc']="";
        $this->template->load('template', $this->folder.'/view',$data);
    }
    
    function tampiljadwal()
    {
        $konsentrasi    =   $_GET['konsentrasi'];
        $tahun_akademik =   $_GET['tahun_akademik'];
        $semester       =   $_GET['semester'];
        
        
        echo "<table class='table table-bordered' id='jadwal'>
        <tr><th width=7>No</th>
        <th width=120>Hari</th>
        <th>Kode</th>
        <th>Mata Pelajaran</th>
        <th width=5>SKS</th>
        <th width=115>Ruang</th>
        <th  width=154>Jam</th>
        <th>Guru</th>
        <th></th></tr>";
        $i=1;
       
        if($semester==0)
        {
            // looping semester
            $smt=  getField('akademik_konsentrasi', 'jml_semester', 'konsentrasi_id', $konsentrasi);
            for($j=1;$j<=$smt;$j++)
            {
                echo"<tr class='success'><th colspan=9>SEMESTER $j</th></tr>";
                $sql="  SELECT jk.*,mm.jam,mm.nama_mapel,mm.kode_mapel,mm.sks,mm.semester,jk.jam_mulai,jk.jam_selesai
                FROM akademik_jadwal_sekolah as jk,mapel_matapelajaran as mm
                WHERE mm.mapel_id=jk.mapel_id and jk.tahun_akademik_id=$tahun_akademik and jk.konsentrasi_id=$konsentrasi and jk.semester=$j";
                $data=  $this->db->query($sql)->result();
                $class="class='form-control'";
                foreach ($data as $r)
                {

                    echo "<tr><td>$i</td>
                        <td>";
                        echo editcombo('hari','app_hari','col-sm-14','hari','hari_id','',array('onchange'=>'simpanhari('.$r->jadwal_id.')','id'=>'hariid'.$r->jadwal_id),$r->hari_id);
                        echo"</td>
                        <td>".  strtoupper($r->kode_mapel)."</td>
                        <td>".  strtoupper($r->nama_mapel)."</td>
                        <td align='center'>$r->sks</td>
                        <td>";
                        echo editcombo('ruang','app_ruangan','col-sm-14','nama_ruangan','ruangan_id','',array('onchange'=>'simpanruang('.$r->jadwal_id.')','id'=>'ruangid'.$r->jadwal_id),$r->ruangan_id);
                        echo"</td>
                        <td>";
                        echo inputan('text', '', 'col-sm-9', '', 1, $r->jam_mulai, array('onKeyup'=>'simpanjam('.$r->jadwal_id.')','id'=>'jamid'.$r->jadwal_id));
                        echo inputan('text','', 'col-sm-9', '', 1, $r->jam_selesai, array('disabled'=>'disabled'));
                        //echo editcombo('waktu_sekolah','akademik_waktu_sekolah','col-sm-13','keterangan','waktu_id','',array('onchange'=>'simpanjam('.$r->jadwal_id.')','id'=>'jamid'.$r->jadwal_id),$r->waktu_id);
                        echo"</td>
                        <td>";
                        echo editcombo('guru','app_guru','col-sm-13','nama_lengkap','guru_id','',array('onchange'=>'simpanguru('.$r->jadwal_id.')','id'=>'guruid'.$r->jadwal_id),$r->guru_id);
                        echo"</td>
                            <td><i class='gi gi-print' title='cetak absen'></i></td></tr>";
                    $i++;
                }  
            }
        }
        else
        {
            $sql="  SELECT jk.*,mm.jam,mm.nama_mapel,mm.kode_mapel,mm.sks,mm.semester,jk.jam_mulai,jk.jam_selesai
                FROM akademik_jadwal_sekolah as jk,mapel_matapelajaran as mm
                WHERE mm.mapel_id=jk.mapel_id and jk.tahun_akademik_id=$tahun_akademik and jk.konsentrasi_id=$konsentrasi and jk.semester=$semester";
                $data=  $this->db->query($sql)->result();
                $class="class='form-control'";
                foreach ($data as $r)
                {

                    echo "<tr><td>$i</td>
                        <td>";
                        echo editcombo('hari','app_hari','col-sm-14','hari','hari_id','',array('onchange'=>'simpanhari('.$r->jadwal_id.')','id'=>'hariid'.$r->jadwal_id),$r->hari_id);
                        echo"</td>
                        <td>".  strtoupper($r->kode_mapel)."</td>
                        <td>".  strtoupper($r->nama_mapel)."</td>
                        <td align='center'>$r->sks</td>
                        <td>";
                        echo editcombo('ruang','app_ruangan','col-sm-14','nama_ruangan','ruangan_id','',array('onchange'=>'simpanruang('.$r->jadwal_id.')','id'=>'ruangid'.$r->jadwal_id),$r->ruangan_id);
                        echo"</td>
                        <td>";
                        echo inputan('text', '', 'col-sm-9', '', 1, $r->jam_mulai, array('onKeyup'=>'simpanjam('.$r->jadwal_id.')','id'=>'jamid'.$r->jadwal_id));
                        echo inputan('text','', 'col-sm-9', '', 1, $r->jam_selesai, array('disabled'=>'disabled'));
                        //echo editcombo('waktu_sekolah','akademik_waktu_sekolah','col-sm-13','keterangan','waktu_id','',array('onchange'=>'simpanjam('.$r->jadwal_id.')','id'=>'jamid'.$r->jadwal_id),$r->waktu_id);
                        echo"</td>
                        <td>";
                        echo editcombo('guru','app_guru','col-sm-13','nama_lengkap','guru_id','',array('onchange'=>'simpanguru('.$r->jadwal_id.')','id'=>'guruid'.$r->jadwal_id),$r->guru_id);
                        echo"</td>
                            <td><i class='gi gi-print' title='cetak absen'></i></td></tr>";
                    $i++;
                }
        }
        echo"</table>";
    }
    
    function simpanhari()
    {
        $id         =   $_GET['id'];
        $nilaihari  =   $_GET['nilaihari'];
        $nilaijam   =   $_GET['nilai_jam'];
        $nilairuang =   $_GET['nilai_ruang'];
        $get_jam    =   $this->db->query("SELECT mm.jam,jk.ruangan_id,jk.hari_id,jk.jadwal_id
                        FROM akademik_jadwal_sekolah as jk,mapel_matapelajaran as mm 
                        WHERE mm.mapel_id=jk.mapel_id and jk.jadwal_id=$id")->row_array();
        $chek=  $this->chek_ruangan($nilairuang, $nilaihari, $nilaijam);
        if($chek==1)
        {
             $this->mcrud->update($this->tables,array('hari_id'=>$nilaihari), $this->pk,$id);
             echo "<div class='alert alert-success'>Jadwal Berhasil Diperbaharui <i class='gi gi-ok'></i> </div>"; 
        }
        else
        {
            echo "<div class='alert alert-danger'>Jadwal Gagal Diperbaharui <i class='gi gi-remove'></i> </div>";
        }
        
           
           
    }
    
    function simpanruang()
    {
        $id         =   $_GET['id'];
        $nilaijam   =   $_GET['nilai_jam'];
        $nilaihari  =   $_GET['nilaihari'];
        $nilairuang =   $_GET['nilai_ruang'];
        $get_jam    =   $this->db->query("SELECT mm.jam,jk.ruangan_id,jk.hari_id,jk.jadwal_id
                        FROM akademik_jadwal_sekolah as jk,mapel_matapelajaran as mm 
                        WHERE mm.mapel_id=jk.mapel_id and jk.jadwal_id=$id")->row_array();
        $chek=  $this->chek_ruangan($nilairuang, $nilaihari, $nilaijam);
        if($chek==1)
        {
            
            $this->mcrud->update($this->tables,array('ruangan_id'=>$nilairuang), $this->pk,$id);
             echo "<div class='alert alert-success'>Jadwal Berhasil Diperbaharui <i class='gi gi-ok'></i> </div>"; 
        }
        else
        {
            echo "<div class='alert alert-danger'>Jadwal Gagal Diperbaharui <i class='gi gi-remove'></i> </div>";
        }
 
    }
    
    function simpanguru()
    {
        $id         =   $_GET['id'];
        $nilaiguru =   $_GET['nilai_guru'];
        $this->mcrud->update($this->tables,array('guru_id'=>$nilaiguru), $this->pk,$id);
        echo "<div class='alert alert-success'>Jadwal Berhasil Diperbaharui <i class='gi gi-ok'></i> </div>"; 
        
    }
    
    
    function chek_ruangan($ruangan_id,$hari_id,$jam)
    {
        $query="SELECT jadwal_id,timediff(jam_selesai,'$jam') as selisih 
                FROM akademik_jadwal_sekolah
                WHERE hari_id='$hari_id' and ruangan_id='$ruangan_id'";
        
        $chek=$this->db->query($query)->num_rows();
        if($chek==0)
        {
            return 1;
        }
        else 
        {
            $r      =   $this->db->query($query)->row_array();
            $jam    =   substr($r['selisih'],0,2);
            $menit  =   substr($r['selisih'],3,2);
            if($menit>0 or $jam>0)
            {
                // tidak
                return 0;
            }
            else
            {
                return 1;
            }
        }
    }
    function simpanjam()
    {
        $id         =   $_GET['id'];
        $nilaijam   =   $_GET['nilai_jam'];
        $nilaihari  =   $_GET['nilaihari'];
        $nilairuang =   $_GET['nilai_ruang'];
        $get_jam    =   $this->db->query("SELECT mm.jam,jk.ruangan_id,jk.hari_id,jk.jadwal_id
                        FROM akademik_jadwal_sekolah as jk,mapel_matapelajaran as mm 
                        WHERE mm.mapel_id=jk.mapel_id and jk.jadwal_id=$id")->row_array();
        $chek=  $this->chek_ruangan($nilairuang, $nilaihari, $nilaijam);

        if($chek==1)
        {
            // save
            $jam_selesai=  $this->get_jam_selesai_sekolah($nilaijam.':00', ($get_jam['jam']*50));
            $this->mcrud->update($this->tables,array('jam_mulai'=>$nilaijam,'jam_selesai'=>$jam_selesai), $this->pk,$id);
            echo "<div class='alert alert-success'>Jadwal Berhasil Diperbaharui <i class='gi gi-ok'></i> </div>";
        }
        else
        {
             echo "<div class='alert alert-danger'>Jadwal Gagal Diperbaharui <i class='gi gi-remove'></i> </div>";
        } 
    }
    
    function autosetup()
    {
        $tahun_akademik_id  =   $this->input->post('tahun_akademik');
        $tahun_akd          =   getField('akademik_tahun_akademik', 'keterangan', 'tahun_akademik_id', $tahun_akademik_id);
        $tahun_akd=  substr($tahun_akd, 4,1);
        $kelas              =   $this->input->post('kelas');
        $konsentrasi        =   $this->input->post('konsentrasi');
        // get semester
        $semester           =   getField('akademik_konsentrasi', 'jml_semester', 'konsentrasi_id', $konsentrasi);
        // looping semester
        
        if($tahun_akd==1)
        {
            $sms=array(1,3,5,7);
        }
        else
        {
            $sms=array(2,4,6,8);
        }
        //for($i=1;$i<=$semester;$i++)
        for($i=0;($i<=count($sms)-1);$i++)
        {
            $smstr=$sms[$i];
            // ambil mapel_id dari mapel_matapelajaran
            $mapel      =   $this->db->get_where('mapel_matapelajaran',array('semester'=>$smstr,'konsentrasi_id'=>$konsentrasi,'aktif'=>'y'))->result();
            foreach ($mapel as $mapel)
            {
                $mapel_id   =   $mapel->mapel_id;
                // chek udah ada belum
                $param      =   array('tahun_akademik_id'=>  $tahun_akademik_id,
                                       'konsentrasi_id'=>$konsentrasi,
                                       'mapel_id'=>$mapel_id);
                $chek       =  $this->db->get_where('akademik_jadwal_sekolah',$param)->num_rows();
                if($chek<1)
                {
                    $data       =   array(  'tahun_akademik_id'=>  get_tahun_akademik(),
                                            'konsentrasi_id'=>$konsentrasi,
                                            'mapel_id'=>$mapel_id,
                                            'hari_id'=>0,
                                            'semester'=>$i,
                                            'waktu_id'=>0,
                                            'ruangan_id'=>0,
                                             'semester'=>$smstr,
                                            'guru_id'=>0);
                    $this->db->insert('akademik_jadwal_sekolah',$data);
                }
            }  
        }
        redirect('jadwalsekolah');
    }
    
    
    
    function jadwalngajar()
    {
        $guru  =  $this->session->userdata('keterangan');
        $thn    = get_tahun_ajaran_aktif('tahun_akademik_id');
        
        $query="SELECT ak.jenjang,ak.nama_konsentrasi,ar.nama_ruangan,mm.sks,mm.nama_mapel,mm.kode_mapel,ah.hari,aj.jam_mulai,aj.jam_selesai
                FROM akademik_jadwal_sekolah as aj,app_ruangan as ar,akademik_konsentrasi as ak,mapel_matapelajaran as mm,app_hari as ah
                WHERE ar.ruangan_id=aj.ruangan_id and ak.konsentrasi_id=aj.konsentrasi_id and mm.mapel_id=aj.mapel_id and ah.hari_id=aj.hari_id and aj.guru_id=1 and aj.tahun_akademik_id";
        $data['jadwal']=  $this->db->query($query)->result();
        $data['title']="Jadwal Mengajar";
        $data['guru']=$guru;
        $this->template->load('template', $this->folder.'/jadwalngajar',$data);
    }
    
    
            function get_jam($menit)
        {
            for($i=0;$i<=7;$i++)
            {
                if(($i*60)>$menit)
                {
                    return $i-1;
                    exit();
                }
            }
        }
        
        
        function get_menit($menit)
        {
            $jam=  $this->get_jam($menit);
            return $menit-$jam*60;
        }
        
        function get_nol($nilai)
        {
            if($nilai>9)
            {
                return $nilai;
            }
            else
            {
                return "0$nilai";
            }
        }
        
        function get_jam_selesai_sekolah($jam_mulai,$waktu_sekolah)
        {
            $jam=  $this->get_jam($waktu_sekolah);
            $menit=  $this->get_menit($waktu_sekolah);
            $dateString = "Tue, 13 Mar 2012 $jam_mulai";
            $date = new DateTime( $dateString );
            $nextHour   = (intval($date->format('H'))+$jam) % 24;
            $nextMinute = (intval($date->format('i'))+$menit) % 60;
            return $this->get_nol($nextHour).':'.$this->get_nol($nextMinute); 
        }
        

        
        function cetak()
        {
            //$konsen             =  $this->uri->segment(3);
            //$semester           =  $this->uri->segment(4);
            //$tahun              =  $this->uri->segment(5);
            //$konsen             =  $this->uri->segment(3);
            $konsen             =  $this->input->post('konsentrasi');
            $semester           =  $this->input->post('semester');
            $tahun              =  $this->input->post('tahun_akademik');
            $data['konsen']     =  $konsen;
            $data['semester']   =  $semester;
            $data['tahun']      =  $tahun;
            $data['hari']       =  array('','senin','selasa','rabu','kamis','jumat','sabtu','minggu');
            $data['kelas']      =  strtoupper(getField('akademik_kelas', 'nama_kelas', 'kelas_id', getField('akademik_konsentrasi', 'kelas_id', 'konsentrasi_id', $konsen)));
            $data['konsentrasi']=  strtoupper(getField('akademik_konsentrasi', 'nama_konsentrasi', 'konsentrasi_id', $konsen));
            $this->load->view($this->folder.'/cetak',$data);
            
        }
}