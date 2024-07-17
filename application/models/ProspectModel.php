<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProspectModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Load database library if not loaded already
    }

    public function insert_prospect($data) {
        return $this->db->insert('prospects', $data); // Assuming 'prospects' is your table name
    }

}
?>
