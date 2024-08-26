<?php 
 
class M_login extends CI_Model{	
	function cek_login($table,$where){		
		return $this->db->get_where($table,$where);
	}
	public function get_user($user,$password) {
	    $where = array( 
	        'user' => $user, 
	        'password' => $password, 
	    );
	    $this->db->where($where);
	    $query = $this->db->get('admin')->result();
	    foreach ($query as $key => $value) {
	        return $value;
	    }
	}	
}

