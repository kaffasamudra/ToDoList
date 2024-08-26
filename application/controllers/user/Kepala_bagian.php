<?php

class Kepala_bagian extends CI_Controller 
{
    public function __construct()
    {
      parent::__construct();
      $this->load->model('m_todolist');
    }
    
    public function index() {
        if (!$this->session->userdata('username')) {
            redirect('auth/login');
        }

        $role = $this->session->userdata('bagian');
        $this->load->model('m_todolist');
        $data['content'] = $this->m_todolist->get_data_by_role($role);
        $this->load->view('user/kepala_bagian/v_kepala_bagian', $data);
    }
    public function show($slug = null)
      {
        // jika gak ada slug di URL tampilkan 404
        if (!$slug) {
          show_404();
        }

        // ambil artikel dengan slug yang diberikan
        $data['kepala_bagian'] = $this->m_todolist->find_by_slug($slug);
        
        //jika artikel tidak ditemuakn di database tampilkan 404
        if (!$data['kepala_bagian']) {
          show_404();
        }

        // // tampilkan artikel
        $this->load->view('user/kepala_bagian/s_kepala_bagian', $data);
      }
}
