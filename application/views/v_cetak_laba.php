<!DOCTYPE html>
<html>
<head>
	<base href="<?php echo base_url() ?>">
	<title>Cetak Laba</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
</head>
<body style="padding: 20px" onload="print()">
	<center>
		<h3>Laporan Laba Penjualan</h3>
	</center>
	<br><br>

	Dari tanggal <b><?php echo $tgl1 ?></b> sd <b><?php echo $tgl2 ?></b>
	<hr>
	<table class="table table-bordered" >
		<thead>
			<tr>
				<th>No.</th>
				<th>Kode Penjualan</th>
				<th>Tgl Penjualan</th>
				<th>Total Penjualan</th>
				<th>Laba</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$total = 0;
			$no = 1;
			foreach ($cetak->result() as $row) {
			 ?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $row->kode_penjualan ?></td>
				<td><?php echo $row->tgl_penjualan ?></td>
				<td><?php echo $row->total_harga ?></td>
				<td><?php 
				$laba=0;
				$sql = $this->db->query("SELECT * FROM barang as a, penjualan_detail as b where a.kode_barang=b.kode_barang and b.kode_penjualan='$row->kode_penjualan'");
				foreach ($sql->result() as $rs) {
					$laba = $laba+($rs->laba*$rs->qty);
				}
				echo 'Rp. '.number_format($laba);
				?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>

</body>
</html>