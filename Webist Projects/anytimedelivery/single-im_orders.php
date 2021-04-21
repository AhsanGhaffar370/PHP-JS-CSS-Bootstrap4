<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header('order'); 
if( is_user_logged_in() && is_author(get_current_user_id()) || im_get_current_user_role() == 'administrator') {
while ( have_posts() ) : the_post(); 
$order_id = get_post_meta(get_the_ID(), 'im_booking_id', true);
$customer_name = get_post_meta(get_the_ID(), 'im_customer',  true);
$customer_email = get_post_meta(get_the_ID(), 'im_email', true);
$customer_contact = get_post_meta(get_the_ID(), 'im_contact', true);
$customer_mobile = get_post_meta(get_the_ID(), 'im_mobile', true);
$type = get_post_meta(get_the_ID(), 'im_type', true);
$from = get_post_meta(get_the_ID(), 'im_from', true);
$postcode = get_post_meta(get_the_ID(), 'im_from_postcode', true);
$to = get_post_meta(get_the_ID(), 'im_to', true);
$city = get_post_meta(get_the_ID(), 'im_city', true);
$address = get_post_meta(get_the_ID(), 'im_address', true);
$fee = get_post_meta(get_the_ID(), 'im_fee', true);
$box = get_post_meta(get_the_ID(), 'im_box', true);
if($box == 1){
    $box_str = 'Box';
} else {
    $box_str = 'Boxes';
}
$weight = get_post_meta(get_the_ID(), 'im_weight', true);
$lenght = get_post_meta(get_the_ID(), 'im_lenght', true);
$width = get_post_meta(get_the_ID(), 'im_width', true);
$height = get_post_meta(get_the_ID(), 'im_height', true);
if(!empty($weight)){
    $total_wght = 0;
    foreach($weight as $wght){
        $total_wght = $total_wght + $wght;
    }
}
$receiver_name = get_post_meta(get_the_ID(), 'im_receiver_name', true);
$receiver_email = get_post_meta(get_the_ID(), 'im_receiver_email', true);
$receiver_country = get_post_meta(get_the_ID(), 'im_receiver_country', true);
$receiver_country = ', '.$receiver_country;
$receiver_city = get_post_meta(get_the_ID(), 'im_receiver_city', true);
$receiver_city = ', '.$receiver_city;
$receiver_contact = get_post_meta(get_the_ID(), 'im_receiver_contact', true);
$receiver_mobile = get_post_meta(get_the_ID(), 'im_receiver_mobile', true);
$receiver_address = get_post_meta(get_the_ID(), 'im_receiver_address', true);
?>
<style>
@page {
    size: auto;
    size: A4;
    margin: 0mm;
}
</style>

<header>
        <div class="header-main">
            <table style="width: 100%;">
                <tr>
                    <td class="header-logo">
                        <span>
                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/invoice-logo.png" alt="Logo">
                        </span>
                    </td>
                    <td class="header-detail">
                        <address>
                            <p>Anytime Delivery Ltd(11285449)</p>
                            <p>4 Rowallan Parade, Green Lane</p>
                            <p>Dagenham,England,RB8 1 XU</p>
                            <p>02030929424</p>
                            <p>info@anytimedelivery.uk</p>
                            <p>www.anytimedelivery.uk</p>
                        </address>
                    </td>
                </tr>
            </table>
        </div>
    </header>
    <section class="top-details-main">
        <!-- First Row -->
       <div class="top-details">
           <div class="mdetail-box detail-box">
                <p>
                    <span class="lable-holder">B.O.L/MAWB: </span>
                    <span class="with-line">&nbsp;</span>
                </p>
            </div>
            <div class="mdetail-box detail-box move-right">
                <p>
                    <span class="lable-holder">Order No: </span>
                    <span class="with-line"><?php echo $order_id; ?></span>
                </p>
            </div>
            <div class="mdetail-box detail-box">
                <p>
                    <span class="lable-holder">Date: </span>
                    <span class="with-line"><?php echo get_the_date(); ?></span>
                </p>
            </div>
            <div class="mdetail-box detail-box move-right">
                <p>
                    <span class="lable-holder">HAWB: </span>
                    <span class="with-line">&nbsp;</span>
                </p>
            </div>
       </div>
    </section>
    <div class="clr"></div>
    <!-- Sender Reciver Section -->
    <section class="sender-reciver">
        <div class="migrate-main">
            <!-- Sender -->
            <div class="sender">
                <div class="sender-detail-box">
                    <div class="sender-detail mdetail-box">
                        <h4>Sender</h4>
                    </div>
                    <div class="mdetail-box detail-box">
                        <p>
                            <span class="lable-holder">Name: </span>
                            <span class="with-line"><?php echo $customer_name; ?></span>
                        </p>
                    </div>
                    <div class="mdetail-box detail-box address-detail-box">
                        <p>
                            <span class="lable-holder">Address: </span>
                            <span class="with-line"> <?php echo $address; ?>, <?php echo $postcode; ?>, <?php echo $from; ?></span>
                        </p>
                    </div>
                    <div class="mdetail-box detail-box">
                        <p>
                            <span class="lable-holder">Landline: </span>
                            <span class="with-line"><?php echo $customer_contact; ?></span>
                        </p>
                    </div>
                    <div class="mdetail-box detail-box">
                        <p>
                            <span class="lable-holder">Mobile: </span>
                            <span class="with-line"><?php echo $customer_mobile; ?></span>
                        </p>
                    </div>
                    <div class="mdetail-box detail-box">
                        <p>
                            <span class="lable-holder">Email: </span>
                            <span class="with-line"><?php echo $customer_email; ?></span>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Reciver -->
            <div class="reciver">
                <div class="reciver-detail-box">
                    <div class="reciver-detail mdetail-box">
                        <h4>Receiver</h4>
                    </div>
                    <div class="mdetail-box detail-box">
                        <p>
                            <span class="lable-holder">Name: </span>
                            <span class="with-line"><?php echo $receiver_name; ?></span>
                        </p>
                    </div>
                    <div class="mdetail-box detail-box address-detail-box">
                        <p>
                            <span class="lable-holder">Address: </span>
                            <span class="with-line"><?php echo $receiver_address.$receiver_city.$receiver_country; ?></span>
                        </p>
                    </div>
                    <div class="mdetail-box detail-box">
                        <p>
                            <span class="lable-holder">Landline: </span>
                            <span class="with-line"><?php echo $receiver_contact; ?></span>
                        </p>
                    </div>
                    <div class="mdetail-box detail-box">
                        <p>
                            <span class="lable-holder">Mobile: </span>
                            <span class="with-line"><?php echo $receiver_mobile; ?></span>
                        </p>
                    </div>
                    <div class="mdetail-box detail-box">
                        <p>
                            <span class="lable-holder">Email: </span>
                            <span class="with-line"><?php echo $receiver_email; ?></span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="clr"></div>
        </div>
    </section>
    <!-- AirPort Section -->
    <section class="airport">
        <div class="airport-main" style="padding: 15px 0 !important;">
          <div class="airport-box">
            <p>airport to airport (exc duties): door-to-door(exc duties):</p>
            <input type="text">
          </div>
          <div class="airport-box">
            <p>port to port(exc duties):</p>
            <input type="text">
          </div>
          <div class="packup">
                <h3>number of packs goods picked up <span class="special-input"><?php echo $box.' '.$box_str; ?></span> Weight <span class="special-input"><?php echo $total_wght; ?>KG</span> </h3>
          </div>
        </div>
    </section>
    <!-- Dimension section -->
    <section class="dimension">
        <div class="dimension-main">
            <div class="dimension-inner">
                <div class="dimension-title" style="padding: 7px 0px !important;">
                    <h1>dimensions</h1>
                </div>
                <?php 
                if(!empty($weight)){
                    $count = 0;
                    $fee = 0;
                    foreach($weight as $wght){
                        if($type == 'air' && $to == 'india'){
                            $fee = '6.50';
                        } else if($type == 'air' && $to == 'pakistan'){
                            $fee = '5.00';
                        } else if($type == 'sea' && $to == 'pakistan'){
                            $fee = '1.50';
                        }
                        $fee = $fee*$wght;
                        $box = ceil($wght / 20);
                        if($box == 1){
                            $box_str = 'Box';
                        } else {
                            $box_str = 'Boxes';
                        }
                        echo '<p>Weight: '.$wght.'kg, Height: '.$height[$count].'cm, '.$lenght[$count].': 5cm</p>';
                    $count++;
                    }
                }
                ?>
            </div>
        </div>
        <div class="dimension-main">
            <div class="description-inner">
                <div class="dimension-title" style="padding: 7px 0px !important;">
                    <h1>description</h1>
                </div>
                <?php 
                if(!empty($weight)){
                    $fee = 0;
                    $count = 0;
                    foreach($weight as $wght){
                        if($type == 'air' && $to == 'india'){
                            $fee = '6.50';
                        } else if($type == 'air' && $to == 'pakistan'){
                            $fee = '5.00';
                        } else if($type == 'sea' && $to == 'pakistan'){
                            $fee = '1.50';
                        }
                        $fee = $fee*$wght;
                        $box = ceil($wght / 20);
                        if($box == 1){
                            $box_str = 'Box';
                        } else {
                            $box_str = 'Boxes';
                        }
                        $order_data_row .= '<tr><td>'.$wght.'kg</td><td>'.$lenght[$count].'cm</td><td>'.$width[$count].'cm</td><td>'.$height[$count].'cm</td><td>'.$fee.'&pound;</td><td>Use '.$box.' x 20 kg '.$box_str.'</td></tr>';
                        echo '<p>Cost: &pound;'.number_format($fee, 2).', Use '.$box.' x 20 kg '.$box_str.'</p>';
                    $count++;
                    }
                }
                ?>
            </div>
        </div>
    </section>
    <!-- Terms and condition section -->
    <section class="terms">
        <div class="terms-main">
            <h1>Terms & Condition</h1>
            <p style="font-size: 13px;">
			Please read the terms and conditions before signing the slip.<br>Old parcels will be valued at &pound;30.00<br>New parcel will be valued at &pound;150.00, refund will only be given if proof of purchase is provided.<br>
				The parcel will be notified within 24 hours of receiving parcel otherwise the company will not be responsible fo any loss or damage.
			</p>
        </div>
        <div class="terms-main">
            <h1>Customer's Declaration</h1>
            <p style="font-size: 13px;">
			I/We hereby authorise Anytime Delivery to complete all necessary formalities on our befalf subject to their standard term & conditions. Also undertaken that there is no contraband items (drugs, aerosols, explosives, firearms, radioactive materials, pressurised cylinder etc...) Placked in this consignment.
			</p>
        </div>
    </section>
    <section class="bottom-details-main">
          <!-- Second Row -->
        <div class="bottom-detail">
            <div class="bmain-detail">
                <div class="mdetail-box detail-box">
                    <p>
                        <span class="lable-holder">Signed: </span>
                        <span class="with-line"></span>
                    </p>
                </div>
                <div class="mdetail-box detail-box">
                    <p>
                        <span class="lable-holder">Printed: </span>
                        <span class="with-line"></span>
                    </p>
                </div>
                <div class="mdetail-box detail-box">
                    <p>
                        <span class="lable-holder">Date: </span>
                        <span class="with-line"></span>
                    </p>
                </div>
            </div>
            <div class="bmain-detail move-right">
                <div class="mdetail-box detail-box received">
                    <p>
                        <span class="lable-holder">Recived by Signed: </span>
                        <span class="with-line"></span>
                    </p>
                </div>
                <div class="mdetail-box detail-box">
                    <p>
                        <span class="lable-holder">Printed: </span>
                        <span class="with-line"></span>
                    </p>
                </div>
                <div class="mdetail-box detail-box">
                    <p>
                        <span class="lable-holder">Date: </span>
                        <span class="with-line"></span>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <button class="print-btn print-hide" onclick="window.print()">Print</button>
<?php endwhile; } else { echo 'You have no right to access this page. Click <a style="font-weight: bold; color: #5B9144;" href="'.site_url().'">here</a> to go back.';} get_footer('order'); ?>