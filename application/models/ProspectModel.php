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
    
    public function get_prospect_consult($id) 
    {
        $query = $this->db->get_where('prospects', array('id' => $id));
        return $query->row();
    }

    public function fetchProspects($status, $numberOfProspects) {
        // Fetch the prospects with the given status and limit
        $this->db->where('status', $status);
        $this->db->limit($numberOfProspects);
        $query = $this->db->get('prospects');
        return $query->result_array();
    }

    public function updateActiveProspects($numberOfProspects, $status) {
        // Update the 'active' column based on the conditions
        $this->db->where('status', $status);
        $this->db->where('active', 0); // Assuming you want to update only inactive prospects
        $this->db->limit($numberOfProspects);
        $this->db->update('prospects', ['active' => 1]);
    }

    public function get_active_prospects() {
        $this->db->where('active', 1);
        $query = $this->db->get('prospects');
        return $query->result_array();
    }

    public function update_status($id, $status)
{
    $data = array(
        'status' => $status
    );

    $this->db->where('id', $id);
    $this->db->update('prospects', $data);
}

public function set_active_status($id, $status)
{
    $data = array(
        'active' => $status
    );

    $this->db->where('id', $id);
    $this->db->update('prospects', $data);
}



    
}
?>
