<body onload="window.print()">
    
</body><style type="text/css">
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
<table>
    <tr><td width="100">NIS</td><td>: <?php echo strtoupper($biodata['nis'])?></td></tr>
     <tr><td>NAMA</td><td>: <?php echo strtoupper($biodata['nama'])?></td></tr>
      <tr><td>KONSENTRASI</td><td>: <?php echo strtoupper($biodata['nama_konsentrasi'])?></td></tr>
</table>
<hr style="color: black;">
<table border="1" cellspacing="0">
    <tr class="success"><th colspan="7">Riwayat Transaksi Detail</th></tr>
    <tr><th width="10">No</th>
        <th width="500">Jenis Pembayaran</th>
        <th width="160">Tanggal</th>
        <th width="200">Jumlah</th>
        <th width="150">Petugas</th>
    </tr>


    <?php
    $i=1;
    
    foreach ($transaksi as $r)
    {
        $smt=$r->jenis_bayar_id==3?$r->semester:'';
        echo "<tr>
            <td>$i</td>
            <td>".  strtoupper($r->keterangan)." $smt</td>
            <td>".  tgl_indo($r->tanggal)."</td>
            <td>Rp .".rp((int)$r->jumlah)."</td>
            <td>".  strtoupper($r->nama)."</td>
            </tr>";
        $i++;
    }
    ?> 


    <tr><td colspan="4" align="left">Total </td><td><?php echo  rp($sisa_total);?></td></tr>
</table>

<br><br>
Tuban, <?php echo tgl_indo(substr(waktu(), 0,10))?><br>
Bagian Keuangan<BR></br><br><br><br>
(...........................)