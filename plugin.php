<?php
/*
Plugin Name: Chain Feed
Plugin URI: http://mr.hokya.com/chain-feed/
Description: Displays most recent posts of your commentators URLs on each of your posts. This can help you know what they wrote just now.
Version: 2.5
Author: Julian Widya Perdana
Author URI: http://mr.hokya.com/
*/
if (!get_option("chain_feed_items")) update_option("chain_feed_items",10);
if (!get_option("chain_feed_title")) update_option("chain_feed_title","Chain Feed");
function chain_feed () {
	$items = get_option("chain_feed_items");
	$title = get_option("chain_feed_title");
	
	echo "<h3>$title</h3>";
	global $wpdb;
	$p = get_query_var("p");
	$post = get_post($p);
	$postID = $post->ID;
	$urls = $wpdb->get_results("select * from $wpdb->comments where comment_post_ID=$postID order by comment_author_url");
	$valid_urls = array();
	foreach($urls as $urls) {
		$url = $urls->comment_author_url;
		if ($url<>$prevurl) array_push($valid_urls,$url);
		$prevurl = $url;
	}
	$rss = fetch_feed($valid_urls);
	wp_widget_rss_output($rss,"show_date=0&show_summary=0&show_author=0&items=$items");
}

function chain_feed_page () {
	add_options_page("Chain Feed","Chain Feed","manage_options","chain-feed/options.php");
}

add_action('comments_template','chain_feed');
add_action('admin_head','chain_feed_page');
?>