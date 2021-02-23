<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {
    
    public function login($user_email, $user_pass)
    {
        $this->db->where('user_email', $user_email);
        $this->db->where('user_pass', md5($user_pass));
        $this->db->where('status', 1);
        
        $query = $this->db->get('tbl_user');
        if($query->num_rows() == 1)
        {
            return $query->row();
        }
        
        return false;
    }
    
    public function user_info($id)
    {
        $userInfo = $this->db->select('*')
                                ->from('tbl_user')
                                ->where('user_id', $id)
                                ->get()
                                ->row();
        return $userInfo;   
    }
    
    
    public function update_users($img)
    {
        $data = array();
        $id = $this->input->post('user_id', TRUE);
        
        $data['user_name'] = $this->input->post('user_name', true);
        $data['user_email'] = $this->input->post('user_email', true);
        $data['file'] = $img;
        
        unset($data['status']);
        unset($data['user_pass']);
        unset($data['user_role']);
        
        $this->db->where('user_id', $id);
        $this->db->update('tbl_user', $data);
    }
    
    public function update_password($data)
    {
        $this->db->set('user_pass', $data['user_pass']);
        $this->db->where('user_id', $data['user_id']);
        $this->db->update('tbl_user');
    }
    
   public function allCustomer(){
        $result = $this->db->query("select * from tbl_customer")->result();
        return $result;
    }
    public function singleCustomer($customer_id){
        $result = $this->db->query("select * from tbl_customer where customer_id = $customer_id ")->row();
        return $result;
    }
    
    public function product_out_by_customer($customer_id, $from_date, $to_date){
        $result = $this->db->query("SELECT i.*, c.customer_name, pi.product_name, sum(i.quantity) as totalQuantity FROM tbl_invoice i, tbl_customer c, tbl_product_info pi WHERE i.customer_id = '$customer_id' AND c.customer_id = i.customer_id AND pi.product_id = i.product_id AND i.invoice_date BETWEEN '$from_date' AND '$to_date' GROUP BY i.product_id")->result();
        return $result;
    } 
    
    
}
