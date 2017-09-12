<?php

/*
Template Name: Videos
*/
setLillyVars();
get_header();
while ( have_posts() ) : the_post();
echo "<div id=\"body\"><div class=\"wrapper\">".get_body()."</div></div>";
endwhile;
get_footer();

function get_body(){
	$html="<div class=\"clear\"></div><div class=\"video_title_image_wrapper\"><div class=\"videos_image rtl-float-left\"><img class=\"imargin\" src=\"".get_template_directory_uri()."/img/icons/videos.png\" alt=\"".get_the_title()."\" /></div><div class=\"title rtl-float-left\">".get_the_title()."</div><div class=\"clear\"></div></div><div class=\"clear\"></div>";
	
	$x=0;
	$loop = new WP_Query( array( 'post_type' => 'video', 'posts_per_page' => -1, 'orderby' => 'date', 'order' => 'DESC' ) );
    while ( $loop->have_posts() ) : $loop->the_post();
            
			$img=get_field('video_image');
			$file=get_field('video');
			$yt=get_field('video_from_youtube');
			if($yt)$file=$yt;
			else if(isset($file["url"])&&$file["url"])$file=$file["url"];
			$video="<div class=\"gallery_block rtl-float-left".($x++%3==0?" no_margin":"")."\">
						<div class=\"video\">
							<input type=\"hidden\" value=\"".$file."\" />
							<img class=\"imargin\" src=\"".$img["url"]."\" alt=\"".get_the_title()."\" />
							<div class=\"video_play_icon\">
							<img src=\"".get_template_directory_uri()."/img/play.png\" alt=\"\" class=\"play\" />
							</div>
						</div>
						<div class=\"video_name\" title=\"".get_the_title()."\"><img src=\"".get_template_directory_uri()."/img/video.png\" class=\"video_icon rtl-float-left\" alt=\"\"><div class=\"video_text rtl-float-left\">".preg_replace("/^(((^|\s+)[^\s]+){5})[\s\S]+?$/iu","$1...",get_the_title())."</div><div class=\"clear\"></div></div>
						<div class=\"video_description\" title=\"".get_the_content()."\">".get_the_content()."</div>
						<div class=\"watch_now\">>Watch now</div>
					</div>";
			
			$html.=$video;//.preg_replace("/no_margin/iu","",$video.$video);
	endwhile; 
    wp_reset_query();
	
	return $html;
}

function get_video_block($post){
	
}