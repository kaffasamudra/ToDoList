<?php

class Kontak extends CI_Controller
{
  public function contact()
  {
    if ($this->input->method() === 'post') {
      $this->load->model('feedback_model');

      // @TODO: lakukan validasi di sini sebelum insert ke model

      $feedback = [
        'name' => $this->input->post('name'),
        'email' => $this->input->post('email'),
        'message' => $this->input->post('message')
      ];

      $feedback_saved = $this->feedback_model->insert($feedback);

      if ($feedback_saved) {
        return $this->load->view('user/thanks');
      }
    }

    $this->load->view('user/kontak');
  }
}
