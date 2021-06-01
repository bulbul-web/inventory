<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">Add Pack Size</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
		<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('products-section');?>">Product Section</a></li>
    </ol>
    </div>
    <div class="col-sm-3">
        

     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
   <div class="col-lg-12">
     <div class="card">
        <div class="card-header text-uppercase">Add Pack Size Form</div>
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
            
            <?php echo form_open('update-pack-size', 'name="update-pack-size" id="updatePackSize"');?>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Pack Size Name</label>
                  <div class="col-sm-9">
                      <input type="hidden" name="id" value="<?php echo $value->id; ?>" class="form-control form-control-rounded">
                      <input type="text" placeholder="Pack size name" name="pack_size" value="<?php echo $value->pack_size; ?>" class="form-control form-control-rounded">
                      <?php echo form_error('pack_size', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Description</label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="Pack size description" name="description" value=""  class="form-control form-control-rounded">
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
                <a href="<?php echo base_url('pack-size');?>" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Update</button>
            </div>

            <?php echo form_close();?>
        </div>
     </div>
   </div>
</div>

<script>
    document.forms['update-pack-size'].elements['status'].value=<?php echo $value->status; ?>;
    document.forms['update-pack-size'].elements['description'].value="<?php echo $value->description; ?>";//description value from database
</script>