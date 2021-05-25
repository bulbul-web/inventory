<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">All Product</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
		<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('products-section');?>">Product Section</a></li>
    </ol>
    </div>
    <div class="col-sm-3">
        <div class="top-button-area">
            <a class="btn btn-primary m-1" href="<?php echo base_url('products-form');?>"><i aria-hidden="true" class="fa fa-plus-circle"></i> Add Products</a>
        </div>

     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
<div class="col-lg-12">
  <div class="card">
    <div class="card-header"><i class="fa fa-table"></i> Data Exporting
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
    </div>
    <div class="card-body">
      <div class="table-responsive">
      <table id="example" class="table table-bordered">
        <thead>
            <tr>
                <th>SL.</th>
                <th>Image</th>
                <th>Products Name</th>
                <th>Code</th>
                <th>Measurement Scale</th>
                <th>Price</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
            
            <?php 
                $i = 0;
                foreach ($products as $value){
                    $i++;
                
            ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td>
                        <?php if($value->image == ""){ ?>
                        <img src="<?php echo base_url();?>assets/images/products/img-icon.jpg" class="product-img-own"/>
                        <?php } else {?>
                                <img src="<?php echo base_url().$value->image;?>" class="product-img-own"/>
                        <?php } ?>
                    </td>
                    <td>
                        <?php
                            //$prTId = $value->product_type_id;
                            //$proType = $this->query_model->single_product_type($prTId);
                            if($value->product_name == ""){
                                echo '-';
                            }else{
                                echo '<a href="'.base_url().'product-details/'.$value->product_id.'">'.$value->product_name.'</a>';
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            if($value->barcode == ""){
                                echo $value->product_code;
                            }else{
                                echo '<img src="'.base_url().''.$value->barcode.'" class="product-img-own"/>';
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            if($value->pack_size_name == ""){
                                echo '-';
                            }else{
                                echo $value->pack_size_name;
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            if($value->price == ""){
                                echo '-';
                            }else{
                                echo $value->price;
                            }
                        ?>
                    </td>
                    
                    <td>
                        
                        <?php 
                            if($value->product_status == 1){
                        ?>
                            
                            <span class="badge badge-primary m-1">Active</span>
                        <?php
                            }
                        ?>
                        
                        <?php 
                            if($value->product_status == 0){
                        ?>
                            <span class="badge badge-danger m-1">Inactive</span>
                        <?php
                            }
                        ?>
                    
                    </td>
                    <td>
                        <div class="btn-group m-1">
                            <a href="<?php echo base_url();?>edit-product/<?php echo $value->product_id?>" class="btn btn-primary waves-effect waves-light"> <i class="fa fa-edit"></i> </a>
                            <a href="<?php echo base_url();?>delete-product/<?php echo $value->product_id?>" onclick="return confirm('Are you sure to remove?')" class="btn btn-danger waves-effect waves-light" style="display: none;"> <i class="fa fa fa-trash-o"></i> </a>
                            
                         </div>
                    </td>
                </tr>
            <?php } ?>
            
        </tbody>
        <tfoot>
            <tr>
                <th>SL.</th>
                <th>Image</th>
                <th>Products Name</th>
                <th>Code</th>
                <th>Measurement Scale</th>
                <th>Price</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
    </div>
    </div>
  </div>
</div>
</div><!-- End Row-->