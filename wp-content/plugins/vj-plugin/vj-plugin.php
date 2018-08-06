<?php
/*
Plugin Name: vj-plugin for Job Listing
Plugin URI: http://abc.com
Description: plugin by vijay.
Version: 1.1.0
Author:vijay
*/
include_once dirname(__FILE__) . '/all-functions.php';
include_once dirname(__FILE__) .'/simplehtmldom_1_5/simple_html_dom.php';

function myconfig_enqueue_script() {   
	
	wp_enqueue_style( 'vj-style', plugins_url('assets/css/style.css', __FILE__));
	wp_enqueue_script( 'vj-script', plugins_url( 'assets/js/script.js' , __FILE__) );
}
add_action('admin_enqueue_scripts', 'myconfig_enqueue_script',99);

function menu_for_job()
{
  add_menu_page("All Job Settting", "All Job Settting", "manage_options", "all-job-settting", "all_job_function"); 
}
add_action("admin_menu", "menu_for_job");

$job_object = new jobs();

//DEMO FUNCTION
function get_all_content(){
	$job_object = new jobs();
	$result = file_get_contents("https://www.enggwave.com/wp-json/wp/v2/posts/?per_page=100");
	$jsondata = json_decode($result);
	foreach ($jsondata as $data) {
		$job_object->insertJobData($data);
	}
}

function all_job_function(){
	?>
	<div class="vj_get_all_jobs"> 
     <h1>Get all jobs</h1>
     <form class="vj_form" action="#" method="post">
         <input type="submit" name="submit_fetch_jobs" class="button button-primary button-large" id="submit_fetch_jobs" value="Click to update your jobs"> 
     </form>
    </div> 
<?php
}

function displayJobData(){
	$job_object = new jobs();
	$job_object->displayJobData();
	// print_r($all_jobs_listing);
	// echo "<div class='job-view'>";
	// 	echo $data->id."<br>";
	// 	echo $data->title->rendered."<br>";
	// 	echo $data->content->rendered."<br>";
	// 	echo $data->excerpt->rendered."<br>";
	// 	echo $data->link."<br>";
	// 	echo "</div>";
}
add_shortcode('displayJobData','displayJobData');

function load_first(){
	$job_object = new jobs();
	if(isset($_POST['submit_fetch_jobs'])){
		$result = file_get_contents("https://www.enggwave.com/wp-json/wp/v2/posts/?per_page=100");
		$jsondata = json_decode($result);
		foreach ($jsondata as $data) {
			$job_object->insertJobData($data);
		}
	}
}
add_action('init','load_first');

add_shortcode('custom_google_search','custom_google_search');
function custom_google_search(){	
	// $postdata = http_build_query(
 //    	array(
 //        	'user' => '265'
 //    	)
	// );

	// $opts = array('http' =>
 //    	array(
 //        	'method'  => 'POST',
	//         'header'  => 'Content-type: application/x-www-form-urlencoded',
	//         'content' => $postdata
 //    		)
	// 	);

	//$context  = stream_context_create($opts);
	//	$x = simplexml_load_string($result,'SimpleXMLElement', LIBXML_NOCDATA);
	//echo (string) $result->yacht;
	// $value = (string) $x->yacht[0]->yachtEbrochurePic;
	// // echo $value;
	// foreach ($x as $value) {
	// 	// echo "<div class='$value->yachtId'>";
	// 	echo "<img src=".$value->yachtEbrochurePic." height='100' width='200'>";
	// 	// echo "<p>yachtId: ".$value->yachtId;
	// 	// echo " size: ".$value->size;
	// 	// echo " yachtLowPrice: ".$value->yachtLowPrice;
	// 	// echo " yachtHighPrice".$value->yachtHighPrice;
	// 	// echo "</p>	</div>";
		

	// 	//print_r($value);
	// }
	// echo '<pre>';
	// print_r($x);  
?>
	<h3>Custom Google Results</h3>
	<form action='' method='POST'>
		<input type='text' name='search_context' value="<?php if(isset($_POST['search_context'])){ echo $_POST['search_context']; }?>" placeholder="Text to Search">
		<input type='text' name='no_of_results' value="<?php if(isset($_POST['search_context'])){ echo $_POST['no_of_results']; }?>" placeholder="No of expected results">
		<input type='submit' class="fusion-button button-flat fusion-button-square button-large" name='submit' value='Get Results'>
	</form>
<?php
	if(isset($_POST['search_context'])){
	// $search_context=$_POST['search_context'];
	$no_of_results = $_POST['no_of_results'];
	$search_context = preg_replace('/\s+/', '+', $_POST['search_context']);
	
	$html = file_get_html('https://www.google.co.in/search?q='.$search_context.'&num='.$no_of_results);
	// echo $html;

	$contents[] = array();
	$i = 0;
		foreach($html->find('.r') as $element) {
			$title = strip_tags($element->innertext).'</br>';
			// echo $href = $element->href.'</br>';
			$contents[$i]['title'] = $title;
			// $contents[$i]['href'] = $href;
			$i++;
			continue;
		}	$i = 0;
		foreach($html->find('cite') as $element) {
			$url = $element->plaintext.'</br>';
			$contents[$i]['url'] = $url;
			$i++;
			continue;

		}


echo "<pre>";
print_r($contents);
}
//FOR ALL ANCHER TAG TEXTS
	 // foreach($html->find('a') as $element) {
	 // 	echo $element->plaintext;
	 // }


	

// FOR HEADINGS
	// foreach ($html->find('div#ires') as $element) {
	// 		foreach ($element->find('a') as $cc){
	// 				echo $cc->plaintext . '<br>';
	// 		}
	// }



//DEMO CODE TO GET DOM ONJECT
	// $result = file_get_contents('http://fantastech.co/');
	// $dom = new simple_html_dom();
	// $dom->load($html);
	// var_dump($dom);



}

