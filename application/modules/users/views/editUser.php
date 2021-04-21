<style type="text/css">
    .form-group .control-label span.required
    {
        color: red;
    }
    .fieldError{
        color: red !important;
    }
</style>
<!-- Start content -->

<div class="m-portlet m-portlet--primary m-portlet--head-solid-bg">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    Edit User
                </h3>
            </div>
        </div>
    </div>
    <div class="m-portlet__body" >
        <div class="row">
            <div class="col-md-12">
                <div class='tab-content'>   
                    <div id="tabs-1" class='active'>
                        <div class="col-sm-12">
                            <form  class="form-horizontal" id="setup_codes_form" method="post" enctype="multipart/form-data">
                                <div class="modal-body pl-0">
                                    <div class="row"> 
                                        <div class="col-md-6 p-0">
                                            <div class="form-group">
                                                <label for="fname" class="control-label col-lg-4">First Name <span class="required">*</span></label>
                                                <div class="col-lg-8 p-0">
                                                    <input type="text" class="validate[required] form-control placeholder" id="first_name" name="first_name" placeholder="Enter your first name" data-bind="value: first_name" value="<?php echo set_value('first_name'); ?>" maxlength="50" required/>
                                                    <span class="fieldError"><?php echo form_error('first_name'); ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="fname" class="control-label col-lg-4">Last Name <span class="required">*</span></label>
                                                <div class="col-lg-8 p-0">
                                                    <input type="text" class="validate[required] form-control placeholder" id="last_name" name="last_name" placeholder="Enter your last name" data-bind="value: last_name" value="<?php echo set_value('last_name'); ?>" maxlength="50" required/>
                                                    <span class="fieldError"><?php echo form_error('first_name'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-0"> 
                                            <div class="form-group"> 
                                                <label for="name" class="control-label col-lg-4"><?php echo isset($labels['email']) ? $labels['email']:'Email'; ?> <span class="required">*</span></label> 
                                                <div class="col-lg-8 p-0">
                                                    <input type="email" value="<?php echo $post['email']; ?>"  class="form-control note_no" id="user_email" name="email" maxlength="255" required readonly="">
                                                </div>
                                            </div> 
                                        </div> 
                                    </div>
                                    <div class="row"> 
                                        <div class="col-md-6 p-0"> 
                                            <div class="form-group"> 
                                                <label for="phone" class="control-label col-lg-4"><?php echo isset($labels['phone']) ? $labels['phone']:'Phone'; ?> <span class="required">*</span></label> 
                                                <div class="col-lg-8 p-0">
                                                    <input type="text" value="<?php echo $post['phone']; ?>" class="form-control note_no" id="phone" onkeypress="return regex_check()" name="phone" placeholder="Enter Phone" maxlength="15" autocomplete="off" required>
                                                    <span class="phone-error" style="display: none; color: red;">Phone number is not valid. i.e +(country code)(phone number) i.e +92123456789</span>
                                                    <span class="fieldError"><?php echo form_error('phone'); ?></span>
                                                </div>
                                            </div> 
                                        </div> 
                                    </div>
                                    <div class="row"> 
                                    </div>
                                    <div class="row"> 

                                        <div class="col-md-6 p-0"> 
                                            <div class="form-group"> 
                                                <label for="phone" class="control-label col-lg-4"><?php echo isset($labels['user_type']) ? $labels['user_type']:'User Role'; ?> <span class="required">*</span></label> 
                                                <div class="col-lg-8 p-0">
                                                    <select class="validate[required] placeholder" id="user_type" name="user_type[]" required multiple="multiple">
                                                        <option>Select Type</option>
                                                        <?php 
                                                        foreach($post['user_groups'] as $g){
                                                            if (in_array($g['id'], $post['groups_data'])) { ?>
                                                                <option value="<?php echo $g['id']?>" selected="selected"><?php echo ucfirst($g['name']);?></option>

                                                            <?php    }
                                                            else{
                                                                ?>
                                                                <option value="<?php echo $g['id']?>"><?php echo ucfirst($g['name']);?></option>
                                                            <?php } } ?>
                                                        </select>
                                                        <span class="fieldError"><?php echo form_error('user_type'); ?></span>
                                                    </div>
                                                </div> 
                                            </div> 

                                            <div class="col-md-6 p-0"> 
                                                <div class="form-group"> 
                                                    <label for="phone" class="control-label col-lg-4"><?php echo isset($labels['new_password']) ? $labels['new_password']:'New Password'; ?> </label> 
                                                    <div class="col-lg-8 p-0">
                                                        <input type="password"  class="form-control note_no" id="new_password" name="new_password" autocomplete="new-password"  maxlength="255">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row"> 
                                            <div class="col-md-6 p-0"> 
                                                <div class="form-group"> 
                                                    <label for="name" class="control-label col-lg-4"><?php echo isset($labels['image']) ? $labels['image']:'Image'; ?> </label> 
                                                    <div class="col-lg-8 p-0">
                                                        <input type="file"  class="form-control" id="image" name="image"  accept="image/*">
                                                        <?php
                                                        if($this->session->flashdata('img_error') != ""){

                                                            echo '<label for="image" class="error">'.$this->session->flashdata('img_error').'</label>';
                                                        }                                     
                                                        ?>
                                                        <?php if ($post['image'] != '') {
                                                            $filepath = base_url() . "assets/profile_pics/". $post['image'];
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
                                        <div class="row">

                                            <div class="col-md-12 p-0">
                                                <div class="panel-body p0"> 
                                                    <div class="form-group">
                                                        <label for="rrp" class="control-label col-lg-2 ">Your Address<span class="required">*</span></label>
                                                        <div class="col-lg-6 p-0">
                                                            <input type="text" class=" form-control placeholder locationTextField_n" id="locationTextField_n" name="address" placeholder="Search Location" value="<?php echo $post['address']; ?>" onchange="codeAddress();" autocomplete="off" required />
                                                            <span class="fieldError"><?php echo form_error('address'); ?></span>
                                                        </div>
                                                        <div class="col-lg-2">                          
                                                            <i class="input-group-btn">                      
                                                                <button class="btn btn-prosearch" type="button" onclick="codeAddress()">Search</button>
                                                            </i>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 p-0">
                                                <div class="panel-body p0">
                                                    <div class="form-group col-lg-6">
                                                        <label for="sale_price" class="control-label col-lg-4 ">Latitude<span class="required">*</span></label>
                                                        <div class="col-lg-8 p-0">
                                                            <input type="text" class="validate[required] form-control placeholder alphanumeric" id="pro_lat" name="latitude" placeholder="Latitudes" value="<?php echo set_value('latitude'); ?>" autocomplete="off" required readonly />
                                                        </div>
                                                    </div>
                                                    <div class="form-group  col-lg-6">
                                                        <label for="note" class="control-label col-lg-4 ">Longitude<span class="required">*</span></label>
                                                        <div class="col-lg-8 p-0">
                                                            <input type="text" class="validate[required] form-control placeholder alphanumeric" id="pro_lng" name="longitude" placeholder="Longitude" value="<?php echo set_value('longitude'); ?>" autocomplete="off" required readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <input type="hidden" name="id" id="id" value="<?php echo $post['id']; ?>" >
                                            <!-- <input type="hidden" name="user_percentage" id="user_percentage" value="<?=$this->data['user_record']->user_percentage?>" > -->

                                        </div>          

                                        <div style="height:500px;" id="map"></div>
                                        <br/><br/><br/>
                                    </div> 

                                    <div class="form-group " style="float: right;margin: 20px;">
                                        <input type="submit" id="signupuser"  value="Save" class="btn btn-info" data-placement="top" data-toggle="tooltip" data-original-title="Save Data">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content -->

    <?php 
    $db = get_instance()->db->conn_id;
    ?>
    <script type="text/javascript">
    // alert('<?php echo mysqli_real_escape_string($db,$post['item_name']) ?>');
    $("#first_name").val('<?php echo mysqli_real_escape_string($db,$post['first_name']) ?>');
    $("#last_name").val('<?php echo mysqli_real_escape_string($db,$post['last_name']) ?>');
    $("#market_price").val('<?php echo $post['market_price'] ?>');
    $("#willing_to_pay").val('<?php echo $post['willing_to_pay'] ?>');
    $("#note").val('<?php echo mysqli_real_escape_string($db,$post['description']) ?>');
    // $(".locationTextField_n").val('<?php echo mysqli_real_escape_string($db,$post['item_name']) ?>');
    $("#pro_lng").val('<?php echo $post['longitude'] ?>');
    $("#pro_lat").val('<?php echo $post['latitude'] ?>');

    $(document).ready(function(){
        $('#user_type').select2();
    })

// calculating markup price
$('#willing_to_pay').keyup(function(event) {

    var user_percentage = parseInt($('#user_percentage').val());
    var market_price = parseInt($('#market_price').val());
    var willing_to_pay = parseInt($('#willing_to_pay').val());
    var profit = market_price - willing_to_pay;
    var _hundred = 100;
    var _percent = user_percentage / _hundred;
    var _val = _percent*profit;
// var _markup_price = parseInt(_val) + parseInt(willing_to_pay);
var _markup_price = parseInt(market_price) - parseInt(_val);
if (isNaN(_markup_price)) {
    $('#markup_price').val(0);
}
else {
    $('#markup_price').val(_markup_price);
}
});

$('#market_price').keyup(function(event) {

    var user_percentage = parseInt($('#user_percentage').val());
    var market_price = parseInt($('#market_price').val());
    var willing_to_pay = parseInt($('#willing_to_pay').val());
    var profit = market_price - willing_to_pay;
    var _hundred = 100;
    var _percent = user_percentage / _hundred;
    var _val = _percent*profit;
    // var _markup_price = parseInt(_val) + parseInt(willing_to_pay);
    var _markup_price = parseInt(market_price) - parseInt(_val);
    if (isNaN(_markup_price)) {
        $('#markup_price').val(0);
    }
    else {
        $('#markup_price').val(_markup_price);
    }
});

function onlyAlphabets(e, t) {

    try {
        if (window.event) {
            var charCode = window.event.keyCode;            
        }
        else if (e) {
            var charCode = e.which;
        }
        else { return true; }
        if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || (charCode == 32))
            return true;
        else
            return false;
    }
    catch (err) {
        alert(err.Description);
    }
}
$(document).ready(function() {

    $('.form-horizontal').on('change keyup keydown', 'input, textarea, select', function(e) {
        $(this).addClass('changed-input');
    });
});

$('.reset').click(function() {
    setTimeout(function() {
        $('label.error').hide();
        $("[class*='error']").removeClass("error");
    }, 500);
});

$(document).ready(function() {
    $.validator.addMethod(
        "alphabetsOnly",
        function(value, element, regexp) {
            var re = new RegExp(regexp);
            return this.optional(element) || re.test(value);
        },
        "Input should be alphabetical"
        );

    $.validator.addMethod(
        "dobdate",
        function(value, element) {
// put your own logic here, this is just a (crappy) example
if(value!="")
{
    return value.match(/^\d\d?\/\d\d?\/\d\d\d\d$/);
} else {
    return true;
}
},
"Please enter a date in the format dd/mm/yyyy."
);
    $("#firstName").rules("add", {alphabetsOnly: "[a-zA-Z]" });
    $("#lastName").rules("add", {alphabetsOnly: "[a-zA-Z]" });
    $("#spouse_name").rules("add", {alphabetsOnly: "[a-zA-Z]" });

    $('INPUT[type="file"]').change(function () {
        var ext = this.value.match(/\.(.+)$/)[1];
        switch (ext) {
            case 'jpg':
            case 'JPG':
            case 'JPEG':
            case 'jpeg':
            case 'PNG':
            case 'png':
            case 'GIF':
            case 'gif':
            $('#signupuser').attr('disabled', false);
            $('#img_type').hide();
            break;
            default:
// alert('This is not an allowed file type.');
$('#img_type').show();
this.value = '';
}
});
});

function resetcurrentForm() {

}

function check_quantity(event) {
    var code = event.keyCode;
    var qtn_this;
    if (code == 48) { qtn_this = 0; }
    else if (code == 49) { qtn_this = 1; }
    else if (code == 50) { qtn_this = 2; }
    else if (code == 51) { qtn_this = 3; }
    else if (code == 52) { qtn_this = 4; }
    else if (code == 53) { qtn_this = 5; }
    else if (code == 54) { qtn_this = 6; }
    else if (code == 55) { qtn_this = 7; }
    else if (code == 56) { qtn_this = 8; }
    else if (code == 57) { qtn_this = 9; }
    else {}
        var qtn_value = $('#user_percentage').val();
    if (isNaN(qtn_value)) { qtn_value =0; }
    qtn_value = qtn_value+qtn_this;
    var qtn_max_val = parseFloat($('#item-code0').val());
    if (code > 47 && code < 58) {
        if (qtn_value <= 100) {
            return true;
        }
        else{
            return false;
        }
    }
    else if(code == 46)
    {
        if (qtn_value <= 100) {
            return true;
        }
        else{
            return false;
        }
    }
    else
    {
        return false;
    }

}

function regex_check() {
    var input = $('#phone').val();
    if (input.length < 3) {
        return true;    
    }
    else if(input.length > 14) {
        return false;
    }
    var regex = new RegExp("^\\+\\d+$");
    if(regex.test(input)) {
        $('.phone-error').css("display","none");
        return true;
    }else {
        $('.phone-error').css("display","block");
        return false;
    }
}

$(function() {

    $("#store_form").submit(function(e) {

        //$('#store_country').

    });

});

var marker;
var geocoder;
var adr;
var map;

var default_lat = <?php echo !empty($post["latitude"])?$post["latitude"]: '-33.8567844'; ?>;
var default_lng = <?php echo !empty($post["longitude"])?$post["longitude"]:'151.2152967'; ?>;
var default_zoom = 11;

function initMap() {

    geocoder = new google.maps.Geocoder();
    adr = document.getElementById('locationTextField_n').value;
    map = new google.maps.Map(document.getElementById('map'), {

        zoom: default_zoom,
        center: {
            lat: default_lat,
            lng: default_lng
        }
    });

    var lat = default_lat;
    var lng = default_lng;
    var latlng = new google.maps.LatLng(lat, lng);
    var mapOptions = {
        zoom: default_zoom,
        center: latlng,
    };
    var input = document.getElementById('locationTextField_n');
    google.maps.event.addDomListener(input, 'keydown', function(e) {

        if (e.keyCode == 13 && $('.pac-container:visible').length) {
            e.preventDefault();
        }
    });

    var autocomplete = new google.maps.places.Autocomplete(input);
    marker = new google.maps.Marker({

        map: map,
        draggable: true,
        animation: google.maps.Animation.DROP,
        position: {
            lat: default_lat,
            lng: default_lng
        }
    });

    marker.addListener('click', toggleBounce);
    google.maps.event.addListener(marker, 'dragend', function() {
        geocoder.geocode({
            'latLng': marker.getPosition()
        }, function(results, status) {

            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    $('#pro_lat').val(marker.getPosition().lat());
                    $('#pro_lng').val(marker.getPosition().lng());
                    $.each(results[0].address_components, function(index, obj) {

                        if (obj.types[0] == 'country') {
                            $("#store_country").val(obj.long_name);
                        }
                    });
                    $('#locationTextField_n').val(results[0].formatted_address);
                }
            }
        });
    });
}

