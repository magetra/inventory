<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'user/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'user/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'user/index.html';
            $config['first_url'] = base_url() . 'user/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->User_model->total_rows($q);
        $user = $this->User_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'user_data' => $user,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'user/user_list',
            'jdl' => 'Manajemen User',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->User_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_user' => $row->id_user,
		'nama_lengkap' => $row->nama_lengkap,
		'username' => $row->username,
		'password' => $row->password,
		'foto' => $row->foto,
		'level' => $row->level,
	    );
            $this->load->view('user/user_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('user/create_action'),
	    'id_user' => set_value('id_user'),
	    'nama_lengkap' => set_value('nama_lengkap'),
	    'username' => set_value('username'),
	    'password' => set_value('password'),
	    'foto' => set_value('foto'),
        'unit' => set_value('unit'),
	    'level' => set_value('level'),
        'konten' => 'user/user_form',
            'jdl' => 'Manajemen User',
	);
        $this->load->view('v_index', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

            $nmfile = "user_".time();
            $config['upload_path'] = './image/user';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = '20000';
            $config['file_name'] = $nmfile;
            // load library upload
            $this->load->library('upload', $config);
            // upload gambar 1
            $this->upload->do_upload('foto');
            $result1 = $this->upload->data();
            $result = array('gambar'=>$result1);
            $dfile = $result['gambar']['file_name'];

            $data = array(
		'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
		'username' => $this->input->post('username',TRUE),
		'password' => $this->input->post('password',TRUE),
		'foto' => $dfile,
        'unit' => $this->input->post('unit',TRUE),
		'level' => $this->input->post('level',TRUE),
	    );

            $this->User_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('user'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->User_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('user/update_action'),
		'id_user' => set_value('id_user', $row->id_user),
		'nama_lengkap' => set_value('nama_lengkap', $row->nama_lengkap),
		'username' => set_value('username', $row->username),
		'password' => set_value('password', $row->password),
		'foto' => set_value('foto', $row->foto),
        'unit' => set_value('unit', $row->unit),
		'level' => set_value('level', $row->level),
        'konten' => 'user/user_form',
            'jdl' => 'Manajemen User',
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_user', TRUE));
        } else {

            if ($_FILES['foto']['name'] == '' ) {

                $data = array(
    		'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
    		'username' => $this->input->post('username',TRUE),
    		'password' => $this->input->post('password',TRUE),
            'unit' => $this->input->post('unit',TRUE),
    		'level' => $this->input->post('level',TRUE),
    	    );

                $this->User_model->update($this->input->post('id_user', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('user'));
            } else {

                $nmfile = "user_".time();
                $config['upload_path'] = './image/user';
                $config['allowed_types'] = 'jpg|png';
                $config['max_size'] = '20000';
                $config['file_name'] = $nmfile;
                // load library upload
                $this->load->library('upload', $config);
                // upload gambar 1
                $this->upload->do_upload('foto');
                $result1 = $this->upload->data();
                $result = array('gambar'=>$result1);
                $dfile = $result['gambar']['file_name'];

                $data = array(
            'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
            'username' => $this->input->post('username',TRUE),
            'password' => $this->input->post('password',TRUE),
            'foto' => $dfile,
            'unit' => $this->input->post('unit',TRUE),
            'level' => $this->input->post('level',TRUE),
            );

                $this->User_model->update($this->input->post('id_user', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('user'));
            }
        }
    }
    
    public function delete($id) 
    {
        $row = $this->User_model->get_by_id($id);

        if ($row) {
            $this->User_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('user'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_lengkap', 'nama lengkap', 'trim|required');
	$this->form_validation->set_rules('username', 'username', 'trim|required');
	$this->form_validation->set_rules('password', 'password', 'trim|required');
	// $this->form_validation->set_rules('foto', 'foto', 'trim|required');
	$this->form_validation->set_rules('level', 'level', 'trim|required');

	$this->form_validation->set_rules('id_user', 'id_user', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

