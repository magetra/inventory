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
        <h2 style="margin-top:0px">Tabungan Read</h2>
        <table class="table">
	    <tr><td>Saldo</td><td><?php echo $saldo; ?></td></tr>
	    <tr><td>Pengeluaran</td><td><?php echo $pengeluaran; ?></td></tr>
	    <tr><td>No</td><td><?php echo $no_santri; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('tabungan') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>