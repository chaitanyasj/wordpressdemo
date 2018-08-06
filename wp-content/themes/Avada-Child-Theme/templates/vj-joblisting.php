<?php
/*
Template Name: VJ job Listing Template
*/
?>
<?php get_header(); ?>
<?php
global $wpdb;
$results = $wpdb->get_results( 'SELECT * FROM 	wp_enggwave_jobs_data');
echo "<pre>";
// $final_array = strip_tags($results[content]);
print_r($results);
?>
<?php get_footer(); ?>


