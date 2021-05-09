<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">Update regional manager form</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">Update regional manager</li>
    </ol>
    </div>
    <div class="col-sm-3">
        

     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
   <div class="col-lg-12">
     <div class="card">
        <div class="card-header text-uppercase">Update regional manager form</div>
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
            
            <?php echo form_open_multipart('update-regional-manager-particular', 'name="update-regional-manager-particular" id="updateRegionalManagerParticular"');?>
                
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Select Manager</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="manager_id">
                      <option value="">Select Manager</option>
                      <?php
                        foreach ($managerListActive as $value) {
                      ?>
                        <option value="<?php echo $value->id?>"><?php echo $value->name;?></option>
                      <?php } ?>
                    </select>
                    <?php echo form_error('manager_id', '<div class="error">', '</div>'); ?>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Name</label>
                  <div class="col-sm-9">
                      <input type="text" name="name" value="<?php echo $singleRegionalManager->name; ?>" class="form-control form-control-rounded">
                      <input type="hidden" name="id" value="<?php echo $singleRegionalManager->id; ?>" class="form-control form-control-rounded">
                      <input type="hidden" name="user_id" value="<?php echo $singleRegionalManager->user_id; ?>" class="form-control form-control-rounded">
                      <?php echo form_error('name', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
            
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Email</label>
                  <div class="col-sm-9">
                      <input type="email" name="email" value="<?php echo $singleRegionalManager->email; ?>"  class="form-control form-control-rounded">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Phone</label>
                  <div class="col-sm-9">
                      <input type="text" name="phone" value="<?php echo $singleRegionalManager->phone; ?>"  class="form-control form-control-rounded">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Login name</label>
                  <div class="col-sm-9">
                      <input type="text" name="user_email" value="<?php echo $singleRegionalManager->user_email; ?>"  class="form-control form-control-rounded">
                      <?php echo form_error('user_email', '<div class="error">', '</div>'); ?>
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
                <a href="<?php echo base_url('regional-manager-list');?>" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Update</button>
            </div>

            <?php echo form_close();?>
        </div>
     </div>
   </div>
</div>
<script>
    document.forms['update-regional-manager-particular'].elements['manager_id'].value=<?php echo $singleRegionalManager->manager_id; ?>;
    document.forms['update-regional-manager-particular'].elements['status'].value=<?php echo $singleRegionalManager->status; ?>;
</script>