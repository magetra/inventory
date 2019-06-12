<!doctype html>
<html>
    <head>
        <title>Laporan</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body onload="print()">
        <h2 style="margin-top:0px">Setoran suplayer</h2>
        <table class="table">
	    <tr><td>Kode Barang</td><td><?php echo $kode_barang; ?></td></tr>
	    <tr><td>Tgl Setoran</td><td><?php echo $tgl_setoran; ?></td></tr>
	    <tr><td>Jumlah</td><td><?php echo $jumlah; ?></td></tr>
	    <tr><td>Petugas</td><td><?php echo $petugas; ?></td></tr>
	    
	</table>
        </body>
</html>