<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">Add Fiscal Year</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">Add Fiscal Year</li>
    </ol>
    </div>
    <div class="col-sm-3">
        

     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
   <div class="col-lg-12">
     <div class="card">
        <div class="card-header text-uppercase">Add Fiscal Year Form</div>
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
            
            <?php echo form_open_multipart('save-fiscal-year', 'name="save-fiscal-year" id="saveFiscalYear"');?>
                
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">First Day of the fiscal year</label>
                  <div class="col-sm-3">                        
                        <input type="date" name="startDate" value="<?php echo date('Y-m-d'); ?>" class="form-control form-control-rounded">
                        <?php echo form_error('startDate', '<div class="error">', '</div>'); ?>
                  </div>
                </div>  
                
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Last Day of the fiscal year</label>
                  <div class="col-sm-3">                        
                        <input type="date" name="endDate" value="" class="form-control form-control-rounded">
                        <?php echo form_error('endDate', '<div class="error">', '</div>'); ?>
                  </div>
                </div>  

                
                <div class="form-footer">
                    <a href="<?php echo base_url('fiscal-year');?>" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Save</button>
                </div>

            <?php echo form_close();?>
        </div>
     </div>
   </div>
</div>

