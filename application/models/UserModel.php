<?php

class UserModel extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function create_user($data)
    {
        return $this->db->insert('users', $data);
    }

    public function get_user_by_email($email)
    {
        $query = $this->db->get_where('users', ['email' => $email]);

        return $query->row_array();
    }

    public function count_admins()
    {
        $this->db->where('role', 'admin');
        $this->db->from('users');

        return $this->db->count_all_results();
    }
}
