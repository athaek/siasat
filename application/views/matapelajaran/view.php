<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Entry Record</li>
    </ol>
</div>
 
 <script src="<?php echo base_url()?>assets/js/jquery.min.js">
</script>
<script>
$(document).ready(function(){
    loadkonsentrasi();
});
</script>

<script>
$(document).ready(function(){
  $("#konsentrasi").change(function(){
      loadsemester();
  });
});
</script>

<script>
$(document).ready(function(){
  $("#kelas").change(function(){
      loadkonsentrasi();
  });
});
</script>
<script>
$(document).ready(function(){
  $("#semester").change(function(){
      tampilmapel();
  });
});
</script>

<script type="text/javascript">
function loadkonsentrasi()
{
    var kelas=$("#kelas").val();
    $.ajax({
    url:"<?php echo base_url();?>matapelajaran/tampilkonsentrasi",
    data:"kelas=" + kelas ,
    success: function(html)
    { 
       $("#konsentrasi").html(html);
       loadsemester();
    }
          });
}

function hapus(id)
{
    $.ajax({
    url:"<?php echo base_url();?>matapelajaran/delete",
    data:"id=" + id ,
    success: function(html)
    { 
       $("#hide"+id).hide(300);
    }
          });   
}

function ubahstatus(id)
{
    $.ajax({
    url:"<?php echo base_url();?>matapelajaran/ubahstatus",
    data:"id=" + id ,
    success: function(html)
    { 
        tampilmapel();
    }
          });  
}
function loadsemester()
{
    var konsentrasi=$("#konsentrasi").val();
    $.ajax({
    url:"<?php echo base_url();?>matapelajaran/tampilsemester",
    data:"konsentrasi=" + konsentrasi ,
    success: function(html)
    { 
       $("#semester").html(html);
       tampilmapel();
    }
          });
    
}


function tampilmapel()
{
    var konsentrasi=$("#konsentrasi").val();
    var semester=$("#semester").val();
    $.ajax({
    url:"<?php echo base_url();?>matapelajaran/tampilmapel",
    data:"konsentrasi=" + konsentrasi +"&semester="+semester ,
    success: function(html)
    { 
       $("#mapel").html(html);
      
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
       
    <tr><td>Program Studi <?php echo buatcombo('kelas', 'akademik_kelas', '', 'nama_kelas', 'kelas_id', $param, array('id'=>'kelas'))?></td></tr>
    <tr><td>Konsentrasi <?php echo combodumy('konsentrasi', 'konsentrasi')?></td></tr>
    <tr><td>Semester <?php echo combodumy('semester', 'semester')?></td></tr>
    <tr><td><?php echo anchor('matapelajaran/post','<span class="glyphicon glyphicon-plus"></span> Input Data',array('class'=>'btn btn-primary  btn-sm'));?> 
        <?php //echo anchor('matapelajaran/#','<span class="glyphicon glyphicon-print"></span> Cetak Data',array('class'=>'btn btn-primary  btn-sm'));?></td></tr>
</table>
</div>

<div class="col-sm-9">
    
    <table class="table table-bordered" id="mapel">
        <tr><th width="5">No</th><th width="100">Kode</th><th width="50">Kelompok</th><th>Matapelajaran</th><th width="40">SKS</th><th colspan="3">Operasi</th></tr>
    </table>
</div>
