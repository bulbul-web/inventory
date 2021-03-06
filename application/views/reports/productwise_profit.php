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
            <a class="btn btn-primary m-1" href="<?php echo base_url();?>productwise-profit"><i class="fa fa-retweet" aria-hidden="true"></i></a>
        </div>
     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
<div class="col-lg-12">
  <div class="card">
      <div class="card-header">Buy Sell Info</div>
    <div class="card-body">
        <div class="row">

            <div class="col-md-12">
            <form method="post">
                <div class="row"> 
                
                    <!-- <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-sm-12 col-form-label">From Date</label>
                            <div class="col-sm-12">
                                <input type="text" name="from_date" id="fromDate" value="<?php echo set_value('from_date');?>" class="form-control form-control-rounded" required="">
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="col-md-3">
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
                                <button type="submit" name="submit" value="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i>Buy Sell Info</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group row">
                            <label class="col-sm-12 col-form-label">&nbsp;</label>
                            <div class="col-sm-12">
                                <a href="<?php echo base_url();?>/datewise-profit" class="btn btn-success"><i class="fa fa-check-square-o"></i>Date wise Report</a>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>     
            </form>
            </div>

            
            
        </div>
        <div id="print_content">
        <div class="row">
            <div class="col-md-12">
                <br>
                <?php
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
                <h5 style="text-align: center; text-decoration: underline;">Products buy sell information</h5>
                <center style="color: green; font-size: 18px; font-weight: bold;">
                    <?php
                        if (isset($_POST['from_date'])){
                            echo "From: (" . date("d-m-Y", strtotime($_POST['from_date'])).")";
                            $from_date = $_POST['from_date'];
                        }

                        if (isset($_POST['to_date'])){
                            echo " To (" . date("d-m-Y", strtotime($_POST['to_date'])).")";
                            $to_date = $_POST['to_date'];
                        }
                    ?>
                </center>
                <br>
                <div style="overflow-x:auto; width: 100%;">
					<table width="100%" border="1" style="text-align: center;">
						<thead>
							<tr>
								<th>#</th>
								<th>Product Name</th>
								<th>Total Buy price</th>
								<th>Total Sale price</th>
								<th>Balance</th>
								<th>Available Stock</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								
								$dateWiseBuySellReport = $this->db->query("SELECT
                                e.product_name,
                                e.product_id,
                                e.totalSalePrice,
                                e.TotalByingPrice,
                                e.balance,
                                f.pack_size,
                                e.totalStockIn,
                                e.totalSellQuantity,
                                e.totalStockIn - e.totalSellQuantity AS availableStock
                            FROM
                                (
                                SELECT
                                    d.product_name,
                                    d.pack_size,
                                    c.invoice_date,
                                    c.product_id,
                                    c.totalSalePrice,
                                    c.TotalByingPrice,
                                    c.totalSalePrice - c.TotalByingPrice AS balance,
                                    c.totalStockIn,
                                    c.totalSellQuantity
                                FROM
                                    (
                                    SELECT
                                        a.invoice_date,
                                        a.product_id,
                                        a.totalSalePrice,
                                        b.TotalByingPrice,
                                        b.totalStockIn,
                                        a.totalSellQuantity
                                    FROM
                                        (
                                        SELECT
                                            invoice_date,
                                            product_id,
                                            SUM(quantity * sale_price) AS totalSalePrice,
                                            SUM(quantity) AS totalSellQuantity
                                        FROM
                                            tbl_invoice
                                        GROUP BY
                                            product_id
                                    ) a
                                LEFT JOIN(
                                    SELECT
                                        product_id,
                                        SUM(quantity_in * buying_price) AS TotalByingPrice,
                                        SUM(quantity_in) AS totalStockIn
                                    FROM
                                        tbl_stock_in
                                    GROUP BY
                                        product_id
                                ) b
                            ON
                                a.product_id = b.product_id
                                ) c
                            LEFT JOIN(
                                SELECT
                                    pack_size,
                                    product_id,
                                    product_name
                                FROM
                                    tbl_product_info
                            ) d
                            ON
                                d.product_id = c.product_id
                            ) e
                            LEFT JOIN(
                                SELECT
                                    id,
                                    pack_size
                                FROM
                                    tbl_pack_size
                            ) f
                            ON
                                f.id = e.pack_size")->result();
								$sl = 0;
								foreach ($dateWiseBuySellReport as $value):
									$sl++
							?>
							<tr>
								<td><?php echo $sl;?></td>
								<td><?php echo $value->product_name;?></td>
								<td><?php echo round($value->TotalByingPrice, 2);?></td>
								<td><?php echo $value->totalSalePrice;?></td>
								<td><?php echo $value->balance;?></td>
								<td style="text-align: left;"> &nbsp;&nbsp;&nbsp; <?php echo $value->availableStock.' - '.$value->pack_size;?></td>
							</tr>
							<?php endforeach;?>
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
