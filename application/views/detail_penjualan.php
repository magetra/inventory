<?php 
$rs = $data->row();
 ?>
<div class="row">
	<div class="col-md-12">
		<table class="table">
			<tr>
				<th>Kode Penjualan</th>
				<th>:</th>
				<td><?php echo $rs->kode_penjualan; ?></td>
				<th>No Pengguna</th>
				<th>:</th>
				<td><?php echo $rs->no_santri; ?></td>
			</tr>
			<tr>
				<th>Tgl Penjualan</th>
				<th>:</th>
				<td><?php echo $rs->tgl_penjualan; ?></td>
				<th>Nama Pengguna</th>
				<th>:</th>
				<td><?php echo $rs->nama; ?></td>
			</tr>
			<tr>
				<th>Total Harga</th>
				<th>:</th>
				<td>Rp. <?php echo number_format($rs->total_harga); ?></td>
			</tr>
		</table>
	</div>
	<div class="col-md-12">
		<table class="table table-bordered" style="margin-bottom: 10px" >
			<thead>
				<tr>
					<th>No.</th>
					<th>Kode Barang</th>
					<th>Nama Barang</th>
					<th>Harga</th>
					<th>Jumlah</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$sql = $this->db->query("SELECT * FROM penjualan_detail as a,barang as b where a.kode_barang=b.kode_barang and a.kode_penjualan='$rs->kode_penjualan' ");
				$no = 1;
				foreach ($sql->result() as $row) {
				 ?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $row->kode_barang; ?></td>
					<td><?php echo $row->nama_barang; ?></td>
					
					<td><?php echo $row->harga; ?></td>
					<td><?php echo $row->qty; ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>