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
    // Charger le modèle UserModel
    $this->load->model('UserModel');

    // Vérifier si un administrateur existe déjà
    $is_admin_exists = $this->UserModel->count_admins() > 0;
    $is_admin = !$is_admin_exists;

    // Règles de validation du formulaire
    $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|is_unique[users.email]', [
        'is_unique' => 'Cette adresse e-mail est déjà enregistrée.'
    ]);
    $this->form_validation->set_rules('password', 'Mot de passe', [
        'required',
        'min_length[8]',
        'regex_match[/[0-9]/]',
        'regex_match[/[^a-zA-Z0-9]/]',
    ], [
        'required' => 'Le champ Mot de passe est obligatoire.',
        'min_length' => 'Le champ Mot de passe doit comporter au moins 8 caractères.',
        'regex_match' => 'Le mot de passe doit contenir au moins un chiffre et un caractère spécial.',
    ]);
    $this->form_validation->set_rules('confirm_password', 'Confirmez le mot de passe', 'required|matches[password]', [
        'matches' => 'Le champ de confirmation du mot de passe ne correspond pas au champ Mot de passe.'
    ]);
    $this->form_validation->set_rules('first_name', 'Prénom', 'required', [
        'required' => 'Le champ Prénom est obligatoire.'
    ]);
    $this->form_validation->set_rules('last_name', 'Nom', 'required', [
        'required' => 'Le champ Nom est obligatoire.'
    ]);

    if ($is_admin_exists) {
        $this->form_validation->set_rules('role', 'Rôle', 'required', [
            'required' => 'Le champ Rôle est obligatoire.'
        ]);
    }

    if ($this->form_validation->run() === false) {
        $data = [
            "title" => 'Inscription',
            "view" => "auth/register",
            "is_admin_exists" => $is_admin_exists,
        ];
        $this->load->view("auth/layout", $data);
    } else {
        $role = $is_admin ? 'admin' : ($this->input->post('role') ?? 'user');

        $user_data = [
            'email' => $this->input->post('email'),
            'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'role' => $role,
        ];

        if ($this->UserModel->create_user($user_data)) {
            $this->session->set_flashdata('success', 'Inscription réussie. Vous pouvez maintenant vous connecter.');
        } else {
            $this->session->set_flashdata('error', 'Un problème est survenu lors de la création de votre compte. Veuillez réessayer.');
        }

        $redirect_url = $is_admin ? 'authController/login' : 'dashboard';
        redirect($redirect_url);
    }
}



    public function login()
    {
        $is_admin_exists = $this->UserModel->count_admins() > 0;

        // Form validation rules
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === false) {
            $data = [
                "title"           => 'Connexion',
                "view"            => "auth/login",
                "is_admin_exists" => $is_admin_exists,
            ];
            $this->load->view("auth/layout", $data);
        } else {
            $email    = $this->input->post('email');
            $password = $this->input->post('password');
            $user     = $this->UserModel->get_user_by_email($email);

            if ($user) {
                if ($user['suspended'] == 1) {
                    // Check if the user is suspended
                    $this->session->set_flashdata('error', 'Votre compte est suspendu.');
                    redirect('authController/login');
                } elseif (password_verify($password, $user['password'])) {
                    $this->session->set_userdata([
                        'id'         => $user['id'],
                        'email'      => $user['email'],
                        'first_name' => $user['first_name'],
                        'last_name'  => $user['last_name'],
                        'role'       => $user['role'],
                        'is_admin'   => $user['role'] == 'admin',
                        'auth'       => true,
                    ]);
                    redirect('dashboard');
                } else {
                    $this->session->set_flashdata('error', 'Invalid email or password');
                    redirect('authController/login');
                }
            } else {
                $this->session->set_flashdata('error', 'Invalid email or password');
                redirect('authController/login');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata([
            'email', 'first_name', 'last_name', 'role', 'is_admin', 'auth',
        ]);
        $this->session->sess_destroy();
        redirect('login');
    }
}
