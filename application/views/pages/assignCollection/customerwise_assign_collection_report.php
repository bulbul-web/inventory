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
      <div class="card-header">
        <?php
            if(isset($title)){
                echo $title;
            }
        ?>
      </div>
    <div class="card-body">
        <?php echo form_open_multipart('customerwise-assign-collection-report', 'name="customerwise-assign-collection-report" id="customerwiseAssignCollectionReport" autocomplete="off"');?>
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
                        <input type="text" placeholder="From date" name="from_date" id="fromDate" value="<?php echo set_value('from_date');?>" class="form-control form-control-rounded" required="">
                    </div>
                  </div>
            </div>
            <div class="col-md-3">
                <div class="form-group row">
                    <label class="col-sm-12 col-form-label">To Date</label>
                    <div class="col-sm-12">
                        <input type="text" placeholder="To date" name="to_date" id="toDate" value="<?php echo set_value('to_date');?>" class="form-control form-control-rounded" required="">
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
                <h5 style="text-align: center; text-decoration: underline;">Customerwise assign collection report</h5>
                <center style="color: green; font-size: 18px; font-weight: bold;">
                    (<?php echo $singleCustomer->customer_name;?>)<br>
                    Phone no: <?php echo $singleCustomer->customer_mobile;?><br>
                    Address: <?php echo $singleCustomer->customer_address;?><br>
                    <?php
                        if (isset($_POST['from_date'])){
                            echo "From: (" . date("d-m-Y", strtotime($_POST['from_date'])).")";
                        }

                        if (isset($_POST['to_date'])){
                            echo " To (" . date("d-m-Y", strtotime($_POST['to_date'])).")";
                        }
                    ?>
                </center>
                <br>
                <p style="text-align: right; font-weight: bold; font-size: 16px;">Previous Due: <?php if(empty($customerWiseAssgnClctnBfrCrtnDate->Totaldue)){echo '0';}else{echo round($customerWiseAssgnClctnBfrCrtnDate->Totaldue, 2);}?> &nbsp; &nbsp; </p>
                <table width="100%" border="1" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Note</th>
                            <th>Sell Amount</th>
                            <th>Received Amount</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sl=0;
                            $balance = round($customerWiseAssgnClctnBfrCrtnDate->Totaldue, 2);
                            $totalSell_amount = 0;
                            $totalRecived_amount = 0;
                            $totalDue = 0;
                            foreach ($customerWiseAssignCollection as $value):
                                $totalSell_amount += $value->sell_amount;
                                $totalRecived_amount += $value->recived_amount;
                                $totalDue += $value->due;
                            $sl++
                        ?>
                        <tr>
                            <td><?= $sl;?></td>
                            <td><?= $value->trns_date;?></td>
                            <td><?= $value->note;?></td>
                            <td><?= $value->sell_amount;?></td>
                            <td><?= $value->recived_amount;?></td>
                            <td>
                                <?php
                                    echo $balance = ($balance + $value->sell_amount) - $value->recived_amount;
                                ?>
                            </td>
                        </tr>
                        <?php endforeach;?>
                        <tr>
                            <td colspan="3" style="text-align: right;"><b>Total:</b></td>
                            <td><b><?php echo $netTotalSell = $totalSell_amount + $customerWiseAssgnClctnBfrCrtnDate->Totaldue;?></b></td>
                            <td><b><?php echo $totalRecived_amount;?></b></td>
                            <td><b>--</b></td>
                        </tr>
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
<a href="<?php echo base_url('assign-collection-report-section');?>" class="btn btn-secondary"><i class="fa fa-angle-left"></i> Back To Report Section</a><br>
<button id="btnPrint" class="btn btn-primary" style="float: right;"> <i class="fa fa-print" aria-hidden="true" style="font-size: 25px; margin-right: 10px;"></i>Print</button>
<script>
    $("#btnPrint").on("click", function() {
        //alert($(window).height());
        var ht = $(window).height();
        var wt = $(window).width();
        var divContents = $("#print_content").html();
        var printWindow = window.open('', '', 'height=' + ht + 'px,width=' + wt + 'px');
        printWindow.document.write('<html><head><title></title>');
        
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
