<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
<div class="booking-note">
    <div class="container">
        <?php echo get_option_tree( 'booking_text', '', false ); ?>
    </div>
</div>
<div class="clearfix"></div>
<div class="quick_links">
    <div class="container-fluid container-fluid-footer">
        <div class="row">
            <div class="col-sm-12">
                <?php 
                        wp_nav_menu( array(
                            'theme_location' => 'footer',
                            'menu_class'     => '',
                           ) );
                    ?>
            </div>
        </div> <!--row -->
    </div> <!-- container -->
</div>

<!-- FOOTER START -->
    <footer class="footer">     

        <div class="main_footer">

            <div class="container">

                <div class="row">

                    <div class="col-xs-12 col-sm-4 col-md-4">

                        <div class="row logo">

                            <a href="<?php echo site_url(); ?>">
                                
                                <?php if(get_option_tree( 'logo_footer', '', false ) != ''){ ?>
                                    <img src="<?php echo get_option_tree( 'logo_footer', '', false ); ?>" alt="logo">
                                <?php } else { ?>
                                    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo.png" alt="logo">
                                <?php } ?>

                            </a>                    

                        </div> 
                        <div class="site_title">
                            <?php if(get_option_tree( 'header_logo_text', '', false ) != ''){ ?>
                            <span><?php echo get_option_tree( 'footer_logo_text', '', false ); ?></span><br>
                            <?php } ?>
                            <p><?php echo get_option_tree( 'copyright', '', false ); ?></p>
                        </div>

                    </div>
                        
                    <div class="col-xs-12 col-sm-4 col-md-4 text-center">
                        <ul class="social">
                            <li><a target="_blank" href="<?php echo get_option_tree( 'fb_link', '', false ); ?>"><i class="fa fa-facebook"></i></a></li>
                            <li><a target="_blank" href="<?php echo get_option_tree( 'ln_link', '', false ); ?>"><i class="fa fa-linkedin"></i></a></li>
                            <li><a target="_blank" href="<?php echo get_option_tree( 'tw_link', '', false ); ?>"><i class="fa fa-twitter"></i></a></li>
                            <li><a target="_blank" href="<?php echo get_option_tree( 'pin_link', '', false ); ?>"><i class="fa fa-pinterest-p"></i></a></li>
                            <li><a target="_blank" href="<?php echo get_option_tree( 'gp_link', '', false ); ?>"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>    

                    <div class="col-xs-12 col-sm-4 col-md-4">
                      <div class="site_developer text-right">

                            <a href="http://www.eqan.net" target="_blank">
                                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/eqan.png" alt="EQAN LIMITED">
                            </a>

                        </div>
                      
                    </div>
        

                </div> <!-- row -->    

            </div> <!-- container -->

        </div> <!-- main_footer -->

    </footer>
    <!-- FOOTER END -->

        
<?php wp_footer(); ?>

</body>
</html>
