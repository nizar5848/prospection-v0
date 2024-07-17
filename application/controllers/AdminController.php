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
        $query = $this->db->get('users');
        $data  = $query->result_array();

        // Format the data to include an 'actions' field
        $formattedData = array_map(function ($row) {
            $row['actions'] = '
                           
            <div class="d-flex justify-content-center align-items-center" >
            
    <button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="text-muted sr-only">Action</span>
    </button>
    <div class="dropdown-menu dropdown-menu-left">
        <a class="dropdown-item" href="#">Editer</a>
        <a class="dropdown-item" href="#">Supprimer</a>
        <a class="dropdown-item" href="#">Suspendre</a>
</div>               
    </div';

            return $row;
        }, $data);

        echo json_encode(['data' => $formattedData]);
    }
}
