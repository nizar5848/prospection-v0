<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AuthController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
    }


    public function register()
    {
        // Load the UserModel
        $this->load->model('UserModel');

        // Check if an admin already exists
        $is_admin_exists = $this->UserModel->count_admins() > 0;
        $is_admin        = ! $is_admin_exists;

        // Form validation rules
        $this->form_validation->set_rules('email', 'Email',
            'required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Password', [
                'required',
                'min_length[8]',
                'regex_match[/[0-9]/]',
                'regex_match[/[^a-zA-Z0-9]/]'
            ], [
                'regex_match' => 'The {field} must contain at least one digit and one special character.'
            ]);
        $this->form_validation->set_rules('confirm_password',
            'Confirm Password', 'required|matches[password]');
        $this->form_validation->set_rules('first_name', 'First Name',
            'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');

        if ($is_admin_exists) {
            $this->form_validation->set_rules('role', 'Role', 'required');
        }

        if ($this->form_validation->run() === false) {
            $data = [
                "title" => 'Inscription',
                "view"            => "auth/register",
                "is_admin_exists" => $is_admin_exists,
            ];
            $this->load->view("auth/layout", $data);
        } else {
            $role = $is_admin ? 'admin' : $this->input->post('role');
            $data = array(
                'email'      => $this->input->post('email'),
                'password'   => password_hash($this->input->post('password'),
                    PASSWORD_BCRYPT),
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'role'       => $role,
            );

            $this->UserModel->create_user($data);

            $redirect_url = $is_admin ? 'authController/login' : 'admin/dashboard';
            redirect($redirect_url);
        }
    }


    public function login()
    {
        $is_admin_exists = $this->UserModel->count_admins() > 0;
        // Form validation rules
        $this->form_validation->set_rules('email', 'Email',
            'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === false) {
//            $this->load->view('auth/login');
            $data = [
                "title" => 'Connexion',
                "view"            => "auth/login",
                "is_admin_exists" => $is_admin_exists,
            ];
            $this->load->view("auth/layout", $data);
        } else {
            $email    = $this->input->post('email');
            $password = $this->input->post('password');
            $user     = $this->UserModel->get_user_by_email($email);

            if ($user && password_verify($password, $user['password'])) {
                $this->session->set_userdata('email', $user['email']);
                $this->session->set_userdata('first_name', $user['first_name']);
                $this->session->set_userdata('last_name', $user['last_name']);
                $this->session->set_userdata('role', $user['role']);
                $this->session->set_userdata('is_admin',
                    $user['role'] == 'admin');

                if ($user['role'] == 'admin') {
                    redirect('admin/dashboard');
                } else {
                    redirect('user/dashboard');
                }
            } else {
                echo "error login";
                $this->session->set_flashdata('error',
                    'Invalid email or password');
                redirect('authController/login');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata([
            'email', 'first_name', 'last_name', 'role', 'is_admin',
        ]);
        $this->session->sess_destroy();
        redirect('login');
    }
}
