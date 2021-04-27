
  
  
<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">Order</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">Add order</li>
    </ol>
    </div>
    <div class="col-sm-3">
        <div class="top-button-area">
            <a class="btn btn-primary m-1" href="<?php echo base_url('order');?>"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back</a>
        </div>
        <div class="top-button-area">
            <a class="btn btn-primary m-1" href="<?php echo base_url('order-form');?>"><i class="fa fa-retweet" aria-hidden="true"></i></a>
        </div>
    </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
   <div class="col-lg-12">
     <div class="card">
        <div class="card-header text-uppercase">Add order Form</div>
        <div class="card-body">
            <center> 
                <font color="#FF0000" style="font-size: 20px;">
                <?php
                $message = $this->session->userdata('message');
                //echo $message;
                if (isset($message)) {
                    echo $message;
                    $this->session->unset_userdata('message');
                }
                ?>

                </font>
            </center>
            
            
            
            
            <button type="button" class="btn btn-primary" onclick="showarea()">Old Customer</button><!-----for exits customer----->
            <button type="button" class="btn btn-success" onclick="hiddenareaAndShowCutomerAddarea()"><i aria-hidden="true" class="fa fa-plus-circle"></i> New Customer</button><!----new customer add---->
            <button type="button" class="btn btn-danger" onclick="hiddenarea()">Common Customer</button><!---for common customer--->
            
            
            
            <?php echo form_open('save-order', 'name="save-order" id="saveorder"');?>
           <!-- <label>Vouser ID:</label><input type="text" class="form-control form-control-rounded" name="voucherId_manual" value="" required="required"/> -->
            
                <div class="row hideArea">
                    <div class="col-md-4">
                        <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="col-form-label">Name</label>
                            <input type="text" name="customer_name" id="customer_name" placeholder="type customer name"  class="form-control form-control-rounded required valueNull" required="">
                            <input type="hidden" name="customer_id" id="customer_id"  class="form-control form-control-rounded valueNull">
                            
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="col-form-label">Phone</label>
                            <input type="text" id="customer_mobile" class="form-control form-control-rounded valueNull" disabled="">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="col-form-label">Email</label>
                            <input type="email" id="customer_email" class="form-control form-control-rounded valueNull" disabled="">
                        </div>
                      </div>
                    </div>

                </div>


                <!---new customer---->
                <div class="row newCustomerArea">
                    <div class="col-md-4">
                        <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="col-form-label">Name</label>
                            <input type="text" name="customer_name_new" placeholder="customer name"  class="form-control form-control-rounded newCustmReq valueNull">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="col-form-label">Phone</label>
                            <input type="number" name="customer_mobile_new" placeholder="Mobile no" class="form-control form-control-rounded newCustmReq valueNull">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="col-form-label">Email</label>
                            <input type="email" name="customer_email_new" placeholder="Email" class="form-control form-control-rounded valueNull">
                        </div>
                      </div>
                    </div>

                </div>
                <!---new customer---->


                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group row hideArea">
                            <div class="col-sm-12">
                                <label class="col-form-label">Address</label>
                                <input type="text" id="customer_address" class="form-control form-control-rounded valueNull" disabled="">
                            </div>
                        </div>

                        <!---new customer---->
                        <div class="form-group row newCustomerArea">
                            <div class="col-sm-12">
                                <label class="col-form-label">Address</label>
                                <input type="text" name="customer_address_new" placeholder="Address" class="form-control form-control-rounded valueNull">
                            </div>
                        </div>
                        <!---new customer---->

                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="col-form-label">Date</label>
                            <input type="text" name="invoice_date" id="datepicker" value="<?php echo date('Y-m-d'); ?>" class="form-control form-control-rounded">
                            <?php echo form_error('invoice_date', '<div class="error">', '</div>'); ?>
                        </div>
                      </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="col-form-label">Note</label>
                            <input type="text" name="note" class="form-control form-control-rounded">
                        </div>
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div style="overflow-x:auto;">
                            <table name="save-order" id="autocomplete_table" class="table table-bordered table-sm table-hover tbl-own" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Rate</th>
                                        <th>Calculation</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="row_1">
                                        <td>
                                            <input type="text" name="product_name" onchange="productPress(this)" id="product_name_1" placeholder="type product name" class="form-control autocomplete_txt" required="">
                                            <input type="hidden" name="product_id[]" id="product_id_1">
                                        </td>
                                        <td>
                                            <input type="number" step=any name="quantity[]" onkeyup="qntyPress(this)" id="quantity_1" value="0" class="form-control">
                                            <p style="text-align: center; font-weight: bold; color: green"  id="avlableStock_1"></p>
                                        </td>
                                        <td><input type="number" step=any name="sale_price[]" onkeyup="pricePress(this)" id="sale_price_1" value="0" class="form-control"></td>
                                        <td><input type="number" step=any name="invc_ttl_price[]" id="invc_ttl_price_1" value="0" class="form-control" disabled="disabled"></td>
                                        <td class="text-center"></td>
                                    </tr>
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-right"><b>Discount:</b></td> 
                                        <td class="text-right">
                                            <input id="discountBox" onkeyup="setDiscount(this.value)" value="0" name="discount" type="number" step=any class="form-control w-100 text-center">
                                        </td> 
                                        <td align="center">
                                            <button id="addorderItem" name="add-order-item" type="button" class="btn btn-primary btn-sm">Add New Item</button>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td colspan="3" class="text-right"><b>Grand Total:</b></td>
                                        <td colspan="2" class="text-center">
                                            <input type="number" step=any id="grandTotal" disabled="disabled" class="form-control w-100 text-center">
                                        </td>
                                    </tr> 
                                    <tr style="">
                                        <td colspan="3" class="text-right"><b>Final Total:</b></td>
                                        <td colspan="2" class="text-center">
                                            <input type="number" step=any id="FinalAmount" value="" disabled="disabled" class="form-control w-100 text-center">
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td colspan="3" class="text-right"><b>Paid Amount:</b></td> 
                                        <td colspan="2" class="text-right">
                                            <input id="paidAmount" value="0" onkeyup="calculteDue(this.value)" name="paid_amount" type="number" step=any required="required" class="form-control w-100 text-center">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-right"><b>Day:</b></td> 
                                        <td colspan="2" class="text-right">
                                            <input value="" name="payment_day" type="number" class="form-control w-100 text-center">
                                        </td>
                                    </tr>
                                    <tr class="dueArea">
                                        <td colspan="3" class="text-right"><b>Due:</b></td> 
                                        <td class="text-center">
                                            <input type="number" step=any disabled="disabled" id="dueBox" class="form-control w-100 text-center">
                                        </td>
                                    </tr>
                                    <tr class="duePaid">
                                        <td colspan="5" class="text-right text-success"><b>Total Paid.</b></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="form-footer">
                    <a href="<?php echo base_url('order');?>" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a>
                  <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Save</button>
                </div>
            
            
            
            
            <!--<input type="hidden" id="base_path" value="<?php //echo base_url();?>" >--><!---for ajax base path--->
            <?php echo form_close();?>
        </div>
     </div>
   </div>
