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
       
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/component.css">
    <link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/animation.css">
    <link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/swipebox.css">
    <link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/lightslider.css" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/owl.theme.css" />
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" rel="stylesheet" />
    <style>
        .bottom_contact .home-form.parallex-form{
            background: url(<?php echo get_option_tree( 'booking_bg', '', false ); ?>) center center no-repeat !important; 
            background-size: cover !important; 
            background-attachment: fixed !important; 
            padding-top: 0px !important; 
            padding-bottom: 60px !important;
            border: 1px solid #CB0101;
        }
    </style>
    <?php wp_head(); ?>
</head>
<?php if(is_home() || is_front_page()){
    $class = 'home';
} else {
    $class = 'inner';
} ?>
<body class="<?php echo $class; ?>" >
 

<div class="modal" id="myModal1" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Thank You</h4>
            </div>
            <div class="modal-body">
                <?php echo get_option_tree( 'contact_form', '', false ); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="header-all animate-in fadeInTop" data-animation="load" data-show-screen="0.8" data-speed="1">
    
    <div class="main_header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="logo_wrap">
                        <a href="<?php bloginfo('url'); ?>" class="logo">
                            <?php if(get_option_tree( 'logo_image', '', false ) != ''){ ?>
                                <img src="<?php echo get_option_tree( 'logo_image', '', false ); ?>" alt="logo">
                            <?php } else { ?>
                                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo.png" alt="logo">
                            <?php } ?>
                        </a>
                    </div>    
                    <div class="site_title">
                        <?php echo get_option_tree( 'header_logo_text', '', false ); ?>
                    </div> 
                </div>
                <div class="new-contact-holder">
                    <div class="contact-box first-block">
                        <ul>
                            <li>
                                <a href="tel:<?php echo get_option_tree( 'contact_no', '', false ); ?>"><?php echo get_option_tree( 'contact_no', '', false ); ?></a>
                            </li>
                            <li>
                                <a href="tel:<?php echo get_option_tree( 'mobile_no', '', false ); ?>"><?php echo get_option_tree( 'mobile_no', '', false ); ?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="contact-box second-block">
                        <ul>
                            <li>
                                <a href="mailto:<?php echo get_option_tree( 'site_email', '', false ); ?>"><?php echo get_option_tree( 'site_email', '', false ); ?></a>
                            </li>
                            <li>
                                <a href="<?php echo get_option_tree( 'site_url', '', false ); ?>"><?php echo get_option_tree( 'site_url', '', false ); ?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="language-holder">
                    <div id="google_translate_element"></div>
                        <script type="text/javascript">
                                function googleTranslateElementInit() {
                                    new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
                            }
                        </script>
                        <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                    </div>
                    <div class="clearfix"></div>
                    <ul class="social">
                        <li><a target="_blank" href="<?php echo get_option_tree( 'fb_link', '', false ); ?>"><i class="fa fa-facebook"></i></a></li>
                        <li><a target="_blank" href="<?php echo get_option_tree( 'ln_link', '', false ); ?>"><i class="fa fa-linkedin"></i></a></li>
                        <li><a target="_blank" href="<?php echo get_option_tree( 'tw_link', '', false ); ?>"><i class="fa fa-twitter"></i></a></li>
                        <li><a target="_blank" href="<?php echo get_option_tree( 'pin_link', '', false ); ?>"><i class="fa fa-pinterest-p"></i></a></li>
                        <li><a target="_blank" href="<?php echo get_option_tree( 'gp_link', '', false ); ?>"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                </div>
                
                <div class="clearfix"></div>
            </div>
        </div>
        
        <div class="tagline_wrapper">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-lg-8">
                                    <p class="tagline"><?php echo get_option_tree( 'tagline1', '', false ); ?></p>
                                </div>
                                <div class="col-xs-12 col-lg-4">
                                    <div class="sm_menu">
                                        <?php 
                                            wp_nav_menu( array(
                                                'theme_location' => 'header',
                                                'menu_class'     => 'list-unstyled list-inline',
                                            ) );
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    </div> <!-- container -->
</div> <!-- header -->
<div class="clearfix"></div>
<!-- TICKER END -->
<div class="menu_bar">
        <div class="container-fluid">
            <div class="row">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span> 
                  </button>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <?php 
                        wp_nav_menu( array(
                            'theme_location' => 'primary',
                            'menu_class'     => 'nav nav-all',
                            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                            'walker'            => new wp_bootstrap_navwalker(),
                           ) );
                    ?>
                </div>
            </div> <!--row -->
        </div> <!-- container -->
    </div> <!-- nav -->