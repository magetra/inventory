<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Setoran_suplayer extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Setoran_suplayer_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'setoran_suplayer/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'setoran_suplayer/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'setoran_suplayer/index.html';
            $config['first_url'] = base_url() . 'setoran_suplayer/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Setoran_suplayer_model->total_rows($q);
        $setoran_suplayer = $this->Setoran_suplayer_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'setoran_suplayer_data' => $setoran_suplayer,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'setoran_suplayer/setoran_suplayer_list',
            'jdl' => 'Data Setoran Suplayer',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Setoran_suplayer_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_setoran' => $row->id_setoran,
		'kode_barang' => $row->kode_barang,
		'tgl_setoran' => $row->tgl_setoran,
		'jumlah' => $row->jumlah,
		'petugas' => $row->petugas,
	    );
            $this->load->view('setoran_suplayer/setoran_suplayer_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('setoran_suplayer'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('setoran_suplayer/create_action'),
	    'id_setoran' => set_value('id_setoran'),
	    'kode_barang' => set_value('kode_barang'),
	    'tgl_setoran' => set_value('tgl_setoran'),
	    'jumlah' => set_value('jumlah'),
	    'petugas' => set_value('petugas'),
        'konten' => 'setoran_suplayer/setoran_suplayer_form',
            'jdl' => 'Data Setoran Suplayer',
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
		'tgl_setoran' => $this->input->post('tgl_setoran',TRUE),
		'jumlah' => $this->input->post('jumlah',TRUE),
		'petugas' => $this->input->post('petugas',TRUE),
	    );

            $this->Setoran_suplayer_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('setoran_suplayer'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Setoran_suplayer_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('setoran_suplayer/update_action'),
		'id_setoran' => set_value('id_setoran', $row->id_setoran),
		'kode_barang' => set_value('kode_barang', $row->kode_barang),
		'tgl_setoran' => set_value('tgl_setoran', $row->tgl_setoran),
		'jumlah' => set_value('jumlah', $row->jumlah),
		'petugas' => set_value('petugas', $row->petugas),
        'konten' => 'setoran_suplayer/setoran_suplayer_form',
            'jdl' => 'Data Setoran Suplayer',
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('setoran_suplayer'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_setoran', TRUE));
        } else {
            $data = array(
		'kode_barang' => $this->input->post('kode_barang',TRUE),
		'tgl_setoran' => $this->input->post('tgl_setoran',TRUE),
		'jumlah' => $this->input->post('jumlah',TRUE),
		'petugas' => $this->input->post('petugas',TRUE),
	    );

            $this->Setoran_suplayer_model->update($this->input->post('id_setoran', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('setoran_suplayer'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Setoran_suplayer_model->get_by_id($id);

        if ($row) {
            $this->Setoran_suplayer_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('setoran_suplayer'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('setoran_suplayer'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_barang', 'kode barang', 'trim|required');
	$this->form_validation->set_rules('tgl_setoran', 'tgl setoran', 'trim|required');
	$this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');
	$this->form_validation->set_rules('petugas', 'petugas', 'trim|required');

	$this->form_validation->set_rules('id_setoran', 'id_setoran', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "setoran_suplayer.xls";
        $judul = "setoran_suplayer";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Barang");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Setoran");
	xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
	xlsWriteLabel($tablehead, $kolomhead++, "Petugas");

	foreach ($this->Setoran_suplayer_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_barang);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_setoran);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jumlah);
	    xlsWriteLabel($tablebody, $kolombody++, $data->petugas);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}
