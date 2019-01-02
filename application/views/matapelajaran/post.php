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
    loadkonsentrasi();
});
</script>

<script>
$(document).ready(function(){
  $("#kelas").change(function(){
      loadkonsentrasi();
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
</script>


<?php
echo $this->session->flashdata('pesan');
?>
   <?php
echo form_open_multipart($this->uri->segment(1).'/post');
$semester=array(1=>'Semester 1',
                2=>'Semester 2',
                3=>'Semester 3',
                4=>'Semester 4',
                5=>'Semester 5',
                6=>'Semester 6',
                7=>'Semester 7',
                8=>'Semester 8');
if($this->session->userdata('level')==1)
{
    $param="";
}
else
{
    $param=array('kelas_id'=>$this->session->userdata('keterangan'));
}
?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Entry Record</h3>
  </div>
<table class="table table-bordered">

    <tr>
    <td width="150">Kode / Nama Matapelajaran</td><td>
        <?php echo inputan('text', 'kode','col-sm-2','Kode Matapelajaran ..', 1, '','');?>
        <?php echo inputan('text', 'nama','col-sm-4','Nama Matapelajaran ..', 1, '','');?>
    </td>
    </tr>
    
    
    <tr>
    <td width="150">SKS / Semester</td><td>
        <?php echo inputan('text', 'sks','col-sm-1','SKS ..', 1, '','');?>
        <div class="col-sm-2">
        <?php echo form_dropdown('semester',$semester,'',"class='form-control'")?>
        </div>
    </td>
    </tr>
    
      <tr>
    <td width="150">Kelompok Matapelajaran</td><td>
         <div class="col-sm-6">
        <?php echo buatcombo('kelompok', 'mapel_kelompok', '', 'nama', 'kelompok_id', '', '')?>
         </div>
    </td>
    </tr>
    
    <tr>
        <td width="150">Konsentrasi / Kelas</td><td>
            <div class="col-sm-3">
        <?php echo buatcombo('kelas', 'akademik_kelas', '', 'nama_kelas', 'kelas_id', $param, array('id'=>'kelas'))?>
            </div>
            
                        <div class="col-sm-3">
        <?php echo combodumy('konsentrasi', 'konsentrasi')?>
            </div>
    </td>
    <tr><td>Jumlah Jam</td><td> <?php echo inputan('text', 'jam','col-sm-1','Jam ..', 1, '','');?></td></tr>
    </tr>
    
    <tr>
         <td></td><td colspan="2"> 
            <input type="submit" name="submit" value="simpan" class="btn btn-danger  btn-sm">
            <?php echo anchor($this->uri->segment(1),'kembali',array('class'=>'btn btn-danger btn-sm'));?>
        </td></tr>
    
</table>
</div></div>
</form>
