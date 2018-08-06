<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'avada-stylesheet' ) );
    wp_enqueue_script('lightbox_script',get_stylesheet_directory_uri() . '/assets/lightbox_me.js');
    wp_enqueue_script('myscript',get_stylesheet_directory_uri() . '/assets/script.js');
    wp_enqueue_script('chart-script','https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js');
 	wp_localize_script( 'myscript', 'fs_object_name', array( 'ajax_url'=> admin_url( 'admin-ajax.php' )));
	wp_enqueue_script( 'fs_script3', '//www.youtube.com/player_api', array('jquery') );

}

add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );
function load_custom_wp_admin_style() {
        wp_enqueue_style( 'child-admin-style', get_stylesheet_directory_uri() . '/admin-style.css');
        wp_enqueue_script('myscriptadmin',get_stylesheet_directory_uri() . '/assets/adminscript.js');
        wp_localize_script( 'myscriptadmin', 'fs_admin_object_name', array( 'ajax_url'=> admin_url( 'admin-ajax.php' )));
}

add_action( 'after_setup_theme', 'avada_lang_setup' );
function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'Avada', $lang );
}

add_action('wp_footer','functionPopup');
function functionPopup(){ ?>
	<div class="fs_popup" style="display: none;"><img src="/wp-content/uploads/2017/09/loading_1.gif" id="fs-loading" style="display: none;"/></div>
<?php }

add_shortcode('topic_question_description','topic_question_description');
function topic_question_description($atts){
	global $wpdb;
	$alphabets = array('A','B','C','D','E','F');
	extract(shortcode_atts(array(
		'ques_id' => 'ques_id'
		), $atts));
		 $questiondata = $wpdb->get_results("SELECT question,correct_msg,answer_data FROM  `wp_wp_pro_quiz_question` WHERE  `id` = $ques_id" , ARRAY_A);
		 echo "<div class='fs-topic-data'>";
		 echo '<p>Question :- '.$questiondata[0]['question'].'</p>';
		 WpProQuiz_Helper_Until::saveUnserialize($questiondata[0]['answer_data'], $ans);
		 
		 echo '<p>Choices :- ';
		 foreach ($ans as $anskey => $value) {
		 		echo '<br>'.$alphabets[$anskey].'. '.$value->getAnswer();
		 }
		 echo "</p>";
		 foreach ($ans as $value) {
		 	if($value->isCorrect() == 1){
		 		echo '<p>Correct Answer :- '.$value->getAnswer().'</p>';
		 	}
		 }
		echo '<p>Explanation :- '.$questiondata[0]['correct_msg'].'</p>';
		 echo "</div>";
}

add_filter( 'bbp_get_reply_content', 'for_topic_the_content' );
add_filter( 'bbp_get_topic_content', 'for_topic_the_content' );
function for_topic_the_content( $content ) {
	if(get_post_type() == 'topic'){
		if ( has_shortcode( $content, 'topic_question_description' ) ) {
			return do_shortcode($content);
		}else{
			return $content;
		}
	}else{
		return $content;
	}
}

add_action('wp_head','check_for_general_forum'); 
function check_for_general_forum(){
	if(get_the_ID() == '4194' ){
		echo '<style> .bbp-topic-form{ display: block !important;	}</style>';
	}
}
add_action('wp_head','check_for_quiz_page'); 
function check_for_quiz_page(){
	if(get_post_type() == 'sfwd-quiz' ){
		echo '<style> .fusion-row #content{ width:100% !important;	}</style>';
	}
}

add_filter( 'woocommerce_account_menu_items', 'custom_my_account_menu_items' );
function custom_my_account_menu_items( $items ) {
    unset($items['downloads']);
    unset($items['edit-address']);
    return $items;
}

add_filter ( 'woocommerce_account_menu_items', 'wpb_woo_my_account_myorder' );
function wpb_woo_my_account_myorder($myorder){
	$myorder['reports'] = __( 'Reports');
	return $myorder;
}

