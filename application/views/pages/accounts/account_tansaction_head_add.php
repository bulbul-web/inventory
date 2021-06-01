<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">Add Tansaction Head</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">Add Tansaction Head</li>
    </ol>
    </div>
    <div class="col-sm-3">
        

     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
   <div class="col-lg-12">
     <div class="card">
        <div class="card-header text-uppercase">Add Tansaction Head Form</div>
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
            
            <?php echo form_open_multipart('save-acnt-tansaction-head', 'name="save-acnt-tansaction-head" id="saveAcntTansactionHead"');?>
                
                
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Select Control Head</label>
                  <div class="col-sm-9">
                        <select name="ControlHead_id" id="ControlHead_id" class="form-control">
                                <option value="" disabled selected>----Select----</option>
                            <?php
                                $controlHead = $this->db->query("SELECT * FROM tbl_controlhead")->result();
                                foreach($controlHead as $value):
                            ?>
                                <option value="<?= $value->ControlHead_id;?>"><?= $value->HeadDescription;?></option>
                                
                            <?php endforeach;?>
                        </select>
                        <?php echo form_error('ControlHead_id', '<div class="error">', '</div>');?>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Select Sub Head</label>
                  <div class="col-sm-9">
                        <select name="SubHeadID" id="subheadlist" class="form-control">

                        </select>
                        <?php echo form_error('SubHeadID', '<div class="error">', '</div>');?>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Select Sub Sub Head</label>
                  <div class="col-sm-9">
                        <select name="SSubHeadID" id="subsubheadlist" class="form-control">

                        </select>
                        <?php echo form_error('SSubHeadID', '<div class="error">', '</div>');?>
                  </div>
                </div>

            
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Transaction Head Name</label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="Transaction head name" name="TransHeadDescription" value="<?php echo set_value('TransHeadDescription'); ?>"  class="form-control form-control-rounded">
                      <?php echo form_error('TransHeadDescription', '<div class="error">', '</div>')?>
                  </div>
                </div>  

                <div class="form-footer">
                    <a href="<?php echo base_url('acnt-tansaction-head-list');?>" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Save</button>
                </div>

            <?php echo form_close();?>
        </div>
     </div>
   </div>
</div>

<script>
    document.getElementById('ControlHead_id').value="<?php echo set_value('ControlHead_id'); ?>";
    document.getElementById('subheadlist').value="<?php echo set_value('SubHeadID'); ?>";
    document.getElementById('subsubheadlist').value="<?php echo set_value('SSubHeadID'); ?>";
</script>
<script>
    $(document).ready(function(){

        //get sub head by ControlHead_id
        $("#ControlHead_id").change(function(){
            var ControlHead_id = $("#ControlHead_id").val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>get-sub-head-by-contrl-id/"+ControlHead_id,
                success:function(data){
                    $("#subheadlist").html(data);
                }
            });
        });
        //get sub head by ControlHead_id

        //get Sub Sub head by ControlHead_id
        $("#subheadlist").change(function(){
            
            var SubHeadID = $("#subheadlist").val();
            // alert(SubHeadID);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>get-sub-sub-head-by-subId/"+SubHeadID,
                success:function(data){
                    $("#subsubheadlist").html(data);
                }
            });
        });
        //get Sub Sub head by ControlHead_id

    });
</script>