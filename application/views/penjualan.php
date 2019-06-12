<div class="row">
	<div class="col-md-4">
		<a href="app/tambah_penjualan" class="btn btn-primary">Tambah Penjualan</a>
		<a href="app/export_penjualan" target="_blank" class="btn btn-primary">Export</a>
	</div>
	<div class="col-md-4"></div>
	<div class="col-md-4"></div><br><br><br>
	<div class="col-md-12">
		<table class="table table-bordered" style="margin-bottom: 10px" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Kode Penjualan</th>
					<th>Nama Pengguna</th>
					<th>Tanggal Penjualan</th>
					<th>Total Bayar</th>
					<th>Nama Kasir</th>
					<th>Pilihan</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$sql = $this->db->query("SELECT * FROM penjualan_header,santri where penjualan_header.no_santri=santri.no_santri order by penjualan_header.id_penjualan DESC");
				$no = 1;
				foreach ($sql->result() as $row) {
				 ?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $row->kode_penjualan; ?></td>
					<td><?php echo $row->nama; ?></td>
					
					<td><?php echo $row->tgl_penjualan; ?></td>
					<td><?php echo $row->total_harga; ?></td>
					<td><?php echo $row->kasir; ?></td>
					<td>
						<a href="app/detail_penjualan/<?php echo $row->kode_penjualan ?>" class="btn btn-info btn-sm">detail</a>
						<a href="app/hapus_penjualan/<?php echo $row->kode_penjualan ?>" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm('Are You Sure ?')">hapus</a>
						<a href="app/cetak_penjualan/<?php echo $row->kode_penjualan ?>" target="_blank" class="btn btn-success btn-sm">cetak</a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>