<?php

class Dashboard extends CI_Controller
{
	function __construct()
 	{
 		parent::__construct();
        $this->load->model('M_todolist');
 		$this->load->model('feedback_model');
 	}
 	public function index() {
        $data['count_todolist'] = $this->db->get("todolist")->num_rows();
        $data['count_feedback'] = $this->db->get("feedback")->num_rows();

        $this->load->view('admin/dashboard', $data);
    }
}?>