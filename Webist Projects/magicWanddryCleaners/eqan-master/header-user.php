<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php endif; ?>
    <?php if(get_option_tree( 'logo_favi', '', false ) != ''){ ?>
    <link rel="icon" href="<?php echo get_option_tree( 'logo_favi', '', false ); ?>" sizes="32x32" type="image/png">
    <?php } ?>
    <link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/user/admin-files/bower_components/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/user/admin-files/bower_components/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/user/admin-files/bower_components/Ionicons/css/ionicons.min.css">
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/user/admin-files/plugins/iCheck/square/blue.css">
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/user/admin-files/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/user/admin-files/dist/css/skins/_all-skins.min.css">
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/user/admin-files/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/user/admin-files/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/user/admin-files/dist/css/AdminLTE.min.css">
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<?php wp_head(); ?>
</head>

<?php if(is_user_logged_in() ){ ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo site_url(); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>D</b>B</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Dashboard</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?php $current_user = wp_get_current_user(); ?>
              <span class="hidden-xs">Welcome <?php echo get_user_meta($current_user->ID, 'first_name', true); ?> <?php echo get_user_meta($current_user->ID, 'last_name', true); ?></span>
            </a>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="<?php echo site_url(); ?>" type="button" class="btn btn-success">
              Home
            </a>
          </li>
          <li>
            <a href="<?php echo wp_logout_url(); ?>" type="button" class="btn btn-danger">
              Logout
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <?php 
        $slug = get_queried_object()->post_name;
          
          if($slug == 'view-all-bookings' || $slug == 'dashboard'){
            $booking_active = 'menu-open';
            $booking_style = 'style="display: block;"';
            $all_booking_active = 'active';
          } else {
            $booking_active = '';
            $booking_style = '';
            $all_booking_active = '';
          }

          if($slug == 'edit-profile'){
            $edit_active = 'active';
          } else {
            $edit_active = '';
          }

          if($slug == 'change-password'){
            $change_active = 'active';
          } else {
            $change_active = '';
          }

      ?>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        
        <li class="<?php echo $booking_active; ?>">
          <a href="<?php echo site_url(); ?>/dashboard">
            <i class="fa fa-folder"></i>
            <span>Bookings</span>
          </a>       
        </li>

        <li class="treeview <?php echo $profile_active; ?>">
          <a href="#">
            <i class="fa fa-gear"></i> <span>Settings</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-down pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" <?php echo $profile_style; ?>>
            <li class="<?php echo $edit_active; ?>"><a href="<?php echo site_url(); ?>/edit-profile"><i class="fa fa-circle-o"></i> Edit Profile</a></li>
            <li class="<?php echo $change_active; ?>"><a href="<?php echo site_url(); ?>/change-password"><i class="fa fa-circle-o"></i> Change Password</a></li>
          </ul>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
<?php } else { ?> 
<body class="hold-transition login-page">
<?php } ?>