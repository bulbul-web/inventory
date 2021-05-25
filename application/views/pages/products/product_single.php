<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">
        <?php
            if(isset($title)){
                echo $title;
            }
        ?>
    </h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
		<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('products-section');?>">Product Section</a></li>
       <li class="breadcrumb-item active" aria-current="page">
           <?php
                if(isset($title)){
                    echo $title;
                }
            ?>
       </li>
    </ol>
    </div>
    <div class="col-sm-3">
        <div class="top-button-area">
            <a class="btn btn-primary m-1" href="<?php echo base_url('products-form');?>"><i aria-hidden="true" class="fa fa-plus-circle"></i> Add Product</a>
        </div>

     </div>
</div>
<!-- End Breadcrumb-->
<div class="row">
<div class="col-lg-12">
  <div class="card">
    <div class="card-header"><i class="fa fa-table"></i> Data Exporting</div>
    <div class="card-body">
        <h3 class="text-center"><?=$singleProduct->product_name;?></h3>
        <center>
            <img src="<?php echo base_url().$singleProduct->image;?>" style="height: 100px; width: 100px;"/>
        </center>
      <div class="table-responsive">
      <table class="table table-bordered">
          <tr>
              <td width="20%"><strong>Product Type</strong></td>
              <td><?= $singleProduct->product_type_name;?></td>
          </tr>
          
          <tr>
              <td><strong>Description</strong></td>
              <td><?= $singleProduct->product_descrip;?></td>
          </tr>
          <tr>
              <td><strong>Code</strong></td>
              <td><?= $singleProduct->product_code;?></td>
          </tr>
          <tr>
              <td><strong>Measurement Scale</strong></td>
              <td><?= $singleProduct->pack_size_name;?></td>
          </tr>
          <tr>
              <td><strong>Total Price</strong></td>
              <td><?= $singleProduct->price;?></td>
          </tr>
          <tr>
              <td><strong>Status</strong></td>
              <td>
                <?php 
                    if($singleProduct->product_status == 1){
                ?>

                    <span class="badge badge-primary m-1">Active</span>
                <?php
                    }
                ?>

                <?php 
                    if($singleProduct->product_status == 0){
                ?>
                    <span class="badge badge-danger m-1">Inactive</span>
                <?php
                    }
                ?>
              </td>
          </tr>
          <tr>
              <td><strong>Entry Date</strong></td>
              <td><?= $singleProduct->entry_date;?></td>
          </tr>
          <tr>
              <td><strong>Entry By</strong></td>
              <td><?= $singleProduct->entry_by;?></td>
          </tr>
      </table>
    </div>
        
    </div>
      
  </div>
</div>
</div><!-- End Row-->

<a href="<?php echo base_url('products');?>" class="btn btn-secondary"><i class="fa fa-angle-left"></i> Back To Product List</a><br>
