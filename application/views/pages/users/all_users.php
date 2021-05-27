<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">User List</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">User List</li>
    </ol>
    </div>
    <div class="col-sm-3">
        <div class="top-button-area">
            <a class="btn btn-primary m-1" href="<?php echo base_url('add-user');?>"><i aria-hidden="true" class="fa fa-plus-circle"></i> Add Admin</a>
        </div>

     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
<div class="col-lg-12">
  <div class="card">
    <div class="card-header"><i class="fa fa-table"></i> Data Exporting
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
    </div>
    <div class="card-body">
      <div class="table-responsive">
      <table id="example" class="table table-bordered">
        <thead>
            <tr>
                <th>SL.</th>
                <th>Name</th>
                <th>User Role</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
            
            <?php 
                $i = 0;
                foreach ($userList as $value){
                    $i++;
                
            ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td>
                        <?php
                            if($value->user_name == ""){
                                echo '-';
                            }else{
                                echo $value->user_name;
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            if($value->user_role == 1){
                                echo 'Admin';
                            }elseif($value->user_role == 2){
                                echo 'Dealer';
                            }elseif($value->user_role == 3){
                                echo 'Sales Man';
                            }
                        ?>
                    </td>
                    <td>
                        
                        <?php 
                            if($value->status == 1){
                        ?>
                            
                            <span class="badge badge-primary m-1">Active</span>
                        <?php
                            }
                        ?>
                        
                        <?php 
                            if($value->status == 0){
                        ?>
                            <span class="badge badge-danger m-1">Inactive</span>
                        <?php
                            }
                        ?>
                    
                    </td>
                    <td>
                        <div class="btn-group m-1">
                            <a href="<?php echo base_url();?>edit-user/<?php echo $value->user_id?>" class="btn btn-primary waves-effect waves-light"> <i class="fa fa-edit"></i> </a>
                            <!-- <a href="<?php echo base_url();?>" onclick="return confirm('Are you sure to remove?')" class="btn btn-danger waves-effect waves-light" style="display: none;"> <i class="fa fa fa-trash-o"></i> </a> -->
                            
                         </div>
                    </td>
                </tr>
            <?php } ?>
            
        </tbody>
        <tfoot>
            <tr>
                <th>SL.</th>
                <th>Name</th>
                <th>User Role</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
    </div>
    </div>
  </div>
</div>
</div><!-- End Row-->
