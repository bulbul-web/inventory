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
            <a class="btn btn-primary m-1" href="<?php echo base_url();?>customer-wise-report-payment"><i class="fa fa-retweet" aria-hidden="true"></i></a>
        </div>
     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
<div class="col-lg-12">
  <div class="card">
      <div class="card-header">Date Wise Report (Customer Payment)</div>
    <div class="card-body">
        <?php echo form_open_multipart('customer-wise-report-payment', 'name="customer-wise-report-payment" id="customerWiseReportPayment" autocomplete="off"');?>
        <div class="row"> 
                
            <!-- <div class="col-md-5">
                <div class="form-group row">
                    <label class="col-sm-12 col-form-label">From Date</label>
                    <div class="col-sm-12">
                        <input type="text" name="from_date" id="fromDate" value="<?php echo set_value('from_date');?>" class="form-control form-control-rounded" required="">
                    </div>
                  </div>
            </div> -->

            <!-- <div class="col-md-5">
                <div class="form-group row">
                    <label class="col-sm-12 col-form-label">To Date</label>
                    <div class="col-sm-12">
                        <input type="text" name="to_date" id="toDate" value="<?php echo set_value('to_date');?>" class="form-control form-control-rounded" required="">
                    </div>
                  </div>
            </div> -->

            <div class="col-md-2">
                <div class="form-group row">
                    <label class="col-sm-12 col-form-label">&nbsp;</label>
                    <div class="col-sm-12">
                        <button type="submit" name="submit" value="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> Report</button>
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
                    // if(isset($_POST['from_date'])):
                    if(isset($_POST['submit'])):
                ?>
                <center>
                    <?php
                        $companyInfo = $this->db->query('SELECT * FROM tbl_company where id = 1')->row();
                    ?>
                    <img src="<?php echo base_url().$companyInfo->file;?>" class="logo-icon" alt="logo icon" style="width: 90px;">
                    <h3 class="text-dark" style="padding: 0; margin: 0; line-height: 35px;"><?php echo $companyInfo->name;?></h3>
                    <p style="margin: 0px; padding: 0px;"><?php echo $companyInfo->address;?></p></br>
                </center>
                
                <h5 style="text-align: center; text-decoration: underline;">Customer Wise payment details</h5>
                <!-- <center style="color: green; font-size: 18px; font-weight: bold;">
                    
                    <?php
                    if (isset($from_date)):
                        echo "From: (" . date("d-m-Y", strtotime($from_date)).")";
                    endif;

                    if (isset($to_date)):
                        echo " To (" . date("d-m-Y", strtotime($to_date)).")";
                    endif;
                    ?>
                </center> -->
                <br>
                <div style="overflow-x:auto; width: 100%;">
					<table width="100%" border="1">
						<thead>
							<tr>
								<th  style="text-align: center;">#</th>
								<th  style="text-align: center;">Customer Name.</th>
								<th  style="text-align: center;">Total</th>
								<th  style="text-align: center;">Discount</th>
								<th  style="text-align: center;">Paid</th>
								<th  style="text-align: center;">Due</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$sl = 0;
								$netGrandTotal = 0;
								$totalDiscount = 0;
								$dueTotal = 0;
								$total = 0;
								foreach($result as $value):
									$sl++;
									$netGrandTotal += $value->grandTotal;
									$totalDiscount += $value->discount;
									$grandTotal = ($value->grandTotal - $value->discount);
									$dueTotal += $grandTotal - $value->paid_amount;
									$total += $value->paid_amount;
							?>
								<tr>
									<td  style="text-align: center;"><?= $sl;?></td>
									<td  style="text-align: center;"><?= $value->customer_name;?></td>
									<td  style="text-align: center;"><?= $value->grandTotal;?></td>
									<td  style="text-align: center;"><?= $value->discount;?></td>
									<td  style="text-align: center;"><?= $value->paid_amount;?></td>
									<td  style="text-align: center;">
										<?php
											//after discount then grandtotal and then show the due
											$grandTotal = ($value->grandTotal - $value->discount);
											$due = $grandTotal - $value->paid_amount;
											echo $due;
										?>
									</td>
								</tr>
							<?php endforeach;?>
								<tr>
									<td colspan="2" style="text-align: right;">Total:</td>
									<td style="text-align: center;"><b><?= $netGrandTotal;?></b></td>
									<td style="text-align: center;"><b><?= $totalDiscount;?></b></td>
									<td style="text-align: center;"><b><?= $total;?></b></td>
									<td style="text-align: center;"><b><?php echo $dueTotal;?></b>
									</td>
								</tr>
						</tbody>
					</table>
				</div>
                <?php endif;?>
            </div>
        </div>
        </div>
    </div>
      
  </div>
</div>
</div><!-- End Row-->
<a href="<?php echo base_url('all-report-section');?>" class="btn btn-secondary"><i class="fa fa-angle-left"></i> Back to report section</a><br>
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
<script>
    // document.forms['nameMonthReport'].elements['customerId'].value=<?php //echo $singleCustomer->customer_d; ?>;//for active inactive.
</script>