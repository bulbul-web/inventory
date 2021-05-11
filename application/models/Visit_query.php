<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visit_query extends CI_Model {
    public function saveVisitorData($data){
        $this->db->insert('tbl_visit_info', $data);
    }
}