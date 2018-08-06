<?php get_header(); 
 
if (is_single() ) {
  // echo "this is single.php";  
}
?>
<div class="container">
	<div class="row">
		<!-- <h3 id="h3">we are in index.php, In container class</h3> -->
 	<h2>Posts</h2>
 	<strong id="post">
	<?php if ( have_posts() ) : ?>
    	<?php while ( have_posts() ) : the_post(); ?>
    	<h2><a href="<?php the_permalink();  ?>"><?php the_title();  ?>	</a></h2>
Written by, 
	<?php
	$author = get_post_meta( get_the_ID(), 'metabox_author', true); 
	echo $author; ?>

| Publication Year:-
	<?php
	$published = get_post_meta( get_the_ID(), 'metabox_publication_year', true);
  	echo $published; ?>
| Published or not:-
	<?php
	$pubyear = get_post_meta( get_the_ID(), 'metadata_checkbox', true); 
	echo $pubyear; ?>
| Ratings:- 
<?php 
$rating=get_post_meta(get_the_ID(),'rating_meta_value',true);
echo $rating." Star";   
?>

     	  <?php the_content();  ?>
   		 <?php endwhile; ?>
	<?php endif; ?>

	</strong></div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); 


?>