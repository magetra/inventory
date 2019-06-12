<div class="panel panel-info">
  <div class="panel-heading">Cetak Transaksi Barang</div>
  <div class="panel-body">
  	<form action="app/aksi_cetaktransaksi" method="post">
	<div class="form-group">
		<label>Dari</label>
		<input type="date" name="tgl1" class="form-control">
	</div>
	<div class="form-group">
		<label>Sampai</label>
		<input type="date" name="tgl2" class="form-control">
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-success">Cetak</button>
	</div>
</form>
  </div>
</div>