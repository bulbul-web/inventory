<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visit_query extends CI_Model {
    public function saveVisitorData($data){
        $this->db->insert('tbl_visit_info', $data);
    }

    public function allVisitor(){
        $result = $this->db->query("SELECT * FROM tbl_visit_info")->result();
        return $result;
    }
    public function singleVisitor($visitorId){
        $result = $this->db->query("SELECT * FROM tbl_visit_info WHERE id = '$visitorId' ")->row();
        return $result;
    }
    public function updateVisitorData($data){
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_visit_info', $data);
    }

}