add_filter ( 'woocommerce_account_menu_items', 'wpb_woo_my_account_order' );
function wpb_woo_my_account_order() {
	$myorder = array(
		'dashboard'          => __( 'Dashboard', 'woocommerce' ),
		'reports'    	 => __( 'Reports', 'woocommerce' ),
		'edit-account'       => __( 'Profile', 'woocommerce' ),
		'orders'             => __( 'Orders', 'woocommerce' ),
		'subscriptions' 	 => __('Subscriptions','woocommerce'),
		'payment-methods' 	 => __('Billing','woocommerce'),
		'customer-logout'    => __( 'Logout', 'woocommerce' )
	);
	return $myorder;
}

add_action( 'init', 'my_custom_endpoints' );
function my_custom_endpoints() {
    add_rewrite_endpoint( 'reports', EP_ROOT | EP_PAGES );
}

add_filter( 'query_vars', 'my_custom_query_vars', 0 );
function my_custom_query_vars( $vars ) {
    $vars[] = 'reports';
    return $vars;
}

add_action( 'woocommerce_account_customer-logout_endpoint', 'my_logout_endpoint_content' );
function my_logout_endpoint_content() {
    include 'woocommerce/myaccount/logout.php'; 
}



 
add_filter( 'woocommerce_get_endpoint_url', 'misha_hook_endpoint', 10, 4 );
function misha_hook_endpoint( $url, $endpoint, $value, $permalink ){
	if( $endpoint === 'customer-logout' ) {
		$url = wp_logout_url(get_site_url());
	}
	return $url; 
}

add_action( 'woocommerce_account_reports_endpoint', 'my_custom_endpoint_content' );
function my_custom_endpoint_content() {
    include 'woocommerce/myaccount/reports.php'; 
}

add_action( 'after_switch_theme', 'my_custom_flush_rewrite_rules' );
function my_custom_flush_rewrite_rules() {
    flush_rewrite_rules();
}

add_filter( 'manage_users_columns', 'new_modify_user_table' );
function new_modify_user_table( $column ) {
    $column['phone'] = 'Phone no.';
    return $column;
}

add_filter( 'manage_users_custom_column', 'new_modify_user_table_row', 10, 3 );
function new_modify_user_table_row( $val, $column_name, $user_id ) {
    switch ($column_name) {
        case 'phone' :
            return get_the_author_meta( 'billing_phone', $user_id );
            break;
        default:
    }
    return $val;
}

add_action( 'gform_user_registered', 'vc_gf_registration_autologin',  10, 4 );
function vc_gf_registration_autologin( $user_id, $user_config, $entry, $password ) {
	$user = get_userdata( $user_id );
	$user_login = $user->user_login;
	$user_password = $password;
    wp_signon( array(
		'user_login' => $user_login,
		'user_password' =>  $user_password,
		'remember' => false
    ) );
}

add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {
    unset($fields['order']['order_comments']);
    unset($fields['shipping']);
    unset($fields['billing']);
    return $fields;
}

add_filter( 'woocommerce_order_item_name', 'remove_permalink_order_table', 10, 3 );
function remove_permalink_order_table( $name, $item, $order ) {
   $name = $item['name'];
   return $name;
}

add_action('fs_before_fusion_row','fs_lessons_list');
function fs_lessons_list(){
	if(is_single() && get_post_type() =='sfwd-courses'){
		$lessonArray = array('Clsfcn','Entry','TA','BC','Valn','FTZ','PEx','Fines','Marks','Bonds','Dbk','ADD','IPR','POA','Records','Quota');
		$lessinIDs = array(4281,204,4283,188,4285,510,4267,203,180,191,4268,4269,182,181,506,4272);  ?>
		<div class="fs-lesson-listing">
			<?php foreach ($lessonArray as $lessonkey => $lessonvalue) {   ?>
				<?php if($lessinIDs[$lessonkey] != get_the_ID()){ ?>
					<a href="<?php echo get_permalink($lessinIDs[$lessonkey]); ?>"><?php  echo $lessonvalue; ?> </a>
				<?php } ?>	
			<?php } ?>
		</div>
<?php
	}
}

add_filter('wp_nav_menu_objects', 'change_menu'); 
function change_menu($items){
  foreach($items as $item){
    if( $item->title == "Logout"){
         $item->url =  wp_logout_url(get_site_url());
    }
  }
  return $items;
}

