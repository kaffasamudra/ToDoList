<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $data['user'] = $this->User_model->get_user_by_id($this->session->userdata('user_id'));
        $this->load->view('settings', $data);
    }

    public function update_profile() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $user_id = $this->session->userdata('user_id');
            $name = $this->input->post('name');

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('profile_picture')) {
                $upload_data = $this->upload->data();
                $profile_picture = $upload_data['file_name'];
            } else {
                $profile_picture = NULL;
            }

            $this->User_model->update_user($user_id, $name, $profile_picture);
            $this->session->set_flashdata('success', 'Profile updated successfully.');
            redirect('settings');
        }
    }

    public function update_password() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $this->form_validation->set_rules('current_password', 'Current Password', 'required');
        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $user_id = $this->session->userdata('user_id');
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password');

            if ($this->User_model->check_current_password($user_id, $current_password)) {
                $this->User_model->update_password($user_id, $new_password);
                $this->session->set_flashdata('success', 'Password updated successfully.');
            } else {
                $this->session->set_flashdata('error', 'Current password is incorrect.');
            }
            redirect('settings');
        }
    }
}
