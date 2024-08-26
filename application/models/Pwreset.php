<?php

class Pwreset extends CI_Model {

    public function create_token($id_user, $token) {
        $data = [
            'id_user' => $id_user,
            'token' => $token,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('password_resets', $data);
    }

    public function get_token($token) {
        $this->db->where('token', $token);
        $query = $this->db->get('password_resets');
        return $query->row();
    }

    public function delete_expired_tokens() {
        $this->db->where('created_at <', date('Y-m-d H:i:s'));
        $this->db->delete('password_resets');
        
        return $this->db->affected_rows() > 0;
    }
}
