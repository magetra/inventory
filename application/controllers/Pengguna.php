<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengguna extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Santri_model');
        $this->load->model('No_urut');
        $this->load->library('form_validation');
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
    }

    public function upload(){
  $fileName = $this->input->post('file', TRUE);

  $config['upload_path'] = './upload/'; 
  $config['file_name'] = $fileName;
  $config['allowed_types'] = 'xls|xlsx|csv|ods|ots';
  $config['max_size'] = 10000;

  $this->load->library('upload', $config);
  $this->upload->initialize($config); 
  
  if (!$this->upload->do_upload('file')) {
   $error = array('error' => $this->upload->display_errors());
   $this->session->set_flashdata('msg','Ada kesalah dalam upload'); 
   redirect('import'); 
  } else {
   $media = $this->upload->data();
   $inputFileName = 'upload/'.$media['file_name'];
   
   try {
    $inputFileType = IOFactory::identify($inputFileName);
    $objReader = IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);
   } catch(Exception $e) {
    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
   }

   $sheet = $objPHPExcel->getSheet(0);
   $highestRow = $sheet->getHighestRow();
   $highestColumn = $sheet->getHighestColumn();

   for ($row = 2; $row <= $highestRow; $row++){  
     $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
       NULL,
       TRUE,
       FALSE);
     $data = array(
                    'id_santri' => '',
                    'no_santri' => $rowData[0][0],
                    'nama' => $rowData[0][1],
                    'alamat' => $rowData[0][2],
                    'tempat_lahir' => $rowData[0][3],
                    'tanggal_lahir' => $rowData[0][4],
                    'no_telp' => $rowData[0][5],
                    'kelas' => $rowData[0][6],
                    'unit_pendidikan' => $rowData[0][7],
                );
    $this->db->insert("santri",$data);
   } 
   ?>
   <script type="text/javascript">
     alert('berhasil upload data !');
     window.location='<?php echo base_url() ?>santri/';
   </script>
   <?php
  }  
 }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'santri/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'santri/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'santri/index.html';
            $config['first_url'] = base_url() . 'santri/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Santri_model->total_rows($q);
        $santri = $this->Santri_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'santri_data' => $santri,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'santri/santri_list',
            'jdl' => 'Data Pengguna',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Santri_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_santri' => $row->id_santri,
		'no_santri' => $row->no_santri,
		'nama' => $row->nama,
		'alamat' => $row->alamat,
		'tempat_lahir' => $row->tempat_lahir,
		'tanggal_lahir' => $row->tanggal_lahir,
		'no_telp' => $row->no_telp,
        'konten' => 'santri/santri_read',
            'jdl' => 'Data Pengguna',
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengguna'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('santri/create_action'),
	    'id_santri' => set_value('id_santri'),
	    'no_santri' => $this->No_urut->buat_kode_santri(),
	    'nama' => set_value('nama'),
	    'alamat' => set_value('alamat'),
	    'tempat_lahir' => set_value('tempat_lahir'),
	    'tanggal_lahir' => set_value('tanggal_lahir'),
        'no_telp' => set_value('no_telp'),
        'kelas' => set_value('kelas'),
	    'unit_pendidikan' => set_value('unit_pendidikan'),
        'konten' => 'santri/santri_form',
            'jdl' => 'Data Pengguna',
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
		'no_santri' => $this->input->post('no_santri',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
		'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
        'no_telp' => $this->input->post('no_telp',TRUE),
        'kelas' => $this->input->post('kelas',TRUE),
		'unit_pendidikan' => $this->input->post('unit_pendidikan',TRUE),
	    );

            $this->Santri_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pengguna'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Santri_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('santri/update_action'),
		'id_santri' => set_value('id_santri', $row->id_santri),
		'no_santri' => set_value('no_santri', $row->no_santri),
		'nama' => set_value('nama', $row->nama),
		'alamat' => set_value('alamat', $row->alamat),
		'tempat_lahir' => set_value('tempat_lahir', $row->tempat_lahir),
		'tanggal_lahir' => set_value('tanggal_lahir', $row->tanggal_lahir),
        'no_telp' => set_value('no_telp', $row->no_telp),
        'kelas' => set_value('kelas', $row->kelas),
		'unit_pendidikan' => set_value('unit_pendidikan', $row->unit_pendidikan),
        'konten' => 'santri/santri_form',
            'jdl' => 'Data Pengguna',
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengguna'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_santri', TRUE));
        } else {
            $data = array(
		'no_santri' => $this->input->post('no_santri',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
		'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
        'no_telp' => $this->input->post('no_telp',TRUE),
        'kelas' => $this->input->post('kelas',TRUE),
		'unit_pendidikan' => $this->input->post('unit_pendidikan',TRUE),
	    );

            $this->Santri_model->update($this->input->post('id_santri', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pengguna'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Santri_model->get_by_id($id);

        if ($row) {
            $this->Santri_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pengguna'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengguna'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('no_santri', 'no santri', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('tempat_lahir', 'tempat lahir', 'trim|required');
	$this->form_validation->set_rules('tanggal_lahir', 'tanggal lahir', 'trim|required');
	$this->form_validation->set_rules('no_telp', 'no telp', 'trim|required');

	$this->form_validation->set_rules('id_santri', 'id_santri', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

