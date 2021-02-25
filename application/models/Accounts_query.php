<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts_query extends CI_Model {
    
    public function account_sub_head_list(){
        $result = $this->db->query("SELECT * FROM tbl_subhead")
                        ->result();
        return $result;
    }
    public function account_sub_sub_head_list(){
        $result = $this->db->query("SELECT * FROM tbl_subsubheads")
                        ->result();
        return $result;
    }
    
    public function account_tansaction_head_list(){
        $result = $this->db->query("SELECT * FROM tbl_transactionhead")
                        ->result();
        return $result;
    }
   
    public function fiscal_year_list(){
        $result = $this->db->query("SELECT * FROM tbl_fiscalyear")
                        ->result();
        return $result;
    }

    public function save_acnt_sub_head($data){
        $this->db->insert('tbl_subhead', $data);
    }

    public function save_acnt_sub_sub_head($data){
        $this->db->insert('tbl_subsubheads', $data);
    }
    
    public function save_acnt_tansaction_head($data){
        $this->db->insert('tbl_transactionhead', $data);
    }
    
    public function save_fiscal_year($data){
        $this->db->insert('tbl_fiscalyear', $data);
    }

    public function get_sub_head_by_contrl_id($ControlHead_id){
        $result = $this->db->query("SELECT * FROM tbl_subhead WHERE ControlHead_id = '$ControlHead_id' and active = '1' ")->result();
        return $result;
    }
    
    public function get_sub_sub_head_by_subId($SubHeadID){
        $result = $this->db->query("SELECT * FROM tbl_subsubheads WHERE SubHeadID = '$SubHeadID' and active = '1' ")->result();
        return $result;
    }


}