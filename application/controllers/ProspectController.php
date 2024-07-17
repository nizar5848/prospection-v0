<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProspectController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProspectModel'); // Load the ProspectModel
        $this->load->library('form_validation'); // Load the form_validation library
    }

    public function registerProspect()
    {
        $data = [
            "title" => "Liste des utilisateurs",
            "view"  => "dashboard/register_prospect",
        ];

        $this->load->view('dashboard/layouts', $data);
    }

    public function register()
    {
        // Validate form input
        $this->form_validation->set_rules('first_name', 'Prénom', 'required');
        $this->form_validation->set_rules('last_name', 'Nom', 'required');
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
        $this->form_validation->set_rules('company', 'Entreprise', 'required');
        $this->form_validation->set_rules('phone_number', 'Numéro téléphone', 'required');
        $this->form_validation->set_rules('address', 'Adresse', 'required');

        if ($this->form_validation->run() === FALSE) {
            // Form validation failed, show errors or handle accordingly
            $this->load->view('registration_form'); // Replace with your view name
        } else {
            // Form validation succeeded, proceed to insert into database
            $data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'company' => $this->input->post('company'),
                'phone_number' => $this->input->post('phone_number'),
                'address' => $this->input->post('address'),
                'status' => 'nouveau', // Default status as per your enum
                'historiqueInteractions' => '' // You may handle this field as needed
            );

            // Call the model to insert data
            if ($this->ProspectModel->insert_prospect($data)) {
                // Successfully inserted
                redirect('dashboard'); // Replace with your redirect URL
            } else {
                // Insertion failed, handle error
                // Example: $data['error'] = 'Failed to insert prospect';
                $this->load->view('registration_form', $data); // Replace with your view name
            }
        }
    }
}
?>
