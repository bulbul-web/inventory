<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Query_model extends CI_Model {
    public function saveSupplierData($data){
        $this->db->insert('tbl_supplier', $data);
    }
    
    public function viewAllSuppliers(){
        $result = $this->db->select('*')
                        ->from('tbl_supplier')
                        ->order_by('supplier_id', 'ASC')
                        ->get()
                        ->result();
        return $result;
    }
    public function viewAllSuppliersActive(){
        $result = $this->db->select('*')
                        ->from('tbl_supplier')
                        ->where('supplier_status = 1')
                        ->order_by('supplier_id', 'ASC')
                        ->get()
                        ->result();
        return $result;
    }
    
    public function single_suppliers($supplier_id){
        $result = $this->db->select('*')
                        ->from('tbl_supplier')
                        ->where('supplier_id', $supplier_id)
                        ->get()
                        ->row();
        return $result;
    }
    
    public function updateSupplierData(){
        $supplier_id = $this->input->post('supplier_id', true);
        $data['supplier_name'] = $this->input->post('supplier_name', true);
        $data['supplier_address'] = $this->input->post('supplier_address', true);
        $data['supplier_mobile'] = $this->input->post('supplier_mobile', true);
        $data['supplier_email'] = $this->input->post('supplier_email', true);
        $data['entry_by'] = $this->session->userdata('user_name');
        $data['entry_date'] = date("Y-m-d");
        $data['supplier_status'] = $this->input->post('supplier_status', true);
        
        $this->db->where('supplier_id', $supplier_id);
        $this->db->update('tbl_supplier', $data);
    }
    
    public function delete_supplier($id){
        $this->db->where('supplier_id', $id);
        $this->db->delete('tbl_supplier');
    }
    
    
    
    
    
    
    public function viewAllProductsType(){
        $result = $this->db->select('*')
                        ->from('tbl_product_type')
                        ->order_by('product_type_id', 'ASC')
                        ->get()
                        ->result();
        return $result;
    }
    public function viewAllProductsTypeActive(){
        $result = $this->db->select('*')
                        ->from('tbl_product_type')
                        ->where('product_type_status = 1')
                        ->order_by('product_type_id', 'ASC')
                        ->get()
                        ->result();
        return $result;
    }
    public function viewAllProductsActive(){
        $result = $this->db->select('*')
                        ->from('tbl_product_info')
                        ->where('product_status = 1')
                        ->order_by('product_id', 'ASC')
                        ->get()
                        ->result();
        return $result;
    }
    public function saveProductTypeData($data){
        $this->db->insert('tbl_product_type', $data);
    }
    public function single_product_type($product_type_id){
        $result = $this->db->select('*')
                        ->from('tbl_product_type')
                        ->where('product_type_id', $product_type_id)
                        ->get()
                        ->row();
        return $result;
    }
    public function saveStockInData($data){
        $this->db->insert('tbl_stock_in', $data);
    }
    public function updateProductTypeData(){
        $product_type_id = $this->input->post('product_type_id', true);
        $data['product_type_name'] = $this->input->post('product_type_name', true);
        $data['product_type_descrip'] = $this->input->post('product_type_descrip', true);
        $data['entry_by'] = $this->session->userdata('user_name');
        $data['entry_date'] = date("Y-m-d");
        $data['product_type_status'] = $this->input->post('product_type_status', true);
        
        $this->db->where('product_type_id', $product_type_id);
        $this->db->update('tbl_product_type', $data);
    }
    
    public function delete_product_type($id){
        $this->db->where('product_type_id', $id);
        $this->db->delete('tbl_product_type');
    }
    
    public function delete_product($id){
        $this->db->where('product_id', $id);
        $this->db->delete('tbl_product_info');
    }
    
    public function viewAllProducts(){
        $result = $this->db->query("select tbl_product_type.product_type_name, tbl_pack_size.pack_size as pack_size_name, tbl_product_info.* from tbl_product_info LEFT JOIN tbl_product_type on tbl_product_type.product_type_id = tbl_product_info.product_type_id LEFT JOIN tbl_pack_size on tbl_pack_size.id = tbl_product_info.pack_size")
                        ->result();
        return $result;
    }
    public function viewAllStockIn(){
        $result = $this->db->query
                (
                " SELECT "
                . " tbl_warehouse.warehouse_name,"
                . " tbl_supplier.supplier_name,"
                . " tbl_product_info.product_name,"
                . " tbl_product_info.product_code,"
                . " tbl_pack_size.pack_size,"
                . " tbl_stock_in.*"
                . " FROM tbl_stock_in"
                . " LEFT JOIN tbl_warehouse ON tbl_warehouse.warehouse_id = tbl_stock_in.warehouse_id"
                . " LEFT JOIN tbl_supplier ON tbl_supplier.supplier_id = tbl_stock_in.supplier_id"
                . " LEFT JOIN tbl_product_info ON tbl_product_info.product_id = tbl_stock_in.product_id"
                . " LEFT JOIN tbl_pack_size on tbl_product_info.pack_size = tbl_pack_size.id"
                . " ORDER BY tbl_stock_in.id DESC"
                )
                ->result();
        return $result;
    }
    public function viewSingleStockIn($id){
        $result = $this->db->query
                (
                " SELECT "
                . " tbl_warehouse.warehouse_name,"
                . " tbl_supplier.supplier_name,"
                . " tbl_product_info.product_name,"
                . " tbl_product_info.product_code,"
                . " tbl_stock_in.*"
                . " FROM tbl_stock_in"
                . " LEFT JOIN tbl_warehouse ON tbl_warehouse.warehouse_id = tbl_stock_in.warehouse_id"
                . " LEFT JOIN tbl_supplier ON tbl_supplier.supplier_id = tbl_stock_in.supplier_id"
                . " LEFT JOIN tbl_product_info ON tbl_product_info.product_id = tbl_stock_in.product_id"
                . " WHERE tbl_stock_in.id=$id"
                )
                ->row();
        return $result;
    }
    public function viewSingleProducts($id){
        $result = $this->db->query
                (
                "select tbl_product_type.product_type_name, tbl_pack_size.pack_size as pack_size_name, tbl_product_info.* from tbl_product_info LEFT JOIN tbl_product_type on tbl_product_type.product_type_id = tbl_product_info.product_type_id LEFT JOIN tbl_pack_size on tbl_pack_size.id = tbl_product_info.pack_size WHERE tbl_product_info.product_id = $id"
                )
                ->row();
        return $result;
    }
    public function saveProductData($data){
        $this->db->insert('tbl_product_info', $data);
    }
    public function single_product($product_id){
        $result = $this->db->select('*')
                ->from('tbl_product_info')
                ->where('product_id', $product_id)
                ->get()
                ->row();
        return $result;
        
    }
    public function updateProductData($data){
        $this->db->where('product_id', $data['product_id']);
        $this->db->update('tbl_product_info', $data);
    }
    public function updateStockInData($data){
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_stock_in', $data);
    }
    
    
    
    public function viewAllCustomers(){
        $result = $this->db->select('*')
                        ->from('tbl_customer')
                        ->order_by('customer_id', 'ASC')
                        ->get()
                        ->result();
        return $result;
    }
    public function viewAllPackSize(){
        $result = $this->db->select('*')
                        ->from('tbl_pack_size')
                        ->order_by('id', 'ASC')
                        ->get()
                        ->result();
        return $result;
    }
    public function viewAllPackSizeId($id){
        $result = $this->db->select('*')
                        ->from('tbl_pack_size')
                        ->where('id', $id)
                        ->get()
                        ->row();
        return $result;
    }
    public function savePackSizeData($data){
        $this->db->insert('tbl_pack_size', $data);
    }
    public function updatePackSizeData($data){
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_pack_size', $data);
    }
    public function delete_pack_size($id){
        $this->db->where('id', $id);
        $this->db->delete('tbl_pack_size');
    }
    
    
    
    public function viewAllCustomersMatch($customer_name){
        $result = $this->db->select('*')
                        ->from('tbl_customer')
                        ->where("customer_name like '%".$customer_name."%' AND customer_status = 1")
                        ->limit(15)
                        ->get()
                        ->result();
        return $result;

          
    }
    
    public function viewAllProductsMatch($product_name){
        $result = $this->db->query
                (
                
                "SELECT * FROM tbl_product_info WHERE product_name LIKE '%".$product_name."%' AND product_status = 1 GROUP BY tbl_product_info.product_id"
                )->result();
        return $result;

          
    }
    
    
    
    public function saveCustomerData($data){
        $this->db->insert('tbl_customer', $data);
    }
    
    
    
    public function single_Customer($customer_id){
        $result = $this->db->select('*')
                ->from('tbl_customer')
                ->where('customer_id', $customer_id)
                ->get()
                ->row();
        return $result;
    }
    
    
    public function updateCustomerData($data){
        $this->db->where('customer_id', $data['customer_id']);
        $this->db->update('tbl_customer', $data);
    }
    
    
    public function delete_customer($id){
        $this->db->where('customer_id', $id);
        $this->db->delete('tbl_customer');
    }
    public function delete_stock_in($id){
        $this->db->where('id', $id);
        $this->db->delete('tbl_stock_in');
    }
    
    
    
    public function viewAllWarehouse(){
        $result = $this->db->select('*')
                        ->from('tbl_warehouse')
                        ->order_by('warehouse_id', 'ASC')
                        ->get()
                        ->result();
        return $result;
    }
    public function viewAllWarehouseActive(){
        $result = $this->db->select('*')
                        ->from('tbl_warehouse')
                        ->where('warehouse_status = 1')
                        ->order_by('warehouse_id', 'ASC')
                        ->get()
                        ->result();
        return $result;
    }
    public function saveWarehouseData($data){
        $this->db->insert('tbl_warehouse', $data);
    }
    public function single_Warehouse($warehouse_id){
        $result = $this->db->select('*')
                ->from('tbl_warehouse')
                ->where('warehouse_id', $warehouse_id)
                ->get()
                ->row();
        return $result;
    }
    public function updateWarehouseData($data){
        $this->db->where('warehouse_id', $data['warehouse_id']);
        $this->db->update('tbl_warehouse', $data);
    }
    public function delete_warehouse($id){
        $this->db->where('warehouse_id', $id);
        $this->db->delete('tbl_warehouse');
    }
    
    
    public function viewAllLoan(){
        $result = $this->db->select('*')
                        ->from('tbl_loan')
                        ->order_by('id', 'ASC')
                        ->get()
                        ->result();
        return $result;
    }
    public function saveLoanData($data)
    {
        $this->db->insert('tbl_loan', $data);
    }
    public function viewSingleLoan($id)
    {
        $result = $this->db->select('*')
                ->from('tbl_loan')
                ->where('id', $id)
                ->get()
                ->row();
        return $result;
    }
    public function updateLoanData($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_loan', $data);
    }
    public function delete_loan($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_loan');
    }
    
    
    
    
    public function viewInvoice(){
        $result = $this->db->query
                (
                    
                    "SELECT c.customer_name, i.voucher_id, sum(i.quantity * i.sale_price) as grandTotal, i.paid_amount, i.discount, i.invoice_date, i.status, i.note"
                    . " FROM tbl_customer c, tbl_invoice i"
                    . " WHERE i.customer_id = c.customer_id"
                    . " GROUP BY i.voucher_id"
                    . " ORDER BY i.id DESC"
//                    "SELECT"
//                    . " tbl_customer.*,"
//                    . " tbl_product_info.*,"
//                    . " tbl_invoice.*, sum(tbl_invoice.quantity * tbl_invoice.sale_price) as grandTotal"
//                    . " FROM tbl_invoice"
//                    . " LEFT join tbl_customer ON tbl_customer.customer_id = tbl_invoice.customer_id"
//                    . " LEFT JOIN tbl_product_info on tbl_product_info.product_id = tbl_invoice.product_id"
//                    . " GROUP BY tbl_invoice.voucher_id"
//                    . " ORDER BY tbl_invoice.voucher_id DESC"
                )->result();
        return $result;
    }

    public function viewAllCostsHead(){
        $result = $this->db->query("select * from tbl_costs_head ORDER BY id DESC")->result();
        return $result;
    }

    public function viewSingleCostsHead($trans_id){
        $result = $this->db->query("select * from tbl_costs_head where id = $trans_id")->row();
        return $result;
    }

    public function viewAllTransHeadMatch($trans_head){
        $result = $this->db->query
                (
                "SELECT * FROM tbl_costs_head WHERE tbl_costs_head.trnsaction_head LIKE '%".$trans_head."%' AND tbl_costs_head.status = 1 "
                )->result();
        return $result;

          
    }

    public function save_transaction_head($data){
        $this->db->insert('tbl_costs_head', $data);
    }

    public function update_transaction_head($data){
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_costs_head', $data);
    }

    public function delete_transaction_head($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_costs_head');
    }


    public function viewAllCosts(){
        $result = $this->db->query("SELECT c.*, SUM(c.amount) as total_expense FROM tbl_costs c GROUP BY c.trnsction_id ORDER BY c.id DESC")->result();
        return $result;
    }

    public function expense_details($trnsction_id){
        $result = $this->db->query("SELECT c.*, ch.trnsaction_head FROM tbl_costs c, tbl_costs_head ch WHERE ch.id = c.costs_head_id AND c.trnsction_id = '$trnsction_id' ORDER BY c.id DESC")->row();
        return $result;
    }

    public function expense_details_all($trnsction_id){
        $result = $this->db->query("SELECT c.*, ch.trnsaction_head FROM tbl_costs c, tbl_costs_head ch WHERE ch.id = c.costs_head_id AND c.trnsction_id = '$trnsction_id' ORDER BY c.id DESC")->result();
        return $result;
    }


    public function voucher_info_customer($voucher_id){
        $result = $this->db->query
                (
                "SELECT c.*, i.*"
                . " FROM tbl_customer c, tbl_invoice i"
                . " WHERE i.customer_id = c.customer_id AND i.voucher_id = '$voucher_id'"
                . " GROUP BY i.voucher_id"
//                    "SELECT"
//                    . " tbl_customer.*,"
//                    . " tbl_product_info.*,"
//                    . " tbl_invoice.*"
//                    . " FROM tbl_invoice"
//                    . " LEFT join tbl_customer ON tbl_customer.customer_id = tbl_invoice.customer_id"
//                    . " LEFT JOIN tbl_product_info on tbl_product_info.product_id = tbl_invoice.product_id"
//                    . " where tbl_invoice.voucher_id='$voucher_id'"
//                    . " GROUP BY tbl_invoice.voucher_id"
                    
                )->row();
        return $result;
    }
    public function voucher_info_product($voucher_id){
        $result = $this->db->query
                (
                "SELECT"
                . " c.*,"
                . " pi.*,"
                . " i.*"
                . " FROM"
                . " tbl_customer c,"
                . " tbl_product_info pi,"
                . " tbl_invoice i"
                . " WHERE"
                . " i.customer_id = c.customer_id AND i.product_id = pi.product_id AND i.voucher_id = '$voucher_id'"
//                    "SELECT"
//                    . " tbl_customer.*,"
//                    . " tbl_product_info.*,"
//                    . " tbl_invoice.*"
//                    . " FROM tbl_invoice"
//                    . " LEFT join tbl_customer ON tbl_customer.customer_id = tbl_invoice.customer_id"
//                    . " LEFT JOIN tbl_product_info on tbl_product_info.product_id = tbl_invoice.product_id"
//                    . " where tbl_invoice.voucher_id='$voucher_id'"
                
                )->result();
        return $result;
    }
    
    public function invoice_status($voucher_id, $invoice_status){
        if($invoice_status == 1){
            $invoice_status = 0;
        }elseif($invoice_status == 0){
            $invoice_status = 1;
        }
        $this->db->set('status', $invoice_status);
        $this->db->where('voucher_id', $voucher_id);
        $this->db->update('tbl_invoice');
    }
    
    public function delete_invoice($voucher_id){
        $this->db->where('voucher_id', $voucher_id);
        $this->db->delete('tbl_invoice');
    }
    public function delete_invoice_product($id){
        $this->db->where('id', $id);
        $this->db->delete('tbl_invoice');
    }

}
