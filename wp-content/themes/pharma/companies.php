<?php

/*
Template Name: Companies
*/

$page_id=get_the_ID();

get_header();
echo "<div id=\"page_title\"><div class=\"wrapper\"><h1 class=\"rtl-float-left\">".get_the_title()."</h1><div class=\"clear\"></div></div></div>";
echo "<div id=\"body\"><div class=\"wrapper\"><div class=\"company_list\">".get_body()."</div></div></div>";
echo getVideos($page_id);
echo getArticles($page_id);
get_footer();

function get_body(){
	global $post;
	$html="";
	$loop = new WP_Query( array( 'post_type' => 'companies', 'posts_per_page' => -1, 'orderby' => 'date', 'order' => 'DESC' ) );
	while ( $loop->have_posts() ) : $loop->the_post();
		//var_dump(get_field('logo'));exit;
		$website=get_post_meta($post->ID,'website');
		$logo=get_field('logo');
		$contacts=get_post_meta($post->ID,'contacts');
		$html.="<div class=\"company rtl-float-left rtl-align-left\">
			<div class=\"company_logo\"><img src=\"".$logo["url"]."\" alt=\"".get_the_title()."\" /></div>
			<div class=\"company_title\">".get_the_title()."</div>
			<div class=\"company_contacts\">".preg_replace("/[\r\n]+/iu","<br />",$contacts[0])."</div>
			<div class=\"company_website\"><a href=\"".$website[0]."\">".L("website")."</a></div>
		</div>";
	endwhile; wp_reset_query();
	return $html."<div class=\"clear\"></div>";
}

get_footer();

?>