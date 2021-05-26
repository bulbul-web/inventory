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
        
        $result = $this->db->query
                (
                    
                    "SELECT c.customer_name, i.*, sum(i.quantity * i.sale_price) as grandTotal"
                    . " FROM tbl_customer c, tbl_order i"
                    . " WHERE i.customer_id = c.customer_id AND NOT (i.delete_status <=> 'deleted')"
                    . " GROUP BY i.order_id"
                    . " ORDER BY i.id DESC"
                )->result();
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