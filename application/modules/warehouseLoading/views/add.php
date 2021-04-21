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
<h3>Warehouse Container loading</h3>
<br />			
<br />	

<form action="<?=base_url('addWarehouseLoading');?>" id="addWarehouseLoading_form" class="form-horizontal form_register" enctype="multipart/form-data" method="post" onsubmit="return check_validations();" novalidate="novalidate">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Date:</label>
                        <input type="date" class="form-control" id="date" name="date">
                    </div>
                    <div class="form-group">
                        <label>Builty Number:</label>
                        <select class="js-example-basic-single form-control" name="builty_number" required="">
                            <option value="">Select</option>
                            <?php  
                            foreach ($builty_numbers as $key => $builty_number) { ?>
                                <option value="<?= $builty_number['order_id'] ?>"><?= $builty_number['order_tracking_number'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>KSL Slip Number:</label>
                        <input type="number" class="form-control" id="ksl-slip-no" name="ksl_slip_number">
                    </div>
                    <div class="form-group">
                        <label class="" >City</label>
                        <select class="js-example-basic-single2 form-control" name="city">
                            <option value="" selected hidden>Select</option>
                            <?php  
                            foreach ($cities as $key => $city) { ?>
                                <option value="<?= $city['city_id'] ?>"><?= $city['city_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="" >Item Type</label>
                        <select class="js-example-basic-single2 form-control" name="item_type">
                            <option value="" selected hidden>Select</option>
                            <option value="normal">Normal</option>
                            <option value="wooden_box">Wooden Box</option>
                            <option value="cycle">Cycle</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Quantity:</label>
                        <input type="number" class="form-control" id="Quantity" name="quantity">
                    </div>
                    <div class="form-group">
                        <label>Weight:</label>
                        <input type="number" class="form-control" id="weight" name="weight">
                    </div>
                    <div class="form-group">
                        <label>Rate:</label>
                        <input type="number" class="form-control" id="rate" name="rate">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="" >Area</label>
                        <select class="js-example-basic-single2 form-control" name="area">
                            <option value="AL">W.H</option>
                            <option value="AL">Outside</option>
                            <option value="AL">Default</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="" >Sender:</label>
                        <select class="js-example-basic-single1 form-control" name="sender">
                            <option value="AL">Sender1</option>
                            <option value="AL">Sender2</option>
                            <option value="AL">Sender3</option>
                        </select>               
                    </div>
                    <div class="form-group">
                        <label class="" >Receiver:</label>
                        <select class="js-example-basic-single2 form-control" name="reciever">
                            <option value="AL">Receiver1</option>
                            <option value="AL">Receiver2</option>
                            <option value="AL">Receiver3</option>
                        </select>               
                    </div>
                    <div class="form-group">
                        <label class="" >Status W.H/CNT Load:</label>
                        <select class="js-example-basic-single2 form-control" name="status">
                            <option value="AL">Loaded</option>
                            <option value="AL">Delievered</option>
                            <option value="AL">Received</option>
                        </select>               
                    </div>
                    <div class="form-group">
                        <label class="" >Days</label>
                        <input type="number" class="form-control" id="days" name="days">
                    </div>
                    <div class="form-group">
                        <label class="" >Dispatch:</label>
                        <input type="text" class="form-control" id="dispatch" name="dispatch">
                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
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
    $('.datepicker').datepicker();
</script>
<script async defer    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmqmsf3pVEVUoGAmwerePWzjUClvYUtwM&libraries=geometry,places&callback=initMap"></script>

