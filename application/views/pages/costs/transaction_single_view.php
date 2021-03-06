<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-6">
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
    <div class="col-sm-6">
        
        <div class="top-button-area">
            <a class="btn btn-primary m-1" href="<?php echo base_url('transaction-add');?>"><i aria-hidden="true" class="fa fa-plus-circle"></i> New Transaction</a>
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
                        <img src="<?php echo base_url();?>assets/images/logo-icon.png" class="logo-icon" alt="logo icon" style="width: 190px;"></td>
                    <!-- <td>
                        <?php
                            $row = $this->db->query("select * from tbl_warehouse")->row();
                        ?>
                        <h3 class="text-dark" style="padding: 0; margin: 0; line-height: 35px;"><?= $row->warehouse_name;?></h3>
                        <p style="margin: 0px; padding: 0px;"><?= $row->warehouse_address;?></p>
                    </td> -->
                </tr>
                <tr>
                    <td style="text-align: center;">
                        <h3 class="text-dark" style="padding: 0; margin: 0; line-height: 35px;">VarietiesBD</h3>
                        <p style="margin: 0px; padding: 0px;">Bashaboo</p>
                    </td>
                </tr>
            </table>
        </div>

        <table style="width: 100%">
            <tr>
                <td colspan="2" style="text-align: left;">
                    <h2 class="text-primary" style="margin: 0; padding: 0;">Transaction</h2>
                </td>
            </tr>  
            <tr>
                <td colspan="2" style="text-align: left;">
                    <h4 style="margin: 0; padding: 0;"><?php echo $expense_details->trnsction_id; ?></h4>
                </td>
            </tr>
            <tr>
                <td width="10%" style="text-align: left;">Issue Date:</td>
                <td style="text-align: left;"><?php echo $expense_details->trnsction_date;?></td>
            </tr>
        </table>
        <!-- <table width="100%">
            <tr>
                <td width="70%">&nbsp;</td>
                <td class="text-left">Bill To,</td>
            </tr>
            <tr>
                <td width="70%">&nbsp;</td>
                <td class="text-left"><b><?php echo $voucher_info_customer->customer_name;?></b></td>
            </tr>
            <tr>
                <td width="70%">&nbsp;</td>
                <td class="text-left"><?php echo $voucher_info_customer->customer_address;?></td>
            </tr>
            <tr>
                <td width="70%">&nbsp;</td>
                <td class="text-left"><?php echo $voucher_info_customer->customer_mobile;?></td>
            </tr>
            <tr>
                <td width="70%">&nbsp;</td>
                <td class="text-left"><?php echo $voucher_info_customer->customer_email;?></td>
            </tr>
        </table> -->
        
        
        
        
        
        <div class="row">
            <div class="col-md-12">
                <table width="100%" border="1">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Expense Name</th>
                        <th scope="col">Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=0; foreach ($expense_details_all as $value): $i++;?>
                        <tr>
                            <td><?= $i;?></td>
                            <td><?= $value->trnsaction_head;?></td>
                            <td><?= $value->amount;?></td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
                <tfoot>
                    <tr>
                        <?php
                            $trnsction_id = $expense_details->trnsction_id;
                            $result = $this->db->query
                                    (
                                    "SELECT c.*, SUM(c.amount) as total_expense FROM tbl_costs c WHERE trnsction_id = '$trnsction_id' AND NOT (c.delete_status <=> 'deleted') GROUP BY c.trnsction_id  "
                                    )->row();

                        ?>
                        <td colspan="2" style="text-align: right;"><b>Grand Total:</b></td>
                        <td style="text-align: center;">
                            <span id="totalExpense"><?= $result->total_expense;?></span>
                        </td>
                    </tr> 
                </tfoot>
              </table>

              <table width="100%">
                    <tr>
                        <td style="text-align: left;"><p>In Word: <span id="totalExpenseInWord"></span> taka only.</p></td>
                    </tr>
              </table>
                
              
                
                
                
                
                
            </div>
        </div>
        
        
    </div><!---cart body ---->
      
  </div>
</div>
</div><!-- End Row-->

<a href="<?php echo base_url('costs-list');?>" class="btn btn-secondary"><i class="fa fa-angle-left"></i> Back To Costs List</a><br>

<button onclick="PrintMe('divid')" class="btn btn-primary" style="float: right;"> <i class="fa fa-print" aria-hidden="true" style="font-size: 25px; margin-right: 10px;"></i>Print</button>
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
    var number = document.getElementById("totalExpense").innerText;  
    var Inwords = toWordsconver(number);
    //alert(Inwords);
    document.getElementById("totalExpenseInWord").innerHTML = Inwords;
});
</script>
