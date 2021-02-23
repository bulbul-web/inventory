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
            <a class="btn btn-primary m-1" href="<?php echo base_url();?>month-report"><i class="fa fa-retweet" aria-hidden="true"></i></a>
        </div>
     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
<div class="col-lg-12">
  <div class="card">
      <div class="card-header">Customer Wise Products Report</div>
    <div class="card-body">
        <?php echo form_open_multipart('product-out-by-customer', 'name="product-out-by-customer" id="productOutByCustomer" autocomplete="off"');?>
        <div class="row"> 
            <div class="col-md-4">
                <div class="form-group row">
                    <label class="col-sm-12 col-form-label">Customers</label>
                    <div class="col-sm-12">
                        <select name="customer_id" class="form-control" required>
                            <option value="">--Select Customer--</option>
                            <?php foreach($allCustomer as $value):?>
                                <option value="<?php echo $value->customer_id;?>"><?php echo $value->customer_name;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                  </div>
            </div>
            <div class="col-md-3">
                <div class="form-group row">
                    <label class="col-sm-12 col-form-label">From Date</label>
                    <div class="col-sm-12">
                        <input type="text" name="from_date" id="fromDate" value="<?php echo set_value('from_date');?>" class="form-control form-control-rounded" required="">
                    </div>
                  </div>
            </div>
            <div class="col-md-3">
                <div class="form-group row">
                    <label class="col-sm-12 col-form-label">To Date</label>
                    <div class="col-sm-12">
                        <input type="text" name="to_date" id="toDate" value="<?php echo set_value('to_date');?>" class="form-control form-control-rounded" required="">
                    </div>
                  </div>
            </div>
            
            <div class="col-md-2">
                <div class="form-group row">
                    <label class="col-sm-12 col-form-label">&nbsp;</label>
                    <div class="col-sm-12">
                        <button type="submit" value="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> Report</button>
                    </div>
                  </div>
            </div>
        </div>
        <hr>
        
        <?php form_close();?>
        <div id="print_content">
        <div class="row">
            <div class="col-md-12">
                <?php
                    if(isset($_POST['customer_id'])):
                ?>
                <center style="color: green; font-size: 18px; font-weight: bold;">
                    (<?php echo $singleCustomer->customer_name;?>)<br>
                    Phone no: <?php echo $singleCustomer->customer_mobile;?><br>
                    Address: <?php echo $singleCustomer->customer_address;?><br>
                    <?php
                        if (isset($from_date)):
                            echo "From: (" . date("d-m-Y", strtotime($from_date)).")";
                        endif;

                        if (isset($to_date)):
                            echo " To (" . date("d-m-Y", strtotime($to_date)).")";
                        endif;
                    ?>
                </center>
                <br>
                
                <table width="100%" border="1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Total Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sl=0;
                            foreach ($customerWiseProductInfo as $value):
                            $sl++
                        ?>
                        <tr>
                            <td><?= $sl;?></td>
                            <td><?= $value->product_name;?></td>
                            <td><?= $value->totalQuantity;?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <?php endif;?>
            </div>
        </div>
        </div>
    </div>
      
  </div>
</div>
</div><!-- End Row-->
<a href="<?php echo base_url('invoice');?>" class="btn btn-secondary"><i class="fa fa-angle-left"></i> Back To Invoice List</a><br>
<button id="btnPrint" class="btn btn-primary" style="float: right;"> <i class="fa fa-print" aria-hidden="true" style="font-size: 25px; margin-right: 10px;"></i>Print</button>
<script>
    $("#btnPrint").on("click", function() {
        //alert($(window).height());
        var ht = $(window).height();
        var wt = $(window).width();
        var divContents = $("#print_content").html();
        var printWindow = window.open('', '', 'height=' + ht + 'px,width=' + wt + 'px');
        printWindow.document.write('<html><head><title>f</title>');
        
        printWindow.document.write('<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet"/>');
        
        
        printWindow.document.write('</head><body>');
        printWindow.document.write(divContents);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    });
</script>
<script>
    $(document).ready(function(){
        $( "#fromDate" ).datepicker({dateFormat: "yy-mm-dd"});
        $( "#toDate" ).datepicker({dateFormat: "yy-mm-dd"});
    });
</script>
