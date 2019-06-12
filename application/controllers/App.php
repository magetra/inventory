<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {


	public function index()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        }
		$data = array(
			'konten' => 'v_home',
			'jdl' => 'Dashboard',
		);
		$this->load->view('v_index',$data);
	}

	public function brg_suplayer()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
		$data = array(
			'konten' => 'v_suplayer',
			'jdl' => 'Barang Suplayer',
		);
		$this->load->view('v_index',$data);
	}

	public function ubahpassword()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
		$data = array(
			'konten' => 'ubahpassword',
			'jdl' => 'Akun Anda',
		);
		$this->load->view('v_index',$data);
	}

	public function aksi_ubahpassword()
	{
		$username = $this->input->post('username');
		$pswlama = $this->input->post('pswlama');
		$pswbaru = $this->input->post('pswbaru');
		$id_user = $this->input->post('id_user');

		$cekpsw = $this->db->query("SELECT * FROM user where password='$pswlama'");
		if ($cekpsw->num_rows() == 1) {
			$this->db->where('id_user', $id_user);
			$this->db->update('user', array('password'=>$pswbaru));
			$this->logout();
		} else {
			?>
			<script type="text/javascript">
				alert('password kamu salah');
				window.location="<?php echo base_url() ?>app/ubahpassword";
			</script>
			<?php
		}		
	}

	public function cek_barang()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $kode_barang = $this->input->post('kode_barang');
        $cek = $this->db->query("SELECT * FROM barang WHERE kode_barang='$kode_barang'")->row();
		$data = array(
			'stok' => $cek->stok,
			'harga' => $cek->harga,
			'kode_barang' => $cek->kode_barang,
			'nama_barang' => $cek->nama_barang,
			'nama_suplayer' => $cek->nama_suplayer,
		);
		echo json_encode($data);
	}

	public function cek_barang_suplayer()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $kode_barang = $this->input->post('kode_barang');
        $tb = $this->db->query("SELECT * FROM barang WHERE kode_barang='$kode_barang'")->row();
        $sp = $this->db->query("SELECT jumlah FROM setoran_suplayer WHERE kode_barang='$kode_barang'")->row();

		$data = array(
			'stok' => $tb->stok,
			'harga' => $tb->harga,
			'kode_barang' => $tb->kode_barang,
			'nama_barang' => $tb->nama_barang,
			'nama_suplayer' => $tb->nama_suplayer,
			'harga_suplayer' => $tb->harga_suplayer,
			'terjual' => $sp->jumlah - $tb->stok,
			'nominal' => ($sp->jumlah - $tb->stok)*$tb->harga_suplayer,
		);
		echo json_encode($data);
	}

	public function export_pengguna()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $this->load->view('export_santri');
	}

	public function export_barang()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $this->load->view('export_barang');
	}

	public function hapus_semua_pengguna()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $this->db->delete('santri');
        redirect('pengguna','refresh');
	}

	public function export_tabungan()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $this->load->view('export_tabungan');
	}

	public function export_penjualan()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $this->load->view('export_penjualan');
	}

	public function export_suplayer()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $this->load->view('export_suplayer');
	}

	public function cek_metode()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $id = $this->input->post('id');
        if ($id =='CASH') {
        	# code...
        } else {
        	?>
        	
        	<?php
        }
	}

	public function simpan_cart()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $data = array(
            'id'    => $this->input->post('kode_barang'),
            'qty'   => $this->input->post('jumlah'),
            'price' => $this->input->post('harga'),
            'name'  => $this->input->post('nabar'),
        );
        $this->cart->insert($data);
        redirect('app/tambah_penjualan');
	}

	public function hapus_cart($id)
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $data = array(
            'rowid'    => $id,
            'qty'   => 0,
        );
        $this->cart->update($data);
        redirect('app/tambah_penjualan');
	}
	

	public function penjualan()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
		$data = array(
			'konten' => 'penjualan',
			'jdl' => 'Data Penjualan',
		);
		$this->load->view('v_index',$data);
	}

	public function cetak_stok()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
		$this->load->view('cetak_stok');
	}

	public function cetak_terjual()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
		$data = array(
			'konten' => 'cetak_terjual',
			'jdl' => 'Barang Terjual',
		);
		$this->load->view('v_index',$data);
	}

	public function aksi_cetakterjual()
	{
		$tgl1 = $this->input->post('tgl1');
		$tgl2 = $this->input->post('tgl2');
		$cetak = $this->db->query("SELECT * from barang, penjualan_detail, penjualan_header where barang.kode_barang=penjualan_detail.kode_barang and penjualan_header.tgl_penjualan BETWEEN '$tgl1' and '$tgl2' ");
		$data = array(
			'tgl1' => $tgl1,
			'tgl2' => $tgl2,
			'cetak' => $cetak,
		);
		$this->load->view('v_cetak_terjual', $data);
	}

	public function cetak_laba()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
		$data = array(
			'konten' => 'laba',
			'jdl' => 'Laba Penjualan',
		);
		$this->load->view('v_index',$data);
	}

	public function aksi_cetaklaba()
	{
		$tgl1 = $this->input->post('tgl1');
		$tgl2 = $this->input->post('tgl2');
		$cetak = $this->db->query("SELECT * FROM penjualan_header where tgl_penjualan BETWEEN '$tgl1' and '$tgl2' ");
		$data = array(
			'tgl1' => $tgl1,
			'tgl2' => $tgl2,
			'cetak' => $cetak,
		);
		$this->load->view('v_cetak_laba', $data);
	}

	public function cetak_transaksi()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
		$data = array(
			'konten' => 'transaksi',
			'jdl' => 'Transaksi Penjualan',
		);
		$this->load->view('v_index',$data);
	}

	public function aksi_cetaktransaksi()
	{
		$tgl1 = $this->input->post('tgl1');
		$tgl2 = $this->input->post('tgl2');
		$cetak = $this->db->query("SELECT * FROM penjualan_header where tgl_penjualan BETWEEN '$tgl1' and '$tgl2' ");
		$data = array(
			'tgl1' => $tgl1,
			'tgl2' => $tgl2,
			'cetak' => $cetak,
		);
		$this->load->view('v_cetak_transaksi', $data);
	}

	public function detail_penjualan($kode_penjualan)
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
		$data = array(
			'konten' => 'detail_penjualan',
			'jdl' => 'Detail Penjualan',
			'data' => $this->db->query("SELECT * FROM penjualan_header as a, santri as b WHERE a.no_santri=b.no_santri and a.kode_penjualan='$kode_penjualan'"),
		);
		$this->load->view('v_index',$data);
	}

	public function hapus_penjualan($kode_penjualan)
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $this->db->where('kode_penjualan', $kode_penjualan);
		$this->db->delete('penjualan_header');
		$this->db->where('kode_penjualan', $kode_penjualan);
		$this->db->delete('penjualan_detail');
		?>
		<script type="text/javascript">
			alert('Berhapus Hapus Data');
			window.location='<?php echo base_url('app/penjualan') ?>';
		</script>
		<?php
	}

	public function cetak_penjualan($kode_penjualan)
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $data = array(
			'data' => $this->db->query("SELECT * FROM penjualan_header as a, santri as b WHERE a.no_santri=b.no_santri and a.kode_penjualan='$kode_penjualan'"),
		);
		$this->load->view('cetak_penjualan',$data);
	}

	public function cetak_saldo($no_santri)
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $data = array(
			'data' => $this->db->query("SELECT * FROM tabungan as a, santri as b WHERE a.no_santri=b.no_santri and a.no_santri='$no_santri'"),
		);
		$this->load->view('cetak_saldo',$data);
	}

	public function tambah_penjualan()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $this->load->model('No_urut');
		$data = array(
			'konten' => 'form_penjualan',
			'jdl' => 'Tambah Penjualan',
			'kodeurut' => $this->No_urut->buat_kode_penjualan(),
		);
		$this->load->view('v_index',$data);
	}

	public function simpan_penjualan()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $kode_penjualan = $this->input->post('kode_penjualan');
        $no_santri = $this->input->post('no_santri');
        $total_harga = $this->input->post('total_harga');
        $tgl_penjualan = $this->input->post('tgl_penjualan');
        $kasir = $this->input->post('kasir');

        foreach ($this->cart->contents() as $items) {
        	$kode_barang = $items['id'];
        	$qty = $items['qty'];
        	$d = array(
        		'kode_penjualan' => $kode_penjualan,
        		'kode_barang' => $kode_barang,
        		'qty' => $qty,
        	);
        	$this->db->insert('penjualan_detail', $d);
        	$this->db->query("UPDATE barang SET stok=stok-'$qty' WHERE kode_barang='$kode_barang'");
        }

        $data = array(
            'kode_penjualan'=> $kode_penjualan,
            'no_santri'=> $no_santri,
            'total_harga'=> $total_harga,
            'tgl_penjualan'=> $tgl_penjualan,
            'kasir'=> $kasir,
        );
        $this->db->insert('penjualan_header', $data);
        $this->db->query("UPDATE tabungan SET saldo=saldo-'$total_harga', pengeluaran=pengeluaran+'$total_harga' WHERE no_santri='$no_santri'");
        $this->cart->destroy();
        redirect('app/penjualan');
	}


	public function login()
	{
		if ($this->input->post() == NULL) {
			$this->load->view('login');
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$unit = $this->input->post('unit');
			
			$cek_user = $this->db->query("SELECT * FROM user WHERE username='$username' and password='$password' and unit='$unit' ");
				if ($cek_user->num_rows() == 1) {
					foreach ($cek_user->result() as $row) {
						$sess_data['id_user'] = $row->id_user;
						$sess_data['foto'] = $row->foto;
						$sess_data['nama'] = $row->nama_lengkap;
						$sess_data['username'] = $row->username;
						$sess_data['unit'] = $row->unit;
						$sess_data['level'] = $row->level;
						$this->session->set_userdata($sess_data);
					}
					redirect('app');
					
				} else {
					?>
					<script type="text/javascript">
						alert('Username dan password kamu salah !');
						window.location="<?php echo base_url('app/login'); ?>";
					</script>
					<?php
				}

		}
	}

	
	function logout()
	{
		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('nama');
		$this->session->unset_userdata('foto');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('unit');
		$this->session->unset_userdata('level');
		session_destroy();
		redirect('app');
	}

}