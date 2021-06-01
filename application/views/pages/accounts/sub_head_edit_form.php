<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">Update Customer</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">Update Customer</li>
    </ol>
    </div>
    <div class="col-sm-3">
        

     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
   <div class="col-lg-12">
     <div class="card">
        <div class="card-header text-uppercase">Update Customer Form</div>
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
            
            <?php echo form_open_multipart('update-acnt-sub-head', 'name="update-acnt-sub-head" id="updateAcntSubHead"');?>
                
                
                
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
                  <label class="col-sm-3 col-form-label">Enter Sub Head Name</label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="Sub head name" name="SubHeadDescription" value="<?php echo $SubHeadSingle->SubHeadDescription; ?>"  class="form-control form-control-rounded">
                      <?php echo form_error('SubHeadDescription', '<div class="error">', '</div>')?>
                  </div>
                </div>  

                <input type="hidden" name="SubHeadID" value="<?php echo $SubHeadSingle->SubHeadID; ?>" />

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Note</label>
                  <div class="col-sm-9">
                      <input type="number" placeholder="Note" name="note" value="0" value="<?php echo $SubHeadSingle->note; ?>"  class="form-control form-control-rounded" required="">
                  </div>
                </div>              
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">View as detail in Balance Sheet</label>
                  <div class="col-sm-9">
                      <input type="checkbox" name="viewState" class="checkbox-style" value="view" <?php if ($SubHeadSingle->viewState == 'view'): ?> checked <?php endif; ?>/>
                  </div>
                </div>
            <div class="form-footer">
                <a href="<?php echo base_url('account-sub-head');?>" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Update</button>
            </div>

            <?php echo form_close();?>
        </div>
     </div>
   </div>
</div>

<script>
    document.forms['update-acnt-sub-head'].elements['ControlHead_id'].value=<?php echo $SubHeadSingle->ControlHead_id;?>;
</script>