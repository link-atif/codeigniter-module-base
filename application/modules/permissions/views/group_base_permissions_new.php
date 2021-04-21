<script type="text/javascript">
    function selectRole(id) {
        document.frm_group.group_id.value = id;
        document.frm_group.submit();
    }
    function checkGroup() {
        var group = $('#group_id').val();
        if (group == '') {
            alert("Please Select Group!");
            return false;
        }
    }
	
	function check_function() {
        var val1 = $('#function_name1').val();
        if (val1 == '') {
            alert("Please Enter Function Name!");
            return false;
        }
    }
	
	function check_child_function() {
        var val2 = $('#function_name2').val();
        if (val2 == '') {
            alert("Please Enter Function Name!");
            return false;
        }
    }
	
    function setName(module_name, controller, id) {
        name = module_name;
        controller = controller;
        $(".module_value").val(name);
        $(".controller_value").val(controller);
        if (id) {
            $("#parent_id").val(id);
        }
    }
    $(document).ready(function() {
        $("input[type=checkbox]").on("change", function() {
            var checked = "";
            if ($(this).prop("checked") == true) {
                checked = "checked";
            }
            var checkboxes = $(this).parent().parent().find("li");
            checkboxes.each(function() {
                $(this).find("input[type=checkbox]").prop("checked", checked);
            });
        });
    });
    $(document).ready(function(){
        var updateOutput = function(e){
            var list = e.length ? e : $(e.target),
                    output = list.data('output');
			if (window.JSON) {
                output.val(window.JSON.stringify(list.nestable('serialize')));
            } else {
                output.val('JSON browser support required for this demo.');
            }
        };
        // activate Nestable for list 1
        // $('#nestable').nestable({  group: 1 }).on('change', updateOutput);
        // output initial serialised data
        // updateOutput($('#nestable').data('output', $('#nestable-output')));
    });
	
	$(document).ready(function(){
    	$('[data-toggle="tooltip"]').tooltip();   
	});
	
	$(document).ready(function() {
		$('#checkAll').click(function () {    
     		$('input:checkbox').prop('checked', this.checked);    
 		});
    });
	
	function expandCollapse() {
		if($(".submenu").css('display') == 'none') {
			$("#expand-collapse").html("Collapse All");
			$(".submenu").show("fast");
		} else {
			$("#expand-collapse").html("Expand All");
			$(".submenu").hide("fast");
		}
	}
</script>

<style>
    .cpc_permissionsgroup_base_permissions_new .dd-list{

        width:100% !important;
    }
     .cpc_permissionsgroup_base_permissions_new .dd-handle{

        height:auto!important;
    }
</style>

