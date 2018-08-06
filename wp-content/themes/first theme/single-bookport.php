<?php get_header(); ?>
<div class="container">
	<div class="row">
		<h3 id="h3">we are in index.php, In container class</h3>
 	<h2>Posts</h2>
	<?php if ( have_posts() ) : ?>
    	<?php while ( have_posts() ) : the_post(); ?>
    	
     	  <?php the_content();  ?>
   		 <?php endwhile; ?>
	<?php endif; ?>

	</strong></div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

 
