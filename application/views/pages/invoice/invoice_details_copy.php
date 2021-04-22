<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Invoice</title>

    <style>
        
        .div_style{
            width:495px;
            margin-left:30px;
            margin-top:15px;
            float: left;
        }

        table{
            /* border-spacing: 2px; */
            border-collapse: collapse;
        }
        td{
            padding: 2px;
        }

        table.customer_section td{
            width: 10px;
        }



    </style>
</head>
<body>

    <div id="dvContainer" style="float: left;">

        <?php
            for($c=1; $c<=2; $c++){ 
                ($c==1)? $text = "Office Copy" : $text = "Customer Copy";
                ($c==1)? $sl = "1" : $sl = "2";
        ?>

            <div class="div_style">
                <p style="text-align: center;"><?php echo $text?></p>
                    <table style="width: 100%; margin: 0 auto;">
                        <tr>
                            <td style="width: 30%; text-align: center;">

                                <?php $shopInfo = $this->db->query("SELECT * FROM tbl_user WHERE user_id = $userInfo->user_id")->row();?>
                                <!-- <img src="<?php echo base_url().$shopInfo->file;?>" class="logo-icon" alt="logo icon" style="width: 70px;"></td> -->

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
                                <p style="margin: 0px; padding: 0px;">Bashaboo</p></br>
                            </td>
                        </tr>
                    </table>

                    <table style="width: 100%">
                        <tr>
                            <td style="width: 50%">
                                <table style="width: 100%;">
                                    <tr>
                                        <td colspan="2" style="text-align: left;">
                                            <h2 class="text-primary" style="margin: 0; padding: 0;">Invoice</h2>
                                        </td>
                                    </tr>  
                                    <tr>
                                        <td colspan="2" style="text-align: left;">
                                            <h4 style="margin: 0; padding: 0;"><?php echo $voucher_info_customer->voucher_id; ?></h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="33%" style="text-align: left;">Issue Date:</td>
                                        <td style="text-align: left;"><?php echo $voucher_info_customer->invoice_date;?></td>
                                    </tr>
                                </table>
                            </td>

                            <td style="width: 50%;">
                                <table width="100%" class="customer_section">
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>Bill To,</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td><b><?php echo $voucher_info_customer->customer_name;?></b></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td><?php echo $voucher_info_customer->customer_address;?></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td><?php echo $voucher_info_customer->customer_mobile;?></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td><?php echo $voucher_info_customer->customer_email;?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                
                
                
                
                
                    <table width="100%" border="1">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Name</th>
                                <th style="text-align: center; width: 40px;" scope="col">Qnty</th>
                                <th style="text-align: center; width: 95px;" scope="col">Price/unit</th>
                                <th style="text-align: center; width: 95px;" scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; foreach ($voucher_info_product as $value): $i++;?>
                                <tr>
                                    <td><?= $i;?></td>
                                    <td><?= $value->product_name;?></td>
                                    <td style="text-align: center;"><?= $value->quantity;?></td>
                                    <td style="text-align: center;"><?= $value->sale_price;?></td>
                                    <td style="text-align: center;"><?= $value->quantity * $value->sale_price;?></td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <?php
                                    $voucher_id = $voucher_info_customer->voucher_id;
                                    $result = $this->db->query
                                            (
                                            "select"
                                            . " tbl_invoice.*, sum(tbl_invoice.quantity * tbl_invoice.sale_price) as grandTotal"
                                            . " FROM tbl_invoice"
                                            . " WHERE tbl_invoice.voucher_id = '$voucher_id' AND NOT (tbl_invoice.delete_status <=> 'deleted')"
                                            )->row();

                                ?>
                                <td colspan="4" style="text-align: right;"><b>Grand Total:</b></td>
                                <td style="text-align: center;">
                                    <?=$result->grandTotal;?>
                                </td>
                            </tr> 
                            <tr>
                                <td colspan="4" style="text-align: right;"><b>Discount:</b></td> 
                                <td style="text-align: center;">
                                    <?= $value->discount;?>
                                </td>
                            </tr> 
                            <tr style="">
                                <td colspan="4" style="text-align: right;"><b>Final Total:</b></td>
                                <td style="text-align: center;">
                                    <?= ($result->grandTotal - $value->discount)?>
                                </td>
                            </tr> 
                            <tr>
                                <td colspan="4" style="text-align: right;"><b>Paid Amount:</b></td> 
                                <td style="text-align: center;">
                                    <span id="paidAmountValue_<?php echo $sl;?>"><?= $value->paid_amount;?></span>
                                </td>
                            </tr>
                            
                            <tr>
                                <td colspan="4" style="text-align: right;"><b>Due:</b></td> 
                                <td style="text-align: center;">
                                    <?= ($result->grandTotal - $value->discount) - $value->paid_amount;?>
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                    <table width="100%">
                        <tr>
                            <td style="text-align: left;"><p>In Word: <span id="paidAmountValueInWord_<?php echo $sl;?>"></span> taka only.</p></td>
                        </tr>
                    </table>

                    <table  width="100%">
                        <tr>
                            <td colspan="2" style="height: 50px;"></td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">
                                <p style="padding-left: 28px; line-height: 0px; margin-bottom: -4px;"> <?php echo $voucher_info_customer->entry_by?>  </p>
                                <p style="text-decoration: overline; padding-left: 15px;"> Prepared by </p>
                            </td>
                            <td style="width: 50%; text-align: right;">
                                <p style="padding-left: 15px; line-height: 0px; margin-bottom: -4px;"> &nbsp; </p>
                                <p style="text-decoration: overline; padding-left: 15px;"> Customer </p>
                            </td>
                        </tr>
                    </table>
                            
                        
                            
                            
                        
                    
            </div>
            
        <?php } ?>

    </div>

    <!-- <a href="<?php echo base_url('invoice');?>" class="btn btn-secondary"><i class="fa fa-angle-left"></i> Back To Invoice List</a><br> -->
    <!-- <button id="btnPrint" class="btn btn-primary" style="float: right;"> <i class="fa fa-print" aria-hidden="true" style="font-size: 25px; margin-right: 10px;"></i>Print</button> -->

    <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
        $("#btnPrint").live("click", function () {
            var divContents = $("#dvContainer").html();
            var printWindow = window.open('', '', 'height=auto,width=auto');
            printWindow.document.write('<html><head><title>DIV Contents</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
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
            var number_1 = document.getElementById("paidAmountValue_1").innerText;  
            var Inwords_1 = toWordsconver(number_1);
            document.getElementById("paidAmountValueInWord_1").innerHTML = Inwords_1;
            
            var number_2 = document.getElementById("paidAmountValue_2").innerText;  
            var Inwords_2 = toWordsconver(number_2);
            document.getElementById("paidAmountValueInWord_2").innerHTML = Inwords_2;
        });
    </script>
</body>