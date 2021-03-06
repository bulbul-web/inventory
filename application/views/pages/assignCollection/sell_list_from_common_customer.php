<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-6">
    <h4 class="page-title">All Assign Sell</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">All Transaction</li>
    </ol>
    </div>
     <div class="col-sm-6">
        
        <div class="top-button-area">
            <a class="btn btn-primary m-1" href="<?php echo base_url('sell-from-common-customer-add');?>"><i aria-hidden="true" class="fa fa-plus-circle"></i> Assign Sell</a>
        </div>
        <div class="top-button-area">
            <a class="btn btn-primary m-1" href="<?php echo base_url('sell-list-from-common-customer');?>"><i class="fa fa-retweet" aria-hidden="true"></i></a>
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
                <th>Date</th>
                <th>Customer Name</th>
                <th>Note</th>
                <th>Assign Amount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
            
            <?php 
                $i = 0;
                foreach ($allSellAsignList as $value){
                    $i++;
                
            ?> 
                <tr>
                    <td><?php echo $i;?></td>
                    <td>
                        <?php
                            $date = date_create("$value->trns_date");
                            echo date_format($date,"d/m/Y");
                        ?>
                    </td>
                    <td>
                        <?php 
                            echo $value->customer_name;
                        ?>
                    </td>
                    <td>
                        <?php
                            if($value->note == ""){
                                echo '-';
                            }else{
                                echo $value->note;
                            }
                        ?>
                    </td>
                    
                    <td>
                        <?php
                            echo $value->sell_amount;
                        ?>
                    </td>
                    <td>
                        
                        <?php 
                            if($value->status == 1){
                        ?>
                            
                            <span class="badge badge-primary m-1">Active</span>
                        <?php
                            }
                        ?>
                        
                        <?php 
                            if($value->status == 0){
                        ?>
                            <span class="badge badge-danger m-1">Inactive</span>
                        <?php
                            }
                        ?>
                    
                    </td>
                    <td>
                        <div class="btn-group m-1">
                            <a href="<?php echo base_url();?>edit-assign-amount/<?php echo $value->id?>" class="btn btn-primary waves-effect waves-light"> <i class="fa fa-edit"></i> </a>
                            <a href="<?php echo base_url();?>delete-assign-amount/<?php echo $value->id?>" onclick="return confirm('Are you sure to remove?')" class="btn btn-danger waves-effect waves-light"> <i class="fa fa fa-trash-o"></i> </a>
                            
                         </div>
                    </td>
                </tr>
            <?php } ?>
            
        </tbody>
        <tfoot>
            <tr>
                <th>SL.</th>
                <th>Date</th>
                <th>Customer Name</th>
                <th>Note</th>
                <th>Assign Amount</th>
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