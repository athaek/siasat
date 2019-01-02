<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

error_reporting(E_ALL ^ E_DEPRECATED);
mysql_connect("101.50.1.20","mossmasa_toorharmonysekolahsmansa","*B4nkJ4t1m#");
mysql_select_db("mossmasa_sekolah");

if(isset($_GET['type'])){

	if($_GET['type'] == "login"){
		
		$username = $_GET['username'];
		$password = md5($_GET['password']);

		$query = " SELECT student_siswa.nama,student_siswa.alamat,akademik_konsentrasi.nama_konsentrasi,akademik_kelas.nama_kelas,app_usersiswa.nis,keuangan_pembayaran_detail.tanggal,keuangan_pembayaran_detail.jumlah
					FROM app_usersiswa 
					INNER JOIN student_siswa ON student_siswa.nis = app_usersiswa.nis
					INNER JOIN keuangan_pembayaran_detail ON keuangan_pembayaran_detail.nis = student_siswa.nis
					INNER JOIN 	akademik_konsentrasi ON akademik_konsentrasi.konsentrasi_id = student_siswa.konsentrasi_id
					INNER JOIN 	akademik_kelas ON akademik_kelas.kelas_id = akademik_konsentrasi.kelas_id
					Where username='$username' and password='$password'";
		$result1 = mysql_query($query);
		$totalRows = mysql_num_rows($result1);

		if($totalRows > 0){
			$recipes = array();
			while($recipe = mysql_fetch_array($result1, MYSQL_ASSOC))
			{
				//$recipes[] = array('user'=>$recipe);
				$recipes[] = $recipe;
			}

			$output = json_encode(array('siswa' => $recipes));
			//$output = json_encode($recipes); 
			//$output ="{LoginStatus:[{success:true,Successcode : 200}]}";
			echo $output;
			//header("location:htmlviewjson.html");
		}
	} else

	if($_GET['type'] == "registration"){
		$nis 		=$_GET['nis'];
		$namasiswa	=$_GET['namasiswa'];
		$username 	=$_GET['username'];
		$password = $_GET['password'];

		$query = "INSERT INTO app_usersiswa VALUES (null,'$nis','$namasiswa','$username',md5('".$password."'))";
		$result1 = mysql_query($query);
		$recipes["success"] = true;
		$recipes["Code"] = 200;

		$output = json_encode(array('siswa' =>$recipes ));
		echo $output;
	}
} else

{
	echo "invalit format";
}

?>
