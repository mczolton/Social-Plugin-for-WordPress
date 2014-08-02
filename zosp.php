<?php

/*  Plugin Name: Zolton.org Social Plugin
    Plugin URI: http://www.zolton.org/projects/social-plugin-for-wordpress/
    Description: Simple social networking integration for Wordpress.
    Version: 1.5.2	
    Author: Mark Zolton
    Author URI: http://www.zolton.org
    License: GPL2

    Copyright 2014  Mark Zolton  (email : mark@zolton.org)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.
 n
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Default Settings
define( 'ZOSP_FB_APPID', '000000000000000' ); 
define( 'ZOSP_TWITTER_USERNAME', 'mytwitterusername'); 
define( 'ZOSP_FB_IMAGE', 'http://www.example.org/images/example.png'); 
define( 'ZOSP_FB_COMMENT_WIDTH', '474' );
// define( 'ZOSP_FB_LIKE_SEND', 'true' ); 
// define( 'ZOSP_HIDE_WPCOMMENTS', 'false' );

/** Options Page */
function zosp_options_add_page() {
	
add_options_page(
	'Zolton.org Social Plugin', 
	'Social Plugin', 
	'manage_options', 
	'zosp-plugin', 
	'zosp_options_page');
}

function zosp_options_page() {
	?>
	<div>
		<h2>Zolton.org Social Plugin Settings</h2>
		<!-- dot dot dot -->
		<form action="options.php" method="post">
		
			<?php settings_fields('zosp_options'); ?>
			<?php do_settings_sections('zosp-plugin'); ?>
	
			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
			
		</form>
	</div>
	<?php 
}

add_action('admin_menu', 'zosp_options_add_page');

/** Settings */
function zosp_options_init() {
	
	register_setting( 'zosp_options', 'zosp_options', 'zosp_options_validate' );
	
	// Required Settings
	add_settings_section('zosp_options_required', 'Required Settings', 'zosp_options_required_text', 'zosp-plugin');
	add_settings_field('zosp_options_fb_appid', 'Facebook App ID', 'zosp_options_fb_appid_string', 'zosp-plugin', 'zosp_options_required');
	add_settings_field('zosp_options_twitter_username', 'Twitter Username', 'zosp_options_twitter_username_string', 'zosp-plugin', 'zosp_options_required');

	// Advanced Settings
	add_settings_section('zosp_options_advanced', 'Advanced Settings', 'zosp_options_advanced_text', 'zosp-plugin');
	add_settings_field('zosp_options_fb_image', 'Default Facebook Image', 'zosp_options_fb_image_string', 'zosp-plugin', 'zosp_options_advanced');
	add_settings_field('zosp_options_fb_comment_width', 'Facebook Comment Field Width (pixels)', 'zosp_options_fb_comment_width_string', 'zosp-plugin', 'zosp_options_advanced');
	add_settings_field('zosp_options_fb_like_send', 'Show Facebook Send Button', 'zosp_options_fb_like_send_string', 'zosp-plugin', 'zosp_options_advanced');
	add_settings_field('zosp_options_pinit_button', 'Show Pinterest Pin It Button', 'zosp_options_pinit_button_string', 'zosp-plugin', 'zosp_options_advanced');
	add_settings_field('zosp_options_hide_wpcomments', 'Hide Wordpress Comments', 'zosp_options_hide_wpcomments_string', 'zosp-plugin', 'zosp_options_advanced');
}

function zosp_options_required_text() {
	echo '<p style="padding-right: 300px;">The Zolton.org Social Plugin 
	requires a Facebook App ID and a Twitter username. Get a Facebook App ID
	from the <a href="https://developers.facebook.com/apps" target="_blank">Facebook 
	Developers</a> page. Get a Twitter username by visiting 
	<a href="http://twitter.com/" target="_blank">Twitter</a> and signing up 
	for a new account.</p>';
}

function zosp_options_fb_appid_string() {
	
	$value = null;
	$options = get_option('zosp_options');
	
	if($options['fb_appid']) {
		$value = $options['fb_appid'];
	} else {
		$value = ZOSP_FB_APPID;
	}
	
	echo "<input id='zosp_options_fb_appid' name='zosp_options[fb_appid]' 
	size='40' type='text' value='{$value}' />";
} 

function zosp_options_twitter_username_string() {
	
	$value = null;
	$options = get_option('zosp_options');
	
	if($options['twitter_username']) {
		$value = $options['twitter_username'];
	} else {
		$value = ZOSP_TWITTER_USERNAME;
	}
	
	echo "<input id='zosp_options_twitter_username' name='zosp_options[twitter_username]' 
	size='40' type='text' value='{$value}' />";
} 

