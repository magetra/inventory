<!DOCTYPE html>
<html>
<head>
	<base href="<?php echo base_url() ?>">
	<title>Cetak Stok Barang</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
</head>
<body onload="print()">
	<center>
		<h3>Stok Barang</h3>
	</center>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Stok</th>
            </tr><?php
            $start = 0;
            $barang_data = $this->db->get('barang');
            foreach ($barang_data->result() as $barang)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start ?></td>
            <td><?php echo $barang->kode_barang ?></td>
            <td><?php echo $barang->nama_barang ?></td>
            <td><?php echo $barang->stok ?></td>
        </tr>
                <?php
            }
            ?>
        </table>
		</div>
	</div>


</body>
</html>