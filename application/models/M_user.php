<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_user($username,$password) {
        $where = array( 
            'username' => $username, 
            'password' => $password, 
        );
        $this->db->where($where);
        $query = $this->db->get('users')->result();
        foreach ($query as $key => $value) {
            return $value;
        }
    }

    public function get_user_by_phone($phone) {
        $this->db->where('phone', $phone);
        $query = $this->db->get('users');
        return $query->row();
    }

    public function update_password($id_user, $password) {
        $this->db->where('id', $id_user);
        $this->db->update('users', ['password' => $password]);
    }
}
