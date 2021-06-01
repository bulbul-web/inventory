<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">Add Opening Balance</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">Add Opening Balance</li>
    </ol>
    </div>
    <div class="col-sm-3">
        

     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
   <div class="col-lg-12">
     <div class="card">
        <div class="card-header text-uppercase">Add Opening Balance Form</div>
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
            
            <?php echo form_open_multipart('save-opening-balance', 'name="save-opening-balance" id="saveOpeningBalance"');?>
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Select Date</label>
                  <div class="col-sm-5">
                        <input type="text" placeholder="Opening balance Date" name="opening_balance_date" id="datepicker" value="<?php echo date('Y-m-d'); ?>" class="form-control form-control-rounded">
                        <?php echo form_error('opening_balance_date', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Select Control Head</label>
                  <div class="col-sm-9">
                        <select name="ControlHead_id" id="ControlHead_id" class="form-control">
                                <option value="" disabled selected>----Select----</option>
                            <?php
                                $controlHead = $this->db->query("SELECT * FROM tbl_controlhead WHERE HeadDescription != 'Expenditure' AND  HeadDescription != 'Income'")->result();
                                foreach($controlHead as $value):
                            ?>
                                <option value="<?= $value->ControlHead_id;?>"><?= $value->HeadDescription;?></option>
                                
                            <?php endforeach;?>
                        </select>
                        <?php echo form_error('ControlHead_id', '<div class="error">', '</div>');?>
                  </div>
                </div>

                               

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Select Transaction Head</label>
                  <div class="col-sm-9">
                        <select name="TransactionHeadID" id="TransactionHeaID" class="form-control">

                        </select>
                        <?php echo form_error('TransactionHeadID', '<div class="error">', '</div>');?>
                  </div>
                </div>

                <!---cr amount--->
                <div class="form-group row" id="crRow">
                  <label class="col-sm-3 col-form-label">Amount</label>
                  <div class="col-sm-5">
                        <input type="number" step=any name="CR" placeholder="CR"  class="form-control">
                        <?php echo form_error('CR', '<div class="error">', '</div>');?>
                  </div>
                </div>
                
                <!---dr amount--->
                <div class="form-group row" id="drRow">
                  <label class="col-sm-3 col-form-label">Amount</label>
                  <div class="col-sm-5">
                        <input type="number" step=any name="DR" placeholder="DR" class="form-control">
                        <?php echo form_error('DR', '<div class="error">', '</div>');?>
                  </div>
                </div>

             

                <div class="form-footer">
                    <a href="<?php echo base_url('opening-balance');?>" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Save</button>
                </div>

            <?php echo form_close();?>
        </div>
     </div>
   </div>
</div>

<script>
    document.getElementById('ControlHead_id').value="<?php echo set_value('ControlHead_id'); ?>";
    document.getElementById('TransactionHeadID').value="<?php echo set_value('TransactionHeadID'); ?>";
</script>
<script>
    $(document).ready(function(){
        $("#datepicker").datepicker({dateFormat: "yy-mm-dd"});
        $("#crRow").hide();
        $("#drRow").hide();
        //get sub head by ControlHead_id

        $("#ControlHead_id").change(function(){
            var ControlHead_id = $("#ControlHead_id").val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>get-transaction-by-contrl-head-id/"+ControlHead_id,
                success:function(data){
                    $("#TransactionHeaID").html(data);
                }
            });

            if(ControlHead_id == 1 || ControlHead_id ==2){
                $("#crRow").hide();
                $("#drRow").show();
            }else if(ControlHead_id == 3 || ControlHead_id ==4){
                $("#crRow").show();
                $("#drRow").hide();
            }

        });
        //get sub head by ControlHead_id
        

    });
</script>