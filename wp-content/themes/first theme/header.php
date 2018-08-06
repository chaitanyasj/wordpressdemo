<!DOCTYPE html>
<html>
<head>
	<title><?php wp_title(); ?> </title>
	<link rel="stylesheet" type="text/css" href="wp-content/themes/first theme/style.css">
	<?php wp_head(); ?>
</head>
<body>
<div id="header">
<h2 id="h2">Welcome to wordpress theme building</h2>
<!-- <h3 id="h3">We are in header.php file</h3> -->
</div>
<div class="bottomMenu">
              <?php wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?>  
    </div>