//CHECKS USER HAVE SUBSCRIPTION OR NOT.
function check_user_subscription(){
	$flag = 0;
	$pending_cancel = wcs_user_has_subscription( get_current_user_id(), 4456, 'pending-cancel');
	$active = wcs_user_has_subscription( get_current_user_id(), 4456, 'active');
	// $three_month = wcs_user_has_subscription( get_current_user_id(), 4455, 'active' );
	// $six_month = wcs_user_has_subscription( get_current_user_id(), 4454, 'active' );	
	if(!is_user_logged_in()){
		$flag = 0;
	}else{
		if (current_user_can('administrator')) {
			$flag = 1;
		}elseif($pending_cancel == 1 || $active == 1){
			$flag = 1;
		// }elseif($three_month){
		// 	$flag = 1;
		// }elseif($six_month){
		// 	$flag = 1;
		}else{
			$flag = 2;
		}
	}
	return $flag;
}


add_filter( 'woocommerce_add_cart_item_data', 'wdm_empty_cart', 10,  3);
function wdm_empty_cart( $cart_item_data, $product_id, $variation_id ) {
	global $woocommerce;
 	$woocommerce->cart->empty_cart();
 	return $cart_item_data;

}

add_action('woocommerce_login_form_end','show_register_html');
function show_register_html(){
	echo "<p class='fs-loginpage-msg'>Not registered? Please click <a href='/register/'>here</a> to register.</p>";
}

add_action('wp_ajax_mon_action', 'fs_get_cat_results');
add_action('wp_ajax_nopriv_mon_action', 'fs_get_cat_results');
function fs_get_cat_results(){
	$tests_category_result = array();
	$catresult = $_POST['cat_data'];
	$quiz_data = $_POST['quiz_data'];

	$fs_new_tests_category[$quiz_data] = $catresult['catarr'];
	$fs_old_tests_category = get_user_meta(get_current_user_id(),'tests_category_result',true);
	// echo "<pre>";
	// print_r($fs_new_tests_category);
	//print_r($fs_old_tests_category);
	// die;
	if(!empty($fs_old_tests_category)){
		foreach ($fs_old_tests_category as $key => $value) {
			if($key == $quiz_data){
				$fs_old_tests_category = array_replace($fs_old_tests_category, $fs_new_tests_category);
			}
		}
		$fs_old_tests_category  = $fs_old_tests_category + $fs_new_tests_category;
		// print_r($fs_old_tests_category);

	}else{
		$fs_old_tests_category = $fs_new_tests_category;
	}
		$updated = update_user_meta(get_current_user_id(),'tests_category_result',$fs_old_tests_category);
	// echo $updated;
	// print_r($fs_old_tests_category);
	
die;
}

add_action('woocommerce_account_navigation','display_upgrade_message');
function display_upgrade_message(){
	$check = check_user_subscription();
	if($check == 2){
		echo "<span class='fs_display_upgrade'><a class='display_upgrade_message'>Upgrade</a> your account</span>";
	}
}

// add_filter( 'woocommerce_valid_order_statuses_for_cancel', 'fs_show_cancel_option', 50, 2 );
// function fs_show_cancel_option( $statuses, $order ){

// //     // Set HERE the order statuses where you want the cancel button to appear
    // $custom_statuses    = array( 'completed', 'pending', 'processing', 'on-hold', 'failed' );

// //     // Set HERE the delay (in days)
// //     $duration = 3; // 3 days

// //     $delay = $duration*24*60*60; // (duration in seconds) 
// //     $date_created_time  = strtotime($order->get_date_created()); // Creation date time stamp
// //     $date_modified_time = strtotime($order->get_date_modified()); // Modified date time stamp
// //     $now = strtotime("now"); // Now  time stamp

// //     // Using Creation date time stamp
// //     if ( ( $date_created_time + $delay ) >= $now ) return $custom_statuses;
// //     else 
    // return $custom_statuses;
// }

