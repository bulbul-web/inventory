<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">Update Supplier</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">Update Supplier</li>
    </ol>
    </div>
    <div class="col-sm-3">
        

     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
   <div class="col-lg-12">
     <div class="card">
        <div class="card-header text-uppercase">Update supplier Form</div>
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
            
            <?php echo form_open('update-suppliers', 'name="update-suppliers" id="saveSuppliers"');?>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Supplier Name</label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="Supplier name" name="supplier_name" value="<?php echo $singleSupplier->supplier_name;?>" class="form-control form-control-rounded">
                      <input type="hidden" name="supplier_id" value="<?php echo $singleSupplier->supplier_id;?>" />
                      <?php echo form_error('supplier_name', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Supplier Address</label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="Supplier address" name="supplier_address" value="<?php echo $singleSupplier->supplier_address; ?>"  class="form-control form-control-rounded">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Supplier Mobile</label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="Supplier mobile" name="supplier_mobile" value="<?php echo $singleSupplier->supplier_mobile; ?>" class="form-control form-control-rounded">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Supplier Email</label>
                  <div class="col-sm-9">
                      <input type="email" placeholder="Supplier email" name="supplier_email" value="<?php echo $singleSupplier->supplier_email; ?>" class="form-control form-control-rounded">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Status</label>
                  <div class="col-sm-9">
                      <select id="supplierStatus" name="supplier_status" value="<?php echo $singleSupplier->supplier_status; ?>" class="form-control">
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                      </select>
                  </div>
                </div>
            <div class="form-footer">
                <a href="<?php echo base_url('suppliers');?>" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Save</button>
            </div>

            <?php echo form_close();?>
        </div>
     </div>
   </div>
</div>

<script>
    document.forms['update-suppliers'].elements['supplierStatus'].value=<?php echo $singleSupplier->supplier_status; ?>;//for active inactive.
</script>