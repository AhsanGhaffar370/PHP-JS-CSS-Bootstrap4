<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_ELEMENTOR_VERSION', '2.6.1' );

if ( ! isset( $content_width ) ) {
	$content_width = 800; // Pixels.
}

if ( ! function_exists( 'hello_elementor_setup' ) ) {
	/**
	 * Set up theme support.
	 *
	 * @return void
	 */
	function hello_elementor_setup() {
		if ( is_admin() ) {
			hello_maybe_update_theme_version_in_db();
		}

		$hook_result = apply_filters_deprecated( 'elementor_hello_theme_load_textdomain', [ true ], '2.0', 'hello_elementor_load_textdomain' );
		if ( apply_filters( 'hello_elementor_load_textdomain', $hook_result ) ) {
			load_theme_textdomain( 'hello-elementor', get_template_directory() . '/languages' );
		}

		$hook_result = apply_filters_deprecated( 'elementor_hello_theme_register_menus', [ true ], '2.0', 'hello_elementor_register_menus' );
		if ( apply_filters( 'hello_elementor_register_menus', $hook_result ) ) {
			register_nav_menus( [ 'menu-1' => __( 'Header', 'hello-elementor' ) ] );
			register_nav_menus( [ 'menu-2' => __( 'Footer', 'hello-elementor' ) ] );
		}

		$hook_result = apply_filters_deprecated( 'elementor_hello_theme_add_theme_support', [ true ], '2.0', 'hello_elementor_add_theme_support' );
		if ( apply_filters( 'hello_elementor_add_theme_support', $hook_result ) ) {
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'title-tag' );
			add_theme_support(
				'html5',
				[
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
					'script',
					'style',
				]
			);
			add_theme_support(
				'custom-logo',
				[
					'height'      => 100,
					'width'       => 350,
					'flex-height' => true,
					'flex-width'  => true,
				]
			);

			/*
			 * Editor Style.
			 */
			add_editor_style( 'classic-editor.css' );

			/*
			 * Gutenberg wide images.
			 */
			add_theme_support( 'align-wide' );

			/*
			 * WooCommerce.
			 */
			$hook_result = apply_filters_deprecated( 'elementor_hello_theme_add_woocommerce_support', [ true ], '2.0', 'hello_elementor_add_woocommerce_support' );
			if ( apply_filters( 'hello_elementor_add_woocommerce_support', $hook_result ) ) {
				// WooCommerce in general.
				add_theme_support( 'woocommerce' );
				// Enabling WooCommerce product gallery features (are off by default since WC 3.0.0).
				// zoom.
				add_theme_support( 'wc-product-gallery-zoom' );
				// lightbox.
				add_theme_support( 'wc-product-gallery-lightbox' );
				// swipe.
				add_theme_support( 'wc-product-gallery-slider' );
			}
		}
	}
}
add_action( 'after_setup_theme', 'hello_elementor_setup' );

function hello_maybe_update_theme_version_in_db() {
	$theme_version_option_name = 'hello_theme_version';
	// The theme version saved in the database.
	$hello_theme_db_version = get_option( $theme_version_option_name );

	// If the 'hello_theme_version' option does not exist in the DB, or the version needs to be updated, do the update.
	if ( ! $hello_theme_db_version || version_compare( $hello_theme_db_version, HELLO_ELEMENTOR_VERSION, '<' ) ) {
		update_option( $theme_version_option_name, HELLO_ELEMENTOR_VERSION );
	}
}

