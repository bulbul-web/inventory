<?php
	$companyInfo = $this->db->query('SELECT * FROM tbl_company where id = 1')->row();
?>
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
            <a class="btn btn-primary m-1" href="<?php echo base_url('stock-in-form');?>"><i aria-hidden="true" class="fa fa-plus-circle"></i> Stock In</a>
        </div>

     </div>
</div>
<div class="printarea" style="height:200px;width:300px;padding:10px;margin:3px;  display:none;">

</div>
<!-- End Breadcrumb-->
<div class="row">
<div class="col-lg-12">
  <div class="card">
    <div class="card-header"><i class="fa fa-table"></i> Data Exporting</div>
    <div class="card-body" id="divid">
        <div class="container">
            <table style="width: 100%; margin: 0 auto;">
                <tr>
                    <td style="width: 30%; text-align: center;">

                        <?php $shopInfo = $this->db->query("SELECT * FROM tbl_user WHERE user_id = $userInfo->user_id")->row();?>
                        <!-- <img src="<?php echo base_url().$shopInfo->file;?>" class="logo-icon" alt="logo icon" style="width: 70px;"></td> -->

                        <img src="<?php echo base_url().$companyInfo->file;?>" class="logo-icon" alt="logo icon" style="width: 90px;">
                    </td>

                </tr>
                <tr>
                    <td style="text-align: center;">
                        <h3 class="text-dark" style="padding: 0; margin: 0; line-height: 35px;"><?php echo $companyInfo->name;?></h3>
                        <p style="margin: 0px; padding: 0px;"><?php echo $companyInfo->address;?></p>
                        <br>
                        <h6>Purchase Report</h6>
                    </td>
                </tr>
            </table>
        </div>

        <br>

        <table style="width: 100%;">
            <tr>
                <td style="width: 45%">
                    <table border="1" style="border: 1px solid black; width: 100%;">
                        <tr>
                            <td style="width: 35%;"> <b>Date</b></td>
                            <td><?php echo $purchase_info_supplier->bill_date;?></td>
                        </tr>
                        <tr>
                            <td> <b>Supplier</b></td>
                            <td><?php echo $purchase_info_supplier->supplier_name;?></td>
                        </tr>
                        <tr>
                            <td> <b>Address</b></td>
                            <td><?php echo $purchase_info_supplier->supplier_address;?></td>
                        </tr>
                        <tr>
                            <td> <b>Contact No</b></td>
                            <td><?php echo $purchase_info_supplier->supplier_mobile;?></td>
                        </tr>
                    </table>
                </td>
                <td style="width: 10%">
                    
                </td>
                <td style="width: 45%">
                    <table border="1" style="border: 1px solid black; width: 100%;">
                        <tr>
                            <td style="width: 35%;"> <b>Bill No</b></td>
                            <td><?php echo $purchase_info_supplier->bill_no;?></td>
                        </tr>

                        <!-- <tr>
                            <td> <b>Payment Terms</b></td>
                            <td>
                                <?php 
                                    if($purchase_info_supplier->payment_day == null){
                                        echo '0';
                                    }else {
                                        echo $purchase_info_supplier->payment_day;
                                    }
                                ?>
                                 Day
                            </td>
                        </tr> -->

                        <tr>
                            <td> <b>Entry By</b></td>
                            <td>
                                <?php 
                                    $billByDetails = $this->db->query("SELECT * FROM tbl_user WHERE user_id = '$purchase_info_supplier->entry_by'")->row();
                                    if(isset($billByDetails)){
                                        echo $billByDetails->user_name;
                                    }
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td> <b>Contact No</b></td>
                            <td>
                                <?php 
                                    if(isset($billByDetails)){
                                        echo $billByDetails->user_mobile;
                                    }
                                ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        
        <br>
        
        <div class="row">
            <div class="col-md-12">
                <table width="100%" border="1">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Name</th>
                        <th style="text-align: center;" scope="col">Product Standard</th>
                        <th style="text-align: center;" scope="col">Quantity</th>
                        <th style="text-align: center;" scope="col">Price/unit</th>
                        <th style="text-align: center;" scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i=0;
                        $grandTotal = 0;
                        foreach ($purchase_info_product as $value):
                            $grandTotal += $value->quantity_in * $value->buying_price;
                            $i++;
                    ?>
                        <tr>
                            <td><?= $i;?></td>
                            <td style="font-weight: bold;"><?= $value->product_name;?></td>
                            <td style="text-align: center;"><?= $value->product_segment;?></td>
                            <td style="text-align: center;"><?= $value->quantity_in.' '.$value->pack_size_name;?></td>
                            <td style="text-align: center;"><?= $value->buying_price;?></td>
                            <td style="text-align: center;"><?= $value->quantity_in * $value->buying_price;?></td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" style="text-align: right;"><b>Grand Total:</b></td>
                        <td style="text-align: center;">
                            <span><?= $grandTotal;?></span>
                        </td>
                    </tr> 

                    <tr>
                        <td colspan="5" style="text-align: right;"><b>Paid Amount:</b></td> 
                        <td style="text-align: center;">
                            <?php
                                $paidAmount = $this->db->query("SELECT *, sum(payment) as totalPayment FROM tbl_stock_in_history WHERE bill_no = '$purchase_info_supplier->bill_no' GROUP BY bill_no")->row();
                            ?>
                            <span id="paidAmountValue"><?= $paidAmount->totalPayment;?></span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="5" style="text-align: right;"><b>Due:</b></td> 
                        <td style="text-align: center;">
                            <?php echo $grandTotal - $paidAmount->totalPayment?>
                        </td>
                    </tr>
                </tfoot>
              </table>

              <table width="100%">
                    <tr>
                        <td style="text-align: left;"><p>In Word: <span id="paidAmountValueInWord"></span> taka only.</p></td>
                    </tr>
              </table>
                
              
                
                
                
                
                
            </div>
        </div>
        
        
    </div><!---cart body ---->
      
  </div>
