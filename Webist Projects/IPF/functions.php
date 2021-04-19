<?php

function themeslug_theme_customizer( $wp_customize ) {
    
$wp_customize->add_section( 'themeslug_logo_section' , array(
    'title'       => __( 'Logo', 'themeslug' ),
    'priority'    => 30,
    'description' => 'Upload a logo to replace the default site name and description in the header',
) );

$wp_customize->add_setting( 'themeslug_logo' );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themeslug_logo', array(
    'label'    => __( 'Logo', 'themeslug' ),
    'section'  => 'themeslug_logo_section',
    'settings' => 'themeslug_logo',
) ) );



}
add_action( 'customize_register', 'themeslug_theme_customizer' );
require_once 'im/init.php';
require_once 'im/extra.php';



// This theme uses wp_nav_menu() in two locations.
function regiter_menu() {
// This theme uses wp_nav_menu() in two locations.
  register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'ipf' ),
    'footer'  => __( 'Footer Menu', 'ipf' ),
    'footer1'  => __( 'Footer1 Menu', 'ipf' ),
    'footer2'  => __( 'Footer2 Menu', 'ipf' ),
        'footer3'  => __( 'Footer3 Menu', 'ipf' )
  ) );
}


add_action( 'after_setup_theme', 'regiter_menu' );





function twentyfifteen_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Widget Area', 'twentyfifteen' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentyfifteen' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'twentyfifteen_widgets_init' );