add_filter( 'woocommerce_account_orders_columns', 'new_orders_columns' );
function new_orders_columns( $columns ) {
    // Add new columns
    unset($columns['order-date']);
    unset($columns['order-total']);
    unset($columns['order-status']);
    $first_array = array_splice ($columns, 0, 1); 
    $columns = array_merge ($first_array,  array('subscription-id' => 'Subscription'), $columns); 
    $first_array = array_splice ($columns, 0, 2); 
    $columns = array_merge ($first_array,  array('subscription-status' => 'Subscription status'), $columns); 
    $first_array = array_splice ($columns, 0, 3); 
    $columns = array_merge ($first_array,  array('start-date' => 'Start date'), $columns); 
    $first_array = array_splice ($columns, 0, 4); 
    $columns = array_merge ($first_array,  array('end-date' => 'Payment due'), $columns);
    // $columns['subscription-id'] = __( 'Subscription', 'Text Domain' );
    // $columns['start-date'] = __( 'Start date', 'Text Domain' );
    // $columns['end-date'] = __( 'End date', 'Text Domain' );
    return $columns;
}

// add_filter( 'wcs_view_subscription_actions', 'add_subscriptions_cancel_button',100,2);
function add_subscriptions_cancel_button($actions, $subscription){
	$current_status = $subscription->get_status();
	if ($current_status == 'active') {
	$actions['cancel'] = array(
				'url'  => wcs_get_users_change_status_link( $subscription->get_id(), 'cancelled', $current_status ),
				'name' => _x( 'Cancel', 'an action on a subscription', 'woocommerce-subscriptions' ),
			);
	}
	return $actions;
}
add_filter( 'woocommerce_account_payment_methods_columns', 'change_payment_method_column',100,2);
function change_payment_method_column($columns){
	$columns=array(
		'method' => __( 'Payment Method', 'woocommerce' ),  
        'expires' => __( 'Expires on', 'woocommerce' ),  
        'actions' => ' ',  
 	); 
	return $columns;
}

add_action( 'woocommerce_login_form', 'redirect_user_back_to_product' );
function redirect_user_back_to_product() {
	if($_GET['redirect_to']){
		$redirect_to = $_GET['redirect_to']; ?>
		<input type="hidden" name="redirect-user" value="<?php echo $redirect_to; ?>">
<?php
	}else{  ?>
	<input type="hidden" name="redirect-user" value="<?php echo home_url(); ?>">
<?php
	}

}
function custom_woocommerce_login_redirect_back( $redirect, $user ) {
		$redirect = esc_url( $_POST['redirect-user'] );
	return $redirect;
}
add_filter( 'woocommerce_login_redirect', 'custom_woocommerce_login_redirect_back' );

// add_filter('woocommerce_login_redirect', 'pro_login_redirect');
// function pro_login_redirect( $redirect_to ) {
// $redirect_to = get_permalink(get_the_ID());
// return $redirect_to;
// }

add_filter( 'woocommerce_my_account_my_orders_actions', 'sv_add_my_account_order_actions', 10, 2 );
function sv_add_my_account_order_actions( $actions, $order ) {
	$sub_id = wcs_get_subscriptions_for_order(  $order->get_order_number());
	$subscription = wcs_get_subscription(key($sub_id));
	if($subscription->get_status() == 'active'){
		$actions['cancel-subscription'] = array(
	        //'url'  => $actions_for_subscription['cancel']['url'],
	        'url' => '',
	        'name' => __( ' Cancel Subscription', 'my-textdomain' ),
	        'sub_id' => key($sub_id),
	    );
	}
    return $actions;
}

add_action('wp_ajax_sub_action', 'popup_for_subscription');
add_action('wp_ajax_nopriv_sub_action', 'popup_for_subscription');
function popup_for_subscription(){
	$sub_id= $_POST['my_data'];
	$subscription = wcs_get_subscription($sub_id);
	$actions_for_subscription = wcs_get_all_user_actions_for_subscription( $subscription, get_current_user_id() );
	?>
	<div class="fs-popup-wrap">
		<div class="popup-header">
			<h3>Cancel Subscription</h3>
		</div>
	<div class="popup-body">
		<p> Your cancellation will be effective w.e.f. <?php echo $subscription->get_date_to_display('schedule_next_payment' ); ?>.</p>
		<a class="fusion-button button-flat fusion-button-round button-default button-1 button-small" target="_self" href=" <?php echo $actions_for_subscription['cancel']['url']; ?> "><span class="fusion-button-text">Cancel subscription</span></a>
		<span class="close-popup">x</span>
	</div>
<?php
die;	
}

