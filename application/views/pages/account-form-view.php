<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
               <h4 class="page-title">Update Account</h4>
               <ol class="breadcrumb">
                   <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">Update Account</li>
    </ol>
      </div>
      <div class="col-sm-3">
  
       </div>
</div>
<!-- End Breadcrumb-->
 <div class="row">
   <div class="col-lg-12">
     <div class="card">
        <div class="card-header text-uppercase">Update Form</div>
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
                if($this->session->flashdata('error')){echo $this->session->flashdata('error');}
                ?>

                </font>
            </center>

                    <?php echo form_open_multipart('update-user', 'name="update-user" id="updateUuser"');?>                       
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">User Name</label>
                          <div class="col-sm-9">
                              <input type="text" value="<?php echo $userInfo->user_name;?>" name="user_name" class="form-control form-control-rounded">
                              <input type="hidden" value="<?php echo $userInfo->user_id;?>" name="user_id" class="form-control form-control-rounded">
                              <?php echo form_error('user_name', '<div class="error">', '</div>'); ?>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label  class="col-sm-3 col-form-label">User Email or login name</label>
                          <div class="col-sm-9">
                              <input type="text" value="<?php echo $userInfo->user_email;?>" name="user_email"  class="form-control form-control-rounded">
                              <?php echo form_error('user_email', '<div class="error">', '</div>'); ?>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="rounded-input" class="col-sm-3 col-form-label">Image</label>
                          <div class="col-sm-9">
                                <input type="file" class="form-control form-control-rounded"  name="file">
                                <input type="hidden" name="old_file" value="<?php echo $userInfo->file;?>">
                                <span class="error">Upload (png/jpg) and size(110 x 110)</span>
                                <br/>
                                <br/>
                                <?php if($userInfo->file == ""){ ?>
                                      <img src="<?php echo base_url();?>assets/images/avatars/avatar-17.png" class="user-img" alt="user avatar">  
                                <?php } else { ?>
                                      <img src="<?php echo base_url().$userInfo->file;?>" class="user-img" alt="user avatar">
                                <?php }?>
                                
                          </div>
                        </div>
                        <div class="form-footer">
                            <a href="<?php echo base_url();?>" class="btn btn-danger"><i class="fa fa-times"></i> CANCEL</a>
                            <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> Update</button>
                        </div>

                    <?php form_close();?>

        </div>
     </div>
   </div>
 </div><!--End Row-->