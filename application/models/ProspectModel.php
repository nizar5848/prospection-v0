<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ProspectModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load database library if not loaded already
    }

    public function insert_prospect($data)
    {
        return $this->db->insert('prospects', $data); // Assuming 'prospects' is your table name
    }

    public function delete_user_by_id($id)
    {
        $this->db->where('id', $id);

        return $this->db->delete('prospects');
    }

    public function get_prospect($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('prospects');

        $prospect = $query->row_array(); // Return the result as an associative array

        if ( ! empty($prospect['phone_numbers'])) {
            $prospect['phone_numbers'] = json_decode($prospect['phone_numbers'], true);
        }

        return $prospect;
    }

    public function update_prospect($id, $data)
    {
        $this->db->where('id', $id);

        return $this->db->update('prospects', $data);
    }

    public function get_prospect_consult($id)
    {
        $query = $this->db->get_where('prospects', array('id' => $id));

        $prospect = $query->row();

        if ( ! empty($prospect->phone_numbers)) {
            $prospect->phone_numbers = json_decode($prospect->phone_numbers, true);
        }

        return $prospect;
    }

    public function fetchProspects($status, $numberOfProspects)
    {
        // Fetch the prospects with the given status and limit
        $this->db->where('status', $status);
        $this->db->limit($numberOfProspects);
        $query = $this->db->get('prospects');

        return $query->result_array();
    }

    public function updateActiveProspects($numberOfProspects, $status)
    {
        // Update the 'active' column based on the conditions
        $this->db->where('status', $status);
        $this->db->where('active', 0); // Assuming you want to update only inactive prospects
        $this->db->limit($numberOfProspects);
        $this->db->update('prospects', ['active' => 1]);
    }

    public function get_active_prospects()
    {
        $this->db->where('active', 1);
        $query = $this->db->get('prospects');

        return $query->result_array();
    }

    public function update_status($id, $status)
    {
        $data = array(
            'status' => $status,
        );

        $this->db->where('id', $id);
        $this->db->update('prospects', $data);
    }

    public function set_active_status($id, $status)
    {
        $data = array(
            'active' => $status,
        );

        $this->db->where('id', $id);
        $this->db->update('prospects', $data);
    }

    public function get_all_prospects()
    {
        $query = $this->db->get('prospects');

        return $query->result();
    }

    public function insert_batch($data)
    {
        $this->db->insert_batch('prospects', $data);
    }


    // charts
    public function get_prospects_by_status()
    {
        $this->db->select("status, COUNT(*) as count");
        $this->db->group_by("status");
        $query = $this->db->get("prospects");

        return $query->result_array();
    }

    public function get_total_prospects()
    {
        return $this->db->count_all("prospects");
    }

    public function get_prospects_over_time()
    {
        $this->db->select("DATE(created_at) as day, COUNT(*) as prospect_count");
        $this->db->group_by("DATE(created_at)");
        $query = $this->db->get("prospects");

        return $query->result_array();
    }

    public function get_conversion_percentage()
    {
        $this->db->select('status, COUNT(*) as count');
        $this->db->from('prospects');
        $this->db->group_by('status');
        $query   = $this->db->get();
        $results = $query->result_array();

        $total            = 0;
        $conversion_count = 0;

        foreach ($results as $row) {
            if ($row['status'] == 'converti') {
                $conversion_count = $row['count'];
            }
            $total += $row['count'];
        }

        $percentage_conversion = $total > 0 ? ($conversion_count / $total) * 100 : 0;

        return [
            'conversion_percentage' => $percentage_conversion,
            'total'                 => $total,
        ];
    }

    public function updateActiveStatus($id, $status)
    {
        // Update the active column for the specified ID
        $this->db->where('id', $id);

        return $this->db->update('prospects', array('active' => $status));
    }

    // dashboard cards
    // Get total number of prospects
//    public function get_total_prospects()
//    {
//        return $this->db->count_all('prospects');
//    }


// Get total number of reminders
    public function get_total_reminders()
    {
        return $this->db->count_all('rappels'); // Assuming you have a 'reminders' table
    }

// Get conversion percentage
//    public function get_conversion_percentage()
//    {
//        $total_prospects     = $this->get_total_prospects();
//        $converted_prospects = $this->db->where('status', 'converti')->count_all_results('prospects');
//
//        $conversion_percentage = ($total_prospects > 0) ? ($converted_prospects / $total_prospects) * 100 : 0;
//
//        return [
//            'conversion_percentage' => number_format($conversion_percentage, 2),
//            'total'                 => $converted_prospects,
//        ];
//    }

// Get number of active prospects
    public function get_active_prospects_count()
    {
        $this->db->where('active', 1);

        return $this->db->count_all_results('prospects');
    }

// Get number of new prospects
    public function get_new_prospects()
    {
        $this->db->where('status', 'nouveau');

        return $this->db->count_all_results('prospects');
    }


    public function getProspectStatus($id)
    {
        $this->db->select('active');
        $this->db->from('prospects');
        $this->db->where('id', $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->active;
        } else {
            return null; // or handle it as needed
        }
    }

    public function delete_notes_by_prospect_id($id)
    {
        return $this->db->delete('notes', array('prospect_id' => $id));
    }

    public function has_related_notes($id)
    {
        $this->db->where('prospect_id', $id);
        $query = $this->db->get('notes');

        return $query->num_rows() > 0;
    }


}

?>
