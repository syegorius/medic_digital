<?php

/*
Template Name: Homepage
*/

setLillyVars();

get_header();
while ( have_posts() ) : the_post();
echo "<div id=\"body\">".get_body()."</div>";
endwhile;
get_footer();

function get_body(){
	global $post;
        
	$html='<div class="wallpaper"><div class="wrapper"><img class="wallpapar_logo right" alt="" src="'.get_template_directory_uri().'/img/header-logo.png"/></div></div>';
	$html.='<h1><div class="wrapper"><div class="h1">'.get_the_title().'</div></div></h1>';
	$html.=get_body_leftside().get_body_rightside();
	return $html;
}

function get_post_picture(){
	$img=get_field('image');
	return isset($img["url"])?$img["url"]:"";
}

function get_body_leftside(){
	$x=0;
	$references="";
	$html="<div class=\"wrapper w".$x."\"><div class=\"left_blocks rtl-float-left\">";
	$loop = new WP_Query( array( 'post_type' => 'papers', 'posts_per_page' => -1, 'orderby' => 'date', 'order' => 'ASC' ) );
	while($loop->have_posts()) : $loop->the_post();
        $img=get_field('image');
		$rImg=get_field('responsive_image');
		//$hImg=get_field('hover_image');
		$html.="<div class=\"left_block rtl-float-left".($x++%3==0?" first_col":"")."\">
			<div class=\"bged\">
				<div class=\"title_image_wrapper\"><div class=\"paper_image rtl-float-left\"><a href=\"".get_the_permalink()."\"><img class=\"imargin mouseout\" src=\"".$img["url"]."\" alt=\"".get_the_title()."\" /><img class=\"imargin inactive\" src=\"".$rImg["url"]."\" alt=\"".get_the_title()."\" /></a></div><div class=\"title inactive rtl-float-left\"><a href=\"".get_the_permalink()."\"><span>".get_the_title()."</span></a></div><div class=\"clear\"></div></div>
				<div class=\"paper_description\">".get_the_content()."</div>
				<!--<div class=\"paper_text\">".get_the_content()."</div>-->
				<div class=\"view_presentation inactive\"><a href=\"".get_the_permalink()."\">View presentation</a></div>
				<div class=\"close_paper_text inactive\">Close</div>

				<div class=\"open_paper_text inactive\" onclick=\"showText(this)\">View full indication</div>
			</div>
		</div>";
		$references.="<div class=\"paper_references rtl-float-left\">".preg_replace("/[\r\n]+/iu","<br />",get_field("references"))."</div>";
		if($x%3==0){
			$html.="<div class=\"clear\"></div></div>";
			if($x==3)$html.="<div class=\"right_block rtl-float-right\"></div>";
			$html.="<div class=\"clear\"></div></div>";
			$html.="<div class=\"references_wrapper r".(($x/3)-1)."\"><div class=\"wrapper\"><div class=\"paper_references_title inactive rtl-float-left\" onclick=\"showReferences(this)\">References</div>".$references."<div class=\"clear\"></div><div class=\"close_paper_references inactive\">Close</div></div></div>";
			$references="";
			$html.="<div class=\"wrapper w".($x/3)."\"><div class=\"left_blocks rtl-float-left\">";
		}
	endwhile; 
	if($x%3!=0){
		$html.="<div class=\"clear\"></div></div>";
		
		if($x<3)$html.="<div class=\"right_block rtl-float-right\"></div>";
		$html.="<div class=\"clear\"></div></div>";
		$html.="<div class=\"references_wrapper r".(floor($x/3))."\"><div class=\"wrapper\"><div class=\"paper_references_title inactive rtl-float-left\" onclick=\"showReferences(this)\">References</div>".$references."<div class=\"clear\"></div><div class=\"close_paper_references inactive\" onclick=\"hideReferences(this)\">Close</div></div></div>";
    }
	else{
		$html.="<div class=\"clear\"></div></div>";
		
		if($x<3)$html.="<div class=\"right_block rtl-float-right\"></div>";
		$html.="<div class=\"clear\"></div></div>";
		//$html.="<div class=\"references_wrapper r".(floor($x/3))."\"><div class=\"wrapper\"><div class=\"paper_references_title inactive rtl-float-left\" onclick=\"showReferences(this)\">References</div>".$references."<div class=\"clear\"></div><div class=\"close_paper_references inactive\" onclick=\"hideReferences(this)\">Close</div></div></div>";
		$references="";
	}
	
	return $html;
}

function get_body_rightside(){
	$html="";
	return $html;
}

?>