<div class="authentication-wrapper authentication-2 px-4">
	<div class="authentication-inner py-5">
		<form class="card" action="<?php echo base_url()?>auth/forgot_password" method="post">
      		<div class="p-4 p-sm-5">
	        <!-- [ Logo ] Start -->
	        <div class="d-flex justify-content-center align-items-center pb-2 mb-4">
	          <div class="ui-w-140">
	            <div class="w-100 position-relative">
	              <img src="<?php echo base_url(); ?>assets/img/athtra-logo2.png" alt="Brand Logo" class="img-fluid">
	              <div class="clearfix"></div>
	            </div>
	          </div>
	        </div>
	        <!-- [ Logo ] End -->
	        <h5 class="text-center text-muted font-weight-normal mb-4">Reset Your Password</h5>
	        <hr class="mt-0 mb-4">
	        <div id="infoMessage"><?php echo $message;?></div>
	        <p>Enter your username and we will send you n OTP to reset your password.</p>
	        <div class="form-group">
	          <input type="text" class="form-control" name="email" placeholder="Enter your username">
	          <div class="clearfix"></div>
	        </div>
	        <button type="submit" class="btn btn-primary btn-block">Send Email </button>
	      </div>
	    </form>
	</div>
</div>