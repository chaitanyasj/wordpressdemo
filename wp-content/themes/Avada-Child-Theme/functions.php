<?php

function theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'avada-stylesheet' ) );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'Avada', $lang );
}
add_action( 'after_setup_theme', 'avada_lang_setup' );



function add_post_formats(){
    add_theme_support( 'post-formats', array( 'video') );
}
add_action( 'after_setup_theme', 'add_post_formats', 20 );
	
add_shortcode('restapi','restapi');
function restapi(){  ?>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
  $( function() {
    $( ".drag" ).draggable();  } );
  </script>
		<div class="col-md-3 main_div">
			<ul>
				<li class="drag">abc</li>
				<li class="drag">xyz</li>
				<li class="drag">pqr</li>
				<li class="drag">lmn</li>
			</ul>
	</div>
	<div class="col-md-9 main_div"></div>
<?php
}
function has_attributes() {
	global $product;
	echo "<pre>";
	print_r($product);
    // foreach ( $product->get_attributes() as $attribute ) {
    //   if ( $attribute->get_visible() ) {
    //     return true;
    //   }
    // }
    // return false;
  }
  add_action('wp_footer','has_attributes');
