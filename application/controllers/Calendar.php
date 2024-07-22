<?php

class Calendar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Event_model');
    }

    public function index()
    {
        $data = [
            'view'  => 'dashboard/calendar',
            'title' => 'calendrier',
        ];
        $this->load->view('dashboard/layouts', $data);
    }

    public function display_event()
    {
        $events = $this->Event_model->get_events();
        if ( ! empty($events)) {
            $data_arr = [];
            foreach ($events as $i => $event) {
                $data_arr[$i]['event_id'] = $event['event_id'];
                $data_arr[$i]['title']    = $event['event_name'];
                $data_arr[$i]['start']    = $event['event_start_datetime'];  // Use DATETIME format
                $data_arr[$i]['end']      = $event['event_end_datetime'];    // Use DATETIME format
                $data_arr[$i]['color']    = '#36CD36';
            }

            $data = [
                'status' => true,
                'msg'    => 'successfully!',
                'data'   => $data_arr,
            ];
        } else {
            $data = [
                'status' => false,
                'msg'    => 'Error!',
            ];
        }
        echo json_encode($data);
    }

    public function save_event()
    {
        $event_name           = $this->input->post('event_name');
        $event_start_datetime = $this->input->post('event_start_datetime');
        $event_end_datetime   = $this->input->post('event_end_datetime');

        $event = [
            'event_name'           => $event_name,
            'event_start_datetime' => $event_start_datetime,
            'event_end_datetime'   => $event_end_datetime,
        ];

        if ($this->Event_model->save_event($event)) {
            $data = [
                'status' => true,
                'msg'    => 'Événement ajouté avec succès!',
            ];
        } else {
            $data = [
                'status' => false,
                'msg'    => 'Désolé, l\'événement n\'a pas été ajouté.',
            ];
        }
        echo json_encode($data);
    }

    public function update_event()
    {
        $event_id             = $this->input->post('event_id');
        $event_name           = $this->input->post('event_name');
        $event_start_datetime = $this->input->post('event_start_datetime');
        $event_end_datetime   = $this->input->post('event_end_datetime');

        $event = [
            'event_name'           => $event_name,
            'event_start_datetime' => $event_start_datetime,
            'event_end_datetime'   => $event_end_datetime,
        ];

        if ($this->Event_model->update_event($event_id, $event)) {
            $data = [
                'status' => true,
                'msg'    => 'Événement mis à jour avec succès!',
            ];
        } else {
            $data = [
                'status' => false,
                'msg'    => 'Désolé, l\'événement n\'a pas été mis à jour.',
            ];
        }
        echo json_encode($data);
    }
}
