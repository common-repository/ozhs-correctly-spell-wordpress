<?php
/*
Plugin Name: Ozh's Correctly Spell WordPress
Plugin URI: http://planetozh.com/blog/my-projects/plugin-to-correctly-spell-wordpress-not-word-press/
Description: Writes WordPress as it should be written. WordPress. Not Wordpress. Not Word Press.
Version: 1.0
Author: Ozh
Author URI: http://planetOzh.com/
*/

/*** Options : edit ******/

$wp_ozh_spell_wordpress['fix_WP'] = true;
		/* Rewrite also occurences of 'WP' ? Correct 'WP' if true, let 'WP' as is if false */

$wp_ozh_spell_wordpress['fix_titles'] = true;
		/* Take care of your posts titles as well ? */
		
$wp_ozh_spell_wordpress['fix_comments'] = true;
		/* What about fixing your commenters' messages as well ? */


/*** Hook magic *****/

add_filter('the_content', 'wp_ozh_spell_wordpress', 100);
if ($wp_ozh_spell_wordpress['fix_comments'])
	add_filter('comment_text', 'wp_ozh_spell_wordpress', 100);
if ($wp_ozh_spell_wordpress['fix_titles'])
	add_filter('the_title', 'wp_ozh_spell_wordpress', 100);


/*** The WordPress-ificator *****/

function wp_ozh_spell_wordpress($text) {
	global $wp_ozh_spell_wordpress;
	
	$patterns = array('/\bword[- ]?press\b/i');
	if ($wp_ozh_spell_wordpress['fix_WP'])
		$patterns[] = '/WP/i';
	
	$replace = 'WordPress';

	$text = preg_replace($patterns, array($replace), $text);
	
	return $text;
	
}

?>