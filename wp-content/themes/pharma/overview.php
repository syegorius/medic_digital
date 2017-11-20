<?php
/*
Template Name: Overview
*/

$page_id=get_the_ID();

get_header();
echo "<div id=\"page_title\"><div class=\"wrapper\"><h1 class=\"rtl-float-left\">".get_the_title()."</h1><div class=\"clear\"></div></div></div>";
echo "<div id=\"body\"><div class=\"wrapper\"><div class=\"overview\">";
echo get_the_body();
echo "</div>".get_the_button()."</div>";
echo getVideos($page_id);
echo getArticles($page_id);
get_footer();

function get_the_body(){
	$html="<div class=\"overview_content rtl-align-left rtl-float-left\">".do_shortcode(get_the_content())."</div>";
	$html.="<div class=\"overview_icons rtl-float-left\">";
		if( have_rows('counter') ):
			while ( have_rows('counter') ) : the_row();
				$icon=get_sub_field('icon');
				$html.="<div class=\"overfiew_fact\"><div class=\"rtl-float-left overview_counter_icon\"><img src=\"".$icon['url']."\" alt=\"\" /></div>
				<div class=\"rtl-float-left overview_counter_text\">
					<div class=\"rtl-align-left overview_amount\">".get_sub_field('amount')."</div>";
					if(get_fact_link(get_sub_field('amount_of_what_link'))!=""&&get_fact_link(get_sub_field('amount_of_what_link'))!=get_permalink())$html.="<div class=\"rtl-align-left overview_amount_of_what\"><a href=\"".get_fact_link(get_sub_field('amount_of_what_link'))."\">".get_sub_field('amount_of_what')."</a></div>";
					else if(get_sub_field('amount_of_what_external_link')!=""&&get_sub_field('amount_of_what_external_link')!=get_permalink())$html.="<div class=\"rtl-align-left overview_amount_of_what\"><a href=\"".get_sub_field('amount_of_what_external_link')."\">".get_sub_field('amount_of_what')."</a></div>";
					else $html.="<div class=\"rtl-align-left overview_amount_of_what\">".get_sub_field('amount_of_what')."</div>";
					$html.="<div class=\"rtl-align-left overview_amount_of_what_description\">".get_sub_field('amount_of_what_description')."</div>
				</div><div class=\"clear\"></div></div>";
			endwhile;
		else:
		endif;
	$html.="</div><div class=\"clear\"></div>";
	return $html;
}


function get_the_button(){
    $html="";
    
    if( have_rows('button') ):
        while ( have_rows('button') ) : the_row();
            $text=get_sub_field('button_name');
            
            if(get_fact_link(get_sub_field('internal_link'))!=""&&get_fact_link(get_sub_field('internal_link'))!=get_permalink())$link=get_fact_link(get_sub_field('internal_link'));
            else if(get_sub_field('external_link')!=""&&get_sub_field('external_link')!=get_permalink())$link=get_sub_field('external_link');
            else $link="#";
            
            $html.="<a href=\"".$link."\" class=\"overview_button rtl-float-right\">".$text."</a><div class=\"clear\"></div>";
        endwhile;
    endif;
    
    return $html;
}

?>