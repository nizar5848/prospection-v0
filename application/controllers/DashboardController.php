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
        $this->load->model('Rappel_model');

        if ( ! $this->session->userdata('auth')) {
            redirect('authController/login');
        }
    }

    public function adminDashboard()
    {
        $user_id         = $this->session->userdata('id');
        $pending_rappels = $this->Rappel_model->get_rappels_by_user($user_id);
        $pending_count   = count($pending_rappels);

        $this->session->set_userdata('pending_count', $pending_count);
        $data = [
            "title"         => 'Admin Dashboard',
            'view'          => 'dashboard/home',
            "firstname"     => $this->session->userdata('first_name'),
            "lastname"      => $this->session->userdata('last_name'),
            "role"          => $this->session->userdata('role'),
            'pending_count' => $this->session->userdata('pending_count'),

        ];

        $this->load->view('dashboard/layouts', $data);
    }

    public function userDashboard()
    {
        $this->load->model('Event_model');
        $this->load->model('ProspectModel');

        // Fetch data from the models
        $total_prospects       = $this->ProspectModel->get_total_prospects();
        $total_events          = $this->Event_model->get_total_events();
        $total_reminders       = $this->ProspectModel->get_total_reminders();
        $conversion_data       = $this->ProspectModel->get_conversion_percentage();
        $active_prospects      = $this->ProspectModel->get_active_prospects_count();
        $new_prospects         = $this->ProspectModel->get_new_prospects();
        $prospects_status_data = $this->ProspectModel->get_prospects_by_status();
        $prospects_data        = $this->ProspectModel->get_prospects_over_time();


        // rappels count
        $user_id         = $this->session->userdata('id');
        $pending_rappels = $this->Rappel_model->get_rappels_by_user($user_id);
        $pending_count   = count($pending_rappels);

        $this->session->set_userdata('pending_count', $pending_count);

        $data = [
            "title"                 => 'User Dashboard',
            'view'                  => 'dashboard/home_user',
            "firstname"             => $this->session->userdata('first_name'),
            "lastname"              => $this->session->userdata('last_name'),
            "role"                  => $this->session->userdata('role'),
//            "total_prospects"       => $total_prospects,
            "total_events"          => $total_events,
            "total_reminders"       => $total_reminders,
            "conversion_percentage" => $conversion_data['conversion_percentage'],
            "active_prospects"      => $active_prospects,
            "new_prospects"         => $new_prospects,
            "prospects_status_data" => $prospects_status_data,
            "total_prospects"       => $total_prospects,
            "prospects_data"        => $prospects_data,
//            "conversion_percentage" => $conversion_data['conversion_percentage'],
            "total_conversion"      => $conversion_data['total'],
            'pending_count'         => $this->session->userdata('pending_count'),
        ];

        $this->load->view('dashboard/layouts', $data);
    }


    public function statistiques()
    {
        $this->load->model('Event_model');
        $this->load->model('ProspectModel');

        $events_data           = $this->Event_model->get_events_over_time();
        $prospects_status_data = $this->ProspectModel->get_prospects_by_status();
        $total_prospects       = $this->ProspectModel->get_total_prospects();
        $prospects_data        = $this->ProspectModel->get_prospects_over_time();
        $conversion_data       = $this->ProspectModel->get_conversion_percentage();

        $data = [
            "title"                 => 'Statistiques',
            'view'                  => 'dashboard/statistiques',
            "firstname"             => $this->session->userdata('first_name'),
            "lastname"              => $this->session->userdata('last_name'),
            "role"                  => $this->session->userdata('role'),
            "events_data"           => $events_data,
            "prospects_status_data" => $prospects_status_data,
            "total_prospects"       => $total_prospects,
            "prospects_data"        => $prospects_data,
            "conversion_percentage" => $conversion_data['conversion_percentage'],
            "total_conversion"      => $conversion_data['total'],
            'pending_count'         => $this->session->userdata('pending_count'),
        ];

        $this->load->view('dashboard/layouts', $data);
    }


    public function prospectsTableAdmin()
    {
        $data = [
            "title"         => "Liste de tout les prospects.",
            "view"          => "dashboard/prospects_table",
            'pending_count' => $this->session->userdata('pending_count'),

        ];

        $this->load->view("dashboard/layouts", $data);
    }

    public function calendar()
    {
        $data = [
            "title"         => "Calendrier",
            "view"          => "dashboard/calendar",
            'pending_count' => $this->session->userdata('pending_count'),
        ];

        $this->load->view('dashboard/layouts', $data);
    }

    public function prospectsTableUser()
    {
        $data = [
            "title"         => "Liste de tout les prospects.",
            "view"          => "dashboard/prospects_table",
            'pending_count' => $this->session->userdata('pending_count'),
        ];

        $this->load->view("dashboard/layouts", $data);
    }

    public function prospectsTableUserNouveau()
    {
        $data = [
            "title"         => "Nouveaux prospects",
            "view"          => "dashboard/prospects_table_nouveau",
            'pending_count' => $this->session->userdata('pending_count'),
        ];

        $this->load->view("dashboard/layouts", $data);
    }

    public function prospectsTableUserContacte()
    {
        $data = [
            "title"         => "Prospects contactés",
            "view"          => "dashboard/prospects_table_contacte",
            'pending_count' => $this->session->userdata('pending_count'),
        ];

        $this->load->view("dashboard/layouts", $data);
    }

    public function prospectsTableUserEnNegociation()
    {
        $data = [
            "title"         => "Prospects en cours de négociation",
            "view"          => "dashboard/prospects_table_en_negociation",
            'pending_count' => $this->session->userdata('pending_count'),
        ];

        $this->load->view("dashboard/layouts", $data);
    }

    public function prospectsTableUserConverti()
    {
        $data = [
            "title"         => "Prospects convertis",
            "view"          => "dashboard/prospects_table_converti",
            'pending_count' => $this->session->userdata('pending_count'),
        ];

        $this->load->view("dashboard/layouts", $data);
    }

    public function prospectsTableUserPerdu()
    {
        $data = [
            "title"         => "Prospects perdus",
            "view"          => "dashboard/prospects_table_perdu",
            'pending_count' => $this->session->userdata('pending_count'),
        ];

        $this->load->view("dashboard/layouts", $data);
    }


    public function usersTable()
    {
        $layout_data = [
            "title"         => "Liste des utilisateurs",
            "view"          => "dashboard/users_table",
            'pending_count' => $this->session->userdata('pending_count'),
        ];

        $this->load->view('dashboard/layouts', $layout_data);
    }

    public function register()
    {
        // Charger le modèle UserModel
        $this->load->model('UserModel');

        // Vérifier si un administrateur existe déjà
        $is_admin_exists = $this->UserModel->count_admins() > 0;
        $is_admin        = ! $is_admin_exists;

        // Règles de validation du formulaire
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|is_unique[users.email]', [
            'is_unique' => 'Cette adresse e-mail est déjà enregistrée.',
        ]);
        $this->form_validation->set_rules('password', 'Mot de passe', [
            'required',
            'min_length[8]',
            'regex_match[/[0-9]/]',
            'regex_match[/[^a-zA-Z0-9]/]',
        ], [
            'required'    => 'Le mot de passe ne respecte pas les exigences requises.',
            'min_length'  => 'Le mot de passe ne respecte pas les exigences requises.',
            'regex_match' => 'Le mot de passe ne respecte pas les exigences requises.',
        ]);
        $this->form_validation->set_rules('confirm_password', 'Confirmez le mot de passe', 'required|matches[password]',
            [
                'matches' => 'Le champ de confirmation du mot de passe ne correspond pas au champ Mot de passe.',
            ]);
        $this->form_validation->set_rules('first_name', 'Prénom', 'required', [
            'required' => 'Le champ Prénom est obligatoire.',
        ]);
        $this->form_validation->set_rules('last_name', 'Nom', 'required', [
            'required' => 'Le champ Nom est obligatoire.',
        ]);

        if ($is_admin_exists) {
            $this->form_validation->set_rules('role', 'Rôle', 'required', [
                'required' => 'Le champ Rôle est obligatoire.',
            ]);
        }

        if ($this->form_validation->run() === false) {
            $data = [
                "title"             => 'Inscription',
                "view"              => "dashboard/register_user",
                "is_admin_exists"   => $is_admin_exists,
                'validation_errors' => validation_errors(), // Passer les erreurs de validation
                'pending_count'     => $this->session->userdata('pending_count'),
            ];
            $this->load->view("dashboard/layouts", $data);
        } else {
            $role = $is_admin ? 'admin' : ($this->input->post('role') ?? 'user');

            $user_data = [
                'email'         => $this->input->post('email'),
                'password'      => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'first_name'    => $this->input->post('first_name'),
                'last_name'     => $this->input->post('last_name'),
                'role'          => $role,
                'pending_count' => $this->session->userdata('pending_count'),
            ];

            if ($this->UserModel->create_user($user_data)) {
                $this->session->set_flashdata('success', 'Utilisateur ajouté avec succès.');
            } else {
                $this->session->set_flashdata('error',
                    'Un problème est survenu lors de la création du compte. Veuillez réessayer.');
            }

            $redirect_url = $is_admin ? 'register_user' : 'register_user';
            redirect($redirect_url);
        }
    }


    public function fetchDatafromDatabase()
    {
        $query           = $this->db->get('users');
        $data            = $query->result_array();
        $currentUserId   = (int) $this->session->userdata('id');
        $currentUserRole = $this->session->userdata('role'); // Supposons que le rôle soit stocké dans la session

        $formattedData = array_map(function ($row) use ($currentUserId, $currentUserRole) {
            $rowUserId        = (int) $row['id'];
            $rowUserRole      = $row['role']; // Supposons que le rôle soit une colonne dans votre table users
            $rowUserSuspended = $row['suspended']; // Supposons que suspended soit une colonne dans votre table users

            // Déterminer les actions en fonction du rôle de l'utilisateur actuel et du rôle de l'utilisateur de la ligne
            if ($rowUserId != $currentUserId) { // Empêcher l'utilisateur de voir les actions pour lui-même
                if ($currentUserId == 1 || ($currentUserRole == 'admin' && $rowUserRole == 'user')) {
                    $suspendLink = $rowUserSuspended
                        ? '<a class="dropdown-item" href="'.base_url('DashboardController/suspendre_user/'.$row['id']).'">Désuspendre</a>'
                        : '<a class="dropdown-item" href="'.base_url('DashboardController/suspendre_user/'.$row['id']).'">Suspendre</a>';

                    $row['actions'] = '
                    <div class="d-flex justify-content-center align-items-center">
                              <button class="btn btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-chevron-down"></i>

                                  </button>
                        <div class="dropdown-menu dropdown-menu-left">
                            <a class="dropdown-item" href="'.base_url('DashboardController/delete_user/'.$row['id']).'">Supprimer</a>
                            <a class="dropdown-item" href="'.base_url('DashboardController/edit_user/'.$row['id']).'">Modifier</a>'
                        .$suspendLink.'
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

    public function fetchProspects($status = null)
    {
        if ($status) {
            $this->db->where('status', $status);
        }
        $query = $this->db->get('prospects');
        $data  = $query->result_array();

        $formattedData = array_map(function ($row) {
            $actions = '
    <div class="d-flex justify-content-center align-items-center">
        <a class="btn btn-success btn-sm mr-1" href="'.base_url('ProspectController/selectProspect/'.$row['id']).'" title="Ajouter à contacter">
            <i class="fas fa-plus text-white mt-1"></i>
        </a>
        <a class="btn btn-primary btn-sm mr-1" href="'.base_url('ProspectController/edit_prospect/'.$row['id']).'" title="Modifier">
            <i class="fas fa-edit"></i>
        </a>';

            // Check if the user has the admin role
            if ($this->session->userdata('role') === 'admin') {
                $actions .= '
        <a class="btn btn-danger btn-sm" href="'.base_url('ProspectController/delete_prospect/'.$row['id']).'" title="Supprimer">
            <i class="fas fa-trash"></i>
        </a>';
            }

            $actions .= '</div>';

            $row['actions'] = $actions;

            return $row;
        }, $data);


        echo json_encode(['data' => $formattedData]);
    }


    public function delete_user($id)
    {
        $current_user_id = $this->session->userdata('id');

        if ($id == 1) {
            $this->session->set_flashdata('error', 'Vous ne pouvez pas supprimer l\'admin supérieur.');
            redirect('table-utilisateurs');
        } elseif ($id == $current_user_id) {
            $this->session->set_flashdata('error', 'Vous ne puvez pas supprimer votre compte.');
            redirect('table-utilisateurs');
        } else {
            if ($this->UserModel->delete_user_by_id($id)) {
                $this->session->set_flashdata('success', 'Utilisateur supprimé avec succès.');
            } else {
                $this->session->set_flashdata('error', 'Failed to delete user.');
            }
            redirect('table-utilisateurs');
        }
    }

    public function edit_user($id)
    {
        // Fetch user data from the database
        $user = $this->UserModel->get_user_by_id($id);
        if ( ! $user) {
            show_404();
        }

        // Check if the current user is an admin
        $is_admin_exists = $this->session->userdata('role') === 'admin';

        // Form validation rules
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('first_name', 'Prénom', 'required');
        $this->form_validation->set_rules('last_name', 'Nom de famille', 'required');

        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'Mot de passe', 'required|min_length[8]');
            $this->form_validation->set_rules('confirm_password', 'Confirmation du mot de passe',
                'required|matches[password]');

            // Set custom error messages
            $this->form_validation->set_message('required', 'Le %s est requis.');
            $this->form_validation->set_message('matches', 'Le mot de passe et la confirmation ne correspondent pas.');
            $this->form_validation->set_message('min_length', 'Le mot de passe doit comporter au moins 8 caractères.');
        }

        // Check if the form is submitted and valid
        if ($this->form_validation->run() === true) {
            // Prepare user data for update
            $update_data = [
                'email'      => $this->input->post('email'),
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
            ];

            if ($this->input->post('password')) {
                $update_data['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
            }

            if ($is_admin_exists) {
                // Update role only if it's present in the form submission
                if ($this->input->post('role')) {
                    $update_data['role'] = $this->input->post('role');
                }
            } else {
                // Preserve existing role if current user is not an admin
                $update_data['role'] = $user['role'];
            }

            // Update user data in the database
            $this->UserModel->update_user($id, $update_data);

            // Set success message and redirect to user list
            $this->session->set_flashdata('success', 'Utilisateur modifié avec succès');
            redirect('DashboardController/usersTable');
        } else {
            // Get current user ID
            $currentUserId = $this->session->userdata('id');

            // Pass data to the view
            $data = [
                'title'           => 'Modifier Utilisateur',
                'view'            => 'dashboard/edit_user',
                'user'            => $user,
                'is_admin_exists' => $is_admin_exists,
                'pending_count'   => $this->session->userdata('pending_count'),
                'currentUserId'   => $currentUserId,
            ];

            $this->load->view('dashboard/layouts', $data);
        }
    }


    public function suspendre_user($id)
    {
        // Check if the current user is an admin
        if ($this->session->userdata('role') !== 'admin') {
            show_error('Unauthorized action', 403);
        }

        // Fetch user data from the database
        $user = $this->UserModel->get_user_by_id($id);

        if ( ! $user) {
            show_404();
        }

        // Update the suspended status of the user
        $new_status = ! $user['suspended'];
        $this->UserModel->update_suspended_status($id, $new_status);

        // Set success message and redirect to user list
        $this->session->set_flashdata('success',
            'Utilisateur '.($new_status ? 'suspendé' : 'désuspendé').' avec succès');
        redirect('DashboardController/usersTable');
    }

    public function profile()
    {
        $current_user_id = $this->session->userdata('id');

        // Fetch user data from the database
        $this->load->model('UserModel');
        $user = $this->UserModel->get_user_by_id($current_user_id);

        if ( ! $user) {
            show_404();
        }

        // Pass data to the view
        $data = [
            'title'         => 'Profile',
            'view'          => 'dashboard/profile',
            'user'          => $user,
            'pending_count' => $this->session->userdata('pending_count'),

        ];

        $this->load->view('dashboard/layouts', $data);
    }

    public function update_profile()
    {
        $current_user_id = $this->session->userdata('id');

        // Fetch user data from the database
        $this->load->model('UserModel');
        $user = $this->UserModel->get_user_by_id($current_user_id);

        if ( ! $user) {
            show_404();
        }

        // Form validation rules
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');

        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        }

        // Check if the form is submitted and valid
        if ($this->form_validation->run() === true) {
            // Prepare user data for update
            $update_data = [
                'email'      => $this->input->post('email'),
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
            ];

            if ($this->input->post('password')) {
                $update_data['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
            }

            // Update user data in the database
            $this->UserModel->update_user($current_user_id, $update_data);

            // Set success message and redirect to profile page
            $this->session->set_flashdata('success', 'Profile updated successfully');
            redirect('DashboardController/profile');
        } else {
            // Pass data to the view
            $data = [
                'title' => 'Profile',
                'view'  => 'dashboard/profile',
                'user'  => $user,
            ];

            $this->load->view('dashboard/layouts', $data);
        }
    }


}
