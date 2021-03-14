<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts_query extends CI_Model {
    
    public function account_sub_head_list(){
        $result = $this->db->query("SELECT a.*, b.HeadDescription FROM tbl_subhead a, tbl_controlhead b WHERE a.ControlHead_id = b.ControlHead_id ORDER BY b.HeadDescription ASC")
                        ->result();
        return $result;
    }
    public function account_sub_sub_head_list(){
        $result = $this->db->query("SELECT a.*, b.SubHeadDescription, b.ControlHead_id, c.HeadDescription, c.ControlHead_id FROM tbl_subsubheads a, tbl_subhead b, tbl_controlhead c WHERE a.SubHeadID = b.SubHeadID AND c.ControlHead_id = b.ControlHead_id ORDER BY c.HeadDescription ASC")
                        ->result();
        return $result;
    }
    
    public function account_tansaction_head_list(){
        $result = $this->db->query("SELECT a.*, b.SSubHeadDescription, c.SubHeadDescription, d.HeadDescription FROM tbl_transactionhead a, tbl_subsubheads b, tbl_subhead c, tbl_controlhead d WHERE a.SSubHeadID = b.SSubHeadID AND a.SubHeadID = c.SubHeadID AND c.ControlHead_id = d.ControlHead_id ORDER BY d.HeadDescription ASC")
                        ->result();
        return $result;
    }
    
    public function opening_balance_list(){
        $result = $this->db->query("SELECT a.*, b.TransactionHeadID, b.TransHeadDescription, b.SSubHeadID, c.SSubHeadDescription, c.SubHeadID, d.SubHeadDescription, d.ControlHead_id, e.HeadDescription FROM tbl_opening_balance a, tbl_transactionhead b, tbl_subsubheads c, tbl_subhead d, tbl_controlhead e WHERE b.TransactionHeadID = a.TransactionHeadID AND b.SSubHeadID = c.SSubHeadID AND c.SubHeadID = d.SubHeadID AND e.ControlHead_id = d.ControlHead_id ORDER BY e.HeadDescription ASC")
                        ->result();
        return $result;
    }
   
    public function fiscal_year_list(){
        $result = $this->db->query("SELECT * FROM tbl_fiscalyear")
                        ->result();
        return $result;
    }
    
    public function transaction_list(){
        $result = $this->db->query("SELECT a.*, sum(a.CR) as totalCR, sum(a.DR) as totalDR, b.TransHeadDescription FROM tbl_transactions a, tbl_transactionhead b WHERE b.TransactionHeadID = a.TrasactionHeadID AND NOT (a.delete_status <=> 'deleted') GROUP BY a.VoucherNo ORDER BY a.TransactionID DESC")
                        ->result();
        return $result;
    }
   
    public function journal_transaction_list(){
        $result = $this->db->query("SELECT a.*, sum(a.CR) as totalCR, sum(a.DR) as totalDR, b.TransHeadDescription FROM tbl_transactions a, tbl_transactionhead b WHERE b.TransactionHeadID = a.TrasactionHeadID AND NOT (a.delete_status <=> 'deleted') AND a.V_type = 'JR' GROUP BY a.VoucherNo ORDER BY a.TransactionID DESC")
                        ->result();
        return $result;
    }
    
    public function transaction_list_without_journal(){
        $result = $this->db->query("SELECT a.*, sum(a.CR) as totalCR, sum(a.DR) as totalDR, b.TransHeadDescription FROM tbl_transactions a, tbl_transactionhead b WHERE b.TransactionHeadID = a.TrasactionHeadID AND NOT (a.delete_status <=> 'deleted') AND NOT (a.V_type <=> 'JR') GROUP BY a.VoucherNo ORDER BY a.TransactionID DESC")
                        ->result();
        return $result;
    }

    public function transaction_Acnt_Row($VoucherNo){
        $result = $this->db->query("SELECT a.*, sum(a.CR) as totalCR, sum(a.DR) as totalDR, b.TransHeadDescription FROM tbl_transactions a, tbl_transactionhead b WHERE b.TransactionHeadID = a.TrasactionHeadID AND a.VoucherNo = '$VoucherNo' AND NOT (a.delete_status <=> 'deleted') GROUP BY a.VoucherNo ORDER BY a.TransactionID DESC")
                        ->row();
        return $result;
    }
    
    public function transaction_Acnt_Result($VoucherNo){
        $result = $this->db->query("SELECT a.*, b.TransHeadDescription FROM tbl_transactions a, tbl_transactionhead b WHERE a.TrasactionHeadID = b.TransactionHeadID AND a.VoucherNo = '$VoucherNo' AND NOT (a.delete_status <=> 'deleted') ")
                        ->result();
        return $result;
    }
    
    public function transaction_Acnt_Result_wth_ot_cntr_hd($VoucherNo){
        $result = $this->db->query("SELECT a.*, b.TransHeadDescription FROM tbl_transactions a, tbl_transactionhead b WHERE a.TrasactionHeadID = b.TransactionHeadID AND a.VoucherNo = '$VoucherNo' AND NOT (a.checkControlHead <=> '1') AND NOT (a.delete_status <=> 'deleted') ")
                        ->result();
        return $result;
    }

    public function save_acnt_sub_head($data){
        $this->db->insert('tbl_subhead', $data);
    }

    public function sub_head_single($SubHeadID){
        $result = $this->db->query("SELECT * FROM tbl_subhead WHERE SubHeadID = '$SubHeadID' ")->row();
        return $result;
    }

    public function update_acnt_sub_head($data){
        $this->db->where('SubHeadID', $data['SubHeadID']);
        $this->db->update('tbl_subhead', $data);
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

    public function viewAllTransactionHeadMatch($trns_head_name){
        $result = $this->db->query
                (
                
                "SELECT * FROM tbl_transactionhead WHERE TransHeadDescription LIKE '%".$trns_head_name."%' AND active = 1 GROUP BY tbl_transactionhead.TransactionHeadID "
                )->result();
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


    public function delete_tansaction_status($TransactionID){
        $this->db->set('status', '0');
        $this->db->set('delete_status', 'deleted');
        $this->db->where('TransactionID', $TransactionID);
        $this->db->update('tbl_transactions');
    }




}