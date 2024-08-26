<?php

class Todolist extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_todolist');
  }

  public function index()
  {
    // ambil todolist yang statusnya bukan draft
    $data['todolist'] = $this->m_todolist->get_published()->result();

    if (count($data['todolist']) > 0) {
      // kirim data todolist ke view
      $this->load->view('admin/list_todolist', $data);
    } else {
      // kalau gak ada todolist, tampilkan view ini
      $this->load->view('admin/empty_todolist');
    }
  }

  public function show($slug = null)
  {
    // jika gak ada slug di URL tampilkan 404
    if (!$slug) {
      show_404();
    }

    // ambil artikel dengan slug yang diberikan
    $data['todolist'] = $this->m_todolist->find_by_slug($slug);
    
    // jika artikel tidak ditemuakn di database tampilkan 404
    if (!$data['todolist']) {
      show_404();
    }

    // // tampilkan artikel
    $this->load->view('admin/preview', $data);
  }
}

