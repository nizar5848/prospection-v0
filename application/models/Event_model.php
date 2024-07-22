<?php

// application/models/Event_model.php
class Event_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_events()
    {
        $query = $this->db->get('events');

        return $query->result_array();
    }

    public function save_event($event)
    {
        return $this->db->insert('events', $event);
    }

    public function update_event($event_id, $event)
    {
        $this->db->where('event_id', $event_id);

        return $this->db->update('events', $event);
    }
}
