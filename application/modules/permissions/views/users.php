<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">
    function updateUserRoles(uid) {
        $("#user_id").val(uid);
        var id = $("#id" + uid).val();
        var a = id.split(",");
        for (var i = 0; i < a.length; i++) {
            var selected_id = a[i];
            $("#groups option").each(function() {
                if ($(this).val() == selected_id) { // EDITED THIS LINE
                    $(this).attr("selected", "selected");
                }
            });
        }
        $('#groups').trigger('change');
    }
    $(document).ready(function() {
        $(".js-example-tokenizer").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });
    });
</script>


<style>
    #reset {
        float: right;
    }
    .text_filter {
        width: 100% !important;
    }
    #add_info{
        display:none;
    }
    .table-scrollable.table-scrollable-borderless {
        height: 300px;
        overflow-y: auto;
    }
    .portlet.yellow-crusta.box {
        height: 400px;
    }
    #close_form{
        display:none;
    }
    .timeline-badge-userpic {
        height: 80px;
    }
    .portlet.yellow-crusta.box {
        background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    }

    .btnclass {
        float: left;
        padding: 0 0 7px 2px;
    }

    .page_bg {
        background: #fff none repeat scroll 0 0;
        float: left;
        margin-bottom: 15px;
        margin-top: 15px;
        padding: 0 15px;
        width: 100%;
    }
    .portlet-body.employe_div {
        height: auto;
    }

    #add_info{
        display:none;
    }

    #close_form{
        display:none;
    }
    .timeline-badge-userpic {
        height: 80px;
    }
    .upload{
        background-color: blue;
        border: 1px solid;
        color: #fff;
        padding: 10px;
        text-shadow: 1px 1px 0 green;
    }
    .upload:hover{
        cursor:pointer;
        background:#c20b0b;
        border:1px solid #c20b0b;
        box-shadow:0 0 5px rgba(0,0,0,.75)
    }
    #file{
        color:green;
        padding:5px;
        border:1px dashed #123456;
        background-color:#f9ffe5
    }
    #upload{
        margin-left:45px
    }
    #noerror{
        color:green;
        text-align:left
    }
    #error{
        color:red;
        text-align:left
    }
    #img{
        width:17px;
        border:none;
        height:17px;
        margin-bottom:91px
    }
    .abcd{
        text-align:center
    }
    .abcd img{
        height:100px;
        width:100px;
        padding:5px;
        border:1px solid #e8debd
    }

    .timeline-badge-userpic1 {
        float: right;
    }
    .timeline-body-content {
        float: left;
        font-size: 14px;
        margin-top: 35px;
        width: 86%;
    }
    .timeline-body-head {
        float: left;
        margin-bottom: 0 !important;
        width: 86%;
    }
    #filediv {
        float: left;
        margin-top: 10px;
        padding-left: 23%;
        width: 60%;
    }
    #filediv input {
        margin-left: 33%;
        margin-top: 15px;
    }

    @media (max-width:767px){
        #filediv input {
            margin-left: 5%;
            margin-top: 15px;
        }
        .leftcontent {
            width: 100%;
        }
        .rightcontent {
            width: 100%;
        }

    }
    .timeline-badge1 {
        float: right;
        margin-top: -23px;
    }
    .employe_div {
        height: 363px;

    }

    .topdiv {
        float: left;
        width: 100%;
        font-weight: bold;
        font-size: 14px;
        padding: 25px 16px;
    }
    .text_overflow {
        height: 61px;
        overflow: auto;
    }
    #actualbody {
        background: #eff3f8 none repeat scroll 0 0;
    }
    .btnclass {
        float: right;
        margin-bottom: 0px;
        margin-left: 3px;
        margin-top: -20px;
    }
    .container.page_bg {
        background: #fff none repeat scroll 0 0;
        padding-top: 15px;
    }
    #actualbody {
        padding:0px;
    }
    #pagetitle {
        margin-top: 15px;
    }
    .topdivid {
        font-size: 16px;
        margin-left: 10px;
        margin-top: 13px;
        width: 50%;
    }
    .title_table {
        float: left;
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 15px;
        margin-left: 15px;
        width: 100%;
    }
    .discription_table {
        border: 1px solid #ccc;
    }
    .showspace{
        margin-bottom:20px;

    }
    h3 {
        margin-bottom: 0;
        margin-top: 10px;
    }
    .leftcontent {
        float: left;
        width: 50%;
    }
    .rightcontent {
        float: left;
        width: 50%;
    }
    .discription {
        margin-bottom: 20px;
    }
    .header_content {
        border-bottom: 1px solid #eee;
        float: left;
        margin-bottom: 20px;
        padding-bottom: 0;
        width: 100%;
    }
    .topdivid > span {
        color: #4db3a2 !important;
        font-size: 16px;
        font-weight: bold;
    }
    .fa-cogs::before {
        color: #4db3a2;
        content: "";
    }
    .color_d {
        color: #9eacb4;
        font-size: 13px;
        font-style: normal;
        margin-left: 10px;
        margin-right:10px;
    }
    .title_all_c {
        font-size: 18px;
        margin-bottom: 20px;
        margin-left: 10px;
    }
    @media (max-width:480px) {
        .nav > li > a {
            padding: 10px 2px;
        }
        .topdivid {
            width: 100%;
        }
    }
    @media (max-width:767px) {
        .tabbable-custom {
            float: left;
            width: 100%;
        }
    }

    .container {
        width: 1300px;
        max-width:100%;
    }
    .portlet > .portlet-body.blue-hoki, .portlet.blue-hoki {
        float: left;
        width: 100%;
    }
    .table-scrollable {
        border: medium none;
    }

