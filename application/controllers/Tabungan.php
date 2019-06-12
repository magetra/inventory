<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tabungan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tabungan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'tabungan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'tabungan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'tabungan/index.html';
            $config['first_url'] = base_url() . 'tabungan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tabungan_model->total_rows($q);
        $tabungan = $this->Tabungan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tabungan_data' => $tabungan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'tabungan/tabungan_list',
            'jdl' => 'Tabungan Pengguna',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Tabungan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_tabungan' => $row->id_tabungan,
		'saldo' => $row->saldo,
		'pengeluaran' => $row->pengeluaran,
		'no_santri' => $row->no_santri,
	    );
            $this->load->view('tabungan/tabungan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tabungan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tabungan/create_action'),
	    'id_tabungan' => set_value('id_tabungan'),
	    'saldo' => set_value('saldo'),
	    'pengeluaran' => set_value('pengeluaran'),
	    'no_santri' => set_value('no_santri'),
        'konten' => 'tabungan/tabungan_form',
            'jdl' => 'Tabungan Santri',
	);
        $this->load->view('v_index', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            date_default_timezone_set('Asia/Jakarta');
            $jam = date('H:i:s');
            $no_santri = $this->input->post('no_santri',TRUE);

            $cek = $this->db->query("SELECT * FROM tabungan where no_santri='$no_santri'");
            if ($cek->num_rows() != 0) {
                    $saldo_tambahan = $this->input->post('saldo',TRUE);
                    $waktu = date('d-m-Y').' '.$jam;
                //$this->db->query("UPDATE tabungan SET saldo=saldo+'$saldo_tambahan',saldo_tambahan='$saldo_tambahan',waktu='$waktu' WHERE no_santri='$no_santri'");
                $data_detail = array(
                    'no_santri' => $no_santri,
                    'saldo_tambahan' => $saldo_tambahan,
                    'waktu' => $waktu,
                );
                $this->db->insert('detail_tabungan',$data_detail);
                $this->session->set_flashdata('message', 'Berhasil Menambahkan Saldo');
                redirect(site_url('tabungan'));
            } else {
                $data = array(
                    'saldo' => $this->input->post('saldo',TRUE),
                    'pengeluaran' => $this->input->post('pengeluaran',TRUE),
                    'no_santri' => $this->input->post('no_santri',TRUE),
                    'waktu' => date('d-m-Y').' '.$jam,
                    );
                 $this->Tabungan_model->insert($data);
                $this->session->set_flashdata('message', 'Berhasil Menambahkan Saldo');
                redirect(site_url('tabungan'));
            }
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tabungan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tabungan/update_action'),
		'id_tabungan' => set_value('id_tabungan', $row->id_tabungan),
		'saldo' => set_value('saldo', $row->saldo),
		'pengeluaran' => set_value('pengeluaran', $row->pengeluaran),
		'no_santri' => set_value('no_santri', $row->no_santri),
        'konten' => 'tabungan/tabungan_form',
            'jdl' => 'Tabungan Santri',
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tabungan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_tabungan', TRUE));
        } else {
            $data = array(
		'saldo' => $this->input->post('saldo',TRUE),
		'pengeluaran' => $this->input->post('pengeluaran',TRUE),
		'no_santri' => $this->input->post('no_santri',TRUE),
	    );

            $this->Tabungan_model->update($this->input->post('id_tabungan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tabungan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tabungan_model->get_by_id($id);

        if ($row) {
            $this->Tabungan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tabungan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tabungan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('saldo', 'saldo', 'trim|required');
	//$this->form_validation->set_rules('pengeluaran', 'pengeluaran', 'trim|required');
	$this->form_validation->set_rules('no_santri', 'no santri', 'trim|required');

	$this->form_validation->set_rules('id_tabungan', 'id_tabungan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

