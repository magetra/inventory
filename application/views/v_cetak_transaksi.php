<!DOCTYPE html>
<html>
<head>
	<base href="<?php echo base_url() ?>">
	<title>Cetak Transaksi</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
</head>
<body style="padding: 20px" onload="print()">
	<center>
		<h3>Laporan Transaksi Barang</h3>
	</center>
	<br><br>

	Dari tanggal <b><?php echo $tgl1 ?></b> sd <b><?php echo $tgl2 ?></b>
	<hr>
	<table class="table table-bordered" style="margin-bottom: 10px" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Kode Penjualan</th>
					<th>Tanggal Penjualan</th>
					<th>Total Bayar</th>
					<th>Nama Kasir</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$no = 1;
				foreach ($cetak->result() as $row) {
				 ?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $row->kode_penjualan; ?></td>
					
					<td><?php echo $row->tgl_penjualan; ?></td>
					<td><?php echo $row->total_harga; ?></td>
					<td><?php echo $row->kasir; ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>

</body>
</html>