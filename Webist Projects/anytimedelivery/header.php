<?php
if (!session_id()) {
    session_start();
}
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel='stylesheet' id='font_Roboto-css' href='http://fonts.googleapis.com/css?family=Roboto%3A300&amp;ver=4.6.13' type='text/css' media='all' />
    <link rel='stylesheet' id='font_Poppins-css' href='http://fonts.googleapis.com/css?family=Poppins%3A600&amp;ver=4.6.13' type='text/css' media='all' />
    <link rel='stylesheet' id='buttons-css' href='<?php echo esc_url( get_template_directory_uri() ); ?>/assets/wp-includes/css/buttons.min4e7f.css?ver=4.6.13' type='text/css' media='all' />
    <link rel='stylesheet' id='dashicons-css' href='<?php echo esc_url( get_template_directory_uri() ); ?>/assets/wp-includes/css/dashicons.min4e7f.css?ver=4.6.13' type='text/css' media='all' />
    <link rel='stylesheet' id='mediaelement-css' href='<?php echo esc_url( get_template_directory_uri() ); ?>/assets/wp-includes/js/mediaelement/mediaelementplayer.min51cd.css?ver=2.22.0' type='text/css' media='all' />
    <link rel='stylesheet' id='wp-mediaelement-css' href='<?php echo esc_url( get_template_directory_uri() ); ?>/assets/wp-includes/js/mediaelement/wp-mediaelement.min4e7f.css?ver=4.6.13' type='text/css' media='all' />
    <link rel='stylesheet' id='media-views-css' href='<?php echo esc_url( get_template_directory_uri() ); ?>/assets/wp-includes/css/media-views.min4e7f.css?ver=4.6.13' type='text/css' media='all' />
    <link rel='stylesheet' id='imgareaselect-css' href='<?php echo esc_url( get_template_directory_uri() ); ?>/assets/wp-includes/js/imgareaselect/imgareaselect3bf4.css?ver=0.9.8' type='text/css' media='all' />
    <link rel='stylesheet' id='rs-plugin-settings-css' href='<?php echo esc_url( get_template_directory_uri() ); ?>/assets/wp-content/plugins/revslider/public/assets/css/settingsa88c.css?ver=5.3.0.2' type='text/css' media='all' />
    <link rel='stylesheet' id='bootstrap_css_bootstrap_min-css' href='<?php echo esc_url( get_template_directory_uri() ); ?>/assets/wp-content/themes/logistics-theme/assets/css/bootstrap.min4e7f.css?ver=4.6.13' type='text/css' media='all' />
    <link rel='stylesheet' id='bootstrap_theme_css-css' href='<?php echo esc_url( get_template_directory_uri() ); ?>/assets/wp-content/themes/logistics-theme/assets/css/bootstrap-theme4e7f.css?ver=4.6.13' type='text/css' media='all' />
    <link rel='stylesheet' id='iconmoon_css-css' href='<?php echo esc_url( get_template_directory_uri() ); ?>/assets/wp-content/themes/logistics-theme/assets/css/iconmoon4e7f.css?ver=4.6.13' type='text/css' media='all' />
    <link rel='stylesheet' id='menu_css-css' href='<?php echo esc_url( get_template_directory_uri() ); ?>/assets/wp-content/themes/logistics-theme/assets/css/menu4e7f.css?ver=4.6.13' type='text/css' media='all' />
    <link rel='stylesheet' id='style_css-css' href='<?php echo esc_url( get_template_directory_uri() ); ?>/assets/wp-content/themes/logistics-theme/style4e7f.css?ver=4.6.13' type='text/css' media='all' />
    <link rel='stylesheet' id='responsive_css-css' href='<?php echo esc_url( get_template_directory_uri() ); ?>/assets/wp-content/themes/logistics-theme/assets/css/responsive4e7f.css?ver=4.6.13' type='text/css' media='all' />
    <link rel='stylesheet' id='theme_style_css-css' href='<?php echo esc_url( get_template_directory_uri() ); ?>/assets/wp-content/themes/logistics-theme/include/theme_styles4e7f.css?ver=4.6.13' type='text/css' media='all' />
    <script type='text/javascript' src='<?php echo esc_url( get_template_directory_uri() ); ?>/assets/wp-includes/js/jquery/jqueryb8ff.js?ver=1.12.4'></script>
    <script type='text/javascript' src='<?php echo esc_url( get_template_directory_uri() ); ?>/assets/wp-includes/js/jquery/jquery-migrate.min330a.js?ver=1.4.1'></script>
    <?php wp_head(); ?>
	<script data-ad-client="ca-pub-4458814384589965" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	
