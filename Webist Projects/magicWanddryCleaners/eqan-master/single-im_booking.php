<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div class="container new-inner-page">
            <div class="row">
                <?php while ( have_posts() ) : the_post(); ?>
                <div style="margin-top: 20px;" class="col-xs-12 animate-in fadeInBottom" data-animation="load" data-show-screen="0.8" data-speed="1">
                    <div class="inner-page">
                        <div class="main_heading">
                            <h2>Order#MWDC-<?php echo get_the_ID(); ?></h2>
                        </div>
                    </div>
                </div>
                
                <div class="col-xs-12 animate-in fadeInBottom" data-animation="load" data-show-screen="0.8" data-speed="1">
                    <div class="">
                        <?php 
                            $table_data = get_post_meta(get_the_ID(), 'im_table_data', true);
                            $ftotal = get_post_meta(get_the_ID(), 'im_ftotal', true);
                            $reason = get_post_meta(get_the_ID(), 'im_reason', true);
                            $table_row = $table_data;
                            if($ftotal > 0){
                                $table_row .= '<tr><th style="text-align: left;">Final Total</th><th>&nbsp;</th><th>&nbsp;</th><th style="text-align: left;">&pound;'.$ftotal.'</th></tr>';
                                $table_row .= '<tr><td colspan="4" style="text-align: left;">'.$reason.'</td></tr>';
                            }
                            $content = '<div class="table-responsive"><table class="table table-bordered table-striped">'.$table_row.'</table></div>';
                            echo $content;
                        ?>
                    </div>
                </div>
                <?php endwhile; ?>
            </div> <!-- row -->
        </div>
<?php get_footer(); ?>