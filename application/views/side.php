<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="image/user/<?php echo $this->session->userdata('foto') ?>" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name"><?php echo $this->session->userdata('nama') ?></div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<ul class="nav menu">

		<?php 
		if ($this->session->userdata('level') == 'admin') {

		 ?>
		 	 
			<li><a href=""><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li><a href="pengguna"><em class="fa fa-user">&nbsp;</em> Data Pengguna</a></li>
			<li><a href="barang"><em class="fa fa-cube">&nbsp;</em> Data Barang</a></li>
			
			<li class="parent "><a data-toggle="collapse" href="#sub-item-2">
				<em class="fa fa-exchange">&nbsp;</em> Data Suplier <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-2">
					<li><a class="" href="suplayer">
						<span class="fa fa-arrow-right">&nbsp;</span> Data Suplier
					</a></li>
					<li><a class="" href="setoran_suplayer">
						<span class="fa fa-arrow-right">&nbsp;</span> Data Setoran
					</a></li>
					<li><a class="" href="pengambilan_suplayer">
						<span class="fa fa-arrow-right">&nbsp;</span> Data Pengambilan
					</a></li>
				</ul>
			</li>
			<li><a href="tabungan"><em class="fa fa-suitcase">&nbsp;</em> Tabungan</a></li>
			<li><a href="app/penjualan"><em class="fa fa-cart-plus">&nbsp;</em> Penjualan</a></li>
			<li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-building-o">&nbsp;</em> Lap Penjualan <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					
					<li><a class="" href="app/cetak_stok" target="_blank">
						<span class="fa fa-arrow-right">&nbsp;</span> Stok Barang
					</a></li>
					<li><a class="" href="app/cetak_transaksi" target="_blank">
						<span class="fa fa-arrow-right">&nbsp;</span> Transaksi
					</a></li>
				</ul>
			</li>

			<li><a href="user"><em class="fa fa-users">&nbsp;</em> Manajemen User</a></li>
			
		<?php } elseif ($this->session->userdata('level') == 'kasir') { ?>
			<li><a href=""><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li><a href="barang"><em class="fa fa-cube">&nbsp;</em> Data Barang</a></li>
			<li class="parent "><a data-toggle="collapse" href="#sub-item-2">
				<em class="fa fa-exchange">&nbsp;</em> Data Suplier <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-2">
					<li><a class="" href="suplayer">
						<span class="fa fa-arrow-right">&nbsp;</span> Data Suplier
					</a></li>
					<li><a class="" href="setoran_suplayer">
						<span class="fa fa-arrow-right">&nbsp;</span> Data Setoran
					</a></li>
					<li><a class="" href="pengambilan_suplayer">
						<span class="fa fa-arrow-right">&nbsp;</span> Data Pengambilan
					</a></li>
				</ul>
			</li>
			<li><a href="app/penjualan"><em class="fa fa-cart-plus">&nbsp;</em> Penjualan</a></li>

		<?php } elseif ($this->session->userdata('level') == 'tabungan') { ?>
			<li><a href=""><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li><a href="pengguna"><em class="fa fa-user">&nbsp;</em> Data Pengguna</a></li>
			<li class="parent "><a data-toggle="collapse" href="#sub-item-2">
				<em class="fa fa-exchange">&nbsp;</em> Data Suplier <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-2">
					<li><a class="" href="suplayer">
						<span class="fa fa-arrow-right">&nbsp;</span> Data Suplier
					</a></li>
					<li><a class="" href="setoran_suplayer">
						<span class="fa fa-arrow-right">&nbsp;</span> Data Setoran
					</a></li>
					<li><a class="" href="pengambilan_suplayer">
						<span class="fa fa-arrow-right">&nbsp;</span> Data Pengambilan
					</a></li>
				</ul>
			</li>
			<li><a href="tabungan"><em class="fa fa-suitcase">&nbsp;</em> Tabungan</a></li>
		<?php } elseif ($this->session->userdata('level') == 'pendidikan') { ?>

		<li><a href=""><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li><a href="pengguna"><em class="fa fa-user">&nbsp;</em> Data Pengguna</a></li>
			<li><a href="barang"><em class="fa fa-cube">&nbsp;</em> Data Barang</a></li>
			
			<li class="parent "><a data-toggle="collapse" href="#sub-item-2">
				<em class="fa fa-exchange">&nbsp;</em> Data Suplier <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-2">
					<li><a class="" href="suplayer">
						<span class="fa fa-arrow-right">&nbsp;</span> Data Suplier
					</a></li>
					<li><a class="" href="setoran_suplayer">
						<span class="fa fa-arrow-right">&nbsp;</span> Data Setoran
					</a></li>
					<li><a class="" href="pengambilan_suplayer">
						<span class="fa fa-arrow-right">&nbsp;</span> Data Pengambilan
					</a></li>
				</ul>
			</li>
			<li><a href="tabungan"><em class="fa fa-suitcase">&nbsp;</em> Tabungan</a></li>
			<li><a href="app/penjualan"><em class="fa fa-cart-plus">&nbsp;</em> Penjualan</a></li>
			<li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-building-o">&nbsp;</em> Lap Penjualan <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					
					<li><a class="" href="app/cetak_stok" target="_blank">
						<span class="fa fa-arrow-right">&nbsp;</span> Stok Barang
					</a></li>
					<li><a class="" href="app/cetak_terjual" target="_blank">
						<span class="fa fa-arrow-right">&nbsp;</span> Barang Terjual
					</a></li>
					<li><a class="" href="app/cetak_laba" target="_blank">
						<span class="fa fa-arrow-right">&nbsp;</span> Laba
					</a></li>
					<li><a class="" href="app/cetak_transaksi" target="_blank">
						<span class="fa fa-arrow-right">&nbsp;</span> Transaksi
					</a></li>
				</ul>
			</li>
			<?php } elseif ($this->session->userdata('level') == 'suplayer') { ?>
			<li><a href="app/brg_suplayer"><em class="fa fa-cube">&nbsp;</em> Data Barang</a></li>

		<?php } ?>

			<li><a href="app/logout"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div>