function zosp_options_advanced_text() {
	echo '<p style="padding-right: 300px;">These settings are optional, 
	but it\'s worth it to set them to something other than the default.</p>';
}

function zosp_options_fb_image_string() {
	
	$value = null;
	$options = get_option('zosp_options');
	
	if($options['fb_image']) {
		$value = $options['fb_image'];
	} else {
		$value = ZOSP_FB_IMAGE;
	}
	
	echo "<input id='zosp_options_fb_image' name='zosp_options[fb_image]' 
	size='80' type='text' value='{$value}' />";
} 

function zosp_options_fb_comment_width_string() {
		
	$value = null;
	$options = get_option('zosp_options');
	
	if($options['fb_comment_width']) {
		$value = $options['fb_comment_width'];
	} else {
		$value = ZOSP_FB_COMMENT_WIDTH;
	}
	
	echo "<input id='zosp_options_fb_comment_width' name='zosp_options[fb_comment_width]' 
	size='8' type='text' value='{$value}' />";
} 

function zosp_options_fb_like_send_string() {
	$options = get_option('zosp_options');
	$checked = null;
	
	if($options['fb_like_send'] == '1') { $checked = 'checked=\'checked\''; } 
	
	echo "<input id='zosp_options_fb_like_send' type='checkbox' name='zosp_options[fb_like_send]' 
	value='1' $checked />";
}

function zosp_options_pinit_button_string() {
	$options = get_option('zosp_options');
	$checked = null;
	
	if($options['pinit_button'] == '1') { $checked = 'checked=\'checked\''; } 
	
	echo "<input id='zosp_options_pinit_button' type='checkbox' name='zosp_options[pinit_button]' 
	value='1' $checked />";

	echo "<p><strong>Note:</strong> Pin It button will only display on posts that have a featured image.</p>";
}

function zosp_options_hide_wpcomments_string() {
	$options = get_option('zosp_options');
	$checked = null;
	
	if($options['hide_wpcomments'] == '1') { $checked = 'checked=\'checked\''; } 
	
	echo "<input id='zosp_options_hide_wpcomments' type='checkbox' name='zosp_options[hide_wpcomments]' 
	value='1' $checked />";
}

function zosp_options_validate($input) {

	$options = get_option('zosp_options');
	
	$options['fb_appid'] = trim($input['fb_appid']);
	$options['twitter_username'] = trim($input['twitter_username']);
	$options['fb_image'] = trim($input['fb_image']);
	$options['fb_comment_width'] = trim($input['fb_comment_width']);
	$options['fb_like_send'] = trim($input['fb_like_send']);
	$options['pinit_button'] = trim($input['pinit_button']);
	$options['hide_wpcomments'] = trim($input['hide_wpcomments']);

	return $options;
}

add_action('admin_init', 'zosp_options_init');

/** Facebook FBML Namespace */
function zosp_facebook_namespace($content) {
	return $content . ' xmlns:fb="http://www.facebook.com/2008/fbml"';
}

add_filter('language_attributes', 'zosp_facebook_namespace');

/** Facebook Open Graph Tags */
function zosp_facebook_og_tags() {
	
	$options = get_option('zosp_options');
	$app_id = $options['fb_appid'];
	
	// Always add the OG tag for app_id.
	echo <<<END
<!-- ZO: Facebook Open Graph Tags -->
<meta property="fb:app_id" content="{$app_id}" />
END;

	// If this is a single post, add additional OG tags (generally used by the Like Button).
	if( is_singular() ) {	
			 
		$options = get_option('zosp_options');
		
		$title = esc_attr( single_post_title( '', FALSE ) );
		$site_name = esc_attr( get_bloginfo( 'name' ) );
		$url = esc_url( get_permalink() );
		$image = $options['fb_image'];
		
		// Get the featured image, if one exists.
        if ( has_post_thumbnail( get_the_ID() ) ) {
            $image = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
        }
        
        $image = esc_url( $image );
		
		echo <<<END
<meta property="og:title" content="{$title}" />
<meta property="og:site_name" content="{$site_name}" />
<meta property="og:url" content="{$url}" />
<meta property="og:type" content="website" />
<meta property="og:image" content="{$image}" />
END;

	}
	
	echo '<!-- ZO: End Facebook Open Graph Tags -->';
}

add_action( 'wp_head', 'zosp_facebook_og_tags' );

