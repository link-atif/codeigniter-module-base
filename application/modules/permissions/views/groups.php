<script>
    function checkGroup(){
		var group = $('#group_name').val();
		if(group ==''){
			alert("Enter Group Name?");
			return false;
		}
    }
	
    function updateGroup(id,name,description,check_permission,redirect){
		$("#group_id").val(id);
		$("#edit_group_name").val(name);
		$("#edit_group_description").val(description);
		$("#p_redirect").val(redirect);
			if(check_permission == "on"){
				$("#check_permission").attr( 'checked', true )
			}else{
				$("#check_permission").attr( 'checked', false )
			}
		$('#edit_group').modal('show');
    }
	
</script>
<div class="m-portlet m-portlet--primary m-portlet--head-solid-bg" id="main_portlet">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    Groups
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
      
            <button type="submit" class="btn btn-secondary m-btn m-btn--icon m-btn--pill add-group" data-toggle="modal" data-target="#add_group" style="margin: 10px;"> 
                    <span>
                        <i class="fa fa-plus" aria-hidden="true"></i>

                        <span>  Add Group</span>
            </span></button>
        </div>

    </div>
    <div class="m-portlet__body">
        <div id="bdlist">
            <table class="table table-bordered"  id="group_list">
                <thead>
                    <tr role="row" class="heading">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Check Permissions</th>
                        <th >Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($groups as $g) { ?>
                        <tr>
                         
    
                            <td><?php echo $g['id'] ?></td>
                            <td><?php echo $g['name'] ?></td>
                            <td><?php echo $g['description'] ?></td>
                            <td><?php echo $g["check_permission"]; ?></td>
                            <td>
                                <a href="javascript:void(0)" onclick="updateGroup('<?php echo $g["id"] ?>', '<?php echo $g["name"] ?>', '<?php echo $g["description"] ?>', '<?php echo $g["check_permission"] ?>', '<?php echo $g["redirect"] ?>')" class="dropdown-item" id="btnView"> <i class="la la-edit"></i>
                                <button class="btn btn-info"><i class="fa fa-edit"></i> Edit</button>
                                </a>
                                 <a href="<?php echo base_url() ?>permissions/delete_group/<?php echo $g['id']; ?>" class="dropdown-item"  >
                                     <button class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button></a>
                                <?php if($g["check_permission"] == "on"){ ?>
                                    <a href="<?php echo base_url();?>permissions/group_base_permissions?group_id=<?php echo $g['id']; ?>" class="dropdown-item">
                                        <button class="btn btn-success"><i class="fa fa-lock"></i> Manage permissions</button>
                                    </a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade in" id="add_group">
    <div class="modal-dialog">
      <div class="modal-content">
        
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Add Group</h4>
        </div>
        
        <div class="modal-body">
                <form name="frm" method="post" action="<?php echo base_url() ?>permissions/add_groups">              
                    <input type="hidden" name="user_id" id="user_id">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label>Name</label>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" placeholder="Name" name="name" id="group_name" value="" />
                                </div>
                            </div>
                            </br>
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label>Description</label>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea class="form-control" name="description"></textarea>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label>Redirect</label>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" placeholder="Redirect" name="redirect" id="redirect" value="" />
                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label>Check Permission</label>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <span class="m-switch m-switch--icon">
                                        <label>
                                            <input type="checkbox" name="check_permission" >
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                            </div>
                                              
                        </div>      
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" onClick="return checkGroup();">Add</button>
           
        </div>
        </form>
      </div>
    </div>
  </div>
<div class="modal fade" id="edit_group">
    <div class="modal-dialog">
      <div class="modal-content">
        
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Update Group</h4>
        </div>
        
        <div class="modal-body">
                <form name="frm" method="post" action="<?php echo base_url() ?>permissions/update_group">
                    <input type="hidden" name="group_id" id="group_id" />                 
                    <input type="hidden" name="user_id" id="user_id" />
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label for="">Name</label>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" placeholder="Name" name="name" id="edit_group_name" />
                                </div>
                            </div>
                            </br>
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label>Description</label>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea class="form-control" name="description" id="edit_group_description"></textarea>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label>Redirect</label>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" placeholder="Redirect" name="redirect" id="p_redirect" value="" />
                                </div>
                                <br>
                                 <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label>Check Permission</label>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <span class="m-switch m-switch--icon" style="margin: 10px;">
                                        <label>
                                            <input type="checkbox" id="check_permission" name="check_permission">
                                            <span></span>
                                        </label>
                                    </span>
                     <!--                    <div class="make-switch has-switch" data-on-label="<i class='entypo-check'></i>" data-off-label="<i class='entypo-cancel'></i>">
                            <div class="switch-on"><input type="checkbox" name="category_status" checked=""><span class="switch-left"><i class="entypo-check"></i></span><label>&nbsp;</label><span class="switch-right"><i class="entypo-cancel"></i></span></div>
                        </div> -->
                                </div>
                            </div>
                     
                        </div>      
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
           </form>
        </div>
      </div>
    </div>
  </div>

<div class="md-overlay"></div>
