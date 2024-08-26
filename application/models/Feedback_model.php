<?php

class Feedback_model extends CI_Model
{
	private $_table = "feedback";

	public function insert($feedback)
	{
		if(!$feedback){
			return;
		}

		return $this->db->insert($this->_table, $feedback);
	}

	public function get()
	{
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function delete($id)
	{
		if(!$id){
			return;
		}

		$this->db->delete($this->_table, ['id' => $id]);
	}
	
	public function __construct() {
        $this->load->database();
    }

    // Fungsi untuk mendapatkan jumlah data
    public function get_data_count() {
        return $this->db->count_all('feedback'); // Ganti 'nama_tabel' dengan nama tabel Anda
    }
}
