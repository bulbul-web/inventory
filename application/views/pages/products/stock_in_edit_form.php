<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">Stock In Update</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">Stock In Update</li>
    </ol>
    </div>
    <div class="col-sm-3">
        

     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
   <div class="col-lg-12">
     <div class="card">
        <div class="card-header text-uppercase">Stock In Update Form</div>
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
            
            <?php echo form_open_multipart('update-stock-in', 'name="update-stock-in" id="updateStockIn"');?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="col-form-label">Challan Date</label>
                            <input type="text" name="challan_date" id="challan_date" value="<?php echo $singleStockIn->challan_date;?>"  class="form-control form-control-rounded">
                            <input type="hidden" name="id" value="<?php echo $singleStockIn->id;?>">
                            
                            <?php echo form_error('challan_date', '<div class="error">', '</div>'); ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="col-form-label">Bill No</label>
                            <input type="text" name="bill_no" value="<?php echo $singleStockIn->bill_no;?>" class="form-control form-control-rounded" disabled>
                            <input type="hidden" name="bill_no" value="<?php echo $singleStockIn->bill_no;?>" class="form-control form-control-rounded">
                            <?php echo form_error('bill_no', '<div class="error">', '</div>'); ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="col-form-label">Bill Date</label>
                            <input type="text" name="bill_date" id="bill_date" value="<?php echo $singleStockIn->bill_date;?>" class="form-control form-control-rounded">
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
                            <input type="number" step=any name="quantity_in" value="<?php echo $singleStockIn->quantity_in; ?>" class="form-control form-control-rounded">
                            <?php echo form_error('quantity_in', '<div class="error">', '</div>'); ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="col-form-label">Buying Price/unit</label>
                            <input type="number" step=any name="buying_price" value="<?php echo $singleStockIn->buying_price; ?>" class="form-control form-control-rounded">
                            <?php echo form_error('buying_price', '<div class="error">', '</div>'); ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="col-form-label">Sale Price/unit</label>
                            <input type="number" step=any name="sale_price" value="<?php echo $singleStockIn->sale_price; ?>" class="form-control form-control-rounded">
                            <?php echo form_error('sale_price', '<div class="error">', '</div>'); ?>
                        </div>
                      </div>
                    </div>

                </div>
                
                
            
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Note</label>
                  <div class="col-sm-9">
                      <input type="text" name="note" value="<?php echo $singleStockIn->note; ?>"  class="form-control form-control-rounded">
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
                <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Update</button>
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
    document.forms['update-stock-in'].elements['product_id'].value=<?php echo $singleStockIn->product_id; ?>;
    document.forms['update-stock-in'].elements['warehouse_id'].value=<?php echo $singleStockIn->warehouse_id; ?>;
    document.forms['update-stock-in'].elements['supplier_id'].value=<?php echo $singleStockIn->supplier_id; ?>;
    document.forms['update-stock-in'].elements['status'].value=<?php echo $singleStockIn->status; ?>;
</script>
<script>
    
</script>