<?php
$save_branch = $this->acl_model->has_permission('branches','saveBranch',$role_ids_array);
$edit_branch = $this->acl_model->has_permission('branches','updateBranch',$role_ids_array);
$delete_branch = $this->acl_model->has_permission('branches','deleteBranch',$role_ids_array);
$restore_branch = $this->acl_model->has_permission('branches','restoreBranch',$role_ids_array);
?>
<?php if($save_branch === TRUE){ ?>
<h3>Add Branches</h3>
<br />          
<br />  
<form method="POST" enctype="multipart/form-data" action="<?=base_url('saveBranch');?>">  
            <div class="row">
            <div class="col-md-12" >
                                
                <div class="col-md-8">
                    <div class="form-group">
                        <div class="col-md-3">
                            <label>Branch Country</label>
                        </div>
                        <div class="col-md-8">
                            <select name="branch_warehouse_id" class="form-control">
                                <option value="">Select Warehouse</option>
                                <?php foreach ($warehouses as $warehouse) { 
                                    if($warehouse['isdel'] == 0){ ?>
                                    <option value="<?=$warehouse['warehouse_id'];?>"><?=$warehouse['warehouse_name'];?></option>
                                <?php }else{ ?>
                                    <option value="<?=$warehouse['warehouse_id'];?>" disabled="" style="background-color: #bd1717;color: white;"><?=$warehouse['warehouse_name'];?> <span> (Record Deleted)</span></option>
                                <?php }} ?>
                            </select>
                        </div>
                    </div> 

                    <br><br><br>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label>Branch Country <span class="required" aria-required="true">*</span></label>
                        </div>
                        <div class="col-md-8">
                            <select name="branch_country_id" class="form-control" required="">
                                <option value="">Select Country</option>

                                <?php foreach ($countries as $country) { 
                                    if($country['isdel'] == 0){ ?>
                                    <option value="<?=$country['country_id'];?>"><?=$country['country_name'];?></option>
                                <?php }else{ ?>
                                    <option value="<?=$country['country_id'];?>" disabled="" style="background-color: #bd1717;color: white;"><?=$country['country_name'];?> <span> (Record Deleted)</span></option>
                                <?php }} ?>
                              
                            </select>
                        </div>
                    </div> 
                    <br><br><br>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label>Branch Name <span class="required" aria-required="true">*</span></label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="branch_name" class="form-control" value="<?=set_value('branch_name');?>" required="">
                        </div>
                    </div>  

                    <br><br>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label>Branch Detail </label>
                        </div>
                        <div class="col-md-8">
                            <textarea name="editor2"><?=set_value('editor2');?></textarea>
                            <script>
                                    CKEDITOR.replace( 'editor2' );
                            </script>
                        </div>
                    </div>
    
                    <div class="col-md-12" style="text-align: center;margin: 20px;">
                        <button type="submit" class="btn btn-info" >Submit</button>                   
                    </div>                      
                </div>  
            
    
        </div>
        </div>

</form>
<?php } ?>
<h3>View Branches</h3>
<br />          
<table class="table table-bordered datatable" id="table-4">
    <thead>
        <tr>
            <th>No</th>
            <th>Warehouse</th>  
            <th>Branch Name</th>  
            <th>Branch Country</th>  
            <th width="20%">Branch Detail</th>  
            <th>Created At</th>
