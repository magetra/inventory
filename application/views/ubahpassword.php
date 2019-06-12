<form action="app/aksi_ubahpassword" method="post">
	<div class="col-md-6">
		<div class="form-group">
			<label>Nama Lengkap</label>
			<input class="form-control" placeholder="Username" name="nama" value="<?php echo $this->session->userdata('nama'); ?>" type="text" readonly>
		</div>
		<div class="form-group">
			<label>Username</label>
			<input class="form-control" placeholder="Username" name="username" value="<?php echo $this->session->userdata('username'); ?>" type="text" readonly>
		</div>
		<div class="form-group">
			<label>Password Lama</label>
			<input class="form-control" placeholder="Password Lama" name="pswlama"  type="password" autofocus>
			<input type="hidden" name="id_user" value="<?php echo $this->session->userdata('id_user'); ?>">
		</div>
		<div class="form-group">
			<label>Password Baru</label>
			<input class="form-control" placeholder="Password Baru" name="pswbaru"  type="password" >
		</div>
		<div class="form-group">
			<button class="btn btn-success" type="submit">Ubah</button>
		</div>
	</div>
</form>