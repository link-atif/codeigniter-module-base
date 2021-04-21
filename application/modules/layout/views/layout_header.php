<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Neon Admin Panel" />
  <meta name="author" content="" />

  <link rel="icon" href="<?=base_url();?>assets/admin/assets/images/favicon.ico">

  <title>Admin | Dashboard</title>

  <link rel="stylesheet" href="<?=base_url();?>assets/admin/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
  <link rel="stylesheet" href="<?=base_url();?>assets/admin/assets/css/font-icons/entypo/css/entypo.css">
  <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
  <link rel="stylesheet" href="<?=base_url();?>assets/admin/assets/css/bootstrap.css">
  <link rel="stylesheet" href="<?=base_url();?>assets/admin/assets/css/neon-core.css">
  <link rel="stylesheet" href="<?=base_url();?>assets/admin/assets/css/neon-theme.css">
  <link rel="stylesheet" href="<?=base_url();?>assets/admin/assets/css/neon-forms.css">
  <link rel="stylesheet" href="<?=base_url();?>assets/admin/assets/css/custom.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

  <!-- <script src="<?=base_url();?>assets/admin/assets/js/jquery-1.11.3.min.js"></script> -->
  <script
        src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous"></script>
  <!-- <script src="<?=base_url();?>assets/admin/assets/js/js/ckeditor.js"></script> -->
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  <script src="https://clientportal.azureedge.net/webasset/themes/vendors/multiselect/jquery.multiselect.js"></script>
  <script src="https://clientportal.azureedge.net/webasset/themes/vendors/jquery-validation/js/jquery.validate.min.js"></script>

  <script type="text/javascript">
    jQuery( document ).ready( function( $ ) {
      var $table4 = jQuery( "#table-4" );
      
      $table4.DataTable( {
        dom: 'Bfrtip',
        buttons: [
          'copyHtml5',
          'excelHtml5',
          'csvHtml5',
          'pdfHtml5'
        ]
      } );
    } );    
    </script>
</head>
<style type="text/css">
  .not_available{
    background-color: #cc2424;
    color: white;
    padding: 4px 10px;
    border-radius: 18px;
  }
</style>
<body class="page-body  page-fade" data-url="http://neon.dev">

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
  
  <div class="sidebar-menu">

    <div class="sidebar-menu-inner">
      
      <header class="logo-env">

        <!-- logo -->
        <div class="logo">
          <a href="<?=base_url();?>">
            <img src="<?=base_url();?>assets/admin/assets/images/logo@2x.png" width="120" alt="" />
          </a>
        </div>

        <!-- logo collapse icon -->
        <div class="sidebar-collapse">
          <a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
            <i class="entypo-menu"></i>
          </a>
        </div>

                
        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
        <div class="sidebar-mobile-menu visible-xs">
          <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
            <i class="entypo-menu"></i>
          </a>
        </div>

      </header>
<?php
  $this->load->view('layout/layout_sidebar');
?>