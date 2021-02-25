<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts_query extends CI_Model {
    
    public function account_sub_head_list(){
        $result = $this->db->query("SELECT * FROM tbl_subhead")
                        ->result();
        return $result;
    }


    public function save_acnt_sub_head($data){
        $this->db->insert('tbl_subhead', $data);
    }


}