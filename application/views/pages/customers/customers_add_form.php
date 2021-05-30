<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">Add Customer</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('customer-section');?>">customer Section</a></li>
    </ol>
    </div>
    <div class="col-sm-3">
        <div class="top-button-area">
            <a class="btn btn-primary m-1" href="<?php echo base_url('customers');?>"><i aria-hidden="true" class="fa fa-plus-circle"></i> Customer list</a>
        </div>

     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
   <div class="col-lg-12">
     <div class="card">
        <div class="card-header text-uppercase">Add Customer Form</div>
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
            
            <?php echo form_open('save-customers', 'name="save-customers" id="saveCustomers"');?>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Customer Category</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="customer_category" id="customerCategory" required="" onchange="getCustomerSubcategory()" >
                        <option value="">Select Customer Category</option>

                        <?php
                          $customer_category = $this->db->query("SELECT * FROM tbl_customer_category WHERE status = 1 ")->result();
                          foreach ($customer_category as $value) {                        
                        ?>
                          <option value="<?php echo $value->id;?>"><?php echo $value->name;?></option>
                        <?php } ?>
                      </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Customer Sub Category</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="customer_subcategory" id="customerSubcategory" >
                        <option value="">Select Customer Subcategory</option>
                      </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Responsibilty</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="user_id" >
                        <option value="">Select Salesman</option>

                        <?php
                          $salesman = $this->db->query("SELECT * FROM tbl_salesman WHERE status = 1 ")->result();
                          foreach ($salesman as $value) {                        
                        ?>
                          <option value="<?php echo $value->id;?>"><?php echo $value->name;?></option>
                        <?php } ?>
                      </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Company Name</label>
                  <div class="col-sm-9">
                      <input type="text" name="customer_name" value="<?php echo set_value('customer_name'); ?>" class="form-control form-control-rounded">
                      <?php echo form_error('customer_name', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">customer Address</label>
                  <div class="col-sm-9">
                      <input type="text" name="customer_address" value="<?php echo set_value('customer_address'); ?>"  class="form-control form-control-rounded">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">customer Mobile</label>
                  <div class="col-sm-9">
                      <input type="text" name="customer_mobile" value="<?php echo set_value('customer_mobile'); ?>" class="form-control form-control-rounded">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">customer Email</label>
                  <div class="col-sm-9">
                      <input type="email" name="customer_email" value="<?php echo set_value('customer_email'); ?>" class="form-control form-control-rounded">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Contact Person Name</label>
                  <div class="col-sm-9">
                      <input type="text" name="contact_person_name" value="<?php echo set_value('contact_person_name'); ?>" class="form-control form-control-rounded">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Contact Person Mobile</label>
                  <div class="col-sm-9">
                      <input type="text" name="contact_person_mobile" value="<?php echo set_value('contact_person_mobile'); ?>" class="form-control form-control-rounded">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Contact Person Email</label>
                  <div class="col-sm-9">
                      <input type="email" name="contact_person_email" value="<?php echo set_value('contact_person_email'); ?>" class="form-control form-control-rounded">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Status</label>
                  <div class="col-sm-9">
                      <select name="customer_status" class="form-control">
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                      </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Potential</label>
                  <div class="col-sm-9">
                      <select name="potential_status" class="form-control">
                          <option value="1">Potential</option>
                          <option value="0">Non Potential</option>
                      </select>
                  </div>
                </div>
            <div class="form-footer">
                <a href="<?php echo base_url('customers');?>" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Save</button>
            </div>

            <?php echo form_close();?>
        </div>
     </div>
   </div>
</div>

<script>
  function getCustomerSubcategory() {
    var category_id = $("#customerCategory").val();
    $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>Customers/findCustoemrSubcategory',
          data: {
              category_id: category_id
          },
          success: function (response) {
              document.getElementById("customerSubcategory").innerHTML = response;
          }
    });
    
  }
</script>