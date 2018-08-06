








style.css  
functions.php 
index.php
sidebar.php
page.php 
single.php 
header.php (get_header())
footer.php (get_footer())
archive.php 	
search.php 
single-book.php ----  custom post type
archive-book.php ----



work on this  it's function.php


http://localhost/wordpressdemo/?book=the-one-thing-by-garry-keller
http://localhost/wordpressdemo/?book=power-by-robert-greene












    

//social icon

function widget($args, $instance) {}
    function mywidget()
    {
        parent::wp_widget(false,$name=__('Social Icons','wp_widget_plugin'));
    }
   
}
    function get_widget() 
    {
        register_widget( 'mywidget' );
    }
    add_action( 'widgets_init', 'get_widget' );

    function display_content($content)
    {
        $b = get_option('socialdisplay');
        // print_r($b);
        $co = '';
        foreach ($b as $key => $x) 
            {
            $co .= '<a href="http://www.fb.com"><img src="'.plugins_url( '/images/'.$key.'.png', __FILE__ ).'" alt="wheel">';

        }
        return $content.$co;
    }
  
    // action for line no 19.
     function menupage()
    {
        add_menu_page( 
        __( 'Custom Menu Title', 'textdomain' ),
        'Social Icon',
        'manage_options',
        'custompage',
        'my_custom_menu_page'); 
    }
    add_action('admin_menu','menupage');
    // filter Ref line no  46
    function my_custom_menu_page()
    {
        $data1 = $_POST['social'];
        
        if(isset($_POST['submit']))
        update_option('socialdisplay',$data1);
        $data = get_option('socialdisplay');
        print_r($data);
        ?>
        <div class="wrap">
            <h1>Change Social Icons</h1>
            <form name='myform' action="#" method="POST">
                <input type="checkbox" name=social[facebook]> Facebook</br> 
                <input type="checkbox" name=social[google]> Google</br>
                <input type="checkbox" name=social[twitter]> Twitter</br>
                <?php submit_button(); ?>
            </form>
            </div>
            <?php 
    } 
    //add_filter( 'the_content', array('saasd','display_content') );













// MY OWN #REF CODE


<?php 
function update($new_instance,$old_instance)
{
	$instance=(array);
	$instance=$old_instance;
	$instance['fname']=$new_instance['fname'];
	$instance['lname']$new_instance['lname'];
	return $instance;
}

// wp_parse_args(''); 
// USED WHEN WE NEED TO PASS ARRAY CONTAINING DIFFERENT TYPE OF VALUES.
$default=array(
	'fname'=>'abc',
	'lname'=>'xyz');
$instance=wp_parse_args($instance,$default);

















// WORDPRESS FOOTER CLASS

do_action( 'get_footer' );
       if ( file_exists( TEMPLATEPATH . '/footer.php') )
            load_template( TEMPLATEPATH . '/footer.php');
       else
            load_template( ABSPATH . 'wp-content/themes/default/footer.php');



    // If it's a 404 page, use a "Page not found" title.
    if ( is_404() ) {
        $title['title'] = __( 'Page not found' );















 ?>
