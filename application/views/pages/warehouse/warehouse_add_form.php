<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">Add Warehouse</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">Add Warehouse</li>
    </ol>
    </div>
    <div class="col-sm-3">
      <div class="top-button-area">
          <a class="btn btn-primary m-1" href="<?php echo base_url('warehouse');?>"><i aria-hidden="true" class="fa fa-plus-circle"></i> Warehouse list</a>
      </div>

    </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
   <div class="col-lg-12">
     <div class="card">
        <div class="card-header text-uppercase">Add Warehouse Form</div>
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
            
            <?php echo form_open('save-warehouse', 'name="save-warehouse" id="saveWarehouse"');?>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Warehouse Name</label>
                  <div class="col-sm-9">
                      <input type="text" placeholder="Outlet/warehouse name" name="warehouse_name" value="<?php echo set_value('warehouse_name'); ?>" class="form-control form-control-rounded">
                      <?php echo form_error('warehouse_name', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Warehouse Address</label>
                  <div class="col-sm-9">
                      <input type="text" name="warehouse_address" placeholder="address" value="<?php echo set_value('warehouse_address'); ?>"  class="form-control form-control-rounded">
                      <?php echo form_error('warehouse_address', '<div class="error">', '</div>'); ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Status</label>
                  <div class="col-sm-9">
                      <select name="warehouse_status" class="form-control">
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                      </select>
                  </div>
                </div>
            <div class="form-footer">
                <a href="<?php echo base_url('warehouse');?>" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Save</button>
            </div>

            <?php echo form_close();?>
        </div>
     </div>
   </div>
</div>