</div>
<script>
    //for common customer
    function hiddenarea(){
        $(".newCustomerArea").hide();
        $(".hideArea").hide();
        $('.required').removeAttr('required');
        $('.newCustmReq').removeAttr('newCustmReq');
        $(".valueNull").val(null);
    }

    //for exits customer
    function showarea(){
        $(".newCustomerArea").hide();
        $(".hideArea").show();
        $('.newCustmReq').removeAttr('newCustmReq');
        $('.required').attr('required', 'required');
    }

    //new customer add
    function hiddenareaAndShowCutomerAddarea(){
        $(".hideArea").hide();
        $(".newCustomerArea").show();
        $('.required').removeAttr('required');
        $('.newCustmReq').attr('required', 'required');
        $(".valueNull").val(null);
    }
</script>
<script type='text/javascript'>
$(document).ready(function(){
    $(".newCustomerArea").hide();
    $('.newCustmReq').removeAttr('newCustmReq');
    $(".dueArea").hide();
    $(".duePaid").hide();
    $( "#datepicker" ).datepicker({dateFormat: "yy-mm-dd"});

    //var basePath = $("#base_path").val();
    $("#customer_name").autocomplete({
        source: function(request, cb){
            console.log(request);

            $.ajax({
                //url: basePath+'get-customers/'+request.term,
                url: "<?=base_url()?>get-customers/"+request.term,
                method: 'GET',
                dataType: 'json',
                success: function(res){
                    var result;
                    result = [
                        {
                            label: 'There is no matching record found for '+request.term,
                            value: ''
                        }
                    ];

                    console.log("Before format", res);


                    if (res.length) {
                        result = $.map(res, function(obj){
                            return {
                                label: obj.customer_name,
                                value: obj.customer_name,
                                data : obj
                            };
                        });
                    }

                    console.log("formatted response", result);
                    cb(result);
                }
            });
        },
        select: function( event, selectedData ) {
            console.log(selectedData);

            if (selectedData && selectedData.item && selectedData.item.data){
                var data = selectedData.item.data;

                $('#customer_id').val(data.customer_id);
                $('#customer_mobile').val(data.customer_mobile);
                $('#customer_email').val(data.customer_email);
                $('#customer_address').val(data.customer_address);
            }

        }  
    });//customer data end
           
    

});
</script>
<script>

