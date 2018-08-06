<?php
/*
Template Name: Archives
*/
get_header(); ?>

<div id="container">
	<div id="content" role="main">

			<?php if ( have_posts() ) : ?>
    	<?php while ( have_posts() ) : the_post(); ?>
    	<h2><a href="<?php the_permalink();  ?>"><?php the_title();  ?></a>	</h2>
     	  <?php the_content();  ?>
   		 <?php endwhile; ?>
	<?php endif; ?>
	</div><!-- #content -->
</div><!-- #container -->
<?php  get_search_form();  ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>