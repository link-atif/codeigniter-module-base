<?php

ob_start();
$ci 	= & get_instance();
$class 	= $ci->router->fetch_class();
$module = $this->router->fetch_module();
$method = $this->router->fetch_method();
$this->load->helper('url');
$last_para = end(explode('/',current_url()));
$nd_last_para_count = count(explode('/',current_url()));
$nd_last_para = explode('/',current_url())[$nd_last_para_count-2];

$group_id 			=	$this->ion_auth->get_users_groups()->result();
$group   			= $this->session->userdata('user_group');
// debug($nd_last_para); die;
$logged_user_data   =   $this->ion_auth->user()->row();

$user_group = $this->session->userdata('user_group');

if(in_array('1', $user_group)){define("is_admin", TRUE);}else{ define("is_admin", FALSE); }
if(in_array('2', $user_group)){define("is_member", TRUE);}else{ define("is_member", FALSE); }
if(in_array('3', $user_group)){define("is_corporate_subuser", TRUE);}else{ define("is_corporate_subuser", FALSE); }
if(in_array('4', $user_group)){define("is_corporate", TRUE);}else{ define("is_corporate", FALSE); }
if(in_array('5', $user_group)){define("is_courier", TRUE);}else{ define("is_courier", FALSE); }

/*
$permissions_groups =	$this->acl_model->get_all_permissions_by_groupids($group);
$m_c_a 				=	array();
foreach($permissions_groups as $methodlist => $controllerlist)
{
	foreach($controllerlist as $modellist => $methods)
	{
		$m_c_a[] = $methods['module']."/".$methods['controller']."/".$methods['action'];
	}
} */
$main_active 		=	'';
$dashboard			=	'';
$dashboard_active	=	'';


if($module == 'dashboard')
{
	$dashboard			=	'm-menu__item--active';  
	$dashboard_active	=	'm-menu__item--active  m-menu__item--active-tab';  
}

if($module == 'users' && $method == 'index')
{
    $users_item         =   'm-menu__item--active';  
    $users_active       =   'm-menu__item--active  m-menu__item--active-tab';  
}else if($module == 'users' && $method == 'purchase_history'){

    $purchase_history_item         =   'm-menu__item--active';  
    $users_active       =   'm-menu__item--active  m-menu__item--active-tab';  
}

if($module == 'categories')
{
    $categories_item     =   'm-menu__item--active';  
    $categories_active   =   'm-menu__item--active  m-menu__item--active-tab';  
}

if($module == 'posts')
{
    $posts_item          =   'm-menu__item--active';  
    $posts_active   =   'm-menu__item--active  m-menu__item--active-tab';  
}
if($module == 'posts' && $method == 'get_wishlist_data')
{
    $posts_item    =   'm-menu__item';  
    $posts_item_wishlist  = 'm-menu__item--active';  
    $posts_active   =   'm-menu__item--active  m-menu__item--active-tab';  
}
if($module == 'posts' && $method == 'get_archive_data')
{
    $posts_item     =   'm-menu__item';  
    $posts_item_archive  = 'm-menu__item--active';  
    $posts_active   =   'm-menu__item--active  m-menu__item--active-tab';  
}
if($module == 'waiting_requests' && $last_para == 'waiting_requests')
{
    $posts_item     =   'm-menu__item';  
    $waiting_requests_item  = 'm-menu__item--active';  
    $posts_active   =   'm-menu__item--active  m-menu__item--active-tab';  
}
if($module == 'posts' && $last_para == 'live_locations')
{
    $posts_item     =   'm-menu__item';  
    $location_item  = 'm-menu__item--active';  
    $posts_active   =   'm-menu__item--active  m-menu__item--active-tab';  
}


