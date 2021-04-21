<?php                                                                          
$this->load->helper('common_helper');

$_SESSION['LOGIN_PAGE_BRAND_LOGO']= global_constants('LOGIN_PAGE_BRAND_LOGO');

$logo_desktop = $_SESSION['LOGIN_PAGE_BRAND_LOGO'];

$title = $_SESSION['SITE_TITLE'] = global_constants('SITE_TITLE');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php echo $title; ?></title> 
        <meta name="description" content="Cargo">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
        <!--begin::Web font -->
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
        <script>
            WebFont.load({
                google: {
                    "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700", "Asap+Condensed:500"]
                },
                active: function() {
                    sessionStorage.fonts = true;
                }
            });
        </script>
        <!--end::Web font -->
        
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/themes/siegedata/default/css/vendors.bundle.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/themes/siegedata/default/css/style.bundle.css" />
		
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/themes/siegedata/app/css/siegedata.css" />
		
        <link rel="shortcut icon" href="<?= base_url(); ?>themes/siegedata/demo10/demo/media/img/logo/favicon.ico" />
        <script type="text/javascript" src="https://clientportal.azureedge.net/webasset/js/jquery.min.js"></script>

<script src="https://clientportal.azureedge.net/webasset/themes/vendors/jquery-validation/js/jquery.validate.min.js"></script>
        <!-- Making ready functions to run after jquery load -->

        <script>(function(w, d, u) {
                w.readyQ = [];
                w.bindReadyQ = [];
                function p(x, y) {
                    if (x == "ready") {
                        w.bindReadyQ.push(y);
                    } else {
                        w.readyQ.push(x);
                    }
                }
                ;
                var a = {ready: p, bind: p};
                w.$ = w.jQuery = function(f) {
                    if (f === d || f === u) {
                        return a
                    } else {
                        p(f)
                    }
                }
            })(window, document)</script>

        <!-- Making ready functions to run after jquery load -->


        <!-- END Page lavel cs -->

    </head>
    <body  class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >

        <!-- begin:: Page -->
        <div class="m-grid m-grid--hor m-grid--root m-page">
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile m-login m-login--1 m-login--signin" id="m_login">
                <div class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1	m-login__content m-grid-item--center login_page" style="background-image: url(<?php echo base_url() ?>assets/themes/siegedata/app/media/img/bg/bg-4.jpg)">
                    <div class="m-grid__item" style="padding:20px;">
                        <div class="m-login__logo text-center"> <img alt="" src="<?php echo base_url().$logo_desktop; ?>" />  </div>
						
                        <h3 class="m-login__welcome text-center" style='font-size:20px;margin-top:40px;'><?php echo $title; ?></h3>
						
                    </div>
                </div>
                <div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
                    <div class="m-stack m-stack--hor m-stack--desktop">
                        <div class="m-stack__item m-stack__item--fluid">
                            <div class="m-login__wrapper">
                                <div class="m-login__logo"> <img alt="" src="<?php echo base_url().$logo_desktop; ?>" style='width:150px;'/> </div>
								
								<!--
                                <div class="m-login__head">
                                    <h3 class="m-login__title">ECS Customer Portal</h3>
                                </div>
								-->
								
								<?php if(isset($message)) { ?>
									<div class="alert alert-danger"> <?php echo $message; ?> </div>
								<?php }?>
                               <?php if(isset($message1) && $message1 !='') { ?>
                                    <div class="alert alert-success"> <?php echo $message1; ?> </div>
                                <?php  } ?>

                                <div class="m-login__signin">
                                    <form id="Users" method="post" class="login-form m-login__form m-form" onsubmit="return check_validations();">
                                        <dl class="zend_form">
                                           
                                            <dt id="Username-label">&#160;</dt>
                                            <div class="form-group m-form__group">

                                                <input class="validate[required] form-control m-input" id="username" name="username" type="text" required="required" placeholder="Full Name" value="<?php echo set_value('username'); ?>" />
                                                <span class="fieldError" style="color: red;"><?php echo form_error('username'); ?></span>
                                            </div>
                                            <dt id="Username-label">&#160;</dt>
                                            <div class="form-group m-form__group">
                                               
                                                <input class="validate[required] form-control m-input" id="email" name="email" type="email" required="required" placeholder="Email" value="<?php echo set_value('email'); ?>"/>
                                                <span class="fieldError" style="color: red;"><?php echo form_error('email'); ?></span>

                                            </div>
                                            <dt id="Username-label">&#160;</dt>
                                            <div class="form-group m-form__group">
                                                <input type="text" class="validate[required] form-control" id="phone" name="phone" maxlength="100" placeholder="Enter Phone" onkeypress="return regex_check()" required  value="<?php echo set_value('phone'); ?>" autocomplete="off" />
                                                <!-- <input class="form-control m-input" id="phone" name="phone" type="text" required="required" placeholder="Phone"  /> -->
                                                <span class="fieldError" style="color: red;"><?php echo form_error('phone'); ?></span>
                                                <span class="phone-error" style="display: none; color: red;">Phone number is not valid. i.e +(country code)(phone number) i.e +92123456789</span>
                                            </div>
                                            <dt id="Userpass-label">&#160;</dt>
                                            <div class="form-group m-form__group">
                                                
                                                <input class="form-control m-input" id="password" name="password" type="password" required="password" placeholder="Password" value="<?php echo set_value('phone'); ?>"  >
                                                <span class="fieldError" style="color: red;"><?php echo form_error('password'); ?></span>

                                            </div>
                                            <div class="m-login__form-action">
                                                <dt id="submit-label">&#160;</dt>
                                                <dd id="submit-element">
                                                    <input type="submit" name="submit" id="btnSubmit" value="Register" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air" />
                                                </dd>
                                            </div>
                                        </dl>
                                    </form>
                                 
                                </div>
                           
                       
                                 <p class='text-center'>Already a member? <a href="<?=base_url();?>">Login. </a> </p>
                                <p class='text-center'>Powered by Scatter-Systems Pty. Ltd. © 2020 All Rights Reserved.  </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Page --> 
        <!--begin::Base Scripts -->
        
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/themes/siegedata/default/js/vendors.bundle.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/themes/siegedata/default/js/scripts.bundle.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/themes/siegedata/default/js/login.js"></script>

        <!--end::Base Scripts -->

        <!--begin::Page Vendors Scripts -->
  		
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/themes/vendors/jquery-ui/jquery-ui.bundle.js"></script>


        <!--end::Page Vendors Scripts -->

        <!--begin::Page Snippets -->

        <script>
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
		$(document).ready(function() {
		
		$.validator.addMethod("emailExt", function(value, element, param) {
				return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
			},'Please enter a valid email address.');

					 $('#forgotform').validate({// initialize the plugin
						rules: {
						   
							inputEmail: {
							   required: true,
							   emailExt: true
							}
						}
					});	 
					
					$('#User').validate({// initialize the plugin
						rules: {
						   
							username: {
							   required: true,
							   emailExt: true
							}
						}
					});
				});
	
			(function($, d) {
				$.each(readyQ, function(i, f) {
					$(f)
				});
				$.each(bindReadyQ, function(i, f) {
					$(d).bind("ready", f)
				})
			})(jQuery, document)
	
			$(window).on('load', function() {
				$('body').removeClass('m-page--loading');
			});

        </script>

        <!-- end::Page Loader -->
    </body>
</html>	