add_filter( 'woocommerce_return_to_shop_redirect', 'wc_redirect_to_checkout_with_subscription' );
function wc_redirect_to_checkout_with_subscription() {
	return '/checkout/?add-to-cart=570&variation_id=4456&attribute_pa_subscription=monthly-subscription&quantity=1';
}

// add_filter('woocommerce_lost_password_message','fs_change_lost_password_message',10,1);
// function fs_change_lost_password_message($message){
// 	 return  __( ' Please enter your username (email address.) You will receive an emailed link to create a new password.', 'custombrokerexamprep' );
// }

add_action('woocommerce_before_edit_account_form','add_profile_page_top_message');
function add_profile_page_top_message(){
	echo "Use profile page to review your profile or change your password.";
}

add_action('woocommerce_before_account_orders','add_orders_page_top_message');
function add_orders_page_top_message(){
	echo "Use orders page to review your orders and subscription.";
}

add_action('woocommerce_before_account_payment_methods','add_payment_methods_page_top_message');
function add_payment_methods_page_top_message(){
	echo "Use billing page to add and view payment methods.";
}

// add_filter( 'woocommerce_cart_item_subtotal', 'filter_woocommerce_cart_item_subtotal', 10, 3 );
function filter_woocommerce_cart_item_subtotal( $wc, $cart_item, $cart_item_key ) { 
    echo "$".$cart_item[ 'data' ]->price;
    $subtotal = __( ' per month', 'Avada' );
    return $subtotal;
};

// add_filter( 'woocommerce_order_formatted_line_subtotal', 'filter_woocommerce_order_formatted_line_subtotal', 10, 3 );
function filter_woocommerce_order_formatted_line_subtotal( $subtotal, $item, $instance ) { 
	echo $subtotal;
    $subtotal = __( ' per month', 'Avada' );
    return $subtotal; 
}; 

// add_filter( 'woocommerce_cart_totals_order_total_html', 'filter_woocommerce_cart_totals_order_total_html', 10, 1 );
function filter_woocommerce_cart_totals_order_total_html( $value ) { 
    return $value." (per month until cancelled.)"; 
};

// add_filter( 'woocommerce_get_order_item_totals', 'filter_woocommerce_get_order_item_totals', 10, 3 );
function filter_woocommerce_get_order_item_totals( $array, $int, $int ) { 
    // make filter magic happen here... 
    // echo "<pre>";
    // print_r($array);
    $array['order_total']['value'] = $array['order_total']['value'].' (per month until cancelled.)';
    return $array; 
};        

// function fs_check_all_questions(){
// 	global $wpdb;
// 	$questiondata = $wpdb->get_results("SELECT quiz_id, title FROM `wp_wp_pro_quiz_question` WHERE category_id = ''" , ARRAY_A);
// 	echo "<pre>";
// 	print_r($questiondata);
// }
// add_shortcode('fs_check_all_questions','fs_check_all_questions');

function dtwd_exclude_widget_category($args){
$exclude = "27,23"; // IDs of excluding categories
$args["exclude"] = $exclude;
return $args;
}
add_filter("widget_categories_args","dtwd_exclude_widget_category");

// CODE TO CHANGE ANY TEXT
add_filter( 'woocommerce_add_message', function( $message ) {
    if( $message == 'Your subscription has been cancelled.' )
        $message = 'Your subscription will be canceled automatically on the last date of your current billing cycle.';
    return $message;
},20);

// function give_profile_name($atts){
//     $user=wp_get_current_user();
//     $name=$user->user_firstname; 
//     return '<span class="menu-addon">Hello, '.$name.'</span>My Account';
// }

// add_shortcode('profile_name', 'give_profile_name');

