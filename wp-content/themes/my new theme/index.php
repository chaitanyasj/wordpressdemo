<!-- SENDING CSS CODE IN PHP. -->
<?php 
$csscode='<style type="text/css">h2{color:blue;}</style>';
 ?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="wp-content/themes/my new theme/style.css">

<?php echo $csscode; ?>
</head>
<body>
<!-- <a href="#">home</a>
<a href="aaa.php">news</a>
<a href="">Log out</a> -->
<?php do_action('show_body') ;  ?>


</body>
</html>




