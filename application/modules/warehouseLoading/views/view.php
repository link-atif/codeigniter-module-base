<h3>View DailyHistory</h3>
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
            <th>Date</th>
            <th>Builty Number</th>
            <th>KSL Slip Number</th>
            <th>City</th> 
            <th>Item Type</th> 
            <th>Quantity</th> 
            <th>Weight</th> 
            <th>Rate</th> 
            <th>Area</th> 
            <th>Sender</th> 
            <th>Reciever</th> 
            <th>Status</th> 
            <th>Days</th> 
            <th>Dispatch</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $count = 1;
        foreach (@$warehouseloading as $data) {
            if($data['added_on'] !='0000-00-00 00:00:00'){
                $date_object = new DateTime($data['added_on']);
                $date = $date_object->format('d/m/Y h:i A');
            }else{
                $date = '';
            }
            ?>
            <tr class="odd gradeX">
                <td><?=$count;?></td>
                <td><?=$data['date'];?></td>
                <td><?=$data['builty_number'];?></td>
                <td><?=$data['ksl_slip_number'];?></td>
                <td><?=$data['city'];?></td>
                <td><?=$data['item_type'];?></td>
                <td><?=$data['quantity'];?></td>
                <td><?=$data['weight'];?></td>
                <td><?=$data['rate'];?></td>
                <td>
                    <!-- <?php
                    if ($data['history_type'] == 1) {
                        echo "Servey";
                    }else if($data['history_type'] == 2){
                        echo "Quatation";
                    }else if($data['history_type'] == 3){
                        echo "Booking";
                    }
                    ?> -->
                    <?=$data['area'];?>
                </td>
                <td>
                    <!-- <?php
                    if ($data['delivery_type'] == 1) {
                        echo "Servey";
                    }else if($data['delivery_type'] == 2){
                        echo "Quatation";
                    }else if($data['delivery_type'] == 3){
                        echo "Booking";
                    }
                    ?> -->
                    <?=$data['sender'];?>
                </td>
                <td><?=$data['reciever'];?></td>
                <td><?=$data['status'];?></td>
                <td><?=$data['days'];?></td>
                <td><?=$data['dispatch'];?></td>
                <td><?=$data['added_on'];?></td>
                <td>
                    <?php if($data['isdel'] == '0'){ ?>
                        <button class="btn btn-danger" onclick="delete_record('<?=$data["id"]?>','daily_hoistory')"><i class="fa fa-daily_hoistory"></i> Delete</button>  
                        <a class="btn btn-info" href="<?=base_url('/editWarehouseLoading').'/'.$data['id']?>"><i class="fa fa-edit"></i> Edit</a>
                    <?php }else{ ?>  
                        <button class="btn btn-primary" onclick="restore_record('<?=$data["id"]?>')"><i class="fa fa-trash"></i> Restore</button>     
                    <?php } ?> 
                </td>
            </tr>
            <?php
            $count++;
        } ?>           
    </tbody>
</table>
<script type="text/javascript">

  

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
        var base_url = "<?=base_url('deleteWarehouseLoading');?>";
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
function restore_record(record_id){
    Swal.fire({
      title: 'Are you sure to restore this record?',
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: `Confirm`,
      denyButtonText: `Cancel`,
  }).then((result) => {
      if (result.value === true) {
        img_id = $(event).attr('img_id');
        $('.delbtn'+img_id).css('display','none');
        var base_url = "<?=base_url('restoreWarehouseLoading');?>";
        $.ajax({
          type: "POST",
          data: {record_id: record_id},
          url: base_url,
          success: function(result) 
          {
            Swal.fire('Restored!', '', 'success');
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