<div class="m-portlet m-portlet--primary m-portlet--head-solid-bg" id="main_portlet">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    Permissions
                </h3>
            </div>
        </div>    
    </div>
	
										
										
    <div class="m-portlet__body">
						
 	<form name="frm_group" id="frm_group">
        <input type="hidden" name="group_id" />
    </form>
    <form name="role_base_permission" method="post" action="<?php echo base_url() ?>permissions/set_group_permissions">
        <div class="row">
            <div class="col-md-1">
                <label for="">Groups :</label>
            </div>
            <div class="col-md-4">
                <select id="group_id" class="form-control" name="groups" onchange="selectRole(this.value)">
                    <option value="">Select Group</option>
                    <?php foreach ($groups as $g) { ?>
                        <option <?php if ($this->input->get('group_id') == $g['id']) { ?> selected="selected" <?php } ?>  value="<?php echo $g['id']; ?>"><?php echo $g['name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-info m-btn m-btn--icon m-btn--pill"  onclick="return checkGroup();">Update</button>
            </div>
        </div>
        <div class="row">
        	<div class="col-md-4">
				<span>
				<label for="checkAll" class="btn btn-info m-btn m-btn--icon m-btn--pill"> <input type="checkbox" value="" id="checkAll"/> Select All</label>
                </span>
                <span>
				<a onclick="expandCollapse()" class="btn btn-info m-btn m-btn--icon m-btn--pill" id="expand-collapse" >Collapse All</a>
				</span>
            </div>
        </div>
  
             <div class="row mt-4" id="nestable">  
                <?php foreach ($permissions as $p) { ?>               
                <div class="col-md-6"> 
                	<ol class="dd-list">
                    	<li class="dd-item" data-id="2">
                        	<div class="dd-handle">
							
							<label class="kt-checkbox kt-checkbox--bold kt-checkbox--success">
							<input type="checkbox" value="" /> &nbsp; <?php echo $p['module_name']; ?> 
							<span></span></label>
							</div>
                        	<?php $controllers = $this->acl_model->get_all_controllers($p['module_name']);
                        	foreach ($controllers as $c) {
                            ?>
                            	<ol class="dd-list submenu">
                                	<li class="dd-item" data-id="3">
                                    	<div class="dd-handle">
										<label class="kt-checkbox kt-checkbox--bold kt-checkbox--success">
										<input type="checkbox" value=""/> &nbsp; <?php echo $c['controllers']; ?> <span></span></label> <button type="button" onclick="setName('<?php echo $p['module_name']; ?>', '<?php echo $c['controllers']; ?>');" class="pull-right btn btn-info m-btn--pill" style="font-size:12px; padding:1px 5px; margin: 0px 0px 0px 5px;" data-toggle="modal" data-target="#functions" >Add Function</button> </div>
										<hr class="hrsize" >
                                    	<?php $functions = $this->acl_model->get_all_functions($c['controllers'],$p['module_name']);
                                    	foreach ($functions as $f) {
                                        ?> 
										
							
                                        	<ol class="dd-list">
                                            	<li class="dd-item" data-id="6">
                                                	<div class="dd-handle">
													
													<span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
													<label>

													<input type="checkbox" name="permissions[]"  value="<?php echo $f['id']; ?>" <?php if (in_array($f['id'], $group_permissions)) { ?> checked <?php } ?>/> &nbsp; <?php echo $f['name']; ?> 	
													<span></span></label></span> &nbsp;<a href="#" data-toggle="tooltip" style="color: #000;" title="<?php echo $f['description']; ?>">?</a><button type="button" onclick="setName('<?php echo $p['module_name']; ?>', '<?php echo $c['controllers']; ?>', '<?php echo $f['id'] ?>')" class="pull-right btn btn-info m-btn--pill" style="font-size:12px; padding:1px 5px; margin: 0px 0px 0px 5px;" data-toggle="modal" data-target="#child_functions">Add Child Function</button></div>
                                                	<?php
                                                	$sub_childs = $this->acl_model->get_all_subchilds($f['id']);
                                                	foreach ((array) $sub_childs as $childs) {
                                                    //$child = implode(", ", $childs['id']);
                                                    	if ($childs['id'] != '') {
                                                    ?>
                                                    	<ol class="dd-list">
                                                        	<li class="dd-item" data-id="6">
                                                            	<div class="dd-handle">
																<input type="checkbox" name="permissions[]" value="<?php echo $childs['id']; ?>" <?php if (in_array($childs['id'], $group_permissions)) { ?> checked <?php } ?>/> &nbsp; <?php echo $childs['name']; ?> &nbsp;<a href="#" data-toggle="tooltip" style="color: #000;" title="<?php echo $childs['description']; ?>">?</a></div>
                                                            </li>
                                                        </ol>
                									<?php } 
                                        			} ?>
                                            	</li>
                                        	</ol>
                            			<?php } ?>
                                	</li>
                            	</ol>
                			<?php } ?>
                    	</li>
                	</ol> 
                </div> 
               	<?php } ?> 
            </div>
    	</form>
    </div>
</div>
<div id="functions" class="modal " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog"> 
        <div class="">
            <div class="panel panel-color panel-info">
                <div class="building_heading_button btn blue">
                	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>      
                    <h4 class="panel-title">Add Function</h4> 
                </div>
                <div class="modal-content"> 
  					<form method="post" name="frm" action="<?php echo base_url() ?>permissions/add_permission_function" >
                        <input type="hidden" name="module" class="module_value" />
                        <input type="hidden" name="controller" class="controller_value" />              
                        <input type="hidden" name="user_id" id="user_id" />
                    	<div class="modal-body">
                        	<div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label for="">Name</label>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" placeholder="Name" name="function" id="function_name1" />
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label for="">Function Name</label>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" placeholder="Function Name" name="name" />
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label for="">Description</label>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea class="form-control" name="description"></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label>Availability</label>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <ul style="list-style-type:none; text-align:center; margin-top:10px;">
                                        <li>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="inlineRadio5" data-pattern="" value="public" name="permission_status" checked>
                                                <label for="inlineRadio5"> Public </label>
                                                <input type="radio" id="inlineRadio6" data-pattern="" value="permission_needed" name="permission_status">
                                                <label for="inlineRadio6"> Permission Needed </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                      	<div class="modal-footer no-border"> <span id="loading_img" style="display:none"><img src="<?php echo base_url() ?>assets/images/loader-new.gif" /></span>
                            <button type="submit"  class="btn btn-info m-btn--pill waves-effect waves-light" onclick="return check_function();">Add</button>
                        </div>
         			</form>
                </div> 
            </div>
        </div>
    </div>
</div>
<div id="child_functions" class="modal " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog"> 
        <div class="">
            <div class="panel panel-color panel-info">
                <div class="building_heading_button btn blue">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button> 
                    <h4 class="panel-title">Add Child Function</h4> 
                </div>
                <div class="modal-content"> 
  					<form method="post" name="frm" action="<?php echo base_url() ?>permissions/add_permission_function" >
                        <input type="hidden" name="module" class="module_value" />
                        <input type="hidden" name="controller" class="controller_value" />
                        <input type="hidden" name="parent_id" id="parent_id" />
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label for="">Name</label>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" placeholder="Name" name="function" id="function_name2"/>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label for="">Function Name</label>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" placeholder="Function Name" name="name" />
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label for="">Description</label>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea class="form-control" name="description"></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label>Availability</label>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <ul style="list-style-type:none; text-align:center; margin-top:10px;">
                                        <li>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="inlineRadio5" data-pattern="" value="public" name="permission_status" checked>
                                                <label for="inlineRadio5"> Public </label>
                                                <input type="radio" id="inlineRadio6" data-pattern="" value="permission_needed" name="permission_status">
                                                <label for="inlineRadio6"> Permission Needed </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer no-border"> <span id="loading_img" style="display:none"><img src="<?php echo base_url() ?>assets/images/loader-new.gif" /></span>
                            <button type="submit"  class="btn btn-info m-btn--pill waves-effect waves-light" onclick="return check_child_function();">Add</button>
                        </div>
                    </form>
                </div> 
            </div>
        </div>
    </div>
</div>
<style>

.kt-checkbox{
    display:inline-block;
    position:relative;
    padding-left:30px;
    margin-bottom:10px;
    text-align:left;
    cursor:pointer;
    font-size:1rem;
    -webkit-transition:all 0.3s ease;
    transition:all 0.3s ease
	font-weight: bold;
}
.kt-checkbox.kt-checkbox--disabled{
    opacity:0.8;
    cursor:not-allowed
}
.kt-checkbox>input{
    position:absolute;
    z-index:-1;
    opacity:0
}
.kt-checkbox>span{
    border-radius:3px;
    background:none;
    position:absolute;
    top:1px;
    left:0;
    height:18px;
    width:18px
}
.kt-checkbox>span:after{
    content:'';
    position:absolute;
    display:none;
    top:50%;
    left:50%;
    margin-left:-2px;
    margin-top:-6px;
    width:5px;
    height:10px;
    border-width:0 2px 2px 0
    /*rtl:ignore*/
     !important;
    -webkit-transform:rotate(45deg);
    transform:rotate(45deg)
    /*rtl:ignore*/
}
.kt-checkbox>input:checked ~ span{
    -webkit-transition:all 0.3s ease;
    transition:all 0.3s ease;
    background:none
}
.kt-checkbox>input:checked ~ span:after{
    display:block
}
.kt-checkbox:hover>input:not([disabled]):checked ~ span,.kt-checkbox>input:checked ~ span{
    -webkit-transition:all 0.3s ease;
    transition:all 0.3s ease
}
.kt-checkbox>input:disabled ~ span{
    opacity:0.6;
    pointer-events:none
}
.kt-checkbox.kt-checkbox--solid>span{
    border:1px solid transparent
}
.kt-checkbox.kt-checkbox--solid:hover>input:not([disabled]) ~ span,.kt-checkbox.kt-checkbox--solid>input:focus ~ span{
    -webkit-transition:all 0.3s ease;
    transition:all 0.3s ease
}
.kt-checkbox.kt-checkbox--square>span{
    border-radius:0
}
.kt-checkbox.kt-checkbox--bold>span{
    border-width:2px !important;
    -webkit-transition:all 0.3s ease;
    transition:all 0.3s ease
}
.form-inline .kt-checkbox{
    margin-left:15px;
    margin-right:15px
}
.kt-checkbox.kt-checkbox--single{
    width:18px;
    height:18px
}
.kt-checkbox.kt-checkbox--single>span{
    top:0px
}
th>.kt-checkbox.kt-checkbox--single,td>.kt-checkbox.kt-checkbox--single{
    right:-5px
}
.input-group .kt-checkbox{
    margin-bottom:0 !important;
    padding-left:0
}
.kt-checkbox-list{
    padding:0 0
}
.form-horizontal .form-group .kt-checkbox-list{
    padding-top:0
}
.kt-checkbox-list .kt-checkbox{
    text-align:left;
    display:block
}
.kt-checkbox-list .kt-checkbox:last-child{
    margin-bottom:5px
}
.kt-checkbox-inline{
    padding:0 0
}
.kt-checkbox-inline .kt-checkbox{
    display:inline-block;
    margin-right:15px;
    margin-bottom:5px
}
.kt-checkbox-inline .kt-checkbox:last-child{
    margin-right:0
}
.form-group.row .kt-checkbox-inline{
    margin-top:0.75rem
}
.form-group.row .kt-checkbox-list{
    margin-top:2px
}
.kt-checkbox.kt-checkbox--disabled{
    opacity:0.7
}
.kt-checkbox>span{
    border:1px solid #d1d7e2
}
.kt-checkbox>span:after{
    border:solid #bfc7d7
}
.kt-checkbox>input:disabled ~ span:after{
    border-color:#c8cfdd
}
.kt-checkbox>input:checked ~ span{
    border:1px solid #c8cfdd
}
.kt-checkbox.kt-checkbox--bold>input:checked ~ span{
    border:2px solid #c8cfdd
}
.kt-checkbox>input:disabled ~ span{
    opacity:0.6
}
.kt-checkbox.kt-checkbox--solid>span{
    background:#e4e8ee;
    border:1px solid transparent !important
}
.kt-checkbox.kt-checkbox--solid>span:after{
    border:solid #99a6bf
}
.kt-checkbox.kt-checkbox--solid>input:focus ~ span{
    border:1px solid transparent !important
}
.kt-checkbox.kt-checkbox--solid>input:checked ~ span{
    background:#dee2ea
}
.kt-checkbox.kt-checkbox--brand.kt-checkbox--disabled{
    opacity:0.7
}
.kt-checkbox.kt-checkbox--brand>span{
    border:1px solid #5d78ff
}
.kt-checkbox.kt-checkbox--brand>span:after{
    border:solid #5d78ff
}
.kt-checkbox.kt-checkbox--brand>input:disabled ~ span:after{
    border-color:#5d78ff
}
.kt-checkbox.kt-checkbox--brand>input:checked ~ span{
    border:1px solid #5d78ff
}
.kt-checkbox.kt-checkbox--brand.kt-checkbox--bold>input:checked ~ span{
    border:2px solid #5d78ff
}
.kt-checkbox.kt-checkbox--brand>input:disabled ~ span{
    opacity:0.6
}
.kt-checkbox.kt-checkbox--brand.kt-checkbox--solid>span{
    background:#5d78ff;
    border:1px solid transparent !important
}
.kt-checkbox.kt-checkbox--brand.kt-checkbox--solid>span:after{
    border:solid #fff
}
.kt-checkbox.kt-checkbox--brand.kt-checkbox--solid>input:focus ~ span{
    border:1px solid transparent !important
}
.kt-checkbox.kt-checkbox--brand.kt-checkbox--solid>input:checked ~ span{
    background:#5d78ff
}
.kt-checkbox.kt-checkbox--light.kt-checkbox--disabled{
    opacity:0.7
}
.kt-checkbox.kt-checkbox--light>span{
    border:1px solid #fff
}
.kt-checkbox.kt-checkbox--light>span:after{
    border:solid #fff
}
.kt-checkbox.kt-checkbox--light>input:disabled ~ span:after{
    border-color:#fff
}
.kt-checkbox.kt-checkbox--light>input:checked ~ span{
    border:1px solid #fff
}
.kt-checkbox.kt-checkbox--light.kt-checkbox--bold>input:checked ~ span{
    border:2px solid #fff
}
.kt-checkbox.kt-checkbox--light>input:disabled ~ span{
    opacity:0.6
}
.kt-checkbox.kt-checkbox--light.kt-checkbox--solid>span{
    background:#fff;
    border:1px solid transparent !important
}
.kt-checkbox.kt-checkbox--light.kt-checkbox--solid>span:after{
    border:solid #282a3c
}
.kt-checkbox.kt-checkbox--light.kt-checkbox--solid>input:focus ~ span{
    border:1px solid transparent !important
}
.kt-checkbox.kt-checkbox--light.kt-checkbox--solid>input:checked ~ span{
    background:#fff
}
.kt-checkbox.kt-checkbox--dark.kt-checkbox--disabled{
    opacity:0.7
}
.kt-checkbox.kt-checkbox--dark>span{
    border:1px solid #282a3c
}
.kt-checkbox.kt-checkbox--dark>span:after{
    border:solid #282a3c
}
.kt-checkbox.kt-checkbox--dark>input:disabled ~ span:after{
    border-color:#282a3c
}
.kt-checkbox.kt-checkbox--dark>input:checked ~ span{
    border:1px solid #282a3c
}
.kt-checkbox.kt-checkbox--dark.kt-checkbox--bold>input:checked ~ span{
    border:2px solid #282a3c
}
.kt-checkbox.kt-checkbox--dark>input:disabled ~ span{
    opacity:0.6
}
.kt-checkbox.kt-checkbox--dark.kt-checkbox--solid>span{
    background:#282a3c;
    border:1px solid transparent !important
}
.kt-checkbox.kt-checkbox--dark.kt-checkbox--solid>span:after{
    border:solid #fff
}
.kt-checkbox.kt-checkbox--dark.kt-checkbox--solid>input:focus ~ span{
    border:1px solid transparent !important
}
.kt-checkbox.kt-checkbox--dark.kt-checkbox--solid>input:checked ~ span{
    background:#282a3c
}
.kt-checkbox.kt-checkbox--primary.kt-checkbox--disabled{
    opacity:0.7
}
.kt-checkbox.kt-checkbox--primary>span{
    border:1px solid #5867dd
}
.kt-checkbox.kt-checkbox--primary>span:after{
    border:solid #5867dd
}
.kt-checkbox.kt-checkbox--primary>input:disabled ~ span:after{
    border-color:#5867dd
}
.kt-checkbox.kt-checkbox--primary>input:checked ~ span{
    border:1px solid #5867dd
}
.kt-checkbox.kt-checkbox--primary.kt-checkbox--bold>input:checked ~ span{
    border:2px solid #5867dd
}
.kt-checkbox.kt-checkbox--primary>input:disabled ~ span{
    opacity:0.6
}
.kt-checkbox.kt-checkbox--primary.kt-checkbox--solid>span{
    background:#5867dd;
    border:1px solid transparent !important
}
.kt-checkbox.kt-checkbox--primary.kt-checkbox--solid>span:after{
    border:solid #fff
}
.kt-checkbox.kt-checkbox--primary.kt-checkbox--solid>input:focus ~ span{
    border:1px solid transparent !important
}
.kt-checkbox.kt-checkbox--primary.kt-checkbox--solid>input:checked ~ span{
    background:#5867dd
}
.kt-checkbox.kt-checkbox--success.kt-checkbox--disabled{
    opacity:0.7
}
.kt-checkbox.kt-checkbox--success>span{
    border:1px solid #0abb87
}
.kt-checkbox.kt-checkbox--success>span:after{
    border:solid #0abb87
}
.kt-checkbox.kt-checkbox--success>input:disabled ~ span:after{
    border-color:#0abb87
}
.kt-checkbox.kt-checkbox--success>input:checked ~ span{
    border:1px solid #0abb87
}
.kt-checkbox.kt-checkbox--success.kt-checkbox--bold>input:checked ~ span{
    border:2px solid #0abb87
}
.kt-checkbox.kt-checkbox--success>input:disabled ~ span{
    opacity:0.6
}
.kt-checkbox.kt-checkbox--success.kt-checkbox--solid>span{
    background:#0abb87;
    border:1px solid transparent !important
}
.kt-checkbox.kt-checkbox--success.kt-checkbox--solid>span:after{
    border:solid #fff
}
.kt-checkbox.kt-checkbox--success.kt-checkbox--solid>input:focus ~ span{
    border:1px solid transparent !important
}
.kt-checkbox.kt-checkbox--success.kt-checkbox--solid>input:checked ~ span{
    background:#0abb87
}
.kt-checkbox.kt-checkbox--info.kt-checkbox--disabled{
    opacity:0.7
}
.kt-checkbox.kt-checkbox--info>span{
    border:1px solid #5578eb
}
.kt-checkbox.kt-checkbox--info>span:after{
    border:solid #5578eb
}
.kt-checkbox.kt-checkbox--info>input:disabled ~ span:after{
    border-color:#5578eb
}
.kt-checkbox.kt-checkbox--info>input:checked ~ span{
    border:1px solid #5578eb
}
.kt-checkbox.kt-checkbox--info.kt-checkbox--bold>input:checked ~ span{
    border:2px solid #5578eb
}
.kt-checkbox.kt-checkbox--info>input:disabled ~ span{
    opacity:0.6
}
.kt-checkbox.kt-checkbox--info.kt-checkbox--solid>span{
    background:#5578eb;
    border:1px solid transparent !important
}
.kt-checkbox.kt-checkbox--info.kt-checkbox--solid>span:after{
    border:solid #fff
}
.kt-checkbox.kt-checkbox--info.kt-checkbox--solid>input:focus ~ span{
    border:1px solid transparent !important
}
.kt-checkbox.kt-checkbox--info.kt-checkbox--solid>input:checked ~ span{
    background:#5578eb
}
.kt-checkbox.kt-checkbox--warning.kt-checkbox--disabled{
    opacity:0.7
}
.kt-checkbox.kt-checkbox--warning>span{
    border:1px solid #ffb822
}
.kt-checkbox.kt-checkbox--warning>span:after{
    border:solid #ffb822
}
.kt-checkbox.kt-checkbox--warning>input:disabled ~ span:after{
    border-color:#ffb822
}
.kt-checkbox.kt-checkbox--warning>input:checked ~ span{
    border:1px solid #ffb822
}
.kt-checkbox.kt-checkbox--warning.kt-checkbox--bold>input:checked ~ span{
    border:2px solid #ffb822
}
.kt-checkbox.kt-checkbox--warning>input:disabled ~ span{
    opacity:0.6
}
.kt-checkbox.kt-checkbox--warning.kt-checkbox--solid>span{
    background:#ffb822;
    border:1px solid transparent !important
}
.kt-checkbox.kt-checkbox--warning.kt-checkbox--solid>span:after{
    border:solid #111
}
.kt-checkbox.kt-checkbox--warning.kt-checkbox--solid>input:focus ~ span{
    border:1px solid transparent !important
}
.kt-checkbox.kt-checkbox--warning.kt-checkbox--solid>input:checked ~ span{
    background:#ffb822
}
.kt-checkbox.kt-checkbox--danger.kt-checkbox--disabled{
    opacity:0.7
}
.kt-checkbox.kt-checkbox--danger>span{
    border:1px solid #fd397a
}
.kt-checkbox.kt-checkbox--danger>span:after{
    border:solid #fd397a
}
.kt-checkbox.kt-checkbox--danger>input:disabled ~ span:after{
    border-color:#fd397a
}
.kt-checkbox.kt-checkbox--danger>input:checked ~ span{
    border:1px solid #fd397a
}
.kt-checkbox.kt-checkbox--danger.kt-checkbox--bold>input:checked ~ span{
    border:2px solid #fd397a
}
.kt-checkbox.kt-checkbox--danger>input:disabled ~ span{
    opacity:0.6
}
.kt-checkbox.kt-checkbox--danger.kt-checkbox--solid>span{
    background:#fd397a;
    border:1px solid transparent !important
}
.kt-checkbox.kt-checkbox--danger.kt-checkbox--solid>span:after{
    border:solid #fff
}
.kt-checkbox.kt-checkbox--danger.kt-checkbox--solid>input:focus ~ span{
    border:1px solid transparent !important
}
.kt-checkbox.kt-checkbox--danger.kt-checkbox--solid>input:checked ~ span{
    background:#fd397a
}

#expand-collapse {
	color: #fff;
}
#checkAll {
	margin: 0px 0 0 0;
}

