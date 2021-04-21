<?php
$save_subbranch = $this->acl_model->has_permission('branches','saveSubBranch',$role_ids_array);
$edit_subbranch = $this->acl_model->has_permission('branches','updateSubBranch',$role_ids_array);
$delete_subbranch = $this->acl_model->has_permission('branches','deleteSubBranch',$role_ids_array);
$restore_subbranch = $this->acl_model->has_permission('branches','restoreSubBranch',$role_ids_array);
?>
<?php if($save_subbranch === TRUE){ ?>
<h3>Add SubBranches</h3>
<br />          
<br />  
<form method="POST" enctype="multipart/form-data" id="user_form" action="<?=base_url('saveSubBranch');?>">  
            <div class="row">
            <div class="col-md-12" >
                                
                <div class="col-md-8">
                    <div class="form-group">
                        <div class="col-md-3">
                            <label>Main Branch</label>
                        </div>
                        <div class="col-md-8">
                            <select name="branch_id" class="validate[required] form-control" required="">
                                <option value="">Select Branch</option>
                                <?php foreach ($branches as $branch) { 
                                    if($branch['isdel'] == 0){ ?>
                                    <option value="<?=$branch['branch_id'];?>"><?=$branch['branch_name'];?></option>
                                <?php }else{ ?>
                                    <option value="<?=$branch['branch_id'];?>" disabled="" style="background-color: #bd1717;color: white;"><?=$branch['branch_name'];?> <span> (Record Deleted)</span></option>
                                <?php }} ?>
                            </select>
                            <span class="fieldError"><?php echo form_error('branch_id'); ?></span>

                        </div>
                    </div> 
                    <br><br><br>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label>SubBranch Name <span class="required" aria-required="true">*</span></label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="branch_name" class="form-control" value="<?=set_value('branch_name');?>" required="">
                        </div>
                    </div>  

                    <br><br>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label>SubBranch Detail </label>
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
<h3>Sub Branches</h3>
<br />          
<table class="table table-bordered datatable" id="table-4">
    <thead>
        <tr>
            <th>No</th>
            <th>Main Branch</th>  
            <th>Sub Branch Name</th>  
            <th>Branch Country</th>  
            <th width="20%">Branch Detail</th>  
            <th>Created At</th>
<?php if($edit_subbranch === TRUE || $delete_subbranch === TRUE || $restore_subbranch === TRUE){ ?>
            <th>Action</th>
<?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php 
        $count = 1;
        foreach ($subbranches as $branch) {

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
            $main_branch_name = $this->Branches_model->get_branch($branch['parent_id'])->branch_name;
            if($main_branch_name == ""){
                $main_branch_name = '<spna class="not_available">Not available</span>';
            }
            ?>
            <tr class="odd gradeX">
                <td><?=$count;?></td>
                <td><?=$main_branch_name;?></td>
                <td><?=$branch['branch_name'];?></td>
                <td><?=$country_name;?></td>
                <td><?=$branch['branch_detail'];?></td>
                <td><?=$date;?></td> 
<?php if($edit_subbranch === TRUE || $delete_subbranch === TRUE || $restore_subbranch === TRUE){ ?>
                <td>
                    <?php if($branch['isdel'] == '0'){ ?>
                        <?php if($delete_subbranch === TRUE){ ?>
                        <button class="btn btn-danger" onclick="delete_record('<?=$branch["branch_id"]?>','cities')"><i class="fa fa-trash"></i> Delete</button>  
                    <?php } ?>  
                    <?php if($edit_subbranch === TRUE){ ?>
                        <button class="btn btn-info" onclick="edit_record('<?=$branch["branch_id"]?>')"><i class="fa fa-edit"></i> Edit</button>
                    <?php } ?>  
                    <?php }else{ ?>  
                    <?php if($restore_subbranch === TRUE){ ?>
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
          <h4 class="modal-title">Update SubBranch</h4>
        </div>
        
        <div class="modal-body">
                <form name="frm" method="post" action="<?=base_url('updateSubBranch');?>">               
                    <input type="hidden" name="branch_id" id="branch_id">
                        <div class="modal-body">
                            
                             <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label for="">Main Branch</label>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select name="parent_id" class="form-control" id="parent_id">
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label for="">SubBranch Name</label>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" placeholder="Name" name="branch_name" id="branch_name" required="">
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
    $('#user_form').validate();
  </script>
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
                    console.log(result);

                    countries = result.countries;          
                    warehouses = result.warehouses;          
                    branches = result.branches;
                    result = result.data;

                    $('#branch_id').val(result.branch_id);
                    $('#branch_name').val(result.branch_name);
                    $('#branch_country').val(result.branch_country);
                    var options = '<option selected="" disabled="">Select Main Branch</option>';
                    $.each(branches, function(id, value) {
                        if(value.isdel === '1'){
                            options += '<option value="'+value.branch_id+'" disabled="" style="background-color: #bd1717;color: white;">'+value.branch_name+' <span> (Record Deleted)</span></option>';
                        }else if(result.parent_id == value.branch_id){
                            options += '<option value="'+value.branch_id+'" selected>'+value.branch_name+'</option>';
                        }else{
                            options += '<option value="'+value.branch_id+'">'+value.branch_name+'</option>';                      
                        }
                    });
                    $('#parent_id').html(options);
                    var branch_detail = result.branch_detail;
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
                var base_url = "<?=base_url('deleteSubBranch');?>";
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
                var base_url = "<?=base_url('restoreSubBranch');?>";
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

