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
        $this->load->model('UserModel');
        $this->load->helper('date'); // Load the date helper

    }

    public function registerProspect()
    {
        $data = [
            "title"         => "Créer un prospect",
            "view"          => "dashboard/register_prospect",
            'pending_count' => $this->session->userdata('pending_count'),
        ];

        $this->load->view('dashboard/layouts', $data);
    }

    public function register()
    {
        $this->form_validation->set_rules('first_name', 'Prénom', 'required', [
            'required' => 'Le champ Prénom est obligatoire.',
        ]);
        $this->form_validation->set_rules('last_name', 'Nom', 'required', [
            'required' => 'Le champ Nom est obligatoire.',
        ]);
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email', [
            'required'    => 'Le champ E-mail est obligatoire.',
            'valid_email' => 'Veuillez fournir une adresse e-mail valide.',
        ]);
        $this->form_validation->set_rules('company', 'Entreprise', 'required', [
            'required' => 'Le champ Entreprise est obligatoire.',
        ]);
        $this->form_validation->set_rules('ville', 'Ville', 'required', [
            'required' => 'Le champ Ville est obligatoire.',
        ]);
        $this->form_validation->set_rules('address', 'Adresse', 'required', [
            'required' => 'Le champ Adresse est obligatoire.',
        ]);

        // Validate phone numbers
        $phone_numbers = $this->input->post('phone_number');
        if (empty($phone_numbers) || ! is_array($phone_numbers)) {
            $this->form_validation->set_rules('phone_number[]', 'Numéros de téléphone', 'required', [
                'required' => 'Le champ Numéros de téléphone est obligatoire.',
            ]);
        }

        // Validate interests
