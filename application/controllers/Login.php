<?php 
 
class Login extends CI_Controller{
 
	function __construct(){
		parent::__construct();		
		$this->load->model('m_login');
 
	}
 
	function index(){
		$this->load->view('v_login');
	}
 
	public function login() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user', 'user', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/dashboard');
        } else {
            $user = $this->input->post('user');
            $password = $this->input->post('password');
            
            $this->load->model('m_login');
            $user = $this->m_login->get_user($user, $password);
            
            if ($user->user == $user && $user->password == $password) {
                $this->session->set_userdata('user', $user->user);
                $this->session->set_userdata('id_user', $user->id);
                // Redirect based on role
                redirect(base_url("admin"));
                } else { 
                $this->session->set_flashdata('error', 'Invalid user or password');
                redirect('admin');
            }
        }
    }
 
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
	
}