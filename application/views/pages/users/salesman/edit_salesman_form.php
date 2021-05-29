<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">Update salesman form</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
       <li class="breadcrumb-item"><a href="<?php echo base_url('marketing-setup-section');?>">Marketing Section</a></li>
    </ol>
    </div>
    <div class="col-sm-3">
        

     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
   <div class="col-lg-12">
     <div class="card">
        <div class="card-header text-uppercase">Update salesman form</div>
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
            
            <?php echo form_open_multipart('update-salesman-particular', 'name="update-salesman-particular" id="updateSalesmanParticular"');?>
                
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Select Manager</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="manager_id" id="manager_id" onChange="getRegiionalManagerByManagerId(this.value);">
                      <option value="">Select Manager</option>
                      <?php
                        foreach ($managerListActive as $value) {
                      ?>
                        <option value="<?php echo $value->id?>"><?php echo $value->name;?></option>
                      <?php } ?>
                    </select>
                    <?php echo form_error('manager_id', '<div class="error">', '</div>'); ?>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Select Regional Manager</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="regional_manager_id" id="regional_manager_id">
                      <option value="">Select Regioinal Manager</option>
                      <?php
                        $regionalManagerListActiveMatch = $this->db->query("select * from tbl_regional_manager where manager_id = '$singleSalesman->manager_id' ")->result();
                        foreach ($regionalManagerListActiveMatch as $value) {
                         
                      ?>
                        <option value="<?php echo $value->id?>"><?php echo $value->name;?></option>
                      <?php } ?>
                    </select>
                    <?php echo form_error('regional_manager_id', '<div class="error">', '</div>'); ?>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Name</label>
                  <div class="col-sm-9">
                      <input type="text" name="name" value="<?php echo $singleSalesman->name; ?>" class="form-control form-control-rounded">
                      <input type="hidden" name="id" value="<?php echo $singleSalesman->id; ?>" class="form-control form-control-rounded">
                      <input type="hidden" name="user_id" value="<?php echo $singleSalesman->user_id; ?>" class="form-control form-control-rounded">
                      <?php echo form_error('name', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
            
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Email</label>
                  <div class="col-sm-9">
                      <input type="email" name="email" value="<?php echo $singleSalesman->email; ?>"  class="form-control form-control-rounded">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Phone</label>
                  <div class="col-sm-9">
                      <input type="text" name="phone" value="<?php echo $singleSalesman->phone; ?>"  class="form-control form-control-rounded">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Login name</label>
                  <div class="col-sm-9">
                      <input type="text" name="user_email" value="<?php echo $singleSalesman->user_email; ?>"  class="form-control form-control-rounded">
                      <?php echo form_error('user_email', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                        <select name="status" id="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

            <div class="form-footer">
                <a href="<?php echo base_url('salesman-list');?>" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Update</button>
            </div>

            <?php echo form_close();?>
        </div>
     </div>
   </div>
</div>
<script>
  function getRegiionalManagerByManagerId(manager_id){
      var manager_id = $("#manager_id").val();
      $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>Users/findRegionalManager',
          data: {
              manager_id: manager_id
          },
          success: function (response) {
              document.getElementById("regional_manager_id").innerHTML = response;
          }
      });
    }

  
    $( document ).ready(function() {
        
        $("#manager_id").val(<?php echo $singleSalesman->manager_id; ?>);
        $("#status").val(<?php echo $singleSalesman->status; ?>);
        $("#regional_manager_id").val(<?php echo $singleSalesman->regional_manager_id; ?>);
                    
    })

    
</script>