if($module == 'finddeals')
{
    $finddeal_item     =   'm-menu__item--active';  
    $assigned_finddeal_item     =   'm-menu__item';  
    $finddeal_active   =   'm-menu__item--active  m-menu__item--active-tab';  
}
if($module == 'finddeals' && $last_para == 'live_locations'){

    $finddeal_item     =   'm-menu__item';  
    $assigned_finddeal_item     =   'm-menu__item';  
    $finddeal_active   =   'm-menu__item  m-menu__item--active-tab';  
    $finddeal_location_active   =   'm-menu__item--active';  
}
if($module == 'finddeals' && ($last_para == 'review_listings' || $nd_last_para == 'review_listings')){

    $finddeal_item     =   'm-menu__item';  
    $assigned_finddeal_item     =   'm-menu__item';  
    $finddeal_active   =   'm-menu__item  m-menu__item--active-tab';  
    $review_listings_active   =   'm-menu__item--active';  
}
if($module == 'finddeals' && $last_para != 'deals' && $nd_last_para == 'courier_user_view' && in_array('2', $user_group)){

    $finddeal_item     =   'm-menu__item';  
    $assigned_finddeal_item     =   'm-menu__item--active';  
    $finddeal_active   =   'm-menu__item  m-menu__item--active-tab';  
}
if($module == 'finddeals' && ($last_para == 'deals' || !is_numeric($last_para))){

    $finddeal_item     =   'm-menu__item--active';  
    $assigned_finddeal_item     =   'm-menu__item';  
    $finddeal_active   =   'm-menu__item  m-menu__item--active-tab';  
}

if($module == 'items')
{
    $items_menue          =   'm-menu__item--active';  
    $items_active   =   'm-menu__item--active  m-menu__item--active-tab';  
}

if($module == 'vendors')
{
    $vendors_menue          =   'm-menu__item--active';  
    $vendors_active   =   'm-menu__item--active  m-menu__item--active-tab';  
}
if($module == 'vendors' && $last_para == 'live_locations')
{
    $vendors_menue          =   'm-menu__item';  
    $location_menue          =   'm-menu__item--active';  
    $vendors_active   =   'm-menu__item--active  m-menu__item--active-tab';  
}

if($module == 'preferences')
{
    $preferences_menue          =   'm-menu__item--active';  
    $preferences_active   =   'm-menu__item--active  m-menu__item--active-tab';  
}
if($module == 'preferences' && $last_para == 'rejectionreasons'){

    $preferences_menue     =   'm-menu__item';  
    $preferences_rejection_active   =   'm-menu__item--active';  
    $preferences_active   =   'm-menu__item--active  m-menu__item--active-tab';  
}
/*if($module == 'waiting_requests')
{
    $waiting_requests_menue          =   'm-menu__item--active';  
    $waiting_requests_active   =   'm-menu__item--active  m-menu__item--active-tab';  
}*/

if($module == 'notifications')
{
    $notifications_menue          =   'm-menu__item--active';  
    $notifications_active   =   'm-menu__item--active  m-menu__item--active-tab';  
}
if($module == 'logs')
{

    $logs_menue          =   'm-menu__item--active';  
    $logs_active   =   'm-menu__item--active  m-menu__item--active-tab';  
}
if($module == 'ledger')
{

    $ledger_menue          =   'm-menu__item--active';  
    $ledger_active   =   'm-menu__item--active  m-menu__item--active-tab';  
}

$main_menu = $module;
$sub = $class;



//GPS MAPPING CHECK STARTS

?>

