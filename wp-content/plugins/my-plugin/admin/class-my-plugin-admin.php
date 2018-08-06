      <?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       www.vijay.cim
 * @since      1.0.0
 *
 * @package    My_Plugin
 * @subpackage My_Plugin/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    My_Plugin
 * @subpackage My_Plugin/admin
 * @author     Vijay <Vijay@gmail.com>
 */
class My_Plugin_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in My_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The My_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/my-plugin-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in My_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The My_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/my-plugin-admin.js', array( 'jquery' ), $this->version, false );

	}

    /**
	 * ADD AN OPTIONS PAGE UNDER THE SETTINGS SUBMENU
	 *
	 * @since  1.0.0
	 */
	public function add_options_page() {
	
		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'Outdated Notice Settings', 'outdated-notice' ),
			__( 'Outdated Notice', 'outdated-notice' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_options_page' )
		);
	
	}
 //CUSTOM POST TYPE JOB

	public function my_custom_post_job(){
  	$labels=array(
  		'name'=>('Jobs'),
  		'singular_name'      => _x( 'Jobs', 'post type singular name' ),
  	    'add_new'            => _x( 'Add New', 'book'),
  	    'add_new_item'       => __( 'Add New Jobs'),
  	    'edit_item'          => __( 'Edit Jobs' ),
  	    'new_item'           => __( 'New Jobs' ),
  	    'all_items'          => __( 'All Jobs' ),
  	    'view_item'          => __( 'View Jobs' ),
  	    'search_items'       => __( 'Search Jobs' ),
  	    'not_found'          => __( 'No Jobs found' ),
  	    'not_found_in_trash' => __( 'No Jobs found in the Trash' ), 
  	    'parent_item_colon'  => '',
  		'menu_name'=>'Jobs');
  	$args=array(
  	'labels'  => $labels,
      'description'   => 'Holds our Jobs data',
      'public'        => true,
      'menu_position' => 5,
      'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
      'has_archive'   => true,
      'taxonomies'	  => array('topics','Category'));
  	register_post_type('Job',$args);
	
	}

	function add_category_taxonomy_to_job() {
		register_taxonomy_for_object_type( 'category', 'job' );
	}
	function add_tag_taxonomy_to_job() {
		register_taxonomy_for_object_type( 'post_tag', 'job' );
	}


 //CUSTOM POST TYPE PRODUCT

	public function my_custom_post_product(){
  	$labels=array(
  		'name'=>('Products'),
  		'singular_name'      => _x( 'Products', 'post type singular name' ),
  	    'add_new'            => _x( 'Add New', 'Product'),
  	    'add_new_item'       => __( 'Add New Product'),
  	    'edit_item'          => __( 'Edit Products' ),
  	    'new_item'           => __( 'New Products' ),
  	    'all_items'          => __( 'All Products' ),
  	    'view_item'          => __( 'View Products' ),
  	    'search_items'       => __( 'Search Products' ),
  	    'not_found'          => __( 'No Products found' ),
  	    'not_found_in_trash' => __( 'No Products found in the Trash' ), 
  	    'parent_item_colon'  => '',
  		'menu_name'=>'Products');
  	$args=array(
  	'labels'  => $labels,
      'description'   => 'Holds our Products data',
      'public'        => true,
      'menu_position' => 5,
      'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
      'has_archive'   => true,
      'taxonomies'	  => array('topics','Category'));
  	register_post_type('Product',$args);
	
	}

	function add_category_taxonomy_to_product() {
		register_taxonomy_for_object_type( 'category', 'product' );
	}
	function add_tag_taxonomy_to_product() {
		register_taxonomy_for_object_type( 'post_tag', 'product' );
	}



 /**
 * Generate sub menu page for settings
 *
 * @uses rushhour_projects_options_display()
 */
	public function product_setting_function()
	{
	    
	    add_submenu_page('edit.php?post_type=product', 'Product Settings',' Settings', 'edit_themes', 'product_setting', array($this, 'my_submenu_function'));
	}
	public function my_submenu_function()
	{
		echo "hi";
	}
}
