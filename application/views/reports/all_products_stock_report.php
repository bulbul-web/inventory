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
            <a class="btn btn-primary m-1" href="<?php echo base_url();?>all-products-stock-report"><i class="fa fa-retweet" aria-hidden="true"></i></a>
        </div>
     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
<div class="col-lg-12">
  <div class="card">
      <div class="card-header">Month Wise Report</div>
    <div class="card-body">
        <div id="print_content">
        <div class="row">
            <div class="col-md-12">
                <br>
                <form method="post">
                    <button type="submit" name="submit" value="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> Report</button>
                </form>
                <?php
                    if(isset($_POST['submit'])){                        
                        $stock_out_result = $this->db->query
                                (
                                    //"SELECT SUM(i.quantity) as stock_out, si.quantity_in, pi.product_name, si.challan_date, ps.pack_size FROM tbl_invoice i, tbl_stock_in si, tbl_product_info pi, tbl_pack_size ps WHERE i.product_id = si.product_id AND pi.product_id = si.product_id AND ps.id = pi.pack_size GROUP BY i.product_id"
                                    " select c.product_name, c.product_id, c.stockIn, c.stockOut, c.pack_size, c.packName, (c.stockIn-c.stockOut) as available_quantity from "
                                    . " (SELECT a.stockIn,b.stockOut,a.product_id, a.product_name, a.pack_size, a.packName FROM "
                                    
                                        ." ( " 
                                            ." SELECT sum(si.quantity_in) as stockIn, pi.product_id, pi.product_name, pi.pack_size, ps.pack_size AS packName"
                                            ." FROM tbl_stock_in si, tbl_product_info pi, tbl_pack_size ps "
                                            ." WHERE pi.product_id = si.product_id AND ps.id = pi.pack_size"
                                            ." GROUP BY pi.product_id"
                                        ." ) a"
                                    ." LEFT JOIN "
                                        ." ("
                                            ." SELECT sum(i.quantity) as stockOut, i.product_id FROM tbl_invoice i WHERE NOT (i.delete_status <=> 'deleted') GROUP BY i.product_id"
                                        ." ) b"
                                    ." ON a.product_id = b.product_id)c"
                                )->result();
                    
                ?>
                    <table width="100%" border="1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Stock In</th>
                                <th>Pack Size</th>
                                <th>Stock Out</th>
                                <th>Available Stock</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=0;
                                foreach($stock_out_result as $value):
                                    $i++;
                            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $value->product_name; ?></td>
                                    <td><?php echo $value->stockIn; ?></td>
                                    <td><?php echo $value->packName; ?></td>
                                    <td><?php echo $value->stockOut; ?></td>
                                    <td><?php echo $value->available_quantity; ?></td>
                                    
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                <?php }?>
            </div>
        </div>
        </div>
    </div>
      
  </div>
</div>
</div><!-- End Row-->
<a href="<?php echo base_url('all-report-section');?>" class="btn btn-secondary"><i class="fa fa-angle-left"></i> Back To Report</a><br>
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
