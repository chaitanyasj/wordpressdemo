<?php
/*
 plugin name:firstplugin
 description: this is my first in first plugin for wordpress.
 Author: vijay
 Licence:GPL 2
 */
// add_action('wp_head','show_head');
// function show_head(){
// 	print "	<link rel='stylesheet' type='text/css' href=''>";
// }




add_action('show_body','show_my_data');
function show_my_data(){
echo "code from first plugin in wordpress";
print "<hr>learning wordpress";
print "<hr>This is example of wpdb function using get_results();";
}



add_filter('show_body2','show_my_data2');
function show_my_data2($value){
	$value=20;
	return $value;
}


// $query="select * from student";
// $results=$wpdb->get_results($query);
// print "<table><tr><td>Rollno</td><td>Name</td><td>Email</td><td>Mobile</td></tr><tr>";
// foreach($results as $result){
// 	print "<td>$result->id</td>";
// 	print "<td>$result->name</td>";
// 	print "<td>$result->email</td>";
// 	print "<td>$result->mobile</td></tr>";
// }
// print "</table><hr>";

add_filter('student_data','student_function');
function student_function(){
$query="select * from student";
$results=$wpdb->get_results($query);
return $results;
}	 



// add_action('show_sum','sum_fun');
// function sum_fun(){
// 	$sum=100;
// 	return $sum;
// }