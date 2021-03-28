<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">Add Products</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">Add Products</li>
    </ol>
    </div>
    <div class="col-sm-3">
        

     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
   <div class="col-lg-12">
     <div class="card">
        <div class="card-header text-uppercase">Add Products Form</div>
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
            
            <?php echo form_open_multipart('save-qrcode', 'name="save-products" id="saveProducts"');?>
                
                
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Name</label>
                  <div class="col-sm-9">
                      <input type="text" name="name" value="<?php echo set_value('name'); ?>" class="form-control form-control-rounded">
                      <?php echo form_error('name', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
            
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Email</label>
                  <div class="col-sm-9">
                      <input type="email" name="email" value="<?php echo set_value('email'); ?>"  class="form-control form-control-rounded">
                      <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Mobile</label>
                  <div class="col-sm-9">
                      <input type="text" name="mobile" value="<?php echo set_value('mobile'); ?>"  class="form-control form-control-rounded">
                      <?php echo form_error('mobile', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                
                
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Website link</label>
                  <div class="col-sm-9">
                      <input type="text" name="website_link" value="<?php echo set_value('website_link'); ?>"  class="form-control form-control-rounded">
                      <?php echo form_error('website_link', '<div class="error">', '</div>'); ?>
                  </div>
                </div>

            <div class="form-footer">
                <a href="<?php echo base_url('qrcode');?>" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Save</button>
            </div>

            <?php echo form_close();?>
        </div>
     </div>
   </div>
</div>