function toggleBounce() {

    if (marker.getAnimation() !== null) {
        marker.setAnimation(null);
    } else {
        marker.setAnimation(google.maps.Animation.BOUNCE);
    }
}
function codeAddress() {
    ShowLoader();
    setTimeout(function(){
        marker.setMap(null);

        $('#pro_lat').default_lat;
        $('#pro_lng').default_lng;
        var address = document.getElementById('locationTextField_n').value;

        geocoder.geocode({
            'address': address
        }, function(results, status) {

            if (status == google.maps.GeocoderStatus.OK) {

                var position = results[0].geometry.location;
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();
                map.setCenter(position);
                marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    draggable: true,
                    title: "Drag me!"
                });

                map.setZoom(default_zoom);

                $('#pro_lat').val(latitude);
                $('#pro_lat+label').css('display','none');
                $('#pro_lng').val(longitude);
                $('#pro_lng+label').css('display','none');

                google.maps.event.addListener(marker, 'dragend', function() {

                    geocoder.geocode({
                        'latLng': marker.getPosition()
                    }, function(results, status) {

                        if (status == google.maps.GeocoderStatus.OK) {
                            if (results[0]) {
                                $('#pro_lat').val(marker.getPosition().lat());
                                $('#pro_lng').val(marker.getPosition().lng());
                                $.each(results[0].address_components, function(index, obj) {
                                    if (obj.types[0] == 'country') {
                                        $("#store_country").val(obj.long_name);
                                    }
                                });

                                $('#locationTextField_n').val(results[0].formatted_address);
                            }
                        }
                    });
                });
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
                return false;
            }
        });
        HideLoader();
    },1000);
    return false;
} 
</script>
<script async defer    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmqmsf3pVEVUoGAmwerePWzjUClvYUtwM&libraries=geometry,places&callback=initMap">  </script>
