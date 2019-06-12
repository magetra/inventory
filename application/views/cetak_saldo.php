<!DOCTYPE html>
<html>
<head>
	<base href="<?php echo base_url() ?>">
	<title>Cetak Saldo Santri</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
</head>
<body onload="print()">
	<center>
		<h2>Saldo Santri</h2>
	</center>
	<?php 
	$rs = $data->row();
	 ?>
	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<tr>
					<th>NO SANTRI</th>
					<th>:</th>
					<td><?php echo $rs->no_santri; ?></td>

					<th>SALDO SEBELUMNYA</th>
					<th>:</th>
					<td><?php
					$sblm = $rs->saldo - $rs->saldo_tambahan;
					echo 'Rp. '. number_format($sblm);
					 ?></td>
				</tr>
				<tr>
					<th>NAMA SANTRI</th>
					<th>:</th>
					<td><?php echo $rs->nama; ?></td>

					<th>SALDO TAMBAHAN</th>
					<th>:</th>
					<td><?php
					echo 'Rp. '. number_format($rs->saldo_tambahan);
					 ?></td>
				</tr>
				<tr>
					<th>SALDO SEKARANG</th>
					<th>:</th>
					<td><h3><?php
					echo 'Rp. '. number_format($rs->saldo);
					 ?></h3></td>

					<th>LAST UPDATE</th>
					<th>:</th>
					<td><?php
					echo $rs->waktu;
					 ?></td>
				</tr>
			</table>
		</div>
	</div>

	<div class="row">
		<center><h2>Histori Tabungan & Belanja</h2></center>
		<div class="col-md-6">
			<table class="table">
				<tr>
					<th>Saldo Tambahan</th>
					<th>Waktu</th>
				</tr>
				<?php 
				$sql = $this->db->query("SELECT * FROM detail_tabungan where no_santri='$rs->no_santri'");
				foreach ($sql->result() as $rd) {
				 ?>
				<tr>
					<td><?php echo $rd->saldo_tambahan ?></td>
					<td><?php echo $rd->waktu ?></td>
				</tr>
				<?php } ?>
			</table>
		</div>

		<div class="col-md-6">
			<table class="table">
				<tr>
					<th>Kode Penjualan</th>
					<th>Total Harga</th>
					<th>Waktu</th>
				</tr>
				<?php 
				$sql = $this->db->query("SELECT * FROM penjualan_header where no_santri='$rs->no_santri'");
				foreach ($sql->result() as $rd) {
				 ?>
				<tr>
					<td><?php echo $rd->kode_penjualan ?></td>
					<td><?php echo $rd->total_harga ?></td>
					<td><?php echo $rd->tgl_penjualan ?></td>
				</tr>
				<?php } ?>
			</table>
		</div>
	</div>


</body>
</html>