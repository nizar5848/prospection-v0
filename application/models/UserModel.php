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

    // code for datatable


    public function fetchAllData($data, $tablename, $where)
    {
        $query = $this->db->select($data)
            ->from($tablename)
            ->where($where)
            ->get();

        return $query->result_array();
    }

    public function delete_user_by_id($id)
    {
        $this->db->where('id', $id);

        return $this->db->delete('users');
    }


    public function get_user_by_id($id)
    {
        $query = $this->db->get_where('users', ['id' => $id]);

        return $query->row_array();
    }

    public function update_user($id, $data)
    {
        $this->db->where('id', $id);

        return $this->db->update('users', $data);
    }

    public function update_suspended_status($id, $status)
    {
        $this->db->where('id', $id);

        return $this->db->update('users', ['suspended' => $status]);
    }


    // for the assigned_to func
    public function get_all_users()
    {
        $query = $this->db->get('users');

        return $query->result_array();
    }

}
