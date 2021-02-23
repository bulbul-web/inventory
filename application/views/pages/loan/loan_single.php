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
            <a class="btn btn-primary m-1" href="<?php echo base_url('loan-form');?>"><i aria-hidden="true" class="fa fa-plus-circle"></i> New Loan</a>
        </div>

     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
<div class="col-lg-12">
  <div class="card">
    <div class="card-header"><i class="fa fa-table"></i> Data Exporting</div>
    <div class="card-body">
        <h3 class="text-center">Loan From "<?=$loanSingle->loan_from;?>"</h3>
        <h6 class="text-center">Date: (<?=$loanSingle->start_date;?>) To (<?=$loanSingle->end_date;?>)</h6>
      <div class="table-responsive">
      <table class="table table-bordered">
          <tr>
              <td width="20%"><strong>Mobile</strong></td>
              <td><?= $loanSingle->mobile;?></td>
          </tr>
          <tr>
              <td><strong>Email</strong></td>
              <td><?= $loanSingle->email;?></td>
          </tr>
          <tr>
              <td><strong>Address</strong></td>
              <td><?= $loanSingle->address;?></td>
          </tr>
          <tr>
              <td><strong>Description</strong></td>
              <td><?= $loanSingle->description;?></td>
          </tr>
          <tr>
              <td><strong>Amount</strong></td>
              <td><?= $loanSingle->loan_amount;?></td>
          </tr>
          <tr>
              <td><strong>Status</strong></td>
              <td>
                <?php 
                    if($loanSingle->status == 1){
                ?>

                    <span class="badge badge-primary m-1">Active</span>
                <?php
                    }
                ?>

                <?php 
                    if($loanSingle->status == 0){
                ?>
                    <span class="badge badge-danger m-1">Inactive</span>
                <?php
                    }
                ?>
              </td>
          </tr>
          <tr>
              <td><strong>Entry Date</strong></td>
              <td><?= $loanSingle->entry_date;?></td>
          </tr>
          <tr>
              <td><strong>Entry By</strong></td>
              <td><?= $loanSingle->entry_by;?></td>
          </tr>
      </table>
    </div>
        
    </div>
      
  </div>
</div>
</div><!-- End Row-->

<a href="<?php echo base_url('loan');?>" class="btn btn-secondary"><i class="fa fa-angle-left"></i> Back To Loan List</a><br>

