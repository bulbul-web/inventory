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
            <a class="btn btn-primary m-1" href="<?php echo base_url();?>datewise-expense"><i class="fa fa-retweet" aria-hidden="true"></i></a>
        </div>
     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
<div class="col-lg-12">
  <div class="card">
      <div class="card-header">Datewise Report</div>
    <div class="card-body">
        <?php echo form_open_multipart('datewise-stock-report', 'name="datewise-stock-report" id="datewiseStockReport" autocomplete="off"');?>
        <div class="row"> 
            <div class="col-md-2">
                <div class="form-group row">
                    <label class="col-sm-12 col-form-label">Status</label>
                    <div class="col-sm-12">
                        <select name="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                  </div>
            </div>
            <div class="col-md-4">
                <div class="form-group row">
                    <label class="col-sm-12 col-form-label">From Date</label>
                    <div class="col-sm-12">
                        <input type="text" name="from_date" id="fromDate" value="<?php echo set_value('from_date');?>" class="form-control form-control-rounded" required="">
                    </div>
                  </div>
            </div>
            <div class="col-md-4">
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
                    if(isset($_POST['status'])):
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
                <h5 style="text-align: center; text-decoration: underline;">Datewise Stock Report</h5>
                    <?php
                    if (isset($from_date)):
                        echo "From: (" . date("d-m-Y", strtotime($from_date)).")";
                    endif;

                    if (isset($to_date)):
                        echo " To (" . date("d-m-Y", strtotime($to_date)).")";
                    endif;
                    echo "<br>";
					 
                        if($status==1){
                            echo "--Active--";
                        }else{
                            echo "--Inactive--";
                        };
                    ?>
                </center>
                <br>
                <div style="overflow-x:auto; width: 100%;">
					<table width="100%" border="1" style="text-align: center;">
						<thead>
							<tr>
								<th>#</th>
								<th>Bill Date</th>
								<th>Bill No.</th>
								<th>Product Name</th>
								<th>Stock In</th>
								<th>Price</th>
								<th>Total</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$sl=0;
								$netTotalPrice = 0;
								foreach ($result as $value):
									$netTotalPrice += $value->totalPrice;
									$sl++
							?>
							<tr>
								<td><?= $sl;?></td>
								<td>
									<?php
										$date = date_create("$value->bill_date");
										echo date_format($date,"d/m/Y");
									?>
								</td>
								<td><?= $value->bill_no;?></td>
								<td><?= $value->product_name;?></td>
								<td><?= $value->quantity_in.' '.$value->pack_size;?></td>
								<td><?= $value->buying_price;?></td>
								<td><?= round($value->totalPrice, 2);?></td>
								<td>
									<a href="<?php echo base_url();?>stock-details/<?php echo $value->id;?>" target="__BLANK"><i class="fa fa-eye" aria-hidden="true"></i></a>
								</td>
							</tr>
							<?php endforeach;?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="6" style="text-align: right; font-weight: bold;">Total:</td>
								<td><?php echo $netTotalPrice;?></td>
								<td>-</td>
							</tr>
						</tfoot>
					</table>
				</div>
                <div>
                </div>
                <?php endif;?>
                
            </div>
        </div>
        </div>
    </div>
      
  </div>
</div>
</div><!-- End Row-->
<a href="<?php echo base_url('all-report-section');?>" class="btn btn-secondary"><i class="fa fa-angle-left"></i> Back To Report Section</a><br>
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