$(document).ready(function() {
	var max_fields      = 10; 
	var wrapper   	    = $("#autocomplete_table tbody"); 
	var add_button      = $("#addorderItem"); 
	
	var rowCount = 1;
        var html;
	$(add_button).click(function(e){ 
            e.preventDefault();
            if(rowCount < max_fields){ 
                    rowCount++; 
                    html = '<tr id="row_'+rowCount+'">';
                    html += '<td>\n\
                                <input type="text"  name="product_name" onchange="productPress(this)" id="product_name_'+rowCount+'" placeholder="type product name" class="form-control autocomplete_txt" required="">\n\
                                <input type="hidden" " name="product_id[]" id="product_id_'+rowCount+'">\n\
                            </td>';
                    html += '<td>\n\
                                <input type="number" step=any  name="quantity[]" onkeyup="qntyPress(this)" id="quantity_'+rowCount+'" value="0" class="form-control">\n\
                                <p style="text-align: center; font-weight: bold; color: green"  id="avlableStock_'+rowCount+'"></p>\n\
                            </td>';
                    html += '<td><input type="number" step=any  name="sale_price[]" onkeyup="pricePress(this)" id="sale_price_'+rowCount+'" value="0" class="form-control"></td>';
                    html += '<td><input type="number" step=any  name="invc_ttl_price[]" id="invc_ttl_price_'+rowCount+'" value="0" class="form-control" disabled="disabled"></td>';
                    html += '<td class="text-center"><button type="button" id="remove_'+rowCount+'" name="remove" data-row="row" scope="row" class="btn btn-danger btn-sm timesSpan delete_row">×</button></td>';
                    html += '</tr>';

                    $(wrapper).append(html); //add input box
            }
	});
	
	$(wrapper).on("click",".delete_row", function(e){ 
            e.preventDefault(); $("#row_"+rowCount).remove(); rowCount--;
            var grandTotal = 0;
            var countTotal =  $('input[name="invc_ttl_price[]"]').length;
            for (i = 1; i <= countTotal; i++) {
                grandTotal = parseFloat(grandTotal) + parseFloat($("#invc_ttl_price_"+i).val());
            }

            $("#grandTotal").attr("value",grandTotal);
        });
        
        
});
function productPress(args){
    var id = args.id;
    var res = id.split("_");
    var number = res[2];
    var unit = $("#sale_price_"+number).val();
    var qnty = $("#quantity_"+number).val();
    var totalPrice = unit*qnty;
    $("#invc_ttl_price_"+number).attr("value",totalPrice);
    var grandTotal = 0;
   var countTotal =  $('input[name="invc_ttl_price[]"]').length;
   for (i = 1; i <= countTotal; i++) {
        grandTotal = parseFloat(grandTotal) + parseFloat($("#invc_ttl_price_"+i).val());
    }
    $("#grandTotal").attr("value",grandTotal);
    $("#FinalAmount").attr("value",grandTotal);

    
    
}
function qntyPress(args){


   var id = args.id;
   var qnty = args.value;
   var res = id.split("_");
   var number = res[1];
   var price = $("#sale_price_"+number).val();
   var total = qnty*price;
   $("#invc_ttl_price_"+number).attr("value",total);
    var grandTotal = 0;
   var countTotal =  $('input[name="invc_ttl_price[]"]').length;
   for (i = 1; i <= countTotal; i++) {
        grandTotal = parseFloat(grandTotal) + parseFloat($("#invc_ttl_price_"+i).val());
    }

    $("#grandTotal").attr("value",grandTotal);
    $("#FinalAmount").attr("value",grandTotal);
   
}