/** Facebook JavaScript SDK */
function zosp_facebook_js_sdk($c) {
	
	$options = get_option('zosp_options');
	$app_id = $options['fb_appid'];

	echo <<<END
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId={$app_id}&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

END;

?>
<!-- Pinterest -->
<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>

<!-- Google Plus One -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<?php 
}

add_filter( 'wp_footer', 'zosp_facebook_js_sdk' );

/** Facebook Comments */
function zosp_facebook_comments () {
	
	if( is_singular() && comments_open() ) {
		
		$options = get_option('zosp_options');
		
		$url = esc_url( get_permalink() );
		$width = $options['fb_comment_width'];
		
		/* Sets the width of Facebook Comments based on the template.
		 * At zolton.org, we use a template called "onecolumn-page" 
		 * or "full-width" that is wider than a multi-column page. If 
		 * "onecolumn-page" or "full-width" is not in use, just the 
		 * multi-column width.
		 */
		if( strpos( get_page_template(), 'onecolumn' ) || strpos( get_page_template(), 'full-width' ) ) {
			// $width = '640';
			$fullWidthClass = 'full-width'; 
		} 
		
		echo <<<END
<!-- ZO: Facebook Comments -->
<div id="facebook-comments" style="width: {$width}px;" class="{$fullWidthClass}">
<h3 id="facebook-reply-title">Add a Facebook Comment</h3>
<fb:comments href="{$url}" num_posts="3" width="{$width}" publish></fb:comments>
</div>
<!-- ZO: End Facebook Comments -->
END;

	}
}

add_filter( 'comments_template',  'zosp_facebook_comments');

/** Social Buttons */
function zosp_social_buttons( $content ) {

	$new_content = '';
	
	// If this is a single post, add additional OG tags (generally used by the Like Button).
	if( is_singular() && comments_open() && in_the_loop()) {
		
		$options = get_option('zosp_options');
		
		$title = esc_attr( single_post_title( '', FALSE ) );
		$site_name = esc_attr( get_bloginfo( 'name' ) );
		$title .= ' from ' . $site_name;

		$url = esc_url( get_permalink() );
		$twitter_username = $options['twitter_username'];
		$send = null;
		
		if($options['fb_like_send'] == '1') { $send = 'true'; }
		else { $send = 'false'; } 

		// Get the featured image, if one exists.
		$image = null;
       		if ( has_post_thumbnail( get_the_ID() ) ) {
            		$image = esc_url( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) );
        	}

		$new_content = <<<END
<!-- ZO: Social Buttons --> 
<div class="zosp-social-buttons">
END;

		if($options['pinit_button'] == '1' && $image != null)
		{
			$new_content .= <<<END
<div class="zosp-social-button zosp-social-pinit">
	<a href="//www.pinterest.com/pin/create/button/?url={$url}&media={$image}&description={$title}" data-pin-do="buttonPin" data-pin-config="none" data-pin-color="gray"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_white_20.png" /></a>
</div>
END;
		}

		$new_content .= <<<END
<!-- Google+ -->
<div class="zosp-social-button zosp-social-plusone">
	<div class="g-plusone" data-size="tall" data-annotation="none"></div>
</div>

<!-- Twitter -->
<div class="zosp-social-button zosp-social-twitter">
	<a href="https://twitter.com/share" class="twitter-share-button" data-via="{$twitter_username}" data-count="none">Tweet</a>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
</div>
	
<!-- Facebook -->
<div class="zosp-social-button zosp-social-facebook">
	<div class="fb-like" data-href="{$url}" data-layout="button" data-action="like" data-show-faces="false" data-share="{$send}"></div>
</div>

</div>			
<!-- ZO: End Social Buttons -->
END;

	}
	
	return $content . $new_content;
	
}

add_filter( 'the_content', 'zosp_social_buttons' );

/** Hide the Wordpress comment form? */
$options = get_option('zosp_options');
if($options['hide_wpcomments'] == '1')
{
	function zosp_hide_wpcomments()
	{
		$path = plugins_url('css/zosp-hide-wpcomments.css', __FILE__);
		
		wp_register_style('zosp_hide_wpcomments', $path);
        	wp_enqueue_style('zosp_hide_wpcomments');
	}
	
	add_action('init', 'zosp_hide_wpcomments');
}

/** Include Zolton.org Social Plugin specific style sheet. */
function zosp_style_sheet()
{
	$path = plugins_url('css/zosp-style.css', __FILE__);
		
	wp_register_style('zosp-style', $path);
	wp_enqueue_style('zosp-style');
}
	
add_action('init', 'zosp_style_sheet');

?>
