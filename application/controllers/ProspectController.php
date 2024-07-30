<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ProspectController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProspectModel'); // Load the ProspectModel
        $this->load->library('form_validation'); // Load the form_validation library
        $this->load->library('PHPExcel');
        $this->load->model('NoteModel');
        $this->load->helper('date'); // Load the date helper

    }

    public function registerProspect()
    {
        $data = [
            "title"         => "Liste des utilisateurs",
            "view"          => "dashboard/register_prospect",
            'pending_count' => $this->session->userdata('pending_count'),
        ];

        $this->load->view('dashboard/layouts', $data);
    }

    public function register()
    {
        // Validate form input
        $this->form_validation->set_rules('first_name', 'Prénom', 'required');
        $this->form_validation->set_rules('last_name', 'Nom', 'required');
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
        $this->form_validation->set_rules('company', 'Entreprise', 'required');
        $this->form_validation->set_rules('phone_number', 'Numéro téléphone', 'required');
        $this->form_validation->set_rules('address', 'Adresse', 'required');

        if ($this->form_validation->run() === false) {
            // Form validation failed, show errors or handle accordingly
            $this->load->view('registration_form'); // Replace with your view name
        } else {
            // Form validation succeeded, proceed to insert into database
            $data = array(
                'first_name'             => $this->input->post('first_name'),
                'last_name'              => $this->input->post('last_name'),
                'email'                  => $this->input->post('email'),
                'company'                => $this->input->post('company'),
                'phone_number'           => $this->input->post('phone_number'),
                'address'                => $this->input->post('address'),
                'status'                 => 'nouveau', // Default status as per your enum
                'historiqueInteractions' => '', // You may handle this field as needed
            );

            // Call the model to insert data
            if ($this->ProspectModel->insert_prospect($data)) {
                // Successfully inserted
                redirect('dashboard'); // Replace with your redirect URL
            } else {
                // Insertion failed, handle error
                $this->load->view('registration_form', $data); // Replace with your view name
            }
        }
    }

    public function edit_prospect($id)
    {
        // Validate form input
        $this->form_validation->set_rules('first_name', 'Prénom', 'required');
        $this->form_validation->set_rules('last_name', 'Nom', 'required');
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
        $this->form_validation->set_rules('company', 'Entreprise', 'required');
        $this->form_validation->set_rules('phone_number', 'Numéro téléphone', 'required');
        $this->form_validation->set_rules('address', 'Adresse', 'required');

        // Load user data (assuming you have a way to get the current user)
        $user = $this->session->userdata('user'); // Adjust this as per your application

        if ($this->form_validation->run() === false) {
            // Form validation failed, load the form again with errors
            $data = [

                'title'         => 'Modifier Prospects',
                'view'          => 'dashboard/edit_prospect',
                'user'          => $user,
                'prospects'     => $this->ProspectModel->get_prospect($id),
                'pending_count' => $this->session->userdata('pending_count'),
                'title'         => 'Modifier Prospects',
                'view'          => 'dashboard/edit_prospect',
                'user'          => $user,
                'prospects'     => $this->ProspectModel->get_prospect($id),
                'pending_count' => $this->session->userdata('pending_count'),


            ];
            $this->load->view('dashboard/layouts', $data);
        } else {
            // Form validation succeeded, proceed to update the database
            $data = array(
                'first_name'             => $this->input->post('first_name'),
                'last_name'              => $this->input->post('last_name'),
                'email'                  => $this->input->post('email'),
                'company'                => $this->input->post('company'),
                'phone_number'           => $this->input->post('phone_number'),
                'address'                => $this->input->post('address'),
                'status'                 => 'nouveau', // Update status if needed
                'historiqueInteractions' => '', // Update this field as needed

            );

            // Call the model to update data
            if ($this->ProspectModel->update_prospect($id, $data)) {
                // Successfully updated
                redirect('table-prospects-globale'); // Replace with your redirect URL
            } else {
                // Update failed, handle error
                $data = [
                    'title'     => 'Modifier Prospects',
                    'view'      => 'dashboard/edit_prospect',
                    'user'      => $user,
                    'prospects' => $this->ProspectModel->get_prospect($id),
                    'error'     => 'Failed to update prospect',

                ];
                $this->load->view('dashboard/layouts', $data);
            }
        }
    }

    public function consult_prospect($id)
    {
        // Make sure to check if $id is provided
        if (empty($id)) {
            show_404();
        }

        $prospect = $this->ProspectModel->get_prospect_consult($id);

        if (empty($prospect)) {
            show_404();
        }

        $user  = $this->session->userdata('user'); // Adjust this as per your application
        $notes = $this->NoteModel->get_notes_by_prospect($id);

        $data = [
            'title'         => 'Consulter Prospect',
            'view'          => 'dashboard/consulter_prospect',
            'user'          => $user,
            'prospect'      => $prospect,
            'notes'         => $notes,
            'pending_count' => $this->session->userdata('pending_count'),

        ];

        $this->load->view('dashboard/layouts', $data);
    }


    public function delete_prospect($id)
    {
        if ($this->ProspectModel->delete_user_by_id($id)) {
            $this->session->set_flashdata('success', 'User deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete user.');
        }
        redirect('table-prospects');
    }

    public function selectProspects()
    {
        // Assuming you have some way to get the current user, possibly from the session
        $user = $this->session->userdata('user');

        // Get the number of prospects and status from POST data
        $numberOfProspects = $this->input->post('number_of_prospects');
        $status            = $this->input->post('status');

        // Call the model to fetch the prospects based on the criteria
        $prospects = $this->ProspectModel->fetchProspects($status, $numberOfProspects);

        // Update the 'active' column for selected prospects
        $this->ProspectModel->updateActiveProspects($numberOfProspects, $status);

        // Prepare data for the view
        $data = [
            'title'     => 'Prospects',
            'view'      => 'dashboard/prospects_table',
            'user'      => $user,
            'prospects' => $prospects,
        ];

        // Load the view with the data
        $this->load->view('dashboard/layouts', $data);
    }

    public function active_prospects()
    {
        $active_prospects = $this->ProspectModel->get_active_prospects();

        $data = [
            'title'            => 'Prospects à  contacter',
            'view'             => 'dashboard/prospects_a_contacter',
            'active_prospects' => $active_prospects,
            'pending_count'    => $this->session->userdata('pending_count'),
        ];

        $this->load->view('dashboard/layouts', $data);
    }

    public function change_status($id)
    {
        // Load the model
        $this->load->model('ProspectModel');

        // Get the status from the form
        $status = $this->input->post('status');

        // Update the prospect status in the database
        $this->ProspectModel->update_status($id, $status);

        // Redirect to a success page or back to the prospect details
        redirect(base_url('ProspectController/consult_prospect/'.$id.'?source=contact'));
    }

    public function close_call($id)
    {
        // Load the model
        $this->load->model('ProspectModel');

        // Update the prospect's active status to 0
        $this->ProspectModel->set_active_status($id, 0);

        // Redirect to a success page or back to the prospect details
        redirect('ProspectController/active_prospects/'.$id);
    }

    public function exportToExcel()
    {
        // Fetch prospects data
        $prospects = $this->ProspectModel->get_all_prospects();

        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

        // Set document properties
        $objPHPExcel->getProperties()->setCreator("Your Name")
            ->setLastModifiedBy("Your Name")
            ->setTitle("Prospects Export")
            ->setSubject("Prospects Export")
            ->setDescription("Export of prospects data.")
            ->setKeywords("prospects export phpexcel")
            ->setCategory("Export");

        // Add header
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ID')
            ->setCellValue('B1', 'Nom')
            ->setCellValue('C1', 'Prénom')
            ->setCellValue('D1', 'Email')
            ->setCellValue('E1', 'Entreprise')
            ->setCellValue('F1', 'Téléphone')
            ->setCellValue('G1', 'Adresse')
            ->setCellValue('H1', 'Statut');

        // Add data
        $row = 2;
        foreach ($prospects as $prospect) {
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$row, $prospect->id)
                ->setCellValue('B'.$row, $prospect->last_name)
                ->setCellValue('C'.$row, $prospect->first_name)
                ->setCellValue('D'.$row, $prospect->email)
                ->setCellValue('E'.$row, $prospect->company)
                ->setCellValue('F'.$row, $prospect->phone_number)
                ->setCellValue('G'.$row, $prospect->address)
                ->setCellValue('H'.$row, $prospect->status);
            $row++;
        }

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Prospects');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="prospects.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }

    public function importFromExcel()
    {
        if (isset($_FILES['excel_file']['name']) && $_FILES['excel_file']['name'] != '') {
            $path        = $_FILES['excel_file']['tmp_name'];
            $objPHPExcel = PHPExcel_IOFactory::load($path);

            $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
            $data      = array();
            /*$get_last = $this->db->query('SELECT id FROM prospects ORDER BY id DESC')->row(0);
            var_export( $get_last);*/
            foreach ($sheetData as $row) {
                if ($row['A'] != 'ID') {
                    $data[] = array(
                        'last_name'    => $row['B'],
                        'first_name'   => $row['C'],
                        'email'        => $row['D'],
                        'company'      => $row['E'],
                        'phone_number' => $row['F'],
                        'address'      => $row['G'],
                        'status'       => $row['H'],
                    );
                }
            }

            if ( ! empty($data)) {
                $this->ProspectModel->insert_batch($data);
            }

            redirect('table-prospects');
        } else {
            echo "Please upload a file.";
        }
    }

    public function selectProspect($id)
    {
        // Update the active column to 1 for the given ID
        $updateStatus = $this->ProspectModel->updateActiveStatus($id, 1);

        if ($updateStatus) {
            // Optionally, you can set a success message and redirect
            $this->session->set_flashdata('success', 'Prospect updated successfully!');
        } else {
            // Optionally, you can set an error message and redirect
            $this->session->set_flashdata('error', 'Failed to update prospect.');
        }

        // Redirect to a relevant page, such as the list of prospects
        redirect('table-prospects');
    }

    public function add_note($prospect_id)
    {
        $user_id   = $this->session->userdata('id');
        $note_text = $this->input->post('note');

        $data = array(
            'user_id'     => $user_id,
            'prospect_id' => $prospect_id,
            'text'        => $note_text,
            'created_at'  => date('Y-m-d H:i:s'),
        );

        $this->NoteModel->insert_note($data);

        // Corrected redirect
        redirect(base_url('ProspectController/consult_prospect/'.$prospect_id.'?source=contact'));
    }

    public function delete_note($note_id)
    {
        $prospect_id = $this->NoteModel->get_prospect_id_by_note_id($note_id);
        $this->NoteModel->delete_note_by_id($note_id);

        // Corrected redirect
        redirect(base_url('ProspectController/consult_prospect/'.$prospect_id.'?source=contact'));
    }


}

?>
