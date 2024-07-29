<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NoteModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insert_note($data) {
        $this->db->insert('notes', $data);
    }
    
    
    public function get_notes_by_prospect($prospect_id)
    {
        $this->db->where('prospect_id', $prospect_id);
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get('notes');
        return $query->result_array();
    }

    public function get_prospect_id_by_note_id($note_id) {
        $this->db->select('prospect_id');
        $this->db->from('notes');
        $this->db->where('id', $note_id);
        $query = $this->db->get();
        $result = $query->row();
        return $result->prospect_id;
    }
    

    public function delete_note_by_id($note_id) {
        $this->db->where('id', $note_id);
        $this->db->delete('notes');
    }
    
  
    
}