add_action('template_redirect','calsiteinfo');
function calsiteinfo(){
	if($_POST['submitfile']){
		if($_FILES['inputcsv']['error'] == 4){ 
			echo "<script>alert('No file selected to upload.');</script>"; 
			return false;
		}
		elseif($_FILES['inputcsv']['error'] == 3){
			echo "<script>alert('File upload failed.');</script>"; 
			return false;
		}
		elseif($_FILES['inputcsv']['type'] != 'text/csv'){
			echo "<script>alert('Please upload csv file.');</script>"; 
			return false;
		}
		$file_name = $_FILES['inputcsv']['name'];
		$tempname = $_FILES['inputcsv']['tmp_name'];
		$siteArray = array_map('str_getcsv', file($tempname));
		$prepare_csv = array();
		foreach ($siteArray as $key => $search_context) {
			if (strpos($search_context[0], 'https://') !== false) {
		        $headers = get_headers($search_context[0]);
		      	$site_html = file_get_html($search_context[0]);
		    }
		    elseif (strpos($search_context[0], 'http://') !== false) {
		        $headers = get_headers($search_context[0]);
		        $site_html = file_get_html($search_context[0]);
		    }
		    else{
		        $headers = get_headers('http://'.$search_context[0]);
		        $site_html = file_get_html('http://'.$search_context[0]);
		    }
			if (strpos($site_html, 'WordPress') !== false) {
			    $prepare_csv[$key][0] = $search_context[0];
			    $prepare_csv[$key][1] = 'yes';
			}
			elseif (strpos($site_html, 'wp-content') !== false) {
				$prepare_csv[$key][0] = $search_context[0];
			    $prepare_csv[$key][1] = 'yes';
			}
			else{
				$prepare_csv[$key][0] = $search_context[0];
			    $prepare_csv[$key][1] = 'no';
			}
		}
		header('Content-type: text/csv');
		header('Content-Disposition: attachment; filename="('.$file_name.') '.date(" F Y h:i:s A").'.csv"');
		header('Pragma: no-cache');
		header('Expires: 0');
		$file = fopen('php://output', 'w');
		fputcsv($file, array('Site', 'Present'));
		foreach ($prepare_csv as $row)
		{
		    fputcsv($file, $row);
		}
		exit;
	}
}
?>
<?php
add_shortcode('getsiteinfo','getsiteinfo');
function getsiteinfo(){ ?>
	<form action='' method='POST' enctype="multipart/form-data">
		<input type="file" name="inputcsv">
		<input type='submit' class="fusion-button button-flat fusion-button-square button-large" name='submitfile' value='Upload file'>
	</form>
<?php	} ?>