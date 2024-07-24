<?php

class RappelsController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Rappel_model');
        $this->load->library('session');
    }

    public function rappels()
    {
        $user_id         = $this->session->userdata('id');
        $pending_rappels = $this->Rappel_model->get_rappels_by_user($user_id);
        $pending_count   = count($pending_rappels);

        $data = [
            'title'         => 'Rappels',
            'view'          => 'rappels/index',
            'first_name'    => $this->session->userdata('first_name'),
            'id'            => $this->session->userdata('id'),
            'rappels'       => $pending_rappels,
            'pending_count' => $pending_count,
        ];

        $this->load->view('dashboard/layouts', $data);
    }

    public function switch_status($rappel_id)
    {
        // Load required models
        $this->load->model('Rappel_model');

        // Fetch the rappel by its ID
        $rappel = $this->Rappel_model->get_rappel($rappel_id);

        if ($rappel) {
            // Toggle the status
            $new_status = $rappel['status'] == 'pending' ? 'done' : 'pending';
            $this->Rappel_model->update_status($rappel_id, $new_status);
        }

        // Redirect back to the rappels index
        redirect('rappels');
    }

    public function create()
    {
        // Load form helper and library if needed
        $this->load->helper('form');
        $this->load->library('form_validation');
        $user_id         = $this->session->userdata('id');
        $pending_rappels = $this->Rappel_model->get_rappels_by_user($user_id);
        $pending_count   = count($pending_rappels); // Count the number of pending rappels

        // Set validation rules
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

        if ($this->form_validation->run() === false) {
            $data = [
                'title'         => 'Créer un rappel',
                'view'          => 'rappels/create',
                'pending_count' => $pending_count, // Pass the count to the view

            ];

            $this->load->view('dashboard/layouts', $data);
        } else {
            $user_id     = $this->session->userdata('id');
            $rappel_data = [
                'user_id'     => $user_id,
                'title'       => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'status'      => 'pending',
            ];

            $this->Rappel_model->create_rappel($rappel_data);
            redirect('rappels');
        }
    }
}

?>
