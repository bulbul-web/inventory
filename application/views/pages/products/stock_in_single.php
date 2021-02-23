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
            <a class="btn btn-primary m-1" href="<?php echo base_url('stock-in-form');?>"><i aria-hidden="true" class="fa fa-plus-circle"></i> Add Stock In</a>
        </div>

     </div>
</div>
<!-- End Breadcrumb-->
<div class="row">
<div class="col-lg-12">
  <div class="card">
    <div class="card-header"><i class="fa fa-table"></i> Data Exporting</div>
    <div class="card-body">
        <h3 class="text-center"><?=$singleStockIn->product_name;?></h3>
        <p class="text-center">Quantity: <strong><?=$singleStockIn->quantity_in;?></strong></p>
        <p class="text-center">Challan Date: <strong><?=$singleStockIn->challan_date;?></strong></p>
      <div class="table-responsive">
      <table class="table table-bordered">
          <tr>
              <td width="20%"><strong>Warehouse</strong></td>
              <td><?= $singleStockIn->warehouse_name;?></td>
          </tr>
          <tr>
              <td><strong>Supplier</strong></td>
              <td><?= $singleStockIn->supplier_name;?></td>
          </tr>
          <tr>
              <td><strong>Bill No.</strong></td>
              <td><?= $singleStockIn->bill_no;?></td>
          </tr>
          <tr>
              <td><strong>Bill Date</strong></td>
              <td><?= $singleStockIn->bill_date;?></td>
          </tr>
          <tr>
              <td><strong>Buying Price</strong></td>
              <td><?= $singleStockIn->buying_price;?></td>
          </tr>
          <tr>
              <td><strong>Sale Price</strong></td>
              <td><?= $singleStockIn->sale_price;?></td>
          </tr>
          <tr>
              <td><strong>Note</strong></td>
              <td><?= $singleStockIn->note;?></td>
          </tr>
          <tr>
              <td><strong>Status</strong></td>
              <td>
                <?php 
                    if($singleStockIn->status == 1){
                ?>

                    <span class="badge badge-primary m-1">Active</span>
                <?php
                    }
                ?>

                <?php 
                    if($singleStockIn->status == 0){
                ?>
                    <span class="badge badge-danger m-1">Inactive</span>
                <?php
                    }
                ?>
              </td>
          </tr>
          <!-- <tr>
              <td><strong>Entry Date</strong></td>
              <td><?= $singleStockIn->entry_date;?></td>
          </tr> -->
          <tr>
              <td><strong>Entry By</strong></td>
              <td><?= $singleStockIn->entry_by;?></td>
          </tr>
      </table>
    </div>
        
    </div>
      
  </div>
</div>
</div><!-- End Row-->

<a href="<?php echo base_url('products-stock-in');?>" class="btn btn-secondary"><i class="fa fa-angle-left"></i> Back To Stock In List</a><br>
