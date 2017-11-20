<?php

setLillyVars();
get_banners();
get_header();
echo get_body_header();
echo get_top();
echo get_left_side_articles("","","_static");
echo get_left_side_articles("");
get_footer();

function get_top(){
    $html='<div id="top" class="rel">';
    //$img=get_field('image');
    $html.='<img src="#" class="imargin bg" title="" alt="" />';
    $html.='<div class="page_details abs pointer"><div class="page_reference red_bg"></div><div class="page_title"></div></div>';
    return $html.='</div>';
}

