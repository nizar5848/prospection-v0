<?php

// application/controllers/Calendar.php
class Calendar extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Event_model');
    }

    public function view()
    {
        $this->load->view('dashboard/calendar');
    }

    public function display_event()
    {
        $events = $this->Event_model->get_events();
        if ( ! empty($events)) {
            $data_arr = array();
            foreach ($events as $i => $event) {
                $data_arr[$i]['event_id'] = $event['event_id'];
                $data_arr[$i]['title']    = $event['event_name'];
                $data_arr[$i]['start']    = date("Y-m-d",
                    strtotime($event['event_start_date']));
                $data_arr[$i]['end']      = date("Y-m-d",
                    strtotime($event['event_end_date']));
                $data_arr[$i]['color']    = '#36CD36';
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
        $event_name       = $this->input->post('event_name');
        $event_start_date = date("Y-m-d",
            strtotime($this->input->post('event_start_date')));
        $event_end_date   = date("Y-m-d",
            strtotime($this->input->post('event_end_date')));

        $event = array(
            'event_name'       => $event_name,
            'event_start_date' => $event_start_date,
            'event_end_date'   => $event_end_date,
        );

        if ($this->Event_model->save_event($event)) {
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
