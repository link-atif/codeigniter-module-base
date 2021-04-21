 <style type="text/css">
.form-group .control-label span.required
{
    color: red;
}

.fieldError{
    color: red !important;
}
.error{
	color: red;
}
</style>
<h3>Add User</h3>
<br />			
<br />	

<form action="<?=base_url('addUserData');?>" id="user_form" class="form-horizontal form_register" enctype="multipart/form-data" method="post" onsubmit="return check_validations();" novalidate="novalidate">
	<div class="panel panel-color panel-info">
		<div class="panel-body">
			<div class=" form">
				<div class="row">
					<div class="col-md-6 p-0">
						<div class="panel-body  p0"> 
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
			
                            <div class="form-group">
                                <label for="emailAddress" class="control-label col-lg-4"><?php echo isset($labels['emailAddress']) ? $labels['emailAddress']:'Work Email'; ?> <span class="required">*</span></label>
                                <div class="col-lg-8 p-0">
                                    <input type="email" class="validate[required] form-control placeholder" id="emailAddress" name="emailAddress" maxlength="100" placeholder="Enter Email Address" required  value="<?php echo set_value('emailAddress'); ?>"   />
                                    <span class="fieldError"><?php echo form_error('emailAddress'); ?></span>
                                </div>   
                            </div>
                            <div class="form-group">
                                <label for="workPhone" class="control-label col-lg-4"><?php echo isset($labels['workPhone']) ? $labels['workPhone']:'Phone'; ?> <span class="required">*</span></label>
                                <div class="col-lg-8 p-0">
                                    <input type="text" class="validate[required] form-control placeholder" id="workPhone" name="workPhone" maxlength="100" placeholder="Enter Phone" onkeypress="return regex_check()" required  value="<?php echo set_value('workPhone'); ?>" autocomplete="off" />
                                    <span class="fieldError"><?php echo form_error('workPhone'); ?></span>
                                    <span class="phone-error" style="display: none; color: red;">Phone number is not valid. i.e +(country code)(phone number) i.e +92123456789</span>
                                </div>   
                            </div>

                            <div class="form-group">
                                <label for="emailnotification" class="control-label col-lg-4"><?php echo isset($labels['profile_pic']) ? $labels['profile_pic']:'Profile Picture'; ?></label>

                                <div class="col-lg-8 p-0">
                                    <!-- <input type="file" name=""> -->
                                    <input type="file" name="image" id="image" class="form-control" accept="image/*">

                                    <?php
                                    if($this->session->flashdata('img_error') != ""){

                                        echo '<label for="image" class="error">'.$this->session->flashdata('img_error').'</label>';
                                    }                                     
                                    ?>
                                </div>
                            </div> 
						</div>
					</div>   

					<div class="col-md-6 p-0">
						<div class="panel-body p0"> 
                            <div class="form-group">
                                <label for="password" class="control-label col-lg-4 "><?php echo isset($labels['password']) ? $labels['password']:'Password'; ?> <span class="required">*</span></label>
                                <div class="col-lg-8 p-0">
                                    <input type="password" class="validate[required] form-control placeholder password_check_cls" id="password" name="password" placeholder="Enter Password" value="<?php echo set_value('password'); ?>" maxlength="80" autocomplete="new-password" required />
                                    <span class="fieldError"><?php echo form_error('password'); ?></span>
                                    <span id="result_pw_check"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword" class="control-label col-lg-4 "><?php echo isset($labels['repeatPassword']) ? $labels['repeatPassword']:'Repeat Password'; ?><span class="required">*</span></label>
                                <div class="col-lg-8 p-0">
                                    <input type="password" class="validate[required,equals[password]] form-control placeholder" id="repeatPassword" data-rule-equalTo="#password" name="repeatPassword" placeholder="Enter Repeat password" data-bind="value: confirmPassword, event: { change: matchPassword }" value="<?php echo set_value('repeatPassword'); ?>" maxlength="80" required/>
                                    <span class="fieldError"><?php echo form_error('repeatPassword'); ?></span>
                                </div>
                            </div>
							<div class="form-group">
								<label for="user_type" class="control-label col-lg-4 ">User Type<span class="required" aria-required="true">*</span></label>
								<div class="col-lg-8 p-0">
                                     
									<select class="user_type" required="" name="user_type[]" multiple="" data-select2-id="1" tabindex="-1" aria-hidden="true" aria-required="true">
										<option>Select Type</option>
                                        <?php foreach($groups as $g){ ?>

                                            <option value="<?php echo $g->id?>"><?php echo ucfirst($g->name);?></option>
<!--                                             <?php if (set_value('user_type') == $g->id) { ?>
                                                <option value="<?php echo $g->id?>" selected="selected"><?php echo ucfirst($g->name);?></option>
                                            <?php }else { ?>
                                                <option value="<?php echo $g->id?>"><?php echo ucfirst($g->name);?></option>
                                            <?php } ?>   -->

                                       <?php } ?>
								
									</select>
                                     <span class="fieldError"><?php echo form_error('user_type'); ?></span>
								</div>
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
                                    <input type="text" class="validate[required] form-control placeholder" id="locationTextField" name="address" placeholder="Search Location" value="<?php echo set_value('address'); ?>" onchange="codeAddress();" autocomplete="off" required />
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
							<div class="panel-body p0">
                                <div class="form-group col-lg-6">
                                    <label for="sale_price" class="control-label col-lg-4 ">Latitude:<span class="required">*</span></label>
                                    <div class="col-lg-8 p-0">
                                        <input type="text" class="validate[required] form-control placeholder alphanumeric" id="pro_lat" name="latitude" placeholder="Latitudes" value="<?php echo set_value('latitude'); ?>" autocomplete="off" required readonly />
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="note" class="control-label col-lg-4">Longitude<span class="required">*</span></label>
                                    <div class="col-lg-8 p-0">
                                        <input type="text" class="validate[required] form-control placeholder alphanumeric" id="pro_lng" name="longitude" placeholder="Longitude" value="<?php echo set_value('longitude'); ?>" autocomplete="off" required readonly />
                                    </div>
                                </div>    
                            </div>
						
						</div>
							<div id="map" style="height:500px;"></div>

					</div>
					<div class="form-group " style="float: right;margin: 20px;">
						<input type="submit" id="signupuser" name="signupuser" value="Save" class="btn btn-info" data-placement="top" data-toggle="tooltip" data-original-title="Save Data">
					</div>
				</div>    

				<br><br><br>

			</div>
		</div> <!-- panel -->

		
