<?php

setLillyVars();

get_header();

echo get_top();
echo get_left_side_articles(get_the_ID());
get_footer();

function get_top(){
    $html='<div id="top" class="rel">';
    $img=get_field('image');
    $html.='<img src="'.$img['url'].'" class="imargin bg" title="" alt="" />';
    $html.='<div class="page_details abs"><div class="page_reference red_bg">'.get_field("reference").'</div><div class="page_title">'.get_the_title().'</div></div>';
    return $html.='</div>';
}

