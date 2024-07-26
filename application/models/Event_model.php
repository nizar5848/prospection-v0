<?php

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

    public function delete_event($event_id)
    {
        $this->db->where('event_id', $event_id);

        return $this->db->delete('events');
    }

    // chart
    public function get_events_over_time()
    {
        $this->db->select("MONTH(event_start_datetime) as month, COUNT(*) as event_count");
        $this->db->group_by("MONTH(event_start_datetime)");
        $query = $this->db->get("events");

        return $query->result_array();
    }
}
