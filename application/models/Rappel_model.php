<?php

class Rappel_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_rappels_by_user($user_id)
    {
        // Fetch only rappels with status 'pending'
        $this->db->where('user_id', $user_id);
        $this->db->where('status', 'pending');
        $query = $this->db->get('rappels');

        return $query->result_array();
    }

    public function get_rappel($rappel_id)
    {
        $this->db->where('id', $rappel_id);
        $query = $this->db->get('rappels');

        return $query->row_array();
    }

    public function create_rappel($data)
    {
        return $this->db->insert('rappels', $data);
    }

    public function update_status($rappel_id, $status)
    {
        $this->db->where('id', $rappel_id);
        $this->db->update('rappels', ['status' => $status]);
    }
}
