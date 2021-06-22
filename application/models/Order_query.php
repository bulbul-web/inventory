<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_query extends CI_Model {
    
    public function vieworder($id){
        
        $result = $this->db->query
                (
                    
                    "SELECT c.customer_name, i.*, sum(i.quantity * i.sale_price) as grandTotal"
                    . " FROM tbl_customer c, tbl_invoice i"
                    . " WHERE i.customer_id = c.customer_id AND NOT (i.delete_status <=> 'deleted') AND i.order_by = '$id'"
                    . " GROUP BY i.voucher_id"
                    . " ORDER BY i.id DESC"
                )->result();
        return $result;
    }

    public function view_salesman_order($id){
        
        $result = $this->db->query
                (
                    
                    "SELECT c.customer_name, i.*, sum(i.quantity * i.sale_price) as grandTotal"
                    . " FROM tbl_customer c, tbl_order i"
                    . " WHERE i.customer_id = c.customer_id AND NOT (i.delete_status <=> 'deleted') AND i.order_by = '$id'"
                    . " GROUP BY i.order_id"
                    . " ORDER BY i.id DESC"
                )->result();
        return $result;
    }

    public function view_salesman_reject_order($id){
        
        $result = $this->db->query
                (
                    
                    "SELECT c.customer_name, i.*, sum(i.quantity * i.sale_price) as grandTotal"
                    . " FROM tbl_customer c, tbl_order i"
                    . " WHERE i.customer_id = c.customer_id AND NOT (i.delete_status <=> 'deleted') AND i.order_by = '$id' AND i.order_status = 2"
                    . " GROUP BY i.order_id"
                    . " ORDER BY i.id DESC"
                )->result();
        return $result;
    }

    public function view_salesman_order_all(){
        $user_role = $this->session->userdata('user_role');
        $user_id = $this->session->userdata('user_id');
        if($user_role == 1):
            $result = $this->db->query
            (
                
                "SELECT c.customer_name, i.*, sum(i.quantity * i.sale_price) as grandTotal"
                . " FROM tbl_customer c, tbl_order i"
                . " WHERE i.customer_id = c.customer_id AND NOT (i.delete_status <=> 'deleted')"
                . " GROUP BY i.order_id"
                . " ORDER BY i.id DESC"
            )->result();
        elseif($user_role == 2):
            $result = $this->db->query("SELECT o.*, sum(o.quantity * o.sale_price) as grandTotal, c.customer_name, u.user_name, u.user_role, u.m_rm_s_id, s.name salesmane_name, s.regional_manager_id, s.manager_id, uu.user_name, uu.user_id as regional_manager_user_id FROM tbl_order o JOIN tbl_user u ON o.order_by = u.user_id JOIN tbl_salesman s ON u.m_rm_s_id = s.id JOIN tbl_user uu ON uu.m_rm_s_id = s.regional_manager_id JOIN tbl_customer c ON o.customer_id = c.customer_id WHERE NOT(o.delete_status <=> 'deleted') AND uu.user_role = 2 AND uu.user_id = $user_id GROUP BY o.order_id ORDER BY convert(o.order_id, decimal) DESC")->result();
        elseif($user_role == 4):
            $result = $this->db->query("SELECT o.*, sum(o.quantity * o.sale_price) as grandTotal, c.customer_name, u.user_name, u.user_role, u.m_rm_s_id, s.id, s.name, s.manager_id, s.regional_manager_id, uu.user_id, uu.user_role FROM tbl_order o JOIN tbl_user u ON u.user_id = o.order_by JOIN tbl_customer c ON o.customer_id = c.customer_id JOIN tbl_salesman s ON u.m_rm_s_id = s.id JOIN tbl_user uu ON uu.m_rm_s_id = s.manager_id WHERE NOT(o.delete_status <=> 'deleted') AND uu.user_role = 4 AND uu.user_id = $user_id GROUP BY o.order_id ORDER BY convert(o.order_id, decimal) DESC")->result();
        endif;
        return $result;
    }

    public function view_salesman_reject_order_all(){
        
        $result = $this->db->query
                (
                    
                    "SELECT c.customer_name, i.*, sum(i.quantity * i.sale_price) as grandTotal"
                    . " FROM tbl_customer c, tbl_order i"
                    . " WHERE i.customer_id = c.customer_id AND NOT (i.delete_status <=> 'deleted') AND i.order_status = 2 "
                    . " GROUP BY i.order_id"
                    . " ORDER BY i.id DESC"
                )->result();
        return $result;
    }



}