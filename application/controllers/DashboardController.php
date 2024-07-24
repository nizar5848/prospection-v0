<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DashboardController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('UserModel');
        $this->load->library('form_validation');
        $this->load->model('ProspectModel');

        if (!$this->session->userdata('auth')) {
            redirect('authController/login');
        }
    }

    public function adminDashboard()
    {
        $data = [
            "title"     => 'Admin Dashboard',
            'view'      => 'dashboard/home',
            "firstname" => $this->session->userdata('first_name'),
            "lastname"  => $this->session->userdata('last_name'),
            "role"      => $this->session->userdata('role'),
        ];

        $this->load->view('dashboard/layouts', $data);
    }

    public function userDashboard()
    {
        $data = [
            "title"     => 'User Dashboard',
            'view'      => 'dashboard/home_user',
            "firstname" => $this->session->userdata('first_name'),
            "lastname"  => $this->session->userdata('last_name'),
            "role"      => $this->session->userdata('role'),
        ];

        $this->load->view('dashboard/layouts', $data);
    }

    public function prospectsTableAdmin()
    {
        $data = [
            "title" => "Liste de tout les prospects.",
            "view"  => "dashboard/prospects_table",
        ];

        $this->load->view("dashboard/layouts", $data);
    }

    public function calendar()
    {
        $data = [
            "title" => "Calendrier",
            "view"  => "dashboard/calendar",
        ];

        $this->load->view('dashboard/layouts', $data);
    }

    public function prospectsTableUser()
    {
        $data = [
            "title" => "Liste de tout les prospects.",
            "view"  => "dashboard/prospects_table",
        ];

        $this->load->view("dashboard/layouts", $data);
    }

    public function usersTable()
    {
        $layout_data = [
            "title" => "Liste des utilisateurs",
            "view"  => "dashboard/users_table",
        ];

        $this->load->view('dashboard/layouts', $layout_data);
    }

    public function register()
    {
        $this->load->model('UserModel');

        $is_admin_exists = $this->UserModel->count_admins() > 0;
        $is_admin = !$is_admin_exists;

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', [
            'required',
            'min_length[8]',
            'regex_match[/[0-9]/]',
            'regex_match[/[^a-zA-Z0-9]/]',
        ], [
            'regex_match' => 'The {field} must contain at least one digit and one special character.',
        ]);
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');

        if ($is_admin_exists) {
            $this->form_validation->set_rules('role', 'Role', 'required');
        }

        if ($this->form_validation->run() === false) {
            $data = [
                "title" => 'Inscription',
                "view"  => "dashboard/register_user",
                "is_admin_exists" => $is_admin_exists,
            ];
            $this->load->view("dashboard/layouts", $data);
        } else {
            $role = $is_admin ? 'admin' : $this->input->post('role');
            $data = [
                'email'      => $this->input->post('email'),
                'password'   => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'role'       => $role,
            ];

            $this->UserModel->create_user($data);

            $redirect_url = $is_admin ? 'authController/login' : 'dashboard';
            redirect($redirect_url);
        }
    }

    public function fetchDatafromDatabase()
    {
        $query = $this->db->get('users');
        $data = $query->result_array();
        $currentUserId = (int)$this->session->userdata('id');
        $currentUserRole = $this->session->userdata('role'); // Supposons que le rôle soit stocké dans la session
    
        $formattedData = array_map(function ($row) use ($currentUserId, $currentUserRole) {
            $rowUserId = (int)$row['id'];
            $rowUserRole = $row['role']; // Supposons que le rôle soit une colonne dans votre table users
            $rowUserSuspended = $row['suspended']; // Supposons que suspended soit une colonne dans votre table users
    
            // Déterminer les actions en fonction du rôle de l'utilisateur actuel et du rôle de l'utilisateur de la ligne
            if ($rowUserId != $currentUserId) { // Empêcher l'utilisateur de voir les actions pour lui-même
                if ($currentUserId == 1 || ($currentUserRole == 'admin' && $rowUserRole == 'user')) {
                    $suspendLink = $rowUserSuspended 
                        ? '<a class="dropdown-item" href="' . base_url('DashboardController/suspendre_user/' . $row['id']) . '">Désuspendre</a>'
                        : '<a class="dropdown-item" href="' . base_url('DashboardController/suspendre_user/' . $row['id']) . '">Suspendre</a>';
    
                    $row['actions'] = '
                    <div class="d-flex justify-content-center align-items-center">
                        <button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted sr-only">Action</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-left">
                            <a class="dropdown-item" href="' . base_url('DashboardController/delete_user/' . $row['id']) . '">Supprimer</a>
                            <a class="dropdown-item" href="' . base_url('DashboardController/edit_user/' . $row['id']) . '">Modifier</a>'
                            . $suspendLink . '
                        </div>
                    </div>';
                } else {
                    $row['actions'] = ''; 
                }
            } else {
                $row['actions'] = ''; // Pas d'actions pour l'utilisateur actuel sur son propre enregistrement
            }
    
            return $row;
        }, $data);
    
        echo json_encode(['data' => $formattedData]);
    }
    
    

    
    

    

    public function fetchProspects()
    {
        $query = $this->db->get('prospects');
        $data = $query->result_array();

        $formattedData = array_map(function ($row) {
            $row['actions'] = '
            <div class="d-flex justify-content-center align-items-center">
                <button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="text-muted sr-only">Action</span>
                </button>
                <div class="dropdown-menu dropdown-menu-left">
                    <a class="dropdown-item" href="' . base_url('DashboardController/edit_prospect/' . $row['id']) . '">Modifier</a>
                    <a class="dropdown-item" href="' . base_url('DashboardController/delete_prospect/' . $row['id']) . '">Supprimer</a>
                </div>               
            </div>';

            return $row;
        }, $data);

        echo json_encode(['data' => $formattedData]);
    }

    public function delete_user($id)
    {
        $current_user_id = $this->session->userdata('id');

        if ($id == 1) {
            $this->session->set_flashdata('error', 'You cannot delete the first user.');
            redirect('table-utilisateurs');
        } elseif ($id == $current_user_id) {
            $this->session->set_flashdata('error', 'You cannot delete yourself.');
            redirect('table-utilisateurs');
        } else {
            if ($this->UserModel->delete_user_by_id($id)) {
                $this->session->set_flashdata('success', 'User deleted successfully.');
            } else {
                $this->session->set_flashdata('error', 'Failed to delete user.');
            }
            redirect('table-utilisateurs');
        }
    }

    public function edit_user($id) {
        // Fetch user data from the database
        $user = $this->UserModel->get_user_by_id($id);
        
        if (!$user) {
            show_404();
        }
    
        // Check if the current user is an admin
        $is_admin_exists = $this->session->userdata('role') === 'admin';
    
        // Form validation rules
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
    
        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        }
    
        // Check if the form is submitted and valid
        if ($this->form_validation->run() === TRUE) {
            // Prepare user data for update
            $update_data = [
                'email' => $this->input->post('email'),
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
            ];
    
            if ($this->input->post('password')) {
                $update_data['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
            }
    
            if ($is_admin_exists) {
                $update_data['role'] = $this->input->post('role');
            }
    
            // Update user data in the database
            $this->UserModel->update_user($id, $update_data);
    
            // Set success message and redirect to user list
            $this->session->set_flashdata('success', 'User updated successfully');
            redirect('DashboardController/usersTable');
        } else {
            // Pass data to the view
            $data = [
                'title' => 'Modifier Utilisateur',
                'view' => 'dashboard/edit_user',
                'user' => $user,
                'is_admin_exists' => $is_admin_exists,
            ];
    
            $this->load->view('dashboard/layouts', $data);
        }
    }

    public function suspendre_user($id) {
        // Check if the current user is an admin
        if ($this->session->userdata('role') !== 'admin') {
            show_error('Unauthorized action', 403);
        }
    
        // Fetch user data from the database
        $user = $this->UserModel->get_user_by_id($id);
        
        if (!$user) {
            show_404();
        }
    
        // Update the suspended status of the user
        $new_status = !$user['suspended'];
        $this->UserModel->update_suspended_status($id, $new_status);
    
        // Set success message and redirect to user list
        $this->session->set_flashdata('success', 'User ' . ($new_status ? 'suspended' : 'unsuspended') . ' successfully');
        redirect('DashboardController/usersTable');
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
        
    
    
}
