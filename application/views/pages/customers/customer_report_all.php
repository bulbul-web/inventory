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
            <a class="btn btn-primary m-1" href="<?php echo base_url();?>customer-report-all"><i class="fa fa-retweet" aria-hidden="true"></i></a>
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
            
                <div style="overflow-x: auto;">
                    <table width="100%" border="1" style="text-align: center;">
                        <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Catagory Name</th>
                                <th>Subcategory Name</th>
                                <th>Salesman name</th>
                                <th>Customer Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 0;
                                foreach($customerReportAll as $value):
                                    
                                    $i++;
                            ?>
                                <tr>
                                    
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $value->customerCategory;?></td>
                                    <td><?php echo $value->customerSubcategory;?></td>
                                    <td><?= $value->salesman ;?></td>
                                    <td><?= $value->customer_name ;?></td>
                                    <td><?= $value->customer_mobile ;?></td>
                                    <td><?= $value->customer_address ;?></td>
                                    <td><?= $value->customer_email ;?></td>
                                </tr>
                            <?php endforeach;?>
                            
                            
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
