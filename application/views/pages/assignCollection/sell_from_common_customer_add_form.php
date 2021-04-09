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
            <a class="btn btn-primary m-1" href="<?php echo base_url('sell-list-from-common-customer');?>"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back</a>
        </div>
        <div class="top-button-area">
            <a class="btn btn-primary m-1" href="<?php echo base_url('sell-from-common-customer-add');?>"><i class="fa fa-retweet" aria-hidden="true"></i></a>
        </div>

    </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
   <div class="col-lg-12">
     <div class="card">
        <div class="card-header text-uppercase">
        
        <?php
            if(isset($title)){
                echo $title;
            }
        ?> Form</div>
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
            
            <?php echo form_open('save-assign-sell', 'name="save-assign-sell" id="saveAssignSell"');?>

            <div class="row">

                <div class="col-md-4">
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label">Date</label>
                        <div class="col-sm-12">
                            <input id="trnsDate" type="text" name="trns_date" value="<?php echo date('Y-m-d'); ?>" class="form-control" required/>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-8">
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label">Customers</label>
                        <div class="col-sm-12">
                            <select name="customer_id" id="customerId" class="form-control" required>
                                <option value="">--Select Customer--</option>
                                <?php foreach($allCustomer as $value):?>
                                    <option value="<?php echo $value->customer_id;?>" ><?php echo $value->customer_name;?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                </div>
            
            </div>


            <div class="row">

                <div class="col-md-4">
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label">Amount</label>
                        <div class="col-sm-12">
                            <input type="number" step=any name="sell_amount" value="0" class="form-control" required/>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label">Note</label>
                        <div class="col-sm-12">
                            <input type="text" name="note" value="" class="form-control"/>
                        </div>
                    </div>
                </div>

            </div>


            <div class="form-footer">
                <a href="<?php echo base_url('sell-list-from-common-customer');?>" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Save</button>
            </div>

            <?php echo form_close();?>
        </div>
     </div>
   </div>
</div>

<script type='text/javascript'>
$(document).ready(function(){
    $( "#trnsDate" ).datepicker({dateFormat: "yy-mm-dd"});
});
</script>