//        $interets = $this->input->post('interets');
//        if (empty($interets) || ! is_array($interets)) {
//            $this->form_validation->set_rules('interets[]', 'Intérêts', 'required', [
//                'required' => 'Le champ Intérêts est obligatoire.',
//            ]);
//        }

        if ($this->form_validation->run() === false) {
            $data = [
                'title'             => 'Créer un nouveau prospect',
                'is_admin_exists'   => $this->UserModel->count_admins() > 0,
                'validation_errors' => validation_errors(),
            ];
            $this->load->view('dashboard/register_prospect', $data);
        } else {
            $prospect_data = [
                'first_name'    => $this->input->post('first_name'),
                'last_name'     => $this->input->post('last_name'),
                'email'         => $this->input->post('email'),
                'company'       => $this->input->post('company'),
                'phone_numbers' => json_encode($this->input->post('phone_number')), // Store phone numbers as JSON
                'ville'         => $this->input->post('ville'),
                'address'       => $this->input->post('address'),
                'interets'      => json_encode($this->input->post('interets')), // Store interests as JSON
                'status'        => 'nouveau', // Default status
                'assigned_to'   => $this->session->userdata('id'), // Set the assigned_to field
            ];

            if ($this->ProspectModel->insert_prospect($prospect_data)) {
                $this->session->set_flashdata('success', 'Le prospect a été ajouté avec succès.');
                redirect('register-prospect');
            } else {
                $this->session->set_flashdata('error',
                    'Un problème est survenu lors de l\'ajout du prospect. Veuillez réessayer.');
                $data = [
                    'title'             => 'Créer un nouveau prospect',
                    'is_admin_exists'   => $this->UserModel->count_admins() > 0,
                    'validation_errors' => validation_errors(),
                ];
                $this->load->view('dashboard/register_prospect', $data);
            }
        }
    }

    public function edit_prospect($id)
    {
        $this->load->library('form_validation');
        $this->load->model('ProspectModel');
        $this->load->model('UserModel');

        $this->form_validation->set_rules('first_name', 'Prénom', 'required');
        $this->form_validation->set_rules('last_name', 'Nom', 'required');
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
        $this->form_validation->set_rules('company', 'Entreprise', 'required');
        $this->form_validation->set_rules('ville', 'Ville', 'required');
        $this->form_validation->set_rules('address', 'Adresse', 'required');

        $phone_numbers = $this->input->post('phone_number');
        if (empty($phone_numbers) || ! is_array($phone_numbers)) {
            $this->form_validation->set_rules('phone_number[]', 'Numéros de téléphone', 'required');
        }

        $this->form_validation->set_rules('assigned_to', 'Assigné à', 'required|integer');

        $user = $this->session->userdata('user');

        if ($this->form_validation->run() === false) {
            $prospect  = $this->ProspectModel->get_prospect($id);
            $users     = $this->UserModel->get_all_users();
            $interests = $this->ProspectModel->get_interests_list($id); // Get the interests list
            $data      = [
                'title'         => 'Modifier Prospect',
                'view'          => 'dashboard/edit_prospect',
                'user'          => $user,
                'prospect'      => $prospect,
                'users'         => $users,
                'interests'     => $interests,
                'pending_count' => $this->session->userdata('pending_count'),
            ];
            $this->load->view('dashboard/layouts', $data);
        } else {
            $data = [
                'first_name'    => $this->input->post('first_name'),
                'last_name'     => $this->input->post('last_name'),
                'email'         => $this->input->post('email'),
                'company'       => $this->input->post('company'),
                'phone_numbers' => json_encode($this->input->post('phone_number')),
                'ville'         => $this->input->post('ville'),
                'address'       => $this->input->post('address'),
                'assigned_to'   => $this->input->post('assigned_to'),
                'interets'      => json_encode($this->input->post('interets')), // Update interests
                'status'        => 'nouveau',
            ];

            if ($this->ProspectModel->update_prospect($id, $data)) {
                $this->session->set_flashdata('success', 'Le prospect a été modifié avec succès!');
                redirect('table-prospects-globale');
            } else {
                $prospect  = $this->ProspectModel->get_prospect($id);
                $users     = $this->UserModel->get_all_users();
                $interests = $this->ProspectModel->get_interests_list($id); // Get the interests list
                $data      = [
                    'title'     => 'Modifier Prospect',
                    'view'      => 'dashboard/edit_prospect',
                    'user'      => $user,
                    'prospect'  => $prospect,
                    'users'     => $users,
                    'interests' => $interests,
                    'error'     => 'Échec de la modification du prospect',
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

        // Load the models
        $this->load->model('ProspectModel');
        $this->load->model('NoteModel');
        $this->load->model('UserModel'); // Load the UserModel to fetch user details

        // Get the prospect details
        $prospect = $this->ProspectModel->get_prospect_consult($id);

        if (empty($prospect)) {
            show_404();
        }

        // Fetch user details if assigned_to is set
        if ( ! empty($prospect->assigned_to)) {
            $assignedUser            = $this->UserModel->get_user_by_id($prospect->assigned_to);
            $prospect->assigned_user = $assignedUser; // Attach user details to prospect
        } else {
            $prospect->assigned_user = null; // No user assigned
        }

        // Get notes related to the prospect
        $notes = $this->NoteModel->get_notes_by_prospect($id);

        // Get user data from session
        $user = $this->session->userdata('user');

        // Prepare data for the view
        $data = [
            'title'         => 'Consulter Prospect',
            'view'          => 'dashboard/consulter_prospect',
            'user'          => $user,
            'prospect'      => $prospect,
            'notes'         => $notes,
            'pending_count' => $this->session->userdata('pending_count'),
        ];
        // Load the layout view
        $this->load->view('dashboard/layouts', $data);
    }


    public function delete_prospect($id)
    {
        // Delete related notes first
        if ($this->ProspectModel->delete_notes_by_prospect_id($id)) {
            if ($this->ProspectModel->delete_user_by_id($id)) {
                $this->session->set_flashdata('success', 'Utilisateur supprimé avec succès.');
            } else {
                $this->session->set_flashdata('error', 'Impossible de supprimer utilisateur.');
            }
        } else {
            $this->session->set_flashdata('error', 'Impossible de supprimer les notes associées.');
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

        // Ensure the inputs are valid
        if ( ! is_numeric($numberOfProspects) || empty($status)) {
            // Set an error flash message
            $this->session->set_flashdata('error', 'Veuiller choisir le nombre et la statut des prospects');
            redirect('table-prospects');

            return;
        }

        // Call the model to fetch the prospects based on the criteria
        $prospects = $this->ProspectModel->fetchProspects($status, $numberOfProspects);

        // Check if any prospects were found
        if (empty($prospects)) {
            $this->session->set_flashdata('error', 'No prospects found for the given criteria.');
            redirect('table-prospects');

            return;
        }

        // Update the 'active' column for selected prospects
        $this->ProspectModel->updateActiveProspects($numberOfProspects, $status);

        // Set a flash message for success
        $this->session->set_flashdata('success', 'Les prospects sont  ajoutés au contact avec succès.');

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

        // Set a session flashdata to indicate the call has ended
        $this->session->set_flashdata('call_ended', 'L\'appel a été clôturé avec succès.');

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
            ->setCellValue('G1', 'Ville')
            ->setCellValue('H1', 'Adresse')
            ->setCellValue('I1', 'Statut')
            ->setCellValue('J1', 'Interets');

        // Add data
        $row = 2;
        foreach ($prospects as $prospect) {
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$row, $prospect->id)
                ->setCellValue('B'.$row, $prospect->last_name)
                ->setCellValue('C'.$row, $prospect->first_name)
                ->setCellValue('D'.$row, $prospect->email)
                ->setCellValue('E'.$row, $prospect->company)
                ->setCellValue('F'.$row, $prospect->phone_numbers)
                ->setCellValue('G'.$row, $prospect->ville)
                ->setCellValue('H'.$row, $prospect->address)
                ->setCellValue('I'.$row, $prospect->status)
                ->setCellValue('J'.$row, $prospect->interets);
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

            foreach ($sheetData as $row) {
                if ($row['A'] != 'ID') {
                    $data[] = array(
                        'last_name'     => $row['B'],
                        'first_name'    => $row['C'],
                        'email'         => $row['D'],
                        'company'       => $row['E'],
                        'phone_numbers' => $row['F'],
                        'ville'         => $row['G'],
                        'address'       => $row['H'],
                        'status'        => $row['I'],
                        'interets'      => $row['J'],
                    );
                }
            }

            if ( ! empty($data)) {
                $this->ProspectModel->insert_batch($data);
                $this->session->set_flashdata('success', 'La table excel est importé avec succès!');
            } else {
                $this->session->set_flashdata('warning', 'Pas de fichier excel selectioné.');
            }

            redirect('table-prospects');
        } else {
            $this->session->set_flashdata('error', 'Veuillez choisir un fichier excel.');
            redirect('table-prospects');
        }
    }


    public function selectProspect($id)
    {
        // Retrieve the current status of the prospect
        $currentStatus = $this->ProspectModel->getProspectStatus($id);

        if ($currentStatus == 1) {
            // Prospect is already active
            $this->session->set_flashdata('warning', 'Ce prospect est déjà ajouté au contact!');
        } else {
            // Update the active column to 1 for the given ID
            $updateStatus = $this->ProspectModel->updateActiveStatus($id, 1);

            if ($updateStatus) {
                // Set a success message
                $this->session->set_flashdata('success', 'Ce prospect est ajouté au contact avec succès!');
            } else {
                // Set an error message
                $this->session->set_flashdata('error', 'Failed to update prospect.');
            }
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
