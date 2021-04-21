<h3>View Orders</h3>
<br />          

<table class="table table-bordered datatable" id="table-4">
    <thead>
        <tr>
            <th>No</th>
            <th>Order tracking number</th>
            <th>Order amount</th>
            <th>Shipper address</th>
            <th>Reciever address</th>
            <th>Order total pcs</th>
            <th>Order total weight</th>
            <th>Shipment mode</th>
            <th>Order status</th>
            <th>Grand total</th>
            <th>Order create Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $count = 1;
        foreach ($orders as $kwy => $order) {
            if($order['added_on'] !='0000-00-00 00:00:00'){
                $date_object = new DateTime($order['added_on']);
                $date = $date_object->format('d/m/Y h:i A');
            }else{
                $date = '';
            }
            ?>
            <tr class="odd gradeX">
                <td><?= ++$key ;?></td>
                <td><?=$order['order_tracking_number'];?></td>
                <td><?=$order['order_amount'];?></td>
                <td><?=$order['shipper_address'];?></td>
                <td><?=$order['reciever_address'];?></td>
                <td><?=$order['order_total_pcs'];?></td>
                <td><?=$order['order_total_weight'];?></td>
                <td><?=$order['shipment_mode_text'];?></td>
                <td><?=$order['order_status'];?></td>
                <td><?=$order['grand_total'];?></td>
                <td><?=$date;?></td> 
                <td>
                    <button class="btn btn-danger" onclick="delete_record('<?=$order['order_id'];?>')"><li class="fa fa-trash"></li> Delete</button>
                    <a href="<?=base_url('editOrder/').$order['id']?>">
                        <button class="btn btn-info"><li class="fa fa-edit"></li> Edit</button>
                    </a>
                    <a href="<?=base_url('orderDetail/').$order['id']?>">   
                        <button class="btn btn-success"><li class="fa fa-info"></li> Detail</button>
                    </a>
                </td>
            </tr>
            <?php } ?>           
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
            var base_url = "<?=base_url('deleteOrder');?>";
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

