<?php

class Calendar extends CI_Controller
{
    public function view()
    {
        $this->load->view('dashboard/calendar');
    }

    public function display_event()
    {
        $this->load->database();
        $display_query = "SELECT event_id, event_name, event_start_date, event_end_date FROM calendar_event_master";
        $results       = $this->db->query($display_query);
        $count         = $results->num_rows();
        if ($count > 0) {
            $data_arr = array();
            $i        = 1;
            foreach ($results->result_array() as $data_row) {
                $data_arr[$i]['event_id'] = $data_row['event_id'];
                $data_arr[$i]['title']    = $data_row['event_name'];
                $data_arr[$i]['start']    = date("Y-m-d",
                    strtotime($data_row['event_start_date']));
                $data_arr[$i]['end']      = date("Y-m-d",
                    strtotime($data_row['event_end_date']));
                $data_arr[$i]['color']    = '#36CD36';
                $i++;
            }

            $data = array(
                'status' => true,
                'msg'    => 'successfully!',
                'data'   => $data_arr,
            );
        } else {
            $data = array(
                'status' => false,
                'msg'    => 'Error!',
            );
        }
        echo json_encode($data);
    }

    public function save_event()
    {
        $this->load->database();
        $event_name       = $this->input->post('event_name');
        $event_start_date = date("Y-m-d",
            strtotime($this->input->post('event_start_date')));
        $event_end_date   = date("Y-m-d",
            strtotime($this->input->post('event_end_date')));

        $insert_query = "INSERT INTO `calendar_event_master`(`event_name`, `event_start_date`, `event_end_date`) VALUES (?, ?, ?)";
        $this->db->query($insert_query,
            array($event_name, $event_start_date, $event_end_date));
        if ($this->db->affected_rows() > 0) {
            $data = array(
                'status' => true,
                'msg'    => 'Event added successfully!',
            );
        } else {
            $data = array(
                'status' => false,
                'msg'    => 'Sorry, Event not added.',
            );
        }
        echo json_encode($data);
    }
}
