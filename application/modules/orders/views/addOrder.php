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
<h3><?php echo $title; ?></h3>
<br />			
<br />	

<form action="<?=base_url('addOrder');?>" id="user_form" class="form-horizontal form_register" enctype="multipart/form-data" method="post" onsubmit="return check_validations();" novalidate="novalidate">

    <div class="panel panel-color panel-info">
        <div class="panel-body">
            <div class=" form">
                <div class="row">
                    <div class="col-md-12 p-0">
                        <div class="panel-body  p0"> 
                            <div class="form-group">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>Date</th>
                                        <th>Destination</th>
                                        <th>Pcs</th>
                                        <th>Total weight</th>
                                        <th>Tracking number</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="date" name="order_date" class="form-control" required=""></td>
                                            <td>
                                                <input type="text" name="order_destination" id="destination" class="destination form-control" onchange="codeAddress1()" required="">
                                                <input type="hidden" name="order_destination_latitude" id="order_destination_latitude" class="destination form-control">
                                                <input type="hidden" name="order_destination_longitude" id="order_destination_longitude" class="destination form-control">
                                            </td>
                                            <td><input type="text" name="order_total_pcs" class="form-control" required=""></td>
                                            <td><input type="text" name="order_total_weight" id="order_total_weight" class="form-control" readonly=""></td>
                                            <td><input type="text" name="order_tracking_number" id="order_tracking_number" class="form-control" value="" readonly=""></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>
                                                            Shipper Name :
                                                        </th>
                                                        <td>
                                                            <input type="text" name="shipper_name" class="form-control" required="">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            Address :
                                                        </th>
                                                        <td>
                                                            <input type="text" name="shipper_address" id="shipper_address" class="form-control" onchange="codeAddress2()" required="">
                                                            <input type="hidden" id="shipper_address_lat" name="shipper_address_lat" class="form-control" >
                                                            <input type="hidden" id="shipper_address_long" name="shipper_address_long" class="form-control" >
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            Customer TRN :
                                                        </th>
                                                        <td>
                                                            <input type="text" name="shipper_customer_trn" class="form-control" >
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            Mob :
                                                        </th>
                                                        <td>
                                                            <input type="text" name="shipper_phone" class="form-control" required="">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td colspan="3">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>
                                                            Consignee/ Reciever Name :
                                                        </th>
                                                        <td>
                                                            <input type="text" name="reciever_name" class="form-control" required="">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            Address :
                                                        </th>
                                                        <td>
                                                            <input type="text" name="reciever_address" id="reciever_address" class="form-control" onchange="codeAddress3()" required="">
                                                            <input type="hidden" id="reciever_address_lat" name="reciever_address_lat" class="form-control">
                                                            <input type="hidden" id="reciever_address_long" name="reciever_address_long" class="form-control">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            Mob :
                                                        </th>
                                                        <td>
                                                            <input type="text" name="reciever_phone" class="form-control" required="">
                                                        </td>
                                                    </tr>
                                                </table>  
                                            </td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">
                                                Mode of shipment :
                                            </th>
                                            <td colspan="3">
                                                <select name="shipment_mode" class="form-control" required="">
                                                    <option selected="" disabled="">select shimpent mode</option>
                                                    <?php
                                                    if (!empty($shipment_modes)) {
                                                        foreach ($shipment_modes as $key => $modes) {?>
                                                            <option value="<?= $modes['id'] ?>"><?= $modes['shipment_type'] ?></option>
                                                        <?php }
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <table class="table table-bordered">
                                                    <th>Salesman : </th>
                                                    <td>
                                                        <input type="text" name="salesman" class="form-control" value="<?= $this->session->userdata('user_name') ?>" readonly="">
                                                        <input type="hidden" name="user_id" class="form-control" value="<?= $this->session->userdata('user_id') ?>" readonly="">
                                                    </td>
                                                </table>
                                            </td>
                                            <td colspan="3">
                                                <!-- <table class="table table-bordered">
                                                    <th>Booking No. : </th>
                                                    <td><input type="text" name="order_tracking_number" class="form-control"></td>
                                                </table> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" style="text-align: center;"><b>Invoice Type</b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">
                                                <table class="table table-bordered itemRows" id="newinvoice">
                                                    <thead>
                                                        <th>SR NO.</th>
                                                        <th>Item description</th>
                                                        <th>Weight</th>
                                                        <th>Freight</th>
                                                        <th>VAT</th>
                                                        <th>Total</th>
                                                        <th>Action</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr id="1">
                                                            <td>1</td>
                                                            <td><input type="text" name="item_name[]" id="item_desc1" class="form-control" required="" autocomplete="off" ></td>
                                                            <td><input type="text" name="item_weight[]" id="item_weight1" onkeyup="total_weight()" class="form-control" required="" autocomplete="off"></td>
                                                            <td><input type="text" name="item_freight[]" id="item_freight1" class="form-control" required="" autocomplete="off"></td>
                                                            <td><input type="text" name="item_vat[]" id="item_vat1" class="form-control" required="" autocomplete="off"></td>
                                                            <td><input type="text" name="item_price[]" id="item_total1" class="form-control" onkeyup="total()" required="" autocomplete="off"></td>
                                                            <td class="text-center">
                                                                <button type="button" onclick="removeRow(this,rowNum);" style="background: none; border: none;">
                                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <td>Declare Value :</td>
                                                        <td><input type="text" name="" class="form-control"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" style="width: 212%;">
                                                            <table class="table table-bordered itemBox">
                                                                <thead>
                                                                    <th>Box</th>
                                                                    <th>Weight</th>
                                                                    <th>Box</th>
                                                                    <th>Weight</th>
                                                                    <th>Box</th>
                                                                    <th>Weight</th>
                                                                    <th>Box</th>
                                                                    <th>Weight</th>
                                                                    <th>Box</th>
                                                                    <th>Weight</th>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="width: 7%;padding: 15px 10px 10px 20px;"><b>1</b></td>
                                                                        <td style="width: 7%;"><input type="text" name="boxes[]" class="form-control"></td>
                                                                        <td style="width: 7%;padding: 15px 10px 10px 20px;"><b>2</b></td>
                                                                        <td style="width: 7%;"><input type="text" name="boxes[]" class="form-control"></td>
                                                                        <td style="width: 7%;padding: 15px 10px 10px 20px;"><b>3</b></td>
                                                                        <td style="width: 7%;"><input type="text" name="boxes[]" class="form-control"></td>
                                                                        <td style="width: 7%;padding: 15px 10px 10px 20px;"><b>4</b></td>
                                                                        <td style="width: 7%;"><input type="text" name="boxes[]" class="form-control"></td>
                                                                        <td style="width: 7%;padding: 15px 10px 10px 20px;"><b>5</b></td>
                                                                        <td style="width: 7%;"><input type="text" name="boxes[]" class="form-control"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <table class="table table-bordered">
                                                                <tr>
                                                                    <td style="text-align: right;float: right;">
                                                                        <button type="button" class="btn btn-info" onclick="add_boxes()">Add</button>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td colspan="3">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>TOTAL AMOUNT : </th>
                                                        <td><input type="text" name="order_amount" id="total_amount" class="form-control"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>DOCUMENTS FEES : </th>
                                                        <td><input type="text" name="document_fees" id="document_fees" class="form-control"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>INSURANCE : </th>
                                                        <td><input type="text" name="insurance" id="insurance" class="form-control"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>PACKING CHARGES : </th>
                                                        <td><input type="text" name="packing_charges" id="packing_charges" class="form-control"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>TRANSPORTATION CHARGES : </th>
                                                        <td><input type="text" name="transportation_charges" id="transportation_charges" class="form-control"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>TOTAL VAT : </th>
                                                        <td><input type="text" name="total_vat" id="total_vat" class="form-control"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>GRAND TOTAL : </th>
                                                        <td><input type="text" name="grand_total" id="grand_total" class="form-control"></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">
                                                <div style="float: right;">
                                                    <button type="button" class="btn btn-info" onclick="addRow()">Add Row</button>
                                                    <input type="submit" id="submit" name="submit" value="Save" class="btn btn-info" data-placement="top" data-toggle="tooltip" data-original-title="Save Data">
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="map" style=""></div>
    <br><br><br>
</form>
<script type="text/javascript">
    $(document).ready(function(){
        tracking_number();
    })
    function tracking_number(){
        var branch = "<?= $this->session->userdata('branch_name'); ?>";
        var weight = $('#order_total_weight').val();
        var string = branch + weight;
        $('#order_tracking_number').val(string);
    }
    //invoice js
    var rowNum = 1;
    var rowBox = 5;
    var a = 0;
    function addRow() {
        rowNum ++;
        var row = '<tr id="'+rowNum+'"><td width="6%">'+rowNum+'</td>';
        row += '<td width="17%"><input type="text" class="form-control" id="item_desc'+rowNum+'" name="item_name[]" required="" autocomplete="off"/></td>';
        row += '<td width="15%"><input type="text" class="form-control" id="item_weight'+rowNum+'" name="item_weight[]" onkeyup="total_weight()" required="" autocomplete="off"></td>';
        row += '<td><input type="text" class="form-control" name="item_freight[]" id="item_freight'+rowNum+'"  required="" autocomplete="off" /></td>';
        row += '<td><input type="text" class="form-control" id="item_vat'+rowNum+'" name="item_vat[]" required="" autocomplete="off" /> </td>';
        row += '<td><input type="text" class="form-control" id="item_total'+rowNum+'" name="item_price[]" onkeyup="total()" required="" autocomplete="off" autocomplete="off" /> </td>';
        row += '<td class="text-center"><button type="button" onclick="removeRow(this,'+rowNum+');" style="background: none; border: none;"><i class="fa fa-trash" aria-hidden="true"></i></button></td></tr>';
        $('.itemRows').append(row);
    }
    function add_boxes() {
        rowBox ++;
        console.log(rowBox)
        var row_box = '<tr>';
        row_box += '<td style="width: 7%;padding: 15px 10px 10px 20px;"><b>'+rowBox+'</b></td>';
        row_box += '<td style="width: 7%;"><input type="text" name="boxes[]" class="form-control"></td>';
        rowBox ++;
        row_box += '<td style="width: 7%;padding: 15px 10px 10px 20px;"><b>'+rowBox+'</b></td>';
        row_box += '<td style="width: 7%;"><input type="text" name="boxes[]" class="form-control"></td>';
        rowBox ++;
        row_box += '<td style="width: 7%;padding: 15px 10px 10px 20px;"><b>'+rowBox+'</b></td>';
        row_box += '<td style="width: 7%;"><input type="text" name="boxes[]" class="form-control"></td>';
        rowBox ++;
        row_box += '<td style="width: 7%;padding: 15px 10px 10px 20px;"><b>'+rowBox+'</b></td>';
        row_box += '<td style="width: 7%;"><input type="text" name="boxes[]" class="form-control"></td>';
        rowBox ++;
        row_box += '<td style="width: 7%;padding: 15px 10px 10px 20px;"><b>'+rowBox+'</b></td>';
        row_box += '<td style="width: 7%;"><input type="text" name="boxes[]" class="form-control"></td>';
        row_box += '</tr>';
        $('.itemBox').append(row_box);
    }
    function removeRow(t,contr) {
        var row = $('#newinvoice > tbody > tr').length;
        if (row == 1)
        {
            location.reload(true);
        }
        else
        {
            var e = t.parentNode.parentNode;
            e.parentNode.removeChild(e);
            var counter = 0;
            $('#newinvoice > tbody > tr').each(function(){
                counter++;
                $(this).find("td:nth-child(1)").text(counter)
            })
            total();
            total_weight();
        }
    }
    function total()
    {
        var grandtotal = 0;
        var grandtotal1 =0;
        var rowNum1 = $('#newinvoice tr:last').attr('id');
        for(var j = 0; j <= rowNum1; j++)
        {
            q_total1 = parseInt($("#item_total"+[j]).val());
            if (isNaN(q_total1)) {
            }
            else
            {
                grandtotal1 = grandtotal1 + q_total1;
            }
        }
        grandtotal = grandtotal1;
        // calculate values sum 
        var document_fees = $('#document_fees').val();
        if (isNaN(document_fees) || document_fees == "") {
            document_fees = 0;
        }
        var insurance = $('#insurance').val();
        if (isNaN(insurance) || insurance == "") {
            insurance = 0;
        }
        var packing_charges = $('#packing_charges').val();
        if (isNaN(packing_charges) || packing_charges == "") {
            packing_charges = 0;
        }
        var transportation_charges = $('#transportation_charges').val();
        if (isNaN(transportation_charges) || transportation_charges == "") {
            transportation_charges = 0;
        }
        var total_vat = $('#total_vat').val();
        if (isNaN(total_vat) || total_vat == "") {
            total_vat = 0;
        }
        console.log(document_fees+'document_fees'+insurance+'insurance'+packing_charges+'packing_charges'+transportation_charges+'transportation_charges'+total_vat+'total_vat'+grandtotal+'grandtotal')
        var final = parseInt(document_fees)+parseInt(insurance)+parseInt(packing_charges)+parseInt(transportation_charges)+parseInt(total_vat)+parseInt(grandtotal); 
        $('#total_amount').val('');
        $('#total_amount').val(grandtotal);
        $('#grand_total').val();
        $('#grand_total').val(final);
        tracking_number();
    }
    function total_weight()
    {
        var grandtotal = 0;
        var grandtotal1 =0;
        var rowNum1 = $('#newinvoice tr:last').attr('id');
        for(var j = 0; j <= rowNum1; j++)
        {
            q_total1 = parseInt($("#item_weight"+[j]).val());
            if (isNaN(q_total1)) {
            }
            else
            {
                grandtotal1 = grandtotal1 + q_total1;
            }
        }
        grandtotal = grandtotal1;
        $('#order_total_weight').val('');
        $('#order_total_weight').val(grandtotal);
        tracking_number();
    }

    $(document).on('keyup','#document_fees, #insurance, #packing_charges, #transportation_charges, #total_vat',function(){
        total();
    })

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
/*if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position){
        console.log(position);
        $.get( "https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyAmqmsf3pVEVUoGAmwerePWzjUClvYUtwM&latlng="+ position.coords.latitude + "," + position.coords.longitude +"&sensor=false", function(data) {
            console.log(data.results[0]);
            var _formated_address = data.results[0].formatted_address;
            var _location_lat = data.results[0].geometry.location.lat;
            var _location_lng = data.results[0].geometry.location.lng;
            if (typeof _formated_address !== 'undefined' && typeof _location_lat !== 'undefined' && typeof _location_lng !== 'undefined') {
                $('#destination').val(_formated_address);
                $('#order_destination_latitude').val(_location_lat);
                $('#order_destination_longitude').val(_location_lng);
                console.log('Location found');
                default_lat = _location_lat;
                default_lng = _location_lng;
                initMap();
            }
        })
    });
}*/

function initMap() {
    initMap1();
    initMap2();
    initMap3();
}
function initMap1() {
    geocoder = new google.maps.Geocoder();
    adr = document.getElementById('destination').value;
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
    var input = document.getElementById('destination');
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
                    alert(marker.getPosition().lat())
                    $('#order_destination_latitude').val(marker.getPosition().lat());
                    $('#order_destination_longitude').val(marker.getPosition().lng());
                    $.each(results[0].address_components, function(index, obj) {
                        if (obj.types[0] == 'country') {
                            $("#store_country").val(obj.long_name);
                        }
                    });
                    $('#destination').val(results[0].formatted_address);
                }
            }
        });
    });
}
function initMap2() {
    geocoder = new google.maps.Geocoder();
    adr = document.getElementById('shipper_address').value;
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
    var input = document.getElementById('shipper_address');
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
                    alert(marker.getPosition().lat())
                    $('#shipper_address_lat').val(marker.getPosition().lat());
                    $('#shipper_address_long').val(marker.getPosition().lng());
                    $.each(results[0].address_components, function(index, obj) {
                        if (obj.types[0] == 'country') {
                            $("#store_country").val(obj.long_name);
                        }
                    });
                    $('#shipper_address').val(results[0].formatted_address);
                }
            }
        });
    });
}
function initMap3() {
    geocoder = new google.maps.Geocoder();
    adr = document.getElementById('reciever_address').value;
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
    var input = document.getElementById('reciever_address');
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
                    alert(marker.getPosition().lat())
                    $('#reciever_address_lat').val(marker.getPosition().lat());
                    $('#reciever_address_long').val(marker.getPosition().lng());
                    $.each(results[0].address_components, function(index, obj) {
                        if (obj.types[0] == 'country') {
                            $("#store_country").val(obj.long_name);
                        }
                    });
                    $('#reciever_address').val(results[0].formatted_address);
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
function codeAddress1() {
    setTimeout(function(){
        marker.setMap(null);
        $('#pro_lat').default_lat;
        $('#pro_lng').default_lng;
        var address = document.getElementById('destination').value;

        geocoder.geocode({
            'address': address
        }, function(results, status) {

            if (status == google.maps.GeocoderStatus.OK) {

                var position = results[0].geometry.location;
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();


                $('#order_destination_latitude').val(latitude);
                    // $('#pro_lat+label').css('display','none');
                    $('#order_destination_longitude').val(longitude);
                    // $('#pro_lng+label').css('display','none');
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                    return false;
                }

            });
    },1000);
    return false;
} 
function codeAddress2() {
    setTimeout(function(){
        marker.setMap(null);
        $('#shipper_address_lat').default_lat;
        $('#shipper_address_long').default_lng;
        var address = document.getElementById('destination').value;

        geocoder.geocode({
            'address': address
        }, function(results, status) {

            if (status == google.maps.GeocoderStatus.OK) {

                var position = results[0].geometry.location;
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();


                $('#shipper_address_lat').val(latitude);
                    // $('#shipper_address_lat+label').css('display','none');
                    $('#shipper_address_long').val(longitude);
                    // $('#shipper_address_long+label').css('display','none');
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                    return false;
                }

            });
    },1000);
    return false;
}
function codeAddress3() {
    setTimeout(function(){
        marker.setMap(null);
        $('#reciever_address_lat').default_lat;
        $('#reciever_address_long').default_lng;
        var address = document.getElementById('reciever_address').value;

        geocoder.geocode({
            'address': address
        }, function(results, status) {

            if (status == google.maps.GeocoderStatus.OK) {

                var position = results[0].geometry.location;
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();


                $('#reciever_address_lat').val(latitude);
                    // $('#reciever_address_lat+label').css('display','none');
                    $('#reciever_address_long').val(longitude);
                    // $('#reciever_address_long+label').css('display','none');
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                    return false;
                }

            });
    },1000);
    return false;
} 

</script>
<script async defer    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmqmsf3pVEVUoGAmwerePWzjUClvYUtwM&libraries=geometry,places&callback=initMap"></script>

