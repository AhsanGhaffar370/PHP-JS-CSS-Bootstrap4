<?php
/**
 Template Name: HOME
 */

get_header(); ?>


<!-- WELCOME SECTION START -->
<div class="motopress-wrapper slider-wrap clearfix">
  <div class="container-fluid">
    <div class="row">
      
    </div>
  </div>
</div>
<div class="clearfix"></div>
<!-- WELCOME SECTION END -->

<!-- BODY WRAPER SECTION START -->
<div class="motopress-wrapper content-holder clearfix">
  <div class="container-fluid">

    <div class="slider animate-in fadeInBottom" data-animation="load" data-show-screen="0.8" data-speed="1" style="margin-bottom: 30px;">
        <?php echo do_shortcode('[metaslider id="9"]'); ?>
    </div><!-- slider -->

      <?php echo do_shortcode('[BOOKINGFORM show="inner" parallex="yes"]'); ?>


    <div class="clearfix"></div>

<!-- ICONS BOXES START -->

<div class="icon_section" data-show-screen="0.8" data-animation="load" data-speed="1" style="transition: 1s;">
  <?php if(get_option_tree( 'home_page_heading1', '', false ) != ''){ ?>
  <div class="section_title why-us">
    <h2><?php echo get_option_tree( 'home_page_heading1', '', false ); ?></h2>
  </div>
  <?php } ?>

  <?php 
    if(get_option_tree( 'home_page_content1', '', false ) != ''){ 
      echo get_option_tree( 'home_page_content1', '', false ); 
    }
  ?>
  <div class="container">
    <div class="row section-c-carousel owl-carousel">
      <?php 
                    $query = new WP_Query( array( 
                        'post_type'     => 'special_offers', 
                        'post_status'   => 'publish',  
                        'posts_per_page'  => 4,
                        'order'  =>  'ASC',
                    ));
                    $count = 1;

                    while ( $query->have_posts() ) : $query->the_post();
                    if($count == 1){
                        $active = 'active';
                    } else {
                        $active = '';
                    }
                    $feat_image1 = get_post_meta(get_the_ID(), 'im_icon_img', true);

                    /*$link = get_post_meta(get_the_ID(),'im_icon_link', true);*/
                    $content = get_post_meta(get_the_ID(),'im_icon_content', true);
                    
              ?>
      <div class="item col-xs-12">
        <div class="box-new box-new-<?php echo $count; ?> <?php echo $active; ?>">
          <div class="icon-holder text-center">
            <img src="<?php echo $feat_image1; ?>" alt="icon">
          </div>
          <h4><?php the_title(); ?></h4>
          <!-- <p><?php echo strip_tags(substr($content, 0, 225)); ?></p> -->
          <!-- <a class="new-icon-link" href="<?php echo $link; ?>"></a> -->
        </div>
      </div>
      <?php $count++; endwhile; wp_reset_query(); ?>
    </div>
  </div>
