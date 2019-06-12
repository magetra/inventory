<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Suplayer extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Suplayer_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'suplayer/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'suplayer/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'suplayer/index.html';
            $config['first_url'] = base_url() . 'suplayer/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Suplayer_model->total_rows($q);
        $suplayer = $this->Suplayer_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'suplayer_data' => $suplayer,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'suplayer/suplayer_list',
            'jdl' => 'Data Suplayer',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Suplayer_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_suplayer' => $row->id_suplayer,
		'kode_barang' => $row->kode_barang,
		'nama_suplayer' => $row->nama_suplayer,
		'jumlah_storan' => $row->jumlah_storan,
		'tgl_penyetoran' => $row->tgl_penyetoran,
		'jumlah_terjual' => $row->jumlah_terjual,
		'sisa_barang' => $row->sisa_barang,
		'nominal_uang' => $row->nominal_uang,
		'tgl_pengambilan' => $row->tgl_pengambilan,
		'petugas' => $row->petugas,
	    );
            $this->load->view('suplayer/suplayer_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('suplayer'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('suplayer/create_action'),
	    'id_suplayer' => set_value('id_suplayer'),
	    'kode_barang' => set_value('kode_barang'),
	    'nama_suplayer' => set_value('nama_suplayer'),
	    'jumlah_storan' => set_value('jumlah_storan'),
	    'tgl_penyetoran' => set_value('tgl_penyetoran'),
	    'jumlah_terjual' => set_value('jumlah_terjual'),
	    'sisa_barang' => set_value('sisa_barang'),
	    'nominal_uang' => set_value('nominal_uang'),
	    'tgl_pengambilan' => set_value('tgl_pengambilan'),
	    'petugas' => set_value('petugas'),
        'konten' => 'suplayer/suplayer_form',
            'jdl' => 'Data Suplayer',
	);
        $this->load->view('v_index', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_barang' => $this->input->post('kode_barang',TRUE),
		'nama_suplayer' => $this->input->post('nama_suplayer',TRUE),
		'jumlah_storan' => $this->input->post('jumlah_storan',TRUE),
		'tgl_penyetoran' => $this->input->post('tgl_penyetoran',TRUE),
		'jumlah_terjual' => $this->input->post('jumlah_terjual',TRUE),
		'sisa_barang' => $this->input->post('sisa_barang',TRUE),
		'nominal_uang' => $this->input->post('nominal_uang',TRUE),
		'tgl_pengambilan' => $this->input->post('tgl_pengambilan',TRUE),
		'petugas' => $this->input->post('petugas',TRUE),
	    );

            $this->Suplayer_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('suplayer'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Suplayer_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('suplayer/update_action'),
		'id_suplayer' => set_value('id_suplayer', $row->id_suplayer),
		'kode_barang' => set_value('kode_barang', $row->kode_barang),
		'nama_suplayer' => set_value('nama_suplayer', $row->nama_suplayer),
		'jumlah_storan' => set_value('jumlah_storan', $row->jumlah_storan),
		'tgl_penyetoran' => set_value('tgl_penyetoran', $row->tgl_penyetoran),
		'jumlah_terjual' => set_value('jumlah_terjual', $row->jumlah_terjual),
		'sisa_barang' => set_value('sisa_barang', $row->sisa_barang),
		'nominal_uang' => set_value('nominal_uang', $row->nominal_uang),
		'tgl_pengambilan' => set_value('tgl_pengambilan', $row->tgl_pengambilan),
		'petugas' => set_value('petugas', $row->petugas),
        'konten' => 'suplayer/suplayer_form',
            'jdl' => 'Data Suplayer',
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('suplayer'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_suplayer', TRUE));
        } else {
            $data = array(
		'kode_barang' => $this->input->post('kode_barang',TRUE),
		'nama_suplayer' => $this->input->post('nama_suplayer',TRUE),
		'jumlah_storan' => $this->input->post('jumlah_storan',TRUE),
		'tgl_penyetoran' => $this->input->post('tgl_penyetoran',TRUE),
		'jumlah_terjual' => $this->input->post('jumlah_terjual',TRUE),
		'sisa_barang' => $this->input->post('sisa_barang',TRUE),
		'nominal_uang' => $this->input->post('nominal_uang',TRUE),
		'tgl_pengambilan' => $this->input->post('tgl_pengambilan',TRUE),
		'petugas' => $this->input->post('petugas',TRUE),
	    );

            $this->Suplayer_model->update($this->input->post('id_suplayer', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('suplayer'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Suplayer_model->get_by_id($id);

        if ($row) {
            $this->Suplayer_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('suplayer'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('suplayer'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_barang', 'kode barang', 'trim|required');
	$this->form_validation->set_rules('nama_suplayer', 'nama suplayer', 'trim|required');
	$this->form_validation->set_rules('jumlah_storan', 'jumlah storan', 'trim|required');
	$this->form_validation->set_rules('tgl_penyetoran', 'tgl penyetoran', 'trim|required');
	$this->form_validation->set_rules('jumlah_terjual', 'jumlah terjual', 'trim|required');
	$this->form_validation->set_rules('sisa_barang', 'sisa barang', 'trim|required');
	$this->form_validation->set_rules('nominal_uang', 'nominal uang', 'trim|required');
	$this->form_validation->set_rules('tgl_pengambilan', 'tgl pengambilan', 'trim|required');
	$this->form_validation->set_rules('petugas', 'petugas', 'trim|required');

	$this->form_validation->set_rules('id_suplayer', 'id_suplayer', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