</style>


<div class="m-portlet m-portlet--primary m-portlet--head-solid-bg" id="main_portlet">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    Users
                </h3>
            </div>
        </div>

    </div>

    <div class="m-portlet__body">

        <div id="bdlist">

<!--                      <input type="button" onclick="yadcf.exResetAllFilters(oTable);" value="<?php echo $this->lang->line('reset'); ?>" class="some_btn general_btn btn btn-info pull-right">-->
            <table class="table table-bordered table-hover table-checkable dataTable no-footer dtr-inline"  id="user_list">
                <thead>

                    <tr role="row" class="heading">
                        <th width="8%">Action</th>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Roles</th>


                    </tr>

                </thead>
                <tbody>
                    <?php
                    foreach ($users as $r) {
                        $roles_arr = $this->acl_model->get_group_by_user_id($r['id']);
                        ?>
                        <tr>
                    <input type="hidden" name="id" id="id<?php echo $r['id'] ?>" value='<?php echo $roles_arr['ids'] ?>' />
                    <td>
                        <span class="dropdown">
                            <a  class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                                <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">

                                <a href="javascript:void(0)" data-toggle="modal" data-target="#edit_role" onclick='updateUserRoles("<?php echo $r['id']; ?>")' class="dropdown-item"  id="btnView"><i class="la la-edit"></i>Edit</a>

                            </div>
                        </span>
                    </td>
                    <td><?php echo $r['id'] ?></td>
                    <td><?php echo $r['first_name'] . " " . $r['last_name']; ?></td>
                    <td><?php echo $roles_arr['names']; ?></td>

                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="edit_role" class="modal " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog"> 
        <div class="">
            <div class="panel panel-color panel-info">
                <div class="building_heading_button btn blue">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button> 
                    <h4 class="panel-title">Update Role</h4> 
                </div>
                <form name="frm" method="post" action="<?php echo base_url() ?>permissions/update_usergroup">
               	<input type="hidden" name="user_id" id="user_id" />
                    <div class="modal-content"> 
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label>Roles</label>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select name="groups[]" id="groups" class="js-example-tokenizer" style="width:100%" width="100%"  multiple="multiple">
                                        <?php foreach ($groups as $g) { ?>
                                            <option value="<?php echo $g['id']; ?>"><?php echo $g['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer"> 
                           <input type="hidden" id="incident_id" name="incident_id" value="0" />
                           <button type="submit"  class="btn btn-info m-btn--pill waves-effect waves-light">Update</button>
                        </div> 
                    </div> 
                </form>
            </div>
        </div>
	</div>
</div>
<div class="md-overlay"></div>