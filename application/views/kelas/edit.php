<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Entry Record</li>
    </ol>
</div>
     <?php
echo form_open($this->uri->segment(1).'/edit');
echo "<input type='hidden' name='id' value='$r[kelas_id]'>";
?>
 <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Edit Record</h3>
  </div>
  <div class="panel-body">
<table class="table table-bordered">
   
    <tr>
    <td width="150">Nama Kelas</td><td>
        <?php echo inputan('text', 'nama','col-sm-4','Nama kelas ..', 1, $r['nama_kelas'],'');?>
    </td>
    </tr>
    <tr>
    <td width="150">Wali</td><td>
        <?php echo inputan('text', 'ketua','col-sm-4','Wali ..', 0, $r['ketua'],'');?>
    </td>
    </tr>
    <tr>
    <td width="150">No Izin</td><td>
        <?php echo inputan('text', 'izin','col-sm-4','No Izin ..', 0, $r['no_izin'],'');?>
    </td>
    </tr>
    <tr>
         <td></td><td colspan="2"> 
            <input type="submit" name="submit" value="simpan" class="btn btn-danger  btn-sm">
            <?php echo anchor($this->uri->segment(1),'kembali',array('class'=>'btn btn-danger btn-sm'));?>
        </td></tr>
    
</table>
  </div></div>
</form>