<!-- 	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="/resources/demos/external/jquery-mousewheel/jquery.mousewheel.js"></script> -->
	
    <style>
        #show_price1{
            margin: 20px;
            padding: 20px 10px 20px 10px;
            border-radius: 5px;
            background-color: #FFFFFF;
        }
        .order21{
            /* align-text: center; */
            font-family: 'FjallaOne-Regular' !important;
            background-color: #F0F0F0;
            border-radius: 2px;
            padding: 10px 0px;
            color: #5585AB !important;
            text-align: center;
        }

        .main-section h2, .main-section h2 a {
            color: #5585AB !important;
        }

        .hidden123{
            display: none;
        }

        table > thead > tr > th, table > tbody > tr > th, table > tfoot > tr > th, table > thead > tr > td, table > tbody > tr > td, table > tfoot > tr > td {
            color: black !important;
            border-bottom: 1px solid #ddd !important;
            line-height: 50px;
            padding-left: 7px;
            vertical-align: top;
            font-size: 12px;
            border-left: 1px solid #ddd !important;
            font-weight: 500;
        }

        .total_am{
            font-family: "Times New Roman", Times !important; 
            color: #5585AB !important;
            padding-right: 15px;
            text-align: right;
            
        }

    </style>
</head>

<?php if(is_home() || is_front_page()){
    $class = 'home';
} else {
    $class = 'inner';
} ?>

<body class="home page page-id-58 page-template-default  cbp-spmenu-push">
    <!-- Wrapper -->
    <div class="wrapper wrapper_full_width">
        <!-- Header 1 Start -->
        <header id="header" class="">
            <div class="container">
                <div class="nav-area">
                    <nav class="navigation">
                        <ul>
                        <?php
                            wp_nav_menu( array(
                                'theme_location' => 'primary',
                                'container' => false,
                                'items_wrap' => '%3$s',    
                            ));
                        ?>
                        </ul>
                    </nav>
                    <ul class="social-networks">
                        <li>
                            <a  class="cs-color-hover" title="" href="<?php echo get_option_tree( 'fb_link', '', false ); ?>"
                            data-placement-tooltip="tooltip"  target="_blank">
                                                                <i class="icon-facebook-square "></i>

                                                    </a>
                        </li>
                        <li>
                            <a  class="cs-color-hover" title="" href="<?php echo get_option_tree( 'tw_link', '', false ); ?>"
                            data-placement-tooltip="tooltip"  target="_blank">
                                                                <i class="icon-twitter-square "></i>

                                                    </a>
                        </li>
                        <li>
                            <a  class="cs-color-hover" title="" href="<?php echo get_option_tree( 'in_link', '', false ); ?>"
                            data-placement-tooltip="tooltip"  target="_blank">
                                                                <i class="icon-instagram"></i>

                                                    </a>
                        </li>
                        <li>
                            <a  class="cs-color-hover" title="" href="<?php echo get_option_tree( 'yell_link', '', false ); ?>"
                            data-placement-tooltip="tooltip"  target="_blank">
                                                                <i class="icon-hacker-news"></i>

                                                    </a>
                        </li>
                    </ul>
                </div>
                <div class="logo-area">
                    <div class="logo">
                        <a href="<?php echo site_url(); ?>">
                <img src="<?php echo get_option_tree( 'logo_image', '', false ); ?>" alt="">
            </a>
                    </div>
                    <div class="right-area">
                        <ul class="contact-info">
                            <li> <i class="icon-phone8"></i>
                                <div class="info-text">
                                    <span class="info-title">Contact Us</span> <span class="text"><?php echo get_option_tree( 'contact_no', '', false ); ?></span> </div>
                            </li>
                            <li> <i class="icon-mail6"></i>
                                <div class="info-text"> <span class="info-title">Email Us</span> <a href="mailto:<?php echo get_option_tree( 'site_email', '', false ); ?>" class="text"><?php echo get_option_tree( 'site_email', '', false ); ?></a> </div>
                            </li>
                        </ul>
                        <a href="https://anytimedelivery.uk/parcel-form/" class="quick-btn cs-bgcolor">Get Quote</a>
                    </div>
                </div>
            </div>
        </header>

        <?php
            if(is_home() || is_front_page()){} else {
            $feat_image = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID()) );
            if($feat_image != ''){ ?>
        <div class="breadcrumb-sec align-left" style="background: url(<?php echo $feat_image; ?>) center top  ; min-height:7px!important;"> 
        <?php } else { ?>
        <div class="breadcrumb-sec align-left" style="background: url(<?php echo esc_url( get_template_directory_uri() ); ?>/assets/wp-content/uploads/Sub-Header-1.jpg) center top  ; min-height:7px!important;">
        <?php } ?>
            <div class="container">
                <div class="row">
                    <div class="breadcrumb-holder col-md-12" style="min-height:7px;  padding-top:70px;  padding-bottom:105px">
                        <h1 style="color:#ffffff !important"><?php the_title(); ?></h1>
                        <ul class="breadcrumbs align-right">
                            <li><a href="<?php echo site_url(); ?>"><i class="icon-home"></i> Home</a></li>
                            <li class="active"><?php the_title(); ?></li>
                        </ul>                    
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <?php } ?>