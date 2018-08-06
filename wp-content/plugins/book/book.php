<?php
/*
Plugin Name: custom post book plugin
Description: getting custom post named book
Version: 1
Author: vijay
*/

function my_custom_post_book(){
	$args=array();
	register_post_type('book',$args);
}
add_action('init','my_custom_post_book');















function dbdatawpquery($value='')
{
	# code...
	//function for geting db data
}
add_shortcode('dbdata','dbdatawpquery');