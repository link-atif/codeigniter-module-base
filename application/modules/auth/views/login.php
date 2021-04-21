<?php $base_url = base_url(); ?>
<!DOCTYPE html>
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Screen Login </title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo $base_url?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $base_url?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $base_url?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $base_url?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo $base_url?>assets/global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $base_url?>assets/admin/pages/css/login-soft.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo $base_url?>assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo $base_url?>assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $base_url?>assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="<?php echo $base_url?>assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $base_url?>assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
  <div class="authentication-wrapper authentication-1 px-4">
    <div class="authentication-inner py-3">

      <!-- [ Logo ] Start -->
      <div class="d-flex justify-content-center align-items-center">
        <div class="ui-w-140">
          <div class="w-100 position-relative">
            <img src="<?=base_url();?>assets/img/athtra-logo2.png" alt="Brand Logo" class="img-fluid">
          </div>
        </div>
      </div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">
	<!-- BEGIN LOGIN FORM -->
	<form class="login-form" action="<?php echo base_url()?>auth/login" method="post">
	<?php //echo form_open("auth/login");?>
  <br>
		<h3 class="form-title">Login to your account</h3>
    <?php if($message!='' || $message_success!=''){   ?>
		<div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span>
			Enter any username and password. </span>
				<?php if(isset($message_success)){?>
				<div id="infoMessage" class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<?php echo $message_success;?>
				</div>
				<?php   }   ?>
				<?php if(isset($message)){   ?>
				<div id="infoMessage" class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<?php echo $message;?>
				</div>
				<?php   }   ?>
		</div>
    <?php }?>
        <div class="form-group">
          <label class="form-label">Email</label>
          <input type="text" class="form-control" name="identity" placeholder="Username / Email">
          <div class="clearfix"></div>
        </div>
        <div class="form-group">
          <label class="form-label d-flex justify-content-between align-items-end">
            <span>Password</span>
          </label>
          <input type="password" name="password" class="form-control">
          <div class="clearfix"></div>
        </div>
        <div class="d-flex justify-content-between align-items-center m-0">
          <label class="custom-control custom-checkbox m-0 m_15">
            <input type="checkbox" class="custom-control-input">
            <span class="custom-control-label">Remember me</span>
          </label>
          <button type="submit" class="btn btn-primary">Sign In</button>
        </div>
        <a href="<?php echo base_url()?>auth/forgot_password" class="d-block small m_10">Forgot password?</a>
      		
	</form>
	
</div>

<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="../../../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="../../../assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="../../../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../../../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="../../../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="../../../assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="../../../assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="../../../assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../../../assets/global/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="../../../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../../../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="../../../assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="../../../assets/admin/pages/scripts/login-soft.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {     
  Metronic.init(); // init metronic core components
Layout.init(); // init current layout
  Login.init();
  Demo.init();
       // init background slide images
       $.backstretch([
        "../../../assets/admin/pages/media/bg/1.jpg",
        "../../../assets/admin/pages/media/bg/2.jpg",
        "../../../assets/admin/pages/media/bg/3.jpg",
        "../../../assets/admin/pages/media/bg/4.jpg"
        ], {
          fade: 1000,
          duration: 8000
    }
    );
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
