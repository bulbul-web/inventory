<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">update visitor</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">update visitor</li>
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
        <div class="card-header text-uppercase">update visitor Form</div>
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
            
            <?php echo form_open_multipart('update-visitor', 'name="update-visitor" id="updatevisitor"');?>
                
                
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Name</label>
                  <div class="col-sm-9">
                      <input type="hidden" name="hidden" value="<?php echo $singleVisitor->id; ?>" class="form-control form-control-rounded">
                      <input type="text" name="name" value="<?php echo $singleVisitor->name; ?>" class="form-control form-control-rounded" required="">
                      <?php echo form_error('name', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Phone</label>
                  <div class="col-sm-9">
                      <input type="text" name="phone" value="<?php echo $singleVisitor->phone; ?>"  class="form-control form-control-rounded" required="">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Email</label>
                  <div class="col-sm-9">
                      <input type="email" name="email" value="<?php echo $singleVisitor->email; ?>"  class="form-control form-control-rounded">
                  </div>
                </div>
            
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Description</label>
                  <div class="col-sm-9">
                      <input type="text" name="description" value="<?php echo $singleVisitor->description; ?>"  class="form-control form-control-rounded">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">address</label>
                  <div class="col-sm-9">
                      <input type="text" name="address" value="<?php echo $singleVisitor->address; ?>"  class="form-control form-control-rounded" required="">
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Visit Date</label>
                  <div class="col-sm-9">
                    <input type="text" name="visit_date" id="visitdate" value="<?php echo $singleVisitor->visit_date; ?>" class="form-control form-control-rounded">
                      <?php echo form_error('visit_date', '<div class="error">', '</div>'); ?>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Next visit Date</label>
                  <div class="col-sm-9">
                    <input type="text" name="next_visit_date" id="nextvisitdate" value="<?php echo $singleVisitor->next_visit_date;?>" class="form-control form-control-rounded">
                      <?php echo form_error('next_visit_date', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
            
                <div class="form-group row">
                  <label for="rounded-input" class="col-sm-3 col-form-label">Image</label>
                  <div class="col-sm-9">
                      <input type="file" class="form-control"  name="image">
                      <span class="error">Upload (png/jpg) and size(400 x 400)</span>
                      <br>
                      <?php if($singleVisitor->image == ""){ ?>
                            
                      <?php } else { ?>
                            <img src="<?php echo base_url().$singleVisitor->image;?>" style="width: 80px;">
                      <?php }?>
                  </div>
                </div>


                <?php
                    $checkCustomer = $this->db->query("SELECT a.*, b.visitor_id FROM tbl_visit_info a, tbl_customer b WHERE a.id = b.visitor_id AND a.id = '$singleVisitor->id' ")->num_rows();
                    
                    if($checkCustomer == 0):
                ?>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">update as customer</label>
                    <div class="col-sm-10 text-left">
                    
                      <input type="checkbox" name="check" value="customer" style="height: 35px; width:35px;"/>
                    </div>
                  </div>
                <?php else: ?>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">update as customer</label>
                    <div class="col-sm-10 text-left">
                    
                      <input type="checkbox" name="check" value="customer" style="height: 35px; width:35px;" checked disabled />
                    </div>
                  </div>
                <?php endif;?>


                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Status</label>
                  <div class="col-sm-9">
                      <select name="status" id="status" class="form-control">
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                      </select>
                  </div>
                </div>
                
               
                <div class="form-footer">
                    <a href="<?php echo base_url('visitor');?>" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> update</button>
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
  $("#status").val(<?php echo $singleVisitor->status; ?>);
});