<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Data</li>
    </ol>
</div>
 
 <script src="<?php echo base_url()?>assets/js/jquery.min.js">
</script>

<script>
$(document).ready(function(){
          loadjurusan();
         
  });
</script>

<script>
$(document).ready(function(){
  $("#kelas").change(function(){
      loadjurusan()
  });
});
</script>

<script>
$(document).ready(function(){
  $("#konsentrasi").change(function(){
      loadsiswa();
  });
});
</script>

<script>
$(document).ready(function(){
  $("#tahun_angkatan").change(function(){
      loadjurusan()
  });
});
</script>

<script>
$(document).ready(function(){
  $("#input").click(function(){
      loadtablemapel();
  });
});
</script>

<script type="text/javascript">
function loadsiswa()
{
    var konsentrasi=$("#konsentrasi").val();
    var tahun_angkatan=$("#tahun_angkatan").val();
    $.ajax({
    url:"<?php echo base_url();?>krs/tampilkansiswa",
    data:"konsentrasi=" + konsentrasi + "&tahun_angkatan=" + tahun_angkatan ,
    success: function(html)
       {
          $("#list").html(html);
       }
       });
}
</script>

<script type="text/javascript">


function loadjurusan()
{
    var kelas=$("#kelas").val();
    $.ajax({
	url:"<?php echo base_url();?>siswa/tampilkankonsentrasi",
	data:"kelas=" + kelas ,
	success: function(html)
	{
            $("#konsentrasi").html(html);
            loadsiswa();
	}
	});
}
</script>


<script type="text/javascript">
function loaddata(siswa_id)
{
        $.ajax({
	url:"<?php echo base_url();?>krs/loaddata",
	data:"id_siswa=" + siswa_id ,
	success: function(html)
	{
            $("#daftarkrs").html(html);
	}
	});
}


function loadtablemapel(id)
{
    var konsentrasi=$("#konsentrasi").val();
    $.ajax({
	url:"<?php echo base_url();?>krs/loadmapel",
	data:"konsentrasi=" + konsentrasi +"&siswa_id="+id,
	success: function(html)
	{
            $("#daftarkrs").html(html); 
	}
	});
}


function ambil(jadwal_id,siswa_id)
{
    $.ajax({
	url:"<?php echo base_url();?>krs/post",
	data:"jadwal_id=" + jadwal_id+"&siswa_id="+siswa_id ,
	success: function(html)
	{
            $("#hide"+jadwal_id).hide(300);   
	}
	});
   
}


function hapus(krs_id)
{
        $.ajax({
	url:"<?php echo base_url();?>krs/delete",
	data:"krs_id=" + krs_id ,
	success: function(html)
	{
            $("#krshide"+krs_id).hide(300);   
	}
	});
}
</script>
<?php
if($this->session->userdata('level')==1)
{
    $param="";
}
else
{
    $param=array('kelas_id'=>$this->session->userdata('keterangan'));
}
?>
<div class="col-sm-3">
    
    <table class="table table-bordered">
    <tr><td>Kelas<?php echo buatcombo('kelas', 'akademik_kelas', '', 'nama_kelas', 'kelas_id', $param, array('id'=>'kelas'))?></td></tr>
    <tr><td>Konsentrasi<?php echo combodumy('konsentrasi', 'konsentrasi')?></td></tr>
    <tr><td>Tahun Angkatan
            <?php echo buatcombo('tahun_angkatan', 'student_angkatan', '', 'keterangan', 'angkatan_id', '', array('id'=>'tahun_angkatan'))?>
        </td></tr>
    <tr><td>
             
                    <select id="list" name="example-select-multiple" class="form-control" multiple>
                    </select>
                

        </td></tr>

</table>
</div>

<div class="col-sm-8">
    <div id="daftarkrs"></div>
</div>