// add_filter( 'wp_nav_menu_objects', 'my_dynamic_menu_items' );
// function my_dynamic_menu_items( $menu_items ) {
//     foreach ( $menu_items as $menu_item ) {
//         if ( 'My Account' == $menu_item->title ) {
//             global $shortcode_tags;
//             if ( isset( $shortcode_tags['profile_name'] ) ) {
//                 // Or do_shortcode(), if you must.
//                 $menu_item->title = call_user_func( $shortcode_tags['profile_name'] );
//             }
//         }
//     }
//     return $menu_items;
// }

function login_error_override()
{
    return 'ERROR: Invalid username or password. Please re-enter your login info.';
}

add_filter('login_errors', 'login_error_override');



add_action( 'add_meta_boxes', 'wpt_add_event_metaboxes' );
function wpt_add_event_metaboxes() {
	add_meta_box(
		'wpt_events_location',
		'Forum Status',
		'wpt_events_location',
		'sfwd-quiz',
		'side',
		'default'
	);
}
function wpt_events_location() {	
	$curr_id = get_the_id();
	$term_data = get_the_category($curr_id);
	if ($term_data[0]->term_id == 23) {  
		global $wpdb;
		$postTitle = get_the_title($curr_id);
		$query = $wpdb->prepare('SELECT ID FROM '.$wpdb->posts.' WHERE post_title = %s AND post_type = "forum"',$postTitle);
	    $wpdb->query( $query );
	    if($wpdb->num_rows){  ?>
	    	<span class="fs-forum-created" style="color:#4caf50;padding: 5px;">Forum Exist</span>
	    <?php }else{  ?>
		<input type="button" class="fs-create-forum button button-primary" value="Create Forum" fs-quiz-id="<?php echo $curr_id; ?>">
		<img src="/wp-content/uploads/2017/09/loading_1.gif" id="fs-loading" style="display: none;"/>
		<span class="fs-forum-created" style="color:#4caf50;display: none;    padding: 5px;">Forum Created</span>
<?php
		}
	}else{
		echo "Assign 'Test page Quizzes' category to create Forum";
	}
}
add_action('wp_ajax_fsadmin_action', 'create_forum_topics');
add_action('wp_ajax_nopriv_fsadmin_action', 'create_forum_topics');
function create_forum_topics(){
	$quiz_id = $_POST['my_data'];
	$title = get_the_title($quiz_id);
	$quiz_pro_id = get_post_meta($quiz_id,'quiz_pro_id',true);
	global $wpdb;
	$my_forum = array(
			'post_title'   => $title,
			'post_type'    => 'forum',
			'post_status'  => 'publish',
			'post_author'  => 1,
			'meta_input'   => array(
	    			'related_quiz' => $quiz_pro_id,
				 )
		);
	// echo "<pre>";
	// print_r($my_forum);	
	$forum_id = wp_insert_post( $my_forum );
	echo $forum_id;
	$question_ids = $wpdb->get_results("SELECT id,title FROM wp_wp_pro_quiz_question WHERE quiz_id = $quiz_pro_id",ARRAY_A);
	foreach ($question_ids as $value) {
		$First = explode("Question:",$value['title']);
		$second = explode(" ",$First[1]);
		$fsquestion = $First[0]."Question ".$second[1];
		$fsquestionid = $temptopicids[$j];
		$ques_id =$value['id'];
		$my_post = array(
			'post_title'   => $fsquestion,
			'post_type'    => 'topic',
			'post_status'  => 'publish',
			'post_author'  => 1,
			'post_content' => "[topic_question_description ques_id='$ques_id']",
			'post_parent' =>$forum_id,
			'meta_input'   => array(
	    			'_bbp_forum_id' => $forum_id,
				 )
		);
		// echo "<pre>";
		// print_r($my_post);
		$anonymous_data = false; $author_id = 0; $is_edit = false;
		$topic_id = wp_insert_post( $my_post );
		bbp_update_topic( $topic_id, $forum_id, $anonymous_data, $author_id, $is_edit );
		// echo 'topic id '.$topic_id.'<br> ';
	}
	die;
}