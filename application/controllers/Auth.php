<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_user');
    }

    public function index() {
        $this->load->view('user/login_user');
    }

    public function login() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('user/login_user');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            $this->load->model('m_user');
            $user = $this->m_user->get_user($username, $password);
            
            if ($user->username == $username && $user->password == $password) {
                $this->session->set_userdata('username', $user->username);
                $this->session->set_userdata('role', $user->role);
                $this->session->set_userdata('bagian', $user->bagian);
                $this->session->set_userdata('id_user', $user->id);
                // Redirect based on role
                if ($user->role == 'Karyawan') {
                    redirect('todolist');
                } else if ($user->role == 'Direksi') {
                    redirect('direksiview');
                } else if ($user->role == 'Kepala Bagian') {
                    redirect('bagianview');
                } 
                echo $user->role;
            } else {
                $this->session->set_flashdata('error', 'Invalid username or password');
                redirect('userlogin');
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/index');
    }

    public function forgotpassword() {
        $this->load->view('user/forgot_password');
    }

    public function forgot_password() {
        $this->load->model('m_user');
        $this->load->model('pwreset');
        $this->load->helper('url');
        
        $phone = $this->input->post('phone');
        $username = $this->m_user->get_user_by_phone($phone);

        if ($username) {
            $token = bin2hex(random_bytes(3));
            $this->pwreset->create_token($username->id, $token);
            
            $message = "Your password reset token is: $token";
            $this->send_whatsapp_message($phone, $message);

            $this->session->set_flashdata('success', 'Token reset password telah dikirimkan ke WhatsApp Anda.');
            $this->load->view('user/enter_token'); // Tampilkan form untuk memasukkan token
        } else {
            $this->session->set_flashdata('error', 'Nomor telepon tidak ditemukan.');
            $this->load->view('user/forgot_password');
        }
    }

    public function verify_token() {
        $this->load->model('pwreset');
        
        $token = $this->input->post('token');
        $reset = $this->pwreset->get_token($token);

        $this->pwreset->delete_expired_tokens();

        if ($reset) {
            // Tampilkan halaman untuk mengubah password
            $this->session->set_userdata('reset_user_id', $reset->id_user);
            $this->load->view('user/reset_password'); // Tampilkan form untuk mengubah password
        } else {
            $this->session->set_flashdata('error', 'Token tidak valid.');
            $this->load->view('user/enter_token'); // Tampilkan form untuk memasukkan token
        }
    }

    public function reset_password() {
        if (!$this->session->userdata('reset_user_id')) {
            redirect('auth/forgot_password');
        }

        $this->load->view('user/reset_password'); // Tampilkan form untuk mengubah password
    }

    public function update_password() {
        $this->load->model('m_user');
        $this->load->model('pwreset');


        $user_id = $this->session->userdata('reset_user_id');
        $new_password = $this->input->post('password');

        $this->m_user->update_password($user_id, $new_password);

        $this->session->set_flashdata('success', 'Password berhasil diubah.');
        redirect('auth/login');
    }

    private function send_whatsapp_message($phone, $message) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://localhost:3000/send-message?number=$phone&message=" . urlencode($message),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
        ));

        $response = curl_exec($curl);

        curl_close($curl);

    }
}
