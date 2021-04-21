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
                <div class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1  m-login__content m-grid-item--center login_page" style="background-image: url(<?php echo base_url() ?>assets/themes/siegedata/app/media/img/bg/bg-4.jpg)">
                    <div class="m-grid__item" style="padding:20px;">
                        <div class="m-login__logo text-center"> <img alt="" src="<?php echo base_url().$logo_desktop; ?>" />  </div>
                        
                        <h3 class="m-login__welcome text-center" style='font-size:20px;margin-top:40px;'><?php echo $title; ?></h3>
                        
                        <!--
                        <p class="m-login__msg "> ECS Services Pty Ltd was established in 1998 by the founder Raj Masson from his garage at his personal residence in NSW. </p>
                        <p class="m-login__msg "> Since these humble beginnings, ECS Services has grown considerably with our Head Office situated in Castle Hill and satellite offices in Qld, VIC, India and Indonesia. Now with over 80 employees and operating from each of these locations, ECS Services is capable of servicing our valued clients right across the entire Eastern Seaboard of Australia, across all of both Indonesia and India.. </p>
                        <p class="m-login__msg "> Contact ECS Services Pty Ltd for more details. </p>
                        -->
                        
                    </div>
                </div>
                 <div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
                    <div class="m-stack m-stack--hor m-stack--desktop">
                        <div class="m-stack__item m-stack__item--fluid">
                            <div class="m-login__wrapper">
                                <div class="m-login__logo"> <img alt="" src="<?php echo $logo_desktop; ?>" style='width:150px;'/> </div>
                                <div class="m-login__head">
                                    <h3 class="m-login__title"><?php echo $title;  ?></h3>
                                </div>
                                
                                <div class="m-login__forget-password1">
                                    <div class="m-login__head">
                                        <h3 class="m-login__title">Forgotten Password ?</h3>
                                        <div class="m-login__desc">Enter your email to reset your password:</div>
                                    </div>

                                    <?php if(isset($message)) { ?>
                                        <div class="alert alert-danger"> <?php echo $message; ?> </div>
                                    <?php } ?>

                                    <form class="m-login__form m-form" name="forgotform" id='forgotform' action='<?php echo site_url('home/forgotPass'); ?>' method="post">
                                        <div class="form-group m-form__group">
                                            <input class="form-control m-input" type="email" placeholder="Enter Email Address" name="inputEmail" id="inputEmail" autocomplete="off" required='required'>
                                            
                                        </div>
                                        <div class="m-login__form-action">
                                            <input type='submit'  onclick="saveform();" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air" value='Request' name='button'>
                                            <a class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom m-btn--air" href="<?php echo site_url(); ?>" >Back</a>
                                        </div>
                                    </form>
                                </div>
                                <p class='text-center'>Powered by Cargod . © 2021 All Rights Reserved.  </p>
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