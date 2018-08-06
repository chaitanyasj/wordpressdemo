<?php  

function shortcode_first()
{
	$query='select post_title,post_content from wp_posts';
$wp_query->get_results($query);
 if ( have_posts() ) : ?>
    	<?php while ( have_posts() ) : the_post(); ?>
    	<h2><?php the_title();  ?></h2>
     	  <?php the_content();  ?>
   		 <?php endwhile; ?>
	<?php endif; 


}
add_shortcode('show_posts','shortcode_first');
add_filter('widget_text', 'do_shortcode'); 

?>