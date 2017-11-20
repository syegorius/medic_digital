<?php

sendMail();
setLillyVars();
get_banners();
$header=get_header();

$meta_query = array(
    array(
        'key' => 'articles_%_article', // this should be the first sub-field
        'value' => get_the_ID(),
        'compare' => '='
    )
);
$loop = new WP_Query( array( 'post_type' => 'page', 'posts_per_page' => -1, 'meta_query' => $meta_query, 'orderby' => 'date', 'order' => 'DESC' ) );
while ( $loop->have_posts() ) : $loop->the_post();
    global $post;
    $bodyHeader=get_body_header();
    $get_left_side_articles=get_left_side_articles('no_roller','position:absolute');
endwhile;
wp_reset_query();

echo $header.$bodyHeader;
echo get_top();

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
    $html.='<h1 class="article_title" style="font-weight:normal">'.get_the_title().'</h1>';
    $html.='<div class="article_description">'.get_field("description").'</div>';
    $html.='<div class="article_tags">'.get_field("tags").'</div>';
    $html.='<div class="a_ad_s">
        <div class="right">
            <div class="article_author">'.get_field("author").'</div>
            <div class="article_author_description">'.get_field("author_description").'</div>
        </div>
        <div class="article_social left">
            <div class="left print" onclick="print(\'#article\')"></div>
            <div class="left email" onclick="showDif(\'mail\')"><a href="#">&nbsp;</a></div>
            <div class="left call whatsup"><a href="whatsapp://send?text='.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI].'" data-action="share/whatsapp/share">&nbsp;</a></div>
            <div class="left fb"><a href="https://www.facebook.com/sharer/sharer.php?u=http://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI].'" target="_blank">&nbsp;</a></div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>';
    $html.='<div class="article_content">'.get_article_content().'</div>';
    $html.='<div class="article_references">'.get_article_references().'</div>';
    return $html."</div>";
}

function get_article_content(){
	global $banners;
    $html=do_shortcode(get_the_content());
    
	$first_add_block="<!-- /50454183/MedicDigital-Mobile -->
        <div class='ad' style='margin-top:30px;margin-bottom:30px'><div id='div-gpt-ad-".get_option('dfp_id')."-3' style=' height:160px;width:646px;'>
        <script>
        googletag.cmd.push(function() { googletag.display('div-gpt-ad-".get_option('dfp_id')."-3'); });
        </script>
        </div></div>";
    $second_add_block="<!-- /50454183/MedicDigital-Mobile -->
        <div class='ad' style='margin-top:30px;'><div id='div-gpt-ad-".get_option('dfp_id')."-0' style='height:540px; width:646px;'>
        <script>
        googletag.cmd.push(function() { googletag.display('div-gpt-ad-".get_option('dfp_id')."-0'); });
        </script>
        </div></div>";
	
	$show_giga_banner=get_field("show_giga_banner");
	$show_stripe_banner=get_field("show_stripe_banner");
	if(!is_array($show_giga_banner)||!isset($show_giga_banner[0]))$second_add_block='';
	if(!is_array($show_stripe_banner)||!isset($show_stripe_banner[0]))$first_add_block='';
	
	if(isset($banners['giga']))$second_add_block="<div class='ad' style='margin-top:30px;margin-bottom:30px'><div style='width:100%'>".(isset($banners['giga']['link'])?'<a href="'.$banners['giga']['link'].'" target="_blank">':'')."<img src='".$banners['giga']['img']."' style='width:100%' alt='' />".(isset($banners['giga']['link'])?'</a>':'')."</div></div>";
	if(isset($banners['stripe']))$first_add_block="<div class='ad' style='margin-top:30px;margin-bottom:30px'><div style='width:100%'>".(isset($banners['stripe']['link'])?'<a href="'.$banners['stripe']['link'].'" target="_blank">':'')."<img src='".$banners['stripe']['img']."' style='width:100%' alt='' />".(isset($banners['stripe']['link'])?'</a>':'')."</div></div>";
		
    $html=preg_replace('/(<iframe[^>]*>)\s*(<\/iframe>)/iu',"$1&nbsp;$2",$html);
    $html=preg_replace('/<(\w+)\b(?:\s+[\w\-.:]+(?:\s*=\s*(?:"[^"]*"|"[^"]*"|[\w\-.:]+))?)*\s*\/?>\s*<\/\1\s*>/ixsmu',"",$html);
    
	$html=$first_add_block.$html.$second_add_block;
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