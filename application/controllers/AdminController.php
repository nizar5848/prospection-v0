<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AdminController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('UserModel');

        // Check if the user is an admin
        if ( ! $this->session->userdata('is_admin')) {
            redirect('authController/login');
        }
    }

    public function dashboard()
    {
        $data =
            [
                "title"     => 'Admin Dashboard',
                'view'      => 'dashboard/home',
                "firstname" => $this->session->userdata('first_name'),
                "lastname"  => $this->session->userdata('last_name'),

            ];

        $this->load->view('dashboard/layouts', $data);
    }


    // code for datatable
    public function usersTable()
    {
        $layout_data = [
            "title" => "Liste des utilisateurs",
            "view"  => "dashboard/users_table",
        ];

        $this->load->view('dashboard/layouts', $layout_data);
//        $this->load->view('dashboard/users_table');
    }

    public function fetchDatafromDatabase()
    {
        $resultList = $this->UserModel->fetchAllData('*', 'users', array());

        $result = array();
        $i      = 1;
        foreach ($resultList as $key => $value) {
            $result['data'][] = array(
                $i++,
                $value['first_name'],
                $value['last_name'],
                $value['email'],
                $value['role'],
            );
        }
        echo json_encode($result);
    }
}
