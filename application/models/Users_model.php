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
    
    public function single_user($user_id)
    {
        $userInfo = $this->db->select('*')
                                ->from('tbl_user')
                                ->where('user_id', $user_id)
                                ->get()
                                ->row();
        return $userInfo;   
    }

    public function save_user($data){
        $this->db->insert("tbl_user", $data);
    }

    public function save_manager($data){
        $this->db->insert("tbl_manager", $data);
    }

    public function save_regional_manager($data){
        $this->db->insert("tbl_regional_manager", $data);
    }

    public function save_salesman($data){
        $this->db->insert("tbl_salesman", $data);
    }

    public function update_user($data){
        $this->db->where('user_id', $data['user_id']);
        $this->db->update('tbl_user', $data);
    }

    public function update_manager($data){
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_manager', $data);
    }

    public function update_regional_manager($data){
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_regional_manager', $data);
    }

    public function update_salesman($data){
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_salesman', $data);
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

    public function update_company($img){
        $data = array();
        $id = $this->input->post('id', TRUE);
        
        $data['name'] = $this->input->post('name', true);
        $data['email'] = $this->input->post('email', true);
        $data['mobile'] = $this->input->post('mobile', true);
        $data['address'] = $this->input->post('address', true);
        $data['file'] = $img;
        
        unset($data['status']);
        unset($data['user_pass']);
        unset($data['user_role']);
        
        $this->db->where('id', $id);
        $this->db->update('tbl_company', $data);
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
   
    public function allSupplier(){
        $result = $this->db->query("select * from tbl_supplier where supplier_status = 1")->result();
        return $result;
    }
    public function singleCustomer($customer_id){
        $result = $this->db->query("select * from tbl_customer where customer_id = $customer_id ")->row();
        return $result;
    }

    public function single_manager($manager_id){
        $result = $this->db->query("SELECT a.*, b.* FROM tbl_manager a, tbl_user b WHERE a.id = b.m_rm_s_id AND b.user_role = 4 AND a.id = '$manager_id' ")->row();
        return $result;
    }

    public function single_regional_manager($regiional_manager_id){
        $result = $this->db->query("SELECT a.*, b.* FROM tbl_regional_manager a, tbl_user b WHERE a.id = b.m_rm_s_id AND b.user_role = 2 AND a.id = '$regiional_manager_id' ")->row();
        return $result;
    }

    public function single_salesman($salesman_id){
        $result = $this->db->query("SELECT a.*, b.* FROM tbl_salesman a, tbl_user b WHERE a.id = b.m_rm_s_id AND b.user_role = 3 AND a.id = '$salesman_id' ")->row();
        return $result;
    }
    
    public function singleSupplier($supplier_id){
        $result = $this->db->query("select * from tbl_supplier where supplier_id = $supplier_id ")->row();
        return $result;
    }
    
    public function product_out_by_customer($customer_id, $from_date, $to_date){
        $result = $this->db->query("SELECT i.*, c.customer_name, pi.product_name, sum(i.quantity) as totalQuantity, pi.product_id, pi.pack_size, ps.pack_size FROM tbl_invoice i, tbl_customer c, tbl_product_info pi, tbl_pack_size ps WHERE i.customer_id = '$customer_id' AND c.customer_id = i.customer_id AND ps.id = pi.pack_size AND pi.product_id = i.product_id AND i.invoice_date BETWEEN '$from_date' AND '$to_date' AND NOT (i.delete_status <=> 'deleted') GROUP BY i.product_id")->result();
        return $result;
    } 
    
    public function datewise_product_out($from_date, $to_date){
        $result = $this->db->query("SELECT i.*, c.customer_name, pi.product_name, sum(i.quantity) as totalQuantity FROM tbl_invoice i, tbl_customer c, tbl_product_info pi WHERE c.customer_id = i.customer_id AND pi.product_id = i.product_id AND i.invoice_date BETWEEN '$from_date' AND '$to_date' AND NOT (i.delete_status <=> 'deleted') GROUP BY i.product_id")->result();
        return $result;
    } 
    
    public function datewise_collection_from_customer($customer_id, $from_date, $to_date){
        $result = $this->db->query("SELECT a.*, b.customer_name FROM tbl_invoice_history a, tbl_customer b WHERE a.customer_id = b.customer_id AND a.last_paid_date_manual BETWEEN '$from_date' AND '$to_date' AND NOT (a.collection_amount <=> 0) AND a.customer_id = '$customer_id' ")->result();
        return $result;
    } 
    
    public function supplier_and_datewise_buy_product($supplier_id, $from_date, $to_date){
        $result = $this->db->query("SELECT a.*, b.supplier_name, (a.quantity_in * a.buying_price) as totalBuyingPrice, pi.*, ps.pack_size FROM tbl_stock_in a, tbl_supplier b, tbl_product_info pi, tbl_pack_size ps WHERE a.supplier_id = b.supplier_id AND a.bill_date BETWEEN '$from_date' AND '$to_date' AND NOT (a.status <=> 0) AND a.supplier_id = '$supplier_id' AND a.product_id = pi.product_id AND pi.pack_size = ps.id")->result();
        return $result;
    } 

    public function supplier_and_datewise_payment_history($supplier_id, $from_date, $to_date){
        $result = $this->db->query("SELECT a.*, sum(a.payment) as TotalPaymant, b.supplier_id,b.quantity_in,b.buying_price,round((b.quantity_in * b.buying_price), 2) as totalBuyingPrice, c.supplier_name, d.product_id, d.product_name, e.pack_size FROM tbl_stock_in_history a, tbl_stock_in b, tbl_supplier c, tbl_product_info d, tbl_pack_size e WHERE a.bill_no = b.bill_no AND b.supplier_id = c.supplier_id AND b.supplier_id = '$supplier_id' AND a.entry_date BETWEEN '$from_date' AND '$to_date' AND NOT (a.payment <=> 0) AND d.product_id = b.product_id AND e.id = d.pack_size GROUP by a.bill_no, b.entry_date, b.supplier_id")->result();
        return $result;
    } 

    public function datewise_payment_history($from_date, $to_date){
        $result = $this->db->query("SELECT d.TotalBuyingPrice, d.supplier_id, d.totalPayment, d.due, e.supplier_name FROM (SELECT b.TotalBuyingPrice, b.supplier_id, c.totalPayment, round(b.TotalBuyingPrice - c.totalPayment, 2) as due FROM (SELECT a.supplier_id,a.bill_no, sum(a.quantity_in * a.buying_price) as TotalBuyingPrice FROM tbl_stock_in a WHERE a.bill_date BETWEEN '$from_date' AND '$to_date' GROUP by a.supplier_id) b LEFT JOIN (SELECT sih.bill_no, SUM(sih.payment) as totalPayment FROM tbl_stock_in_history sih, tbl_stock_in si WHERE sih.bill_no = si.bill_no GROUP BY si.supplier_id) c ON b.bill_no = c.bill_no) d LEFT JOIN (SELECT s.supplier_id, s.supplier_name FROM tbl_supplier s ) e ON e.supplier_id = d.supplier_id")->result();
        return $result;
    }
    
    public function supplier_due_list(){
        $result = $this->db->query("SELECT c.bill_no, c.totalBuyingPrice, c.totalPayment, c.due, c.supplier_id, supplier_name
        FROM (
                SELECT a.supplier_id, a.bill_no, ROUND(a.totalBuyingPrice, 2) as totalBuyingPrice, b.totalPayment, ROUND((a.totalBuyingPrice - b.totalPayment), 2) as due
                FROM (
                    SELECT bill_no, SUM(quantity_in * buying_price) AS totalBuyingPrice, supplier_id 
                    FROM tbl_stock_in
                    GROUP BY bill_no
                    ) a
                LEFT OUTER JOIN (SELECT bill_no, sum(payment) as totalPayment FROM tbl_stock_in_history GROUP BY bill_no) b
                ON(a.bill_no = b.bill_no)
            ) c
        JOIN tbl_supplier s
        ON(c.supplier_id = s.supplier_id)
        WHERE c.due > 0")->result();
        return $result;
    }
    
    public function datewise_buy_product($from_date, $to_date){
        $result = $this->db->query("SELECT a.*, b.supplier_name, (a.quantity_in * a.buying_price) as totalBuyingPrice, pi.*, ps.pack_size FROM tbl_stock_in a, tbl_supplier b, tbl_product_info pi, tbl_pack_size ps WHERE a.supplier_id = b.supplier_id AND a.bill_date BETWEEN '$from_date' AND '$to_date' AND NOT (a.status <=> 0) AND a.product_id = pi.product_id AND pi.pack_size = ps.id")->result();
        return $result;
    } 

    public function datewise_collection($from_date, $to_date){
        $result = $this->db->query("SELECT a.*, SUM(a.collection_amount) as totalCollection, b.customer_name FROM tbl_invoice_history a, tbl_customer b WHERE a.customer_id = b.customer_id AND a.last_paid_date_manual BETWEEN '$from_date' AND '$to_date' AND NOT (a.collection_amount <=> 0) GROUP BY a.customer_id")->result();
        return $result;
    } 

    public function select_fiscal_year(){
        $result = $this->db->query("SELECT * FROM tbl_fiscalyear WHERE status = 'Active' ")->row();
        return $result;
    }

    public function all_users(){
        $result = $this->db->query("SELECT * FROM tbl_user WHERE NOT (user_email <=> 'Jait') ORDER BY user_id DESC")->result();
        return $result;
    }

    public function manager_list(){
        $result = $this->db->query("SELECT a.*, b.* FROM tbl_manager a, tbl_user b WHERE a.id = b.m_rm_s_id AND b.user_role = 4 ORDER BY id DESC")->result();
        return $result;
    }

    public function regional_manager_list(){
        $result = $this->db->query("SELECT a.*, b.*, c.id as manager_id, c.name as manager_name FROM tbl_regional_manager a, tbl_user b, tbl_manager c WHERE a.id = b.m_rm_s_id AND c.id = a.manager_id AND b.user_role = 2 ORDER BY id DESC")->result();
        return $result;
    }

    public function salesman_list(){
        $result = $this->db->query("SELECT a.*, b.* FROM tbl_salesman a, tbl_user b WHERE a.id = b.m_rm_s_id AND b.user_role = 3 ORDER BY id DESC")->result();
        return $result;
    }

    public function manager_list_active(){
        $result = $this->db->query("SELECT * FROM tbl_manager WHERE status = 1 ORDER BY name ASC")->result();
        return $result;
    }

    public function regional_manager_list_active(){
        $result = $this->db->query("SELECT * FROM tbl_regional_manager WHERE status = 1 ORDER BY name ASC")->result();
        return $result;
    }
    
    
}
