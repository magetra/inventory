<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Barang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_model');
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
                    'id_barang' => '',
                    'kode_barang' => $rowData[0][0],
                    'nama_barang' => $rowData[0][1],
                    'stok' => $rowData[0][2],
                    'harga' => $rowData[0][3],
                    'harga_suplayer' => $rowData[0][4],
                    'laba' => $rowData[0][5],
                    'nama_suplayer' => $rowData[0][6],
                );
    $this->db->insert("barang",$data);
   } 
   ?>
   <script type="text/javascript">
     alert('berhasil upload data !');
     window.location='<?php echo base_url() ?>barang/';
   </script>
   <?php
  }  
 }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'barang/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'barang/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'barang/index.html';
            $config['first_url'] = base_url() . 'barang/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Barang_model->total_rows($q);
        $barang = $this->Barang_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'barang_data' => $barang,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'barang/barang_list',
            'jdl' => 'Data Barang',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Barang_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_barang' => $row->id_barang,
		'kode_barang' => $row->kode_barang,
		'nama_barang' => $row->nama_barang,
		'stok' => $row->stok,
		'harga' => $row->harga,
	    );
            $this->load->view('barang/barang_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('barang/create_action'),
	    'id_barang' => set_value('id_barang'),
	    'kode_barang' => $this->No_urut->buat_kode_barang(),
	    'nama_barang' => set_value('nama_barang'),
	    'stok' => set_value('stok'),
        'harga' => set_value('harga'),
        'harga_suplayer' => set_value('harga_suplayer'),
	    'nama_suplayer' => set_value('nama_suplayer'),
        'konten' => 'barang/barang_form',
            'jdl' => 'Data Barang',
	);
        $this->load->view('v_index', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $h1 = $this->input->post('harga',TRUE);
            $h2 = $this->input->post('harga_suplayer',TRUE);
            $laba = $h1 - $h2;
            $data = array(
		'kode_barang' => $this->input->post('kode_barang',TRUE),
		'nama_barang' => $this->input->post('nama_barang',TRUE),
		'stok' => $this->input->post('stok',TRUE),
        'harga' => $this->input->post('harga',TRUE),
        'harga_suplayer' => $this->input->post('harga_suplayer',TRUE),
        'nama_suplayer' => $this->input->post('nama_suplayer',TRUE),
		'laba' => $laba,
	    );

            $this->Barang_model->insert($data);
            $cek = $this->db->get_where('user',array('username'=> $this->input->post('nama_suplayer')));
            if ($cek->num_rows() == 0) {
                $this->db->insert('user', array(
                    'username' => strtolower($this->input->post('nama_suplayer')),
                    'password' => strtolower($this->input->post('nama_suplayer')),
                    'nama_lengkap' => $this->input->post('nama_suplayer'),
                    'foto' => 'user_1521020506.png',
                    'level'=> 'suplayer',
                ));
            } else {

            }
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('barang'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Barang_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('barang/update_action'),
		'id_barang' => set_value('id_barang', $row->id_barang),
		'kode_barang' => set_value('kode_barang', $row->kode_barang),
		'nama_barang' => set_value('nama_barang', $row->nama_barang),
		'stok' => set_value('stok', $row->stok),
        'harga' => set_value('harga', $row->harga),
        'harga_suplayer' => set_value('harga_suplayer', $row->harga_suplayer),
		'nama_suplayer' => set_value('nama_suplayer', $row->nama_suplayer),
        'konten' => 'barang/barang_form',
            'jdl' => 'Data Barang',
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_barang', TRUE));
        } else {
            $h1 = $this->input->post('harga',TRUE);
            $h2 = $this->input->post('harga_suplayer',TRUE);
            $laba = $h1 - $h2;
            $data = array(
		'kode_barang' => $this->input->post('kode_barang',TRUE),
		'nama_barang' => $this->input->post('nama_barang',TRUE),
		'stok' => $this->input->post('stok',TRUE),
        'harga' => $this->input->post('harga',TRUE),
        'harga_suplayer' => $this->input->post('harga_suplayer',TRUE),
        'nama_suplayer' => $this->input->post('nama_suplayer',TRUE),
		'laba' => $laba,
	    );

            $this->Barang_model->update($this->input->post('id_barang', TRUE), $data);
            $cek = $this->db->get_where('user',array('username'=> $this->input->post('nama_suplayer')));
            if ($cek->num_rows() == 0) {
                $this->db->insert('user', array(
                    'username' => strtolower($this->input->post('nama_suplayer')),
                    'password' => strtolower($this->input->post('nama_suplayer')),
                    'nama_lengkap' => $this->input->post('nama_suplayer'),
                    'foto' => 'user_1521020506.png',
                    'level'=> 'suplayer',
                ));
            } else {

            }
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('barang'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Barang_model->get_by_id($id);

        if ($row) {
            $this->Barang_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('barang'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_barang', 'kode barang', 'trim|required');
	$this->form_validation->set_rules('nama_barang', 'nama barang', 'trim|required');
	$this->form_validation->set_rules('stok', 'stok', 'trim|required');
	$this->form_validation->set_rules('harga', 'harga', 'trim|required');

	$this->form_validation->set_rules('id_barang', 'id_barang', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

