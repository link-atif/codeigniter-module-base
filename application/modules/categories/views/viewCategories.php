<h3>Add Categories</h3>
<br />          
<br />  
<form method="POST" enctype="multipart/form-data">  

    <div class="row">
        <div class="col-md-12" >
            <div class="col-md-6"> 
                <div class="form-group">
                    <div class="col-md-2">
                        <label>Category Name</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="cat_name" class="form-control" value="<?=set_value('cat_name');?>" required="">
                    </div>
                    <div class="col-md-2" style="text-align: center;">
                        <button type="submit" class="btn btn-info" >Save</button>                   
                    </div>                      
                </div>  
            </div>
        </div>
    </div>
</form>
<?php
$edit_cat = $this->acl_model->has_permission('categories','updateCategory',$role_ids_array);
$delete_cat = $this->acl_model->has_permission('categories','deleteCategory',$role_ids_array);
$restore_cat = $this->acl_model->has_permission('categories','restoreCategory',$role_ids_array);
?>    
<h3>View Categories</h3>
<br />          
<table class="table table-bordered datatable" id="table-4">
    <thead>
        <tr>
            <th>No</th>
            <th>Category Name</th>  
            <th>Created At</th>
<?php if($edit_cat === TRUE || $delete_cat === TRUE || $restore_cat === TRUE){ ?>  

            <th>Action</th>
<?php }?>

        </tr>
    </thead>
    <tbody>
        <?php 
        $count = 1;
        foreach ($categories as $cat) {
            if($cat['added_on'] !='0000-00-00 00:00:00'){
                $date_object = new DateTime($cat['added_on']);
                $date = $date_object->format('d/m/Y h:i A');
            }else{
                $date = '';
            }
            ?>
            <tr class="odd gradeX">
                <td><?=$count;?></td>
                <td><?=$cat['cat_name'];?></td>
                <td><?=$date;?></td> 
<?php if($edit_cat === TRUE || $delete_cat === TRUE || $restore_cat === TRUE){ ?>  
                <td>
                    <?php if($cat['isdel'] == '0'){ ?>
                    <?php if($delete_cat === TRUE){ ?>  
                        <button class="btn btn-danger" onclick="delete_record('<?=$cat["cat_id"]?>','categories')"><i class="fa fa-trash"></i> Delete</button>
                    <?php }?>
                    <?php if($edit_cat === TRUE){ ?>  
                        <button class="btn btn-info" onclick="edit_record('<?=$cat["cat_id"]?>')"><i class="fa fa-edit"></i> Edit</button>
                    <?php }?>
                    <?php }else{?>
                    <?php if($restore_cat === TRUE){ ?>  
                        <button class="btn btn-primary" onclick="restore_record('<?=$cat["cat_id"]?>')"><i class="fa fa-trash"></i> Restore</button>          
                    <?php }?>
                    <?php }?>
                </td>
<?php }?>       
            </tr>
            <?php
            $count++;
        } ?>           
    </tbody>
</table>
<div class="modal fade in" id="edit_category">
    <div class="modal-dialog">
      <div class="modal-content">
        
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Update Group</h4>
        </div>
        
        <div class="modal-body">
                <form name="frm" method="post" action="<?=base_url('updateCategory');?>">               
                    <input type="hidden" name="cat_id" id="cat_id">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label for="">Cargory Name</label>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" placeholder="Name" name="cat_name" id="cat_name" required="">
                                </div>
                            </div>
                            <br>                    
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
    function edit_record(cat_id){

        var base_url = "<?=base_url('getCategoryById');?>";
            $.ajax({
                type: "POST",
                data: {cat_id: cat_id},
                url: base_url,
                success: function(result) 
                {
                    result = JSON.parse(result);
                    console.log(result);
                    $('#cat_id').val(result.cat_id);
                    $('#cat_name').val(result.cat_name);
                    $('#edit_category').modal();     
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
                var base_url = "<?=base_url('categories/deleteCategory');?>";
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
                var base_url = "<?=base_url('restoreCategory');?>";
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

