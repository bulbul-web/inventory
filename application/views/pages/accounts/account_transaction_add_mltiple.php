<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
   <div class="col-sm-9">
    <h4 class="page-title">Add Tansaction</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">Add Tansaction</li>
    </ol>
    </div>
    <div class="col-sm-3">
        

     </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
   <div class="col-lg-12">
     <div class="card">
        <div class="card-header text-uppercase">Add Tansaction Form</div>
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
            
            <?php echo form_open_multipart('save-acnt-tansaction-mltple', 'name="save-acnt-tansaction-mltple" id="saveAcntTansactionMltple"');?>
                
                


            <div class="row">
            
                <div class="col-md-6">
                    <div class="form-group row">
                    <div class="col-sm-12">
                        <label class="col-form-label">Transaction Date</label>
                        <input type="text" name="TrnDate" id="datepicker" value="<?php echo date('Y-m-d'); ?>" class="form-control form-control-rounded">
                        <?php echo form_error('TrnDate', '<div class="error">', '</div>'); ?>
                        
                    </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="col-form-label">Select Project Name</label>
                            <select name="project_id" id="project_id" class="form-control">
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


            <div class="row">


                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="col-form-label">Transaction Type</label>
                            <select name="V_Type" id="V_Type" class="form-control">
                                <option value="" disabled selected>----Select----</option>
                                <option value="DR">DR</option>
                                <option value="CR">CR</option>
                            </select>
                            <?php echo form_error('V_Type', '<div class="error">', '</div>');?>
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="col-form-label">Select Control Head</label>
                            <select name="ControlHead_id" id="ControlHead_id" class="form-control">
                                
                            </select>
                            <?php echo form_error('ControlHead_id', '<div class="error">', '</div>');?>
                        </div>
                    </div>
                </div>             


            </div>



            <div class="row">
                <div class="col-md-12">
                    <table name="save-invoice" id="autocomplete_table" class="table table-bordered table-sm table-hover tbl-own" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Select Transaction Head</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="row_1">

                                <td width="60%">
                                    <select name="TransactionHeadID[]" id="TransactionHeaID" class="form-control" required="">

                                    </select>

                                    <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label class="col-form-label">Note</label>
                                        <input type="text" name="note[]" class="form-control form-control-rounded" required="">
                                    </div>
                                </td>

                                <td>
                                    <input type="number" step=any name="amount[]"  class="form-control" required="">
                                </td>
                                
                                
                                <td class="text-center"></td>

                            </tr>
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" class="text-right"></td> 
                                
                                <td align="center">
                                    <button id="addInvoiceItem" name="add-invoice-item" type="button" class="btn btn-primary btn-sm">Add New Item</button>
                                </td>
                            </tr> 
                            
                            
                        </tfoot>
                    </table>
                </div>
            </div>
                
                

             

                <div class="form-footer">
                    <a href="<?php echo base_url('transaction-list');?>" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a>
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
        
        //get sub head by ControlHead_id

        $("#V_Type").change(function(){
            v_type = $("#V_Type").val();
            // alert(v_type);

            $.ajax({
                type: "POST",
                // url: "<?php echo base_url();?>get-transaction-by-v-type/"+v_type,
                url: "<?php echo base_url();?>get-control-head-by-v-type/"+v_type,
                success:function(data){
                    $("#ControlHead_id").html(data);
                }
            });

            

            $("#ControlHead_id").change(function(){
                ControlHead_id = $("#ControlHead_id").val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>get-transaction-by-contrl-head-id/"+ControlHead_id,
                    success:function(data){
                        $("#TransactionHeaID").html(data);
                    }
                });
            });

        });
        //get sub head by ControlHead_id



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
                html += '<td>\n\
                        <select name="TransactionHeadID[]" id="TransactionHeaID" class="form-control">\n\
                        \n\
                        </select>\n\
                        \n\
                        <div class="form-group row">\n\
                        <div class="col-sm-12">\n\
                            <label class="col-form-label">Note</label>\n\
                            <input type="text" name="note[]" class="form-control form-control-rounded" required="">\n\
                        </div>\n\
                        </td>';
                html += '<td><input type="number" step=any name="amount[]"  class="form-control" required=""></td>';
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
</script>