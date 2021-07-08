<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">Add Products</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
		<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('products-section');?>">Product Section</a></li>
    </ol>
    </div>
    <div class="col-sm-3">
        <div class="top-button-area">
            <a class="btn btn-primary m-1" href="<?php echo base_url('products');?>"><i aria-hidden="true" class="fa fa-plus-circle"></i> Products list</a>
        </div>

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
            
            <?php echo form_open_multipart('save-products', 'name="save-products" id="saveProducts"');?>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Product Category</label>
                  <div class="col-sm-9">
                      <select name="product_category_id" id="productCatId" class="form-control" onChange="getProductTypeByProdCatId(this.value)">
                            <option value="">Select Category</option>
                            <?php
                              $AllproductCategory = $this->db->query("SELECT * FROM tbl_product_category WHERE status = 1")->result();
                              foreach($AllproductCategory as $productCategory){ 
                            ?>
                            <option value="<?php echo $productCategory->id;?>"><?php echo $productCategory->name;?></option>
                            <?php } ?>
                      </select>
                      <?php echo form_error('product_category_id', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Product Type</label>
                  <div class="col-sm-9">
                      <select name="product_type_id" id="productTypeId" class="form-control">
                            <option value="">Select Product Type</option>
                      </select>
                      <?php echo form_error('product_type_id', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Product Name</label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="Product name" name="product_name" value="<?php echo set_value('product_name'); ?>" class="form-control form-control-rounded">
                      <?php echo form_error('product_name', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Product Name Bangla</label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="Product name bangla" name="product_name_bangla" value="<?php echo set_value('product_name_bangla'); ?>" class="form-control form-control-rounded">
                  </div>
                </div>
            
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Product Description</label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="Product description" name="product_descrip" value="<?php echo set_value('product_descrip'); ?>"  class="form-control form-control-rounded">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Product Code</label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="Product code" name="product_code" value="<?php echo set_value('product_code'); ?>"  class="form-control form-control-rounded">
                      <?php echo form_error('product_code', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Measurement Scale</label>
                  <div class="col-sm-9">
                      <select name="pack_size" class="form-control">
                            <option value="">Select Measurement Scale</option>
                            <?php
                                $AllPackSize = $this->db->query("select * from tbl_pack_size")->result();
                                
                                foreach($AllPackSize as $packSize){ 
                            ?>
                                <option value="<?php echo $packSize->id;?>"><?php echo $packSize->pack_size;?></option>
                            <?php } ?>
                      </select>
                      <?php echo form_error('pack_size', '<div class="error">', '</div>'); ?>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Buy Price</label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="Product Buy Price" name="buy_price" value="<?php echo set_value('buy_price'); ?>"  class="form-control form-control-rounded">
                      <?php echo form_error('price', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Sell Price </label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="Product Sell Price" name="price" value="<?php echo set_value('price'); ?>"  class="form-control form-control-rounded">
                      <?php echo form_error('price', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Packet</label>
                  <div class="col-sm-9">
                      <select type="text" name="packet"  class="form-control" required="required">
                          <option value="">--Select Packet---</option>
                          <option value="not">No need</option>
                          <option value="Bosta">Bosta</option>
                          <option value="Carton">Carton</option>
                          <option value="Cane">Cane</option>
                      </select>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Pack quantity</label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="Pack quantity" name="total_pack_size" value="<?php echo set_value('total_pack_size'); ?>"  class="form-control form-control-rounded">
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Product Segment</label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="Product segment" name="product_segment" value="<?php echo set_value('product_segment'); ?>"  class="form-control form-control-rounded">
                  </div>
                </div>
            
                <div class="form-group row">
                    <label for="rounded-input" class="col-sm-3 col-form-label">Image</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control"  name="image">
                        <span class="error">Upload (png/jpg) and size(400 x 400)</span>
                    </div>
                  </div>
                
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Status</label>
                  <div class="col-sm-9">
                      <select name="product_status" class="form-control">
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

<script type="text/javascript">
  function getProductTypeByProdCatId(catagory_id){
    $.ajax({
      type: 'post',
      data: {catagory_id: catagory_id},
      url: '<?php echo base_url()?>Products/getProductTypeByProdCatId',
      success: function (response) {
              document.getElementById("productTypeId").innerHTML = response;
          }
    });
  }
</script>