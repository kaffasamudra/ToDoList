<?php

class Direksi extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_todolist');
  }

  public function index()
  {
    // ambil todolist yang statusnya bukan draft
    // $data['todolist'] = $this->m_todolist->get_published()->result();

    if (count($data['todolist']) > 0) {
      // kirim data todolist ke view
      $this->load->view('user/direksi/v_direksi', $data);
    }
  }

  public function table_data(){
    $this->load->model('M_todolist');

    $bagian = $this->input->post('bagian');

    $listing = $this->M_todolist->get_datatables($bagian);
    $jumlah_semua = $this->M_todolist->jumlah_semua();
    $jumlah_filter = $this->M_todolist->jumlah_filter($bagian);

    $data = array();
    $no = $this->input->post('start');
    foreach ($listing as $key) {
        $no++;
        $row = array();
        $row[] = $key->Id;
        $row[] = $key->Judul;
        $row[] = $key->Tanggal;
        $row[] = $key->Bagian;
        $data[] = $row;
    }

    $output = array(
        "draw" => $this->input->post('draw'),
        "recordsTotal" => $jumlah_semua->jml,
        "recordsFiltered" => $jumlah_filter->jml,
        "data" => $data
    );
    echo json_encode($output);
  }


  public function show($slug = null)
  {
    // jika gak ada slug di URL tampilkan 404
    if (!$slug) {
      show_404();
    }

    // ambil artikel dengan slug yang diberikan
    $data['direksi'] = $this->m_todolist->find_by_slug($slug);
    
    // jika artikel tidak ditemuakn di database tampilkan 404
    if (!$data['direksi']) {
      show_404();
    }

    // // tampilkan artikel
    $this->load->view('user/direksi/s_direksi', $data);
  }
}

