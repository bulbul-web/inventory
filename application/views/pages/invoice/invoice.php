<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">Invoice</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">invoice</li>
    </ol>
    </div>
    <div class="col-sm-3">
        
        <div class="top-button-area">
            <a class="btn btn-primary m-1" href="<?php echo base_url('invoice-form');?>"><i aria-hidden="true" class="fa fa-plus-circle"></i> Add Invoice</a>
        </div>
        <div class="top-button-area">
            <a class="btn btn-primary m-1" href="<?php echo base_url('invoice');?>"><i class="fa fa-retweet" aria-hidden="true"></i></a>
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
                <th>Voucher ID</th>
                <th>Customer Name</th>
                <th>Total</th>
                <th>Paid</th>
                <th>Discount</th>
                <th>Due</th>
                <th>Date</th>
                <th>Note</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $i=0; 
                foreach ($invoice as $value):
                $i++;
            ?>
            <tr>
                <td><a href="<?php echo base_url();?>edit-invoice/<?php echo $value->voucher_id;?>"> <i class="fa fa-edit"></i> <?php echo $i;?> </a></td>
                <td><?php echo '<a href="'. base_url().'invoice-details/'.$value->voucher_id.'">'.$value->voucher_id.'</a>';?></td>
                <td><?php echo $value->customer_name;?></td>
                <td>
                    <?php
                        echo $value->grandTotal;
                    ?>
                </td>
                <td>
                    <?php
                        echo $value->paid_amount;
                    ?>
                </td>
                <td>
                    <?php
                        echo $value->discount;
                    ?>
                </td>
                <td>
                    <?php 
                        echo ($value->grandTotal - $value->discount) - $value->paid_amount;
                    ?>
                </td>
                <td>
                    <?php
                        $date = date_create("$value->invoice_date");
                        echo date_format($date,"d/m/Y");
                     ?>
                </td>
                <td>
                    <?php if(isset($value->note)): echo $value->note; else: echo '-'; endif;?>
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
                        <a href="<?php echo base_url();?>invoice-status/<?php echo $value->voucher_id;?>/<?php echo $value->status;?>" class="btn btn-dark waves-effect waves-light"> 
                            <?php
                                if($value->status == 0){
                                    echo '<i class="fa fa-eye" aria-hidden="true"></i>';
                                }else{
                                    echo '<i class="fa fa-eye-slash" aria-hidden="true"></i>';
                                }
                            ?>
                        </a>
                        <a href="<?php echo base_url();?>edit-invoice/<?php echo $value->voucher_id;?>" class="btn btn-primary waves-effect waves-light"> <i class="fa fa-edit"></i> </a>
                        <a href="<?php echo base_url();?>delete-invoice/<?php echo $value->voucher_id;?>" onclick="return confirm('Are you sure to remove?')" class="btn btn-danger waves-effect waves-light" style="display: none;"> <i class="fa fa fa-trash-o"></i> </a>
                        
                     </div>
                </td>
            </tr>
            <?php endforeach;?>
            
        </tbody>
        <tfoot>
            <tr>
                <th>SL.</th>
                <th>Voucher ID</th>
                <th>Customer Name</th>
                <th>Total</th>
                <th>Paid</th>
                <th>Discount</th>
                <th>Due</th>
                <th>Date</th>
                <th>Note</th>
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
