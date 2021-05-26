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
            <a class="btn btn-primary m-1" href="<?php echo base_url('salesman-order-form');?>"><i aria-hidden="true" class="fa fa-plus-circle"></i> Create order</a>
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
						<?php
							$companyInfo = $this->db->query('SELECT * FROM tbl_company where id = 1')->row();
						?>
                        <img src="<?php echo base_url().$companyInfo->file;?>" class="logo-icon" alt="logo icon" style="width: 90px;"></td>

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
                        <h3 class="text-dark" style="padding: 0; margin: 0; line-height: 35px;"><?php echo $companyInfo->name;?></h3>
                        <p style="margin: 0px; padding: 0px;"><?php echo $companyInfo->address;?></p>
                        <?php
                            if($order_info_customer->reject_for != ''){
                                echo '<span style="color: red;">REJECTED ORDER</span>';
                                echo '<p style="color: red; font-weight: bold;">['.$order_info_customer->reject_for.']</p>';
                            }
                        ?>
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
                            <td><?php echo $order_info_customer->order_date;?></td>
                        </tr>
                        <tr>
                            <td> <b>Customer</b></td>
                            <td><?php echo $order_info_customer->customer_name;?></td>
                        </tr>
                        <tr>
                            <td> <b>Address</b></td>
                            <td><?php echo $order_info_customer->customer_address;?></td>
                        </tr>
                        <tr>
                            <td> <b>Contact No</b></td>
                            <td><?php echo $order_info_customer->customer_mobile;?></td>
                        </tr>
                    </table>
                </td>
                <td style="width: 10%">
                    
                </td>
                <td style="width: 45%">
                    <table border="1" style="border: 1px solid black; width: 100%;">
                        <tr>
                            <td style="width: 35%;"> <b>Order No</b></td>
                            <td><?php echo $order_info_customer->order_id;?></td>
                        </tr>
                        <tr>
                            <td> <b>Payment Terms</b></td>
                            <td>
                                <?php 
                                    if($order_info_customer->payment_day == null){
                                        echo '0';
                                    }else {
                                        echo $order_info_customer->payment_day;
                                    }
                                ?>
                                 Day
                            </td>
                        </tr>
                        <tr>
                            <td> <b>Employee</b></td>
                            <td>
                                <?php 
                                    $orderByDetails = $this->db->query("SELECT * FROM tbl_user WHERE user_id = '$order_info_customer->order_by'")->row();
                                    if(isset($orderByDetails)){
                                        echo $orderByDetails->user_name;
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td> <b>Contact No</b></td>
                            <td>
                                <?php 
                                    if(isset($orderByDetails)){
                                        echo $orderByDetails->user_mobile;
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
                    <?php $i=0; foreach ($order_info_product as $value): $i++;?>
                        <tr>
                            <td><?= $i;?></td>
                            <td style="font-weight: bold;"><?= $value->product_name;?></td>
                            <td style="text-align: center;"><?= $value->product_segment;?></td>
                            <td style="text-align: center;"><?= $value->quantity.' '.$value->pack_size_name;?></td>
                            <td style="text-align: center;"><?= $value->sale_price;?></td>
                            <td style="text-align: center;"><?= $value->quantity * $value->sale_price;?></td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
                <tfoot>
                    <tr>
                        <?php
                            $order_id = $order_info_customer->order_id;
                            $result = $this->db->query
                                    (
                                    "select"
                                    . " tbl_order.*, sum(tbl_order.quantity * tbl_order.sale_price) as grandTotal"
                                    . " FROM tbl_order"
                                    . " WHERE tbl_order.order_id = '$order_id' AND NOT (tbl_order.delete_status <=> 'deleted')"
                                    )->row();

                        ?>
                        <td colspan="5" style="text-align: right;"><b>Grand Total:</b></td>
                        <td style="text-align: center;">
                            <?=$result->grandTotal;?>
                        </td>
                    </tr> 
                    <tr>
                        <td colspan="5" style="text-align: right;"><b>Discount:</b></td> 
                        <td style="text-align: center;">
                            <?= $value->discount;?>
                        </td>
                    </tr> 
                    <tr style="">
                        <td colspan="5" style="text-align: right;"><b>Final Total:</b></td>
                        <td style="text-align: center;">
                            <?= ($result->grandTotal - $value->discount)?>
                        </td>
                    </tr> 
                    <tr>
                        <td colspan="5" style="text-align: right;"><b>Paid Amount:</b></td> 
                        <td style="text-align: center;">
                            <span id="paidAmountValue"><?= $value->paid_amount;?></span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="5" style="text-align: right;"><b>Due:</b></td> 
                        <td style="text-align: center;">
                            <?= ($result->grandTotal - $value->discount) - $value->paid_amount;?>
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



<!-- <button onclick="PrintMe('divid')" class="btn btn-primary" style="float: right;"> <i class="fa fa-print" aria-hidden="true" style="font-size: 25px; margin-right: 10px;"></i>Print</button> -->
<div class="row">
    <div class="col-md-6">
        <a href="<?php echo base_url('salesman-order');?>" class="btn btn-secondary"><i class="fa fa-angle-left"></i> Back To Order List</a><br>
    </div>
    <div class="col-md-3 text-right">
        <?php
            if($order_info_customer->order_status == 2){
                
            }else{
        ?>
            <button class="btn btn-warning" data-toggle="modal" data-target="#rejectForm" >Reject Order</button>
        <?php } ?>
    </div>
        <!-- Modal -->
        <div class="modal fade" id="rejectForm">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> Reject for</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo base_url();?>reject-salesman-order" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="order_id" value="<?php echo $order_info_customer->order_id?>" />
                            <textarea type="text" name="reject_for" class="form-control" value="" placeholder="Why reject"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Reject</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal end-->
    
    <div class="col-md-3 text-right">
        <?php
            $user_role = $this->session->userdata('user_role');
            if($user_role == 3){
                echo '<a href=" '.base_url().'salesman-order-details-copy/'.$value->order_id.' " class="btn btn-primary" target="_blank"><i class="fa fa-print" aria-hidden="true" style="font-size: 25px; margin-right: 10px;"></i>Print</a>';
            }else{
                if($order_info_customer->order_status != '' && $order_info_customer->order_status == 0){
                    echo '<a class="btn btn-danger" href="'.base_url().'accept-salesman-order/'.$order_info_customer->order_id.'">Accept and print</a>';
                }else {
        ?>
            <a href="<?php echo base_url();?>salesman-order-details-copy/<?php echo $value->order_id?>" class="btn btn-primary" target="_blank"><i class="fa fa-print" aria-hidden="true" style="font-size: 25px; margin-right: 10px;"></i>Print</a>
        <?php
                } 
            } 
        ?>
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
