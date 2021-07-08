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
            <a class="btn btn-primary m-1" href="<?php echo base_url();?>product-datewise-report"><i class="fa fa-retweet" aria-hidden="true"></i></a>
        </div>
     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
<div class="col-lg-12">
  <div class="card">
      <div class="card-header">Single Product Datewise Stock Report</div>
    <div class="card-body">
        <form method="post">
            <div class="row"> 
                <div class="col-md-4">
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label">Product</label>
                        <div class="col-sm-12">
                            <select name="product_names" class="form-control">
                                <?php
                                    $products = $this->db->query("SELECT pi.product_name, pi.product_id FROM tbl_product_info pi, tbl_stock_in si WHERE si.product_id = pi.product_id AND pi.product_status = 1 GROUP BY si.product_id")->result();
                                    foreach ($products as $product):
                                ?>
                                
                                <option value="<?= $product->product_id;?>"><?= $product->product_name;?></option>
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
                            <button type="submit" name="submit" class="btn btn-success">View</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>      
        </form>
        <div id="print_content">
        <div class="row">
            <div class="col-md-12">
                <br>
                    
                   
                
                <?php
                    if(isset($_POST['submit'])){
                        echo '<h5 style="text-align: center; text-decoration: underline;">Product and Datewise stock report</h5>';
                        $product_name = $_POST['product_names'];
                        $from_date = $_POST['from_date'];
                        $to_date = $_POST['to_date'];
                        
                        $stock_out_result = $this->db->query
                                (
                                     //"SELECT SUM(i.quantity) as stock_out, si.quantity_in, pi.product_name, si.challan_date, ps.pack_size FROM tbl_invoice i, tbl_stock_in si, tbl_product_info pi, tbl_pack_size ps WHERE i.product_id = si.product_id AND pi.product_id = si.product_id AND ps.id = pi.pack_size GROUP BY i.product_id"
                                     "SELECT i.product_id, sum(i.quantity) as stock_out, pi.pack_size, ps.pack_size, pi.product_name FROM tbl_invoice i LEFT JOIN tbl_product_info pi ON pi.product_id = i.product_id LEFT JOIN tbl_pack_size ps ON pi.pack_size = ps.id WHERE i.product_id = $product_name AND NOT (i.delete_status <=> 'deleted')"
                                )->row();

                        $stock_in_result = $this->db->query
                                (
                                 "SELECT si.quantity_in as total_quantity, si.buying_price, si.bill_date, pi.product_name, ps.pack_size, (si.quantity_in * si.buying_price) as totalPrice FROM tbl_stock_in si LEFT JOIN tbl_product_info pi on pi.product_id = si.product_id LEFT JOIN tbl_pack_size ps on pi.pack_size = ps.id WHERE si.product_id = $product_name AND si.bill_date BETWEEN '$from_date' AND '$to_date' AND si.status = 1"
                                )->result();
                    
                ?>
				<center>
                    <?php
                        $companyInfo = $this->db->query('SELECT * FROM tbl_company where id = 1')->row();
                    ?>
                    <img src="<?php echo base_url().$companyInfo->file;?>" class="logo-icon" alt="logo icon" style="width: 90px;">
                    <h3 class="text-dark" style="padding: 0; margin: 0; line-height: 35px;"><?php echo $companyInfo->name;?></h3>
                    <p style="margin: 0px; padding: 0px;"><?php echo $companyInfo->address;?></p></br>
                </center>
                <center style="color: green; font-size: 18px; font-weight: bold;">
                    Product Name: <?php echo $stock_out_result->product_name;?><br>
                    Pack Size: <?php echo $stock_out_result->pack_size;?><br>
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
                                    
                </div>
				<div style="overflow-x:auto; width: 100%;">
					<table width="100%" border="1" style="text-align: center;">
						<thead>
							<tr>
								<th>Bill Date</th>
								<th>Stock In</th>
								<th>Price</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$i = 0;
								$sum = 0;
								$netTotalPrice = 0;
								foreach($stock_in_result as $value):
									$sum += $value->total_quantity;
									$netTotalPrice += $value->totalPrice;
									$i++;
							?>
								<tr>
									<td>
										<?php
											$date = date_create("$value->bill_date");
											echo date_format($date,"d/m/Y");
										?>
									</td>
									<td><?php echo $value->total_quantity;?></td>
									<td><?= $value->buying_price;?></td>
									<td><?= round($value->totalPrice, 2);?></td>
								</tr>
							<?php endforeach;?>
							<tr>
								<td style="text-align: right;">Total Stock In:</td>
								<td>
									<?php
										echo $sum;
									?>
								</td>
								<td>-</td>
								<td>-</td>
							</tr>
							<!----<tr>
								<td style="text-align: right;">Total Stock Out:</td>
								<td>
									<?php
										if(empty($stock_out_result->stock_out)){echo 0;}else{ echo $stock_out_result->stock_out;}
									?>
								</td>
								<td>-</td>
								<td>-</td>
							</tr>----->
							<!-----<tr>
								<td style="text-align: right;">Available:</td>
								<td>
									<?php
										echo $sum - $stock_out_result->stock_out;
									?>
								</td>
								<td>-</td>
								<td>-</td>
							</tr>---->
						</tbody>
						<tfoot>
							<tr>
								<td colspan="3" style="text-align: right; font-weight: bold;">Total:</td>
								<td><?php echo $netTotalPrice;?></td>
							</tr>
						</tfoot>
					</table>
				</div>


                
                <?php } ?>
            </div>
        </div>
        </div>
    </div>
      
  </div>
</div>
</div><!-- End Row-->
<a href="<?php echo base_url('stock-report');?>" class="btn btn-secondary"><i class="fa fa-angle-left"></i> Back</a><br>
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