// Shortcode
function _ipf_set_member(){
    ob_start();


    if(isset($_POST['submit'])){
        $utitle = $_POST['user-title'];
        $sname = $_POST['sname'];
        $uname = $_POST['user_name'];
        $mname = $_POST['mname'];
        $dob = $_POST['dob'];
        $pob = $_POST['pob'];
        $gender = $_POST['gender'];
        $religion = $_POST['religion'];
        $status = $_POST['user-status'];
        $children = $_POST['children'];
        // $name = $_POST['profile-picture'];
        $caddress = $_POST['caddress'];
        $cpostal = $_POST['cpostal'];
        $ccity = $_POST['ccity'];
        $haddress = $_POST['haddress'];
        $hpostal = $_POST['hpostal'];
        $ccountry = $_POST['ccountry'];
        $mobile = $_POST['mobile'];
        $landline = $_POST['landline'];
        $education = $_POST['education'];
        $skills = $_POST['skills'];
        $kconnect = $_POST['kconnect'];
        $relationship = $_POST['relationship'];
        $user_email= $_POST['email'];
    
        if(isset($_POST['settled'])){
            $settled="YES";
        }else{
            $settled='NO';
        }
        if(isset($_POST['seeker'])){
            $seeker="YES";
        }else{
            $seeker='NO';
        }
        if(isset($_POST['student'])){
            $student="YES";
        }else{
            $student='NO';
        }
        if(isset($_POST['british'])){
            $british="YES";
        }else{
            $british='NO';
        }
        if(isset($_POST['visitor'])){
            $visitor="YES";
        }else{
            $visitor='NO';
        }
        if(isset($_POST['illegal'])){
            $illegal="YES";
        }else{
            $settled='NO';
        }
        if(isset($_POST['stayer'])){
            $stayer="YES";
        }else{
            $stayer='NO';
        }
        if(isset($_POST['employee'])){
            $employee="YES";
        }else{
            $employee='NO';
        }
    

        $reference = $_POST['reference'];
        $explain = $_POST['explain'];
        $legal = $_POST['legal'];
		
// 		$image = $_FILES['profile-picture'];
// 		wp_handle_upload( $image );
		
		if($_FILES['profile-picture']['name'] != ''){
			$uploadedfile = $_FILES['profile-picture'];
			$upload_overrides = array( 'test_form' => false );

			$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
			$imageurl = "";
			if ( $movefile && ! isset( $movefile['error'] ) ) {
			   $imageurl = $movefile['url'];
// 			   echo "url : ".$imageurl;
			} else {
// 			   echo $movefile['error'];
			}
		  }

        // echo '<script type="text/javascript">alert("'.$user_email.'");</script>';
        // echo '<script type="text/javascript">alert("'.$site_name.'");</script>';
        // echo '<script type="text/javascript">alert("'.$mailadmin.'");</script>';

// 		$_POST['profile-picture'];
// 		$image = $_FILES['profile-picture']['name'];
//     	$fileext = pathinfo($image, PATHINFO_EXTENSION);
		
// 		if (!($fileext == 'jpg' || $fileext == 'jpeg' || $fileext == 'png' || $fileext == 'PNG')) {
// 			echo '<script type="text/javascript">alert("Incorrect file format'.$user_email.'");</script>';
// 		} 
// 		else {
// 			move_uploaded_file($_FILES['profile-picture']['tmp_name'],'user_profile_imgs/'.$image);
// 		}
        
        
		$site_name =  get_bloginfo('name');
        $mailadmin = get_bloginfo('admin_email');
        $subject = $site_name.' New Membership Request';

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";     
        $headers .= 'From:'.$site_name.'<'.$mailadmin.'>' . "\r\n";

        $message = '<html>';
        $message .= '<head>
                                <style>
                                .bg_color{background-color: #E9EAEC;padding: 50px 0px 50px 0px;}
                                .sec_bg{padding: 50px;background-color: white;width: 600px;margin: auto;border: 1px solid #bab7b7;}
                                .h21{font-weight: 700;}
                                hr{margin: 20px 0px 20px 0px !important;}
                                .l_color{color: #bbbbbb;text-align: center;margin-top: 20px;font-size: 13px;}
                                </style>
                            </head>';
        $message .= '<body>';
		
        $message .= '<div class="bg_color">
                                <div class="sec_bg">
                                    <p class="h21">Profile Pic</p><img src="'.$imageurl.'" alt="Girl in a jacket" width="100" height="100"><hr>
                                    <p class="h21">Full Name</p><p class="abc">'.$utitle.".".$sname." ".$uname." ".$mname.'</p><hr>
                                    <p class="h21">Date of Birth</p><p class="abc">'.$dob.'</p><hr>
                                    <p class="h21">Place of Birth</p><p class="abc">'.$pob.'</p><hr>
                                    <p class="h21">Gender</p><p class="abc">'.$gender.'</p><hr>
                                    <p class="h21">Religion</p><p class="abc">'.$religion.'</p><hr>
                                    <p class="h21">Marital Status</p><p class="abc">'.$status.'</p><hr>
                                    <p class="h21">How many childrens?</p><p class="abc">'.$children.'</p><hr>
                                    <p class="h21">Current Address</p><p class="abc">'.$caddress.'</p><hr>
                                    <p class="h21">Current Postal Code</p><p class="abc">'.$cpostal.'</p><hr>
                                    <p class="h21">Current City</p><p class="abc">'.$ccity.'</p><hr>
                                    <p class="h21">Home Country Address</p><p class="abc">'.$haddress.'</p><hr>
                                    <p class="h21">Home Country Postal Code</p><p class="abc">'.$hpostal.'</p><hr>
                                    <p class="h21">Current Country</p><p class="abc">'.$ccountry.'</p><hr>
                                    <p class="h21">Mobile No</p><p class="abc">'.$mobile.'</p><hr>
                                    <p class="h21">Landline No</p><p class="abc">'.$landline.'</p><hr>
                                    <p class="h21">Education</p><p class="abc">'.$education.'</p><hr>
                                    <p class="h21">Skills</p><p class="abc">'.$skills.'</p><hr>
                                    <p class="h21">Next of Kin Contact No</p><p class="abc">'.$kconnect.'</p><hr>
                                    <p class="h21">Relationship</p><p class="abc">'.$relationship.'</p><hr>
                                    <p class="h21">Are you Settled?</p><p class="abc">'.$settled.'</p><hr>
                                    <p class="h21">Are you asylum seeker?</p><p class="abc">'.$seeker.'</p><hr>
                                    <p class="h21">Are you student?</p><p class="abc">'.$student.'</p><hr>
                                    <p class="h21">Are you British?</p><p class="abc">'.$british.'</p><hr>
                                    <p class="h21">Are you visitor?</p><p class="abc">'.$visitor.'</p><hr>
                                    <p class="h21">Are you illegal?</p><p class="abc">'.$illegal.'</p><hr>
                                    <p class="h21">Are you over stayer?</p><p class="abc">'.$stayer.'</p><hr>
                                    <p class="h21">Are you employee?</p><p class="abc">'.$employee.'</p><hr>
                                    <p class="h21">Home office reference no</p><p class="abc">'.$reference.'</p><hr>
                                    <p class="h21">Explanation message</p><p class="abc">'.$explain.'</p><hr>
                                    <p class="h21">Legal Help message</p><p class="abc">'.$legal.'</p><hr>
                                </div>
                                <p class="l_color">Sent from <a href="http://www.ipfworldwide.org/" class="l_color">ipf</a></p>
                            </div>';

        wp_mail( $user_email, $subject, $message, $headers );
        wp_mail( $mailadmin, $subject, $message, $headers );
    }
    




?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <style>
        /* #paypal-button-container{
            z-index: 3;
            height: 44px !important;
            width: 200px !important;
            max-width: 200px !important;
            min-width: 200px !important;
            opacity: 0;
            position: absolute;
            left: calc(50% - 62px);
            bottom: -58px;
        } */
        
        .xcomponent-outlet{
            width: 100% !important;
            height: 44px !important;
        }
        /* .paypal-button{
            height: 44px !important;
            width: 200px !important;
            max-width: 200px !important;
            min-width: 200px !important;
            border-radius: 15px;
        } */
        .submit-button{
            left: 0;
            position: absolute;
            z-index: 2;
            max-width: 200px !important;
            min-width: 200px !important;
        }
        /* #paypal-button-container.error{
            z-index: 1;
        } */
    </style>

    <script>




        // $('document').ready(function(){
        //     $( "#datepicker1, #datepicker2" ).datepicker();
        //     $('.required').each(function(){
        //         if($(this).val() == ''){
        //             $('#paypal-button-container').addClass('error');
        //         } else {
        //             $('#paypal-button-container').removeClass('error');
        //         }
        //     });
        //     $('.required').on('keyup', function(){
        //         $('.required').each(function(){
        //             if($(this).val() == ''){
        //                 $('#paypal-button-container').addClass('error');
        //             } else {
        //                 $('#paypal-button-container').removeClass('error');
        //             }
        //         });
        //     });
        //     $('.submit-button').on('click', function(e){
        //         //e.preventDefault();
        //         $('.required').each(function(){
        //             if($(this).val() == ''){
        //                 $('#paypal-button-container').addClass('error');
        //             } else {
        //                 $('#paypal-button-container').removeClass('error');
        //             }
        //         });
        //     });
        // });


        // paypal.Button.render({
        //     env: 'production', // sandbox | production
        //     // PayPal Client IDs - replace with your own
        //     // Create a PayPal app: https://developer.paypal.com/developer/applications/create
        //     client: {
        //         sandbox:    '',
        //         production: 'AYUzoGoNvZ4QvFJ4GFdsA-81gx0rZTTNif24F5ieFemwrBkPcjqMD438T24_KrvMDAvnjZ1axfw6emEp'
        //     },
        //     // Show the buyer a 'Pay Now' button in the checkout flow
        //     commit: true,
        //     // payment() is called when the button is clicked
        //     payment: function(data, actions) {   
        //         // Ajax membership creation
        //         if($('.settled').is(':checked')){
        //             var settled = 'Yes';
        //         } else {
        //             var settled = 'No';
        //         }
        //         if($('.seeker').is(':checked')){
        //             var seeker = 'Yes';
        //         } else {
        //             var seeker = 'No';
        //         }
        //         if($('.student').is(':checked')){
        //             var student = 'Yes';
        //         } else {
        //             var student = 'No';
        //         }
        //         if($('.british').is(':checked')){
        //             var british = 'Yes';
        //         } else {
        //             var british = 'No';
        //         }
        //         if($('.visitor').is(':checked')){
        //             var visitor = 'Yes';
        //         } else {
        //             var visitor = 'No';
        //         }
        //         if($('.illegal').is(':checked')){
        //             var illegal = 'Yes';
        //         } else {
        //             var illegal = 'No';
        //         }
        //         if($('.stayer').is(':checked')){
        //             var stayer = 'Yes';
        //         } else {
        //             var stayer = 'No';
        //         }
        //         if($('.employee').is(':checked')){
        //             var employee = 'Yes';
        //         } else {
        //             var employee = 'No';
        //         }
        //         var fd = new FormData();
        //         var files = document.getElementById("file").files[0];
        //         fd.append('file',files);
        //         fd.append('action','im_set_member');
        //         fd.append('security','model_nonce');
        //         fd.append('user_title', $('.user-title').val());
        //         fd.append('sname', $('.sname').val());
        //         fd.append('name', $('.name').val());
        //         fd.append('mname', $('.mname').val());
        //         fd.append('dob', $('.dob').val()); 
        //         fd.append('pob', $('.pob').val()); 
        //         fd.append('gender', $('.gender').val()); 
        //         fd.append('religion', $('.religion').val()); 
        //         fd.append('status', $('.user-status').val());  
        //         fd.append('children', $('.children').val()); 
        //         fd.append('caddress', $('.caddress').val()); 
        //         fd.append('cpostal', $('.cpostal').val()); 
        //         fd.append('haddress', $('.haddress').val()); 
        //         fd.append('hpostal', $('.hpostal').val());  
        //         fd.append('ccountry', $('.ccountry').val()); 
        //         fd.append('mobile', $('.mobile').val()); 
        //         fd.append('landline', $('.landline').val()); 
        //         fd.append('education', $('.education').val());
        //         fd.append('skills', $('.skills').val());
        //         fd.append('kconnect', $('.kconnect').val());
        //         fd.append('relationship', $('.relationship').val()); 
        //         fd.append('email', $('.email').val()); 
        //         fd.append('nationality', $('.nationality').val());
        //         fd.append('settled', settled);
        //         fd.append('seeker', seeker);
        //         fd.append('student', student);
        //         fd.append('british', british);
        //         fd.append('visitor', visitor);
        //         fd.append('illegal', illegal);
        //         fd.append('stayer', stayer); 
        //         fd.append('employee', employee); 
        //         fd.append('reference', $('.reference').val()); 
        //         fd.append('explain', $('.explain').val()); 
        //         fd.append('legal', $('.legal').val());

        //         $.ajax({
        //             type: "POST",
        //             url: "<?php //echo admin_url('admin-ajax.php'); ?>",
        //             data: fd,
        //             contentType: false,
        //             processData: false,
        //             success:function(data){ 
        //                 $('.membership-form').attr('data-member-id', data);
        //                 $('.hide-first-alert').addClass('show-first-alert');                        
        //             }
        //         });    

        //         // Make a call to the REST api to create the payment
        //         return actions.payment.create({
        //             payment: {
        //                 transactions: [
        //                     {
        //                         amount: { total: '25.00', currency: 'GBP' }
        //                     }
        //                 ]
        //             }
        //         });
        //     },

        //     // onAuthorize() is called when the buyer approves the payment
        //     onAuthorize: function(data, actions) {

        //         // Make a call to the REST api to execute the payment
        //         return actions.payment.execute().then(function() {
        //             var post_id = $('.membership-form').data('member-id');
        //             // Ajax membership creation
        //             $.ajax({
        //                 type: "POST",
        //                 url: "<?php //echo admin_url('admin-ajax.php'); ?>",
        //                 data: { 
        //                     post_id: post_id,
        //                     payment_id: data.paymentID,
        //                     action: 'im_update_member',
        //                     security: 'model_nonce',
        //                 },
        //                 success:function(result){ 
        //                     //alert(JSON.stringify(data));
        //                     $('.hide-second-alert').addClass('show-second-alert');     
        //                 }
        //             });
        //         });
        //     }
        // }, '#paypal-button-container');
    </script>





<!-- CONTACT FORM START -->
<div class="bottom_contact" data-animation="load" data-show-screen="0.8" data-speed="1" style="transition: 1s;">
      <div class="container">
        <div class="row">
          <div class="com-xs-12 text-center">
            <h3>MEMBERSHIP FORM</h3>
          </div>
        </div>
      </div>
      <div class="container">
          <div class="row">
            
            <div class="hide-first-alert alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                We are grateful to you for understanding and showing interest for a good cause, we received all your details  and sharing below for your kind perusal, you submitted, on our website. IPF is greatly thankful that you give hand for the betterment of immigrants, we will soon come back to you for further details, keep visiting our websites for updates.
            </div>

            
            <div class="hide-second-alert alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                IPF received the amount of £ 25, you submitted for the membership. We appreciate and thank you from the deepest core of heart that you visit our website, submit the membership form with the amount of £ 25. IPF welcome you to  become a proud member of an organization working for immigrants welfare. Surely, We together work for a better future.
            </div>    

          </div>
      </div>
        <div class="home-form container">
            <div class="row">
                    
                <!-- <div role="form" class="wpcf7 membership-form" data-member-id="" id="wpcf7-f62-o1" lang="en-US" dir="ltr"> -->
                    <form class="ipl-form" action="" method="post" enctype="multipart/form-data">
                        <div class="col-xs-12 col-sm-3 left-box title-holder">
                            <select class="user-title" name="user-title">
                                <option value="Mr">Mr</option>
                                <option value="Mrs">Mrs</option>
                                <option value="Miss">Miss</option>
                                <option value="Ms">MS</option>
                                <option value="Other">Other</option>
                            </select>
                            <input required class="sname required" type="text" name="sname" placeholder="Surname">
                        </div>
                        <div class="col-xs-12 col-sm-3 middel-box">
                            <input required class="name required" type="text" name="user_name" placeholder="Name">
                        </div>
                        <div class="col-xs-12 col-sm-3 middel-box">
                            <input required class="mname required" type="text" name="mname" placeholder="Middle Name">
                        </div>
                        <div class="col-xs-12 col-sm-3 right-box">
                            <input required id="datepicker1" type="text" class="dob required" name="dob" placeholder="D.O.B">
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-xs-12 col-sm-3 left-box">
                            <input  required type="text" name="pob" class="pob required" placeholder="Place of Birth">
                        </div>
                        <div class="col-xs-12 col-sm-3 middel-box">
                            <select required class="gender required" name="gender">
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-3 middel-box">
                            <input required type="text" class="religion required" name="religion" placeholder="Religion">
                        </div>
                        <div class="col-xs-12 col-sm-3 right-box">
                            <select required class="user-status required" name="user-status">
                                <option value="" >Select Status</option>
                                <option value="single" >Single</option>
                                <option value="married">Married</option>
                                <option value="divorced">Divorced</option>
                                <option value="separated">Separated</option>
                                <option vlaue="widow">Widow</option>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-xs-12 col-sm-3 left-box">
                            <input required type="text" class="children required" name="children" placeholder="How many children?">
                        </div>
                        <div class="col-xs-12 col-sm-3 middel-box label-holder">
                            <input type="file" id="file" class="profile-picture" name="profile-picture" />
                        </div>
                        <div class="clearfix"></div>
                        <h4>Address Information</h4>
                        <div class="clearfix"></div>
                        <div class="col-xs-12 col-sm-4 left-box">
                            <input required type="text" class="caddress required" name="caddress" placeholder="Current Address">
                        </div>
                        <div class="col-xs-12 col-sm-4 middel-box">
                            <input required type="text" class="cpostal required" name="cpostal" placeholder="Current Postal Code">
                        </div>
                        <div class="col-xs-12 col-sm-4 right-box">
                            <input required type="text" class="ccity required" name="ccity" placeholder="Current City">
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-xs-12 col-sm-4 left-box">
                            <input required type="text" class="haddress required" name="haddress" placeholder="Home Country Address">
                        </div>
                        <div class="col-xs-12 col-sm-4 middel-box">
                            <input required type="text" class="hpostal required" name="hpostal" placeholder="Home Country Postal Code">
                        </div>
                        <div class="col-xs-12 col-sm-4 right-box">
                            <input required type="text" class="ccountry required" name="ccountry" placeholder="Current Country">
                        </div>
                        <div class="clearfix"></div>
                        <h4>Personal Information</h4>
                        <div class="clearfix"></div>
                        <div class="col-xs-12 col-sm-3 left-box">
                            <input required type="tel" class="mobile required" name="mobile" placeholder="Mobile No.">
                        </div>
                        <div class="col-xs-12 col-sm-3 middel-box">
                            <input required type="tel" class="landline required" name="landline" placeholder="Landline No.">
                        </div>
                        <div class="col-xs-12 col-sm-3 middel-box">
                            <input required type="text" class="education required" name="education" placeholder="Education">
                        </div>
                        <div class="col-xs-12 col-sm-3 right-box">
                            <input required type="text" class="skills required" name="skills" placeholder="Skills">
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-xs-12 col-sm-3 left-box">
                            <input required type="text" class="kconnect required" name="kconnect" placeholder="Next of Kin Contact No.">
                        </div>
                        <div class="col-xs-12 col-sm-3 middel-box">
                            <input required type="text" class="relationship required" name="relationship" placeholder="Relationship">
                        </div>
                        <div class="col-xs-12 col-sm-3 middel-box">
                            <input required class="email required" type="email" name="email" placeholder="Email">
                        </div>
                        <div class="col-xs-12 col-sm-3 right-box">
                         
                        </div>
                        <div class="clearfix"></div>
                        <h4>Questionnaire</h4>
                        <div class="clearfix"></div>
                        <div class="col-xs-12 col-sm-3 left-box question-holder">
                            <label>Are you settled?</label>
                            <div class="check-box">
                                <input type="checkbox" value="yes" class="settled" name="settled" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-3 middel-box question-holder">
                            <label>Are you asylum seeker?</label>
                            <div class="check-box">
                                <input type="checkbox" value="yes" class="seeker" name="seeker" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-3 middel-box question-holder">
                            <label>Are you student?</label>
                            <div class="check-box">
                                <input type="checkbox" value="yes" class="student" name="student" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-3 right-box question-holder">
                            <label>Are you British?</label>
                            <div class="check-box">
                                <input type="checkbox" value="yes" class="british" name="british" />
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-xs-12 col-sm-3 left-box question-holder">
                            <label>Are you visitor?</label>
                            <div class="check-box">
                                <input type="checkbox" value="yes" class="visitor" name="visitor" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-3 middel-box question-holder">
                            <label>Are you illegal?</label>
                            <div class="check-box">
                                <input type="checkbox" value="yes" class="illegal" name="illegal" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-3 middel-box question-holder">
                            <label>Are you over stayer?</label>
                            <div class="check-box">
                                <input type="checkbox" value="yes" class="stayer" name="stayer" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-3 right-box question-holder">
                            <label>Are you employee?</label>
                            <div class="check-box">
                                <input type="checkbox" value="yes" class="employee" name="employee" />
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-xs-12 col-sm-4 left-box question-holder">
                            <input type="text" class="reference" name="reference" placeholder="Give your home office reference no if any" />
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-xs-12 col-sm-6 left-box question-holder">
                            <textarea type="text" class="explain" name="explain" placeholder="Please Explain with detail"></textarea>
                        </div>
                        <div class="col-xs-12 col-sm-6 right-box question-holder">
                            <textarea type="text" class="legal" name="legal" placeholder="If you need legal help form us"></textarea>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-xs-12 text-center">
                        <input type="submit" name="submit" value="SUBMIT" class="btn btn-danger" style="border-radius: 33px; padding: 18px 0px 36px 0px !important;">
                            <!-- <button class="submit-button">SUBMIT</button>
                            <div id="paypal-button-container"></div> -->
                        </div>
                    </form>
                <!-- </div>           -->
            </div>
        </div>
    </div>
    <!-- CONTACT FORM END -->

<?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

add_shortcode( 'IPFMEMBERSHIP', '_ipf_set_member' );

