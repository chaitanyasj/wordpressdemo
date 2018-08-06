jQuery(document).ready(function(){
	jQuery('.prev-link').addClass('fusion-button button-flat fusion-button-round button-large button-default button-2');
	jQuery('.next-link').addClass('fusion-button button-flat fusion-button-round button-large button-default button-2');
	jQuery('#learndash_mark_complete_button').addClass('fusion-button button-flat fusion-button-round button-large button-default button-2');
	jQuery('.cancel-subscription').addClass('fusion-button button-flat fusion-button-round button-small button-default');
	// jQuery('.fs-register-menuitem a').addClass('fusion-button button-flat fusion-button-round button-small button-default button-2');

	jQuery(document).on('click', '.bbp-forum-info a', function(e){
	 	  var url1 = jQuery(this).attr('href'); 
	 	  if(url1 == '#'){
			e.preventDefault();
			var data = '<div class="fs-popup-wrap">';
			data +='<div class="popup-header">';
			data +='<h3>Subscribe</h3>';
			data +='</div>';
			data +='<div class="popup-body">';
			data +='<p>Please Give Respective Test to View this Discussion</p>';
			data +='<br><a class="fusion-button button-flat fusion-button-round button-default button-1 button-small" target="_self" href="/tests/"><span class="fusion-button-text">Give Test</span></a></div>';
			data +='<span class="close-popup">x</span></div>';
		 	jQuery('.fs_popup').lightbox_me({
				centered: true,
				closeSelector: '.close-popup'
			});
			 jQuery('.fs_popup').html(data);  
		 }
	});
	// FOR COURSE LISTING
	jQuery(document).on('click', '.fs-notlogpermitted-course', function(e){
			e.preventDefault();
			var data = '<div class="fs-popup-wrap">';
			data +='<div class="popup-header">';
			data +='<h3>Login</h3>';
			data +='</div>';
			data +='<div class="popup-body">';
			data +='<p>Please login to access lessons.</p>';
			data +='<br><a class="fusion-button button-flat fusion-button-round button-default button-1 button-small" target="_self" href="/my-account/?redirect_to=https://www.customsbrokerexamprep.com/lesson/"><span class="fusion-button-text">Login</span></a></div>';
			data +='<span class="close-popup">x</span></div>';
		 	jQuery('.fs_popup').lightbox_me({
				centered: true,
				closeSelector: '.close-popup'
			});
			 jQuery('.fs_popup').html(data);  
	});
	jQuery(document).on('click', '.fs-notpermitted-course', function(e){
			e.preventDefault();
			var data = '<div class="fs-popup-wrap">';
			data +='<div class="popup-header">';
			data +='<h3>Upgrade</h3>';
			data +='</div>';
			data +='<div class="popup-body">';
			data +='<p>Please upgrade membership to access this content.</p>';
			data +='<div class="upgrade-option"><a class="fusion-button button-flat fusion-button-round button-default button-1 button-small" target="_self" href="/checkout/?add-to-cart=570&variation_id=4456&attribute_pa_subscription=monthly-subscription&quantity=1"><span class="fusion-button-text">Upgrade with $299 For 1 Month, $299/month</span></a>';
			//data +='<a class="fusion-button button-flat fusion-button-round button-default button-1 button-small" target="_self" href="/checkout/?add-to-cart=570&variation_id=4455&attribute_pa_subscription=3-months&quantity=1"><span class="fusion-button-text">Upgrade with $747 For 3 Months, $249/month</span></a>';
			//data +='<a class="fusion-button button-flat fusion-button-round button-default button-1 button-small" target="_self" href="/checkout/?add-to-cart=570&variation_id=4454&attribute_pa_subscription=6-months&quantity=1"><span class="fusion-button-text">Upgrade with $1194 For 6 Months, $199/month</span></a></div></div>';
			data +='<span class="close-popup">x</span></div>';
		 	jQuery('.fs_popup').lightbox_me({
				centered: true,
				closeSelector: '.close-popup'
			});
			 jQuery('.fs_popup').html(data);  
	});
	// FOR TEST LISTING
	jQuery(document).on('click', '.fs-notlogpermitted-test', function(e){
			e.preventDefault();
			var data = '<div class="fs-popup-wrap">';
			data +='<div class="popup-header">';
			data +='<h3>Login</h3>';
			data +='</div>';
			data +='<div class="popup-body">';
			data +='<p>Please login to access tests.</p>';
			data +='<br><a class="fusion-button button-flat fusion-button-round button-default button-1 button-small" target="_self" href="/my-account/?redirect_to=https://www.customsbrokerexamprep.com/tests/"><span class="fusion-button-text">Login</span></a></div>';
			data +='<span class="close-popup">x</span></div>';
		 	jQuery('.fs_popup').lightbox_me({
				centered: true,
				closeSelector: '.close-popup'
			});
			 jQuery('.fs_popup').html(data);  
	});
	jQuery(document).on('click', '.fs-notpermitted-test', function(e){
			e.preventDefault();
			var data = '<div class="fs-popup-wrap">';
			data +='<div class="popup-header">';
			data +='<h3>Upgrade</h3>';
			data +='</div>';
			data +='<div class="popup-body">';
			data +='<p>Please upgrade membership to access this content.</p>';
			data +='<div class="upgrade-option"><a class="fusion-button button-flat fusion-button-round button-default button-1 button-small" target="_self" href="/checkout/?add-to-cart=570&variation_id=4456&attribute_pa_subscription=monthly-subscription&quantity=1"><span class="fusion-button-text">Upgrade with $299 For 1 Month, $299/month</span></a>';
			//data +='<a class="fusion-button button-flat fusion-button-round button-default button-1 button-small" target="_self" href="/checkout/?add-to-cart=570&variation_id=4455&attribute_pa_subscription=3-months&quantity=1"><span class="fusion-button-text">Upgrade with $747 For 3 Months, $249/month</span></a>';
			//data +='<a class="fusion-button button-flat fusion-button-round button-default button-1 button-small" target="_self" href="/checkout/?add-to-cart=570&variation_id=4454&attribute_pa_subscription=6-months&quantity=1"><span class="fusion-button-text">Upgrade with $1194 For 6 Months, $199/month</span></a></div></div>';
			data +='<span class="close-popup">x</span></div>';
		 	jQuery('.fs_popup').lightbox_me({
				centered: true,
				closeSelector: '.close-popup'
			});
			 jQuery('.fs_popup').html(data);  
	});	
	jQuery(".wpProQuiz_reviewQuestion ol li:first").addClass("fsQuestionVisited");
	jQuery( document ).on("click",".wpProQuiz_QuestionButton",function(e) {
		jQuery(".wpProQuiz_reviewQuestionTarget").addClass("fsQuestionVisited");
		jQuery(".wpProQuiz_reviewQuestionSolved").removeClass("fsQuestionVisited");
	});
	jQuery( document ).on("click",".wpProQuiz_reviewQuestion ol li",function(e) {
		jQuery(this).addClass("fsQuestionVisited");
	});
	jQuery('.gfield_radio').addClass('switch-field');

	jQuery(document).on('click', '.display_upgrade_message', function(e){
			e.preventDefault();
			var data = '<div class="fs-popup-wrap">';
			data +='<div class="popup-header">';
			data +='<h3>Upgrade</h3>';
			data +='</div>';
			data +='<div class="popup-body">';
			data +='<p>Please upgrade membership to access content.</p>';
			data +='<div class="upgrade-option"><a class="fusion-button button-flat fusion-button-round button-default button-1 button-small" target="_self" href="/checkout/?add-to-cart=570&variation_id=4456&attribute_pa_subscription=monthly-subscription&quantity=1"><span class="fusion-button-text">Upgrade with $299 For 1 Month, $299/month</span></a>';
 			//data +='<a class="fusion-button button-flat fusion-button-round button-default button-1 button-small" target="_self" href="/checkout/?add-to-cart=570&variation_id=4455&attribute_pa_subscription=3-months&quantity=1"><span class="fusion-button-text">Upgrade with $747 For 3 Months, $249/month</span></a>';
			//data +='<a class="fusion-button button-flat fusion-button-round button-default button-1 button-small" target="_self" href="/checkout/?add-to-cart=570&variation_id=4454&attribute_pa_subscription=6-months&quantity=1"><span class="fusion-button-text">Upgrade with $1194 For 6 Months, $199/month</span></a></div></div>';
			data +='<span class="close-popup">x</span></div>';
		 	jQuery('.fs_popup').lightbox_me({
				centered: true,
				closeSelector: '.close-popup'
			});
			 jQuery('.fs_popup').html(data);  
	});
	jQuery("#bbp_reply_content").attr("placeholder", "Enter your query here");

	//POPUP FOR CANCEL SUBSCRIPTION MESSAGE.
	jQuery(document).on('click', '.cancel-subscription', function(e){
		e.preventDefault();
		jQuery('.fs_popup').lightbox_me({
						centered: true,
						closeSelector: '.close-popup'
					});
		jQuery("#fs-loading").css("display", "block");
		var sub_id = jQuery(this).attr('sub-id');
			jQuery.ajax({		
				type : 'POST',
				url  : fs_object_name.ajax_url,
				data : {action: 'sub_action', my_data : sub_id},
				success: function(response) {
					// console.log(response);
					jQuery("#fs-loading").css("display", "none");
					jQuery('.fs_popup').html(response);
				}
			});
	});

	jQuery(document).on('click', '#fs-homepage-slider-popup', function(e){
			e.preventDefault();
			var data = '<div class="fs-popup-wrap">';
			data +='<div class="popup-header">';
			data +='<h3>Introduction</h3>';
			data +='</div>';
			data +='<div class="popup-body">';
			data +='<p>Video content not found</p>';
			data +='<span class="close-popup">x</span></div>';
		 	jQuery('.fs_popup').lightbox_me({
				centered: true,
				closeSelector: '.close-popup'
			});
			 jQuery('.fs_popup').html(data);  
	});
	jQuery(".fs-convinience-image .heading.heading-with-icon.icon-left .image").hover(function(){
		jQuery(this).find('img').attr('src','https://www.customsbrokerexamprep.com/wp-content/uploads/2018/01/new-con.png');
	},function(){
		jQuery(this).find('img').attr('src','https://www.customsbrokerexamprep.com/wp-content/uploads/2017/08/convinience.png');
	});
	jQuery(document).on('click','.fs-homepage-video', function(e){
		jQuery('#player_1')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
	});
});