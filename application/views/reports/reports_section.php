<style>
    .report-section .fxd-height{
        min-height: 108px;
    }
    .report-section .fxd-height .text-white{
        font-weight: bold;
    }

</style>
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
            <a class="btn btn-primary m-1" href="<?php echo base_url();?>all-report-section"><i class="fa fa-retweet" aria-hidden="true"></i></a>
        </div>
     </div>
</div>
<!-- End Breadcrumb-->

<?php
    $user_role = $this->session->userdata('user_role');
    if($user_role == 3){
?>

<div class="report-section">
    <div class="row">
        
        <div class="col-12 col-lg-6 col-xl-2">
            <a href="<?php echo base_url('all-products-stock-report');?>">
                <div class="card bg-pattern-danger fxd-height">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body text-left">
                                <!-- <h4 class="text-white">ddd</h4> -->
                                <span class="text-white">Stock Report</span>
                            </div>
                            <!-- <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                                
                            </div> -->
                        </div>
                    </div>
                </div>
            </a>
        </div>

        
    </div>
</div>

<?php } elseif ($user_role == 1) { ?>

<div class="report-section">
    <div class="row">


        <div class="col-12 col-lg-6 col-xl-2">
            <a href="<?php echo base_url('name-month-report');?>">
                <div class="card bg-pattern-primary fxd-height">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body text-left">
                                <!-- <h4 class="text-white">ddd</h4> -->
                                <span class="text-white">Name and Date wise Invoice</span>
                            </div>
                            <!-- <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                                
                            </div> -->
                        </div>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-12 col-lg-6 col-xl-2">
            <a href="<?php echo base_url('month-report');?>">
                <div class="card bg-pattern-danger fxd-height">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body text-left">
                                <!-- <h4 class="text-white">ddd</h4> -->
                                <span class="text-white">Date wise Invoice</span>
                            </div>
                            <!-- <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                                
                            </div> -->
                        </div>
                    </div>
                </div>
            </a>
        </div>



        <div class="col-12 col-lg-6 col-xl-2">
            <a href="<?php echo base_url('stock-report');?>">
                <div class="card bg-pattern-warning fxd-height">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body text-left">
                                <!-- <h4 class="text-white">ddd</h4> -->
                                <span class="text-white">Product Wise Stock Report</span>
                            </div>
                            <!-- <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                                
                            </div> -->
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-12 col-lg-6 col-xl-2">
            <a href="<?php echo base_url('datewise-stock-report');?>">
                <div class="card bg-pattern-primary fxd-height">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body text-left">
                                <!-- <h4 class="text-white">ddd</h4> -->
                                <span class="text-white">Datewise Product Stock Report</span>
                            </div>
                            <!-- <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                                
                            </div> -->
                        </div>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-12 col-lg-6 col-xl-2">
            <a href="<?php echo base_url('datewise-product-out');?>">
                <div class="card bg-pattern-success fxd-height">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body text-left">
                                <!-- <h4 class="text-white">ddd</h4> -->
                                <span class="text-white">Datewise Product Out</span>
                            </div>
                            <!-- <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                                
                            </div> -->
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-12 col-lg-6 col-xl-2">
            <a href="<?php echo base_url('product-out-by-customer');?>">
                <div class="card bg-pattern-success fxd-height">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body text-left">
                                <!-- <h4 class="text-white">ddd</h4> -->
                                <span class="text-white">Product out by customer</span>
                            </div>
                            <!-- <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                                
                            </div> -->
                        </div>
                    </div>
                </div>
            </a>
        </div>

                

        <div class="col-12 col-lg-6 col-xl-2">
            <a href="<?php echo base_url('customer-wise-report-payment');?>">
                <div class="card bg-pattern-primary fxd-height">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body text-left">
                                <!-- <h4 class="text-white">ddd</h4> -->
                                <span class="text-white">Customer wise payment</span>
                            </div>
                            <!-- <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                                
                            </div> -->
                        </div>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-12 col-lg-6 col-xl-2">
            <a href="<?php echo base_url('all-products-stock-report');?>">
                <div class="card bg-pattern-danger fxd-height">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body text-left">
                                <!-- <h4 class="text-white">ddd</h4> -->
                                <span class="text-white">Stock Report</span>
                            </div>
                            <!-- <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                                
                            </div> -->
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-12 col-lg-6 col-xl-2">
            <a href="<?php echo base_url('datewise-collection-from-customer');?>">
                <div class="card bg-pattern-primary fxd-height">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body text-left">
                                <!-- <h4 class="text-white">ddd</h4> -->
                                <span class="text-white">Datewise Collection from customer</span>
                            </div>
                            <!-- <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                                
                            </div> -->
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-12 col-lg-6 col-xl-2">
            <a href="<?php echo base_url('datewise-collection');?>">
                <div class="card bg-pattern-primary fxd-height">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body text-left">
                                <!-- <h4 class="text-white">ddd</h4> -->
                                <span class="text-white">Datewise Collection</span>
                            </div>
                            <!-- <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                                
                            </div> -->
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12 col-lg-6 col-xl-2">
            <a href="<?php echo base_url('supplier-and-datewise-buy-product');?>">
                <div class="card bg-pattern-warning fxd-height">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body text-left">
                                <!-- <h4 class="text-white">ddd</h4> -->
                                <span class="text-white">Supplier and datewise buy product</span>
                            </div>
                            <!-- <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                                
                            </div> -->
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12 col-lg-6 col-xl-2">
            <a href="<?php echo base_url('datewise-buy-product');?>">
                <div class="card bg-pattern-warning fxd-height">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body text-left">
                                <!-- <h4 class="text-white">ddd</h4> -->
                                <span class="text-white">Datewise buy product</span>
                            </div>
                            <!-- <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                                
                            </div> -->
                        </div>
                    </div>
                </div>
            </a>
        </div>



    </div>
</div>

<?php } ?>
