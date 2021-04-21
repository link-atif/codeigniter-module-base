<div class="m-portlet m-portlet--primary m-portlet--head-solid-bg">

    <div class="m-portlet__body">
        <div class="row">

            <div class="col-md-6">
                <div class="m-portlet m-portlet--full-height  m-portlet--rounded">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Personal Info
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="from_group p_t_10">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row static-info">
                                    <div class="col-md-5 name">
                                        <?php echo isset($labels['First Name']) ? $labels['First Name']:'First Name'; ?> :
                                    </div>
                                    <div class="col-md-7 value">
                                        <?php echo isset($user['first_name'])?$user['first_name']:''; ?>
                                    </div>
                                </div>
                                <br><br>

                                <div class="row static-info">
                                    <div class="col-md-5 name">
                                        <?php echo isset($labels['Last Name']) ? $labels['Last Name']:'Last Name'; ?> :
                                    </div>
                                    <div class="col-md-7 value">
                                        <?php echo isset($user['last_name'])?$user['last_name']:''; ?>
                                    </div>
                                </div>
                                <br><br>

                                <div class="row static-info">
                                    <div class="col-md-5 name">
                                        <?php echo isset($labels['email']) ? $labels['email']:'Email'; ?> :
                                    </div>
                                    <div class="col-md-7 value">
                                        <?php echo isset($user['email'])?$user['email']:''; ?>
                                    </div>
                                </div>
                                <br><br>

                                <div class="row static-info">
                                    <div class="col-md-5 name">
                                        <?php echo isset($labels['profile_image']) ? $labels['profile_image']:'Profile Photo'; ?> :
                                    </div>
                                    <div class="col-md-7 value">
                                        <?php if ($user['image'] != '') {
                                            $filepath = base_url() . "assets/profile_pics/". $user['image'];
                                            echo "<img width='200px' src=" . $filepath . " />";
                                        } else {
                                            $no_photo = base_url() . "assets/profile_pics/1614246278_no_profile.jpg";
                                            echo "<img style='width:205px;' src=\"$no_photo\" />";
                                        }
                                        ?>

                                    </div>
                                </div>      
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .from_group {
        padding: 10px 15px;
    }
    #map {

        height: 200px;  /* The height is 400 pixels */

        width: 100%;  /* The width is the width of the web page */

    }
</style>                 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>            

<script type="text/javascript">
 function delete_record(id){

    var status = 1;
    $.get("<?php echo base_url(); ?>finddeals/finddeals/delete_rejected_reason/"+id,function(data){
            // $('#leavesdm-modal-assign').modal('hide');
            Swal.fire({
              title: 'Do you want to delete this record?',
              showDenyButton: true,
              showCancelButton: true,
              confirmButtonText: `Delete`,
              denyButtonText: `Cancel`,
          }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {
                Swal.fire('Yes Delete!', '', 'success');
                location.reload();

            } else if (result.isDenied) {
                Swal.fire('Not Deleted', '', 'info');
            }
        })

      });
        // return false;
    }
    function getData(id)
    {
        $.ajax({
            url: '<?php echo site_url('users/users/get_data'); ?>' + '/' + id,
            type: 'POST',
            data: {id: id},
            success: function(response)
            {
                var dataArray = jQuery.parseJSON(response);
                console.log(response)
                $('#id').val(dataArray.id);
                $('#name').val(dataArray.name);
                $('#phone').val(dataArray.phone);
                $('#user_email').val(dataArray.email);
                $('#address').val(dataArray.address);
                $('#user_percentage').val(dataArray.user_percentage);
                $('#rejection_fee').val(dataArray.rejection_fee);
                group_id = dataArray.group_id;
                var select = document.getElementById("user_role"); 
                var options = dataArray[0]; 
                for(var i = 0; i < options.length; i++) {
                    var opt = options[i];
                    console.log(opt)
                    var el = document.createElement("option");
                    el.textContent = opt.description;
                    el.value = opt.id;
                    select.appendChild(el);
                }
                // get the OPTION we want selected
                var $option = $('#user_role').children('option[value="'+ group_id +'"]');
                // and now set the option we want selected
                $option.attr('selected', true);
                if(dataArray.image !=""){
                    $('.image_src1').show();
                    var src1 = '<?php echo base_url('assets/profile_pics/') ?>' + dataArray.image;        
                    $('.src1').attr('src', src1);
                }

                $('.edit-reset').attr("id", dataArray.id);
                $('.edit-reset').attr("onclick", "getData(this.id);");
                $('#add_edit_setup_codes_modal').modal('show');
            }
        });
        // document.getElementById("editj").style.display = "block";
    }
</script>                       
<script async src='https://www.google.com/recaptcha/api.js'></script>
<script defer

src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmqmsf3pVEVUoGAmwerePWzjUClvYUtwM&callback=initMap">

</script>

<script>
  function initMap() {
    var locationRio = {lat: <?php echo isset($user['latitude'])? $user['latitude']:''; ?>, lng: <?php echo isset($user['longitude'])? $user['longitude']:''; ?>};
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 13,
      center: locationRio,
      gestureHandling: 'none',

  });
    var marker = new google.maps.Marker({
      position: locationRio,
      map: map,
      title: 'Hello World!'
  });
}
</script>