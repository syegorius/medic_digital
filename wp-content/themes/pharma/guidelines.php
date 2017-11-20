<?php

/*
Template Name: Guidelines
*/
$page_id=get_the_ID();

get_header();
echo "<div id=\"page_title\"><div class=\"wrapper\"><div class=\"title_icon rtl-float-left\" style=\"background-image:url('".get_template_directory_uri()."/img/guidelines.png')\"></div><h1 class=\"rtl-float-left\">".get_the_title()."</h1><div class=\"clear\"></div></div></div>";
echo "<div id=\"body\">".get_body()."</div>";
echo getVideos($page_id);
get_footer();

function get_body(){
        global $page_id;
        
	$html="<div class=\"wrapper\"><div class=\"guideline_main_description\">".do_shortcode(get_the_content())."</div></div>";
        $html.=getArticles($page_id);
        $html.=get_the_button();
	
	return $html;
}

function get_the_button(){
    $html="<div class=\"wrapper\">";
    
    if( have_rows('button') ):
        while ( have_rows('button') ) : the_row();
            $text=get_sub_field('button_name');
            
            if(get_fact_link(get_sub_field('internal_link'))!=""&&get_fact_link(get_sub_field('internal_link'))!=get_permalink())$link=get_fact_link(get_sub_field('internal_link'));
            else if(get_sub_field('external_link')!=""&&get_sub_field('external_link')!=get_permalink())$link=get_sub_field('external_link');
            else $link="#";
            
            $html.="<a href=\"".$link."\" class=\"guideline_button rtl-float-left\">".$text."</a><div class=\"clear\"></div>";
        endwhile;
    endif;
    
    //"<!--<a href=\"#\" class=\"guideline_button rtl-float-left\">".L("archive_guidelines_and_papers")."</a><div class=\"clear\"></div>-->"
    return $html."</div>";
}

?>