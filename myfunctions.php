
function im_parcel_form(){
	// if(is_user_logged_in()){
	// $current_user_id = get_current_user_id();
	?>
	<section class="parcel-folrm-holder">
		<?php 
			if(isset($_POST['send_quote'])){
				//print_r($_POST); //ahsan comment it
				$full_name = sanitize_text_field($_POST['sender_name']);
				$email_address = sanitize_text_field($_POST['sender_email']);
				$contact = sanitize_text_field($_POST['sender_contact']);
				$mobile = sanitize_text_field($_POST['sender_mobile']);
				$receiver_name = sanitize_text_field($_POST['receiver_name']);
				$receiver_email = sanitize_text_field($_POST['receiver_email']);
				$receiver_contact = sanitize_text_field($_POST['receiver_contact']);
				$receiver_mobile = sanitize_text_field($_POST['receiver_mobile']);
				$receiver_country = sanitize_text_field($_POST['to']);
				$receiver_city = sanitize_text_field($_POST['receiver_city']);
				$receiver_address = sanitize_text_field($_POST['receiver_address']);
				$type = sanitize_text_field($_POST['type']);
				if($type == 'air'){
					$type_str = 'Air Cargo';
				}
				if($type == 'sea'){
					$type_str = 'Sea Cargo';
				} 
				$from = sanitize_text_field($_POST['from']);
				$from_postcode = sanitize_text_field($_POST['from_postcode']);
				$to = sanitize_text_field($_POST['to']);
				$city = sanitize_text_field($_POST['city']);
				$address = sanitize_text_field($_POST['sender_address']);
				$courier_service = sanitize_text_field($_POST['courier_service']);
				if($courier_service == 'collected'){
					$courier_service_str = 'The parcel will be collected by Courier Company from Sender Address';
				} else {
					$courier_service_str = 'The parcel will be delivered to Courier Company Office';
				}
				$weight = $_POST['weight'];
				$width = $_POST['width'];
				$height = $_POST['height'];
				$lenght = $_POST['lenght'];
				$fee = 0;
				$total_fee=0;
				$order_data_row=""; //ahsan add it
				if($type == 'sea' && $to == 'india' || empty($weight)){
					echo '<p>Unable to proceed. Please try again.</p>';
				} else{
					if(!empty($weight)){
						$count = 0;
						$total_boxes = 0;
						foreach($weight as $wght){
							if($type == 'air' && $to == 'india'){
								$fee = '6.50';
							} else if($type == 'air' && $to == 'pakistan'){
								$fee = '5.00';
							} else if($type == 'sea' && $to == 'pakistan'){
								$fee = '1.50';
							}
							$fee = $fee*$wght;
							$total_fee+=$fee;
							$box = ceil($wght / 20);
							$total_boxes = $total_boxes + $box;
							if($box == 1){
								$box_str = 'Box';
							} else {
								$box_str = 'Boxes';
							}
							$order_data_row .= '<tr><td>'.$wght.'kg</td><td>'.$lenght[$count].'cm</td><td>'.$width[$count].'cm</td><td>'.$height[$count].'cm</td><td>Use '.$box.' x 20 kg '.$box_str.'</td><td>&pound;'.$fee.'</td></tr>';
						$count++;
						}
	
						$order_table_header = '<table class="table" width="700">';
						$order_row_heading = '<tr><th style="text-align: left;">Weight</th><th style="text-align: left;">Length</th><th style="text-align: left;">Width</th><th style="text-align: left;">Height</th><th style="text-align: left;">Box(es)</th><th style="text-align: left;">Cost</th></tr>';
						$order_table_footer = '</table>';
						// $total_fee_str='<h2 class="text-right text-white p-2" style="color: white !important; padding-right: 15px;">Total Amount: &pound;'.$total_fee.' </h2>';

						$order_data_row .='<tr><td></td><td></td><td></td><td></td><td><b>Total Amount: </b></td><td><b>&pound;'.$total_fee.'</b></td></tr>';
						$order_table = $order_table_header.$order_row_heading.$order_data_row.$order_table_footer;
						
						$user_table_header = '<table class="table" width="700">';
						$user_row_heading = '<tr><th>Name</th><th>Contact</th><th>Email</th></tr>';
						$user_data_row = '<tr><td>'.$full_name.'</td><td>'.$contact.'</td><td>'.$email_address.'</td></tr>';
						$user_table_footer = '</table>';
						$user_table = $user_table_header.$user_row_heading.$user_data_row.$user_table_footer;
	
						$content = '<div class="table-responsive">'.$user_table.$order_table.'</table>';
						$wp_error=""; //ahsan add it
	
						//email part ahsan
						$my_post = array(
							'post_title'    => '',
							'post_content'    => $content,
							'post_status'   => 'publish',
							'post_type' => 'im_orders',
	//                         'author' => $current_user_id, //ahsan comment
						);
						$post_id = wp_insert_post( $my_post, $wp_error );
						$booking_id = 'AT-'.$post_id;
						add_post_meta($post_id, 'im_booking_id', $booking_id, true);
						add_post_meta($post_id, 'im_customer', $full_name, true);
						add_post_meta($post_id, 'im_email', $email_address, true);
						add_post_meta($post_id, 'im_contact', $contact, true);
						add_post_meta($post_id, 'im_mobile', $mobile, true);
						add_post_meta($post_id, 'im_receiver_name', $receiver_name, true);
						add_post_meta($post_id, 'im_receiver_email', $receiver_email, true);
						add_post_meta($post_id, 'im_receiver_country', $to, true);
						add_post_meta($post_id, 'im_receiver_city', $receiver_city, true);
						add_post_meta($post_id, 'im_receiver_contact', $receiver_contact, true);
						add_post_meta($post_id, 'im_receiver_mobile', $receiver_mobile, true);
						add_post_meta($post_id, 'im_receiver_address', $receiver_address, true);
						add_post_meta($post_id, 'im_type', $type, true);
						add_post_meta($post_id, 'im_from', $from, true);
						add_post_meta($post_id, 'im_from_postcode', $from_postcode, true);
						add_post_meta($post_id, 'im_to', $to, true);
						add_post_meta($post_id, 'im_city', $city, true);
						add_post_meta($post_id, 'im_address', $address, true);
						add_post_meta($post_id, 'im_weight', $weight, true);
						add_post_meta($post_id, 'im_lenght', $lenght, true);
						add_post_meta($post_id, 'im_width', $width, true);
						add_post_meta($post_id, 'im_height', $height, true);
						add_post_meta($post_id, 'im_fee', $fee, true);
						add_post_meta($post_id, 'im_box', $total_boxes, true);
						add_post_meta($post_id, 'im_courier_service', $courier_service, true);
	
						// Update post title
						$update_booking = get_post($post_id);
						$update_booking->post_title = $booking_id;
						wp_update_post( $update_booking );
	
						$site_name =  get_bloginfo('name');
						$primary_color = '#5B9144';
						$mailadmin = get_bloginfo('admin_email');
						$subject = get_bloginfo('name').' New Order Booking';
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";     
						$headers .= 'From: '.$site_name.' <noreply@domain.com>' . "\r\n";
						
						$message = '<html>';
						$message .= '<body bgcolor="#FFFFFF" marginwidth="10" marginheight="10" topmargin="10" leftmargin="10">';
						$message .= '<table cellpadding="10" cellspacing="10" border="0" width="700">';
	
						$message .= '<tr><td bgcolor="'.$primary_color.'" colspan="2" align="center"><font face="arial" size="7" color="#FFFFFF">'.$site_name.'</td></tr>';
						$message .= '<tr><td bgcolor="#eeeeee" colspan="2" align="center"><font face="arial" size="5" color="#000000">SENDER DETAILS</td></tr>';
						$message .= '<tr><td bgcolor="'.$primary_color.'" width="200"><font face="arial" size="2" color="#FFFFFF">Full Name: </font></td><td bgcolor="#CCCCCC" width="400"><font face="arial" size="2" color="#000000">'.$full_name.'</td></tr>';
						$message .= '<tr><td bgcolor="'.$primary_color.'" width="200"><font face="arial" size="2" color="#FFFFFF">Email Address: </font></td><td bgcolor="#CCCCCC" width="400"><font face="arial" size="2" color="#000000">'.$email_address.'</td></tr>';
						$message .= '<tr><td bgcolor="'.$primary_color.'" width="200"><font face="arial" size="2" color="#FFFFFF">Contact: </font></td><td bgcolor="#CCCCCC" width="400"><font face="arial" size="2" color="#000000">'.$contact.'</td></tr>';
						$message .= '<tr><td bgcolor="'.$primary_color.'" width="200"><font face="arial" size="2" color="#FFFFFF">Mobile: </font></td><td bgcolor="#CCCCCC" width="400"><font face="arial" size="2" color="#000000">'.$mobile.'</td></tr>';
						$message .= '<tr><td bgcolor="'.$primary_color.'" width="200"><font face="arial" size="2" color="#FFFFFF">Country: </font></td><td bgcolor="#CCCCCC" width="400"><font face="arial" size="2" color="#000000">'.$from.'</td></tr>';
						$message .= '<tr><td bgcolor="'.$primary_color.'" width="200"><font face="arial" size="2" color="#FFFFFF">Postcode: </font></td><td bgcolor="#CCCCCC" width="400"><font face="arial" size="2" color="#000000">'.$from_postcode.'</td></tr>';
						$message .= '<tr><td bgcolor="'.$primary_color.'" width="200"><font face="arial" size="2" color="#FFFFFF">Address: </font></td><td bgcolor="#CCCCCC" width="400"><font face="arial" size="2" color="#000000">'.$address.'</td></tr>';
						$message .= '<tr><td bgcolor="#eeeeee" colspan="6" align="center"><font face="arial" size="5" color="#000000">RECEIVER DETAILS</td></tr>';
						$message .= '<tr><td bgcolor="'.$primary_color.'" width="200"><font face="arial" size="2" color="#FFFFFF">Full Name: </font></td><td bgcolor="#CCCCCC" width="400"><font face="arial" size="2" color="#000000">'.$receiver_name.'</td></tr>';
						$message .= '<tr><td bgcolor="'.$primary_color.'" width="200"><font face="arial" size="2" color="#FFFFFF">Email Address: </font></td><td bgcolor="#CCCCCC" width="400"><font face="arial" size="2" color="#000000">'.$receiver_email.'</td></tr>';
						$message .= '<tr><td bgcolor="'.$primary_color.'" width="200"><font face="arial" size="2" color="#FFFFFF">Contact: </font></td><td bgcolor="#CCCCCC" width="400"><font face="arial" size="2" color="#000000">'.$receiver_contact.'</td></tr>';
						$message .= '<tr><td bgcolor="'.$primary_color.'" width="200"><font face="arial" size="2" color="#FFFFFF">Mobile: </font></td><td bgcolor="#CCCCCC" width="400"><font face="arial" size="2" color="#000000">'.$receiver_mobile.'</td></tr>';
						$message .= '<tr><td bgcolor="'.$primary_color.'" width="200"><font face="arial" size="2" color="#FFFFFF">Country: </font></td><td bgcolor="#CCCCCC" width="400"><font face="arial" size="2" color="#000000">'.$to.'</td></tr>';
						$message .= '<tr><td bgcolor="'.$primary_color.'" width="200"><font face="arial" size="2" color="#FFFFFF">City: </font></td><td bgcolor="#CCCCCC" width="400"><font face="arial" size="2" color="#000000">'.$receiver_city.'</td></tr>';
						$message .= '<tr><td bgcolor="'.$primary_color.'" width="200"><font face="arial" size="2" color="#FFFFFF">Address: </font></td><td bgcolor="#CCCCCC" width="400"><font face="arial" size="2" color="#000000">'.$receiver_address.'</td></tr>';
						$message .= '</table>';
						$message .= '<table cellpadding="10" cellspacing="10" border="0" width="700">';
						$message .= '<tr><td bgcolor="#eeeeee" colspan="6" align="center"><font face="arial" size="4" color="#000000">Order Details</td></tr>';
						$message .= $order_row_heading;
						$message .= $order_data_row;
						$message .= '</table>';
						$message .= '<table cellpadding="10" cellspacing="10" border="0" width="700">';
						$message .= '<tr><td><font face="arial" size="2" color="#000000">Type: </font></td><td width="400"><font face="arial" size="2" color="#000000">'.$type_str.'</td></tr>';
						$message .= '<tr><td><font face="arial" size="2" color="#000000">Courier Service: </font></td><td width="400"><font face="arial" size="2" color="#000000">'.$courier_service_str.'</td></tr>';
						$message .= '</table>';
						$message .= '</body>';
						$message .= '</html>';
						
						wp_mail( $mailadmin, $subject, $message, $headers );
						wp_mail( $email_address, $subject, $message, $headers );
						
						// echo submit message ahsan
						echo '<script>alert("Your order has been received and our representative will contact you shortly. The order details has been emailed to provided Sender’s email address. Thank you for visiting our website. Anytime Delivery")</script>';
						// alert("Your message has been sent successfully."); 
						?>
	
		<!-- <div class="alert alert-success alert-dismissible text-center">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Success!</strong> Your message has been sent successfully.
		</div> -->
	
		<?php
					}
				}
			}
			?>
		<form action="" method="post" class="w-100" id="purchase-order-create">
			<div class="mx-auto">
				<div class="col-xs-12">
					<div class="main-row">
						<h2>GET FREE QUOTE</h2>
					</div>
				</div>
	
				<!-- pricing details ahsan -->
				<div id="show_price1" class="hidden123">
					<h3 class="order21">Order Details</h3>
					<div id="show_pricing">
					
					</div>
				</div>
				



				<div id="hide_parcel_desc">
					<div class="col-xs-12">
						<div class="main-row">
							<h3>PARCEL DESCRIPTION</h3>
						</div>
					</div>
					<div class="col-xs-12">
						<div class="border-box">
							<div class="main-row">
								<div>
									<div class="custom-select-main position-relative">
										<div class="row parcel-full-width">
											<div class="col-xs-4 col-sm-4 col-md-4 labeling">
												Parcel Type
											</div>
											<div class="col-xs-4 col-sm-4 col-md-4">
												<div class="radio-holder">
													<input required checked type="radio" name="type" value="air">
													<span>Air Carogo</span>
												</div>
											</div>
											<div class="col-xs-4 col-sm-4 col-md-4">
												<div class="radio-holder">
													<input required type="radio" name="type" value="sea">
													<span>Sea Cargo</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
	
							<div class="table-responsive">
								<div class="table rowfy" id="customFields">
									<div class="tbody">
										<div class="tr-row">
											<div class="p-0"><input required type="number" min="1" name="weight[]"
													id="weight" class="form-control rounded" placeholder="weight"><label
													for="kg">kg</label>
											</div>
											<div class="p-0"><input required type="number" min="1" name="lenght[]"
													id="lenght" class="form-control rounded" placeholder="length"></div>
											<div class="p-0"><input required type="number" min="1" name="width[]"
													id="width" class="form-control rounded" placeholder="width"></div>
											<div class="p-0"><input required type="number" min="1" name="height[]"
													id="height" class="form-control rounded" placeholder="height"><label
													for="kg">cm</label>
											</div>
											<div class="p-0">
												<div class="p-0 rowfy-addrow">+</div>
											</div>
										</div>
									</div>
								</div>
								
								<!-- <div class="text-center finish-btn">
										<a href="#">FINISH</a>
									</div> -->
								<div class="courier-service">
									<div class="radio-holder">
										<input type="radio" checked name="courier_service" value="collected">
										<span>The parcel will be collected by Courier Company from Sender Address</span>
									</div>
									<div class="radio-holder">
										<input type="radio" name="courier_service" value="delivered">
										<span>The parcel will be delivered to Courier Company Office</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="hide-formi">
					<div class="col-xs-12">
						<div class="main-row">
							<h3>PARCEL SENDER INFORMATION</h3>
						</div>
					</div>
					<div class="col-xs-12 mx-auto">
						<div class="main-row">
							<div class="city-input">
								<div class="custom-select-main position-relative">
									<select required name="from" id="from" class="form-control sources"
										placeholder="UK Mainland">
										<option selected value="UK Mainland">UK Mainland</option>
									</select>
								</div>
							</div>
							<div>
								<input required name="from_postcode" type="text"
									class="form-control font rounded w-100 input-height" placeholder="Postcode">
							</div>
						</div>
					</div>
					<div id="hide_sender" style="display:none;">
	
	
						<div class="col-xs-12">
							<div class="main-row table rowfy">
								<div class="city-input">
									<input required type="text" name="sender_address"
										class="form-control font rounded w-100 input-height" placeholder="Address">
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="main-row table rowfy">
								<div class="city-input">
									<input required type="text" name="sender_name"
										class="form-control font rounded w-100 input-height" placeholder="Full Name">
								</div>
								<div class="city-input">
									<input required type="email" name="sender_email"
										class="form-control font rounded w-100 input-height" placeholder="Email Address">
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="main-row table rowfy">
								<div class="city-input">
									<input type="tel" name="sender_contact"
										class="form-control font rounded w-100 input-height" placeholder="Landline Number">
								</div>
								<div class="city-input">
									<input required type="tel" name="sender_mobile"
										class="form-control font rounded w-100 input-height" placeholder="Mobile Number">
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-12">
						<div class="main-row">
							<h3>PARCEL RECEIVER INFORMATION</h3>
						</div>
					</div>
					<div class="col-xs-12">
						<div class="main-row">
							<div class="city-input">
								<div class="custom-select-main position-relative">
									<select required name="to" id="to" class="city-input form-control sources"
										placeholder="Select Country">
										<option value="india">India</option>
										<option value="pakistan">Pakistan</option>
									</select>
								</div>
							</div>
							<div>
								<input required type="text" name="receiver_city"
									class="form-control font rounded w-100 input-height" placeholder="City">
							</div>
						</div>
					</div>
					<div id="hide_receiver" style="display:none;">
	
	
						<div class="col-xs-12">
							<div class="main-row">
								<div>
									<div class="custom-select-main position-relative">
										<input required type="text" name="receiver_address"
											class="form-control font rounded w-100 input-height" placeholder="Address">
									</div>
								</div>
							</div>
						</div>
	
						<div class="col-xs-12">
							<div class="main-row table rowfy">
								<div class="city-input">
									<input required type="text" name="receiver_name"
										class="form-control font rounded w-100 input-height" placeholder="Full Name">
								</div>
								<div class="city-input">
									<input required type="email" name="receiver_email"
										class="form-control font rounded w-100 input-height" placeholder="Email Address">
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="main-row table rowfy">
								<div class="city-input">
									<input type="tel" name="receiver_contact"
										class="form-control font rounded w-100 input-height" placeholder="Landline Number">
								</div>
								<div class="city-input">
									<input required type="tel" name="receiver_mobile"
										class="form-control font rounded w-100 input-height" placeholder="Mobile Number">
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="main-row table rowfy">
								<div class="submit-holder">
									<button type="submit" name="send_quote">Submit</button>
								</div>
							</div>
						</div>
	
					</div>
					<div class="text-center hide_gen_q">
						<br/><br/>
						<button type="button" class="btn btn-success btn-lg fag_btn" id="generate_quote" name="generate_quote">Generate Quote</button>
						<br/><br/>
					</div>
				</div>
			</div>
		</form>
		
<!-- 		<div id="dialog21" title="Basic dialog" style="display:none">
				<p class="text-center">Your order has been received and our representative will contact you shortly. The order details has been emailed to provided Sender’s email address. Thank you for visiting our website. <br/><b>Anytime Delivery</b></p>
		</div> -->
	</section>
	
	
	<?php 
	// } 
	// 	else {
	//         	echo do_shortcode('[xoo_el_inline_form active="login"]');
	//         	} 
	?>
	<?php
	}
	add_shortcode( 'PARCELFORM', 'im_parcel_form' );

    ?>//remove this tag when upload on wordpress