<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">New Loan</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">Add Loan</li>
    </ol>
    </div>
    <div class="col-sm-3">
        

     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
   <div class="col-lg-12">
     <div class="card">
        <div class="card-header text-uppercase">Add Loan Form</div>
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
            
            <?php echo form_open('save-loan', 'name="save-loan" id="saveLoan"');?>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Loan From<span style="color: #fd3550;">*</span></label>
                  <div class="col-sm-9">
                      <input type="text" name="loan_from" value="<?php echo set_value('loan_from'); ?>" class="form-control form-control-rounded">
                      <?php echo form_error('loan_from', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Mobile</label>
                  <div class="col-sm-9">
                      <input type="text" name="mobile" value="<?php echo set_value('mobile'); ?>" class="form-control form-control-rounded">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Email</label>
                  <div class="col-sm-9">
                      <input type="text" name="email" value="<?php echo set_value('email'); ?>" class="form-control form-control-rounded">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Address<span style="color: #fd3550;">*</span></label>
                  <div class="col-sm-9">
                      <input type="text" name="address" value="<?php echo set_value('address'); ?>"  class="form-control form-control-rounded">
                      <?php echo form_error('address', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Description<span style="color: #fd3550;">*</span></label>
                  <div class="col-sm-9">
                      <input type="text" name="description" value="<?php echo set_value('description'); ?>"  class="form-control form-control-rounded">
                      <?php echo form_error('description', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Loan Amount<span style="color: #fd3550;">*</span></label>
                  <div class="col-sm-9">
                      <input type="number" step=any name="loan_amount" value="<?php echo set_value('loan_amount'); ?>"  class="form-control form-control-rounded">
                      <?php echo form_error('loan_amount', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Start Date<span style="color: #fd3550;">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="start_date" id="start_date" value="<?php echo set_value('start_date'); ?>"  class="form-control form-control-rounded">
                                <?php echo form_error('start_date', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">End Date<span style="color: #fd3550;">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="end_date" id="end_date" value="<?php echo set_value('end_date'); ?>" class="form-control form-control-rounded">
                                <?php echo form_error('end_date', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
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
                <a href="<?php echo base_url('loan');?>" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Save</button>
            </div>

            <?php echo form_close();?>
        </div>
     </div>
   </div>
</div>

<script type='text/javascript'>
$(document).ready(function(){
    $( "#start_date" ).datepicker({dateFormat: "yy-mm-dd"});
    $( "#end_date" ).datepicker({dateFormat: "yy-mm-dd"});
});
</script>