</div>
</form>

<script type="text/javascript">
	  $('#user_form').validate({// initialize the plugin
        rules: {

            emailAddress: {
                required: true,
                emailExt: true,

            },
        
        }
    });
    $(document).ready(function(){
        $('.user_type').select2();
    })

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
            var qtn_value = $('#userPercentage').val();
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
        var input = $('#workPhone').val();
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
 


    function resetcurrentForm() {
    }

    function check_validations()
    {
        var password = $('#password').val();
        if (password != '')
        {
            var result_pw_check = $('#result_pw_check').text();
            if (result_pw_check == 'Strong' || result_pw_check == '')
            {
                return true;
            }
            else
            {
                alert('Please add Strong Password');
                return false;
            }
            return false;
        }
    }
    var marker;
    var geocoder;
    var adr;
    var map;
    var default_lat = -33.8567844;
    var default_lng = 151.2152967;
    var default_zoom = 14;
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position){
            console.log(position);
            $.get( "https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyAmqmsf3pVEVUoGAmwerePWzjUClvYUtwM&latlng="+ position.coords.latitude + "," + position.coords.longitude +"&sensor=false", function(data) {
                console.log(data.results[0]);
                var _formated_address = data.results[0].formatted_address;
                var _location_lat = data.results[0].geometry.location.lat;
                var _location_lng = data.results[0].geometry.location.lng;
                if (typeof _formated_address !== 'undefined' && typeof _location_lat !== 'undefined' && typeof _location_lng !== 'undefined') {
                    $('#locationTextField').val(_formated_address);
                    $('#pro_lat').val(_location_lat);
                    $('#pro_lng').val(_location_lng);
                    console.log('Location found');
                    default_lat = _location_lat;
                    default_lng = _location_lng;
                    initMap();
                }
            })
    });
    }

    function initMap() {

        geocoder = new google.maps.Geocoder();
        adr = document.getElementById('locationTextField').value;
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
        var input = document.getElementById('locationTextField');
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
                        $('#locationTextField').val(results[0].formatted_address);
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
            var address = document.getElementById('locationTextField').value;

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
                            $('#locationTextField').val(results[0].formatted_address);
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
<script async defer    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmqmsf3pVEVUoGAmwerePWzjUClvYUtwM&libraries=geometry,places&callback=initMap"></script>

