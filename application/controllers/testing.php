<?php

class testing extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}


	function index()
	{
            akses_guru();
            //echo $this->get_jam_selesai_sekolah('07:00:00', '70');

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
            $dateString = "Tue, 13 jan 2018 $jam_mulai";
            $date = new DateTime( $dateString );
            $nextHour   = (intval($date->format('H'))+$jam) % 24;
            $nextMinute = (intval($date->format('i'))+$menit) % 60;
            return $this->get_nol($nextHour).':'.$this->get_nol($nextMinute); 
        }
}
?>