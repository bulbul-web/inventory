<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">Add user form</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">Add user</li>
    </ol>
    </div>
    <div class="col-sm-3">
        

     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
   <div class="col-lg-12">
     <div class="card">
        <div class="card-header text-uppercase">Add user form</div>
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
            
            <?php echo form_open_multipart('save-user', 'name="save-user" id="saveUser"');?>
                
                
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Name</label>
                  <div class="col-sm-9">
                      <input type="text" name="user_name" value="<?php echo set_value('user_name'); ?>" class="form-control form-control-rounded">
                      <?php echo form_error('user_name', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
            
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Email or (Login name)</label>
                  <div class="col-sm-9">
                      <input type="text" name="user_email" value="<?php echo set_value('user_email'); ?>"  class="form-control form-control-rounded">
                      <?php echo form_error('user_email', '<div class="error">', '</div>'); ?>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Phone</label>
                  <div class="col-sm-9">
                      <input type="text" name="user_mobile" value="<?php echo set_value('user_mobile'); ?>"  class="form-control form-control-rounded">
                      <?php echo form_error('user_mobile', '<div class="error">', '</div>'); ?>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Password</label>
                  <div class="col-sm-9">
                      <input type="text" name="user_pass" value="<?php echo set_value('user_pass'); ?>"  class="form-control form-control-rounded">
                      <?php echo form_error('user_pass', '<div class="error">', '</div>'); ?>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Confirm Password</label>
                  <div class="col-sm-9">
                      <input type="text" name="confirm_password" value="<?php echo set_value('confirm_password'); ?>"  class="form-control form-control-rounded">
                      <?php echo form_error('confirm_password', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                
                
                
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">User type</label>
                    <div class="col-sm-9">
                        <select name="user_role" class="form-control">
                            <option value="1">Admin</option>
                        </select>
                    </div>
                </div>

            <div class="form-footer">
                <a href="<?php echo base_url('all-users');?>" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Save</button>
            </div>

            <?php echo form_close();?>
        </div>
     </div>
   </div>
</div>