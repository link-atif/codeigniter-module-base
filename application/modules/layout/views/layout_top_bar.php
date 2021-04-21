<div class="main-content">
    <div class="row">
      <!-- Profile Info and Notifications -->
      <div class="col-md-6 col-sm-8 clearfix">
        <ul class="user-info pull-left pull-none-xsm">
          <!-- Profile Info -->
          <li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?=base_url();?>assets/admin/assets/images/thumb-1@2x.png" alt="" class="img-circle" width="44" />
          admin </a>         
      </li>    
  </ul> 
</div>
<!-- Raw Links -->
<div class="col-md-6 col-sm-4 clearfix hidden-xs">

    <ul class="list-inline links-list pull-right">

      <li>
        <a href="javascript:" onclick="getProfileDataLoggedInUser(<?= $this->session->userdata('user_id') ?>);">
          Profile <i class="entypo-users"></i>
      </a>
  </li>
  <li>
    <a href="<?=base_url('logout');?>">
      Log Out <i class="entypo-logout right"></i>
  </a>
</li>
</ul>

</div>

<div class="row" style="display: none;">
  <div class="col-sm-8">

    <div class="panel panel-primary" id="charts_env">

      <div class="panel-heading">
        <div class="panel-title">Site Stats</div>
        
        <div class="panel-options">
          <ul class="nav nav-tabs">
            <li class=""><a href="#area-chart" data-toggle="tab">Area Chart</a></li>
            <li class="active"><a href="#line-chart" data-toggle="tab">Line Charts</a></li>
            <li class=""><a href="#pie-chart" data-toggle="tab">Pie Chart</a></li>
        </ul>
    </div>
</div>

<div class="panel-body">

    <div class="tab-content">

      <div class="tab-pane" id="area-chart">
        <div id="area-chart-demo" class="morrischart" style="height: 300px"></div>
    </div>
    
    <div class="tab-pane active" id="line-chart">
        <div id="line-chart-demo" class="morrischart" style="height: 300px"></div>
    </div>
    
    <div class="tab-pane" id="pie-chart">
        <div id="donut-chart-demo" class="morrischart" style="height: 300px;"></div>
    </div>
    
</div>

</div>

<table class="table table-bordered table-responsive">

    <thead>
      <tr>
        <th width="50%" class="col-padding-1">
          <div class="pull-left">
            <div class="h4 no-margin">Pageviews</div>
            <small>54,127</small>
        </div>
        <span class="pull-right pageviews">4,3,5,4,5,6,5</span>
        
    </th>
    <th width="50%" class="col-padding-1">
      <div class="pull-left">
        <div class="h4 no-margin">Unique Visitors</div>
        <small>25,127</small>
    </div>
    <span class="pull-right uniquevisitors">2,3,5,4,3,4,5</span>
</th>
</tr>
</thead>

</table>

</div>

</div>

<div class="col-sm-4">

    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="panel-title">
          <h4>
            Real Time Stats
            <br />
            <small>current server uptime</small>
        </h4>
    </div>
    
    <div class="panel-options">
      <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
      <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
      <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
      <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
  </div>
</div>

<div class="panel-body no-padding">
    <div id="rickshaw-chart-demo">
      <div id="rickshaw-legend"></div>
  </div>
</div>
</div>

</div>
</div>
</div>  
<style type="text/css">
    .form-horizontal .form-group{
        margin-left: 0px; 
        margin-right: 0px;
    }
</style>
<div id="add_edit_setup_codes_modal_for_loginuser_two" class="modal fade in" style="display: none;">
    <div class="modal-dialog modal-lg" id="editdata-modal"> 
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Update Profile</h4>
            </div>
            <div class="alert alert-danger" role="alert" id="mandatory_alert" style="display:none;"></div>
            <form action="<?php echo base_url('save_profile_info'); ?>" class="form-horizontal" id="setup_codes_form" method="post" enctype="multipart/form-data" autocomplete="false">
                <div class="modal-body">
                    <div class="row"> 
                        <div class="col-md-6"> 
                            <div class="form-group"> 
                                <label for="name" class="control-label">Name<span class="required">*</span></label> 
                                <input type="text" onkeypress="return onlyAlphabets(event,this);" class="form-control note_no name"  name="name" placeholder="Enter Name" maxlength="255" required>
                            </div> 
                        </div>
                        <div class="col-md-6"> 
                            <div class="form-group"> 
                                <label for="name" class="control-label">Email <span class="required">*</span></label> 
                                <input type="email"  class="form-control note_no user_email"  name="email" maxlength="255" required>
                            </div> 
                        </div> 
                    </div>
                    <div class="row"> 
                        <div class="col-md-6"> 
                            <div class="form-group"> 
                                <label for="phone" class="control-label">Phone <span class="required">*</span></label> 
                                <input type="text" class="form-control note_no phone"  name="phone" placeholder="Enter Phone" maxlength="255" required>
                            </div> 
                        </div> 
                        <div class="col-md-6"> 
                            <div class="form-group"> 
                                <label for="name" class="control-label">New Password</label> 
                                <input type="password"  class="form-control note_no new_password"  name="new_password" maxlength="255" autocomplete="new-password">
                            </div> 
                        </div> 
                    </div>
                    <div class="row"> 
                        <div class="col-md-6"> 
                            <div class="form-group"> 
                                <label for="phone" class="control-label">Address <span class="required">*</span></label> 
                                <input type="text" class="form-control note_no address" name="address" placeholder="Enter Address" maxlength="255" required>
                            </div> 
                        </div>
                    </div>
                    <div class="row"> 
                        <input type="hidden" name="user_role" class= "user_role">
                        <div class="col-md-6"> 
                            <div class="form-group"> 
                                <label for="phone" class="control-label">User Type </label> 
                                <div class="usertype"></div>
                            </div> 
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-md-6"> 
                            <div class="form-group"> 
                                <label for="name" class="control-label">Image <span class="required">*</span></label> 
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            </div> 
                        </div>
                        <div class="col-md-6 image_src1"> 
                            <div class="form-group"> 
                                <img width="200" height="200" class="src1" src="">
                            </div> 
                        </div> 
                    </div>
                </div> 
                <div class="modal-footer"> 
                    <input type="hidden" id="user_id" class="user_id" name="user_id" value="" />
                    <input type="hidden" id="current_url" class="current_url" name="current_url" value="<?= current_url() ?>" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
                    <button type="submit" class="btn btn-primary">Update</button>
                    <!-- <button class="btn btn-danger" type="reset">Reset</button> -->
                </div> 

            </form>
        </div>

    </div>
