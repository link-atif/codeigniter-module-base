<h3>View Users</h3>
<br />          
<?php
$edit_user_check = $this->acl_model->has_permission('users','editUser',$role_ids_array);
$viewUserDetail_check = $this->acl_model->has_permission('users','viewUserDetail',$role_ids_array);
$delete_user_check = $this->acl_model->has_permission('users','deleteUser',$role_ids_array);
$activate_user_check = $this->acl_model->has_permission('users','activeUserAccount',$role_ids_array);
$deactivate_user_check = $this->acl_model->has_permission('users','deactiveUserAccount',$role_ids_array);
?>
<table class="table table-bordered datatable" id="table-4">
    <thead>
        <tr>
            <th>No</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Image</th> 
<?php if($activate_user_check === TRUE || $deactivate_user_check === TRUE){ ?>  
            <th>Status</th>  
<?php }?>
            <th>Created At</th>
<?php if($edit_user_check === TRUE || $viewUserDetail_check === TRUE || $delete_user_check === TRUE){ ?>  
            <th>Action</th>
<?php }?>

        </tr>
    </thead>
    <tbody>
        <?php 
        $count = 1;
        foreach ($users->result() as $user) {
            if($user->added_on !='0000-00-00 00:00:00'){
                $date_object = new DateTime($user->added_on);
                $date = $date_object->format('d/m/Y h:i A');
            }else{
                $date = '';
            }
            ?>
            <tr class="odd gradeX">
                <td><?=$count;?></td>
                <td><?=$user->first_name;?></td>
                <td><?=$user->last_name;?></td>
                <td><?=$user->email;?></td>
                <td>
                    <?php
                    if ($user->image != "") { ?>
                        <img src="<?= base_url('assets/profile_pics/').$user->image ?>" style="height: 150px;width: 150px;">
                    <?php } else { ?>
                        <img src="<?= base_url('assets/profile_pics/1614246278_no_profile.jpg') ?>" style="height: 150px;width: 150px;">
                    <?php }
                    ?>
                </td>
<?php if($activate_user_check === TRUE || $deactivate_user_check === TRUE){ ?>  

                <td>
                <?php if($user->active == '0'){ ?>
                    <button class="btn btn-danger" onclick="active_user('<?=$user->id;?>');">Inactive</button>
                <?php }else{ ?>
                    <button class="btn btn-success" onclick="deactive_user('<?=$user->id;?>');">Active</button>
                <?php } ?>  
                </td>
<?php }?>

                <td><?=$date;?></td> 
<?php if($edit_user_check === TRUE || $viewUserDetail_check === TRUE || $delete_user_check === TRUE){ ?>  

                <td>
                    <?php if($delete_user_check === TRUE){ ?>  
                    <button class="btn btn-danger" onclick="delete_record('<?=$user->id;?>')"><li class="fa fa-trash"></li> Delete</button>
                    <?php }?>
                    <?php if($edit_user_check === TRUE){ ?>  
                    <a href="<?=base_url('editUser/').$user->id?>">
                        <button class="btn btn-info"><li class="fa fa-edit"></li> Edit</button>
                    </a>
                    <?php }?>
                    <?php if($viewUserDetail_check === TRUE){ ?>  
                    <a href="<?=base_url('userDetail/').$user->id?>">   
                        <button class="btn btn-success"><li class="fa fa-info"></li> Detail</button>
                    </a>
                    <?php }?>

                </td>
<?php }?>

            </tr>
            <?php
            $count++;
        } ?>           
    </tbody>
</table>
<script type="text/javascript">

    function active_user(user_id){
        Swal.fire({
          title: 'Are you sure to active this user?',
          showDenyButton: true,
          showCancelButton: true,
          confirmButtonText: `Confirm`,
          denyButtonText: `Cancel`,
      }).then((result) => {
        if (result.value === true) {
            var base_url = "<?=base_url('activeUserAccount');?>";
            $.ajax({
                type: "POST",
                data: {user_id: user_id},
                url: base_url,
                success: function(result) 
                {
                  Swal.fire('Activated!', '', 'success');
                  setTimeout(function(){
                    location.reload();
                }, 2000);            
              }
          });
        }else{
            Swal.fire('Changes are not saved', '', 'info')
        }

    })

  }
function deactive_user(user_id){
        Swal.fire({
          title: 'Are you sure to deactive this user?',
          showDenyButton: true,
          showCancelButton: true,
          confirmButtonText: `Confirm`,
          denyButtonText: `Cancel`,
      }).then((result) => {
        if (result.value === true) {
            var base_url = "<?=base_url('deactiveUserAccount');?>";
            $.ajax({
                type: "POST",
                data: {user_id: user_id},
                url: base_url,
                success: function(result) 
                {
                  Swal.fire('Deactivated!', '', 'success');
                  setTimeout(function(){
                    location.reload();
                }, 2000);            
              }
          });
        }else{
            Swal.fire('Changes are not saved', '', 'info')
        }

    })

  }
    function delete_record(record_id){
        Swal.fire({
          title: 'Are you sure to delete this record?',
          showDenyButton: true,
          showCancelButton: true,
          confirmButtonText: `Confirm`,
          denyButtonText: `Cancel`,
      }).then((result) => {
        if (result.value === true) {
            img_id = $(event).attr('img_id');
            $('.delbtn'+img_id).css('display','none');
            var base_url = "<?=base_url('deleteUser');?>";
            $.ajax({
                type: "POST",
                data: {record_id: record_id},
                url: base_url,
                success: function(result) 
                {
                  Swal.fire('Deleted!', '', 'success');
                  setTimeout(function(){
                    location.reload();
                }, 2000);            
              }
          });
        }else{
            Swal.fire('Changes are not saved', '', 'info')
        }

    })

  }
</script>

