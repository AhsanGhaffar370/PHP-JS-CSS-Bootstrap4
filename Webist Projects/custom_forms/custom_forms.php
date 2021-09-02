<?php
/**
 * Plugin Name: custom form
 * Plugin Uri: https://ahsan.com
 * Author: Ahsan Rao
 * Author Uri: https://ahsan.com
 * Version: 1.0.0
 * Description: In this plugin we create a simple custom booking form with mail notification
 * Tags: ahsan, customform
 * Lisence: GPL V2
 */

//  how wordpress project executes
// 1st: index.php 2nd: wp-blog-header.php 3rd: wp-load.php & template-loader.php 4th 

defined('ABSPATH') || die("You Can't access this file directly");
// OR
// if(!defined('ABSPATH')):
//     die("You Can't access this file directly");
// endif;
// echo "Hello World";

// __FILE__ return complete path of this file 
register_activation_hook(__FILE__,"custom_forms_register_activation_hook"); //this function executes, when we click on activate plugin button
register_deactivation_hook(__FILE__,"custom_forms_register_deactivation_hook");//this function executes, when we click on deactivate plugin button

// normally, we don't use register_uninstall_hook function, wordpress provides a better way to perform this function by creating a 
// uninstall.php file which will execute automatically when we click on delete plugin button.
// register_uninstall_hook(__FILE__,"custom_forms_register_uninstall_hook");//this function executes, when we click on deactivate plugin button



function custom_forms_register_activation_hook(){
    add_option('blogname',"Title Updated"); //it assign title updated value to updateTitle variable 
}

function custom_forms_register_deactivation_hook(){
    delete_option('blogname');
    add_option('blogname',"Simple Beauty Lashes");
}

// function custom_forms_register_uninstall_hook(){
//     defined('ABSPATH') || die("Nice Try");
//     delete_option('updateTitle');
// }