</div>
<div class="clearfix"></div>
<!-- ICONS BOXES END -->
    
    <!-- SECTION A START -->       
        <div class="two-img-holder">  
          <?php if(get_option_tree( 'home_page_heading2', '', false ) != ''){ ?>
          <div class="section_title why-us">
            <h2><?php echo get_option_tree( 'home_page_heading2', '', false ); ?></h2>
          </div>
          <?php } ?>

          <?php 
            if(get_option_tree( 'home_page_content2', '', false ) != ''){ 
              echo get_option_tree( 'home_page_content2', '', false ); 
            }
          ?>

          <?php 
            $query = new WP_Query( array( 
              'post_type'     => 'business_carousel', 
              'post_status'   => 'publish',  
              'posts_per_page'  => 3,
              'order'  =>  'ASC',
            ));
            $count = 1;
            while ( $query->have_posts() ) : $query->the_post();
            $feat_image = get_post_meta(get_the_ID(), 'im_slide_img', true);
            $feat_image = aq_resize( $feat_image, 400, 250, true, true, true  );
            $feat_image2 = get_post_meta(get_the_ID(), 'im_slide_img2', true);
            $feat_image2 = aq_resize( $feat_image2, 400, 250, true, true, true  );
            $content = get_post_meta(get_the_ID(),'im_slide_long_content', true);
            $link = get_post_meta(get_the_ID(),'im_slide_link', true);
            if($count == 1){
              $active = 'active';
            } else {
              $active = '';
            }
          ?>
            <div class="col-xs-12 col-sm-4">
              <div class="section_one_post section_one_post-<?php echo $count; ?> <?php echo $active; ?>">
                <div class="service-box service-home-main">
                  <div class="section_one_img_holder">
                    <img style="width: 100%;" src="<?php echo $feat_image; ?>" alt="">
                    <img class="img_hvr" style="width: 100%;" src="<?php echo $feat_image2; ?>" alt="">
                  </div>
                </div>
                <h3><?php the_title(); ?></h3>
                <p><?php echo $content; ?></p>
              </div>
            </div>

          <?php $count++; endwhile; wp_reset_query(); ?> 
        </div>
      <!-- SECTION A END -->

  <!-- SECOND CAROUSEL START -->
                <div class="col-xs-12">
                    <div class="carousel-wrap successful-projects">
                                                <?php if(get_option_tree( 'home_page_heading3', '', false ) != ''){ ?>
                                                <div class="section_title why-us">
                                                  <h2><?php echo get_option_tree( 'home_page_heading3', '', false ); ?></h2>
                                                </div>
                                                <?php } ?>

                                                <?php 
                                                  if(get_option_tree( 'home_page_content3', '', false ) != ''){ 
                                                    echo get_option_tree( 'home_page_content3', '', false ); 
                                                  }
                                                ?>
                                                <div class="two-img-holder row">
                                                            <?php 
                                                              $query = new WP_Query( array( 
                                                                'post_type'     => 'personal_carousel', 
                                                                'post_status'   => 'publish',  
                                                                'posts_per_page'  => -1,
                                                                'order'  =>  'ASC',
                                                              ));
                                                              $count = 1;
                                                              while ( $query->have_posts() ) : $query->the_post();
                                                              $feat_image = get_post_meta(get_the_ID(), 'im_slide_img', true);
                                                              $feat_image = aq_resize( $feat_image, 300, 400, true, true, true  );
                                                              $feat_image2 = get_post_meta(get_the_ID(), 'im_slide_img2', true);
                                                              $feat_image2 = aq_resize( $feat_image2, 300, 400, true, true, true  );
                                                              $content = get_post_meta(get_the_ID(),'im_slide_content', true);
                                                              $link = get_post_meta(get_the_ID(),'im_slide_link', true);
                                                              if($count == 1){
                                                                $active = 'active';
                                                              } else {
                                                                $active = '';
                                                              }
                                                            ?>
                                                                <div class="col-xs-12 col-sm-3">
                                                                  <div class="section_two_post section_two_post-<?php echo $count; ?> <?php echo $active; ?>">
                                                                    <figure class="featured-thumbnail">
                                                                      <a href="<?php echo $link; ?>" title="omnis iste natus">
                                                                        <div class="section_two_img_holder">
                                                                          <img style="width: 100%;" src="<?php echo $feat_image; ?>" alt="">
                                                                          <img class="img_hvr" style="width: 100%;" src="<?php echo $feat_image2; ?>" alt="">
                                                                        </div>
                                                                      </a>
                                                                    </figure>
                                                                    <div class="desc">
                                                                        <h5>
                                                                          <a href="<?php echo $link; ?>" title=""><?php the_title(); ?></a>
                                                                        </h5>
                                                                        <p class="excerpt"><?php echo $content; ?></p>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                            <?php $count++; endwhile; wp_reset_query(); ?>
                                                        
                                                </div>
                                            </div>
                </div>
                <!-- SECOND CAROUSEL END -->
                <div class="clearfix"></div>  
                <!-- SERVICES START -->
                                            <div class="services_section">
                                                        <div class="services general-section text-center col-xs-12">
                                                            <?php if(get_option_tree( 'home_page_heading4', '', false ) != ''){ ?>
                                                              <div class="section_title why-us">
                                                                <h2><?php echo get_option_tree( 'home_page_heading4', '', false ); ?></h2>
                                                              </div>
                                                              <?php } ?>

                                                              <?php 
                                                                if(get_option_tree( 'home_page_content4', '', false ) != ''){ 
                                                                  echo get_option_tree( 'home_page_content4', '', false ); 
                                                                }
                                                            ?>  
                                                            <div class="row">
                                                              <?php 
                                                                $query = new WP_Query( array( 
                                                                  'post_type'     => 'home_section_1', 
                                                                  'post_status'   => 'publish',  
                                                                  'posts_per_page'  => 6,
                                                                  'order'  =>  'ASC',
                                                                ));
                                                                $count = 1;
                                                                while ( $query->have_posts() ) : $query->the_post();
                                                                $feat_imag1 = get_post_meta(get_the_ID(), 'im_section_img1', true);
                                                                $feat_imag1 = aq_resize( $feat_imag1, 400, 225, true, true, true  );
                                                                $feat_imag2 = get_post_meta(get_the_ID(), 'im_section_img2', true);
                                                                $feat_imag2 = aq_resize( $feat_imag2, 400, 225, true, true, true  );
                                                                $link1 = get_post_meta(get_the_ID(),'im_section_link1', true);
                                                                if($count == 1){
                                                                  $active = 'active';
                                                                } else {
                                                                  $active = '';
                                                                }
                                                              ?>
                                                              <div class="col-xs-12 col-sm-6 col-md-4">
                                                                <div class="general general-box-<?php echo $count; ?> <?php echo $active; ?>">
                                                                  <div class="image">
                                                                    <img class="full-width hvr-img" src="<?php echo $feat_imag1; ?>" alt="">
                                                                    <img class="full-width" src="<?php echo $feat_imag2; ?>" alt="">
                                                                  </div>
                                                                  <div class="inner-box"></div>
                                                                  <h2>
                                                                    <span><?php the_title(); ?></span>
                                                                  </h2>
                                                                  <a href="<?php echo $link1; ?>"></a>
                                                                </div> 
                                                              </div>
                                                             <?php $count++; endwhile; wp_reset_query(); ?>
                                                            </div>  
                                                        </div>
                                            </div>

                                            <!-- SERVICES END -->
                                            <div class="clearfix"></div>  

                                            
  </div>

  <!-- SERVICES START -->

                                            <div class="col-xs-12">
                                                            <div class="col-xs-12">
                                                              <?php if(get_option_tree( 'home_page_heading5', '', false ) != ''){ ?>
                                                                <div class="section_title why-us">
                                                                  <h2><?php echo get_option_tree( 'home_page_heading5', '', false ); ?></h2>
                                                                </div>
                                                                <?php } ?>

                                                                <?php 
                                                                  if(get_option_tree( 'home_page_content5', '', false ) != ''){ 
                                                                    echo get_option_tree( 'home_page_content5', '', false ); 
                                                                  }
                                                              ?>
                                                            </div>
                                                        

                                                      <div class="col-xs-12 section-c-carousel owl-carousel">
                                                      <?php 
                                                                $query = new WP_Query( array( 
                                                                  'post_type'     => 'home_section_3', 
                                                                  'post_status'   => 'publish',  
                                                                  'posts_per_page'  => 4,
                                                                  'order'  =>  'ASC',
                                                                ));
                                                                $count = 1;
                                                                while ( $query->have_posts() ) : $query->the_post();
                                                                $feat_imag1 = get_post_meta(get_the_ID(), 'im_section_img1', true);
                                                                $feat_imag1 = aq_resize( $feat_imag1, 275, 325, true, true, true  );
                                                                $feat_imag2 = get_post_meta(get_the_ID(), 'im_section_img2', true);
                                                                $feat_imag2 = aq_resize( $feat_imag2, 275, 325, true, true, true  );
                                                                $content = get_post_meta(get_the_ID(), 'im_section_content', true);
                                                                $link = get_post_meta(get_the_ID(),'im_section_link', true);
                                                                if($count == 1){
                                                                  $active = 'active';
                                                                } else {
                                                                  $active = '';
                                                                }
                                                              ?>        
                                                      <div class="item new-bottom-box">
                                                            <div class="single_post">
                                                              <h3><?php the_title(); ?></h3>
                                                              <div class="image">
                                                                <img class="full-width hvr-img" src="<?php echo $feat_imag1; ?>" alt="">
                                                                <img class="full-width" src="<?php echo $feat_imag2; ?>" alt="">
                                                              </div>
                                                              <p><?php echo $content; ?></p>
                                                              <a href="<?php echo $link; ?>" class="btn">Detail</a>
                                                          </div>
                                                      </div> 
                                                      <?php $count++; endwhile; wp_reset_query(); ?>
                                                    </div>
                                                          
                                            
                                        </div>

                                            <!-- SERVICES END -->

</div>
<div class="clearfix"></div>
<!-- BODY WRAPER SECTION END -->

<!-- BOTTOM CONTACT START -->
<div class="bottom_contact animate-in fadeInTop" data-animation="load" data-show-screen="0.8" data-speed="1" style="transition: 1s;">
  <div class="container-fluid">
    <div class="row">
      <div class="com-xs-12 text-center">
        <h3>CONTACT US</h3>
      </div>
    </div>
  </div>
  <div class="home-form container-fluid">
      <div class="row">
          <?php echo do_shortcode('[contact-form-7 id="113" title="Home Page Contact form"]'); ?>
      </div>
  </div>
</div>
<div class="clearfix"></div>
<!-- BOTTOM CONTACT END -->

<!-- MAP START -->
    <div class="home-map-holder">
        <?php echo get_option_tree( 'map', '', false ); ?>
    </div>
<!-- MAP END -->

<div class="clearfix"></div>
<?php get_footer(); ?>