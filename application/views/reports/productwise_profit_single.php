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
            <a class="btn btn-primary m-1" href="<?php echo base_url();?>stock-report"><i class="fa fa-retweet" aria-hidden="true"></i></a>
        </div>
     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
<div class="col-lg-12">
  <div class="card">
      <div class="card-header">Single Product Stock Report</div>
    <div class="card-body">
        <div class="row">

            <div class="col-md-8">
            <form method="post">
                <div class="row"> 
                    <div class="col-md-6">
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
            </div>

            
        </div>
        <div id="print_content">
        <div class="row">
            <div class="col-md-12">
                <br>
                <?php
                    if(isset($_POST['submit'])){
                        echo '<h5 style="text-align: center; text-decoration: underline;">Product Wise Summary Report</h5>';
                        $product_name = $_POST['product_names'];
                        
                        $stock_out_result = $this->db->query
                                (
                                     
                                     "SELECT *, sum(quantity * sale_price) as quantityOutPrice, sum(quantity) as stock_out from tbl_invoice WHERE product_id = $product_name AND NOT (delete_status <=> 'deleted') AND NOT (status <=> '0') AND NOT (order_status <=> '0')"
                                )->row();

                        $stock_in_result = $this->db->query
                                (
                                 "SELECT sum(si.quantity_in) as total_quantity, si.buying_price, si.bill_date, pi.product_name, ps.pack_size, sum(si.quantity_in * si.buying_price) as totalPrice FROM tbl_stock_in si LEFT JOIN tbl_product_info pi on pi.product_id = si.product_id LEFT JOIN tbl_pack_size ps on pi.pack_size = ps.id WHERE si.product_id = $product_name AND si.status = 1"
                                )->row();
                    
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
                    Product Name: <?php echo $stock_in_result->product_name;?><br>
                    Pack Size: <?php echo $stock_in_result->pack_size;?><br>
                    Available stock: <?php echo $stock_in_result->total_quantity - $stock_out_result->stock_out;?><br>
                </center>
                <br>
                                    
                </div>
				<div style="overflow-x:auto; width: 100%;">
					<table width="100%" border="1" style="text-align: center;">
						<thead>
							<tr>
								<th>Stock In</th>
								<th>Stock Out</th>
							</tr>
						</thead>
						<tbody>
							
							<tr>
								
								<td><?php echo $stock_in_result->total_quantity;?></td>
								<td><?php echo $stock_out_result->stock_out;?></td>
								
							</tr>
							<tr>
								<td><?= 'Total: '. round($stock_in_result->totalPrice, 2) . ' tk';?></td>
								<td><?= 'Total: '. round($stock_out_result->quantityOutPrice, 2) . ' tk';?></td>
							</tr>
							
							
						</tbody>
						<tfoot>
							<tr>
								<td colspan="2" style="text-align: center; font-weight: bold;">
								
								<?php
									$balance = $stock_out_result->quantityOutPrice - $stock_in_result->totalPrice;
									if($balance > 0){
										echo 'Profit: '. round($balance, 2);
									}else {
										echo 'Loss: '. round($balance, 2);
									}
								?>
								</td>
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
