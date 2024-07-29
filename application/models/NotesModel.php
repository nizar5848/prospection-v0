<?php
class NoteModel extends CI_Model {

    public function getNotesByProspect($prospect_id) {
        $this->db->where('prospect_id', $prospect_id);
        $query = $this->db->get('notes');
        return $query->result();
    }

    public function addNote($data) {
        return $this->db->insert('notes', $data);
    }
}
?>
