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

    public function register_admin()
    {
        // Check if an admin already exists
        if ($this->UserModel->count_admins() > 0) {
            redirect('authController/login');
        }

        // Form validation rules
        $this->form_validation->set_rules('email', 'Email',
            'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('first_name', 'First Name',
            'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');

        if ($this->form_validation->run() === false) {
            $this->load->view('auth/register_admin');
        } else {
            $data = array(
                'email'      => $this->input->post('email'),
                'password'   => password_hash($this->input->post('password'),
                    PASSWORD_BCRYPT),
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'role'       => 'admin',
            );

            $this->UserModel->create_user($data);
            redirect('authController/login');
        }
    }

    public function register_user()
    {
        // Ensure only admin can access this method
        if ( ! $this->session->userdata('is_admin')) {
            redirect('authController/login');
        }

        // Form validation rules
        $this->form_validation->set_rules('email', 'Email',
            'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('first_name', 'First Name',
            'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');

        if ($this->form_validation->run() === false) {
            $this->load->view('auth/register_user');
        } else {
            $data = array(
                'email'      => $this->input->post('email'),
                'password'   => password_hash($this->input->post('password'),
                    PASSWORD_BCRYPT),
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'role'       => 'user',
            );

            $this->UserModel->create_user($data);
            redirect('user/dashboard');
        }
    }

    public function login()
    {
        // Form validation rules
        $this->form_validation->set_rules('email', 'Email',
            'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === false) {
            $this->load->view('auth/login');
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
                    redirect('adminController/dashboard');
                } else {
                    redirect('userController/dashboard');
                }
            } else {
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
        redirect('authController/login');
    }
}
