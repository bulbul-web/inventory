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
            <a class="btn btn-primary m-1" href="<?php echo base_url('amount-recieved-list-from-common-customer');?>"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back</a>
        </div>
        <div class="top-button-area">
            <a class="btn btn-primary m-1" href="<?php echo base_url().'edit-received-amount/'.$SellReceivedSingle->id;?>"><i class="fa fa-retweet" aria-hidden="true"></i></a>
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
            
            <?php echo form_open('update-received-amount', 'name="update-received-amount" id="updateReceivedAmount"');?>

            <div class="row">

                <div class="col-md-4">
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label">Date</label>
                        <div class="col-sm-12">
                            <input id="trnsDate" type="text" name="trns_date" value="<?php echo $SellReceivedSingle->trns_date; ?>" class="form-control" required/>
                        </div>
                    </div>
                </div>
                    <input type="hidden" name="id" value="<?php echo $SellReceivedSingle->id;?>"/>
                
                <div class="col-md-8">
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label">Customers</label>
                        <div class="col-sm-12">
                            <select name="customer_id" class="form-control" required>
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
                            <input type="number" step=any name="recived_amount" value="<?php echo $SellReceivedSingle->recived_amount?>" class="form-control" required/>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label">Note</label>
                        <div class="col-sm-12">
                            <input type="text" name="note" value="<?php echo $SellReceivedSingle->note?>" class="form-control"/>
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-9">
                    <select name="status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>


            <div class="form-footer">
                <a href="<?php echo base_url('amount-recieved-list-from-common-customer');?>" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Update</button>
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
document.forms['update-received-amount'].elements['status'].value=<?php echo $SellReceivedSingle->status; ?>;//for active inactive.
document.forms['update-received-amount'].elements['customer_id'].value=<?php echo $SellReceivedSingle->customer_id; ?>;//for active inactive.
</script>