if ( ! function_exists( 'hello_elementor_scripts_styles' ) ) {
	/**
	 * Theme Scripts & Styles.
	 *
	 * @return void
	 */
	function hello_elementor_scripts_styles() {
		$enqueue_basic_style = apply_filters_deprecated( 'elementor_hello_theme_enqueue_style', [ true ], '2.0', 'hello_elementor_enqueue_style' );
		$min_suffix          = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		if ( apply_filters( 'hello_elementor_enqueue_style', $enqueue_basic_style ) ) {
			wp_enqueue_style(
				'hello-elementor',
				get_template_directory_uri() . '/style' . $min_suffix . '.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		}

		if ( apply_filters( 'hello_elementor_enqueue_theme_style', true ) ) {
			wp_enqueue_style(
				'hello-elementor-theme-style',
				get_template_directory_uri() . '/theme' . $min_suffix . '.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);

			wp_enqueue_style(
				'custom-style',
				get_template_directory_uri() . '/custom.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_scripts_styles' );

if ( ! function_exists( 'hello_elementor_register_elementor_locations' ) ) {
	/**
	 * Register Elementor Locations.
	 *
	 * @param ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager $elementor_theme_manager theme manager.
	 *
	 * @return void
	 */
	function hello_elementor_register_elementor_locations( $elementor_theme_manager ) {
		$hook_result = apply_filters_deprecated( 'elementor_hello_theme_register_elementor_locations', [ true ], '2.0', 'hello_elementor_register_elementor_locations' );
		if ( apply_filters( 'hello_elementor_register_elementor_locations', $hook_result ) ) {
			$elementor_theme_manager->register_all_core_location();
		}
	}
}
add_action( 'elementor/theme/register_locations', 'hello_elementor_register_elementor_locations' );

if ( ! function_exists( 'hello_elementor_content_width' ) ) {
	/**
	 * Set default content width.
	 *
	 * @return void
	 */
	function hello_elementor_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'hello_elementor_content_width', 800 );
	}
}
add_action( 'after_setup_theme', 'hello_elementor_content_width', 0 );

if ( is_admin() ) {
	require get_template_directory() . '/includes/admin-functions.php';
}

/**
 * If Elementor is installed and active, we can load the Elementor-specific Settings & Features
*/

// Allow active/inactive via the Experiments
require get_template_directory() . '/includes/elementor-functions.php';

/**
 * Include customizer registration functions
*/
function hello_register_customizer_functions() {
	if ( is_customize_preview() ) {
		require get_template_directory() . '/includes/customizer-functions.php';
	}
}
add_action( 'init', 'hello_register_customizer_functions' );

if ( ! function_exists( 'hello_elementor_check_hide_title' ) ) {
	/**
	 * Check hide title.
	 *
	 * @param bool $val default value.
	 *
	 * @return bool
	 */
	function hello_elementor_check_hide_title( $val ) {
		if ( defined( 'ELEMENTOR_VERSION' ) ) {
			$current_doc = Elementor\Plugin::instance()->documents->get( get_the_ID() );
			if ( $current_doc && 'yes' === $current_doc->get_settings( 'hide_title' ) ) {
				$val = false;
			}
		}
		return $val;
	}
}
add_filter( 'hello_elementor_page_title', 'hello_elementor_check_hide_title' );

/**
 * Wrapper function to deal with backwards compatibility.
 */
if ( ! function_exists( 'hello_elementor_body_open' ) ) {
	function hello_elementor_body_open() {
		if ( function_exists( 'wp_body_open' ) ) {
			wp_body_open();
		} else {
			do_action( 'wp_body_open' );
		}
	}
}



function show_entries(){
	
  if (isset($_GET['saver'])) {
	global $wpdb;
    // $table_name=$wpdb->prefix.'participants';
    $table_name='participants';
    $id=$_GET['saver'];
	
	$result=$wpdb->get_results("SELECT * FROM $table_name where id = '$id'");
// 	echo '<pre>';
// 	print_r($row->name);

	?>
	<style>
            .bg_color{background-color: #E9EAEC;padding: 50px 0px 50px 0px;}
            .sec_bg{padding: 50px;background-color: white;width: 600px;margin: auto;border: 1px solid #bab7b7;}
            .h21{font-weight: 700;}
            hr{margin: 20px 0px 20px 0px !important;}
            .l_color{color: #bbbbbb;text-align: center;margin-top: 20px;font-size: 13px;}
            </style>
		  <?PHP
	foreach ( $result as $print )   {
	?>
		<div class="bg_color">
            <div class="sec_bg">
              <p class="h21">Attendance Day</p><p class="abc"><?PHP echo $print->day; ?></p><hr>
              <p class="h21">First Name</p><p class="abc"><?PHP echo $print->firstname; ?></p><hr>
              <p class="h21">Last Name</p><p class="abc"><?PHP echo $print->lastname; ?></p><hr>
              <p class="h21">Title</p><p class="abc"><?PHP echo $print->title; ?></p><hr>
              <p class="h21">Mobile No</p><p class="abc"><?PHP echo $print->phone; ?></p><hr>
              <p class="h21">Email Address</p><p class="abc"><?PHP echo $print->email; ?></p><hr>
              <p class="h21">Company Name</p><p class="abc"><?PHP echo $print->company; ?></p><hr>
              <p class="h21">Job Title</p><p class="abc"><?PHP echo $print->job_title; ?></p><hr>
              <p class="h21">City</p><p class="abc"><?PHP echo $print->city; ?></p><hr>
              <p class="h21">Country</p><p class="abc"><?PHP echo $print->country; ?></p><hr>
              <p class="h21">QR Code</p><p class="abc">
				<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http://www.kingdomoftomorrow.com/sites/wp-json/api/booking_details?id=<?PHP echo $print->id; ?>&choe=UTF-8" title="QR Code" />
				</p>
            </div>
          </div>
		  <?PHP } }?>


<?PHP
}
add_shortcode('SHOWENTRIES21','show_entries');



// ahsan visit

function my_form21(){

    if (isset($_POST['insert21'])) {
        global $wpdb;
        // $table_name=$wpdb->prefix.'participants';
        $table_name='participants';

        $type = 'Visit';
        $day = $_POST['day'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $title = $_POST['title'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $company = $_POST['company'];
        $job_title = $_POST['job_title'];
        $city = $_POST['city'];
        $country = $_POST['country'];
		
            $wpdb->insert($table_name, 
                                    array(
                                        'type'=>$type,
                                        'day'=>$day,
                                        'firstname'=>$firstname,
                                        'lastname'=>$lastname,
                                        'title'=>$title,
                                        'phone'=>$phone,
                                        'email'=>$email,
                                        'company'=>$company,
                                        'job_title'=>$job_title,
                                        'city'=>$city,
                                        'country'=>$country
                                    ),
                                    array(
                                        '%s',
                                        '%s',
                                        '%s',
                                        '%s',
                                        '%s',
                                        '%s',
                                        '%s',
                                        '%s',
                                        '%s',
                                        '%s',
                                        '%s'
                                    )
            );

            $lastid = $wpdb->insert_id;
// 			echo "<script>alert('data inserted');</script>";
$site_name =  get_bloginfo('name');

$mailadmin = get_bloginfo('admin_email');

$subject = $site_name.' New Participant Booking';

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";     
$headers .= 'From:KOT <info@kingdomoftomorrow.com>' . "\r\n";

$message = '<html>';
$message .= '<head>
            <style>
            .bg_color{background-color: white;padding: 10px 0px 10px 0px;}
            .logo_style {width: 150px;
    margin: auto 0 auto auto;
    display: inherit;
    margin-bottom: 20px;}
    .apple_style {
      width: 153px;
      margin: 20px auto auto auto;
      display: block;
      margin-bottom: 20px;
  }
            .sec_bg{padding: 50px;
    background-color: #0C1E33;
    width: 300px;
    margin: auto;
    border: 1px solid #bab7b7;
    border-radius: 20px;}
            .h21{font-weight: 700; color:white;margin: 20px 0px 0px 0px !important;}
            .abc{font-weight: 400; color:white;margin: 7px 0px 10px 0px !important;}
            hr{margin: 20px 0px 20px 0px !important;}
            .l_color{color: #bbbbbb;text-align: center;margin-top: 20px;font-size: 13px;}
            .two_sec{width: 140px;
    display: inline-block;}
    .apple_btn {    font-size: 15px;
      text-decoration: none;
      border: 1px solid white;
      border-radius: 10px;
      width: 100px;
      text-align: center;
      padding: 11px;
      margin: 20px auto;
      display:inline-block;}
      .show_safari { display:none; }
      @media not all and (min-resolution:.001dpcm) { @supports (-webkit-appearance:none) and (display:flow-root) { .show_safari { display:block !important; } } }
            </style>
          </head>';
$message .= '<body>';

$message .= '<div class="bg_color">
            <div class="sec_bg">
              <img class="logo_style" src="http://www.kingdomoftomorrow.com/sites/wp-content/uploads/2022/10/loogo-1.png" alt="">
              <p class="abc">Thanks for your registration, please find below your ticket details</p>
              <img  style="margin: auto; display: inherit;" src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=http://www.kingdomoftomorrow.com/sites/wp-json/api/booking_details?id='.$lastid.'&choe=UTF-8" title="QR Code" />
              <div class="show_safari"><a class="apple_btn" href="https://developer.apple.com/documentation/walletpasses">Apple Wallet</a></div>
              <p class="h21">Attendance Day</p><p class="abc">'.$day.'</p>
              <div class="two_sec">
              <p class="h21">First Name</p><p class="abc">'.$firstname.'</p>
              </div>
              <div class="two_sec">
              <p class="h21">Last Name</p><p class="abc">'.$lastname.'</p>
              </div>
              <div class="two_sec">
              <p class="h21">Title</p><p class="abc">'.$title.'</p>
              </div>
              <div class="two_sec">
              <p class="h21">Mobile No</p><p class="abc">'.$phone.'</p>
              </div>
              <p class="h21">Email Address</p><p class="abc">'.$email.'</p>
              <p class="h21">Company Name</p><p class="abc">'.$company.'</p>
              <p class="h21">Job Title</p><p class="abc">'.$job_title.'</p>
              <div class="two_sec">
              <p class="h21">City</p><p class="abc">'.$city.'</p>
              </div>
              <div class="two_sec">
              <p class="h21">Country</p><p class="abc">'.$country.'</p>
              </div>
              </p>
              <p class="h21">Venue: </p><p class="abc">Riyadh Exhibition & Convention Center</p>
              <p class="h21">Venue location: </p><p class="abc"><a href="https://maps.app.goo.gl/TbCJ2WvMWYJx9wwv5?g_st=ic" class="l_color">Horimlaa</a></p>
              
            </div>
            <p class="l_color">Sent from <a href="http://www.kingdomoftomorrow.com/sites/" class="l_color">Kingdom of Tomorrow</a></p>
          </div>';

wp_mail( $mailadmin, $subject, $message, $headers );
wp_mail( $email, $subject, $message, $headers );
			?>

  	<!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      
  <p id="form-submit" class="sb-menu" style="text-align: center; background: #30c330; padding: 10px; border-radius: 6px; color: white !important; font-size: 17px;">Thanks for your registration, <br> please visit your email to view your ticket.</p>
		<script>
//       $(document).ready(function(){
//     $("html, body").animate({ 
//         scrollTop: $('.sb-menu').offset().top 
//     }, 1000);
// });
    </script>
  <?php
    }
else {
?>
<style>
  .form-control {
    background-color: transparent !important;
    border: 1px solid #7BAC53 !important;
    color: #a8a4a4 !important;
  }
</style>
     <!-- Form Starts -->
    <form id="form1" method="post" action="http://www.kingdomoftomorrow.com/sites/visit/#form-submit">
        <!--enctype="multipart/form-data" is used with post method -->

		<input type="hidden" id="total1" name="total21" />
        <div class="form-row">
          
            <div class="form-group col-md-12">
                <select name="day" id="day" class="form-control rounded-0 p-4" required >
                    <option value="-1" selected disabled>Select Attendance Day</option>
                    <option value="Attend Day 1: 15 November 2022">Attend Day 1: 15 November 2022</option>
                    <option value="Attend Day 2: 16 November 2022">Attend Day 2: 16 November 2022</option>
                    <option value="Attend Day 3: 17 November 2022">Attend Day 3: 17 November 2022</option>
                    <option value="Attend Day 4: 18 November 2022">Attend Day 4: 18 November 2022</option>
                    <option value="Attend Day 5: 19 November 2022">Attend Day 5: 19 November 2022</option>
                    <option value="Attend Day 6: 20 November 2022">Attend Day 6: 20 November 2022</option>
                </select>
            </div>
<br>
            <div class="form-group col-md-6">
                <input type="text" class="form-control rounded-0 p-4" name="firstname" placeholder="First Name" required style="background-color: white;" />
            </div>
<br>
            <div class="form-group col-md-6">
                <input type="text" class="form-control rounded-0 p-4" name="lastname" placeholder="Last Name" required style="background-color: white;" />
            </div>
<br>
            <div class="form-group col-md-6">
                <input type="text" class="form-control rounded-0 p-4" name="title" placeholder="Title" required style="background-color: white;" />
            </div>
<br>
            <div class="form-group col-md-6">
                <input type="tel" class="form-control rounded-0 p-4" name="phone" placeholder="Mobile No" required style="background-color: white;" />
            </div>
<br>
            <div class="form-group col-md-12">
                <input type="email" class="form-control rounded-0 p-4" name="email" placeholder="Email Address" required style="background-color: white;" />
            </div>
<br>
            <div class="form-group col-md-12">
                <input type="text" class="form-control rounded-0 p-4" name="company" placeholder="Company Name" required style="background-color: white;" />
            </div>
<br>
            <div class="form-group col-md-12">
                <input type="text" class="form-control rounded-0 p-4" name="job_title" placeholder="Job Title" required style="background-color: white;" />
            </div>
<br>
            <div class="form-group col-md-12">
                <input type="text" class="form-control rounded-0 p-4" name="city" placeholder="City" required style="background-color: white;" />
            </div>
<br>
            <div class="form-group col-md-12">
                <select name="country" class="form-control rounded-0 p-4" required >
                    <option value="-1" selected disabled>Select Country</option>
                <option value="Afghanistan">Afghanistan</option>
<option value="Albania">Albania</option>
<option value="Algeria">Algeria</option>
<option value="American Samoa">American Samoa</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguilla">Anguilla</option>
<option value="Antartica">Antarctica</option>
<option value="Antigua and Barbuda">Antigua and Barbuda</option>
<option value="Argentina">Argentina</option>
<option value="Armenia">Armenia</option>
<option value="Aruba">Aruba</option>
<option value="Australia">Australia</option>
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="Bahamas">Bahamas</option>
<option value="Bahrain">Bahrain</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Barbados">Barbados</option>
<option value="Belarus">Belarus</option>
<option value="Belgium">Belgium</option>
<option value="Belize">Belize</option>
<option value="Benin">Benin</option>
<option value="Bermuda">Bermuda</option>
<option value="Bhutan">Bhutan</option>
<option value="Bolivia">Bolivia</option>
<option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
<option value="Botswana">Botswana</option>
<option value="Bouvet Island">Bouvet Island</option>
<option value="Brazil">Brazil</option>
<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
<option value="Brunei Darussalam">Brunei Darussalam</option>
<option value="Bulgaria">Bulgaria</option>
<option value="Burkina Faso">Burkina Faso</option>
<option value="Burundi">Burundi</option>
<option value="Cambodia">Cambodia</option>
<option value="Cameroon">Cameroon</option>
<option value="Canada">Canada</option>
<option value="Cape Verde">Cape Verde</option>
<option value="Cayman Islands">Cayman Islands</option>
<option value="Central African Republic">Central African Republic</option>
<option value="Chad">Chad</option>
<option value="Chile">Chile</option>
<option value="China">China</option>
<option value="Christmas Island">Christmas Island</option>
<option value="Cocos Islands">Cocos (Keeling) Islands</option>
<option value="Colombia">Colombia</option>
<option value="Comoros">Comoros</option>
<option value="Congo">Congo</option>
<option value="Congo">Congo, the Democratic Republic of the</option>
<option value="Cook Islands">Cook Islands</option>
<option value="Costa Rica">Costa Rica</option>
<option value="Cota D'Ivoire">Cote d'Ivoire</option>
<option value="Croatia">Croatia (Hrvatska)</option>
<option value="Cuba">Cuba</option>
<option value="Cyprus">Cyprus</option>
<option value="Czech Republic">Czech Republic</option>
<option value="Denmark">Denmark</option>
<option value="Djibouti">Djibouti</option>
<option value="Dominica">Dominica</option>
<option value="Dominican Republic">Dominican Republic</option>
<option value="East Timor">East Timor</option>
<option value="Ecuador">Ecuador</option>
<option value="Egypt">Egypt</option>
<option value="El Salvador">El Salvador</option>
<option value="Equatorial Guinea">Equatorial Guinea</option>
<option value="Eritrea">Eritrea</option>
<option value="Estonia">Estonia</option>
<option value="Ethiopia">Ethiopia</option>
<option value="Falkland Islands">Falkland Islands (Malvinas)</option>
<option value="Faroe Islands">Faroe Islands</option>
<option value="Fiji">Fiji</option>
<option value="Finland">Finland</option>
<option value="France">France</option>
<option value="France Metropolitan">France, Metropolitan</option>
<option value="French Guiana">French Guiana</option>
<option value="French Polynesia">French Polynesia</option>
<option value="French Southern Territories">French Southern Territories</option>
<option value="Gabon">Gabon</option>
<option value="Gambia">Gambia</option>
<option value="Georgia">Georgia</option>
<option value="Germany">Germany</option>
<option value="Ghana">Ghana</option>
<option value="Gibraltar">Gibraltar</option>
<option value="Greece">Greece</option>
<option value="Greenland">Greenland</option>
<option value="Grenada">Grenada</option>
<option value="Guadeloupe">Guadeloupe</option>
<option value="Guam">Guam</option>
<option value="Guatemala">Guatemala</option>
<option value="Guinea">Guinea</option>
<option value="Guinea-Bissau">Guinea-Bissau</option>
<option value="Guyana">Guyana</option>
<option value="Haiti">Haiti</option>
<option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
<option value="Holy See">Holy See (Vatican City State)</option>
<option value="Honduras">Honduras</option>
<option value="Hong Kong">Hong Kong</option>
<option value="Hungary">Hungary</option>
<option value="Iceland">Iceland</option>
<option value="India">India</option>
<option value="Indonesia">Indonesia</option>
<option value="Iran">Iran (Islamic Republic of)</option>
<option value="Iraq">Iraq</option>
<option value="Ireland">Ireland</option>
<option value="Israel">Israel</option>
<option value="Italy">Italy</option>
<option value="Jamaica">Jamaica</option>
<option value="Japan">Japan</option>
<option value="Jordan">Jordan</option>
<option value="Kazakhstan">Kazakhstan</option>
<option value="Kenya">Kenya</option>
<option value="Kiribati">Kiribati</option>
<option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
<option value="Korea">Korea, Republic of</option>
<option value="Kuwait">Kuwait</option>
<option value="Kyrgyzstan">Kyrgyzstan</option>
<option value="Lao">Lao People's Democratic Republic</option>
<option value="Latvia">Latvia</option>
<option value="Lebanon" selected>Lebanon</option>
<option value="Lesotho">Lesotho</option>
<option value="Liberia">Liberia</option>
<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
<option value="Liechtenstein">Liechtenstein</option>
<option value="Lithuania">Lithuania</option>
<option value="Luxembourg">Luxembourg</option>
<option value="Macau">Macau</option>
<option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
<option value="Madagascar">Madagascar</option>
<option value="Malawi">Malawi</option>
<option value="Malaysia">Malaysia</option>
<option value="Maldives">Maldives</option>
<option value="Mali">Mali</option>
<option value="Malta">Malta</option>
<option value="Marshall Islands">Marshall Islands</option>
<option value="Martinique">Martinique</option>
<option value="Mauritania">Mauritania</option>
<option value="Mauritius">Mauritius</option>
<option value="Mayotte">Mayotte</option>
<option value="Mexico">Mexico</option>
<option value="Micronesia">Micronesia, Federated States of</option>
<option value="Moldova">Moldova, Republic of</option>
<option value="Monaco">Monaco</option>
<option value="Mongolia">Mongolia</option>
<option value="Montserrat">Montserrat</option>
<option value="Morocco">Morocco</option>
<option value="Mozambique">Mozambique</option>
<option value="Myanmar">Myanmar</option>
<option value="Namibia">Namibia</option>
<option value="Nauru">Nauru</option>
<option value="Nepal">Nepal</option>
<option value="Netherlands">Netherlands</option>
<option value="Netherlands Antilles">Netherlands Antilles</option>
<option value="New Caledonia">New Caledonia</option>
<option value="New Zealand">New Zealand</option>
<option value="Nicaragua">Nicaragua</option>
<option value="Niger">Niger</option>
<option value="Nigeria">Nigeria</option>
<option value="Niue">Niue</option>
<option value="Norfolk Island">Norfolk Island</option>
<option value="Northern Mariana Islands">Northern Mariana Islands</option>
<option value="Norway">Norway</option>
<option value="Oman">Oman</option>
<option value="Pakistan">Pakistan</option>
<option value="Palau">Palau</option>
<option value="Panama">Panama</option>
<option value="Papua New Guinea">Papua New Guinea</option>
<option value="Paraguay">Paraguay</option>
<option value="Peru">Peru</option>
<option value="Philippines">Philippines</option>
<option value="Pitcairn">Pitcairn</option>
<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Puerto Rico">Puerto Rico</option>
<option value="Qatar">Qatar</option>
<option value="Reunion">Reunion</option>
<option value="Romania">Romania</option>
<option value="Russia">Russian Federation</option>
<option value="Rwanda">Rwanda</option>
<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
<option value="Saint LUCIA">Saint LUCIA</option>
<option value="Saint Vincent">Saint Vincent and the Grenadines</option>
<option value="Samoa">Samoa</option>
<option value="San Marino">San Marino</option>
<option value="Sao Tome and Principe">Sao Tome and Principe</option> 
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Seychelles">Seychelles</option>
<option value="Sierra">Sierra Leone</option>
<option value="Singapore">Singapore</option>
<option value="Slovakia">Slovakia (Slovak Republic)</option>
<option value="Slovenia">Slovenia</option>
<option value="Solomon Islands">Solomon Islands</option>
<option value="Somalia">Somalia</option>
<option value="South Africa">South Africa</option>
<option value="South Georgia">South Georgia and the South Sandwich Islands</option>
<option value="Span">Spain</option>
<option value="SriLanka">Sri Lanka</option>
<option value="St. Helena">St. Helena</option>
<option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
<option value="Sudan">Sudan</option>
<option value="Suriname">Suriname</option>
<option value="Svalbard">Svalbard and Jan Mayen Islands</option>
<option value="Swaziland">Swaziland</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>
<option value="Syria">Syrian Arab Republic</option>
<option value="Taiwan">Taiwan, Province of China</option>
<option value="Tajikistan">Tajikistan</option>
<option value="Tanzania">Tanzania, United Republic of</option>
<option value="Thailand">Thailand</option>
<option value="Togo">Togo</option>
<option value="Tokelau">Tokelau</option>
<option value="Tonga">Tonga</option>
<option value="Trinidad and Tobago">Trinidad and Tobago</option>
<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Turks and Caicos">Turks and Caicos Islands</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Uganda">Uganda</option>
<option value="Ukraine">Ukraine</option>
<option value="United Arab Emirates">United Arab Emirates</option>
<option value="United Kingdom">United Kingdom</option>
<option value="United States">United States</option>
<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
<option value="Uruguay">Uruguay</option>
<option value="Uzbekistan">Uzbekistan</option>
<option value="Vanuatu">Vanuatu</option>
<option value="Venezuela">Venezuela</option>
<option value="Vietnam">Viet Nam</option>
<option value="Virgin Islands (British)">Virgin Islands (British)</option>
<option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
<option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
<option value="Western Sahara">Western Sahara</option>
<option value="Yemen">Yemen</option>
<option value="Serbia">Serbia</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabwe">Zimbabwe</option>
    </select>
            </div>
        </div>

<br>
        <div class="text-left ml-3">
            <input type="submit" name="insert21" value="SUBMIT" class="btn btn-info btn-lg btn-block rounded-0" style="background-color: #7bac53;
    border-radius: 5px;
    font-size: 16px;
    color: white;
    border: none;
    padding: 14px 30px;
    text-align: center;
    margin: auto;
    display: inherit;" />
        </div>
    </form>
    <!-- End of form -->

<?PHP
}
}
add_shortcode( 'MYFORM212', 'my_form21' );


add_action('rest_api_init', function() {
	register_rest_route('api', 'booking_details', array(
		'methods' => 'GET',
		'callback' => 'booking_details',
		
	));
});

function booking_details() {
	if (isset($_GET['id'])) {
		global $wpdb;
		// $table_name=$wpdb->prefix.'participants';
		$table_name='participants';
		$id=$_GET['id'];

		$result=$wpdb->get_results("SELECT * FROM $table_name where id = '$id' limit 1");
		return $result;
	} else {
		return 'Bad request';
	}
}



add_action( 'admin_menu', 'my_admin_menu' );
	
	function customerview_admin_page(){
    
	?>
	<div class="wrap">
		<h2>Customer Details</h2>
		<?php
		global $wpdb;
		// $table_name=$wpdb->prefix.'participants';
		$table_name='participants';

		$customers = $wpdb->get_results("SELECT * FROM $table_name ORDER BY ID DESC;");
		echo "<div class='table-responsive'><table class='table table-striped table-hover custom_datatable'><thead ><tr >";
		echo "<th>ID</th>";
		echo "<th>Attendance Day</th>";
		echo "<th>First Name</th>";
		echo "<th>Last Name</th>";
		echo "<th>Mobile No</th>";
		echo "<th>Email</th>";
		echo "<th>Company Name</th>";
		echo "<th>Job Title</th>";
		echo "<th>City</th>";
		echo "<th>Country</th></tr></thead><tbody>";
		foreach($customers as $customer){
			echo "<tr>";
			echo "<td>".$customer->id."</td>";
			echo "<td>".$customer->day."</td>";
			echo "<td>".$customer->firstname."</td>";
			echo "<td>".$customer->lastname."</td>";
			echo "<td>".$customer->phone."</td>";
			echo "<td>".$customer->email."</td>";
			echo "<td>".$customer->company."</td>";
			echo "<td>".$customer->job_title."</td>";
			echo "<td>".$customer->city."</td>";
			echo "<td>".$customer->country."</td>";
			echo "</tr>";
		}
		echo "</tbody></table></div>";
		?>
	</div>
  
  <link href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">

<!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  	<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script  src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script  src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script  src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>
  
  <script>
  $(document).ready( function () {
      $('.custom_datatable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
      });
  } );
  </script>
	<?php
	}
	
	function my_admin_menu() {
		add_menu_page('Customer Request View', 'Customer Requests', 'manage_options', 'myplugin/View_Customer_Details.php', 'customerview_admin_page', 'dashicons-tag', 6  );
	}










// ahsan workshop

function my_form_workshop(){

  if (isset($_POST['insert21'])) {
      global $wpdb;
      // $table_name=$wpdb->prefix.'workshop_form';
      $table_name='workshop_form';

      $topic = $_POST['topic'];
      $name = $_POST['prefix_name'];
      $position = $_POST['position'];
      $mobile = $_POST['mobile'];
      $email = $_POST['email'];
      $company = $_POST['company'];
      $industry = $_POST['industry'];
      $city = $_POST['city'];
      $island = $_POST['island'];
      $website = $_POST['website'];
      $phone = $_POST['phone'];
      $ext = $_POST['ext'];
      $address = $_POST['address'];
  
          $wpdb->insert($table_name, 
                                  array(
                                      'topic'=>$topic,
                                      'name'=>$name,
                                      'position'=>$position,
                                      'mobile'=>$mobile,
                                      'email'=>$email,
                                      'company'=>$company,
                                      'industry'=>$industry,
                                      'city'=>$city,
                                      'island'=>$island,
                                      'website'=>$website,
                                      'phone'=>$phone,
                                      'ext'=>$ext,
                                      'address'=>$address
                                  ),
                                  array(
                                      '%s',
                                      '%s',
                                      '%s',
                                      '%s',
                                      '%s',
                                      '%s',
                                      '%s',
                                      '%s',
                                      '%s',
                                      '%s',
                                      '%s',
                                      '%s',
                                      '%s'
                                  )
          );

          $lastid = $wpdb->insert_id;
// 			echo "<script>alert('data inserted');</script>";
$site_name =  get_bloginfo('name');

$mailadmin = get_bloginfo('admin_email');

$subject = $site_name.' New Participant Booking';

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";     
$headers .= 'From:KOT <info@kingdomoftomorrow.com>' . "\r\n";

$message = '<html>';
$message .= '<head>
          <style>
          .bg_color{background-color: white;padding: 10px 0px 10px 0px;}
          .logo_style {width: 150px;
  margin: auto 0 auto auto;
  display: inherit;
  margin-bottom: 20px;}
  .apple_style {
    width: 153px;
    margin: 20px auto auto auto;
    display: block;
    margin-bottom: 20px;
}
          .sec_bg{padding: 50px;
  background-color: #0C1E33;
  width: 300px;
  margin: auto;
  border: 1px solid #bab7b7;
  border-radius: 20px;}
          .h21{font-weight: 700; color:white;margin: 20px 0px 0px 0px !important;}
          .abc{font-weight: 400; color:white;margin: 7px 0px 10px 0px !important;}
          hr{margin: 20px 0px 20px 0px !important;}
          .l_color{color: #bbbbbb;text-align: center;margin-top: 20px;font-size: 13px;}
          .two_sec{width: 140px;
  display: inline-block;}
  .apple_btn {    font-size: 15px;
    text-decoration: none;
    border: 1px solid white;
    border-radius: 10px;
    width: 100px;
    text-align: center;
    padding: 11px;
    margin: 20px auto;
    display:inline-block;}
    .show_safari { display:none; }
    @media not all and (min-resolution:.001dpcm) { @supports (-webkit-appearance:none) and (display:flow-root) { .show_safari { display:block !important; } } }
          </style>
        </head>';
$message .= '<body>';

$message .= '<div class="bg_color">
          <div class="sec_bg">
            <img class="logo_style" src="http://www.kingdomoftomorrow.com/sites/wp-content/uploads/2022/10/loogo-1.png" alt="">
            <p class="abc">Thanks for your registration, please find below your ticket details</p>
            <img  style="margin: auto; display: inherit;" src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=http://www.kingdomoftomorrow.com/sites/wp-json/api/booking_details_workshop?id='.$lastid.'&choe=UTF-8" title="QR Code" />
            <div class="show_safari"><a class="apple_btn" href="https://developer.apple.com/documentation/walletpasses">Apple Wallet</a></div>
            <p class="h21">Workshop Topic</p><p class="abc">'.$topic.'</p>
            <p class="h21">Applicant Name</p><p class="abc">'.$name.'</p>
            <p class="h21">Position</p><p class="abc">'.$position.'</p>
            <p class="h21">Mobile No.</p><p class="abc">'.$mobile.'</p>
            <p class="h21">Email</p><p class="abc">'.$email.'</p>
            <p class="h21">Company Name</p><p class="abc">'.$company.'</p>
            <p class="h21">Industry Sector</p><p class="abc">'.$industry.'</p>
            <p class="h21">City</p><p class="abc">'.$island.'</p>
            <p class="h21">Website</p><p class="abc">'.$website.'</p>
            <p class="h21">Phone No</p><p class="abc">'.$phone.'</p>
            <p class="h21">Ext</p><p class="abc">'.$ext.'</p>
            <p class="h21">Address</p><p class="abc">'.$address.'</p>
            <p class="h21">Venue: </p><p class="abc">Riyadh Exhibition & Convention Center</p>
            <p class="h21">Venue location: </p><p class="abc"><a href="https://maps.app.goo.gl/TbCJ2WvMWYJx9wwv5?g_st=ic" class="l_color">Horimlaa</a></p>
          </div>
          <p class="l_color">Sent from <a href="http://www.kingdomoftomorrow.com/sites/" class="l_color">Kingdom of Tomorrow</a></p>
        </div>';

wp_mail( $mailadmin, $subject, $message, $headers );
wp_mail( $email, $subject, $message, $headers );
    ?>

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
<p id="form-submit" class="sb-menu" style="text-align: center; background: #30c330; padding: 10px; border-radius: 6px; color: white !important; font-size: 17px;">Thanks for your registration, <br> please visit your email to view your ticket.</p>
  <script>
//     $(document).ready(function(){
//   $("html, body").animate({ 
//       scrollTop: $('.sb-menu').offset().top 
//   }, 1000);
// });
  </script>
<?php
  }
else {
?>
<style>
.form-control {
  background-color: transparent !important;
  border: 1px solid #7BAC53 !important;
  color: #a8a4a4 !important;
}
</style>
   <!-- Form Starts -->
  <form id="form1" method="post" action="http://www.kingdomoftomorrow.com/sites/workshops/#form-submit">
      <!--enctype="multipart/form-data" is used with post method -->

      <div class="form-row">
        
          <div class="form-group col-md-6">
              <input type="text" class="form-control rounded-0 p-4" name="topic" placeholder="Workshop Topic" required style="background-color: white;" />
          </div>
<br>
          <div class="form-group col-md-6">
              <input type="text" class="form-control rounded-0 p-4" name="prefix_name" placeholder="Applicant Name" required style="background-color: white;" />
          </div>
<br>
          <div class="form-group col-md-6">
              <input type="text" class="form-control rounded-0 p-4" name="position" placeholder="Position" required style="background-color: white;" />
          </div>
<br>
          <div class="form-group col-md-6">
              <input type="tel" class="form-control rounded-0 p-4" name="mobile" placeholder="Mobile No" required style="background-color: white;" />
          </div>
<br>
          <div class="form-group col-md-12">
              <input type="email" class="form-control rounded-0 p-4" name="email" placeholder="Email" required style="background-color: white;" />
          </div>
<br>
          <div class="form-group col-md-12">
              <input type="text" class="form-control rounded-0 p-4" name="company" placeholder="Company Name" required style="background-color: white;" />
          </div>
<br>
          <div class="form-group col-md-12">
              <input type="text" class="form-control rounded-0 p-4" name="industry" placeholder="Industry Sector" required style="background-color: white;" />
          </div>
<br>
          <div class="form-group col-md-12">
              <input type="text" class="form-control rounded-0 p-4" name="city" placeholder="City" required style="background-color: white;" />
          </div>
<br>
          <div class="form-group col-md-12">
              <select name="island" id="island" class="form-control rounded-0 p-4" required >
              <option value="Åland Islands">Åland Islands</option>
									<option value="Albania">Albania</option>
									<option value="Algeria">Algeria</option>
									<option value="American Samoa">American Samoa</option>
									<option value="Andorra">Andorra</option>
									<option value="Angola">Angola</option>
									<option value="Anguilla">Anguilla</option>
									<option value="Antarctica">Antarctica</option>
									<option value="Antigua and Barbuda">Antigua and Barbuda</option>
									<option value="Argentina">Argentina</option>
									<option value="Armenia">Armenia</option>
									<option value="Aruba">Aruba</option>
									<option value="Australia">Australia</option>
									<option value="Austria">Austria</option>
									<option value="Azerbaijan">Azerbaijan</option>
									<option value="Bahamas">Bahamas</option>
									<option value="Bahrain">Bahrain</option>
									<option value="Bangladesh">Bangladesh</option>
									<option value="Barbados">Barbados</option>
									<option value="Belarus">Belarus</option>
									<option value="Belgium">Belgium</option>
									<option value="Belize">Belize</option>
									<option value="Benin">Benin</option>
									<option value="Bermuda">Bermuda</option>
									<option value="Bhutan">Bhutan</option>
									<option value="Bolivia">Bolivia</option>
									<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
									<option value="Botswana">Botswana</option>
									<option value="Bouvet Island">Bouvet Island</option>
									<option value="Brazil">Brazil</option>
									<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
									<option value="Brunei Darussalam">Brunei Darussalam</option>
									<option value="Bulgaria">Bulgaria</option>
									<option value="Burkina Faso">Burkina Faso</option>
									<option value="Burundi">Burundi</option>
									<option value="Cambodia">Cambodia</option>
									<option value="Cameroon">Cameroon</option>
									<option value="Canada">Canada</option>
									<option value="Cape Verde">Cape Verde</option>
									<option value="Cayman Islands">Cayman Islands</option>
									<option value="Central African Republic">Central African Republic</option>
									<option value="Chad">Chad</option>
									<option value="Chile">Chile</option>
									<option value="China">China</option>
									<option value="Christmas Island">Christmas Island</option>
									<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
									<option value="Colombia">Colombia</option>
									<option value="Comoros">Comoros</option>
									<option value="Congo">Congo</option>
									<option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
									<option value="Cook Islands">Cook Islands</option>
									<option value="Costa Rica">Costa Rica</option>
									<option value="Cote D'ivoire">Cote D'ivoire</option>
									<option value="Croatia">Croatia</option>
									<option value="Cuba">Cuba</option>
									<option value="Cyprus">Cyprus</option>
									<option value="Czech Republic">Czech Republic</option>
									<option value="Denmark">Denmark</option>
									<option value="Djibouti">Djibouti</option>
									<option value="Dominica">Dominica</option>
									<option value="Dominican Republic">Dominican Republic</option>
									<option value="Ecuador">Ecuador</option>
									<option value="Egypt">Egypt</option>
									<option value="El Salvador">El Salvador</option>
									<option value="Equatorial Guinea">Equatorial Guinea</option>
									<option value="Eritrea">Eritrea</option>
									<option value="Estonia">Estonia</option>
									<option value="Ethiopia">Ethiopia</option>
									<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
									<option value="Faroe Islands">Faroe Islands</option>
									<option value="Fiji">Fiji</option>
									<option value="Finland">Finland</option>
									<option value="France">France</option>
									<option value="French Guiana">French Guiana</option>
									<option value="French Polynesia">French Polynesia</option>
									<option value="French Southern Territories">French Southern Territories</option>
									<option value="Gabon">Gabon</option>
									<option value="Gambia">Gambia</option>
									<option value="Georgia">Georgia</option>
									<option value="Germany">Germany</option>
									<option value="Ghana">Ghana</option>
									<option value="Gibraltar">Gibraltar</option>
									<option value="Greece">Greece</option>
									<option value="Greenland">Greenland</option>
									<option value="Grenada">Grenada</option>
									<option value="Guadeloupe">Guadeloupe</option>
									<option value="Guam">Guam</option>
									<option value="Guatemala">Guatemala</option>
									<option value="Guernsey">Guernsey</option>
									<option value="Guinea">Guinea</option>
									<option value="Guinea-bissau">Guinea-bissau</option>
									<option value="Guyana">Guyana</option>
									<option value="Haiti">Haiti</option>
									<option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
									<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
									<option value="Honduras">Honduras</option>
									<option value="Hong Kong">Hong Kong</option>
									<option value="Hungary">Hungary</option>
									<option value="Iceland">Iceland</option>
									<option value="India">India</option>
									<option value="Indonesia">Indonesia</option>
									<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
									<option value="Iraq">Iraq</option>
									<option value="Ireland">Ireland</option>
									<option value="Isle of Man">Isle of Man</option>
									<option value="Israel">Israel</option>
									<option value="Italy">Italy</option>
									<option value="Jamaica">Jamaica</option>
									<option value="Japan">Japan</option>
									<option value="Jersey">Jersey</option>
									<option value="Jordan">Jordan</option>
									<option value="Kazakhstan">Kazakhstan</option>
									<option value="Kenya">Kenya</option>
									<option value="Kiribati">Kiribati</option>
									<option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
									<option value="Korea, Republic of">Korea, Republic of</option>
									<option value="Kuwait">Kuwait</option>
									<option value="Kyrgyzstan">Kyrgyzstan</option>
									<option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
									<option value="Latvia">Latvia</option>
									<option value="Lebanon">Lebanon</option>
									<option value="Lesotho">Lesotho</option>
									<option value="Liberia">Liberia</option>
									<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
									<option value="Liechtenstein">Liechtenstein</option>
									<option value="Lithuania">Lithuania</option>
									<option value="Luxembourg">Luxembourg</option>
									<option value="Macao">Macao</option>
									<option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
									<option value="Madagascar">Madagascar</option>
									<option value="Malawi">Malawi</option>
									<option value="Malaysia">Malaysia</option>
									<option value="Maldives">Maldives</option>
									<option value="Mali">Mali</option>
									<option value="Malta">Malta</option>
									<option value="Marshall Islands">Marshall Islands</option>
									<option value="Martinique">Martinique</option>
									<option value="Mauritania">Mauritania</option>
									<option value="Mauritius">Mauritius</option>
									<option value="Mayotte">Mayotte</option>
									<option value="Mexico">Mexico</option>
									<option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
									<option value="Moldova, Republic of">Moldova, Republic of</option>
									<option value="Monaco">Monaco</option>
									<option value="Mongolia">Mongolia</option>
									<option value="Montenegro">Montenegro</option>
									<option value="Montserrat">Montserrat</option>
									<option value="Morocco">Morocco</option>
									<option value="Mozambique">Mozambique</option>
									<option value="Myanmar">Myanmar</option>
									<option value="Namibia">Namibia</option>
									<option value="Nauru">Nauru</option>
									<option value="Nepal">Nepal</option>
									<option value="Netherlands">Netherlands</option>
									<option value="Netherlands Antilles">Netherlands Antilles</option>
									<option value="New Caledonia">New Caledonia</option>
									<option value="New Zealand">New Zealand</option>
									<option value="Nicaragua">Nicaragua</option>
									<option value="Niger">Niger</option>
									<option value="Nigeria">Nigeria</option>
									<option value="Niue">Niue</option>
									<option value="Norfolk Island">Norfolk Island</option>
									<option value="Northern Mariana Islands">Northern Mariana Islands</option>
									<option value="Norway">Norway</option>
									<option value="Oman">Oman</option>
									<option value="Pakistan">Pakistan</option>
									<option value="Palau">Palau</option>
									<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
									<option value="Panama">Panama</option>
									<option value="Papua New Guinea">Papua New Guinea</option>
									<option value="Paraguay">Paraguay</option>
									<option value="Peru">Peru</option>
									<option value="Philippines">Philippines</option>
									<option value="Pitcairn">Pitcairn</option>
									<option value="Poland">Poland</option>
									<option value="Portugal">Portugal</option>
									<option value="Puerto Rico">Puerto Rico</option>
									<option value="Qatar">Qatar</option>
									<option value="Reunion">Reunion</option>
									<option value="Romania">Romania</option>
									<option value="Russian Federation">Russian Federation</option>
									<option value="Rwanda">Rwanda</option>
									<option value="Saint Helena">Saint Helena</option>
									<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
									<option value="Saint Lucia">Saint Lucia</option>
									<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
									<option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
									<option value="Samoa">Samoa</option>
									<option value="San Marino">San Marino</option>
									<option value="Sao Tome and Principe">Sao Tome and Principe</option>
									<option value="Saudi Arabia">Saudi Arabia</option>
									<option value="Senegal">Senegal</option>
									<option value="Serbia">Serbia</option>
									<option value="Seychelles">Seychelles</option>
									<option value="Sierra Leone">Sierra Leone</option>
									<option value="Singapore">Singapore</option>
									<option value="Slovakia">Slovakia</option>
									<option value="Slovenia">Slovenia</option>
									<option value="Solomon Islands">Solomon Islands</option>
									<option value="Somalia">Somalia</option>
									<option value="South Africa">South Africa</option>
									<option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
									<option value="Spain">Spain</option>
									<option value="Sri Lanka">Sri Lanka</option>
									<option value="Sudan">Sudan</option>
									<option value="Suriname">Suriname</option>
									<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
									<option value="Swaziland">Swaziland</option>
									<option value="Sweden">Sweden</option>
									<option value="Switzerland">Switzerland</option>
									<option value="Syrian Arab Republic">Syrian Arab Republic</option>
									<option value="Taiwan">Taiwan</option>
									<option value="Tajikistan">Tajikistan</option>
									<option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
									<option value="Thailand">Thailand</option>
									<option value="Timor-leste">Timor-leste</option>
									<option value="Togo">Togo</option>
									<option value="Tokelau">Tokelau</option>
									<option value="Tonga">Tonga</option>
									<option value="Trinidad and Tobago">Trinidad and Tobago</option>
									<option value="Tunisia">Tunisia</option>
									<option value="Turkey">Turkey</option>
									<option value="Turkmenistan">Turkmenistan</option>
									<option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
									<option value="Tuvalu">Tuvalu</option>
									<option value="Uganda">Uganda</option>
									<option value="Ukraine">Ukraine</option>
									<option value="United Arab Emirates">United Arab Emirates</option>
									<option value="United Kingdom">United Kingdom</option>
									<option value="United States">United States</option>
									<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
									<option value="Uruguay">Uruguay</option>
									<option value="Uzbekistan">Uzbekistan</option>
									<option value="Vanuatu">Vanuatu</option>
									<option value="Venezuela">Venezuela</option>
									<option value="Viet Nam">Viet Nam</option>
									<option value="Virgin Islands, British">Virgin Islands, British</option>
									<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
									<option value="Wallis and Futuna">Wallis and Futuna</option>
									<option value="Western Sahara">Western Sahara</option>
									<option value="Yemen">Yemen</option>
									<option value="Zambia">Zambia</option>
									<option value="Zimbabwe">Zimbabwe</option>
              </select>
          </div>
<br>
          <div class="form-group col-md-12">
              <input type="text" class="form-control rounded-0 p-4" name="website" placeholder="Website" required style="background-color: white;" />
          </div>
<br>
          <div class="form-group col-md-12">
              <input type="tel" class="form-control rounded-0 p-4" name="phone" placeholder="Phone No" required style="background-color: white;" />
          </div>
<br>
          <div class="form-group col-md-12">
              <input type="text" class="form-control rounded-0 p-4" name="ext" placeholder="Ext" required style="background-color: white;" />
          </div>
<br>
          <div class="form-group col-md-12">
              <input type="text" class="form-control rounded-0 p-4" name="address" placeholder="Address" required style="background-color: white;" />
          </div>
      </div>

<br>
      <div class="text-left ml-3">
          <input type="submit" name="insert21" value="SUBMIT" class="btn btn-info btn-lg btn-block rounded-0" style="background-color: #7bac53;
    border-radius: 5px;
    font-size: 16px;
    color: white;
    border: none;
    padding: 14px 30px;
    text-align: center;
    margin: auto;
    display: inherit;" />
      </div>
  </form>
  <!-- End of form -->

<?PHP
}
}
add_shortcode( 'MYFORM_WORKSHOP', 'my_form_workshop' );


add_action('rest_api_init', function() {
register_rest_route('api', 'booking_details_workshop', array(
  'methods' => 'GET',
  'callback' => 'booking_details_workshop',
  
));
});

function booking_details_workshop() {
if (isset($_GET['id'])) {
  global $wpdb;
  // $table_name=$wpdb->prefix.'workshop_form';
  $table_name='workshop_form';
  $id=$_GET['id'];

  $result=$wpdb->get_results("SELECT * FROM $table_name where id = '$id' limit 1");
  return $result;
} else {
  return 'Bad request';
}
}



add_action( 'admin_menu', 'my_admin_menu_workshop' );

function workshop_view_admin_page(){
  
?>
<div class="wrap">
  <h2>Customer Details</h2>
  <?php
  global $wpdb;
  // $table_name=$wpdb->prefix.'workshop_form';
  $table_name='workshop_form';

  $customers = $wpdb->get_results("SELECT * FROM $table_name ORDER BY ID DESC;");
  echo "<div class='table-responsive'><table class='table table-striped table-hover custom_datatable'><thead ><tr >";
  echo "<th>ID</th>";
  echo "<th>Workshop Topic</th>";
  echo "<th>Applicant Name</th>";
  echo "<th>Position</th>";
  echo "<th>Mobile No</th>";
  echo "<th>Email</th>";
  echo "<th>Company Name</th>";
  echo "<th>Industry Sector</th>";
  echo "<th>City</th>";
  echo "<th>Island</th>";
  echo "<th>Website</th>";
  echo "<th>Phone No</th>";
  echo "<th>Ext</th>";
  echo "<th>Address</th></tr></thead><tbody>";
  foreach($customers as $customer){
    echo "<tr>";
    echo "<td>".$customer->id."</td>";
    echo "<td>".$customer->topic."</td>";
    echo "<td>".$customer->name."</td>";
    echo "<td>".$customer->position."</td>";
    echo "<td>".$customer->mobile."</td>";
    echo "<td>".$customer->email."</td>";
    echo "<td>".$customer->company."</td>";
    echo "<td>".$customer->industry."</td>";
    echo "<td>".$customer->city."</td>";
    echo "<td>".$customer->island."</td>";
    echo "<td>".$customer->website."</td>";
    echo "<td>".$customer->phone."</td>";
    echo "<td>".$customer->ext."</td>";
    echo "<td>".$customer->address."</td>";
    echo "</tr>";
  }
  echo "</tbody></table></div>";
  ?>
</div>

<link href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script  src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script  src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script  src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>

<script>
$(document).ready( function () {
    $('.custom_datatable').DataTable({
      dom: 'Bfrtip',
      buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
      ]
    });
} );
</script>
<?php
}

function my_admin_menu_workshop() {
  add_menu_page('Workshop Requests', 'Workshop Requests', 'manage_options', 'myplugin/View_Workshop_Requests.php', 'workshop_view_admin_page', 'dashicons-tag', 7  );
}











// ahsan conference

function my_form_conference(){

  if (isset($_POST['insert21'])) {
      global $wpdb;
      // $table_name=$wpdb->prefix.'conference_form';
      $table_name='conference_form';

      $name = $_POST['prefix_name'];
      $position = $_POST['position'];
      $mobile = $_POST['mobile'];
      $email = $_POST['email'];
      $company = $_POST['company'];
      $industry = $_POST['industry'];
      $city = $_POST['city'];
      $island = $_POST['island'];
      $website = $_POST['website'];
      $phone = $_POST['phone'];
      $ext = $_POST['ext'];
      $address = $_POST['address'];
  
          $wpdb->insert($table_name, 
                                  array(
                                      'name'=>$name,
                                      'position'=>$position,
                                      'mobile'=>$mobile,
                                      'email'=>$email,
                                      'company'=>$company,
                                      'industry'=>$industry,
                                      'city'=>$city,
                                      'island'=>$island,
                                      'website'=>$website,
                                      'phone'=>$phone,
                                      'ext'=>$ext,
                                      'address'=>$address
                                  ),
                                  array(
                                      '%s',
                                      '%s',
                                      '%s',
                                      '%s',
                                      '%s',
                                      '%s',
                                      '%s',
                                      '%s',
                                      '%s',
                                      '%s',
                                      '%s',
                                      '%s',
                                      '%s'
                                  )
          );

          $lastid = $wpdb->insert_id;
// 			echo "<script>alert('data inserted');</script>";
$site_name =  get_bloginfo('name');

$mailadmin = get_bloginfo('admin_email');

$subject = $site_name.' New Participant Booking';

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";     
$headers .= 'From:KOT <info@kingdomoftomorrow.com>' . "\r\n";

$message = '<html>';
$message .= '<head>
          <style>
          .bg_color{background-color: white;padding: 10px 0px 10px 0px;}
          .logo_style {width: 150px;
  margin: auto 0 auto auto;
  display: inherit;
  margin-bottom: 20px;}
  .apple_style {
    width: 153px;
    margin: 20px auto auto auto;
    display: block;
    margin-bottom: 20px;
}
          .sec_bg{padding: 50px;
  background-color: #0C1E33;
  width: 300px;
  margin: auto;
  border: 1px solid #bab7b7;
  border-radius: 20px;}
          .h21{font-weight: 700; color:white;margin: 20px 0px 0px 0px !important;}
          .abc{font-weight: 400; color:white;margin: 7px 0px 10px 0px !important;}
          hr{margin: 20px 0px 20px 0px !important;}
          .l_color{color: #bbbbbb;text-align: center;margin-top: 20px;font-size: 13px;}
          .two_sec{width: 140px;
  display: inline-block;}
  .apple_btn {    font-size: 15px;
    text-decoration: none;
    border: 1px solid white;
    border-radius: 10px;
    width: 100px;
    text-align: center;
    padding: 11px;
    margin: 20px auto;
    display:inline-block;}
    .show_safari { display:none; }
    @media not all and (min-resolution:.001dpcm) { @supports (-webkit-appearance:none) and (display:flow-root) { .show_safari { display:block !important; } } }
    apple-pay-button {
      --apple-pay-button-width: 140px;
      --apple-pay-button-height: 30px;
      --apple-pay-button-border-radius: 5px;
      --apple-pay-button-padding: 5px 0px;
    }
          </style>
          <script src="https://applepay.cdn-apple.com/jsapi/v1/apple-pay-sdk.js"></script>
        </head>';
$message .= '<body>';

$message .= '<div class="bg_color">
          <div class="sec_bg">
            <img class="logo_style" src="http://www.kingdomoftomorrow.com/sites/wp-content/uploads/2022/10/loogo-1.png" alt="">
            <p class="abc">Thanks for your registration, please find below your ticket details</p>
            <img  style="margin: auto; display: inherit;" src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=http://www.kingdomoftomorrow.com/sites/wp-json/api/booking_details_conference?id='.$lastid.'&choe=UTF-8" title="QR Code" />
            <apple-pay-button buttonstyle="black" type="buy" locale="el-GR"></apple-pay-button>
            <p class="h21">Applicant Name</p><p class="abc">'.$name.'</p>
            <p class="h21">Position</p><p class="abc">'.$position.'</p>
            <p class="h21">Mobile No.</p><p class="abc">'.$mobile.'</p>
            <p class="h21">Email</p><p class="abc">'.$email.'</p>
            <p class="h21">Company Name</p><p class="abc">'.$company.'</p>
            <p class="h21">Industry Sector</p><p class="abc">'.$industry.'</p>
            <p class="h21">City</p><p class="abc">'.$island.'</p>
            <p class="h21">Website</p><p class="abc">'.$website.'</p>
            <p class="h21">Phone No</p><p class="abc">'.$phone.'</p>
            <p class="h21">Ext</p><p class="abc">'.$ext.'</p>
            <p class="h21">Address</p><p class="abc">'.$address.'</p>
            <p class="h21">Venue: </p><p class="abc">Riyadh Exhibition & Convention Center</p>
            <p class="h21">Venue location: </p><p class="abc"><a href="https://maps.app.goo.gl/TbCJ2WvMWYJx9wwv5?g_st=ic" class="l_color">Horimlaa</a></p>
          </div>
          <p class="l_color">Sent from <a href="http://www.kingdomoftomorrow.com/sites/" class="l_color">Kingdom of Tomorrow</a></p>
        </div>';

wp_mail( $mailadmin, $subject, $message, $headers );
wp_mail( $email, $subject, $message, $headers );
    ?>

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
<p id="form-submit" class="sb-menu" style="text-align: center; background: #30c330; padding: 10px; border-radius: 6px; color: white !important; font-size: 17px;">Thanks for your registration, <br> please visit your email to view your ticket.</p>
  <script>
//     $(document).ready(function(){
//   $("html, body").animate({ 
//       scrollTop: $('.sb-menu').offset().top 
//   }, 1000);
// });
  </script>
<?php
  }
else {
?>
<style>
.form-control {
  background-color: transparent !important;
  border: 1px solid #7BAC53 !important;
  color: #a8a4a4 !important;
}
</style>
   <!-- Form Starts -->
  <form id="form1" method="post" action="http://www.kingdomoftomorrow.com/sites/conference/#form-submit">
      <!--enctype="multipart/form-data" is used with post method -->

  <input type="hidden" id="total1" name="total21" />
      <div class="form-row">
        
          <div class="form-group col-md-6">
              <input type="text" class="form-control rounded-0 p-4" name="prefix_name" placeholder="Applicant Name" required style="background-color: white;" />
          </div>
<br>
          <div class="form-group col-md-6">
              <input type="text" class="form-control rounded-0 p-4" name="position" placeholder="Position" required style="background-color: white;" />
          </div>
<br>
          <div class="form-group col-md-6">
              <input type="tel" class="form-control rounded-0 p-4" name="mobile" placeholder="Mobile No" required style="background-color: white;" />
          </div>
<br>
          <div class="form-group col-md-12">
              <input type="email" class="form-control rounded-0 p-4" name="email" placeholder="Email" required style="background-color: white;" />
          </div>
<br>
          <div class="form-group col-md-12">
              <input type="text" class="form-control rounded-0 p-4" name="company" placeholder="Company Name" required style="background-color: white;" />
          </div>
<br>
          <div class="form-group col-md-12">
              <input type="text" class="form-control rounded-0 p-4" name="industry" placeholder="Industry Sector" required style="background-color: white;" />
          </div>
<br>
          <div class="form-group col-md-12">
              <input type="text" class="form-control rounded-0 p-4" name="city" placeholder="City" required style="background-color: white;" />
          </div>
<br>
          <div class="form-group col-md-12">
              <select name="island" id="island" class="form-control rounded-0 p-4" required >
              <option value="Åland Islands">Åland Islands</option>
									<option value="Albania">Albania</option>
									<option value="Algeria">Algeria</option>
									<option value="American Samoa">American Samoa</option>
									<option value="Andorra">Andorra</option>
									<option value="Angola">Angola</option>
									<option value="Anguilla">Anguilla</option>
									<option value="Antarctica">Antarctica</option>
									<option value="Antigua and Barbuda">Antigua and Barbuda</option>
									<option value="Argentina">Argentina</option>
									<option value="Armenia">Armenia</option>
									<option value="Aruba">Aruba</option>
									<option value="Australia">Australia</option>
									<option value="Austria">Austria</option>
									<option value="Azerbaijan">Azerbaijan</option>
									<option value="Bahamas">Bahamas</option>
									<option value="Bahrain">Bahrain</option>
									<option value="Bangladesh">Bangladesh</option>
									<option value="Barbados">Barbados</option>
									<option value="Belarus">Belarus</option>
									<option value="Belgium">Belgium</option>
									<option value="Belize">Belize</option>
									<option value="Benin">Benin</option>
									<option value="Bermuda">Bermuda</option>
									<option value="Bhutan">Bhutan</option>
									<option value="Bolivia">Bolivia</option>
									<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
									<option value="Botswana">Botswana</option>
									<option value="Bouvet Island">Bouvet Island</option>
									<option value="Brazil">Brazil</option>
									<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
									<option value="Brunei Darussalam">Brunei Darussalam</option>
									<option value="Bulgaria">Bulgaria</option>
									<option value="Burkina Faso">Burkina Faso</option>
									<option value="Burundi">Burundi</option>
									<option value="Cambodia">Cambodia</option>
									<option value="Cameroon">Cameroon</option>
									<option value="Canada">Canada</option>
									<option value="Cape Verde">Cape Verde</option>
									<option value="Cayman Islands">Cayman Islands</option>
									<option value="Central African Republic">Central African Republic</option>
									<option value="Chad">Chad</option>
									<option value="Chile">Chile</option>
									<option value="China">China</option>
									<option value="Christmas Island">Christmas Island</option>
									<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
									<option value="Colombia">Colombia</option>
									<option value="Comoros">Comoros</option>
									<option value="Congo">Congo</option>
									<option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
									<option value="Cook Islands">Cook Islands</option>
									<option value="Costa Rica">Costa Rica</option>
									<option value="Cote D'ivoire">Cote D'ivoire</option>
									<option value="Croatia">Croatia</option>
									<option value="Cuba">Cuba</option>
									<option value="Cyprus">Cyprus</option>
									<option value="Czech Republic">Czech Republic</option>
									<option value="Denmark">Denmark</option>
									<option value="Djibouti">Djibouti</option>
									<option value="Dominica">Dominica</option>
									<option value="Dominican Republic">Dominican Republic</option>
									<option value="Ecuador">Ecuador</option>
									<option value="Egypt">Egypt</option>
									<option value="El Salvador">El Salvador</option>
									<option value="Equatorial Guinea">Equatorial Guinea</option>
									<option value="Eritrea">Eritrea</option>
									<option value="Estonia">Estonia</option>
									<option value="Ethiopia">Ethiopia</option>
									<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
									<option value="Faroe Islands">Faroe Islands</option>
									<option value="Fiji">Fiji</option>
									<option value="Finland">Finland</option>
									<option value="France">France</option>
									<option value="French Guiana">French Guiana</option>
									<option value="French Polynesia">French Polynesia</option>
									<option value="French Southern Territories">French Southern Territories</option>
									<option value="Gabon">Gabon</option>
									<option value="Gambia">Gambia</option>
									<option value="Georgia">Georgia</option>
									<option value="Germany">Germany</option>
									<option value="Ghana">Ghana</option>
									<option value="Gibraltar">Gibraltar</option>
									<option value="Greece">Greece</option>
									<option value="Greenland">Greenland</option>
									<option value="Grenada">Grenada</option>
									<option value="Guadeloupe">Guadeloupe</option>
									<option value="Guam">Guam</option>
									<option value="Guatemala">Guatemala</option>
									<option value="Guernsey">Guernsey</option>
									<option value="Guinea">Guinea</option>
									<option value="Guinea-bissau">Guinea-bissau</option>
									<option value="Guyana">Guyana</option>
									<option value="Haiti">Haiti</option>
									<option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
									<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
									<option value="Honduras">Honduras</option>
									<option value="Hong Kong">Hong Kong</option>
									<option value="Hungary">Hungary</option>
									<option value="Iceland">Iceland</option>
									<option value="India">India</option>
									<option value="Indonesia">Indonesia</option>
									<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
									<option value="Iraq">Iraq</option>
									<option value="Ireland">Ireland</option>
									<option value="Isle of Man">Isle of Man</option>
									<option value="Israel">Israel</option>
									<option value="Italy">Italy</option>
									<option value="Jamaica">Jamaica</option>
									<option value="Japan">Japan</option>
									<option value="Jersey">Jersey</option>
									<option value="Jordan">Jordan</option>
									<option value="Kazakhstan">Kazakhstan</option>
									<option value="Kenya">Kenya</option>
									<option value="Kiribati">Kiribati</option>
									<option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
									<option value="Korea, Republic of">Korea, Republic of</option>
									<option value="Kuwait">Kuwait</option>
									<option value="Kyrgyzstan">Kyrgyzstan</option>
									<option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
									<option value="Latvia">Latvia</option>
									<option value="Lebanon">Lebanon</option>
									<option value="Lesotho">Lesotho</option>
									<option value="Liberia">Liberia</option>
									<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
									<option value="Liechtenstein">Liechtenstein</option>
									<option value="Lithuania">Lithuania</option>
									<option value="Luxembourg">Luxembourg</option>
									<option value="Macao">Macao</option>
									<option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
									<option value="Madagascar">Madagascar</option>
									<option value="Malawi">Malawi</option>
									<option value="Malaysia">Malaysia</option>
									<option value="Maldives">Maldives</option>
									<option value="Mali">Mali</option>
									<option value="Malta">Malta</option>
									<option value="Marshall Islands">Marshall Islands</option>
									<option value="Martinique">Martinique</option>
									<option value="Mauritania">Mauritania</option>
									<option value="Mauritius">Mauritius</option>
									<option value="Mayotte">Mayotte</option>
									<option value="Mexico">Mexico</option>
									<option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
									<option value="Moldova, Republic of">Moldova, Republic of</option>
									<option value="Monaco">Monaco</option>
									<option value="Mongolia">Mongolia</option>
									<option value="Montenegro">Montenegro</option>
									<option value="Montserrat">Montserrat</option>
									<option value="Morocco">Morocco</option>
									<option value="Mozambique">Mozambique</option>
									<option value="Myanmar">Myanmar</option>
									<option value="Namibia">Namibia</option>
									<option value="Nauru">Nauru</option>
									<option value="Nepal">Nepal</option>
									<option value="Netherlands">Netherlands</option>
									<option value="Netherlands Antilles">Netherlands Antilles</option>
									<option value="New Caledonia">New Caledonia</option>
									<option value="New Zealand">New Zealand</option>
									<option value="Nicaragua">Nicaragua</option>
									<option value="Niger">Niger</option>
									<option value="Nigeria">Nigeria</option>
									<option value="Niue">Niue</option>
									<option value="Norfolk Island">Norfolk Island</option>
									<option value="Northern Mariana Islands">Northern Mariana Islands</option>
									<option value="Norway">Norway</option>
									<option value="Oman">Oman</option>
									<option value="Pakistan">Pakistan</option>
									<option value="Palau">Palau</option>
									<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
									<option value="Panama">Panama</option>
									<option value="Papua New Guinea">Papua New Guinea</option>
									<option value="Paraguay">Paraguay</option>
									<option value="Peru">Peru</option>
									<option value="Philippines">Philippines</option>
									<option value="Pitcairn">Pitcairn</option>
									<option value="Poland">Poland</option>
									<option value="Portugal">Portugal</option>
									<option value="Puerto Rico">Puerto Rico</option>
									<option value="Qatar">Qatar</option>
									<option value="Reunion">Reunion</option>
									<option value="Romania">Romania</option>
									<option value="Russian Federation">Russian Federation</option>
									<option value="Rwanda">Rwanda</option>
									<option value="Saint Helena">Saint Helena</option>
									<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
									<option value="Saint Lucia">Saint Lucia</option>
									<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
									<option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
									<option value="Samoa">Samoa</option>
									<option value="San Marino">San Marino</option>
									<option value="Sao Tome and Principe">Sao Tome and Principe</option>
									<option value="Saudi Arabia">Saudi Arabia</option>
									<option value="Senegal">Senegal</option>
									<option value="Serbia">Serbia</option>
									<option value="Seychelles">Seychelles</option>
									<option value="Sierra Leone">Sierra Leone</option>
									<option value="Singapore">Singapore</option>
									<option value="Slovakia">Slovakia</option>
									<option value="Slovenia">Slovenia</option>
									<option value="Solomon Islands">Solomon Islands</option>
									<option value="Somalia">Somalia</option>
									<option value="South Africa">South Africa</option>
									<option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
									<option value="Spain">Spain</option>
									<option value="Sri Lanka">Sri Lanka</option>
									<option value="Sudan">Sudan</option>
									<option value="Suriname">Suriname</option>
									<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
									<option value="Swaziland">Swaziland</option>
									<option value="Sweden">Sweden</option>
									<option value="Switzerland">Switzerland</option>
									<option value="Syrian Arab Republic">Syrian Arab Republic</option>
									<option value="Taiwan">Taiwan</option>
									<option value="Tajikistan">Tajikistan</option>
									<option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
									<option value="Thailand">Thailand</option>
									<option value="Timor-leste">Timor-leste</option>
									<option value="Togo">Togo</option>
									<option value="Tokelau">Tokelau</option>
									<option value="Tonga">Tonga</option>
									<option value="Trinidad and Tobago">Trinidad and Tobago</option>
									<option value="Tunisia">Tunisia</option>
									<option value="Turkey">Turkey</option>
									<option value="Turkmenistan">Turkmenistan</option>
									<option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
									<option value="Tuvalu">Tuvalu</option>
									<option value="Uganda">Uganda</option>
									<option value="Ukraine">Ukraine</option>
									<option value="United Arab Emirates">United Arab Emirates</option>
									<option value="United Kingdom">United Kingdom</option>
									<option value="United States">United States</option>
									<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
									<option value="Uruguay">Uruguay</option>
									<option value="Uzbekistan">Uzbekistan</option>
									<option value="Vanuatu">Vanuatu</option>
									<option value="Venezuela">Venezuela</option>
									<option value="Viet Nam">Viet Nam</option>
									<option value="Virgin Islands, British">Virgin Islands, British</option>
									<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
									<option value="Wallis and Futuna">Wallis and Futuna</option>
									<option value="Western Sahara">Western Sahara</option>
									<option value="Yemen">Yemen</option>
									<option value="Zambia">Zambia</option>
									<option value="Zimbabwe">Zimbabwe</option>
              </select>
          </div>
<br>
          <div class="form-group col-md-12">
              <input type="text" class="form-control rounded-0 p-4" name="website" placeholder="Website" required style="background-color: white;" />
          </div>
<br>
          <div class="form-group col-md-12">
              <input type="tel" class="form-control rounded-0 p-4" name="phone" placeholder="Phone No" required style="background-color: white;" />
          </div>
<br>
          <div class="form-group col-md-12">
              <input type="text" class="form-control rounded-0 p-4" name="ext" placeholder="Ext" required style="background-color: white;" />
          </div>
<br>
          <div class="form-group col-md-12">
              <input type="text" class="form-control rounded-0 p-4" name="address" placeholder="Address" required style="background-color: white;" />
          </div>
      </div>

<br>
      <div class="text-left ml-3">
          <input type="submit" name="insert21" value="SUBMIT" class="btn btn-info btn-lg btn-block rounded-0" style="background-color: #7bac53;
    border-radius: 5px;
    font-size: 16px;
    color: white;
    border: none;
    padding: 14px 30px;
    text-align: center;
    margin: auto;
    display: inherit;" />
      </div>
  </form>
  <!-- End of form -->

<?PHP
}
}
add_shortcode( 'MYFORM_CONFERENCE', 'my_form_conference' );


add_action('rest_api_init', function() {
register_rest_route('api', 'booking_details_conference', array(
  'methods' => 'GET',
  'callback' => 'booking_details_conference',
  
));
});

function booking_details_conference() {
if (isset($_GET['id'])) {
  global $wpdb;
  // $table_name=$wpdb->prefix.'conference_form';
  $table_name='conference_form';
  $id=$_GET['id'];

  $result=$wpdb->get_results("SELECT * FROM $table_name where id = '$id' limit 1");
  return $result;
} else {
  return 'Bad request';
}
}



add_action( 'admin_menu', 'my_admin_menu_conference' );

function conference_view_admin_page(){
  
?>
<div class="wrap">
  <h2>Customer Details</h2>
  <?php
  global $wpdb;
  // $table_name=$wpdb->prefix.'conference_form';
  $table_name='conference_form';

  $customers = $wpdb->get_results("SELECT * FROM $table_name ORDER BY ID DESC;");
  echo "<div class='table-responsive'><table class='table table-striped table-hover custom_datatable'><thead ><tr >";
  echo "<th>ID</th>";
  echo "<th>Applicant Name</th>";
  echo "<th>Position</th>";
  echo "<th>Mobile No</th>";
  echo "<th>Email</th>";
  echo "<th>Company Name</th>";
  echo "<th>Industry Sector</th>";
  echo "<th>City</th>";
  echo "<th>Island</th>";
  echo "<th>Website</th>";
  echo "<th>Phone No</th>";
  echo "<th>Ext</th>";
  echo "<th>Address</th></tr></thead><tbody>";
  foreach($customers as $customer){
    echo "<tr>";
    echo "<td>".$customer->id."</td>";
    echo "<td>".$customer->name."</td>";
    echo "<td>".$customer->position."</td>";
    echo "<td>".$customer->mobile."</td>";
    echo "<td>".$customer->email."</td>";
    echo "<td>".$customer->company."</td>";
    echo "<td>".$customer->industry."</td>";
    echo "<td>".$customer->city."</td>";
    echo "<td>".$customer->island."</td>";
    echo "<td>".$customer->website."</td>";
    echo "<td>".$customer->phone."</td>";
    echo "<td>".$customer->ext."</td>";
    echo "<td>".$customer->address."</td>";
    echo "</tr>";
  }
  echo "</tbody></table></div>";
  ?>
</div>

<link href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script  src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script  src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script  src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>

<script>
$(document).ready( function () {
    $('.custom_datatable').DataTable({
      dom: 'Bfrtip',
      buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
      ]
    });
} );
</script>
<?php
}

function my_admin_menu_conference() {
  add_menu_page('Conference Requests', 'Conference Requests', 'manage_options', 'myplugin/View_Conference_Requests.php', 'conference_view_admin_page', 'dashicons-tag', 7  );
}









