<?php
$method=$this->uri->segment(5);
if($method=='cetak')
{
    ?>

<body onload="window.print()">
    
<?php

}
else
{
    header("Content-Type: application/vnd.ms-word");
        header("Expires: 0");
        header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
        header("Content-disposition: attachment; filename=jurnal khusus.doc");
}
?>
<style type="text/css">
    body
    {
        font-family: sans-serif;
        font-size: 14px;
    }
    th{
        padding: 5px;
        font-weight: bold;
        font-size: 12px;
    }
    td{
        font-size: 12px;
    }
    h2{
        text-align: left;
        margin-bottom: 13px;
    }
    .potong
    {
        page-break-after:always;
    }
</style>
<table><tr><td><img src='<?php echo base_url()?>assets/images/logo.png' width=50 height=50></td>
						<td style='vertical-align:middle;font-size:16px;padding:10px;'><b>LAPORAN JURNAL KHUSUS</b><br>
                                                    Tanggal <?php echo tgl_indo($this->uri->segment(3))?> Sampai <?php echo tgl_indo($this->uri->segment(4))?></td></tr>
</table><hr>
<br><table border="1" cellspacing="0">
  <tr>
    <th width="15" rowspan="2">No</th>
    <th rowspan="2">Tanggal</th>
    <th colspan="3"><p  align="center">Keterangan</p></th>
    <th colspan="3"><p  align="center">Kas (Debit)</p> </th>
    <th rowspan="2"><p  align="center">Pendapatan Kredit </p></th>
  </tr>
  <tr>
    <th>Nis</th>
    <th>Nama</th>
    <th >Jenis Pembayaran </th>
   
    <th>Biaya Sekolah Reguler </th>
    <th>Biaya Wisuda </th>
    <th>Lain Lain </th>
  
  </tr>
      <?php
    $no=1;
    $jumlah=0;
    $totalsmpp=0;
    $totalwisuda=0;
    $totallain=0;
    foreach ($transaksi as $r)
    {
        $spp=testing($r->jenis_bayar_id ,3,$r->jumlah);
        $wisuda=testing($r->jenis_bayar_id ,7,$r->jumlah);
        $lain=testing2($r->jenis_bayar_id ,$r->jumlah);
  echo "<tr>
    <td>$no</td>
    <td width='90'>".  tgl_indo($r->tanggal)."</td>
    <td width='40'>".  strtoupper($r->nis)."</td>
    <td>". strtoupper($r->nama)."</td>
    <td>".  strtoupper($r->jenis_bayar)."</td>
    <td>".$spp  ."</td>

 
    <td>". $wisuda ."</td>
    <td>". $lain ."</td>
   <td>$r->jumlah</td>
  </tr>";
  $no++;
  $totallain=$totallain+$lain;
  $totalsmpp=$totalsmpp+$spp;
  $totalwisuda=$totalwisuda+$wisuda;
    }
    ?>
    <tr>
    <td colspan=5><p align="right" >Total</p></td>
    <td><?php echo rp((int)$totalsmpp);?></td>
     <td><?php echo rp($wisuda);?></td>
     <td><?php echo rp($totallain);?></td>
    <td><?php echo rp($totalsmpp+$totallain+$totalwisuda);?></td>

  </tr>
  <tr>
      <td colspan="5"><p align="right" >Jumlah Debit</p></td>
      <td colspan="3"><p align="right" ><?php echo rp($totalsmpp+$totallain+$totalwisuda);?></p></td>

      <td><?php echo rp($totalsmpp+$totallain+$totalwisuda);?></td>
  </tr>
</table>