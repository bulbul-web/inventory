<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">Update Customer</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">Update Customer</li>
    </ol>
    </div>
    <div class="col-sm-3">
        

     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
   <div class="col-lg-12">
     <div class="card">
        <div class="card-header text-uppercase">Update Customer Form</div>
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
            
            <?php echo form_open('update-customers', 'name="update-customers" id="updateCustomers"');?>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">customer Name</label>
                  <div class="col-sm-9">
                      <input type="text" name="customer_name" value="<?php echo $singleCustomer->customer_name; ?>" class="form-control form-control-rounded">
                      <input type="hidden" name="customer_id" value="<?php echo $singleCustomer->customer_id; ?>" class="form-control form-control-rounded">
                      <?php echo form_error('customer_name', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">customer Address</label>
                  <div class="col-sm-9">
                      <input type="text" name="customer_address" value="<?php echo $singleCustomer->customer_address; ?>"  class="form-control form-control-rounded">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">customer Mobile</label>
                  <div class="col-sm-9">
                      <input type="text" name="customer_mobile" value="<?php echo $singleCustomer->customer_mobile; ?>" class="form-control form-control-rounded">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">customer Email</label>
                  <div class="col-sm-9">
                      <input type="email" name="customer_email" value="<?php echo $singleCustomer->customer_email; ?>" class="form-control form-control-rounded">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Status</label>
                  <div class="col-sm-9">
                      <select name="customer_status" id="customerStatus" class="form-control">
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                      </select>
                  </div>
                </div>
            <div class="form-footer">
                <a href="<?php echo base_url('customers');?>" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Update</button>
            </div>

            <?php echo form_close();?>
        </div>
     </div>
   </div>
</div>

<script>
    document.forms['update-customers'].elements['customerStatus'].value=<?php echo $singleCustomer->customer_status; ?>;//for active inactive.
</script>