</div>
</div><!-- End Row-->



<button onclick="PrintMe('divid')" class="btn btn-primary" style="float: right;"> <i class="fa fa-print" aria-hidden="true" style="font-size: 25px; margin-right: 10px;"></i>Print</button>
<div class="row">
    <div class="col-md-6">
        <a href="<?php echo base_url('products-stock-in');?>" class="btn btn-secondary"><i class="fa fa-angle-left"></i> Back To Purchase List</a><br>
    </div>
</div>
<script>
    // $("#btnPrint").on("click", function() {
    //     //alert($(window).height());
    //     var ht = $(window).height();
    //     var wt = $(window).width();
    //     var divContents = $("#print_content").html();
    //     var printWindow = window.open('', '', 'height=' + ht + 'px,width=' + wt + 'px');
    //     printWindow.document.write('<html><head><title>VarietiesBD.com</title>');
        
    //     printWindow.document.write('<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet"/>');
        
        
    //     printWindow.document.write('</head><body>');
    //     printWindow.document.write(divContents);
    //     printWindow.document.write('</body></html>');
    //     printWindow.document.close();
    //     printWindow.print();
    // });
</script>
<script language="javascript">
function PrintMe(DivID) {
var disp_setting="toolbar=yes,location=no,";
disp_setting+="directories=yes,menubar=yes,";
disp_setting+="scrollbars=yes,width=650, height=600, left=100, top=25";
   var content_vlue = document.getElementById(DivID).innerHTML;
   var docprint=window.open("","",disp_setting);
   docprint.document.open();
   docprint.document.write('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"');
   docprint.document.write('"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">');
   docprint.document.write('<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">');
   docprint.document.write('<head><title>VarietiesBD.com</title>');
   docprint.document.write('<style type="text/css">body{ margin:0px;');
   docprint.document.write('font-family:verdana,Arial;color:#000;');
   docprint.document.write('font-family:Verdana, Geneva, sans-serif; font-size:12px;}');
   docprint.document.write('a{color:#000;text-decoration:none;} </style>');
   docprint.document.write('</head><body onLoad="self.print()"><center>');
   docprint.document.write(content_vlue);
   docprint.document.write('</center></body></html>');
   docprint.document.close();
   docprint.focus();
}
</script>



<script>
// System for American Numbering 
var th_val = ['', 'thousand', 'million', 'billion', 'trillion'];
// System for uncomment this line for Number of English 
// var th_val = ['','thousand','million', 'milliard','billion'];

var dg_val = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
var tn_val = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
var tw_val = ['twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];
function toWordsconver(s) {
  s = s.toString();
    s = s.replace(/[\, ]/g, '');
    if (s != parseFloat(s))
        return 'not a number ';
    var x_val = s.indexOf('.');
    if (x_val == -1)
        x_val = s.length;
    if (x_val > 15)
        return 'too big';
    var n_val = s.split('');
    var str_val = '';
    var sk_val = 0;
    for (var i = 0; i < x_val; i++) {
        if ((x_val - i) % 3 == 2) {
            if (n_val[i] == '1') {
                str_val += tn_val[Number(n_val[i + 1])] + ' ';
                i++;
                sk_val = 1;
            } else if (n_val[i] != 0) {
                str_val += tw_val[n_val[i] - 2] + ' ';
                sk_val = 1;
            }
        } else if (n_val[i] != 0) {
            str_val += dg_val[n_val[i]] + ' ';
            if ((x_val - i) % 3 == 0)
                str_val += 'hundred ';
            sk_val = 1;
        }
        if ((x_val - i) % 3 == 1) {
            if (sk_val)
                str_val += th_val[(x_val - i - 1) / 3] + ' ';
            sk_val = 0;
        }
    }
    if (x_val != s.length) {
        var y_val = s.length;
        str_val += 'point ';
        for (var i = x_val + 1; i < y_val; i++)
            str_val += dg_val[n_val[i]] + ' ';
    }
    return str_val.replace(/\s+/g, ' ');
}
</script>
<script>  
$(document).ready(function() {
    var number = document.getElementById("paidAmountValue").innerText;  
    var Inwords = toWordsconver(number);
    //alert(Inwords);
    document.getElementById("paidAmountValueInWord").innerHTML = Inwords;
});
</script>
