<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">Update Loan</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">Update Loan</li>
    </ol>
    </div>
    <div class="col-sm-3">
        

     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
   <div class="col-lg-12">
     <div class="card">
        <div class="card-header text-uppercase">Update Loan Form</div>
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
            
            <?php echo form_open('update-loan', 'name="update-loan" id="updateLoan"');?>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Loan From<span style="color: #fd3550;">*</span></label>
                  <div class="col-sm-9">
                      <input type="hidden" name="id" value="<?php echo $loanSingle->id; ?>" class="form-control form-control-rounded">
                      <input type="text" placeholder="Loan from (bank/person)" name="loan_from" value="<?php echo $loanSingle->loan_from; ?>" class="form-control form-control-rounded">
                      <?php echo form_error('loan_from', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Mobile</label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="Mobile" name="mobile" value="<?php echo $loanSingle->mobile; ?>" class="form-control form-control-rounded">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Email</label>
                  <div class="col-sm-9">
                      <input type="text" name="email" placeholder="Email" value="<?php echo $loanSingle->email; ?>" class="form-control form-control-rounded">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Address<span style="color: #fd3550;">*</span></label>
                  <div class="col-sm-9">
                      <input type="text" name="address" placeholder="Address" value="<?php echo $loanSingle->address; ?>"  class="form-control form-control-rounded">
                      <?php echo form_error('address', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Description<span style="color: #fd3550;">*</span></label>
                  <div class="col-sm-9">
                      <input type="text" name="description" value="<?php echo $loanSingle->description; ?>"  class="form-control form-control-rounded">
                      <?php echo form_error('description', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Loan Amount<span style="color: #fd3550;">*</span></label>
                  <div class="col-sm-9">
                      <input type="number" placeholder="Loan amount" step=any name="loan_amount" value="<?php echo $loanSingle->loan_amount; ?>"  class="form-control form-control-rounded">
                      <?php echo form_error('loan_amount', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Start Date<span style="color: #fd3550;">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="start_date" id="start_date" value="<?php echo $loanSingle->start_date; ?>"  class="form-control form-control-rounded">
                                <?php echo form_error('start_date', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">End Date<span style="color: #fd3550;">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="End date" name="end_date" id="end_date" value="<?php echo $loanSingle->end_date; ?>" class="form-control form-control-rounded">
                                <?php echo form_error('end_date', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                    </div>
                </div>
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
                <a href="<?php echo base_url('loan');?>" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Update</button>
            </div>

            <?php echo form_close();?>
        </div>
     </div>
   </div>
</div>
<script type='text/javascript'>
$(document).ready(function(){
    $( "#start_date" ).datepicker({
        dateFormat: "yy-mm-dd"
    });
    $( "#end_date" ).datepicker({dateFormat: "yy-mm-dd"});
});
</script>
<script type='text/javascript'>
    document.forms['update-loan'].elements['status'].value=<?php echo $loanSingle->status; ?>;//for active inactive.
</script>