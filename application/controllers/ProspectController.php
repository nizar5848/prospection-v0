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

    public function edit_prospect($id) {
        // Validate form input
        $this->form_validation->set_rules('first_name', 'Prénom', 'required');
        $this->form_validation->set_rules('last_name', 'Nom', 'required');
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
        $this->form_validation->set_rules('company', 'Entreprise', 'required');
        $this->form_validation->set_rules('phone_number', 'Numéro téléphone', 'required');
        $this->form_validation->set_rules('address', 'Adresse', 'required');
    
        // Load user data (assuming you have a way to get the current user)
        $user = $this->session->userdata('user'); // Adjust this as per your application
    
        if ($this->form_validation->run() === FALSE) {
            // Form validation failed, load the form again with errors
            $data = [
                'title' => 'Modifier Prospects',
                'view' => 'dashboard/edit_prospect',
                'user' => $user,
                'prospects' => $this->ProspectModel->get_prospect($id)
            ];
            $this->load->view('dashboard/layouts', $data);
        } else {
            // Form validation succeeded, proceed to update the database
            $data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'company' => $this->input->post('company'),
                'phone_number' => $this->input->post('phone_number'),
                'address' => $this->input->post('address'),
                'status' => 'nouveau', // Update status if needed
                'historiqueInteractions' => '' // Update this field as needed
            );
    
            // Call the model to update data
            if ($this->ProspectModel->update_prospect($id, $data)) {
                // Successfully updated
                redirect('table-prospects-globale'); // Replace with your redirect URL
            } else {
                // Update failed, handle error
                $data = [
                    'title' => 'Modifier Prospects',
                    'view' => 'dashboard/edit_prospect',
                    'user' => $user,
                    'prospects' => $this->ProspectModel->get_prospect($id),
                    'error' => 'Failed to update prospect'
                ];
                $this->load->view('dashboard/layouts', $data);
            }
        }
    }

    public function consult_prospect($id) {
        // Load prospect data
        $prospect = $this->ProspectModel->get_prospect_consult($id);

        // Check if prospect exists
        if (empty($prospect)) {
            show_404();
        }

        // Load user data (if needed)
        $user = $this->session->userdata('user'); // Adjust this as per your application

        // Pass data to the view
        $data = [
            'title' => 'Consulter Prospect',
            'view' => 'dashboard/consulter_prospect',
            'user' => $user,
            'prospect' => $prospect
        ];
        $this->load->view('dashboard/layouts', $data);
    }

    public function delete_prospect($id)
    {
            if ($this->ProspectModel->delete_user_by_id($id)) {
                $this->session->set_flashdata('success', 'User deleted successfully.');
            } else {
                $this->session->set_flashdata('error', 'Failed to delete user.');
            }
            redirect('table-prospects');
        }
}
?>
