<?php get_header(); ?>
<div class="container">
	<div class="row">

 	<h2>Books</h2>
 	<strong id="post">
 	<?php     
$loop = new WP_Query( array (
  'post_type' => 'book',
  'posts_per_page' => 4
) );




 ?>
	<?php if ( $loop->have_posts() ) : ?>
    	<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
    	<h2><a href="<?php the_permalink();  ?>"><?php the_title();  ?>	</a></h2>
    	
     	  <?php the_content();  ?>
   		 <?php endwhile; ?>
	<?php endif; ?>

	</strong></div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

 

