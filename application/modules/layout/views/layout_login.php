<?php                                                                          
$this->load->helper('common_helper');

$_SESSION['LOGIN_PAGE_BRAND_LOGO']= global_constants('LOGIN_PAGE_BRAND_LOGO');

$logo_desktop = $_SESSION['LOGIN_PAGE_BRAND_LOGO'];

$title = $_SESSION['SITE_TITLE'] = global_constants('SITE_TITLE');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Neon Admin Panel" />
    <meta name="author" content="" />
    <link rel="icon" href="assets/images/favicon.ico">
    <title>Cargo | Login</title>
    <link rel="stylesheet" href="<?=base_url();?>assets/admin/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/admin/assets/css/font-icons/entypo/css/entypo.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="<?=base_url();?>assets/admin/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/admin/assets/css/neon-core.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/admin/assets/css/neon-theme.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/admin/assets/css/neon-forms.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/admin/assets/css/custom.css">
    <script src="<?=base_url();?>assets/admin/assets/js/jquery-1.11.3.min.js"></script>

</head>
<body class="page-body login-page login-form-fall" data-url="http://neon.dev">
<!-- This is needed when you send requests via Ajax -->
<script type="text/javascript">
var baseurl = '';
</script>

<div class="login-container">   
    <div class="login-header login-caret">       
        <div class="login-content">           
            <a href="#" class="logo">
                <img src="<?=base_url();?>assets/admin/assets/images/logo@2x.png" width="120" alt="" />
            </a>
            <p class="description">Dear user, log in to access the admin area!</p>          
            <!-- progress bar indicator -->
            <div class="login-progressbar-indicator">
                <h3>43%</h3>
                <span>logging in...</span>
            </div>
        </div>       
    </div>    
    <div class="login-progressbar">
        <div></div>
    </div>   
    <div class="login-form">    
        <div class="login-content">
            <?php if(isset($success)) { ?>
                <div class="alert alert-success" style="font-size: 15px;"> <?php echo $success; ?> </div>
            <?php }?>
           <?php if(isset($error) && $error !='') { ?>
                <div class="alert alert-danger" style="font-size: 15px;"> <?php echo $error; ?> </div>
            <?php  } ?>
            <form method="post" role="form" action="<?=base_url('login');?>">               
                <div class="form-group">                    
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="entypo-user"></i>
                        </div>
                        <input class="form-control" id="username" name="username" type="email" required="required" placeholder="Username" value="<?php echo $this->input->cookie('cp_username'); ?>" />
                    </div>                   
                </div>              
                <div class="form-group">                    
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="entypo-key"></i>
                        </div>
                         <input class="form-control m-input" id="password" name="password" type="password" required="required" placeholder="Password" value="<?php echo $this->input->cookie('cp_password'); ?>">                     
                    </div>              
                </div>            
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-primary btn-block btn-login" value="Login">
                    
                </div>                
            </form>     

        </div>      
    </div>  
        <p class='text-center'>Powered by Cargo. Ltd. © 2021 All Rights Reserved.  </p>

</div>


    <!-- Bottom scripts (common) -->
    <script src="<?=base_url();?>assets/admin/assets/js/gsap/TweenMax.min.js"></script>
    <script src="<?=base_url();?>assets/admin/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
    <script src="<?=base_url();?>assets/admin/assets/js/bootstrap.js"></script>
    <script src="<?=base_url();?>assets/admin/assets/js/joinable.js"></script>
    <script src="<?=base_url();?>assets/admin/assets/js/resizeable.js"></script>
    <script src="<?=base_url();?>assets/admin/assets/js/neon-api.js"></script>
    <script src="<?=base_url();?>assets/admin/assets/js/jquery.validate.min.js"></script>
    <script src="<?=base_url();?>assets/admin/assets/js/neon-login.js"></script>
    <!-- JavaScripts initializations and stuff -->
    <script src="<?=base_url();?>assets/admin/assets/js/neon-custom.js"></script>
    <!-- Demo Settings -->
    <script src="<?=base_url();?>assets/admin/assets/js/neon-demo.js"></script>

</body>
</html>