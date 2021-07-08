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
            <a class="btn btn-primary m-1" href="<?php echo base_url();?>datewise-buy-product"><i class="fa fa-retweet" aria-hidden="true"></i></a>
        </div>
     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
<div class="col-lg-12">
  <div class="card">
      <div class="card-header">Datewise buy product</div>
    <div class="card-body">
        <?php echo form_open_multipart('datewise-buy-product', 'name="datewise-buy-product" id="datewiseBuyProduct" autocomplete="off"');?>
        <div class="row"> 
            
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
                    if(isset($_POST['from_date'])):
                ?>
				<center>
                    <?php
                        $companyInfo = $this->db->query('SELECT * FROM tbl_company where id = 1')->row();
                    ?>
                    <img src="<?php echo base_url().$companyInfo->file;?>" class="logo-icon" alt="logo icon" style="width: 90px;">
                    <h3 class="text-dark" style="padding: 0; margin: 0; line-height: 35px;"><?php echo $companyInfo->name;?></h3>
                    <p style="margin: 0px; padding: 0px;"><?php echo $companyInfo->address;?></p></br>
                </center>
                <h5 style="text-align: center; text-decoration: underline;">Datewise buy product</h5>
                <center style="color: green; font-size: 18px; font-weight: bold;">
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
                <div style="overflow-x:auto; width: 100%;">
					<table width="100%" border="1" style="text-align: center;">
						<thead>
							<tr>
								<th>#</th>
								<th>Bill Date</th>
								<th>Bill No</th>
								<th>Supplier Name</th>
								<th>Product Name</th>
								<th>Quantity</th>
								<th>Buy price</th>
								<th>Sale price</th>
								<th>Amount (Buy)</th>
								<th>Amount (Sale)</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$sl=0;
								$netTotalBuy = 0;
								$totalSalePrice = 0;
								foreach ($DatewiseBuyProduct as $value):
									$netTotalBuy += $value->totalBuyingPrice;
									$totalSalePrice = $totalSalePrice + ($value->sale_price * $value->quantity_in);
									$sl++
							?>
							<tr>
								<td><?php echo $sl;?></td>
								<td><?php echo $value->bill_date;?></td>
								<td><?php echo $value->bill_no;?></td>
								<td><?php echo $value->supplier_name;?></td>
								<td><?php echo $value->product_name;?></td>
								<td><?php echo $value->quantity_in.' '.$value->pack_size;?></td>
								<td><?php echo $value->buying_price;?></td>
								<td><?php echo $value->sale_price;?></td>
								<td><?php echo round($value->totalBuyingPrice, 2);?></td>
								<td><?php echo $value->sale_price * $value->quantity_in;?></td>
							</tr>
							<?php endforeach;?>
							<tr>
								<td colspan="8" style="text-align: right"><b>Total:</b></td>
								<td><?php echo $netTotalBuy;?></td>
								<td><?php echo $totalSalePrice;?></td>
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
