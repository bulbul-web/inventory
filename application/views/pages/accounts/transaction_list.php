<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">All Transaction</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">All Transaction</li>
    </ol>
    </div>
    <div class="col-sm-3">
        <div class="top-button-area">
            <a class="btn btn-primary m-1" href="<?php echo base_url('account-transaction-add');?>"><i aria-hidden="true" class="fa fa-plus-circle"></i> New Transaction</a>
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
                <th>Voucher No</th>
                <th>Date</th>
                <th>Transaction Name</th>
                <th>CR</th>
                <th>DR</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
            
            <?php 
                $i = 0;
                foreach ($AllTransaction as $value){
                    $i++;
                
            ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $value->VoucherID;?></td>
                    <td>
                        <?php
                            $date = date_create("$value->TrnDate");
                            echo date_format($date,"d/m/Y");
                        ?>
                    </td>
                    <td>
                        <?php echo $value->TransHeadDescription;?>
                    </td>
                    <td>
                        <?php
                            echo $value->totalCR;
                        ?>
                    </td>
                    <td>
                        
                        <?php
                            echo $value->totalDR;
                        ?>
                    
                    </td>
                    <td>
                        <div class="btn-group m-1">
                            <a href="<?php echo base_url();?>edit-transaction-account/<?php echo $value->VoucherNo?>" class="btn btn-primary waves-effect waves-light"> <i class="fa fa-edit"></i> </a>
                            <a href="<?php echo base_url();?>delete-transaction-account/<?php echo $value->VoucherNo?>" onclick="return confirm('Are you sure to remove?')" class="btn btn-danger waves-effect waves-light" style="display: none;"> <i class="fa fa fa-trash-o"></i> </a>
                            
                         </div>
                    </td>
                </tr>
            <?php } ?>
            
        </tbody>
        <tfoot>
            <tr>
                <th>SL.</th>
                <th>Voucher No</th>
                <th>Date</th>
                <th>Transaction Name</th>
                <th>CR</th>
                <th>DR</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
    </div>
    </div>
  </div>
</div>
</div><!-- End Row-->