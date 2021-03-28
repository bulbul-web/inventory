<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">Add Journal Tansaction</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">Add Journal Tansaction</li>
    </ol>
    </div>
    <div class="col-sm-3">
        <div class="top-button-area">
            <a class="btn btn-primary m-1" href="<?php echo base_url();?>account-journal-transaction-add"><i class="fa fa-retweet" aria-hidden="true"></i></a>
        </div>
     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
   <div class="col-lg-12">
     <div class="card">
        <div class="card-header text-uppercase">Add Journal Tansaction Form</div>
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
            
            <?php echo form_open_multipart('save-acnt-journal-tansaction-mltple-trns-all', 'name="save-acnt-journal-tansaction-mltple-trns-all" id="saveAcntJournalTansactionMltpleTrnsAll"');?>
                
                


            <div class="row">
            
                <div class="col-md-6">
                    <div class="form-group row">
                    <div class="col-sm-12">
                        <label class="col-form-label">Transaction Date</label>
                        <input type="text" name="TrnDate" id="datepicker" value="<?php echo date('Y-m-d'); ?>" class="form-control form-control-rounded" required="">
                        <?php echo form_error('TrnDate', '<div class="error">', '</div>'); ?>
                        
                    </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="col-form-label">Select Project Name</label>
                            <select name="project_id" id="project_id" class="form-control" required="">
                                    <option value="" disabled selected>----Select----</option>
                                <?php
                                    $projects = $this->db->query("SELECT * FROM tbl_project WHERE status = 1")->result();
                                    foreach($projects as $value):
                                ?>
                                    <option value="<?= $value->project_id;?>"><?= $value->project_name;?></option>
                                    
                                <?php endforeach;?>
                            </select>
                            <?php echo form_error('project_id', '<div class="error">', '</div>');?>
                        </div>
                    </div>
                </div>
                
                

            </div>

              


            <!-- <div class="row">

                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="col-form-label">Select Control Head</label>
                            <select name="TrasactionHeadID" class="form-control" required="">
                                <option value="" disabled selected>----Select----</option>
                                <?php
                                    $result = $this->db->query("SELECT t.*, ssh.SSubHeadDescription, ssh.SubHeadID, sh.SubHeadDescription, sh.ControlHead_id, c.HeadDescription FROM tbl_transactionhead t, tbl_subsubheads ssh, tbl_subhead sh, tbl_controlhead c WHERE t.SSubHeadID = ssh.SSubHeadID AND ssh.SubHeadID = sh.SubHeadID AND c.ControlHead_id = sh.ControlHead_id AND sh.SubHeadID = '1' AND ssh.SSubHeadID = '14' AND c.ControlHead_id = '1'")->result();
                                    foreach($result as $value):
                                ?>
                                    <option value="<?= $value->TransactionHeadID;?>"><?= $value->TransHeadDescription;?></option>
                                    
                                <?php endforeach;?>
                            </select>
                            <?php echo form_error('TrasactionHeadID', '<div class="error">', '</div>');?>
                        </div>
                    </div>
                </div>             
                
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="col-form-label">Transaction Type</label>
                            <select name="V_Type" id="V_Type" class="form-control" required="">
                                <option value="" disabled selected>----Select----</option>
                                <option value="DR">DR</option>
                                <option value="CR">CR</option>
                            </select>
                            <?php echo form_error('V_Type', '<div class="error">', '</div>');?>
                        </div>
                    </div>
                </div>             


            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="col-form-label">Note</label>
                            <input type="text" name="Note" class="form-control">
                        </div>
                    </div>
                </div>
            </div> -->



            <div class="row">
                <div class="col-md-12">
                    <table name="save-transaction" id="autocomplete_table" class="table table-bordered table-sm table-hover tbl-own" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Select Transaction Head</th>
                                <th>Debit</th>
                                <th>Cretid</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="row_1">
                            
                                <td width="60%">
                                    <input type="text" name="TransHeadDescription" id="TransHeadDescription_1" placeholder="Type Transaction Head" class="form-control autocomplete_txt" required="">
                                    <input type="hidden" name="TransactionHeadIDAcnt[]" id="TransactionHeadIDAcnt_1">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="col-form-label"></label>
                                            <input type="text" name="NoteAcnt[]" class="form-control" placeholder="Note">
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <input type="number" step=any name="amount_dr[]" id="amount_dr_1" onkeyup="amountPressDr(this)"  class="form-control" required="">
                                    <input type="hidden" step=any name="amountDefaultDr[]" value="0">
                                </td>
                                
                                <td>
                                    <input type="number" step=any name="amount_cr[]" id="amount_cr_1" onkeyup="amountPressCr(this)"  class="form-control" required="">
                                    <input type="hidden" step=any name="amountDefaultCr[]" value="0">
                                </td>
                                
                                
                                <td class="text-center"></td>

                            </tr>
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-right"></td> 
                                
                                <td align="center">
                                    <button id="addInvoiceItem" name="add-invoice-item" type="button" class="btn btn-primary btn-sm">Add New Item</button>
                                </td>
                            </tr> 

                            <tr>
                                <td class="text-right"><b>Grand Total:</b></td>
                                <td><input type="number" step=any id="grandTotal" disabled="disabled" class="form-control w-100 text-center"></td>
                                <td class="text-center">
                                    <input type="number" step=any id="grandTotal" disabled="disabled" class="form-control w-100 text-center">
                                </td>
                                <td></td>
                            </tr>
                            
                            
                        </tfoot>
                    </table>
                </div>
            </div>
                
                

             

                <div class="form-footer">
                    <a href="<?php echo base_url('journal-transaction-list');?>" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Save</button>
                </div>

            <?php echo form_close();?>
        </div>
     </div>
   </div>
