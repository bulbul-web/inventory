<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">Add Tansaction</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">Add Tansaction</li>
    </ol>
    </div>
    <div class="col-sm-3">
        

     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
   <div class="col-lg-12">
     <div class="card">
        <div class="card-header text-uppercase">Add Tansaction Form</div>
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
            
            <?php echo form_open_multipart('save-acnt-tansaction', 'name="save-acnt-tansaction" id="saveAcntTansaction"');?>
                
                
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Transaction Date</label>
                  <div class="col-sm-5">
                        <input type="text" name="TrnDate" id="datepicker" value="<?php echo date('Y-m-d'); ?>" class="form-control form-control-rounded">
                        <?php echo form_error('TrnDate', '<div class="error">', '</div>'); ?>
                    </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Select Project Name</label>
                  <div class="col-sm-9">
                        <select name="project_id" id="project_id" class="form-control">
                                <option value="" disabled selected>----Select----</option>
                            <?php
                                $projects = $this->db->query("SELECT * FROM tbl_project WHERE status = 1")->result();
                                foreach($projects as $value):
                            ?>
                                <option value="<?= $value->project_id;?>"><?= $value->project_name;?></option>
                                
                            <?php endforeach;?>
                        </select>
                        <?php echo form_error('project_id', '<div class="error">', '</div>');?>
                  </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Transaction Type</label>
                    <div class="col-sm-9">
                        <select name="V_Type" id="V_Type" class="form-control">
                            <option value="" disabled selected>----Select----</option>
                            <option value="DR">DR</option>
                            <option value="CR">CR</option>
                        </select>
                        <?php echo form_error('V_Type', '<div class="error">', '</div>');?>
                    </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Select Control Head</label>
                  <div class="col-sm-9">
                        <select name="ControlHead_id" id="ControlHead_id" class="form-control">
                            
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
                        <input type="number" step=any name="CR"  class="form-control" value="<?php echo set_value('CR'); ?>">
                        <?php echo form_error('CR', '<div class="error">', '</div>');?>
                  </div>
                </div>
                
                <!---dr amount--->
                <div class="form-group row" id="drRow">
                  <label class="col-sm-3 col-form-label">Amount</label>
                  <div class="col-sm-5">
                        <input type="number" step=any name="DR"  class="form-control" value="<?php echo set_value('DR'); ?>">
                        <?php echo form_error('DR', '<div class="error">', '</div>');?>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Note</label>
                  <div class="col-sm-9">
                        <input type="text" name="Note"  class="form-control" value="<?php echo set_value('Note'); ?>">
                        <?php echo form_error('Note', '<div class="error">', '</div>');?>
                  </div>
                </div>

             

                <div class="form-footer">
                    <a href="<?php echo base_url('transaction-list');?>" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Save</button>
                </div>

            <?php echo form_close();?>
        </div>
     </div>
   </div>
</div>

<script>
    document.getElementById('V_Type').value="<?php echo set_value('V_Type'); ?>";
</script>
<script>
    $(document).ready(function(){
        $("#datepicker").datepicker({dateFormat: "yy-mm-dd"});
        $("#crRow").hide();
        $("#drRow").hide();
        //get sub head by ControlHead_id

        $("#V_Type").change(function(){
            v_type = $("#V_Type").val();
            // alert(v_type);

            $.ajax({
                type: "POST",
                // url: "<?php echo base_url();?>get-transaction-by-v-type/"+v_type,
                url: "<?php echo base_url();?>get-control-head-by-v-type/"+v_type,
                success:function(data){
                    $("#ControlHead_id").html(data);
                }
            });

            if(v_type == 'DR'){
                $("#crRow").hide();
                $("#drRow").show();
            }else if(v_type == "CR"){
                $("#crRow").show();
                $("#drRow").hide();
            }

            $("#ControlHead_id").change(function(){
                ControlHead_id = $("#ControlHead_id").val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>get-transaction-by-contrl-head-id/"+ControlHead_id,
                    success:function(data){
                        $("#TransactionHeaID").html(data);
                    }
                });
            });

        });
        //get sub head by ControlHead_id
        

    });
</script>