.hrsize {
	border: 1px solid;
}

.kt-switch{
    display:inline-block;
    font-size:1rem
}
.kt-switch input:empty{
    margin-left:-999px;
    height:0;
    width:0;
    overflow:hidden;
    position:absolute;
    opacity:0
}
.kt-switch input:empty ~ span{
    display:inline-block;
    position:relative;
    float:left;
    width:1px;
    text-indent:0;
    cursor:pointer;
    -webkit-user-select:none;
    -moz-user-select:none;
    -ms-user-select:none;
    user-select:none
}
.kt-switch input:empty ~ span:before,.kt-switch input:empty ~ span:after{
    position:absolute;
    display:block;
    top:0;
    bottom:0;
    left:0;
    content:' ';
    -webkit-transition:all 100ms ease-in;
    transition:all 100ms ease-in
}
.kt-switch.kt-switch--icon input:empty ~ span:after{
    font-family:"LineAwesome";
    text-decoration:inherit;
    text-rendering:optimizeLegibility;
    text-transform:none;
    -moz-osx-font-smoothing:grayscale;
    -webkit-font-smoothing:antialiased;
    font-smoothing:antialiased;
    content:""
}
.kt-switch.kt-switch--icon input:checked ~ span:after{
    content:'\f17b'
}
.kt-switch.kt-switch--icon-check input:checked ~ span:after{
    font-family:"LineAwesome";
    text-decoration:inherit;
    text-rendering:optimizeLegibility;
    text-transform:none;
    -moz-osx-font-smoothing:grayscale;
    -webkit-font-smoothing:antialiased;
    font-smoothing:antialiased;
    content:""
}
.kt-switch input:empty ~ span{
    line-height:30px;
    margin: -6px 0px 0px 0px;
    height:30px;
    width:57px;
    border-radius:15px
}
.kt-switch input:empty ~ span:before,.kt-switch input:empty ~ span:after{
    width:54px;
    border-radius:15px
}
.kt-switch input:empty ~ span:after{
    height:24px;
    width:24px;
    line-height:26px;
    top:3px;
    bottom:3px;
    margin-left:3px;
    font-size:.9em;
    text-align:center;
    vertical-align:middle
}
.kt-switch input:checked ~ span:after{
    margin-left:26px
}
.kt-switch.kt-switch--lg input:empty ~ span{
    line-height:40px;
    margin:2px 0;
    height:40px;
    width:75px;
    border-radius:20px
}
.kt-switch.kt-switch--lg input:empty ~ span:before,.kt-switch.kt-switch--lg input:empty ~ span:after{
    width:72px;
    border-radius:20px
}
.kt-switch.kt-switch--lg input:empty ~ span:after{
    height:34px;
    width:34px;
    line-height:34px;
    top:3px;
    bottom:3px;
    margin-left:3px;
    font-size:1em;
    text-align:center;
    vertical-align:middle
}
.kt-switch.kt-switch--lg input:checked ~ span:after{
    margin-left:34px
}
.kt-switch.kt-switch--sm input:empty ~ span{
    line-height:24px;
    margin:2px 0;
    height:24px;
    width:40px;
    border-radius:12px
}
.kt-switch.kt-switch--sm input:empty ~ span:before,.kt-switch.kt-switch--sm input:empty ~ span:after{
    width:38px;
    border-radius:12px
}
.kt-switch.kt-switch--sm input:empty ~ span:after{
    height:20px;
    width:20px;
    line-height:20px;
    top:2px;
    bottom:2px;
    margin-left:2px;
    font-size:.8em;
    text-align:center;
    vertical-align:middle
}
.kt-switch.kt-switch--sm input:checked ~ span:after{
    margin-left:16px
}
.form-group.row .kt-switch{
    margin-top:0.15rem
}
.form-group.row .kt-switch.kt-switch--lg{
    margin-top:0rem;
    position:relative;
    top:-0.3rem
}
.form-group.row .kt-switch.kt-switch--sm{
    margin-top:0.3rem
}
.kt-switch input:empty ~ span:before{
    background-color:#e8ebf1
}
.kt-switch input:empty ~ span:after{
    color:#f8f9fb;
    background-color:#ffffff
}
.kt-switch input:checked ~ span:before{
    background-color:#e8ebf1
}
.kt-switch input:checked ~ span:after{
    background-color:#5d78ff;
    color:#fff
}
.kt-switch input[disabled]{
    cursor:not-allowed
}
.kt-switch input[disabled] ~ span:after,.kt-switch input[disabled] ~ span:before{
    cursor:not-allowed;
    opacity:0.7
}
.kt-switch.kt-switch--brand:not(.kt-switch--outline) input:empty ~ span:before{
    background-color:#5d78ff
}
.kt-switch.kt-switch--brand:not(.kt-switch--outline) input:empty ~ span:after{
    color:#5d78ff;
    background-color:#fff;
    opacity:0.4
}
.kt-switch.kt-switch--brand:not(.kt-switch--outline) input:checked ~ span:before{
    background-color:#5d78ff
}
.kt-switch.kt-switch--brand:not(.kt-switch--outline) input:checked ~ span:after{
    opacity:1
}
.kt-switch.kt-switch--outline.kt-switch--brand input:empty ~ span:before{
    border:2px solid #dee3eb;
    background-color:#e8ebf1
}
.kt-switch.kt-switch--outline.kt-switch--brand input:empty ~ span:after{
    color:#fff
}
.kt-switch.kt-switch--outline.kt-switch--brand input:checked ~ span:before{
    background-color:#fff
}
.kt-switch.kt-switch--outline.kt-switch--brand input:checked ~ span:after{
    background-color:#5d78ff;
    opacity:1
}
.kt-switch.kt-switch--light:not(.kt-switch--outline) input:empty ~ span:before{
    background-color:#fff
}
.kt-switch.kt-switch--light:not(.kt-switch--outline) input:empty ~ span:after{
    color:#fff;
    background-color:#282a3c;
    opacity:0.4
}
.kt-switch.kt-switch--light:not(.kt-switch--outline) input:checked ~ span:before{
    background-color:#fff
}
.kt-switch.kt-switch--light:not(.kt-switch--outline) input:checked ~ span:after{
    opacity:1
}
.kt-switch.kt-switch--outline.kt-switch--light input:empty ~ span:before{
    border:2px solid #dee3eb;
    background-color:#e8ebf1
}
.kt-switch.kt-switch--outline.kt-switch--light input:empty ~ span:after{
    color:#282a3c
}
.kt-switch.kt-switch--outline.kt-switch--light input:checked ~ span:before{
    background-color:#282a3c
}
.kt-switch.kt-switch--outline.kt-switch--light input:checked ~ span:after{
    background-color:#fff;
    opacity:1
}
.kt-switch.kt-switch--dark:not(.kt-switch--outline) input:empty ~ span:before{
    background-color:#282a3c
}
.kt-switch.kt-switch--dark:not(.kt-switch--outline) input:empty ~ span:after{
    color:#282a3c;
    background-color:#fff;
    opacity:0.4
}
.kt-switch.kt-switch--dark:not(.kt-switch--outline) input:checked ~ span:before{
    background-color:#282a3c
}
.kt-switch.kt-switch--dark:not(.kt-switch--outline) input:checked ~ span:after{
    opacity:1
}
.kt-switch.kt-switch--outline.kt-switch--dark input:empty ~ span:before{
    border:2px solid #dee3eb;
    background-color:#e8ebf1
}
.kt-switch.kt-switch--outline.kt-switch--dark input:empty ~ span:after{
    color:#fff
}
.kt-switch.kt-switch--outline.kt-switch--dark input:checked ~ span:before{
    background-color:#fff
}
.kt-switch.kt-switch--outline.kt-switch--dark input:checked ~ span:after{
    background-color:#282a3c;
    opacity:1
}
.kt-switch.kt-switch--primary:not(.kt-switch--outline) input:empty ~ span:before{
    background-color:#5867dd
}
.kt-switch.kt-switch--primary:not(.kt-switch--outline) input:empty ~ span:after{
    color:#5867dd;
    background-color:#fff;
    opacity:0.4
}
.kt-switch.kt-switch--primary:not(.kt-switch--outline) input:checked ~ span:before{
    background-color:#5867dd
}
.kt-switch.kt-switch--primary:not(.kt-switch--outline) input:checked ~ span:after{
    opacity:1
}
.kt-switch.kt-switch--outline.kt-switch--primary input:empty ~ span:before{
    border:2px solid #dee3eb;
    background-color:#e8ebf1
}
.kt-switch.kt-switch--outline.kt-switch--primary input:empty ~ span:after{
    color:#fff
}
.kt-switch.kt-switch--outline.kt-switch--primary input:checked ~ span:before{
    background-color:#fff
}
.kt-switch.kt-switch--outline.kt-switch--primary input:checked ~ span:after{
    background-color:#5867dd;
    opacity:1
}
.kt-switch.kt-switch--success:not(.kt-switch--outline) input:empty ~ span:before{
    background-color:#0abb87
}
.kt-switch.kt-switch--success:not(.kt-switch--outline) input:empty ~ span:after{
    color:#0abb87;
    background-color:#fff;
    opacity:0.4
}
.kt-switch.kt-switch--success:not(.kt-switch--outline) input:checked ~ span:before{
    background-color:#0abb87
}
.kt-switch.kt-switch--success:not(.kt-switch--outline) input:checked ~ span:after{
    opacity:1
}
.kt-switch.kt-switch--outline.kt-switch--success input:empty ~ span:before{
    border:2px solid #dee3eb;
    background-color:#e8ebf1
}
.kt-switch.kt-switch--outline.kt-switch--success input:empty ~ span:after{
    color:#fff
}
.kt-switch.kt-switch--outline.kt-switch--success input:checked ~ span:before{
    background-color:#fff
}
.kt-switch.kt-switch--outline.kt-switch--success input:checked ~ span:after{
    background-color:#0abb87;
    opacity:1
}
.kt-switch.kt-switch--info:not(.kt-switch--outline) input:empty ~ span:before{
    background-color:#5578eb
}
.kt-switch.kt-switch--info:not(.kt-switch--outline) input:empty ~ span:after{
    color:#5578eb;
    background-color:#fff;
    opacity:0.4
}
.kt-switch.kt-switch--info:not(.kt-switch--outline) input:checked ~ span:before{
    background-color:#5578eb
}
.kt-switch.kt-switch--info:not(.kt-switch--outline) input:checked ~ span:after{
    opacity:1
}
.kt-switch.kt-switch--outline.kt-switch--info input:empty ~ span:before{
    border:2px solid #dee3eb;
    background-color:#e8ebf1
}
.kt-switch.kt-switch--outline.kt-switch--info input:empty ~ span:after{
    color:#fff
}
.kt-switch.kt-switch--outline.kt-switch--info input:checked ~ span:before{
    background-color:#fff
}
.kt-switch.kt-switch--outline.kt-switch--info input:checked ~ span:after{
    background-color:#5578eb;
    opacity:1
}
.kt-switch.kt-switch--warning:not(.kt-switch--outline) input:empty ~ span:before{
    background-color:#ffb822
}
.kt-switch.kt-switch--warning:not(.kt-switch--outline) input:empty ~ span:after{
    color:#ffb822;
    background-color:#111;
    opacity:0.4
}
.kt-switch.kt-switch--warning:not(.kt-switch--outline) input:checked ~ span:before{
    background-color:#ffb822
}
.kt-switch.kt-switch--warning:not(.kt-switch--outline) input:checked ~ span:after{
    opacity:1
}
.kt-switch.kt-switch--outline.kt-switch--warning input:empty ~ span:before{
    border:2px solid #dee3eb;
    background-color:#e8ebf1
}
.kt-switch.kt-switch--outline.kt-switch--warning input:empty ~ span:after{
    color:#111
}
.kt-switch.kt-switch--outline.kt-switch--warning input:checked ~ span:before{
    background-color:#111
}
.kt-switch.kt-switch--outline.kt-switch--warning input:checked ~ span:after{
    background-color:#ffb822;
    opacity:1
}
.kt-switch.kt-switch--danger:not(.kt-switch--outline) input:empty ~ span:before{
    background-color:#fd397a
}
.kt-switch.kt-switch--danger:not(.kt-switch--outline) input:empty ~ span:after{
    color:#fd397a;
    background-color:#fff;
    opacity:0.4
}
.kt-switch.kt-switch--danger:not(.kt-switch--outline) input:checked ~ span:before{
    background-color:#fd397a
}
.kt-switch.kt-switch--danger:not(.kt-switch--outline) input:checked ~ span:after{
    opacity:1
}
.kt-switch.kt-switch--outline.kt-switch--danger input:empty ~ span:before{
    border:2px solid #dee3eb;
    background-color:#e8ebf1
}
.kt-switch.kt-switch--outline.kt-switch--danger input:empty ~ span:after{
    color:#fff
}
.kt-switch.kt-switch--outline.kt-switch--danger input:checked ~ span:before{
    background-color:#fff
}
.kt-switch.kt-switch--outline.kt-switch--danger input:checked ~ span:after{
    background-color:#fd397a;
    opacity:1
}
</style>