<?php if($edit_branch === TRUE || $delete_branch === TRUE || $restore_branch === TRUE){ ?>
            <th>Action</th>
<?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php 
        $count = 1;
        foreach ($branches as $branch) {
            if($branch['added_on'] !='0000-00-00 00:00:00'){
                $date_object = new DateTime($branch['added_on']);
                $date = $date_object->format('d/m/Y h:i A');
            }else{
                $date = '';
            }
            $country_name = $this->Countries_model->get_country($branch['branch_country_id'])->country_name;
            if($country_name == ""){
                $country_name = '<spna class="not_available">Not available</span>';
            }
            $warehouse_name = $this->Warehouse_model->get_warehouse($branch['branch_warehouse_id'])->warehouse_name;
            if($warehouse_name == ""){
                $warehouse_name = '<spna class="not_available">Not available</span>';
            }
            ?>
            <tr class="odd gradeX">
                <td><?=$count;?></td>
                <td><?=$warehouse_name;?></td>
                <td><?=$branch['branch_name'];?></td>
                <td><?=$country_name;?></td>
                <td><?=$branch['branch_detail'];?></td>
                <td><?=$date;?></td> 
<?php if($edit_branch === TRUE || $delete_branch === TRUE || $restore_branch === TRUE){ ?>
                <td>
                    <?php if($branch['isdel'] == '0'){ ?>
<?php if($delete_branch === TRUE){ ?>                      
                        <button class="btn btn-danger" onclick="delete_record('<?=$branch["branch_id"]?>','cities')"><i class="fa fa-trash"></i> Delete</button>  
<?php } ?>  
<?php if($edit_branch === TRUE){ ?>                      
                        <button class="btn btn-info" onclick="edit_record('<?=$branch["branch_id"]?>')"><i class="fa fa-edit"></i> Edit</button>
<?php } ?>  
                    <?php }else{ ?>  
<?php if($restore_branch === TRUE){ ?>                      
                        <button class="btn btn-primary" onclick="restore_record('<?=$branch["branch_id"]?>')"><i class="fa fa-trash"></i> Restore</button>
<?php } ?>     
                    <?php } ?>  
                </td>
<?php } ?>
            </tr>
            <?php
            $count++;
        } ?>           
    </tbody>
</table>
<div class="modal fade in" id="edit_branch">
    <div class="modal-dialog">
      <div class="modal-content">
        
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Update Group</h4>
        </div>
        
        <div class="modal-body">
                <form name="frm" method="post" action="<?=base_url('updateBranch');?>">               
                    <input type="hidden" name="branch_id" id="branch_id">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label for="">Branch Warehouse</label>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select name="branch_warehouse_id" id="branch_warehouse_id" class="form-control">
                                        
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label for="">Branch Name</label>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" placeholder="Name" name="branch_name" id="branch_name" required="">
                                </div>
                            </div>
                            <br> 
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label for="">Branch Country</label>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select name="branch_country_id" id="branch_country_id" class="form-control">
                                        
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label for="">Branch Detail</label>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                   <textarea name="branch_detail" id="branch_detail" style="width: 399px; height: 245px;"></textarea>
                               
                                </div>
                            </div>                   
                        </div>      
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
           
        </div>
        </form>
      </div>
    </div>
  </div>
<script type="text/javascript">
    // $('#edit_group').modal()
    <?php if($this->session->userdata('update_error_id') != ""){ ?>
        edit_record("<?=$this->session->userdata('update_error_id');?>");
    <?php } ?>
    function edit_record(branch_id){

        var base_url = "<?=base_url('getBranchById');?>";
            $.ajax({
                type: "POST",
                data: {branch_id: branch_id},
                url: base_url,
                success: function(result) 
                {
                    result = JSON.parse(result);
                    countries = result.countries;          
                    warehouses = result.warehouses;          
                    result = result.data;

                    console.log(result);
                    $('#branch_id').val(result.branch_id);
                    $('#branch_name').val(result.branch_name);
                    // $('#branch_country').val(result.branch_country);
                    var options = '<option selected="" disabled="">Select Country</option>';
                    $.each(countries, function(id, value) {
                        if(value.isdel === '1'){
                            options += '<option value="'+value.country_id+'" disabled="" style="background-color: #bd1717;color: white;">'+value.country_name+' <span> (Record Deleted)</span></option>';
                        }else if(result.branch_country_id == value.country_id){
                            options += '<option value="'+value.country_id+'" selected>'+value.country_name+'</option>';
                        }else{
                            options += '<option value="'+value.country_id+'">'+value.country_name+'</option>';                      
                        }
                    });
                    $('#branch_country_id').html(options);

                    var w_options = '<option selected="" disabled="">Select Warehouse</option>';
                    $.each(warehouses, function(id, value) {
                        if(value.isdel === '1'){
                        w_options += '<option value="'+value.warehouse_id+'" disabled="" style="background-color: #bd1717;color: white;">'+value.warehouse_name+' <span> (Record Deleted)</span></option>';
                        }else if(result.branch_warehouse_id == value.warehouse_id){
                            w_options += '<option value="'+value.warehouse_id+'" selected>'+value.warehouse_name+'</option>';
                        }else{
                            w_options += '<option value="'+value.warehouse_id+'">'+value.warehouse_name+'</option>';                      
                        }
                    });
                    $('#branch_warehouse_id').html(w_options);
                    var branch_detail = $.trim(result.branch_detail);
                    // alert();
                    $('#branch_detail').html(branch_detail);
                    $('#edit_branch').modal();     
                }
        });      
    }
    function delete_record(record_id,table){
        Swal.fire({
            title: 'Are you sure to delete this record?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Confirm`,
            denyButtonText: `Cancel`,
        }).then((result) => {
            if (result.value === true) {
                var base_url = "<?=base_url('branches/deleteBranch');?>";
                $.ajax({
                    type: "POST",
                    data: {record_id: record_id,table:table},
                    url: base_url,
                    success: function(result) 
                    {
                        Swal.fire('Deleted!', '', 'success');
                        setTimeout(function(){
                            location.reload();
                        }, 1000);            
                    }
                });
            }else{
                Swal.fire('Changes are not saved', '', 'info')
            }

        })

    }
    function restore_record(record_id){
        Swal.fire({
            title: 'Are you sure to restore this record?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Confirm`,
            denyButtonText: `Cancel`,
        }).then((result) => {
            if (result.value === true) {
                var base_url = "<?=base_url('restoreBranch');?>";
                $.ajax({
                    type: "POST",
                    data: {record_id: record_id},
                    url: base_url,
                    success: function(result) 
                    {
                        Swal.fire('Restored!', '', 'success');
                        setTimeout(function(){
                            location.reload();
                        }, 1000);            
                    }
                });
            }else{
                Swal.fire('Changes are not saved', '', 'info')
            }

        })

    }
</script>