</div>
<hr />
<script type="text/javascript">
    jQuery(document).ready(function($)
    {
      // Sample Toastr Notification
      setTimeout(function()
      {
        var opts = {
          "closeButton": true,
          "debug": false,
          "positionClass": rtl() || public_vars.$pageContainer.hasClass('right-sidebar') ? "toast-top-left" : "toast-top-right",
          "toastClass": "black",
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "5000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
      };
      
  //     toastr.success("You have been awarded with 1 year free subscription. Enjoy it!", "Account Subcription Updated", opts);
  // }, 3000);


      // Sparkline Charts
      $('.inlinebar').sparkline('html', {type: 'bar', barColor: '#ff6264'} );
      $('.inlinebar-2').sparkline('html', {type: 'bar', barColor: '#445982'} );
      $('.inlinebar-3').sparkline('html', {type: 'bar', barColor: '#00b19d'} );
      $('.bar').sparkline([ [1,4], [2, 3], [3, 2], [4, 1] ], { type: 'bar' });
      $('.pie').sparkline('html', {type: 'pie',borderWidth: 0, sliceColors: ['#3d4554', '#ee4749','#00b19d']});
      $('.linechart').sparkline();
      $('.pageviews').sparkline('html', {type: 'bar', height: '30px', barColor: '#ff6264'} );
      $('.uniquevisitors').sparkline('html', {type: 'bar', height: '30px', barColor: '#00b19d'} );
      
      
      $(".monthly-sales").sparkline([1,2,3,5,6,7,2,3,3,4,3,5,7,2,4,3,5,4,5,6,3,2], {
        type: 'bar',
        barColor: '#485671',
        height: '80px',
        barWidth: 10,
        barSpacing: 2
    });
      
      
      // JVector Maps
      var map = $("#map");
      
      map.vectorMap({
        map: 'europe_merc_en',
        zoomMin: '3',
        backgroundColor: '#383f47',
        focusOn: { x: 0.5, y: 0.8, scale: 3 }
    });
      
      
      
      // Line Charts
      var line_chart_demo = $("#line-chart-demo");
      
      var line_chart = Morris.Line({
        element: 'line-chart-demo',
        data: [
        { y: '2006', a: 100, b: 90 },
        { y: '2007', a: 75,  b: 65 },
        { y: '2008', a: 50,  b: 40 },
        { y: '2009', a: 75,  b: 65 },
        { y: '2010', a: 50,  b: 40 },
        { y: '2011', a: 75,  b: 65 },
        { y: '2012', a: 100, b: 90 }
        ],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['October 2013', 'November 2013'],
        redraw: true
    });
      
      line_chart_demo.parent().attr('style', '');
      
      
      // Donut Chart
      var donut_chart_demo = $("#donut-chart-demo");
      
      donut_chart_demo.parent().show();
      
      var donut_chart = Morris.Donut({
        element: 'donut-chart-demo',
        data: [
        {label: "Download Sales", value: getRandomInt(10,50)},
        {label: "In-Store Sales", value: getRandomInt(10,50)},
        {label: "Mail-Order Sales", value: getRandomInt(10,50)}
        ],
        colors: ['#707f9b', '#455064', '#242d3c']
    });
      
      donut_chart_demo.parent().attr('style', '');
      
      
      // Area Chart
      var area_chart_demo = $("#area-chart-demo");
      
      area_chart_demo.parent().show();
      
      var area_chart = Morris.Area({
        element: 'area-chart-demo',
        data: [
        { y: '2006', a: 100, b: 90 },
        { y: '2007', a: 75,  b: 65 },
        { y: '2008', a: 50,  b: 40 },
        { y: '2009', a: 75,  b: 65 },
        { y: '2010', a: 50,  b: 40 },
        { y: '2011', a: 75,  b: 65 },
        { y: '2012', a: 100, b: 90 }
        ],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Series A', 'Series B'],
        lineColors: ['#303641', '#576277']
    });
      
      area_chart_demo.parent().attr('style', '');
      
      
      
      
      // Rickshaw
      var seriesData = [ [], [] ];
      
      var random = new Rickshaw.Fixtures.RandomData(50);
      
      for (var i = 0; i < 50; i++)
      {
        random.addData(seriesData);
    }
    
    var graph = new Rickshaw.Graph( {
        element: document.getElementById("rickshaw-chart-demo"),
        height: 193,
        renderer: 'area',
        stroke: false,
        preserve: true,
        series: [{
            color: '#73c8ff',
            data: seriesData[0],
            name: 'Upload'
        }, {
            color: '#e0f2ff',
            data: seriesData[1],
            name: 'Download'
        }
        ]
    } );
    
    graph.render();
    
    var hoverDetail = new Rickshaw.Graph.HoverDetail( {
        graph: graph,
        xFormatter: function(x) {
          return new Date(x * 1000).toString();
      }
  } );
    
    var legend = new Rickshaw.Graph.Legend( {
        graph: graph,
        element: document.getElementById('rickshaw-legend')
    } );
    
    var highlighter = new Rickshaw.Graph.Behavior.Series.Highlight( {
        graph: graph,
        legend: legend
    } );
    
    setInterval( function() {
        random.removeData(seriesData);
        random.addData(seriesData);
        graph.update();
        
    }, 500 );
});


function getRandomInt(min, max)
{
  return Math.floor(Math.random() * (max - min + 1)) + min;
}
</script>

<?php
if ($this->session->userdata('success') != "") {
    $msg =  $this->session->userdata('success'); ?>
    <script type="text/javascript">
        $(document).ready(function(){
            toastr.success("<?= $msg ?>");
        });
    </script>
<?php } else if($this->session->userdata('error') != ""){
    $msg =  $this->session->userdata('error'); 
    ?>
    <script type="text/javascript">
        $(document).ready(function(){
            toastr.error("<?= $msg ?>");
        });
    </script>
<?php }
?>



<script type="text/javascript">
    function getProfileDataLoggedInUser(id = "")
    {
        $.ajax({
            url: '<?php echo site_url('get_profile_info'); ?>' + '/' + id,
            type: 'POST',
            data: {id: id},
            success: function(response)
            {
                console.log(response)
                var dataArray = jQuery.parseJSON(response);
                var html = "";
                if(typeof dataArray[0].group_id != 'undefined'){
                    group_id_one = dataArray[0].group_id;
                }else{
                    group_id_one = "";
                }

                if(typeof dataArray[1].group_id != 'undefined' ){

                    group_id_two = dataArray[1].group_id;
                }else{
                    group_id_two = "";
                }

                if(group_id_one != ""){
                    if(group_id_one == 1){
                       var group_name = 'Admin';
                   }else if(group_id_one == 2){
                       var group_name = 'Member';
                   }else if(group_id_one == 3){
                       var group_name = 'Corporate User';
                   }else if(group_id_one == 4){
                       var group_name = 'Corporate';
                   }else if(group_id_one == 5){
                       var group_name = 'Courier';
                   }
                   html += '<span class="btn btn-default" style="cursor: pointer !important;">'+group_name+'</span> &nbsp;&nbsp;';
               }
               if(group_id_two != ""){
                if(group_id_two == 1){
                   var group_name = 'Admin';
               }else if(group_id_two == 2){
                   var group_name = 'Member';
               }else if(group_id_two == 3){
                   var group_name = 'Corporate User';
               }else if(group_id_two == 4){
                   var group_name = 'Corporate';
               }else if(group_id_two == 5){
                   var group_name = 'Courier';
               }
               html += '<span class="btn btn-default" style="cursor: pointer !important;">'+group_name+'</span> &nbsp;&nbsp;';
           }
           $('.usertype').html(html);                
           $('.user_id').val(dataArray.id);
           $('.name').val(dataArray.username);
           $('.phone').val(dataArray.phone);
           $('.address').val(dataArray.address);
           $('.user_email').val(dataArray.email);

           if(dataArray.image !=""){
            $('.image_src1').show();
            var src1 = '<?php echo base_url('assets/profile_pics/') ?>' + dataArray.image;        
            $('.src1').attr('src', src1);
        }
        $('.edit-reset').attr("id", dataArray.id);
        $('.edit-reset').attr("onclick", "getData(this.id);");
        $('#add_edit_setup_codes_modal_for_loginuser_two').modal('show');
        console.log(group_id_one);
        console.log(group_id_two);
    }
});


    }
</script>