<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">Add visitor</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">Add visitor</li>
    </ol>
    </div>
    <div class="col-sm-3">
        <div class="top-button-area">
            <a class="btn btn-primary m-1" href="<?php echo base_url('visitor');?>"><i aria-hidden="true" class="fa fa-plus-circle"></i> visitor list</a>
        </div>

     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
   <div class="col-lg-12">
     <div class="card">
        <div class="card-header text-uppercase">Add visitor Form</div>
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
            
            <?php echo form_open_multipart('save-visitor', 'name="save-visitor" id="savevisitor"');?>
                
                
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Name</label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="Institute name" name="name" value="<?php echo set_value('name'); ?>" class="form-control form-control-rounded" required="">
                      <?php echo form_error('name', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Phone</label>
                  <div class="col-sm-9">
                      <input type="text" name="phone" placeholder="Institute mobile number" value="<?php echo set_value('phone'); ?>"  class="form-control form-control-rounded" required="">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Email</label>
                  <div class="col-sm-9">
                      <input type="email" name="email" placeholder="Institute email" value="<?php echo set_value('email'); ?>"  class="form-control form-control-rounded">
                  </div>
                </div>
            
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Description</label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="Description" name="description" value="<?php echo set_value('description'); ?>"  class="form-control form-control-rounded">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Address</label>
                  <div class="col-sm-9">
                      <input type="text" name="address" placeholder="Address" value="<?php echo set_value('address'); ?>"  class="form-control form-control-rounded" required="">
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Visit Date</label>
                  <div class="col-sm-9">
                    <input type="text" name="visit_date" placeholder="Visit date" id="visitdate" value="<?php echo date('Y-m-d'); ?>" class="form-control form-control-rounded">
                      <?php echo form_error('visit_date', '<div class="error">', '</div>'); ?>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Next visit Date</label>
                  <div class="col-sm-9">
                    <input type="text" placeholder="Nex visit date" name="next_visit_date" id="nextvisitdate" value="" class="form-control form-control-rounded">
                      <?php echo form_error('next_visit_date', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
            
                <div class="form-group row">
                  <label for="rounded-input" class="col-sm-3 col-form-label">Image</label>
                  <div class="col-sm-9">
                      <input type="file" class="form-control"  name="image">
                      <span class="error">Upload (png/jpg) and size(400 x 400)</span>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Save as customer</label>
                  <div class="col-sm-10 text-left">
                    <input type="checkbox" name="check" value="customer" style="height: 35px; width:35px;"/>
                  </div>
                </div>
                
                
               
                <div class="form-footer">
                    <a href="<?php echo base_url('visit-add');?>" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Save</button>
                </div>

            <?php echo form_close();?>
        </div>
     </div>
   </div>
</div>

<script>
$(document).ready(function(){
  $( "#visitdate" ).datepicker({dateFormat: "yy-mm-dd"});
  $( "#nextvisitdate" ).datepicker({dateFormat: "yy-mm-dd"});
});
</script>