<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UserController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('UserModel');

        if ($this->session->userdata('is_admin')) {
            redirect('authController/login');
        }

    }

    public function dashboard_user()
    {
        $data =
            [
                "title"     => 'User Dashboard',
                'view'      => 'dashboard_user/home_user',
                "firstname" => $this->session->userdata('first_name'),
                "lastname"  => $this->session->userdata('last_name'),

            ];

        $this->load->view('dashboard_user/layout_user', $data);
    }

    public function register_prospect()
    {
        $data =
            [
                "title"     => 'Création d\'un nouveau prospect',
                'view'      => 'dashboard_user/register_prospect',


            ];

        $this->load->view('dashboard_user/layout_user', $data);
    }


    // code for datatable
    public function prospectsTable()
    {
        $layout_data = [
            "title" => "Liste des prospects",
            "view"  => "dashboard_user/prospects_table",
        ];

        $this->load->view('dashboard_user/layout_user', $layout_data);

    }

    public function fetchDatafromDatabase()
    {
        $query = $this->db->get('prospects');
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