<div class="m-stack__item m-stack__item--fluid m-header-menu-wrapper">
    <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-light " id="m_aside_header_menu_mobile_close_btn">
        <i class="la la-close"></i>
    </button>
    <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-dark m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light ">
        <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">

            <?php if($group){ ?>
                <li id="tab-dashboard" class="m-menu__item m-menu__item--submenu m-menu__item--tabs <?php echo $dashboard_active; ?>" m-menu-submenu-toggle="tab" aria-haspopup="true">
                    <a href="javascript:;" class="m-menu__link m-menu__link_top m-menu__toggle">
                        <span class="m-menu__link-text">Dashboard</span>
                        <i class="m-menu__hor-arrow la la-angle-down"></i>
                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                        <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item <?php echo $dashboard; ?>" m-menu-link-redirect="1" aria-haspopup="true">
                                <a href="<?php echo base_url(); ?>dashboard/" class="m-menu__link ">
                                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                                    <span class="m-menu__link-text">Dashboard </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            <?php } ?>
            <?php if(in_array('1', $group) || in_array('4', $group)){ ?>

               <li id="li_14" class="m-menu__item m-menu__item--submenu m-menu__item--tabs <?php echo $users_active; ?>" m-menu-submenu-toggle="tab" aria-haspopup="true">
                <a href="javascript:;" class="m-menu__link m-menu__link_top m-menu__toggle ">
                    <span class="m-menu__link-text">Users</span>
                    <i class="m-menu__hor-arrow la la-angle-down"></i>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                    <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                    <ul class="m-menu__subnav " id="ul_14">
                        <li id="li_71" class="m-menu__item <?php echo $users_item; ?>" m-menu-link-redirect="1" aria-haspopup="false"><a class="m-menu__link " href="<?php echo base_url(); ?>users/users"><i class="m-menu__link-icon flaticon-graphic-2"></i><span class="m-menu__link-text">Users</span></a></li>

                         <li id="li_71" class="m-menu__item <?php echo $purchase_history_item; ?>" m-menu-link-redirect="1" aria-haspopup="false"><a class="m-menu__link " href="<?php echo base_url(); ?>users/purchase_history"><i class="m-menu__link-icon flaticon-graphic-2"></i><span class="m-menu__link-text">Purchase history</span></a></li>
                    </ul>
                </div>
            </li>
        <?php } ?>
        <?php if(in_array('1', $group)){ ?>

            <li class="m-menu__item m-menu__item--submenu m-menu__item--tabs <?php echo $categories_active ?>" m-menu-submenu-toggle="tab" aria-haspopup="true" id="category_menu_main">
                <a href="javascript:;"  class="m-menu__link m-menu__link_top m-menu__toggle">
                    <span class="m-menu__link-text">Categories</span>
                    <i class="m-menu__hor-arrow la la-angle-down"></i>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                    <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                    <ul class="m-menu__subnav " id="ul_15">
                        <li id="li_72" class="m-menu__item <?php echo $categories_item; ?>" m-menu-link-redirect="1" aria-haspopup="false"><a class="m-menu__link " href="<?php echo base_url(); ?>categories/categories"><i class="m-menu__link-icon flaticon-graphic-2"></i><span class="m-menu__link-text">Categories</span></a></li>
                    </ul>
                </div>
            </li>
        <?php } ?>

        <?php if(in_array('1', $group) || in_array('2', $group)){ ?>


            <li class="m-menu__item m-menu__item--submenu m-menu__item--tabs <?php echo $posts_active ?>" m-menu-submenu-toggle="tab" aria-haspopup="true" id="post_menu_main">
                <a href="javascript:;"  class="m-menu__link m-menu__link_top m-menu__toggle">
                    <span class="m-menu__link-text">Posts</span>
                    <i class="m-menu__hor-arrow la la-angle-down"></i>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                    <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                    <ul class="m-menu__subnav " id="ul_14">
                        <?php 
                        $user_id = $this->session->userdata('user_id'); 
                        if (in_array('2', $group)) { ?>
                            <li id="li_71" class="m-menu__item <?php echo $posts_item; ?>" m-menu-link-redirect="1" aria-haspopup="false">
                                <a class="m-menu__link " href="<?php echo base_url(); ?>posts/posts/index/<?= $user_id ?>"><i class="m-menu__link-icon flaticon-graphic-2"></i><span class="m-menu__link-text">Posts</span></a>
                            </li>
                        <?php } else { ?>
                            <li id="li_71" class="m-menu__item <?php echo $posts_item; ?>" m-menu-link-redirect="1" aria-haspopup="false">
                                <a class="m-menu__link " href="<?php echo base_url(); ?>posts/posts"><i class="m-menu__link-icon flaticon-graphic-2"></i><span class="m-menu__link-text">Posts</span></a>
                            </li>
                        <?php } ?>
                            <?php if (is_member === TRUE) { ?>
                                <li id="li_71" class="m-menu__item <?php echo $posts_item_wishlist; ?>" m-menu-link-redirect="1" aria-haspopup="false">
                                    <a class="m-menu__link " href="<?=base_url();?>posts/get_wishlist_data/<?= $this->session->userdata('user_id')?>"><i class="m-menu__link-icon flaticon-graphic-2"></i><span class="m-menu__link-text">Wishlist Posts</span></a>
                                </li>
                                <li id="li_71" class="m-menu__item <?php echo $posts_item_archive; ?>" m-menu-link-redirect="1" aria-haspopup="false">
                                    <a class="m-menu__link " href="<?=base_url();?>posts/get_archive_data/<?= $this->session->userdata('user_id')?>"><i class="m-menu__link-icon flaticon-graphic-2"></i><span class="m-menu__link-text">Archive Posts</span></a>
                                </li>

                            <?php } ?>
                            <?php if(in_array('1', $group)){ ?>
                                <li id="li_71" class="m-menu__item <?php echo $waiting_requests_item; ?>" m-menu-link-redirect="1" aria-haspopup="false">
                                    <a class="m-menu__link " href="<?php echo base_url(); ?>waiting_requests/waiting_requests"><i class="m-menu__link-icon flaticon-graphic-1"></i><span class="m-menu__link-text">Waiting Requests</span></a>
                                </li>

                                <li id="li_71" class="m-menu__item <?php echo $location_item; ?>" m-menu-link-redirect="1" aria-haspopup="false">
                                    <a class="m-menu__link " href="<?php echo base_url(); ?>posts/posts/live_locations"><i class="m-menu__link-icon flaticon-graphic-1"></i><span class="m-menu__link-text">Live Locations</span></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
            <?php } ?>
            <?php if(in_array('1', $group) || in_array('4', $group) || in_array('5', $group) || in_array('3', $group) || in_array('2', $group)){ ?>


                <li class="m-menu__item m-menu__item--submenu m-menu__item--tabs <?php echo $finddeal_active ?>" m-menu-submenu-toggle="tab" aria-haspopup="true" id="post_menu_main">
                    <a href="javascript:;"  class="m-menu__link m-menu__link_top m-menu__toggle">
                        <span class="m-menu__link-text">Find Deal</span>
                        <i class="m-menu__hor-arrow la la-angle-down"></i>
                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                        <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                        <ul class="m-menu__subnav " id="ul_14">
                            <?php 
                            $user_id = $this->session->userdata('user_id');
                            if (in_array('2', $group) && in_array('5', $group)) { ?>
                                <li id="li_71" class="m-menu__item <?php echo $finddeal_item; ?>" m-menu-link-redirect="1" aria-haspopup="false">
                                    <a class="m-menu__link " href="<?php echo base_url(); ?>finddeals/finddeals/"><i class="m-menu__link-icon flaticon-graphic-2"></i><span class="m-menu__link-text">Find Deal</span>
                                    </a>
                                </li>
                           <!--  <li id="li_71" class="m-menu__item <?php echo $assigned_finddeal_item; ?>" m-menu-link-redirect="1" aria-haspopup="false">
                                <a class="m-menu__link " href="<?php echo base_url(); ?>finddeals/finddeals/index/<?= $user_id ?>"><i class="m-menu__link-icon flaticon-graphic-2"></i><span class="m-menu__link-text">Assigned Find Deal</span>
                                </a>
                            </li> -->
                        <?php } else if (in_array('2', $group)) { ?>
                            <li id="li_71" class="m-menu__item <?php echo $finddeal_item; ?>" m-menu-link-redirect="1" aria-haspopup="false"><a class="m-menu__link " href="<?php echo base_url(); ?>finddeals/finddeals/index/<?= $user_id ?>"><i class="m-menu__link-icon flaticon-graphic-2"></i><span class="m-menu__link-text">Find Deal</span></a></li>
                        <?php } else { ?>
                            <li id="li_71" class="m-menu__item <?php echo $finddeal_item; ?>" m-menu-link-redirect="1" aria-haspopup="false"><a class="m-menu__link " href="<?php echo base_url(); ?>finddeals/finddeals"><i class="m-menu__link-icon flaticon-graphic-2"></i><span class="m-menu__link-text">Find Deal</span></a></li>
                        <?php } ?>
                        <?php if(in_array('1', $group)){ ?>

                            <li id="li_71" class="m-menu__item <?php echo $finddeal_location_active; ?>" m-menu-link-redirect="1" aria-haspopup="false">
                                <a class="m-menu__link " href="<?php echo base_url(); ?>finddeals/finddeals/live_locations"><i class="m-menu__link-icon flaticon-graphic-1"></i><span class="m-menu__link-text">Live Locations</span></a>
                            </li>
                        <?php } if(in_array('1', $group) || in_array('5', $group)){ ?>
                            <li id="li_71" class="m-menu__item <?php echo $review_listings_active; ?>" m-menu-link-redirect="1" aria-haspopup="false">
                                <a class="m-menu__link " href="<?php echo base_url(); ?>finddeals/finddeals/review_listings"><i class="m-menu__link-icon flaticon-graphic-1"></i><span class="m-menu__link-text">Reviews</span></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

            </li>
        <?php } ?>
        <?php if(in_array('1', $group)){ ?>

            <li class="m-menu__item m-menu__item--submenu m-menu__item--tabs <?php echo $items_active ?>" m-menu-submenu-toggle="tab" aria-haspopup="true" id="post_menu_main">
                <a href="javascript:;"  class="m-menu__link m-menu__link_top m-menu__toggle">
                    <span class="m-menu__link-text">Items</span>
                    <i class="m-menu__hor-arrow la la-angle-down"></i>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                    <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                    <ul class="m-menu__subnav " id="ul_14">
                        <li id="li_71" class="m-menu__item <?php echo $items_menue; ?>" m-menu-link-redirect="1" aria-haspopup="false"><a class="m-menu__link " href="<?php echo base_url(); ?>items/items"><i class="m-menu__link-icon flaticon-graphic-2"></i><span class="m-menu__link-text">items</span></a></li>
                    </ul>
                </div>
            </li>
        <?php } ?>
        <?php if(in_array('1', $group)){ ?>

            <li class="m-menu__item m-menu__item--submenu m-menu__item--tabs <?php echo $vendors_active ?>" m-menu-submenu-toggle="tab" aria-haspopup="true" id="post_menu_main">
                <a href="javascript:;"  class="m-menu__link m-menu__link_top m-menu__toggle">
                    <span class="m-menu__link-text">Vendors</span>
                    <i class="m-menu__hor-arrow la la-angle-down"></i>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                    <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                    <ul class="m-menu__subnav " id="ul_14">
                        <li id="li_71" class="m-menu__item <?php echo $vendors_menue; ?>" m-menu-link-redirect="1" aria-haspopup="false"><a class="m-menu__link " href="<?php echo base_url(); ?>vendors/vendors"><i class="m-menu__link-icon flaticon-graphic-2"></i><span class="m-menu__link-text">vendors</span></a></li>

                        <li id="li_71" class="m-menu__item <?php echo $location_menue; ?>" m-menu-link-redirect="1" aria-haspopup="false">
                            <a class="m-menu__link " href="<?php echo base_url(); ?>vendors/vendors/live_locations"><i class="m-menu__link-icon flaticon-graphic-1"></i><span class="m-menu__link-text">Live Locations</span></a>
                        </li>
                    </ul>
                </div>
            </li>
        <?php } ?>
        <?php if(in_array('1', $group)){ ?>

            <li class="m-menu__item m-menu__item--submenu m-menu__item--tabs <?php echo $preferences_active ?>" m-menu-submenu-toggle="tab" aria-haspopup="true" id="post_menu_main">
                <a href="javascript:;"  class="m-menu__link m-menu__link_top m-menu__toggle">
                    <span class="m-menu__link-text">Preferences</span>
                    <i class="m-menu__hor-arrow la la-angle-down"></i>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                    <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                    <ul class="m-menu__subnav " id="ul_14">
                        <li id="li_71" class="m-menu__item <?php echo $preferences_menue; ?>" m-menu-link-redirect="1" aria-haspopup="false"><a class="m-menu__link " href="<?php echo base_url(); ?>preferences/preferences"><i class="m-menu__link-icon flaticon-graphic-2"></i><span class="m-menu__link-text">Preferences</span></a></li>
                        <li id="li_71" class="m-menu__item <?php echo $preferences_rejection_active; ?>" m-menu-link-redirect="1" aria-haspopup="false"><a class="m-menu__link " href="<?php echo base_url(); ?>preferences/rejectionreasons"><i class="m-menu__link-icon flaticon-graphic-2"></i><span class="m-menu__link-text">Rejection Reasons</span></a></li>
                    </ul>
                </div>
            </li>
        <?php } ?>
        <?php if(in_array('1', $group)){ ?>

        <!-- <li class="m-menu__item m-menu__item--submenu m-menu__item--tabs <?php echo $waiting_requests_active ?>" m-menu-submenu-toggle="tab" aria-haspopup="true" id="post_menu_main">
                <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                    <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                    <ul class="m-menu__subnav " id="ul_14">
                        <li id="li_71" class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="false">
                            <a class="m-menu__link " href="<?php echo base_url(); ?>posts/posts"><i class="m-menu__link-icon flaticon-graphic-2"></i><span class="m-menu__link-text">posts</span></a>
                        </li>
                        <li id="li_71" class="m-menu__item <?php echo $waiting_requests_menue; ?>" m-menu-link-redirect="1" aria-haspopup="false">
                            <a class="m-menu__link " href="<?php echo base_url(); ?>waiting_requests/waiting_requests"><i class="m-menu__link-icon flaticon-graphic-1"></i><span class="m-menu__link-text">Waiting Requests</span></a>
                        </li>
                        <li id="li_71" class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="false">
                            <a class="m-menu__link " href="<?php echo base_url(); ?>posts/posts/live_locations"><i class="m-menu__link-icon flaticon-graphic-1"></i><span class="m-menu__link-text">Live Locations</span></a>
                        </li>
                    </ul>
                </div>
            </li> -->
        <?php } ?>
        <?php if(in_array('1', $group)){ ?>

            <li class="m-menu__item m-menu__item--submenu m-menu__item--tabs <?php echo $notifications_active ?>" m-menu-submenu-toggle="tab" aria-haspopup="true" id="post_menu_main">
                <a href="javascript:;"  class="m-menu__link m-menu__link_top m-menu__toggle">
                    <span class="m-menu__link-text">Notifications</span>
                    <i class="m-menu__hor-arrow la la-angle-down"></i>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                    <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                    <ul class="m-menu__subnav " id="ul_14">
                        <li id="li_71" class="m-menu__item <?php echo $notifications_menue; ?>" m-menu-link-redirect="1" aria-haspopup="false"><a class="m-menu__link " href="<?php echo base_url(); ?>notifications/notifications"><i class="m-menu__link-icon flaticon-graphic-2"></i><span class="m-menu__link-text">Notifications</span></a></li>
                    </ul>
                </div>
            </li>
        <?php } ?>
        <?php if(in_array('1', $group)){ ?>

            <li class="m-menu__item m-menu__item--submenu m-menu__item--tabs <?php echo $logs_active ?>" m-menu-submenu-toggle="tab" aria-haspopup="true" id="post_menu_main">
                <a href="javascript:;"  class="m-menu__link m-menu__link_top m-menu__toggle">
                    <span class="m-menu__link-text">Email Logs</span>
                    <i class="m-menu__hor-arrow la la-angle-down"></i>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                    <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                    <ul class="m-menu__subnav " id="ul_14">
                        <li id="li_71" class="m-menu__item <?php echo $logs_menue; ?>" m-menu-link-redirect="1" aria-haspopup="false"><a class="m-menu__link " href="<?php echo base_url(); ?>logs/logs"><i class="m-menu__link-icon flaticon-graphic-2"></i><span class="m-menu__link-text">Email Logs</span></a></li>
                    </ul>
                </div>
            </li>
        <?php } ?>

        <?php if(in_array('1', $group)){ ?>

            <li class="m-menu__item m-menu__item--submenu m-menu__item--tabs <?php echo $ledger_active ?>" m-menu-submenu-toggle="tab" aria-haspopup="true" id="post_menu_main">
                <a href="javascript:;"  class="m-menu__link m-menu__link_top m-menu__toggle">
                    <span class="m-menu__link-text">Ledger</span>
                    <i class="m-menu__hor-arrow la la-angle-down"></i>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                    <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                    <ul class="m-menu__subnav " id="ul_14">
                        <li id="li_71" class="m-menu__item <?php echo $ledger_menue; ?>" m-menu-link-redirect="1" aria-haspopup="false"><a class="m-menu__link " href="<?php echo base_url(); ?>ledger/ledger"><i class="m-menu__link-icon flaticon-graphic-2"></i><span class="m-menu__link-text">Ledger</span></a></li>
                    </ul>
                </div>
            </li>
        <?php } ?>



        <?php
        $grp_id = $this->ion_auth->get_users_groups()->row()->id;
        if ($grp_id == 1)
        {
            $routes_this = array('class' => $class, 'module' => $module, 'method' => $method);
            // $this->load->view('layout/navigation_setup', $routes_this);
        }
        ?> 





    </ul>
</div>
</div>



<script>
    $(document).on('click', '.m-menu__link_top', function() 
    {

        if ($('#m_aside_header_menu_mobile_toggle:visible').length == 0)
        {
            var href_val = $(this).closest('.m-menu__link_top').next().find('a').attr('href');
            if (href_val != 'javascript:;')
            {
                location.href = href_val;
            }
        }
    });
</script>