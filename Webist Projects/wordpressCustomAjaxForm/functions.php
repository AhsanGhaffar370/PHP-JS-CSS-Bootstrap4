<?php
add_action('wp_ajax_contact_us','ajax_contact_us');
function ajax_contact_us(){
	$arr=[];
	wp_parse_str($_POST['contact_us'],$arr);
	global $wpdb;
	global $table_prefix;
	$table=$table_prefix.'contact_us';
	$result=$wpdb->insert($table,[
		"name"=>$arr['name'],
		"email"=>$arr['email']
	]);
	if($result>0){
		wp_send_json_success("Data inserted");
	}else{
		wp_send_json_error("Please try again");
	}
}
?>