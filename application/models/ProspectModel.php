<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProspectModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Load database library if not loaded already
    }

    public function insert_prospect($data) {
        return $this->db->insert('prospects', $data); // Assuming 'prospects' is your table name
    }

    public function delete_user_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->delete('prospects');
    }

    public function get_prospect($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('prospects');
        return $query->row_array(); // Return the result as an associative array
    }

    public function update_prospect($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('prospects', $data);
    }

}

