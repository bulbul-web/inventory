
  
  
<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">Expense</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">Update Expense</li>
    </ol>
    </div>
    <div class="col-sm-3">
        

     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
   <div class="col-lg-12">
     <div class="card">
        <div class="card-header text-uppercase">Update Transaction ID: <span style="color: red;"><?php echo $expense_details->trnsction_id;?></span></div>
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
            
            <?php echo form_open('update-expense', 'name="update-expense" id="updateExpense"');?>
            
                

                <div class="row">
                    
                    <div class="col-md-3">
                        <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="col-form-label">Date</label>
                            <input type="text" name="trnsction_date" id="datepicker" value="<?php echo $expense_details->trnsction_date; ?>" class="form-control form-control-rounded">
                            <?php echo form_error('trnsction_date', '<div class="error">', '</div>'); ?>
                            <input type="hidden" name="trnsction_id" value="<?php echo $expense_details->trnsction_id;?>" />
                        </div>
                      </div>
                    </div>

                    <div class="col-md-9">
                        <div class="form-group row hideArea">
                        <div class="col-sm-12">
                            <label class="col-form-label">Note</label>
                            <input type="text" name="note" value="<?php echo $expense_details->note; ?>" class="form-control form-control-rounded">
                        </div>
                      </div>
                    </div>
                </div>
                
                <div class="row">

                    <div class="col-md-12">
                        <table id="autocomplete_table" class="table table-bordered table-sm table-hover tbl-own" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th width="60%">Expense Name</th>
                                    <th>Amount</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            <?php
                                $i = 0;
                                foreach($expense_details_all as $value):
                                $i++;
                            ?>
                                <tr id="row_<?=$i;?>">
                                    <td>
                                        <input type="text" name="trnsaction_head" id="trnsaction_head_<?=$i;?>" value="<?= $value->trnsaction_head?>" placeholder="type expense name" class="form-control autocomplete_txt" required="" disabled="">
                                        <input type="hidden" name="id[]" id="id_<?=$i;?>" value="<?php echo $value->costs_head_id;?>" required="">
                                        <input type="hidden" name="trns_prmr_id[]"  value="<?php echo $value->id;?>">
                                    </td>
                                    <td><input type="number" step=any name="amount[]" onkeyup="amountPress(this)" id="amount_<?=$i;?>" value="<?= $value->amount?>" class="form-control" required=""></td>
                                    <!-- <td class="text-center" colspan="2"><a type="button" href="<?php echo base_url();?>delete-expense/<?php echo $value->id;?>/<?=$value->trnsction_id;?>" onclick="return confirm('Are you sure to remove?')" name="remove" data-row="row" scope="row" class="btn btn-danger btn-sm timesSpan">×</a></td> -->
                                    <td class="text-center" colspan="2"><a type="button" href="<?php echo base_url();?>delete-expense-status/<?php echo $value->id;?>/<?=$value->trnsction_id;?>" onclick="return confirm('Are you sure to remove?')" name="remove" data-row="row" scope="row" class="btn btn-danger btn-sm timesSpan">×</a></td>
                                </tr>
                            <?php endforeach;?>
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="2"  align="center" class="text-center">
                                        <button id="addExpenseItem" name="add-invoice-item" type="button" class="btn btn-primary btn-sm">Add New Item</button>
                                    </td>
                                </tr> 
                                <tr>
                                    <td colspan="3" class="text-right"><b>Grand Total:</b></td>
                                    <td colspan="2" class="text-center">
                                        <input type="number" step=any id="grandTotal" value="<?php echo $expense_details->totalAmount;?>" disabled="disabled" class="form-control w-100 text-center">
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="form-footer">
                    <a href="<?php echo base_url('costs-list');?>" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a>
                  <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Update</button>
                </div>
            
            
            
            
            <!--<input type="hidden" id="base_path" value="<?php //echo base_url();?>" >--><!---for ajax base path--->
            <?php echo form_close();?>
        </div>
     </div>
   </div>
</div>


<script type='text/javascript'>
$(document).ready(function(){
    $( "#datepicker" ).datepicker({dateFormat: "yy-mm-dd"});
});
</script>


<script>
$(document).ready(function() {
	var max_fields      = 10; 
	var wrapper   	    = $("#autocomplete_table tbody"); 
	var add_button      = $("#addExpenseItem"); 
	
	var rowCount = <?php echo $i;?>;
        var html;
	$(add_button).click(function(e){ 
            e.preventDefault();
            if(rowCount < max_fields){ 
                    rowCount++; 
                    html = '<tr id="row_'+rowCount+'">';
                    html += '<td>\n\
                                <input type="text"  name="trnsaction_head" id="trnsaction_head_'+rowCount+'" placeholder="type expense name" class="form-control autocomplete_txt" required="">\n\
                                <input type="hidden" " name="id[]" id="id_'+rowCount+'" required="">\n\
                            </td>';
                    html += '<td><input type="number" step=any  name="amount[]" onkeyup="amountPress(this)" id="amount_'+rowCount+'" value="0" class="form-control" required=""></td>';
                    html += '<td class="text-center" colspan="2"><button type="button" id="remove_'+rowCount+'" name="remove" data-row="row" scope="row" class="btn btn-danger btn-sm timesSpan delete_row">×</button></td>';
                    html += '</tr>';

                    $(wrapper).append(html); //add input box
            }
	});
	
	$(wrapper).on("click",".delete_row", function(e){ 
            e.preventDefault(); $("#row_"+rowCount).remove(); rowCount--;
            var grandTotal = 0;
            var countTotal =  $('input[name="amount[]"]').length;
            for (i = 1; i <= countTotal; i++) {
                grandTotal = parseFloat(grandTotal) + parseFloat($("#amount_"+i).val());
            }

            $("#grandTotal").attr("value",grandTotal);
        });
        
        
});



function amountPress(args){
    var id = args.id;
    var price = args.value;
    var res = id.split("_");
    var number = res[1];
    var total = $("#amount_"+number).val();
    $("#amount_"+number).attr("value",total);

    var grandTotal = 0;
    var countTotal =  $('input[name="amount[]"]').length;
    for (i = 1; i <= countTotal; i++) {
            grandTotal = parseFloat(grandTotal) + parseFloat($("#amount_"+i).val());
        }

    $("#grandTotal").attr("value",grandTotal);
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
                    url: "<?=base_url()?>get-transaction-head/"+request.term,
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
                                    label: obj.trnsaction_head,
                                    value: obj.trnsaction_head,
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

                    $('#id_'+rowNo).val(data.id);
                }

            }		      	
        });
    }

    $(document).on("focus", '.autocomplete_txt', handleAutocomplete);
</script>