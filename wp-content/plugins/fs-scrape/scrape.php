<?php
/*
Plugin Name: FS Scraper
Plugin URI: https://fantastech.co
Description: This plugin add the scraper functionality.
Author: Ram Shengale (Fantastech Solution)
Author URI: https://fantastech.co
Version: 1.0.0
*/

add_action('wp_enqueue_scripts' , 'fs_scrape_js' );
function fs_scrape_js() {
	wp_enqueue_script( 'fs-scrape-js', plugins_url( 'assets/js/scrap.js?time='.time() , __FILE__ ), array('jquery') );
    wp_localize_script( 'fs-scrape-js', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));
    wp_enqueue_style( 'mystyle1', plugins_url('assets/css/fsstyle.css', __FILE__));
    wp_enqueue_style( 'mystyle2', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
}

add_shortcode('scrape_fs' , 'scrape_fs_func');
function scrape_fs_func($atts) {    
    $a = shortcode_atts( array(
		'table_id' => 0,
	), $atts );
    
	$formdata='
	
	<form id="scrape" name="scrape" method="post">
		<table cellspacing="10px" cellpadding="10px">
			<tr>
				<td><textarea id="scrapetxt" name="scrapetxt"  class="fs-textarea" cols="2" rows="15"></textarea></td>
			</tr>
			<tr>
				<td>
					<select id="scrapeselect"  name="scrapeselect" class="fs-select">
						<option value="google.com"> Google.com </option>
						
					</select>
                    
				</td>
			</tr>
			<tr>
				<td>
					<input type="submit" class="fs-button" id="process_scraper" name="process_scraper" value="Process">
				</td>
			</tr>
		</table>
	</form>
	<div class="outdata"></div>
	
	';
	return $formdata;
}


add_action( 'init', 'fs_scrap_outfunction' );
function fs_scrap_outfunction() {
	
	if(isset($_POST['process_scraper'])){
		$dt = file_get_contents("https://www.google.co.in/search?q=solapur+university&oq=solapur+university+&aqs=chrome..69i57j0l5.5127j0j7&sourceid=chrome&ie=UTF-8",false);
		
		$htmldata = stripslashes($_POST['scrapetxt']);
		$weblink= $_POST['scrapeselect'];
		include_once dirname(__FILE__). '/simplehtmldom_1_5/simple_html_dom.php';
		$html = new simple_html_dom();
		
		
		switch($weblink){
		
		case "google.com":
		
				$html->load($dt);
				echo "<pre>";
				print_r($html);
				die;
		break;
		die;
		
		default:		
			case "0":
			break;
		}	
  }	
	
}
