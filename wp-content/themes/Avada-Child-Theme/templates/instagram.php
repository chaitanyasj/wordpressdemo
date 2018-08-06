<?php
/*
Template Name: Instagram
*/
?>
<?php get_header(); ?>
<?php
// $today = getdate();
// $one_day =  getdate( $today[0] -86400 );
// $args1 = array(
// 	'post_type'		=> 'feed_entries',
// 	'posts_per_page'=> -1,
// 	'post_status'	=> 'publish',
// 	'date_query' 	=> array(
//                     'year' => $today['year'],
//                     'month' => $today['mon'],
//                     'day' => $today['mday']
//                 )
// 	 );
// $args2 = array(
// 	'post_type'		=> 'feed_entries',
// 	'posts_per_page'=> -1,
// 	'post_status'	=> 'publish',
// 	'date_query'	=> array(
//                     'year' => $one_day['year'],
//                     'month' => $one_day['mon'],
//                     'day' => $one_day['mday']
//                 )
// 	 );
// $the_query1 = new WP_Query( $args1 );
// $the_query2 = new WP_Query( $args2 );
$args = array(
	'post_type'		=> 'feed_entries',
	'posts_per_page'=> -1,
	'post_status'	=> 'publish'
	 );
$the_query = new WP_Query( $args );
// echo "<pre>";
// print_r($the_query1->posts);
// echo "<pre>"; die;
?>
<h1 style="text-align: center;">Instagram Posts</h1>
<div id="pl-2409" class="panel-layout">
	<div id="pg-2409-0" class="panel-grid panel-no-style" data-style="{&quot;cell_alignment&quot;:&quot;flex-start&quot;,&quot;equal_column_height&quot;:&quot;no&quot;,&quot;background_image&quot;:false,&quot;background_image_position&quot;:&quot;center top&quot;,&quot;background_image_style&quot;:&quot;cover&quot;,&quot;use_background_video&quot;:&quot;&quot;,&quot;video_overlay&quot;:&quot;none&quot;,&quot;fade_in&quot;:true,&quot;pause_after&quot;:&quot;120&quot;,&quot;pause_play_button&quot;:true,&quot;pauseplay_xpos&quot;:&quot;right&quot;,&quot;pauseplay_ypos&quot;:&quot;top&quot;}" data-ratio="1" data-ratio-direction="right" style="padding:40px 100px;">
<?php foreach ($the_query->posts as $key => $value) {  ?>
	<div class="panel-grid-cell" data-weight="0.25">
		<div>
		<img class="fs-feed-image" src="<?php echo get_post_meta( $value->ID, 'image_url', true); ?>">
		<h3 class="widget-title "><?php echo get_the_title($value->ID); ?></h3>
			<div class="textwidget">
			<?php print_r(get_the_category($value->ID)); ?>
			</div>
			<span class="bitly_link"><?php echo get_post_meta( $value->ID, 'bitly_link', true); ?>			
			</span>
		</div>
	</div>
<?php } ?>
</div>
<?php get_footer(); ?>

