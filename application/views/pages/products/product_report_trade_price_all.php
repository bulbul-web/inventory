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
      <div class="card-header">Product Trade Price Report</div>
    <div class="card-body">
       
        <div id="print_content">
        <div class="row">
                <div class="col-md-12">
                    <center>
                        <?php
                            $companyInfo = $this->db->query('SELECT * FROM tbl_company where id = 1')->row();
                        ?>
                        <img src="<?php echo base_url().$companyInfo->file;?>" class="logo-icon" alt="logo icon" style="width: 90px;">
                        <h3 class="text-dark" style="padding: 0; margin: 0; line-height: 35px;"><?php echo $companyInfo->name;?></h3>
                        <p style="margin: 0px; padding: 0px;"><?php echo $companyInfo->address;?></p></br>
                    </center>
                    <center style="color: green; font-size: 18px; font-weight: bold;">
                        <h5 style="text-align: center; text-decoration: underline;">Products trade price report</h5>
                    </center>
                </div>  
                <div class="col-md-12">
                    <div style="overflow-x: auto;">
                        <table width="100%" border="1" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Product Name</th>
                                    <th>Pack size</th>
                                    <th>Trade Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i = 0;
                                    foreach($productReportAll as $value):
                                        
                                        $i++;
                                ?>
                                    <tr>
                                        
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $value->product_name;?></td>
                                        <td><?php echo $value->pack_size;?></td>
                                        <td><?= $value->trade_price ;?></td>
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