function pricePress(args){

    var id = args.id;
    var price = args.value;
    var res = id.split("_");
    var number = res[2];
    var qnty = $("#quantity_"+number).val();
    var total = qnty*price;
    $("#invc_ttl_price_"+number).attr("value",total);

    var grandTotal = 0;
   var countTotal =  $('input[name="invc_ttl_price[]"]').length;
   for (i = 1; i <= countTotal; i++) {
        grandTotal = parseFloat(grandTotal) + parseFloat($("#invc_ttl_price_"+i).val());
    }

    $("#grandTotal").attr("value",grandTotal);
    $("#FinalAmount").attr("value",grandTotal);
   

}

function setDiscount(discount){
    var grandTotal = $("#grandTotal").val();
    var FinalAmount = grandTotal - discount;
    $("#FinalAmount").attr("value",FinalAmount);

}
    function calculteDue(paidAmount){
        $(".dueArea").show();
        var FinalAmount = $("#FinalAmount").val();
        
        var due = FinalAmount - paidAmount;

        if(FinalAmount == paidAmount){
            $(".dueArea").hide();
            $(".duePaid").show();
        }else{
            $(".duePaid").hide();
        }
        $("#dueBox").attr("value",due);
    }

</script>

<script>
    function getId(element){
            var id, idArr;
            id = element.attr('id');
            idArr = id.split("_");
            return idArr[idArr.length - 1];
        }
        
    function handleAutocomplete() {
        $(this).autocomplete({
            source: function(request, cb){
                console.log(request);

                $.ajax({
                    //url: basePath+'get-customers/'+request.term,
                    url: "<?=base_url()?>get-products/"+request.term,
                    method: 'GET',
                    dataType: 'json',
                    success: function(res){
                        var result;
                        result = [
                            {
                                label: 'There is no matching record found for '+request.term,
                                value: ''
                            }
                        ];

                        console.log("Before format", res);


                        if (res.length) {
                            result = $.map(res, function(obj){
                                return {
                                    label: obj.product_name,
                                    value: obj.product_name,
                                    data : obj
                                };
                            });
                        }

                        console.log("formatted response", result);
                        cb(result);
                    }
                });
            },
            select: function( event, selectedData ) {
                console.log(selectedData);

                if (selectedData && selectedData.item && selectedData.item.data){
                    var data = selectedData.item.data;
                    var currectEle, rowNo;
                    currectEle = $(this);
                    rowNo = getId(currectEle);

                    $('#product_id_'+rowNo).val(data.product_id);
//                    $('#quantity_'+rowNo).val(data.quantity);
                    $('#quantity_'+rowNo).val(1);
                    $('#sale_price_'+rowNo).val(data.price);


                    product_id = data.product_id;
                    $.ajax({
                        type: 'post',
                        url: '<?php echo base_url(); ?>Invoice/avalbaleStockStatus',
                        data: {
                            product_id: product_id
                        },
                        dataType: 'json', // this bit here
                        success: function (response) {
                            console.log(response.available);
                            // $('#avlableStock_'+rowNo).val(response.challan_date);
                            $('#avlableStock_'+rowNo).text(response.available + ' ' + response.pack_size);
                        }
                    });


                }

            }		      	
        });
    }

    $(document).on("focus", '.autocomplete_txt', handleAutocomplete);
</script>
    

