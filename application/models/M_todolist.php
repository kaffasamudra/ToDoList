<?php

class M_todolist extends CI_Model
{
	private $_table = 'todolist';

	public function get()
	{
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function get_published($limit = null, $offset = null)
	{
		// if (!$limit && $offset) {
		// 	$query = $this->db->get_where($this->_table, ['draft' => 'false']);
		// } else {
		// 	$query =  $this->db->get_where($this->_table, ['draft' => 'false'], $limit, $offset);
		// }
		// return $query->result();
		return $this->db->get($this->_table);
	}

	public function find_by_slug($slug)
	{
		if (!$slug) {
			return;
		}
		$query = $this->db->get_where($this->_table, ['slug' => $slug]);
		return $query->row();
	}

	public function find($id)
	{
		if (!$id) {
			return;
		}

		$query = $this->db->get_where($this->_table, array('id' => $id));
		return $query->row();
	}

	public function insert($todolist)
	{
		return $this->db->insert($this->_table, $todolist);
	}

	public function update($todolist)
	{
		if (!isset($todolist['id'])) {
			return;
		}

		return $this->db->update($this->_table, $todolist, ['id' => $todolist['id']]);
	}

	public function delete($id)
	{
		if (!$id) {
			return;
		}

		return $this->db->delete($this->_table, ['id' => $id]);
	}

	public function get_data_by_role($role) {
	    return $this->db->get_where('todolist', ['bagian' => $role])->result_array();
    }

    public function get_todolist_by_user($id_user) {
        $this->db->where('id_user', $id_user);
        $this->db->order_by('created_at', 'desc');
        return $this->db->get('todolist')->result();
    }

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function get_data_count() {
        return $this->db->count_all('todolist'); // Ganti 'nama_tabel' dengan nama tabel Anda
    }
    var $column_order = array(null, 'Judul', 'Tanggal', 'Bagian'); // Column order
    var $order = array('Id' => 'asc'); // Default order

    public function get_datatables($bagian) {

        if($bagian == ""){
            $kondisi_bagian = "";
        } else {
            $kondisi_bagian = " AND Bagian = '$bagian'";
        }

        // Search
        if($this->input->post('search')['value']) {
            $search = $this->input->post('search')['value'];
            $kondisi_search = "Judul LIKE '%$search%' OR Tanggal LIKE '%$search%' OR Bagian LIKE '%$search%' $kondisi_bagian";
        } else {
            $kondisi_search = "1=1 $kondisi_bagian";
        }

        // Order
        if($this->input->post('order')) {
            $result_order = $this->column_order[$this->input->post('order')['0']['column']];
            $result_dir = $this->input->post('order')['0']['dir'];
        } else if(isset($this->order)) {
            $order = $this->order;
            $result_order = key($order);
            $result_dir = $order[key($order)];
        }

        if($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
        }
        
        $this->db->from('todolist');
        $this->db->where($kondisi_search);
        $this->db->order_by($result_order, $result_dir);
        $query = $this->db->get();
        
        return $query->result();
    }

    public function jumlah_semua() {
        $this->db->select("COUNT(Id) as jml");
        $this->db->from("todolist");
        $query = $this->db->get();
        return $query->row();
    }

    public function jumlah_filter($bagian) {

        if($bagian == ""){
            $kondisi_bagian = "";
        } else {
            $kondisi_bagian = " AND Bagian = '$bagian'";
        }

        // Search condition
        if($this->input->post('search')['value']) {
            $search = $this->input->post('search')['value'];
            $kondisi_search = " AND (Judul LIKE '%$search%' OR Tanggal LIKE '%$search%' OR Bagian LIKE '%$search%') $kondisi_bagian";
        } else {
            $kondisi_search = "$kondisi_bagian";
        }
        
        $this->db->select("COUNT(Id) as jml");
        $this->db->from("todolist");
        $this->db->where("1=1 $kondisi_search");
        $query = $this->db->get();
        return $query->row();
    }
}
