<?php 

add_action( 'wp_enqueue_scripts', 'my_enqueue_assets' ); 

function my_enqueue_assets() { 

    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' ); 

} 




function showxmldata(){
	include_once '/opt/lampp/htdocs/wordpressdemo/wp-content/plugins/fs-scrape/simplehtmldom_1_5/simple_html_dom.php';
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
// 	$html = file_get_html('http://fantastech.co/');

// 	 echo '<pre>';
// 	print_r($html);

// foreach($html->find('a') as $element) 
//        echo $element->href . '<br>';


	$result = file_get_contents('http://fantastech.co/');
	$json = json_decode($result);
	// $html = new simple_html_dom();
	// $html->load($result);
	var_dump($json);



}
add_shortcode('showxmldata','showxmldata');



function restapi(){
	$result = file_get_contents("https://www.enggwave.com/wp-json/wp/v2/posts/?per_page=5");
	$jsondata = json_decode($result);
	foreach ($jsondata as $value) {
		echo "<div class='job-view'>";
		// echo $value->id."<br>";
		// echo $value->title->rendered."<br>";
		echo $value->content->rendered."<br>";
		// echo $value->excerpt->rendered."<br>";
		// echo $value->link."<br>";
		echo "</div>";
	}

}
//add_shortcode('restapi','restapi');
