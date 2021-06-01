<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">Add manager form</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="<?php echo base_url('marketing-setup-section');?>">Marketing Section</a></li>
    </ol>
    </div>
    <div class="col-sm-3">
        <div class="top-button-area">
            <a class="btn btn-primary m-1" href="<?php echo base_url('manager-list');?>"><i aria-hidden="true" class="fa fa-list"></i> Manager List</a>
        </div>

    </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
   <div class="col-lg-12">
     <div class="card">
        <div class="card-header text-uppercase">Add manager form</div>
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
            
            <?php echo form_open_multipart('save-manager', 'name="save-manager" id="savemanager"');?>
                
                
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Name</label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="Manager name" name="name" value="<?php echo set_value('name'); ?>" class="form-control form-control-rounded">
                      <?php echo form_error('name', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
            
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Email</label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="Manager email" name="email" value="<?php echo set_value('email'); ?>"  class="form-control form-control-rounded">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Phone</label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="Phone" name="phone" value="<?php echo set_value('phone'); ?>"  class="form-control form-control-rounded">
                      <?php echo form_error('phone', '<div class="error">', '</div>'); ?>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">User Name</label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="Login name" name="user_email" value="<?php echo set_value('user_email'); ?>"  class="form-control form-control-rounded">
                      <?php echo form_error('user_email', '<div class="error">', '</div>'); ?>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Password</label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="Password" name="user_pass" value="<?php echo set_value('user_pass'); ?>"  class="form-control form-control-rounded">
                      <?php echo form_error('user_pass', '<div class="error">', '</div>'); ?>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Confirm Password</label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="Confirm password" name="confirm_password" value="<?php echo set_value('confirm_password'); ?>"  class="form-control form-control-rounded">
                      <?php echo form_error('confirm_password', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                
                
                
                

            <div class="form-footer">
                <a href="<?php echo base_url('manager-add');?>" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Save</button>
            </div>

            <?php echo form_close();?>
        </div>
     </div>
   </div>
</div>