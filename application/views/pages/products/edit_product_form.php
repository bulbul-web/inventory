<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">Update Products</h4>
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
        <div class="card-header text-uppercase">Update Products Form</div>
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
            
            <?php echo form_open_multipart('update-products', 'name="update-products" id="updateProducts"');?>

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
                            <?php foreach($AllproductType as $productType){ ?>
                            <option value="<?php echo $productType->product_type_id;?>"><?php echo $productType->product_type_name;?></option>
                            <?php } ?>
                      </select>
                      <?php echo form_error('product_type_id', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Product Name</label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="Product name" name="product_name" value="<?php echo $singleProduct->product_name; ?>" class="form-control form-control-rounded">
                      <input type="hidden" name="product_id" value="<?php echo $singleProduct->product_id; ?>" class="form-control form-control-rounded">
                      <?php echo form_error('product_name', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Product Name Bangla</label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="Product name bangla" name="product_name_bangla" value="<?php echo $singleProduct->product_name_bangla; ?>" class="form-control form-control-rounded">
                  </div>
                </div>
            
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Product Description</label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="Product description" name="product_descrip" value="<?php echo $singleProduct->product_descrip; ?>"  class="form-control form-control-rounded">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Product Code</label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="Product code" name="product_code" value="<?php echo $singleProduct->product_code; ?>"  class="form-control form-control-rounded">
                      <?php echo form_error('product_code', '<div class="error">', '</div>'); ?>
                      <input type="hidden" name="old_barcode" value="<?php echo $singleProduct->barcode;?>">
                  </div>
                </div>
            
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Measurement Scale</label>
                  <div class="col-sm-9">
                      <select name="pack_size" id="packSize" class="form-control">
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
                      <input type="number" step=any placeholder="Product Buy Price" name="buy_price" value="<?php echo $singleProduct->buy_price; ?>"  class="form-control form-control-rounded">
                      <?php echo form_error('price', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
            
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Sell Price</label>
                  <div class="col-sm-9">
                      <input type="number" id="sellPrice" step=any placeholder="Product Sell Price" name="price" value="<?php echo $singleProduct->price; ?>"  class="form-control form-control-rounded">
                      <?php echo form_error('price', '<div class="error">', '</div>'); ?>
                  </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Trade price (percent) </label>
                        <div class="col-sm-9">
                            <input type="number" placeholder="Trade price (percent)" id="tradePricePrcnt" name="trade_price_prcnt" value="<?php echo $singleProduct->trade_price_prcnt; ?>"  class="form-control form-control-rounded">
                            <?php echo form_error('price', '<div class="error">', '</div>'); ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <!-- <label class="col-sm-3 col-form-label">Trade Price </label> -->
                        <div class="col-sm-9">
                            <input type="number" step=any id="percAmount"  class="form-control form-control-rounded" disabled="" value="<?php echo $singleProduct->trade_price; ?>">
                            <input type="hidden" step=any placeholder="Product Sell Price" name="trade_price" id="percAmountValue" value="<?php echo $singleProduct->trade_price; ?>" >
                            <?php echo form_error('price', '<div class="error">', '</div>'); ?>
                        </div>
                      </div>
                    </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Packet</label>
                  <div class="col-sm-9">
                      <select type="text" name="packet"  class="form-control">
                          <option value="" <?php if($singleProduct->packet == ''){?> selected="selected" <?php } ?>>--Select Packet---</option>
                          <option value="not" <?php if($singleProduct->packet == 'not'){?> selected="selected" <?php } ?>>No need</option>
                          <option value="Bosta" <?php if($singleProduct->packet == 'Bosta'){?> selected="selected" <?php } ?>>Bosta</option>
                          <option value="Carton" <?php if($singleProduct->packet == 'Carton'){?> selected="selected" <?php } ?>>Carton</option>
                          <option value="Cane" <?php if($singleProduct->packet == 'Cane'){?> selected="selected" <?php } ?>>Cane</option>
                      </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Pack quantity</label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="Pack quantity" name="total_pack_size" value="<?php echo $singleProduct->total_pack_size; ?>"  class="form-control form-control-rounded">
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Product Segment</label>
                  <div class="col-sm-9">
                      <input type="text" name="product_segment" placeholder="Product segment" value="<?php echo $singleProduct->product_segment; ?>"  class="form-control form-control-rounded">
                  </div>
                </div>


                <div class="form-group row">
                    <label for="rounded-input" class="col-sm-3 col-form-label">Image</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control"  name="image">
                        <input type="hidden" name="old_image" value="<?php echo $singleProduct->image;?>">
                        <span class="error">Upload (png/jpg) and size(400 x 400)</span>
                        <br/>
                        <br/>
                        <?php if($singleProduct->image == ""){ ?>
                        <img src="<?php echo base_url();?>assets/images/products/img-icon.jpg" class="product-img-own"/>
                        <?php } else {?>
                                <img src="<?php echo base_url().$singleProduct->image;?>" class="product-img-own"/>
                        <?php } ?>
                    </div>
                  </div>
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Status</label>
                  <div class="col-sm-9">
                      <select name="product_status" id="productStatus" class="form-control">
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                      </select>
                  </div>
                </div>
            <div class="form-footer">
                <a href="<?php echo base_url('products');?>" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Update</button>
            </div>

            <?php echo form_close();?>
        </div>
     </div>
   </div>
</div>
<script>
    document.forms['update-products'].elements['productCatId'].value=<?php echo $singleProduct->product_category_id; ?>;
    document.forms['update-products'].elements['productTypeId'].value=<?php echo $singleProduct->product_type_id; ?>;
    document.forms['update-products'].elements['productStatus'].value=<?php echo $singleProduct->product_status; ?>;
    document.forms['update-products'].elements['packSize'].value=<?php echo $singleProduct->pack_size; ?>;
</script>

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

  $(function(){
    
    $('#sellPrice').on('input', function() {
      calculate();
    });
    $('#tradePricePrcnt').on('input', function() {
     calculate();
    });

    function calculate(){
          var sellPrice = parseInt($('#sellPrice').val());
          var tradePricePrcnt = parseInt($('#tradePricePrcnt').val());
          var percAmount="";
          if(isNaN(sellPrice) || isNaN(tradePricePrcnt)){
              percAmount=" ";
            }else{
              percAmount = ((sellPrice * (tradePricePrcnt / 100)) + sellPrice ).toFixed(2);
              // percAmount = parseInt(percAmount) + parseInt(sellPrice);
            }
          
          $('#percAmount').val(percAmount);
          $('#percAmountValue').val(percAmount);
      }

    });
</script>