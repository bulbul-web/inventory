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
        <div id="print_content">
        <div class="row">
            <div class="col-md-12">
                <br>
                <form method="post">
                    <select name="product_names">
                        <?php
                            $products = $this->db->query("SELECT pi.product_name, pi.product_id FROM tbl_product_info pi, tbl_stock_in si WHERE si.product_id = pi.product_id GROUP BY si.product_id")->result();
                            foreach ($products as $product):
                        ?>
                        
                        <option value="<?= $product->product_id;?>"><?= $product->product_name;?></option>
                        <?php endforeach;?>
                    </select>
                    <button type="submit" name="submit">View</button>
                </form>
                <?php
                    if(isset($_POST['submit'])){
                        echo '<h5 style="text-align: center; text-decoration: underline;">Product Wise stock report</h5>';
                        $product_name = $_POST['product_names'];
                        
                        $stock_out_result = $this->db->query
                                (
                                     //"SELECT SUM(i.quantity) as stock_out, si.quantity_in, pi.product_name, si.challan_date, ps.pack_size FROM tbl_invoice i, tbl_stock_in si, tbl_product_info pi, tbl_pack_size ps WHERE i.product_id = si.product_id AND pi.product_id = si.product_id AND ps.id = pi.pack_size GROUP BY i.product_id"
                                     "SELECT i.product_id, sum(i.quantity) as stock_out, pi.pack_size, ps.pack_size, pi.product_name FROM tbl_invoice i LEFT JOIN tbl_product_info pi ON pi.product_id = i.product_id LEFT JOIN tbl_pack_size ps ON pi.pack_size = ps.id WHERE i.product_id = $product_name AND NOT (i.delete_status <=> 'deleted')"
                                )->row();

                        $stock_in_result = $this->db->query
                                (
                                 "SELECT si.quantity_in as total_quantity, si.bill_date, pi.product_name, ps.pack_size FROM tbl_stock_in si LEFT JOIN tbl_product_info pi on pi.product_id = si.product_id LEFT JOIN tbl_pack_size ps on pi.pack_size = ps.id WHERE si.product_id = $product_name"
                                )->result();
                    
                ?>
                <center style="color: green; font-size: 18px; font-weight: bold;">
                    Product Name: <?php echo $stock_out_result->product_name;?><br>
                    Pack Size: <?php echo $stock_out_result->pack_size;?><br>
                </center>
                <br>
                                    
                </div>
                <table width="100%" border="1">
                    <thead>
                        <tr>
                            <th>Bill Date</th>
                            <th>Stock In</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 0;
                            $sum = 0;
                            foreach($stock_in_result as $value):
                                $sum += $value->total_quantity;
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
                            </tr>
                        <?php endforeach;?>
                        <tr>
                            <td style="text-align: right;">Total Stock In:</td>
                            <td>
                                <?php
                                    echo $sum;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">Total Stock Out:</td>
                            <td>
                                <?php
                                    echo $stock_out_result->stock_out;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">Available:</td>
                            <td>
                                <?php
                                    echo $sum - $stock_out_result->stock_out;
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>


                
                <?php } ?>
            </div>
        </div>
        </div>
    </div>
      
  </div>
</div>
</div><!-- End Row-->
<a href="<?php echo base_url('all-report-section');?>" class="btn btn-secondary"><i class="fa fa-angle-left"></i> Back To Stock In List</a><br>
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
