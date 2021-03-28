<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">QR Code List</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">All QR Code</li>
    </ol>
    </div>
    <div class="col-sm-3">
        <div class="top-button-area">
            <a class="btn btn-primary m-1" href="<?php echo base_url('qrcode-form');?>"><i aria-hidden="true" class="fa fa-plus-circle"></i> New Qr Code Generate</a>
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
                <th>QR Code</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
            
            <?php 
                $i = 0;
                foreach ($qrcodelist as $value){
                    $i++;
                
            ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td>
                        <?php if($value->qrcode == ""){ ?>
                        <img src="<?php echo base_url();?>assets/images/products/img-icon.jpg" class="product-img-own"/>
                        <?php } else {?>
                                <img src="<?php echo base_url().$value->qrcode;?>" class="product-img-own"/>
                        <?php } ?>
                    </td>
                    
                    <td>
                        <div class="btn-group m-1">
                            <a href="<?php echo base_url();?>edit-product/<?php echo $value->id?>" class="btn btn-primary waves-effect waves-light"> <i class="fa fa-eye"></i> View</a>
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