<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">Add Products Type</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
		<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('products-section');?>">Product Section</a></li>
    </ol>
    </div>
    <div class="col-sm-3">
      <div class="top-button-area">
          <a class="btn btn-primary m-1" href="<?php echo base_url('product-type');?>"><i aria-hidden="true" class="fa fa-plus-circle"></i> Product type list</a>
      </div>

    </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
   <div class="col-lg-12">
     <div class="card">
        <div class="card-header text-uppercase">Add Products Type Form</div>
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
            
            <?php echo form_open('save-products-type', 'name="save-products-type" id="saveProductsType"');?>

                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Product Category</label>
                  <div class="col-sm-9">
                      <select name="product_category_id" class="form-control" required="">
                          <option value="">Select Product Category</option>
                          <?php
                            $productCategory = $this->query_model->viewAllproductCategory();
                            foreach ($productCategory as $value) {
                                                      
                          ?>
                            <option value="<?php echo $value->id;?>"><?php echo $value->name;?></option>
                          <?php } ?>
                      </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Product Type Name</label>
                  <div class="col-sm-9">
                      <input type="text" name="product_type_name" value="<?php echo set_value('product_type_name'); ?>" class="form-control form-control-rounded">
                      <?php echo form_error('product_type_name', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Products Description</label>
                  <div class="col-sm-9">
                      <input type="text" name="product_type_descrip" value="<?php echo set_value('product_type_descrip'); ?>"  class="form-control form-control-rounded">
                  </div>
                </div>
                
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Status</label>
                  <div class="col-sm-9">
                      <select name="product_type_status" class="form-control">
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                      </select>
                  </div>
                </div>
            <div class="form-footer">
                <a href="<?php echo base_url('products-section');?>" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Save</button>
            </div>

            <?php echo form_close();?>
        </div>
     </div>
   </div>
</div>