<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UserController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');

        // Check if the user is logged in
        if ( ! $this->session->userdata('email')) {
            redirect('authController/login');
        }
    }

    public function dashboard()
    {
        $this->load->view('user/dashboard');
    }

    // Other user methods
}
