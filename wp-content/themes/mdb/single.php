<?php

setLillyVars();
echo get_header();

$meta_query = array(
    array(
        'key' => 'articles_%_article', // this should be the first sub-field
        'value' => get_the_ID(),
        'compare' => '='
    )
);
//var_dump(get_the_ID());exit;
$loop = new WP_Query( array( 'post_type' => 'page', 'posts_per_page' => -1, 'meta_query' => $meta_query, 'orderby' => 'date', 'order' => 'DESC' ) );
/*if (current_user_can('administrator')){
    global $wpdb;
    echo "<pre>";
    print_r($wpdb->queries);
    echo "</pre>";
}*/
while ( $loop->have_posts() ) : $loop->the_post();
    global $post;
    //print_r($post);exit;
    echo get_body_header();
    $get_left_side_articles=get_left_side_articles();
    break;
endwhile;
wp_reset_query();

echo get_top();

/*$ids="";
$master_pages=get_field("master_pages");
if(is_array($master_pages))foreach($master_pages as $k=>$v){
    foreach($v as $page){
        $ids.=$page->ID.',';
    }
}*/
echo $get_left_side_articles;

echo get_article();

get_footer();

function get_top(){
    $html='<div id="top" class="rel">';
    $img=get_field('image');
    $html.='<img src="'.$img['url'].'" class="imargin bg" title="" alt="" />';
    return $html.='</div>';
}

function get_article(){
    $html='<div id="article" class="wrapper rel">';
    $html.='<div class="red_bg right">'.get_field("reference").'</div><div class="clear"></div>';
    $html.='<div class="article_title">'.get_the_title().'</div>';
    $html.='<div class="article_description">'.get_field("description").'</div>';
    $html.='<div class="article_tags">'.get_field("tags").'</div>';
    $html.='<div class="a_ad_s">
        <div class="right">
            <div class="article_author">'.get_field("author").'</div>
            <div class="article_author_description">'.get_field("author_description").'</div>
        </div>
        <div class="article_social left">
            <div class="left" style="background-image:url(\''.get_template_directory_uri().'/img/print.png\')" onclick="print(\'#article\')"></div>
            <div class="left" style="background-image:url(\''.get_template_directory_uri().'/img/email.png\')"><a href="mailto:'. get_option('website_email').'">&nbsp;</a></div>
            <div class="left" style="background-image:url(\''.get_template_directory_uri().'/img/call.png\')"><a href="call:'. get_option('website_phone').'">&nbsp;</a></div>
            <div class="left" style="background-image:url(\''.get_template_directory_uri().'/img/fb.png\')"><a href="https://www.facebook.com/sharer/sharer.php?u=http://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI].'" target="_blank">&nbsp;</a></div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>';
    $html.='<div class="article_content">'.get_article_content().'</div>';
    $html.='<div class="article_references">'.get_article_references().'</div>';
    return $html."</div>";
}

function get_article_content(){
    $html=get_the_content();
    $first_add_block="<!-- /50454183/MedicDigital-Mobile -->
        <div class='ad'><div id='div-gpt-ad-".get_option('dfp_id')."-3' style=' height:160px;width:646px;'>
        <script>
        googletag.cmd.push(function() { googletag.display('div-gpt-ad-".get_option('dfp_id')."-3'); });
        </script>
        </div></div>
        
        <div class='responsive_ad'><div id='div-gpt-ad-".get_option('dfp_id')."-1' style='height:50px; width:320px;'>
        <script>
        googletag.cmd.push(function() { googletag.display('div-gpt-ad-".get_option('dfp_id')."-1'); });
        </script>
        </div></div>";
    $second_add_block="<!-- /50454183/MedicDigital-Mobile -->
        <div class='ad'><div id='div-gpt-ad-".get_option('dfp_id')."-0' style='width:540px; height:646px;'>
        <script>
        googletag.cmd.push(function() { googletag.display('div-gpt-ad-".get_option('dfp_id')."-0'); });
        </script>
        </div></div>
        
        <div class='responsive_ad'><div id='div-gpt-ad-".get_option('dfp_id')."-2' style='height:480px; width:320px;'>
        <script>
        googletag.cmd.push(function() { googletag.display('div-gpt-ad-".get_option('dfp_id')."-2'); });
        </script>
        </div></div>";
    $html=preg_replace("/[\r\n]+/iu","<br />",$html);
    $html=preg_replace('/<(\w+)\b(?:\s+[\w\-.:]+(?:\s*=\s*(?:"[^"]*"|"[^"]*"|[\w\-.:]+))?)*\s*\/?>\s*<\/\1\s*>/ixsmu',"",$html);
    $html=preg_replace('/(\s*<br[^>]*>)+/iu',"<br />",$html);
    
    $html=preg_replace("/((\s*<br[^>]*>)|(\s*<\/p[^>]*>)|(\s*<\/div[^>]*>))/iu","$1".$first_add_block,$html,1);
    $html=preg_replace("/(((\s*<br[^>]*>)|(\s*<\/p[^>]*>)|(\s*<\/divx[^>]*>))+[\s\S]*?((\s*<br[^>]*>)|(\s*<\/p[^>]*>)|(\s*<\/divx[^>]*>)))/iu","$1".$second_add_block,$html,2);
    return $html;
}

function get_article_references(){
    $html="";
    if( have_rows('references') ):
        $html.='<div class="article_references_title red">ביבליוגרפיה</div>';
 	// loop through the rows of data
        $c=1;
        while ( have_rows('references') ) : the_row();
            $html.='<div class="article_reference">'.$c++.".\t".get_sub_field('reference').'</div>';
        endwhile;

    endif;
    
    return $html;
}