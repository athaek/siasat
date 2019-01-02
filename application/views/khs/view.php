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
          //tampilkan_semester();
         
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
  $("#semester").change(function(){
      var siswa=$("#list").val();
      var semester=$("#semester").val();
      loaddata(siswa,semester);
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
    url:"<?php echo base_url();?>khs/tampilkansiswa",
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
function loaddata(siswa_id,semester)
{
        $.ajax({
	url:"<?php echo base_url();?>khs/loaddata",
	data:"id_siswa=" + siswa_id+"&semester="+semester ,
	success: function(html)
	{
            //tampilkan_semester(siswa_id);
            $("#daftarkrs").html(html);
	}
	});
}

function print(id)
{
    alert('do print');
}
function tampilkan_semester(id)
{
   
    $.ajax({
	url:"<?php echo base_url();?>khs/semester_mhs",
	data:"id_siswa=" + id ,
	success: function(html)
	{
            $("#semester").html(html);
            var semester=$("#semester").val();
            loaddata(id,semester);
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


function konfirm(khs_id)
{
        var siswa=$("#list").val();
        var semester=$("#semester").val();
        $.ajax({
	url:"<?php echo base_url();?>khs/konfirm",
	data:"khs_id=" + khs_id ,
	success: function(html)
	{
            loaddata(siswa,semester);
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
            <div class="col-md-14">
                <select class="form-control" id="tahun_angkatan">
                <?php
                foreach ($tahun_angkatan as $ta) {
                    echo "<option value='$ta->tahun_akademik_id'>$ta->keterangan</option>";         
                }
                ?>
                </select>
            </div>
        </td></tr>
    <tr><td>
             
                    <select id="list" name="example-select-multiple" class="form-control" multiple>
                    </select>
                

        </td></tr>
    <tr><td><?php echo combodumy('semester', 'semester')?></td></tr>
</table>
</div>

<div class="col-sm-9">
    <div id="daftarkrs"></div>
</div>




