<?php

/*
Template Name: Personnel
*/

$page_id=get_the_ID();
get_header();

echo '<div class="inactive"><svg class="defs-only">
  <filter id="monochrome" color-interpolation-filters="sRGB" x="0" y="0" height="100%" width="100%">
    <feColorMatrix type="matrix" values="0.95 0 0 0 0.05 
              0.85 0 0 0 0.15  
              0.50 0 0 0 0.50 
              0    0 0 1 0" />
  </filter>
</svg></div>';


if( have_rows('personnel_positions_to_display') ):
    $i=1;
    while ( have_rows('personnel_positions_to_display') ) : the_row();
    
        echo "<div id=\"page_title\"><div class=\"wrapper\"><h1 class=\"rtl-float-left\">".get_sub_field('personnel_position_name')."</h1><div class=\"clear\"></div></div></div>";
        echo "<div id=\"body".$i."\"><div class=\"wrapper\"><div class=\"personnel\">";
        echo get_workers(get_sub_field('personnel_position_to_display'));
        echo "</div><div class=\"clear\"></div></div></div>";

    endwhile;
else:
endif;

echo getVideos($page_id);
echo getArticles($page_id);

/*echo "<div id=\"page_title2\"><div class=\"wrapper\"><h1 class=\"rtl-float-left\">".L("workers")."</h1><div class=\"clear\"></div></div></div>";
echo "<div id=\"body2\"><div class=\"wrapper\"><div class=\"personnel\">";
echo get_workers();
echo "</div><div class=\"clear\"></div></div></div>";
 */
get_footer();

/*function get_directors(){
	global $post;
	$he=ICL_LANGUAGE_CODE=="he"?" he":"";
	$html="<div class=\"personnel_detail\"></div><div class=\"roller\"><div class=\"gallery_wrapper rand".rand(0,1000000)." personnel_gallery_wrapper".$he."\"><div class=\"all\">";
	$loop = new WP_Query( array( 'post_type' => 'Personnel', 'posts_per_page' => -1, 'orderby' => 'date', 'order' => 'DESC' ) );
	while ( $loop->have_posts() ) : $loop->the_post();
		if(get_field('director')==true)$html.=get_personel_block($post);
	endwhile; 
	wp_reset_query();
	return $html."<div class=\"clear\"></div></div><div class=\"clear\"></div></div></div>";
}*/

function get_workers($personnel_type){
	global $post;
	$he=ICL_LANGUAGE_CODE=="he"?" he":"";
	$html="<div class=\"personnel_detail\"></div><div class=\"roller\"><div class=\"gallery_wrapper rand".rand(0,1000000)." personnel_gallery_wrapper".$he."\"><div class=\"all\">";
	$loop = new WP_Query( array( 'post_type' => 'Personnel', 'posts_per_page' => -1, 'orderby' => 'date', 'order' => 'DESC' ) );
	while ( $loop->have_posts() ) : $loop->the_post();
		if(get_field('position')==$personnel_type)$html.=get_personel_block($post);
	endwhile; 
	wp_reset_query();
	return $html."<div class=\"clear\"></div></div><div class=\"clear\"></div></div></div>";
}

function get_personel_block($post){
	$face=get_field('image');
	$motto=get_post_meta($post->ID,'motto');
	return "<div class=\"gallery_block rtl-float-left\"><div class=\"round_image\"><img class=\"imargin\" src=\"".$face["url"]."\" alt=\"".get_the_title()."\" /></div><div class=\"personnel_text_block\"><div class=\"personnel_name\">".get_the_title()."</div><div class=\"personnel_motto\">".$motto[0]."</div><div class=\"personnel_content inactive\">".do_shortcode(get_the_content())."</div></div></div>";
}
?>