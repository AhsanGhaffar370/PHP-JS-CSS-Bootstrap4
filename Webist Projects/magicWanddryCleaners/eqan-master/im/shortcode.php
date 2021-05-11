<?php
// Adding font Awosome to wp head
function font_awesome_icons() {
    echo '<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/fontawesome.css" integrity="sha384-4aon80D8rXCGx9ayDt85LbyUHeMWd3UiBaWliBlJ53yzm9hqN21A+o1pqoyK04h+" crossorigin="anonymous">';
}
add_action('admin_head', 'font_awesome_icons');

// Addign font awosam as post type icon
function post_type_service_icon(){
?>
    <style>
        #adminmenu #menu-posts-im_services .wp-menu-image:before {
            content: "\f214";
            font-family: 'FontAwesome' !important;
            font-size: 18px !important;
        }
    </style>
<?php   
}
add_action('admin_head', 'post_type_service_icon');

add_action( 'init', 'im_booking' );
function im_booking() {

    $labels = array(
        'name'                => _x( 'Booking', 'Post Type General Name', 'im' ),
        'singular_name'       => _x( 'Booking', 'Post Type Singular Name', 'im' ),
        'menu_name'           => __( 'Booking', 'im' ),
        'parent_item_colon'   => __( 'Parent Booking:', 'im' ),
        'all_iteim'           => __( 'All Bookings', 'im' ),
        'view_item'           => __( 'View Booking', 'im' ),
        'add_new_item'        => __( 'Add New Booking', 'im' ),
        'add_new'             => __( 'Add New Booking', 'im' ),
        'edit_item'           => __( 'Edit Booking', 'im' ),
        'update_item'         => __( 'Update Booking', 'im' ),
        'search_iteim'        => __( 'Search Booking', 'im' ),
        'not_found'           => __( 'No Booking found', 'im' ),
        'not_found_in_trash'  => __( 'No Booking found in Trash', 'im' ),
    );
    $args = array(
        'label'               => __( 'Booking', 'im' ),
        'description'         => __( 'Booking LIst information pages', 'im' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'revisions'),
        'taxonomies'          => array( '' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 30,
        'menu_icon'           => 'dashicons-clipboard',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'rewrite' => array(
            'slug' => 'booking-detail',
            'with_front' => false,
        ) ,
    );
    register_post_type( 'im_booking', $args );
    flush_rewrite_rules();
}

add_action( 'init', 'im_services' );
function im_services() {

    $labels = array(
        'name'                => _x( 'Item', 'Post Type General Name', 'im' ),
        'singular_name'       => _x( 'Item', 'Post Type Singular Name', 'im' ),
        'menu_name'           => __( 'All Items', 'im' ),
        'parent_item_colon'   => __( 'Parent Item:', 'im' ),
        'all_iteim'           => __( 'All Items', 'im' ),
        'view_item'           => __( 'View Item', 'im' ),
        'add_new_item'        => __( 'Add New Item', 'im' ),
        'add_new'             => __( 'Add New Item', 'im' ),
        'edit_item'           => __( 'Edit Item', 'im' ),
        'update_item'         => __( 'Update Item', 'im' ),
        'search_iteim'        => __( 'Search Item', 'im' ),
        'not_found'           => __( 'No Item found', 'im' ),
        'not_found_in_trash'  => __( 'No Item found in Trash', 'im' ),
    );
    $args = array(
        'label'               => __( 'Item', 'im' ),
        'description'         => __( 'Item information pages', 'im' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'revisions'),
        'taxonomies'          => array( '' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 30,
        'menu_icon'           => 'dashicons-tag',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'rewrite' => array(
            'slug' => 'service',
            'with_front' => false,
        ) ,
    );
    register_post_type( 'im_services', $args );
    flush_rewrite_rules();
}

add_action( 'init', 'service_type', 0 );
    
function service_type() {
    
  $labels = array(
    'name' => _x( 'Service', 'im' ),
    'singular_name' => _x( 'Service', 'im' ),
    'search_items' =>  __( 'Search Service' ),
    'all_items' => __( 'All Services' ),
    'parent_item' => __( 'Parent Service' ),
    'parent_item_colon' => __( 'Service Topic:' ),
    'edit_item' => __( 'Edit Service' ), 
    'update_item' => __( 'Update Service' ),
    'add_new_item' => __( 'Add New Service' ),
    'new_item_name' => __( 'New Service Name' ),
    'menu_name' => __( 'Services' ),
  );    
  
  register_taxonomy('service_type',array('im_services'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'type' ),
    'capabilites'       => array(
        'manage_terms'  => 'edit_posts',
        'edit_terms'    => 'edit_posts',
        'delete_terms'  => 'edit_posts',
        'assign_terms'  => 'edit_posts'
    )
  ));

}

add_action( 'init', 'im_referral' );
function im_referral() {

    $labels = array(
        'name'                => _x( 'Referral', 'Post Type General Name', 'im' ),
        'singular_name'       => _x( 'Referral', 'Post Type Singular Name', 'im' ),
        'menu_name'           => __( 'All Referrals', 'im' ),
        'parent_item_colon'   => __( 'Parent Referral:', 'im' ),
        'all_iteim'           => __( 'All Referrals', 'im' ),
        'view_item'           => __( 'View Referral', 'im' ),
        'add_new_item'        => __( 'Add New Referral', 'im' ),
        'add_new'             => __( 'Add New Referral', 'im' ),
        'edit_item'           => __( 'Edit Referral', 'im' ),
        'update_item'         => __( 'Update Referral', 'im' ),
        'search_iteim'        => __( 'Search Referral', 'im' ),
        'not_found'           => __( 'No Referral found', 'im' ),
        'not_found_in_trash'  => __( 'No Referral found in Trash', 'im' ),
    );
    $args = array(
        'label'               => __( 'Referral', 'im' ),
        'description'         => __( 'Referral information pages', 'im' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'revisions'),
        'taxonomies'          => array( '' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 30,
        'menu_icon'           => 'dashicons-groups',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'rewrite' => array(
            'slug' => 'referral',
            'with_front' => false,
        ) ,
    );
    register_post_type( 'im_referral', $args );
    flush_rewrite_rules();
}

add_filter( 'cmb2_meta_boxes', 'im_metaboxes_booking' );

function im_metaboxes_booking( array $meta_boxes ) {
  
    $prefix = 'im_';

    $meta_boxes['im_im_services_metabox'] = array(
        'id'            => 'im_im_services_metabox',
        'title'         => __( 'Service Information', 'im' ),
        'object_types'  => array( 'im_services' ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        'fields'        => array(
            array(
                'name' => __( 'Price', 'im' ),
                'id'   => $prefix.'price',
                'desc'       => 'Add price', 
                'type'         => 'text',
            ),
            array(
                'name' => __( 'Price Before Text', 'im' ),
                'id'   => $prefix.'before',
                'desc'       => 'Add price before text', 
                'type'         => 'text',
            ),
            array(
                'name' => __( 'Price After Text', 'im' ),
                'id'   => $prefix.'after',
                'desc'       => 'Add price after text', 
                'type'         => 'text',
            ),
        ),    
    );

    return $meta_boxes;
}

// Tanonomy Metaboxes
add_filter('cmb2-taxonomy_meta_boxes', 'cmb2_taxonomy_sample_metaboxes');
function cmb2_taxonomy_sample_metaboxes( array $meta_boxes ) {

    $prefix = 'im_';

    $meta_boxes['service_type_meta'] = array(
        'id'            => 'service_type_meta',
        'title'         => __( '', 'im' ),
        'object_types'  => array( 'service_type', ), // Taxonomy
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        'fields'        => array(
            array(
                'name'       => __( 'Featured Image', 'im' ),
                'id'         => $prefix . 'img',
                'type'       => 'file'
            ),
            array(
                'name'       => __( 'Icon For Mobile APP', 'im' ),
                'id'         => $prefix . 'icon',
                'type'       => 'file'
            ),
        ),
    );

    return $meta_boxes;
}

// Price List
function _im_service_list() {
    ob_start(); 
            $args = array(
                'taxonomy'     => 'service_type',
                'orderby'      => 'id',
                'parent' => 0,
                'depth'             => 1,
            );
            $all_categories = get_categories( $args );
        ?>
            <div class="table-responsive">
                <table class="table table-bordered remove-table-bordered">
        <?php    
            foreach ($all_categories as $cat){
                echo '<tr class="header-row">';
                    echo '<th colspan="4">'.$cat->name.'</th>';
                echo '</tr>';
                $args = array(
                        'taxonomy'     => 'service_type',
                        'orderby'      => 'id',
                        'parent'    => $cat->cat_ID,
                        'hide_empty' => 0,
                        'depth' => 1,
                    );
                    $childrens = get_categories($args);
                    foreach ($childrens as $children){
                        echo '<tr>';
                            echo '<th colspan="4">'.$children->name.'</th>';
                        echo '</tr>';
                        
                        if( $childrens ) {
                            $query = new WP_Query( array( 'post_type' =>  'im_services', 'tax_query' => array( array( 'taxonomy' => 'service_type', 'field' => 'id', 'terms' => $children->cat_ID)), 'post_status' => 'publish',  'posts_per_page' => -1, 'order' => 'ASC' ) );
                            $count_row = 1;
                            while ( $query->have_posts() ) : $query->the_post();
                                $price = get_post_meta(get_the_ID(), 'im_price', true);
                                $before_price = get_post_meta(get_the_ID(), 'im_before', true);
                                $after_price = get_post_meta(get_the_ID(), 'im_after', true);
                                if($count_row == 1){
                                    echo '<tr>';
                                }
                                echo '<td>'.get_the_title().'</td>';
                                echo '<td>';
                                    if($before_price != ''){
                                        echo $before_price.' ';
                                    }
                                    if($price != 0 && is_numeric($price)){ echo '&pound;'.$price; } 
                                    if($after_price != ''){
                                        echo $after_price.' ';
                                    }
                                
                                echo '</td>';
                                if($count_row == 2){
                                    echo '</tr>';
                                    $count_row = 0;
                                }
                            $count_row++; endwhile;wp_reset_query();
                        }
                    }
                    
                    $query = new WP_Query( array( 'post_type' =>  'im_services', 'tax_query' => array( array( 'taxonomy' => 'service_type', 'field' => 'id', 'include_children' => false, 'terms' => $cat->cat_ID)), 'post_status' => 'publish',  'posts_per_page' => -1, 'order' => 'ASC' ) );
                    $count_row = 1;
                    while ( $query->have_posts() ) : $query->the_post();
                        $price = get_post_meta(get_the_ID(), 'im_price', true);
                        $before_price = get_post_meta(get_the_ID(), 'im_before', true);
                        $after_price = get_post_meta(get_the_ID(), 'im_after', true);
                        if($count_row == 1){
                            echo '<tr>';
                        }
                        echo '<td>'.get_the_title().'</td>';
                        echo '<td>';
                                    if($before_price != ''){
                                        echo $before_price.' ';
                                    }
                                    if($price != 0 && is_numeric($price)){ echo '&pound;'.$price; } 
                                    if($after_price != ''){
                                        echo $after_price.' ';
                                    }
                        echo '</td>';
                        if($count_row == 2){
                            echo '</tr>';
                            $count_row = 0;
                        }
                    $count_row++; endwhile;wp_reset_query();
            }
        ?>
                </table>
            </div>
        <?php
       
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
add_shortcode( 'SERVICELIST', '_im_service_list' );

// Booking Form
function _im_booking_form($atts){
    ob_start(); 
    // Attributes
    $atts = shortcode_atts(
        array(
            'show' => '',
            'parallex' => '',
        ),
        $atts
    ); 
    $show = $atts['show'];
    if($show == 'inner'){
        $container = 'container-fluid';
        $class = '';
    } else {
        $container = 'container';
        $class = 'upper-form-container';
    } 
    $parallex = $atts['parallex'];
    if($parallex == 'yes'){
        $parallex_class = 'parallex-form';
        $overlay_div = '<div class="form-overlay"></div>';
    } else {
        $parallex_class = '';
        $overlay_div = '';
    }
?>          
        <form action="" method="post">
            <?php 
                if(isset($_POST['submit-form'])){
                    
                    $count = 0;
                    $grand_total = 0;
                    
                    $primary_color = im_get_option( 'im_primary_bg' );
                    if($primary_color == ''){
                        $primary_color = '#3C8DBC';
                    }
                    $secondary_color = im_get_option( 'im_secondary_bg' );
                    if($secondary_color == ''){
                        $secondary_color = '#222D32';
                    }

                    $name = sanitize_text_field($_POST['full_name']);
                    $email = sanitize_text_field($_POST['email']);
                    $contact = sanitize_text_field($_POST['contact']);
                    $address = sanitize_text_field($_POST['address']);
                    $post_code = sanitize_text_field($_POST['post_code']);
                    $address1 = sanitize_text_field($_POST['address1']);
                    $post_code1 = sanitize_text_field($_POST['post_code1']);
                    $pdate = sanitize_text_field($_POST['pdate']);
                    $ptime = sanitize_text_field($_POST['ptime']);
                    $date = sanitize_text_field($_POST['date']);
                    $time = sanitize_text_field($_POST['time']);
                    $user_note = sanitize_text_field($_POST['user-note']);
                    $reference_name = $_POST['reference_name'];
                    $reference_email = $_POST['reference_email'];

                    $table_row = '<tr><th>Title</th><th>Price</th><th>Qty</th><th>Total</th></tr>';
                    
                    foreach($_POST['qty'] as $qty){
                        if($qty != '0' && $qty != ''){
                            $grand_total = $grand_total + $_POST['total'][$count];
                            $table_row .= '<tr>';
                            $table_row .= '<td>'.sanitize_text_field($_POST['title'][$count]).'</td>';
                            $table_row .= '<td>'.sanitize_text_field($_POST['price'][$count]).'</td>';
                            $table_row .= '<td>'.sanitize_text_field($_POST['qty'][$count]).'</td>';
                            $table_row .= '<td>'.sanitize_text_field($_POST['total'][$count]).'</td>';
                            $table_row .= '</tr>';
                        }
                    $count++;   
                    }

                    $user_id = get_current_user_id();
                    if(empty(get_user_meta($user_id, 'im_address', true))){
                        update_user_meta($user_id, 'im_address', $address);
                    }
                    if(empty(get_user_meta($user_id, 'im_postcode', true))){
                        update_user_meta($user_id, 'im_postcode', $post_code);
                    }
                    // Check referral discount
                    $referral_discount = get_referral_discount($email, $user_id);
                    $referral_discount['credit'];

                    if($grand_total > 20){
                        $shipping = 0;
                        $shipping_str = 'Free';
                    } else {
                        $shipping = '5.00';
                        $shipping_str = '&pound;'.$shipping;
                    }

                    if($referral_discount['credit'] > 0){
                        update_user_meta($user_id, 'im_credit', 0);
                        $grand_total = $grand_total - $referral_discount['credit'];
                        $table_row .= '<tr><th style="text-align: left;">Credit</th><th>&nbsp;</th><th>&nbsp;</th><th style="text-align: left;">-&pound;'.number_format($referral_discount['credit'], 2).'</th></tr>';  
                    }

                    if($referral_discount['discount'] > 0){
                        $grand_total = $grand_total - $referral_discount['discount'];
                        $table_row .= '<tr><th style="text-align: left;">Referral Discount</th><th>&nbsp;</th><th>&nbsp;</th><th style="text-align: left;">-&pound;'.$referral_discount['discount'].'</th></tr>';  
                    }

                    if($discount > 0){
                        $after_discoint = $grand_total - $grand_total * $discount / 100; 
                        $after_discoint = $after_discoint + $shipping; 
                        $after_discoint = round($after_discoint, 2);
                        $discoint_amount = $after_discoint - $grand_total; 
                        $discoint_amount = round($discoint_amount, 2);
                        $grand_total = $after_discoint;
                        $table_row .= '<tr><th style="text-align: left;">Discount ('.$discount.'%)</th><th>&nbsp;</th><th>&nbsp;</th><th style="text-align: left;">&pound;'.$discoint_amount.'</th></tr>';
                        $table_row .= '<tr><th style="text-align: left;">Delivery Charges</th><th>&nbsp;</th><th>&nbsp;</th><th style="text-align: left;">'.$shipping_str.'</th></tr>';
                        $table_row .= '<tr><th style="text-align: left;">Estimate Total</th><th>&nbsp;</th><th>&nbsp;</th><th style="text-align: left;">&pound;'.$grand_total.'</th></tr>';
                    } else {
                        $grand_total = $grand_total + $shipping;
                        $table_row .= '<tr><th style="text-align: left;">Delivery Charges</th><th>&nbsp;</th><th>&nbsp;</th><th style="text-align: left;">'.$shipping_str.'</th></tr>';
                        $table_row .= '<tr><th style="text-align: left;">Estimate Total</th><th>&nbsp;</th><th>&nbsp;</th><th style="text-align: left;">&pound;'.$grand_total.'</th></tr>';
                    }
                    
                    $content = '<div class="table-responsive"><table class="table table-bordered table-striped">'.$table_row.'</table></div>';
                    
                    // Create booking
                    $my_post = array(
                        'post_title'    => '',
                        'post_status'   => 'publish',
                        'post_type' => 'im_booking',
                        'post_author'   => $user_id,
                    );
                    $post_id = wp_insert_post( $my_post, $wp_error );
                    $booking_id = 'MWDC-'.$post_id;
                    $booking_title = implode(",",$_POST['title']);
                    $booking_title = sanitize_text_field($booking_title);
                    $booking_price = implode(",",$_POST['price']);
                    $booking_price = sanitize_text_field($booking_price);
                    $booking_qty = implode(",",$_POST['qty']);
                    $booking_qty = sanitize_text_field($booking_qty);
                    $booking_total = implode(",",$_POST['total']);
                    $booking_total = sanitize_text_field($booking_total);
                    add_post_meta($post_id, 'im_content', $content, true);
                    add_post_meta($post_id, 'im_total', $grand_total, true);
                    add_post_meta($post_id, 'im_name', $name, true);
                    add_post_meta($post_id, 'im_email', $email, true);
                    add_post_meta($post_id, 'im_contact', $contact, true);
                    add_post_meta($post_id, 'im_address', $address, true);
                    add_post_meta($post_id, 'im_post_code', $post_code, true);
                    add_post_meta($post_id, 'im_address1', $address1, true);
                    add_post_meta($post_id, 'im_post_code1', $post_code1, true);
                    add_post_meta($post_id, 'im_title', $booking_title, true);
                    add_post_meta($post_id, 'im_price', $booking_price, true);
                    add_post_meta($post_id, 'im_qty', $booking_qty, true);
                    add_post_meta($post_id, 'im_table_data', $table_row, true);
                    add_post_meta($post_id, 'im_total', $booking_total, true);
                    add_post_meta($post_id, 'im_ftotal', '', true);
                    add_post_meta($post_id, 'im_discount', $discount, true);
                    add_post_meta($post_id, 'im_shipping', $shipping, true);
                    add_post_meta($post_id, 'im_pdate', $pdate, true);
                    add_post_meta($post_id, 'im_ptime', $ptime, true);
                    add_post_meta($post_id, 'im_date', $date, true);
                    add_post_meta($post_id, 'im_time', $time, true);
                    add_post_meta($post_id, 'im_user_note', $user_note, true);
                    add_post_meta($post_id, 'im_booking_source', 'desktop', true);
                    add_post_meta($post_id, 'im_referral_name', $reference_name, true);
                    add_post_meta($post_id, 'im_referral_email', $reference_email, true);
                    if($referral_discount['discount'] > 0){
                        add_post_meta($post_id, 'im_referral_discount', $referral_discount['discount'], true);
                    } else {
                        add_post_meta($post_id, 'im_referral_discount', 0, true);
                    }
                    if($referral_discount['credit'] > 0){
                        add_post_meta($post_id, 'im_referral_credit', $referral_discount['credit'], true);
                    } else {
                        add_post_meta($post_id, 'im_referral_credit', 0, true);
                    }

                    // Update post title
                    $update_booking = get_post($post_id);
                    $update_booking->post_title = $booking_id;
                    wp_update_post( $update_booking );


                    // Add referral
                    if(!empty($reference_name) && !empty($reference_email)){
                        $referral_email = $reference_email;
                        $count = 0;
                        foreach($reference_name as $referral){
                            if($referral != ''){
                                $referral_name = $referral;
                                $my_referral = array(
                                    'post_title'    => $referral_email[$count],
                                    'post_status'   => 'publish',
                                    'post_type' => 'im_referral',
                                );
                                $referral_id = wp_insert_post( $my_referral, $wp_error );
                                add_post_meta($referral_id, 'im_referral_name', $referral);
                                add_post_meta($referral_id, 'im_referral_email', $referral_email[$count]);
                                add_post_meta($referral_id, 'im_referral_by', $user_id);
                            }
                            $count++;
                        }
                    }

                    $site_name =  get_bloginfo('name');
                    $mailuser = get_bloginfo('admin_email');
                    $subject = get_bloginfo('name').' Booking Form Details';
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";    
                    $headers .= 'From: '.$site_name.' <noreply@domain.com>' . "\r\n";
                    $message = '<html>';
                    $message .= '<body bgcolor="#FFFFFF" marginwidth="10" marginheight="10" topmargin="10" leftmargin="10">';       
                        
                    $message .= '<table cellpadding="10" cellspacing="10" border="0" width="700">';
                      $message .= '<tr><td bgcolor="'.$primary_color.'" colspan="4" align="center"><font face="arial" size="7" color="#FFFFFF">'.$site_name.'</td></tr>';
                      $message .= '<tr><td bgcolor="#CCCCCC" colspan="4" align="center"><font face="arial" size="5" color="#000000"><b>USER DETAIL</b></td></tr>';
                      $message .= '<tr><td bgcolor="#cf3247" width="200"><font face="arial" size="2"color="#FFFFFF">Full Name: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$name.'</td></tr>';
                      $message .= '<tr><td bgcolor="#cf3247" width="200"><font face="arial" size="2"color="#FFFFFF">Email Address: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$email.'</td></tr>';
                      $message .= '<tr><td bgcolor="#cf3247" width="200"><font face="arial" size="2"color="#FFFFFF">Contact No.: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$contact.'</td></tr>';
                      $message .= '<tr><td bgcolor="#cf3247" width="200"><font face="arial" size="2"color="#FFFFFF">Collection Date: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$date.'</td></tr>';
                      $message .= '<tr><td bgcolor="#cf3247" width="200"><font face="arial" size="2"color="#FFFFFF">Collection Time: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$time.'</td></tr>';
                      $message .= '<tr><td bgcolor="#cf3247" width="200"><font face="arial" size="2"color="#FFFFFF">Address: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$address.'</td></tr>';
                      $message .= '<tr><td bgcolor="#cf3247" width="200"><font face="arial" size="2"color="#FFFFFF">Post Code: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$post_code.'</td></tr>';
                      $message .= '<tr><td bgcolor="#cf3247" width="200"><font face="arial" size="2"color="#FFFFFF">Delivery Date: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$pdate.'</td></tr>';
                      $message .= '<tr><td bgcolor="#cf3247" width="200"><font face="arial" size="2"color="#FFFFFF">Delivery Time: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$ptime.'</td></tr>';
                      $message .= '<tr><td bgcolor="#cf3247" width="200"><font face="arial" size="2"color="#FFFFFF">Delivery Address: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$address1.'</td></tr>';
                      $message .= '<tr><td bgcolor="#cf3247" width="200"><font face="arial" size="2"color="#FFFFFF">Delivery Post Code: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$post_code1.'</td></tr>';
                      $message .= '<tr><td bgcolor="#cf3247" width="200"><font face="arial" size="2"color="#FFFFFF">Special Notes: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$user_note.'</td></tr>';
                      $message .= '<tr><td bgcolor="#CCCCCC" colspan="4" align="center"><font face="arial" size="5" color="#000000"><b>ORDER DETAIL</b></td></tr>';
                      $message .= '<tr><td bgcolor="#cf3247" width="200"><font face="arial" size="2"color="#FFFFFF">Order ID: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$booking_id.'</td></tr>';
                      $message .= $table_row;
                    $message .= '</table>';

                    $message .= '</body>';
                    $message .= '</html>';

                    $user_message = '<html>';
                    $user_message .= '<body bgcolor="#FFFFFF" marginwidth="10" marginheight="10" topmargin="10" leftmargin="10">';       
                        
                    $user_message .= '<table cellpadding="10" cellspacing="10" border="0" width="700">';
                      $user_message .= '<tr><td bgcolor="'.$primary_color.'" colspan="4" align="center"><font face="arial" size="7" color="#FFFFFF">'.$site_name.'</td></tr>';
                      $user_message .= '<tr><td bgcolor="#CCCCCC" colspan="4" align="center"><font face="arial" size="5" color="#000000"><b>USER DETAIL</b></td></tr>';
                      $user_message .= '<tr><td bgcolor="#cf3247" colspan="4" align="center"><font face="arial" size="2" color="#ffffff">You will be contacted for delivery date and time and for any bespoke services,<br> please contact us on '.get_option_tree( 'contact_no', '', false ).'</td></tr>';
                      $user_message .= '<tr><td bgcolor="#cf3247" width="200"><font face="arial" size="2"color="#FFFFFF">Full Name: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$name.'</td></tr>';
                      $user_message .= '<tr><td bgcolor="#cf3247" width="200"><font face="arial" size="2"color="#FFFFFF">Email Address: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$email.'</td></tr>';
                      $user_message .= '<tr><td bgcolor="#cf3247" width="200"><font face="arial" size="2"color="#FFFFFF">Contact No.: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$contact.'</td></tr>';
                      $user_message .= '<tr><td bgcolor="#cf3247" width="200"><font face="arial" size="2"color="#FFFFFF">Collection Date: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$date.'</td></tr>';
                      $user_message .= '<tr><td bgcolor="#cf3247" width="200"><font face="arial" size="2"color="#FFFFFF">Collection Time: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$time.'</td></tr>';
                      $user_message .= '<tr><td bgcolor="#cf3247" width="200"><font face="arial" size="2"color="#FFFFFF">Address: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$address.'</td></tr>';
                      $user_message .= '<tr><td bgcolor="#cf3247" width="200"><font face="arial" size="2"color="#FFFFFF">Post Code: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$post_code.'</td></tr>';
                      $user_message .= '<tr><td bgcolor="#cf3247" width="200"><font face="arial" size="2"color="#FFFFFF">Delivery Date: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$pdate.'</td></tr>';
                      $user_message .= '<tr><td bgcolor="#cf3247" width="200"><font face="arial" size="2"color="#FFFFFF">Delivery Time: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$ptime.'</td></tr>';
                      $user_message .= '<tr><td bgcolor="#cf3247" width="200"><font face="arial" size="2"color="#FFFFFF">Delivery Address: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$address1.'</td></tr>';
                      $user_message .= '<tr><td bgcolor="#cf3247" width="200"><font face="arial" size="2"color="#FFFFFF">Delivery Post Code: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$post_code1.'</td></tr>';
                      $user_message .= '<tr><td bgcolor="#cf3247" width="200"><font face="arial" size="2"color="#FFFFFF">Special Notes: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$user_note.'</td></tr>';
                      $user_message .= '<tr><td bgcolor="#CCCCCC" colspan="4" align="center"><font face="arial" size="5" color="#000000"><b>ORDER DETAIL</b></td></tr>';
                      $user_message .= $table_row;
                    $user_message .= '</table>';

                    $user_message .= '</body>';
                    $user_message .= '</html>';

                    wp_mail( $mailuser, $subject, $message, $headers );
                    wp_mail( $email, $subject, $user_message, $headers );
                    
                    $site_name = get_bloginfo('name');
                    $site_name = str_replace(' ', '-', strtolower($site_name));
                    $site_name."-order-items";
            ?>
                    <script>
                        localStorage.setItem("<?php echo $site_name; ?>-order-items", '');
                    </script>
                    <div class="modal show inner-model" id="myModal1" role="dialog">
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
            <?php       
                    
                }
            ?>
        <div class="bottom_contact top_contact eqan-contact animate-in fadeInTop" data-animation="load" data-show-screen="0.8" data-speed="1" style="transition: 1s;">
            <div class="container-fluid">
              <div class="row">
                <div class="com-xs-12 text-center">
                  <h3>QUICK BOOKING FORM</h3>
                </div>
              </div>
            </div>
            <div class="home-form <?php echo $container; ?> <?php echo $class; ?> eqan-booking-form <?php echo $parallex_class; ?>">
            <?php //if(is_user_logged_in() ){ ?>
                <?php echo $overlay_div; ?>
                <p>Thank you for visiting our website and spending time on it. Please provide the required details and submit BOOKING FORM. I would like to appreciate you for writing to us. A copy of the BOOKING DETAILS will be sent to you through email. It is to inform you that this is a conditional booking. One of our staff representative will confirm you via phone call of the availability or unavailability of your chosen slot as per our schedule. Let us know if there is anything else we can help you with. If the inquiry is urgent you can please call on 020 8348 7295 for an immediate response.</p>
                <div class="row">   
                    <!-- <div class="col-xs-12 form-text">
                        <?php //echo get_option_tree( 'booking_to_text', '', false ); ?>
                    </div> -->
                    <?php 
                    if(is_user_logged_in() ){
                        $current_user = wp_get_current_user();
                        $contact_person = get_user_meta($current_user->ID, 'first_name', true);
                        $contact_email = $current_user->user_email;
                        $contact_phone = get_user_meta($current_user->ID, 'im_contact', true);
                        $contact_address = get_user_meta($current_user->ID, 'im_address', true);
                        $contact_postcode = get_user_meta($current_user->ID, 'im_postcode', true);
                        $login_overlay = '';
                        $login_button = '<input type="submit" name="submit-form" value="ORDER SUBMIT">';
                    } else {
                        $contact_person = '';
                        $contact_email = '';
                        $contact_phone = '';
                        $contact_address = '';
                        $contact_postcode = '';
                        $login_overlay = '<a class="xoo-el-login-tgr" href="#" style="position: absolute; top: 0; left: 0; z-index: 1; height: 100%; width: 100%;"></a>';
                        $login_button = '<div class="text-center"><span style="display: inline-block; width: 180px; margin: 0;" class="order-button-holder"><a href="#" class="xoo-el-login-tgr" style="margin-bottom: 0 !important;">ORDER SUBMIT</a></span></div>';
                    }
                    ?>
                    <form action="" method="post">
                        <div class="col-xs-12">
                            <h4 class="laundry-form-heading">Dry-Cleaning and Laundry Items:</h4>
                        </div>
                        <div class="repeatable-box">
                            <div class="repeat-holder">
                                <div class="col-xs-12 col-sm-3 col-md-4 left-box eqan-service-holder">
                                    <select name="title[]" class="eqan_service selectpicker" data-live-search="true" data-container="body">
                                        <option value="">Select Item form Laundry / Dry Cleaning</option>
                                        <?php 
                                            $args = array(
                                                'taxonomy'     => 'service_type',
                                                'orderby'      => 'id',
                                                'parent'    => $cat->cat_ID,
                                                'hide_empty' => 0,
                                                'depth' => 1,
                                            );
                                            $childrens = get_categories($args);
                                            foreach ($childrens as $children){
                                            echo '<optgroup label="'.$children->name.'">';
                                        ?>
                                        <?php 
                                                $query = new WP_Query( array( 'post_type' =>  'im_services', 'tax_query' => array( array( 'taxonomy' => 'service_type', 'field' => 'id', 'terms' => $children->cat_ID)), 'post_status' => 'publish',  'posts_per_page' => -1, 'order' => 'ASC' ) );
                                                    while ( $query->have_posts() ) : $query->the_post();
                                                        $price = get_post_meta(get_the_ID(), 'im_price', true);
                                                        $before_price = get_post_meta(get_the_ID(), 'im_before', true);
                                                        $after_price = get_post_meta(get_the_ID(), 'im_after', true);
                                                        if($price != 0 && is_numeric($price)){
                                                ?>
                                                <option data-id="<?php echo get_the_ID(); ?>" data-price="<?php echo $price; ?>" value="<?php the_title(); ?>"><?php the_title(); ?></option>
                                                <?php } endwhile; wp_reset_query(); 
                                            echo '</optgroup>';
                                            }
                                        ?>
                                    </select>
                                    <div id="select2-holder"></div>
                                    <?php //echo $login_overlay; ?>
                                </div>
                                <div class="col-xs-7 col-sm-4 col-md-4 middel-box">
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-4 col-md-6 left-box less-right-on-mobile">
                                            <input type="number" class="service-current-qty" min="1" name="qty[]" value="" placeholder="Qty" autocomplete="off">
                                        </div>
                                        <div class="col-xs-6 col-sm-4 col-md-6 right-box less-middel-on-mobile">
                                            <input type="text" class="service-price" name="dead-price[]" value="" disabled placeholder="Price">
                                            <input type="hidden" class="service-price" name="price[]" value="">
                                            <input type="hidden" class="row-id" name="id[]" value="">
                                        </div>
                                    </div>  
                                </div>
                                <div class="col-xs-5 col-sm-4 col-md-4 right-box less-left-on-mobile">
                                    <div class="row">
                                        <div class="col-xs-8 col-sm-9 col-md-10 left-box">
                                            <input type="text" class="row-total dead-total" name="dead-total[]" value="" disabled placeholder="Amount">
                                            <input type="hidden" class="row-total" name="total[]" value="">
                                        </div>
                                        <div class="col-xs-4 col-sm-3 col-md-2 right-box text-right">
                                            <span class="add-btn">
                                                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/plus.png" alt="">
                                            </span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="col-xs-12">
                            <h4 class="laundry-form-heading" style="margin-top: 30px;">Collection and Delivery Details:</h4>
                        </div>

                        <div class="col-xs-6 col-sm-3 left-box">
                            <input required class="datepicker" id="datepicker1" type="text" name="date" placeholder="Collection Date" autocomplete="off">  

                        </div>                    
                        <div class="col-xs-6 col-sm-3 right-box">
                            <select name="time" id="ctime" required>
                                <option value="">Collection Time</option>
                                <option value="08:00 AM - 11:00 AM">08:00 AM - 11:00 AM</option>
                                <option value="11:00 AM - 03:00 PM">11:00 AM - 03:00 PM</option>
                                <option value="03:00 PM - 07:00 PM">03:00 PM - 07:00 PM</option>
                            </select>  
                        </div>
                         
                        <div class="col-xs-6 col-sm-3 left-box">
                            <input required class="datepicker" id="datepicker2" type="text" name="pdate" placeholder="Delivery Date" autocomplete="off">  
                        </div>                    
                        <div class="col-xs-6 col-sm-3 right-box">
                            <select name="ptime" id="dtime" required>
                                <option value="">Delivery Time</option>
                                <option value="08:00 AM - 11:00 AM">08:00 AM - 11:00 AM</option>
                                <option value="11:00 AM - 03:00 PM">11:00 AM - 03:00 PM</option>
                                <option value="03:00 PM - 07:00 PM">03:00 PM - 07:00 PM</option>
                            </select>  
                        </div>

                        <div class="col-xs-12">
                            <textarea name="user-note" placeholder="Brief Notes and Instruction about Laundry, Collection and Delivery."></textarea>
                        </div>
                        <div class="clearfix"></div>
                        <div class="shipping-note col-xs-12 text-left">
                            <!-- <p>Free Collection and Delivery for order more than £20. Add more items to save £5 delivery charges.</p> -->
                        </div>
                        <div class="col-xs-12 text-left">
                            <p style="margin-bottom: 0; margin-top: 0;">You will be contacted for delivery date and time and For any bespoke services, please contact us on <?php echo get_option_tree( 'contact_no', '', false ); ?></p>
                        </div>
                        <div class="clearfix"></div>
                        <?php if(is_user_logged_in() ){ ?>
                        <div class="address-holder row">
                            
                            <div class="col-xs-12 col-sm-4 col-md-3">
                                <div class="col-xs-12">
                                    <h4 class="laundry-form-heading">Collection and Delivery Details:</h4>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-9 user-contact-holder">
                                <div class="col-xs-12">
                                    <span>
                                        <?php echo $contact_person; ?>
                                        <input type="hidden" name="full_name" value="<?php echo $contact_person; ?>">
                                    </span>
                                    <span>
                                        <?php echo $contact_phone; ?>
                                        <input type="hidden" name="contact" value="<?php echo $contact_phone; ?>">
                                    </span>
                                    <span>
                                        <?php echo $contact_email; ?>
                                        <input type="hidden" name="email" value="<?php echo $contact_email; ?>">
                                    </span>
                                </div>
                            </div>
                            <div class="clearfix"></div>

                            <div class="col-xs-12 col-sm-4 col-md-3">
                                <div class="col-xs-12">
                                    <h6 class="laundry-form-heading">Collection Address & Postcode:</h6>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-8 col-md-9">
                                <div class="">
                                    <div class="col-xs-12 col-sm-9 col-md-10 left-box">
                                        <input required type="text" name="address" value="<?php echo $contact_address; ?>">
                                    </div>
                                    <div class="col-xs-12 col-sm-3 col-md-2 right-box">
                                        <input class="" required type="text" name="post_code" value="<?php echo $contact_postcode; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>

                            <div class="col-xs-12 col-sm-4 col-md-3">
                                <div class="col-xs-12">
                                    <h6 class="laundry-form-heading">Delivery Address & Postcode:</h6>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-9">
                                <div class="">
                                    <div class="col-xs-12 col-sm-9 col-md-10 left-box">
                                        <input required type="text" name="address1" value="<?php echo $contact_address; ?>">
                                    </div>
                                    <div class="col-xs-12 col-sm-3 col-md-2 right-box">
                                        <input class="" required type="text" name="post_code1" value="<?php echo $contact_postcode; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>

                        </div>
                        <div class="clearfix"></div>
                        <div class="reference-holder row">
                            
                            <div class="col-xs-12 col-sm-4 col-md-3">
                                <div class="col-xs-12">
                                    <h4 class="laundry-form-heading">Refer a Friend:
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-9 user-contact-holder">
                                <div class="col-xs-12 col-sm-5 left-box">
                                    <input type="text" name="reference_name[]" placeholder="Name">
                                </div>
                                <div class="col-xs-12 col-sm-5 right-box inner-less-right-box">
                                    <input type="email" name="reference_email[]" placeholder="Email Address">
                                </div>
                                <div class="col-xs-12 col-sm-2 right-box">
                                    <button class="reference_button add_reference">+</button>
                                </div>

                                <div class="appended-references">
                                    
                                </div>

                            </div>
                            <div class="clearfix"></div>


                        </div>
                        <div class="clearfix"></div>
                        <?php } ?>
                        <div class="col-xs-12">
                            <?php if(is_user_logged_in() ){ ?>
                            <div class="col-xs-12" style="height: 20px;"></div>    
                            <h4 class="text-center show-total" style="padding-bottom: 10px; color: #fff;"></h4>
                            <?php } ?>
                            <?php //echo $login_button; ?> 
                        </div>
                    </form>
                </div>
            <?php //} 
           // else {?>
            <!-- <div class="text-center">

            <h1 class="text-center" style="font-family: 'FjallaOne-Regular' !important;">Please Sign Up or Login to fill out this form</h1>
            <a class="btn btn-danger text-center xoo-el-login-tgr " href="#" style="font-family: 'FjallaOne-Regular' !important; font-size: 20px; padding: 15px 60px; border-radius: 56px;">Sign Up</a>
            </div> -->
            <?PHP //} ?>
            </div>
        </div>  

        <?php
    
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
add_shortcode( 'BOOKINGFORM', '_im_booking_form' );

// Referral discount checker
function get_referral_discount($email, $user_id){
    $referral_amount = '10.00';
    $query = new WP_Query( array( 
        'post_type'     => 'im_referral', 
        'post_status'   => 'publish',  
        's' => $email,
        'posts_per_page'  => 1,
        'order'  =>  'ASC',
    ));
    while ( $query->have_posts() ) : $query->the_post();
        $referral_by = get_post_meta(get_the_ID(), 'im_referral_by', true);
        $referral_by_current_credit = get_user_meta($referral_by, 'im_credit', true);
        $referral_by_current_credit = $referral_by_current_credit + $referral_amount;
        update_user_meta($referral_by, 'im_credit', $referral_by_current_credit);
        
        $referral_discount['discount'] = $referral_amount;       
    endwhile; wp_reset_query();
    $referral_discount['credit'] = get_user_meta($user_id, 'im_credit', true);
    return $referral_discount;
}

// List all bookings
function _im_booking_list($atts) {
    ob_start(); 

    // Attributes
    $atts = shortcode_atts(
        array(
            'number_of_clients' => 'all',
        ),
        $atts
    );

    $no_of_post = $atts['number_of_clients'];
    if($no_of_post == 'all'){
        $no = '-1';
        $id = 'example1';
    } else {
        $no = $no_of_post;
        $id = '';
    }

    if(isset($_GET['delete_project'])){
        $project_id = $_GET['delete_project'];
        im_delete_project($project_id);
    }
    $current_user = wp_get_current_user();
?>

    <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th>Booking Order</th>
                      <th>Collection Date</th>
                      <th>Collection Time</th>
                      <th>Discount</th>
                      <th>Referral Discount</th>
                      <th>Shipping</th>
                      <th>Total Amount</th>
                      <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if(im_get_current_user_role() == 'administrator'){
                            $query = new WP_Query( array(
                                'post_type'     => 'im_booking', 
                                'post_status'   => 'publish',  
                                'posts_per_page'  => -1,
                                'order'  =>  'DESC',
                            ));
                        } else {
                            $query = new WP_Query( array(
                                'post_type'     => 'im_booking', 
                                'post_status'   => 'publish',  
                                'posts_per_page'  => -1,
                                'order'  =>  'DESC',
                                'author' => $current_user->ID,
                            ));
                        }
                        while ( $query->have_posts() ) : $query->the_post();
                    ?>
                        <tr>
                          <td><?php echo get_the_ID(); ?></td>
                          <td><?php echo get_post_meta(get_the_ID(), 'im_date', true); ?></td>
                          <td><?php echo get_post_meta(get_the_ID(), 'im_time', true); ?></td>
                          <td><?php echo get_post_meta(get_the_ID(), 'im_discount', true); ?>%</td>
                          <td><?php echo get_post_meta(get_the_ID(), 'im_referral_discount', true); ?></td>
                          <td>
                            <?php 
                                if(get_post_meta(get_the_ID(), 'im_shipping', true) != 0){
                                    echo '&pound;'.get_post_meta(get_the_ID(), 'im_shipping', true);        
                                } else {
                                    echo get_post_meta(get_the_ID(), 'im_shipping', true);
                                }
                            ?>
                          </td>
                          <td>&pound;<?php echo get_post_meta(get_the_ID(), 'im_total', true); ?></td>
                          <td>
                            <a title="view" href="<?php the_permalink(); ?>" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>                            
                          </td>
                        </tr>
                    <?php endwhile; wp_reset_query(); ?>
                </tbody>
              </table>
<?php    
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
add_shortcode( 'BOOKINGLISTS', '_im_booking_list' );

// Get Current User Role
function im_get_current_user_role() {
  if( is_user_logged_in() ) {
    $user = wp_get_current_user();
    $role = ( array ) $user->roles;
    return $role[0];
  } else {
    return false;
  }
}


// Login Logout to menu
function add_login_logout_register_menu( $items, $args ) {
 if ( $args->theme_location == 'header' ) {
 
    if ( is_user_logged_in() ) {
        $items .= '<li><a href="' . site_url() . '/dashboard">' . __( 'My Account' ) . '</a></li>';
        $items .= '<li><a href="' . site_url() . '/contact-us">' . __( 'Contact Us' ) . '</a></li>';
    } else {
        $items .= '<li><a class="xoo-el-login-tgr" href="#">' . __( 'My Account' ) . '</a></li>';
        $items .= '<li><a href="' . site_url() . '/contact-us">' . __( 'Contact Us' ) . '</a></li>';
    }
}
 
 return $items;
}
 
add_filter( 'wp_nav_menu_items', 'add_login_logout_register_menu', 199, 2 );

add_action('wp_logout','auto_redirect_after_logout');
function auto_redirect_after_logout(){
  wp_redirect( home_url() );
  exit();
}

// Edit Profile
function _im_edit_user_profile() {
ob_start(); 
 
    include_once( 'users/edit-user-profile.php' );    
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
add_shortcode( 'EDITUSERPROFILE', '_im_edit_user_profile' );

// Change Password
function _im_change_password() {
ob_start(); 
    include_once( 'users/change-password.php' );
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
add_shortcode( 'CHANGEPASSWORD', '_im_change_password' );

// User Login
function _im_user_login() {
    ob_start(); 
    if(is_user_logged_in() ) {
        while ( have_posts() ) : the_post();
        the_content();
        endwhile;
    } else {
        include_once( 'users/login.php' );
    }   
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
add_shortcode( 'USERLOGIN', '_im_user_login' );

// Payment process
function _im_payment_process() {
    ob_start(); 
?>
                            <div class="order-wrapper">
                                
                            </div>
                            <div class="bottom_contact animate-in fadeInTop" data-animation="load" data-show-screen="0.8" data-speed="1" style="transition: 1s; margin-top: 0;">
                              <div class="container-fluid">
                                <div class="row">
                                  <div class="com-xs-12 text-center">
                                    <h3 style="margin-top: 0;">PAYMENT FORM</h3>
                                  </div>
                                </div>
                              </div>
                              <div class="home-form container-fluid" style="padding-bottom: 15px;">
                                  <div class="row">
                                      <form id="im-currency-form" action="" method="post">
                                            <div class="col-xs-12 col-sm-4 form-field">
                                                <input data-error="This field is requird." type="text" placeholder="First Name" class="required first-name" name="fname">
                                            </div>
                                            <div class="col-xs-12 col-sm-4 form-field">
                                                <input data-error="This field is requird." type="text" placeholder="Last Name" class="required last-name" name="lname">
                                            </div>
                                            <div class="col-xs-12 col-sm-4 form-field">
                                                <input data-error="This field is requird." type="text" placeholder="Email Address" class="required email" name="email">
                                            </div>
                                            <div class="col-xs-12 col-sm-4 form-field">
                                                <input type="text" placeholder="Contact No" class="contact" name="contact">
                                            </div>
                                            <div class="col-xs-12 col-sm-4 form-field">
                                                <input data-error="This field is requird." type="text" placeholder="Order No" class="required order" name="order">
                                            </div>
                                            <div class="col-xs-12 col-sm-4 form-field">
                                                <input data-error="This field is requird." type="text" placeholder="Amount" class="required amount" name="amount">
                                            </div>
                                            <div class="col-xs-12 submit-filed form-field text-center">
                                                <div id="paypal-button-container"></div>
                                            </div>
                                        </form>
                                  </div>
                              </div>
                            </div>
                            <div class="clearfix"></div>

                            <!-- PAYPAL START -->
                            <div id="paypal-button-container" style="text-align: center !important;"></div>
                            <script src="https://www.paypalobjects.com/api/checkout.js"></script>
                            <script>
                                
                            jQuery(document).ready(function(){

                                jQuery('body').on('click', '#myModal1', function(){
                                    jQuery(this).removeClass('show');
                                });

                                paypal.Button.render({

                                    // Specify the style of the button

                                    style: {
                                        label: 'pay',
                                        size:  'medium', // small | medium | large | responsive
                                        shape: 'pill',   // pill | rect
                                        color: 'black',   // gold | blue | silver | black
                                        tagline: false,
                                    },

                                    env: 'sandbox', // sandbox | production

                                    // PayPal Client IDs - replace with your own
                                    // Create a PayPal app: https://developer.paypal.com/developer/applications/create
                                    client: {
                                        sandbox:    'AQXH4LLDRDPwzGwkS-HniEwGiLVi7i4Q_VjD-mniOOlY1ZRT67qnpaTZ0k21NnGTaDgib8ncgMz_c2Yx',
                                        //production: 'add production id here'
                                    },

                                    // Show the buyer a 'Pay Now' button in the checkout flow
                                    commit: true,

                                    // payment() is called when the button is clicked
                                    payment: function(data, actions) { 
                                        var errors_count = 0;
                                        jQuery('.required').each(function(){
                                            if(jQuery(this).val() == ''){
                                                jQuery(this).addClass('have-error');
                                                var error = jQuery(this).data('error');
                                                jQuery(this).attr('placeholder', error);
                                                errors_count++;
                                            }
                                        });
                                        jQuery('.required').on('focus', function(){
                                            jQuery(this).removeClass('have-error');
                                            jQuery(this).attr('placeholder', '');
                                        });
                                        if(errors_count > 0){
                                            return false;
                                        }

                                        var total_amount = jQuery('.amount').val(); 
                                        // Make a call to the REST api to create the payment
                                        return actions.payment.create({

                                            payment: {
                                                transactions: [
                                                    {
                                                        amount: { total: total_amount, currency: 'GBP' }
                                                    }
                                                ]
                                            }
                                        });
                                    },

                                    // onAuthorize() is called when the buyer approves the payment
                                    onAuthorize: function(data, actions) {

                                        // Make a call to the REST api to execute the payment
                                        return actions.payment.execute().then(function() {
                                            console.log('Yes');
                                            var firstName = jQuery('.first-name').val();
                                            var lastName = jQuery('.last-name').val();
                                            var email = jQuery('.email').val();
                                            var contact = jQuery('.contact').val();
                                            var order = jQuery('.order').val();
                                            var total_amount = jQuery('.amount').val();

                                            jQuery.ajax({
                                                type: "POST",
                                                url: "<?php echo admin_url('admin-ajax.php'); ?>",
                                                data : {                
                                                    action: 'generator_order',
                                                    firstName: firstName,
                                                    lastName: lastName,
                                                    email: email,
                                                    contact: contact,
                                                    order: order,
                                                    total: total_amount,
                                                },
                                                success:function(data){ 
                                                    jQuery('.order-wrapper').empty();
                                                    var successMsg = '<div class="modal show" id="myModal1" role="dialog">' +
                                                        '<div class="modal-dialog">' +
                                                            '<div class="modal-content">' +
                                                                '<div class="modal-header">' +
                                                                    '<button type="button" class="close" data-dismiss="modal">&times;</button>' +
                                                                    '<h4 class="modal-title">Thank You</h4>' +
                                                                '</div>' +
                                                                '<div class="modal-body">' +
                                                                    'Your order has been placed.' +
                                                                '</div>' +
                                                                '<div class="modal-footer">' +
                                                                    '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
                                                                '</div>' +
                                                            '</div>' +
                                                        '</div>' +
                                                    '</div>';
                                                    jQuery('.order-wrapper').append(successMsg);
                                                    jQuery('#im-currency-form input').val('');
                                                    jQuery('.first-name').attr('placeholder', 'First Name');
                                                    jQuery('.last-name').attr('placeholder', 'Last Name');
                                                    jQuery('.email').attr('placeholder', 'Email Address');
                                                    jQuery('.contact').attr('placeholder', 'Contact No');
                                                    jQuery('.order').attr('placeholder', 'Order No');
                                                    jQuery('.amount').attr('placeholder', 'Amount');
                                                }
                                            });
                                        });
                                    }

                                }, '#paypal-button-container');
                                });

                            </script>

<?php
                   
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
add_shortcode( 'PAYMENTS', '_im_payment_process' );

function generator_order() {
 
    // The $_REQUEST contains all the data sent via ajax
    if( isset($_REQUEST) ) { 
        $first_name = sanitize_text_field($_REQUEST['firstName']);
        $last_name = sanitize_text_field($_REQUEST['lastName']);
        $email = sanitize_text_field($_REQUEST['email']);
        $contact = sanitize_text_field($_REQUEST['contact']);
        $order = sanitize_text_field($_REQUEST['order']);
        $total = sanitize_text_field($_REQUEST['total']);

            $primary_color = '#CB0101';
            $mailadmin = get_bloginfo('admin_email');
            $site_name =  get_bloginfo('name');
            $subject = 'New Order';
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";    
            $headers_admin = 'From: '.$site_name.' <'.$email.'>' . "\r\n";  
            $headers_admin .= $headers;  
            $headers_user = 'From: '.$site_name.' <'.$mailadmin.'>' . "\r\n";
            $headers_user .= $headers;

            $message = '<html>';
            $message .= '<body bgcolor="#FFFFFF" marginwidth="10" marginheight="10" topmargin="10" leftmargin="10">';       
                        
            $message .= '<table cellpadding="10" cellspacing="10" border="0" width="700">';
            $message .= '<tr><td bgcolor="'.$primary_color.'" colspan="4" align="center"><font face="arial" size="7" color="#FFFFFF">'.$site_name.'</td></tr>';
            $message .= '<tr><td bgcolor="#CCCCCC" colspan="4" align="center"><font face="arial" size="5" color="#000000"><b>ORDER FORM DETAIL</b></td></tr>';
            $message .= '<tr><td bgcolor="#cf3247" width="200"><font face="arial" size="2"color="#FFFFFF">First Name: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$first_name.'</td></tr>';
            $message .= '<tr><td bgcolor="#cf3247" width="200"><font face="arial" size="2"color="#FFFFFF">Last Name: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$last_name.'</td></tr>';
            $message .= '<tr><td bgcolor="#cf3247" width="200"><font face="arial" size="2"color="#FFFFFF">Email Address: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$email.'</td></tr>';
            $message .= '<tr><td bgcolor="#cf3247" width="200"><font face="arial" size="2"color="#FFFFFF">Contact No.: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$contact.'</td></tr>';
            $message .= '<tr><td bgcolor="#cf3247" width="200"><font face="arial" size="2"color="#FFFFFF">Amount: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$amount.'</td></tr>';
            $message .= '<tr><td bgcolor="#cf3247" width="200"><font face="arial" size="2"color="#FFFFFF">Order No.: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$order.'</td></tr>';
            $message .= '</table>';

            $message .= '</body>';
            $message .= '</html>';

            // Send email to admin
            wp_mail( $mailadmin, $subject, $message, $headers_admin );
            // Send email to user
            wp_mail( $email, $subject, $message, $headers_user );

    }
     
    // Always die in functions echoing ajax content
   die();
}
add_action( 'wp_ajax_generator_order', 'generator_order' );
add_action('wp_ajax_nopriv_generator_order', 'generator_order');

// Enquaue script
// Add custom js
add_action( 'admin_enqueue_scripts', 'load_custom_script' );
function load_custom_script($hook) {
    global $post;
    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
        if ( 'im_booking' === $post->post_type ) {     
            wp_enqueue_script('custom_js_script', get_bloginfo('template_url').'/js/admin_custom.js', array('jquery'));
            wp_localize_script( 'custom_js_script', 'user',
               array( 
                   'ajax_url' => admin_url( 'admin-ajax.php' ),
               )
           );
        }
    }
}

// Set Manage
function update_order() {
    $orderId = $_REQUEST['orderId'];
    $ftotal = $_REQUEST['ftotal'];
    $reason = $_REQUEST['reason'];
    $name = get_post_meta($orderId, 'im_name', true);
    $email = get_post_meta($orderId, 'im_email', true);
    $primary_color = im_get_option( 'im_primary_bg' );
    if($primary_color == ''){
        $primary_color = '#3C8DBC';
    }

    $site_name =  get_bloginfo('name');
    $mailuser = get_bloginfo('admin_email');
    $subject = get_bloginfo('name').' - Order MWDC-'.$orderId.' Confirmation';
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";    
    $headers .= 'From: '.$site_name.' <noreply@domain.com>' . "\r\n";
    $message = '<html>';
    $message .= '<body bgcolor="#FFFFFF" marginwidth="10" marginheight="10" topmargin="10" leftmargin="10">';
    $message .= '<table cellpadding="10" cellspacing="10" border="0" width="700">';
    $message .= '<tr><td bgcolor="'.$primary_color.'" align="center"><font face="arial" size="7" color="#FFFFFF">'.$site_name.'</td></tr>';
    $message .= '<tr><td>Dear '.$name.', final cost for your order is '.$ftotal.'. <strong><a href="'.site_url().'/booking-detail/'.$orderId.'">Click Here</a></strong> to view your order details and reason to increase in cost.</td></tr>';  
    $message .= '</table>';
    $message .= '</body>';  
    $message .= '</html>';       
                        
    wp_mail( $email, $subject, $message, $headers );

    $booking_source = get_post_meta($orderId, 'im_booking_source', true);
    if($booking_source == 'mobile'){
        // Get user id from email
        $user = get_user_by('email', $email);
        $user_id = $user->ID;
        $playerId = get_user_meta($user_id, 'im_player_id', true);
        $notification_message = 'Final cost for your order(MWDC-'.$orderId.') is £'.$ftotal.' The reason in increase in cost is "'.$reason.'"';
        sendMobileNotifocation($notification_message, $playerId);
    }

    die();
}
add_action( 'wp_ajax_update_order', 'update_order' );
add_action('wp_ajax_nopriv_update_order', 'update_order');


// Send notification
function sendMobileNotifocation($message, $playerId){
    $content = array(
        "en" => $message
    );

    $fields = array(
        'app_id' => "77838631-533a-4e38-8738-e847048576ba",
        'include_player_ids' => array($playerId),
        'contents' => $content
    );

    $fields = json_encode($fields);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);
        
    return $response;
}