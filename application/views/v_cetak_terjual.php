<!DOCTYPE html>
<html>
<head>
	<base href="<?php echo base_url() ?>">
	<title>Cetak Barang Terjual</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
</head>
<body onload="print()">
	<center>
		<h3>Barang Terjual</h3>
	</center>
	<div class="row">
		<div class="col-md-12">
            Dari tanggal <b><?php echo $tgl1 ?></b> sd <b><?php echo $tgl2 ?></b>
            <hr>
			<table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Tgl Penjualan</th>
        <th>Terjual</th>
            </tr><?php
            $start = 0;
            foreach ($cetak->result() as $barang)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start ?></td>
            <td><?php echo $barang->kode_barang ?></td>
            <td><?php echo $barang->nama_barang ?></td>
            <td><?php echo $barang->tgl_penjualan ?></td>
            <td><?php
            $terjual = 0;
            $stok = $this->db->query("SELECT * from penjualan_detail where kode_barang='$barang->kode_barang'");
            foreach ($stok->result() as $f) {
                $terjual = $terjual+$f->qty;
            }
             echo $terjual ?></td>
        </tr>
                <?php
            }
            ?>
        </table>
		</div>
	</div>


</body>
</html>