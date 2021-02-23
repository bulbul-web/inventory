<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">Update Product Type</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">Update Product Type</li>
    </ol>
    </div>
    <div class="col-sm-3">
        

     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
   <div class="col-lg-12">
     <div class="card">
        <div class="card-header text-uppercase">Update Product Type Form</div>
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
            
            <?php echo form_open('update-product-type', 'name="update-product-type" id="updateProductType"');?>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Product Type Name</label>
                  <div class="col-sm-9">
                      <input type="text" name="product_type_name" value="<?php echo $singleProductType->product_type_name; ?>" class="form-control form-control-rounded">
                      <input type="hidden" name="product_type_id" value="<?php echo $singleProductType->product_type_id; ?>" class="form-control form-control-rounded">
                      <?php echo form_error('product_type_name', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Products Description</label>
                  <div class="col-sm-9">
                      <input type="text" name="product_type_descrip" value="<?php echo $singleProductType->product_type_descrip; ?>"  class="form-control form-control-rounded">
                  </div>
                </div>
                
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Status</label>
                  <div class="col-sm-9">
                      <select name="product_type_status" id="productTypeStatus" value="<?php echo $singleProductType->product_type_status; ?>" class="form-control">
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                      </select>
                  </div>
                </div>
            <div class="form-footer">
                <a href="<?php echo base_url('product-type');?>" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Save</button>
            </div>

            <?php echo form_close();?>
        </div>
     </div>
   </div>
</div>

<script>
    document.forms['update-product-type'].elements['productTypeStatus'].value=<?php echo $singleProductType->product_type_status; ?>;//for active inactive.
</script>