</div>

<script>
    document.getElementById('V_Type').value="<?php echo set_value('V_Type'); ?>";
</script>
<script>
    $(document).ready(function(){
        $("#datepicker").datepicker({dateFormat: "yy-mm-dd"});


        //table clone
        var max_fields      = 10; 
        var wrapper   	    = $("#autocomplete_table tbody"); 
        var add_button      = $("#addInvoiceItem"); 
        
        var rowCount = 1;
        var html;
        $(add_button).click(function(e){ 
            e.preventDefault();
            if(rowCount < max_fields){ 
                    rowCount++; 
                    html = '<tr id="row_'+rowCount+'">';
                    html += '<td width="60%">\n\
                                <input type="text" name="TransHeadDescription" id="TransHeadDescription_'+rowCount+'" placeholder="Type Transaction Head" class="form-control autocomplete_txt" required="">\n\
                                <input type="hidden" name="TransactionHeadIDAcnt[]" id="TransactionHeadIDAcnt_'+rowCount+'">\n\
                                <div class="form-group row">\n\
                                    <div class="col-sm-12">\n\
                                        <label class="col-form-label"></label>\n\
                                        <input type="text" name="NoteAcnt[]" class="form-control" placeholder="Note">\n\
                                    </div>\n\
                                </div>\n\
                            </td>';
                    html += '<td>\n\
                                <input type="number" step=any name="amount_dr[]" id="amount_dr_'+rowCount+'" onkeyup="amountPressDr(this)"  class="form-control" required="">\n\
                                <input type="hidden" step=any name="amountDefaultDr[]" value="0">\n\
                            </td>';
                    html += '<td>\n\
                                <input type="number" step=any name="amount_cr[]" id="amount_cr_'+rowCount+'" onkeyup="amountPressCr(this)"  class="form-control" required="">\n\
                                <input type="hidden" step=any name="amountDefaultCr[]" value="0">\n\
                            </td>';
                    html += '<td class="text-center"><button type="button" id="remove_'+rowCount+'" name="remove" data-row="row" scope="row" class="btn btn-danger btn-sm timesSpan delete_row">×</button></td>';
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

    function amountPressDr(args){
        // alert(args);
        var id = args.id;
        alert(id);
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
                    url: "<?=base_url()?>get-transaction-head-account/"+request.term,
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
                                    label: obj.TransHeadDescription,
                                    value: obj.TransHeadDescription,
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

                    $('#TransactionHeadIDAcnt_'+rowNo).val(data.TransactionHeadID);
                    $('#amount_'+rowNo).val(0);
                }

            }		      	
        });
    }

    $(document).on("focus", '.autocomplete_txt', handleAutocomplete);
</script>