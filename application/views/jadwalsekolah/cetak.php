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
        padding: 4px;
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
<h3 style="border: 1px solid #000;padding: 10px;">JADWAL SEKOLAH <BR>SEMESTER GENAP TAHUN AKADEMIK 2014-2015</h3>
<table>
    <tr>
        <td rowspan="3"><img src="<?php echo base_url()?>assets/images/logo.png" width="100" style="float: left;margin-right: 10px;">
            <h3>SMA NEGERI 1 TUBAN</h3>
                        Jl.Basuki Rahmad No 55, Tuban - Surabaya, Jawa Timur<br>				
                        Telp / Fax : 0356 - 322725<br>							
                        Email : bankjatimtuban017@gmail.com</td>
        <td style="font-weight: bold">Program Studi</td><td style="font-weight: bold">: <?php echo $kelas;?></td>
    </tr>
    <tr style="font-weight: bold"><td>Konsentrasi</td><td>: <?php echo $konsentrasi;?></td></tr>
     <tr style="font-weight: bold"><td>Semester</td><td> : <?php echo $semester;?></td></tr>
</table>

<br>
<table border="1" cellspacing="0" style="border: 1px solid #000;">
    <tr><th>NO</th>
    <?php
    for($i=1;$i<=7;$i++)
    {
        echo "<th width=160>".  strtoupper($hari[$i])."</th>";
    }
    ?>
    </tr>
    <?php
    for($i=1;$i<=5;$i++)
    {
        echo "<tr><td>$i</td>";
        for($h=1;$h<=7;$h++)
        {
            echo "<td style='text-align: center'>".  chek_jadwal_sekolah($konsen, $h, $tahun,$semester,$i-1)."</td>";
        }
        echo"</tr>";
    }
    ?>
</table>

<table style="font-weight: bold;">
    <tr><td>Ket</td><td>:1 SKS Teori adalah 1 jam =  40 menit<br> 1 SKS Praktek adalah 2 Jam    = 80 menit</td></tr>
    <tr><td>Catatan</td><td>: Pergantian Jadwal sekolah baik Guru harap menghubungi bag. Administrasi</td></tr>
</table>

<table style="font-weight: bold;">
    <tr><td width="500">Mengetahui<br>Pembantu Kepala Seklolah I<br>Bidang Administrasi</td><td>Tuban, Januari 2018<br>Ka. Tatausaha<br>Sekretaris Tatausaha</td></tr>
    <tr><td height="100">Arta Waluyo </td><td>Arta Waluyo</td></tr>
</table>