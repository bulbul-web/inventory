<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
               <h4 class="page-title">Change Password</h4>
               <ol class="breadcrumb">
                   <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">Change Password</li>
    </ol>
      </div>
      <div class="col-sm-3">
  
       </div>
</div>
<!-- End Breadcrumb-->
 <div class="row">
   <div class="col-lg-12">
     <div class="card">
        <div class="card-header text-uppercase">Change Password Form</div>
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

                    <?php echo form_open_multipart('update-password-regional-manager', 'name="update-password-regional-manager" id="updatePasswordRegionalManager"');?>                       
                        
                        <div class="form-group row">
                          <label  class="col-sm-3 col-form-label">New Password</label>
                          <div class="col-sm-9">
                              <input type="password" value="<?php echo set_value('new_password'); ?>" name="new_password"  class="form-control form-control-rounded">
                              <input type="hidden" name="id" value="<?php echo $singleRegionalManager->id;?>" >
                              <input type="hidden" name="user_id" value="<?php echo $singleRegionalManager->user_id;?>" >
                              <?php echo form_error('new_password', '<div class="error">', '</div>'); ?>
                          </div>
                        </div>
                        
                        <div class="form-group row">
                          <label  class="col-sm-3 col-form-label">Confirm Password</label>
                          <div class="col-sm-9">
                              <input type="password" value="<?php echo set_value('confirm_password'); ?>" name="confirm_password"  class="form-control form-control-rounded">
                              <?php echo form_error('confirm_password', '<div class="error">', '</div>'); ?>
                          </div>
                        </div>
            
                        <div class="form-footer">
                            
                            <a class="btn btn-info" href="<?php echo base_url()?>regional-manager-list"> Back</a>
                            <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> Update</button>
                            
                        </div>

                    <?php form_close();?>

        </div>
     </div>
   </div>
 </div><!--End Row-->