<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">order</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">order</li>
    </ol>
    </div>
    <div class="col-sm-3">
        
        <div class="top-button-area">
            <a class="btn btn-primary m-1" href="<?php echo base_url('salesman-order-form');?>"><i aria-hidden="true" class="fa fa-plus-circle"></i> Add order</a>
        </div>
        <div class="top-button-area">
            <a class="btn btn-primary m-1" href="<?php echo base_url('salesman-order');?>"><i class="fa fa-retweet" aria-hidden="true"></i></a>
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
                <th>order ID</th>
                <th>Customer Name</th>
                <th>Total</th>
                <th>Paid</th>
                <th>Discount</th>
                <th>Due</th>
                <th>Date</th>
                <th>Note</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $userRole = $this->session->userdata('user_role');
                $i=0; 
                foreach ($order as $value):
                $i++;
            ?>
            <tr>
                <td>
                    <?php 
                        if($userRole == 1){
                            echo $i;
                        }else {    
                    ?>
                        <a href="<?php echo base_url();?>edit-salesman-order/<?php echo $value->order_id;?>"> <i class="fa fa-edit"></i> <?php echo $i;?> </a>
                    <?php } ?>
                </td>
                <td>
                    <?php 
                        echo '<a href="'. base_url().'salesman-order-details/'.$value->order_id.'">'.$value->order_id.'</a>';
                        if($value->order_by != NULL){
                            if($userRole == 1){
                                $user = $this->db->query("SELECT * FROM tbl_user WHERE user_id = '$value->order_by' ")->row();
                                echo '<br>('.$user->user_name.')';
                            }
                        }
                    ?>
                </td>
                <td><?php echo $value->customer_name;?></td>
                <td>
                    <?php
                        echo $value->grandTotal;
                    ?>
                </td>
                <td>
                    <?php
                        echo $value->paid_amount;
                    ?>
                </td>
                <td>
                    <?php
                        echo $value->discount;
                    ?>
                </td>
                <td>
                    <?php 
                        echo ($value->grandTotal - $value->discount) - $value->paid_amount;
                    ?>
                </td>
                <td>
                    <?php
                        $date = date_create("$value->order_date");
                        echo date_format($date,"d/m/Y");
                     ?>
                </td>
                <td>
                    <?php if(isset($value->note)): echo $value->note; else: echo '-'; endif;?>
                </td>
                <td>
                        
                    <?php 
                        if($value->order_status == 1){
                    ?>

                        <span class="badge badge-primary m-1">Accept</span>
                    <?php
                        }
                    ?>

                    <?php 
                        if($value->order_status == 0){
                    ?>
                        <span class="badge badge-danger m-1">Pending</span>
                    <?php
                        }
                    ?>

                </td>
                <td>
                    <div class="btn-group m-1">
                        <?php
                            
                            if($userRole == 1){
                                echo '<a href="'. base_url().'salesman-order-details/'.$value->order_id.'">View/Accept</a>';
                            }else{
                        ?>
                            <a href="<?php echo base_url();?>edit-salesman-order/<?php echo $value->order_id;?>" class="btn btn-primary waves-effect waves-light"> <i class="fa fa-edit"></i> </a>
                            <a href="<?php echo base_url();?>delete-salesman-order/<?php echo $value->order_id;?>" onclick="return confirm('Are you sure to remove?')" class="btn btn-danger waves-effect waves-light" style="display: none;"> <i class="fa fa fa-trash-o"></i> </a>
                        <?php } ?>
                        
                     </div>
                </td>
            </tr>
            <?php endforeach;?>
            
        </tbody>
        <tfoot>
            <tr>
                <th>SL.</th>
                <th>order ID</th>
                <th>Customer Name</th>
                <th>Total</th>
                <th>Paid</th>
                <th>Discount</th>
                <th>Due</th>
                <th>Date</th>
                <th>Note</th>
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
