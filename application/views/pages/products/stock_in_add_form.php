<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">Stock In Products</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">Stock In Products</li>
    </ol>
    </div>
    <div class="col-sm-3">
        <div class="top-button-area">
            <a class="btn btn-primary m-1" href="<?php echo base_url('products-stock-in');?>"><i aria-hidden="true" class="fa fa-plus-circle"></i> Stock list</a>
        </div>

    </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
   <div class="col-lg-12">
     <div class="card">
        <div class="card-header text-uppercase">Stock In Products Form</div>
        <div class="card-body">
            <center> 
                <font color="#FF0000" style="font-size: 20px;">
                <?php
                $message = $this->session->userdata('message');
                //echo $message;
                if (isset($message)) {
                    echo $message;
                    $this->session->unset_userdata('message');
                }
                ?>

                </font>
            </center>
            
            <?php echo form_open_multipart('save-stock-in', 'name="save-stock-in" id="saveStockIn"');?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="col-form-label">Challan Date</label>
                            <input type="text" name="challan_date" id="challan_date" value=""  class="form-control form-control-rounded">
                            
                            <?php echo form_error('challan_date', '<div class="error">', '</div>'); ?>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4" style="display: none;">
                        <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="col-form-label">Bill No</label>
                            <input type="text" name="bill_no" value="<?php set_value('bill_no');?>" class="form-control form-control-rounded">
                            <?php echo form_error('bill_no', '<div class="error">', '</div>'); ?>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="col-form-label">Bill Date</label>
                            <input type="text" name="bill_date" id="bill_date" value="<?php echo date('Y-m-d'); ?>" class="form-control form-control-rounded">
                            <?php echo form_error('bill_date', '<div class="error">', '</div>'); ?>
                        </div>
                      </div>
                    </div>

                </div>
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Supplier</label>
                  <div class="col-sm-9">
                      <select name="supplier_id" class="form-control">
                            <option value="">Select Supplier</option>
                            <?php foreach($AllSupplier as $supplier){ ?>
                            <option value="<?php echo $supplier->supplier_id;?>"><?php echo $supplier->supplier_name;?></option>
                            <?php } ?>
                      </select>
                      <?php echo form_error('supplier_id', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Warehouse</label>
                  <div class="col-sm-9">
                      <select name="warehouse_id" class="form-control">
                            <option value="">Select Warehouse</option>
                            <?php foreach($AllWarehouse as $warehouse){ ?>
                            <option value="<?php echo $warehouse->warehouse_id;?>"><?php echo $warehouse->warehouse_name;?></option>
                            <?php } ?>
                      </select>
                      <?php echo form_error('warehouse_id', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Product Name</label>
                  <div class="col-sm-9">
                      <select name="product_id" class="form-control">
                            <option value="">Select Product Type</option>
                            <?php foreach($Allproduct as $product){ ?>
                            <option value="<?php echo $product->product_id;?>"><?php echo $product->product_name;?></option>
                            <?php } ?>
                      </select>
                      <?php echo form_error('product_id', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
            
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="col-form-label">Quantity</label>
                            <input type="number" step=any name="quantity_in" value="<?php echo set_value('quantity_in'); ?>" class="form-control form-control-rounded">
                            <?php echo form_error('quantity_in', '<div class="error">', '</div>'); ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="col-form-label">Buying Price/unit</label>
                            <input type="number" step=any name="buying_price" value="<?php echo set_value('buying_price'); ?>" class="form-control form-control-rounded">
                            <?php echo form_error('buying_price', '<div class="error">', '</div>'); ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="col-form-label">Sale Price/unit</label>
                            <input type="number" step=any name="sale_price" value="<?php echo set_value('sale_price'); ?>" class="form-control form-control-rounded">
                            <?php echo form_error('sale_price', '<div class="error">', '</div>'); ?>
                        </div>
                      </div>
                    </div>

                </div>
                
                
            
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Note</label>
                  <div class="col-sm-9">
                      <input type="text" name="note" value="<?php echo set_value('note'); ?>"  class="form-control form-control-rounded">
                  </div>
                </div>
                
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Status</label>
                  <div class="col-sm-9">
                      <select name="status" class="form-control">
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                      </select>
                  </div>
                </div>
            <div class="form-footer">
                <a href="<?php echo base_url('products-stock-in');?>" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Save</button>
            </div>

            <?php echo form_close();?>
        </div>
     </div>
   </div>
</div>
<script>
    $(document).ready(function(){
        $( "#challan_date" ).datepicker({dateFormat: "yy-mm-dd"});
        $( "#bill_date" ).datepicker({dateFormat: "yy-mm-dd"});
    });
</script>