<?php
/*
Template Name: Archive Guidelines
*/

$page_id=get_the_ID();

get_header();
echo "<div id=\"page_title\"><div class=\"wrapper\"><div class=\"title_icon rtl-float-left\" style=\"background-image:url('".get_template_directory_uri()."/img/folder.png')\"></div><h1 class=\"rtl-float-left\">".get_the_title()."</h1><div class=\"clear\"></div></div></div>";
echo "<div id=\"body\"><div class=\"wrapper\"><div class=\"archive_list\">".get_body()."</div></div></div>";
echo getVideos($page_id);
echo getArticles($page_id);
get_footer();

function get_body(){
	global $post;
        global $page_id;
        
        
        if($page_id&&$page_id>0){
            $meta_query = array(
                array(
                    'key'=> 'pages_%_page', // this should be the first sub-field
                    'value' => $page_id,
                    'compare' => '='
                )
            );
        }
        else $meta_query=array();
        
        
	
	$loop = new WP_Query( array( 'post_type' => 'papers', 'posts_per_page' => -1, 'meta_query' => $meta_query, 'orderby' => 'date', 'order' => 'DESC' ) );
	//$i=0;
        while ( $loop->have_posts() /*&& $i++>9*/) : $loop->the_post();
		$html.="<div class=\"archive rtl-float-left rtl-align-left\">
			<div class=\"archive_title\"><a href=\"".get_the_permalink()."\" target=\"_blank\">".get_the_title()."</a></div>
			<div class=\"archive_description\">".do_shortcode(get_the_content())."</div>
		</div>";
	endwhile; wp_reset_query();
	return $html."<div class=\"clear\"></div>";
}
?>