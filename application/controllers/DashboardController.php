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

    $formattedData = array_map(function ($row) use ($currentUserId) {
        $rowUserId = (int)$row['id'];

        if ($rowUserId != 1 && $rowUserId != $currentUserId) {
            $row['actions'] = '
            <div class="d-flex justify-content-center align-items-center">
                <button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="text-muted sr-only">Action</span>
                </button>
                <div class="dropdown-menu dropdown-menu-left">
                    <a class="dropdown-item" href="' . base_url('DashboardController/delete_user/' . $row['id']) . '">Delete</a>
                    <a class="dropdown-item" href="' . base_url('DashboardController/edit_user/' . $row['id']) . '">Edit</a>
                    <a class="dropdown-item" href="' . base_url('DashboardController/suspendre_user/' . $row['id']) . '">Suspendre</a>
                </div>
            </div>';
        } else {
            $row['actions'] = ''; // Hide the actions column for user ID 1 and current user
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
                    <a class="dropdown-item" href="#">Editer</a>
                    <a class="dropdown-item" href="#">Supprimer</a>
                    <a class="dropdown-item" href="#">Suspendre</a>
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

    public function edit_user($id)
    {
        $user = $this->UserModel->get_user_by_id($id);

        if (!$user) {
            show_404();
        }

        $is_admin_exists = $this->session->userdata('role') === 'admin';

        $data = [
            'title' => 'Modifier Utilisateur',
            'view'  => 'dashboard/edit_user',
            'user'  => $user,
            'is_admin_exists' => $is_admin_exists,
        ];

        $this->load->view('dashboard/layouts', $data);
    }
}
