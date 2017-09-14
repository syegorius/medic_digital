<?php

setLillyVars();

get_header();

echo get_top();
echo get_left_side_articles();
get_footer();

function get_top(){
    $html='<div id="top" class="rel">';
    $img=get_field('image');
    $html.='<img src="'.$img['url'].'" class="imargin bg" title="" alt="" />';
    $html.='<div class="page_details abs"><div class="page_reference red_bg">'.get_field("reference").'</div><div class="page_title">'.get_the_title().'</div></div>';
    return $html.='</div>';
}

function get_left_side_articles($page_id=2){
    $html = '<div class="article_links abs">';
    
    if($page_id&&$page_id>0){
        $meta_query = array(
            array(
                'key' => 'master_pages_%_page', // this should be the first sub-field
                'value' => $page_id,
                'compare' => '='
            )
        );
    }
    else $meta_query=array();
    
    $loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => -1, 'meta_query' => $meta_query, 'orderby' => 'date', 'order' => 'DESC' ) );
    /*if (current_user_can('administrator')){
        global $wpdb;
        echo "<pre>";
        print_r($wpdb->queries);
        echo "</pre>";
    }*/
    while ( $loop->have_posts() ) : $loop->the_post();
        
        $html.='<div class="article_link">
                    <div>
                        <div class="red_bg right">'.get_field("reference").'</div><a href="'.get_the_permalink().'">'.get_the_title().'</a>
                        <div class="clear"></div>
                    </div>
                    <div class="right article_link_note">'.get_field("author").'</div>
                    <div class="clear"></div>
                </div>';
    endwhile;
    return $html .= '</div>';
}