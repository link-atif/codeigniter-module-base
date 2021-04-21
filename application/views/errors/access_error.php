<div class="m-portlet m-portlet--primary m-portlet--head-solid-bg m-content">
	<div class="m-portlet__head">
		<div class="m-portlet__head-caption">
			<div class="m-portlet__head-title">
				<h3 class="m-portlet__head-text"> <?php if(isset($title)) { echo $title; } ?> </h3>
			</div>
		</div>
		
	</div>
	<div class="m-portlet__body ">
		<h5>Access Denied.</h5>
	</div>
	
</div>

  
<style>
	#setup_link { display:none !important; }
</style>

 
 <script>
$(document).ready(function()
{
	
	
	$("#tab-dashboard").addClass('m-menu__item--hover');
	
	$(".user-box").click(function(e){
		$("#dropdownmenu").toggle();
	});
	
	 $('.navbar-custom').click(function(e) {
		$("#dropdownmenu").hide();
	}); 	 
	
	$('.content').click(function(e) {
		$("#dropdownmenu").hide();
	}); 
});
 </script>