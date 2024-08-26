<?php

class Post_todolist extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_todolist');
  }

  public function index()
  {
    $id_user = $this->session->userdata('id_user');
    $data['todolist'] = $this->M_todolist->get_todolist_by_user($id_user);
    // var_dump($id_user);
    $this->load->view('user/post_todolist', $data);
  }

  public function new()
  {
    if (empty($this->session->userdata("username"))) {
      redirect("loginuser");
    }
    if ($this->input->method() === 'post') {
      // TODO: Lakukan validasi sebelum menyimpan ke model

      // generate unique id and slug
      $id = uniqid('', true);
      $slug = url_title($this->input->post('title'), 'dash', TRUE) . '-' . $id;

      $todolist = [
        'id_user' => $this->session->userdata('id_user'),
        'title' => $this->input->post('title'),
        'slug' => $slug,
        'content' => $this->input->post('content'),
        'bagian' => $this->session->userdata('bagian')
      ];

      $saved = $this->M_todolist->insert($todolist);

      if ($saved) {
        $this->session->set_flashdata('message', 'todolist was created');
        return redirect('user/post_todolist');
      }
    }
    else
    {

    }
      $this->load->view('user/todolist_new_form');

  }

public function edit($id = null)
{
    $data['todolist'] = $this->M_todolist->find($id);

    if (!$data['todolist'] || !$id) {
        show_404();
    }

    // Dapatkan tanggal saat ini
    $current_date = date('Y-m-d');
    
    $tanggal=date("Y-m-d", strtotime($data['todolist']->created_at));
    // Periksa apakah tanggal todolist sesuai dengan tanggal saat ini
    if ($tanggal !== $current_date) {
        show_error('Data hanya bisa diedit pada tanggal yang sama.');
    }

    if ($this->input->method() === 'post') {
        // TODO: lakukan validasi data sebelum simpan ke model
        $todolist = [
            'id' => $id,
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content')
        ];
        $updated = $this->M_todolist->update($todolist);
        if ($updated) {
            $this->session->set_flashdata('message', 'todolist was updated');
            redirect('user/post_todolist');
        }
    }

    $this->load->view('user/todolist_edit_form', $data);
}

  public function delete($id = null)
  {
    if (!$id) {
      show_404();
    }

    $deleted = $this->M_todolist->delete($id);
    if ($deleted) {
      $this->session->set_flashdata('message', 'to do list was deleted');
      redirect('user/post_todolist');
    }
  }

  public function show($slug = null)
  {
    // jika gak ada slug di URL tampilkan 404
    if (!$slug) {
      show_404();
    }

    // ambil artikel dengan slug yang diberikan
    $data['post_todolist'] = $this->M_todolist->find_by_slug($slug);
    
    // jika artikel tidak ditemuakn di database tampilkan 404
    if (!$data['post_todolist']) {
      show_404();
    }

    // // tampilkan artikel
    $this->load->view('user/show_todolist', $data);
  }
}