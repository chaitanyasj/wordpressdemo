<?php  

// CUSTOM POST FORMAT
function learning_wordpress_theme()
{
	add_theme_support('post-formats',array('aside','gallery','link','image','video','audio','quote','status','chat'));

}
add_action('after_setup_theme','learning_wordpress_theme');

// CODE FOR GETTING WIDGETS
 if ( function_exists('register_sidebar') ) { register_sidebar(array( 'before_widget' => '<li id="%1$s" class="widget %2$s">', 'after_widget' => '</li>', 'before_title' => '<h2 class="widgettitle">', 'after_title' => '</h2>', )); }	

 if ( function_exists('register_sidebar') ) { register_sidebar(array( 'name' => 'Homepage Sidebar', 'id' => 'homepage-sidebar', 'description' => 'Appears as the sidebar on the custom homepage', 'before_widget' => '<div style="height: 280px"></div><li id="%1$s" class="widget %2$s">', 'after_widget' => '</li>', 'before_title' => '<h2 class="widgettitle">', 'after_title' => '</h2>', )); }


// CODE FOR POST CUSTOM TYPES
  function my_custom_post_book(){
  	$labels=array(
  		'name'=>('Books'),
  		'singular_name'      => _x( 'Books', 'post type singular name' ),
  	    'add_new'            => _x( 'Add New', 'book' ),
  	    'add_new_item'       => __( 'Add New Books' ),
  	    'edit_item'          => __( 'Edit Books' ),
  	    'new_item'           => __( 'New Books' ),
  	    'all_items'          => __( 'All Books' ),
  	    'view_item'          => __( 'View Books' ),
  	    'search_items'       => __( 'Search Books' ),
  	    'not_found'          => __( 'No Books found' ),
  	    'not_found_in_trash' => __( 'No Books found in the Trash' ), 
  	    'parent_item_colon'  => '',
  		'menu_name'=>'Books');
  	$args=array(
  	'labels'  => $labels,
      'description'   => 'Holds our Books data',
      'public'        => true,
      'menu_position' => 5,
      'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
      'has_archive'   => true,);
  	register_post_type('book',$args);


}
add_action('init','my_custom_post_book');

// This theme uses wp_nav_menu() in two locations.  
  register_nav_menus( array(  
    'primary' => __( 'Primary Navigation', 'twentyten' ),  
    'secondary' => __('Secondary Navigation', 'twentyten')  
  ) );

	



?>
<!-- CODE FOR RELATING META DATA -->
  <?php
  add_action( 'add_meta_boxes', 'adding_meta_box' );
  function adding_meta_box()
  {
      add_meta_box( 'metabox-id', 'Book Meta Box', 'metabox_contents', 'book', 'normal', 'high' );
  }
  function metabox_contents($post)
  {
       ?>
      <label>Author</label>
      <input type="text" name="metabox_author" id="metabox_author">
       </br><label for="metabox_publication_year">Publication Year</label>
          <select name="metabox_publication_year" id="metabox_publication_year">
              <option value="2001">2001</option>
              <option value="2002">2002</option>
              <option value="2003">2003</option>
              <option value="2004">2004</option>
              <option value="2005">2005</option>
              <option value="2006">2006</option>
          </select>
          </br><input type="checkbox" id="metadata_checkbox" name="metadata_checkbox">
          <label for="metadata_checkbox" >Publish</label>

  <?php }


  add_action( 'save_post', 'metabox_save' );
  function metabox_save( $post_id )
  {
     update_post_meta($post_id,'metabox_author',$_POST[ 'metabox_author' ] );
     update_post_meta($post_id,'metabox_publication_year',$_POST[ 'metabox_publication_year' ] );
     if( isset( $_POST[ 'metadata_checkbox' ] ) ) {
     update_post_meta($post_id,'metadata_checkbox','yes' );  
  }
     else{
     	update_post_meta($post_id,'metadata_checkbox','' );  
     }

  }


// SHORTCODE FUNCTIONS
  function shortcode_first($atts, $content=null)
  {
    extract(shortcode_atts(array(
     'number_of_posts' => '-1',
     'search_text' => '',
     'post_ids' =>'',
     'category'=>'',
     ),$atts));
    $args = array(
     'posts_per_page' => $number_of_posts,
     's' => $search_text,
     'post__in'=> explode( ', ', $post_ids) ,
     'cat'=> explode( ', ', $category ),
     'post_type'=>'post',
     'order'=>'ASC'
    );
    $query = new WP_Query($args);

    if ( $query->have_posts() ) {
      echo '<ul>';
      while ($query->have_posts() ) {
        $query->the_post();
        echo '<h2>' .get_the_id() .".   ". get_the_title() . '</h2>';
        echo '' . get_the_content() . '';
      }
      echo '</ul>';
    }
    
  }
add_shortcode('show_posts','shortcode_first');
add_filter('widget_text', 'do_shortcode'); 

// SHORTCODE WITH $CONTENT
  function shortcode_second($atts,$content=null)
  {
    echo "<style>#contentright{text-align:right; color:brown;}</style>";
    return "<div id=contentright>".$content."</div>";
  }
  add_shortcode('rightalign','shortcode_second');

  function shortcode_third($atts,$content=null)
  {
    echo "<style>#contentleft{text-align:left; color:green;}</style>";
    return "<div id=contentleft>".$content."</div>";
  }
  add_shortcode('leftalign','shortcode_third');

  function shortcode_fourtn($atts,$content=null)
  {
    return "<div id=contentbutton><input style='
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 18px;
    margin: 4px 2px;
    cursor: pointer;
    ' type='button' value='$content'</div>";
  }
  add_shortcode('showbutton','shortcode_fourtn');



//ADDING CUSTOM META BOX
add_action( 'add_meta_boxes', 'custom_meta_box' );
function custom_meta_box()
{
    add_meta_box( 'custom-meta-box-id', 'Custom Meta Box', 'custom_meta_box_context_fun', 'book', 'normal', 'high' );
}
// FUNCTION TO CUSTOMIZE METABOX CONTENTS
function custom_meta_box_context_fun($post)
{
  echo "Enter post Rating</br>";
echo "<input type='text' id='rating_meta_value' name='rating_meta_value'>";
// echo submit_button('Update Rating');
// echo "<input type='submit' value='Update Rating'>";
}

// TO SAVING META DATA
add_action('save_post','save_post_metadata');
function save_post_metadata($post_id){
  update_post_meta($post_id,'rating_meta_value',$_POST['rating_meta_value']);
}
// get_post_custom($post_id);
?>

