<?php
/*
Plugin Name: Feed Entries Configuraton
Plugin URI: http://fantastech.co
Description: Feed Entries configuration by fantastech Solution.
Version: 1.1.0
Author: Ram Shengale (FantasTech Solutions)
Author URI: http://fantastech.co
License: fsconfig
*/

require_once  ( __DIR__ . '/mailchimp-api-master/src/MailChimp.php');
use \DrewM\MailChimp\MailChimp;

function fs_myconfig_enqueue_script() {   
	
	wp_enqueue_style( 'fs-style', plugins_url('assets/css/style.css', __FILE__));
	wp_enqueue_script( 'fs-script', plugins_url( 'assets/js/script.js' , __FILE__ ), array('jquery') );
}
add_action('wp_enqueue_scripts', 'fs_myconfig_enqueue_script');

// REGISTER CUSTOM POST TYPE
function feed_entries_post_type() {
	$labels = array(
		'name'                  => _x( 'Feed Entries', 'Feed Entries', 'text_domain' ),
		'singular_name'         => _x( 'Feed Entry', 'Feed Entry', 'text_domain' ),
		'menu_name'             => __( 'Feed Entries', 'text_domain' ),
		'name_admin_bar'        => __( 'Feed Entry', 'text_domain' ),
		'archives'              => __( 'Feed Entriy Archives', 'text_domain' ),
		'attributes'            => __( 'Feed Entry Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Feed Entry:', 'text_domain' ),
		'all_items'             => __( 'All Feed Entries', 'text_domain' ),
		'add_new_item'          => __( 'Add New Feed Entry', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Feed Entry', 'text_domain' ),
		'edit_item'             => __( 'Edit Feed Entry', 'text_domain' ),
		'update_item'           => __( 'Update Feed Entry', 'text_domain' ),
		'view_item'             => __( 'View Feed Entry', 'text_domain' ),
		'view_items'            => __( 'View Feed Entry', 'text_domain' ),
		'search_items'          => __( 'Search Feed Entry', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Feed Entry Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set Image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Feed Entry', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Feed Entry', 'text_domain' ),
		'items_list'            => __( 'Feed Entries list', 'text_domain' ),
		'items_list_navigation' => __( 'Feed Entries list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Feed Entry', 'text_domain' ),
		'description'           => __( 'Site Feed Entries.', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title','editor', 'author', 'thumbnail', 'comments', 'revisions' ),
		'taxonomies'            => array( 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'           	=> 'dashicons-rss',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'feed_entries', $args );

	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Feed Categories', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Feed Category', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Feed Categories', 'textdomain' ),
		'all_items'         => __( 'All Feed Categories', 'textdomain' ),
		'parent_item'       => __( 'Parent Feed Category', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Feed Category:', 'textdomain' ),
		'edit_item'         => __( 'Edit Feed Category', 'textdomain' ),
		'update_item'       => __( 'Update Feed Category', 'textdomain' ),
		'add_new_item'      => __( 'Add New Feed Category', 'textdomain' ),
		'new_item_name'     => __( 'New Feed Category Name', 'textdomain' ),
		'menu_name'         => __( 'Feed Category', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'feeds-cat' ),
	);

	register_taxonomy( 'feeds-cat', array( 'feed_entries' ), $args );
}
add_action( 'init', 'feed_entries_post_type', 0 );
// add_action( 'init', 'processrssdata',0);
// add_action('wp_footer','processrssdata');
function processrssdata(){
	global $wpdb;
    $query = $wpdb->get_results('SELECT ID FROM ' . $wpdb->posts . ' WHERE post_title = "demov" AND post_type = "feed_entries"');
    echo $query[0]->ID;
     if ( $query[0]->ID ) {
     	$original_link = get_post_meta($query[0]->ID, 'original_link', true);
     	$old_count = get_post_meta($query[0]->ID, 'share_count', true);
     	$fb_count = file_get_contents('https://graph.facebook.com/?ids='.trim($original_link).'',false);
				$fb_count = json_decode($fb_count);
				$b = trim($value->link);
				update_post_meta($query[0]->ID, 'share_count',$fb_count->$b->share->share_count);

    // print_r($wpdb->num_rows);
    die;
	// $bitly = file_get_contents('https://api-ssl.bitly.com/v3/shorten?access_token=aa4de5c3c241c1c3d8bc5d0a515e1455f661a48e',false);
	// echo "<pre>";
	// print_r($bitly);
	// die;

	// $MailChimp = new MailChimp('63de667e4e7bb21af7b4b94b4a7b6081-us2');
	// $campaigns = $MailChimp->get('campaigns/265383394b/content');
	// $campaigns->html;
	// echo "<pre>";
	// print_r($campaigns);
	// get_template_part( 'mailchimptemplate' );
	
	// echo "</pre>";
	// $result = $MailChimp->put('campaigns/265383394b/content', ['template' => ['id' => 345025, 'sections' => ['body' => $html]]]);
	// die;

	$feed_url = 'http://labs.cartisien.com/rss/rss.php';
	$xml = file_get_contents($feed_url,false);
    $xmlOut = '';
    $inTag = false;
    $xmlLen = strlen($xml);
    for($i=0; $i < $xmlLen; ++$i) {
        $char = $xml[$i];
        // $nextChar = $xml[$i+1];
        switch ($char) {
        case '<':
          if (!$inTag) {
              // Seek forward for the next tag boundry
              for($j = $i+1; $j < $xmlLen; ++$j) {
                 $nextChar = $xml[$j];
                 switch($nextChar) {
                 case '<':  // Means a < in text
                   $char = htmlentities($char);
                   break 2;
                 case '>':  // Means we are in a tag
                   $inTag = true;
                   break 2;
                 }
              }
          } else {
             $char = htmlentities($char);
          }
          break;
        case '>':
          if (!$inTag) {  // No need to seek ahead here
             $char = htmlentities($char);
          } else {
             $inTag = false;
          }
          break;
        default:
          if (!$inTag) {
             $char = htmlentities($char);
          }
          break;
        }
        $xmlOut .= $char;
    }
    $result = simplexml_load_string($xmlOut);
	// echo "<pre>";
	// print_r($result); die;
    $feed_url = 'https://twitrss.me/twitter_user_to_rss/?user=cartisien';
	$xml = file_get_contents($feed_url,false);	
	$result2 = simplexml_load_string($xml,'SimpleXMLElement', LIBXML_NOCDATA);
	// echo "<pre>";
	// print_r($result2); die;
	$i = 0;
	foreach ($result->channel->item as $key => $value) {
		// print_r(json_decode(json_encode((array)$value->title)));
		foreach ($result2->channel->item as $key2 => $value2) {
			$tmp_title = explode('http://',$value2->title);
			preg_match('/(src)=("[^"]*")/i',$value2->description, $b);
				$b = str_replace('"', '', $b);
				$image_url = $b[2];
			if(trim($tmp_title[0]) == $value->title && $image != ''){
				$all_data[$i]['image_url'] = $image;
				$all_data[$i]['title'] = (string) $value->title;
				$all_data[$i]['link'] = (string) $value->link;
				$all_data[$i]['category'] = (array) $value->category;
				$bitly = explode('pic.twitter',$tmp_title[1]);
				$all_data[$i]['bitly_link'] = 'http://'.trim($bitly[0]);	
				$fb_count = file_get_contents('https://graph.facebook.com/?ids='.trim($value->link).'',false);
				$fb_count = json_decode($fb_count);
				$b = trim($value->link);
				$all_data[$i]['share_count'] = $fb_count->$b->share->share_count;
				$all_data[$i]['pubDate'] = (string) $value2->pubDate;

				// CODE TO CREATE POSTS
				global $wpdb;
			    $query = $wpdb->prepare(
			        'SELECT ID FROM ' . $wpdb->posts . 'WHERE post_title = %s AND post_type = \'feed_entries\'', $all_data[$i]['title']);
			    $wpdb->query( $query );
			    if ( $wpdb->num_rows ) {
			        return true;
			    } else {
					$update_post = array(
						'post_type'		=> 'feed_entries',
						'post_title'	=> $all_data[$i]['title'],
						'post_status'	=> 'publish',
						'meta_input'	=> array(
					      	'original_link'	=> $all_data[$i]['link'],
					      	'bitly_link'	=> $all_data[$i]['bitly_link'],
					      	'image_url'		=> $all_data[$i]['image_url'],
					      	'pub_date'		=> $all_data[$i]['pubDate'],
					      	'share_count'	=> $all_data[$i]['share_count'],
					      	)
						);
					$response = wp_insert_post($update_post);
					wp_set_object_terms( $response, $all_data[$i]['category'], 'feeds-cat' );
					// echo $response;
					$i++;
				}
			}
		}
	}
	echo "<pre>ghxftjykjjz";
	print_r($all_data);
	echo "</pre>"; die;	
}

}

// title
// link ACF
// bit.ly link ACF
// category
// image url ACF
// pubDate ACF
// share count

