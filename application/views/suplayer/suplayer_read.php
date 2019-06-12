<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Suplayer Read</h2>
        <table class="table">
	    <tr><td>Kode Barang</td><td><?php echo $kode_barang; ?></td></tr>
	    <tr><td>Nama Suplayer</td><td><?php echo $nama_suplayer; ?></td></tr>
	    <tr><td>Jumlah Storan</td><td><?php echo $jumlah_storan; ?></td></tr>
	    <tr><td>Tgl Penyetoran</td><td><?php echo $tgl_penyetoran; ?></td></tr>
	    <tr><td>Jumlah Terjual</td><td><?php echo $jumlah_terjual; ?></td></tr>
	    <tr><td>Sisa Barang</td><td><?php echo $sisa_barang; ?></td></tr>
	    <tr><td>Nominal Uang</td><td><?php echo $nominal_uang; ?></td></tr>
	    <tr><td>Tgl Pengambilan</td><td><?php echo $tgl_pengambilan; ?></td></tr>
	    <tr><td>Petugas</td><td><?php echo $petugas; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('suplayer') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>