<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Neon Admin Panel" />
  <meta name="author" content="" />

  <link rel="icon" href="assets/images/favicon.ico">

  <title>Admin | Dashboard</title>

  <link rel="stylesheet" href="<?=base_url();?>assets/admin/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
  <link rel="stylesheet" href="<?=base_url();?>assets/admin/assets/css/font-icons/entypo/css/entypo.css">
  <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
  <link rel="stylesheet" href="<?=base_url();?>assets/admin/assets/css/bootstrap.css">
  <link rel="stylesheet" href="<?=base_url();?>assets/admin/assets/css/neon-core.css">
  <link rel="stylesheet" href="<?=base_url();?>assets/admin/assets/css/neon-theme.css">
  <link rel="stylesheet" href="<?=base_url();?>assets/admin/assets/css/neon-forms.css">
  <link rel="stylesheet" href="<?=base_url();?>assets/admin/assets/css/custom.css">

  <script src="<?=base_url();?>assets/admin/assets/js/jquery-1.11.3.min.js"></script>
  <!-- <script src="<?=base_url();?>assets/admin/assets/js/js/ckeditor.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

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