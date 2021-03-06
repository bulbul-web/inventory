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
    
    public function opening_balance_list(){
        $result = $this->db->query("SELECT * FROM tbl_opening_balance")
                        ->result();
        return $result;
    }
   
    public function fiscal_year_list(){
        $result = $this->db->query("SELECT * FROM tbl_fiscalyear")
                        ->result();
        return $result;
    }
    
    public function transaction_list(){
        $result = $this->db->query("SELECT a.*, b.TransHeadDescription FROM tbl_transactions a, tbl_transactionhead b WHERE b.TransactionHeadID = a.TrasactionHeadID  ORDER BY a.TransactionID DESC ")
                        ->result();
        return $result;
    }

    public function save_acnt_sub_head($data){
        $this->db->insert('tbl_subhead', $data);
    }
    
    public function save_opening_balance($data){
        $this->db->insert('tbl_opening_balance', $data);
    }

    public function save_acnt_sub_sub_head($data){
        $this->db->insert('tbl_subsubheads', $data);
    }
    
    public function save_acnt_tansaction_head($data){
        $this->db->insert('tbl_transactionhead', $data);
    }
    
    public function save_acnt_tansaction($data){
        $this->db->insert('tbl_transactions', $data);
    }
    
    public function save_fiscal_year($data){
        $this->db->insert('tbl_fiscalyear', $data);
    }

    public function update_fiscal_year($lastid){
        $this->db->set('status', 'Inactive');
        $this->db->where('fiscalYearID', $lastid);
        $this->db->update('tbl_fiscalyear');
    }

    public function get_sub_head_by_contrl_id($ControlHead_id){
        $result = $this->db->query("SELECT * FROM tbl_subhead WHERE ControlHead_id = '$ControlHead_id' and active = '1' ")->result();
        return $result;
    }
    
    public function get_sub_sub_head_by_subId($SubHeadID){
        $result = $this->db->query("SELECT * FROM tbl_subsubheads WHERE SubHeadID = '$SubHeadID' and active = '1' ")->result();
        return $result;
    }
    
    public function get_transaction_head_by_sub_sub_Id($SSubHeadID){
        $result = $this->db->query("SELECT * FROM tbl_transactionhead WHERE SSubHeadID = '$SSubHeadID' and active = '1' ")->result();
        return $result;
    }
    
    public function get_transaction_by_contrl_head_id($ControlHead_id){
        $result = $this->db->query("SELECT t.*, ssh.SSubHeadDescription, ssh.SubHeadID, sh.SubHeadDescription, sh.ControlHead_id, c.HeadDescription FROM tbl_transactionhead t, tbl_subsubheads ssh, tbl_subhead sh, tbl_controlhead c WHERE t.SSubHeadID = ssh.SSubHeadID AND ssh.SubHeadID = sh.SubHeadID AND c.ControlHead_id = sh.ControlHead_id AND c.ControlHead_id = '$ControlHead_id'")->result();
        return $result;
    }
    
    public function get_transaction_by_contrl_Vtype_CR(){
        $result = $this->db->query("SELECT t.*, ssh.SSubHeadDescription, ssh.SubHeadID, sh.SubHeadDescription, sh.ControlHead_id, c.HeadDescription FROM tbl_transactionhead t, tbl_subsubheads ssh, tbl_subhead sh, tbl_controlhead c WHERE t.SSubHeadID = ssh.SSubHeadID AND ssh.SubHeadID = sh.SubHeadID AND c.ControlHead_id = sh.ControlHead_id AND c.ControlHead_id IN (3, 4) ")->result();
        return $result;
    }
    
    public function get_transaction_by_contrl_Vtype_DR(){
        $result = $this->db->query("SELECT t.*, ssh.SSubHeadDescription, ssh.SubHeadID, sh.SubHeadDescription, sh.ControlHead_id, c.HeadDescription FROM tbl_transactionhead t, tbl_subsubheads ssh, tbl_subhead sh, tbl_controlhead c WHERE t.SSubHeadID = ssh.SSubHeadID AND ssh.SubHeadID = sh.SubHeadID AND c.ControlHead_id = sh.ControlHead_id AND c.ControlHead_id IN (1, 2) ")->result();
        return $result;
    }

    public function get_control_head_by_v_type_CR(){
        $result = $this->db->query("SELECT * FROM tbl_controlhead WHERE ControlHead_id IN (3, 4)")->result();
        return $result;
    }
    
    public function get_control_head_by_v_type_DR(){
        $result = $this->db->query("SELECT * FROM tbl_controlhead WHERE ControlHead_id IN (1, 2)")->result();
        return $result;
    }




}