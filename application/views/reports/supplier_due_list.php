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
            <a class="btn btn-primary m-1" href="<?php echo base_url();?>supplier-due-list"><i class="fa fa-retweet" aria-hidden="true"></i></a>
        </div>
     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
<div class="col-lg-12">
  <div class="card">
      <div class="card-header">Supplier due list</div>
    <div class="card-body">
        <div id="print_content">
        <div class="row">
            <div class="col-md-12">
                
                <h5 style="text-align: center; text-decoration: underline;">Supplier due list</h5>
                <br>
                <div style="overflow-x:auto; width: 100%;">
					<table width="100%" border="1" style="text-align: center;">
						<thead>
							<tr>
								<th>#</th>
								<th>Supplier Name</th>
								<th>Bill no</th>
								<th>Total Amount</th>
								<th>Paid</th>
								<th>Due</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$sl=0;
								$totalAmount = 0;
								$netTotalPaymant = 0;
								$totalDue = 0;
								foreach ($supplierDueList as $value):
									$totalAmount = $totalAmount + $value->totalBuyingPrice;
									$netTotalPaymant = $netTotalPaymant + $value->totalPayment;
									$totalDue = $totalDue + $value->due;
									$sl++
							?>
							<tr>
								<td><?php echo $sl;?></td>
								<td><?php echo $value->supplier_name;?></td>
								<td><?php echo '<a href=" '.base_url().'purchase-report/'.$value->bill_no.' " target="_BLANK"> '.$value->bill_no.'</a>';?></td>
								<td><?php echo $value->totalBuyingPrice;?></td>
								<td><?php echo $value->totalPayment;?></td>
								<td><?php echo $value->due;?></td>
							</tr>
							<?php endforeach;?>
							<tr>
								<td colspan="3" style="text-align: right"><b>Total:</b></td>
								<td><b><?php echo $totalAmount;?></b></td>
								<td><b><?php echo $netTotalPaymant;?></b></td>
								<td><b><?php echo $totalDue;?></b></td>
							</tr>
						</tbody>
					</table>
				</div>
            </div>
        </div>
        </div>
    </div>
      
  </div>
</div>
</div><!-- End Row-->
<a href="<?php echo base_url('stock-report-section');?>" class="btn btn-secondary"><i class="fa fa-angle-left"></i> Back to report section</a><br>
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
