<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AdminController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');

        // Check if the user is an admin
        if ( ! $this->session->userdata('is_admin')) {
            redirect('authController/login');
        }
    }

    public function dashboard()
    {
        $data = 
        [
            'view' => 'dashboard/table_content',
        ];

        $this->load->view('dashboard/layouts', $data);
        
    }

    // Other admin methods
}
