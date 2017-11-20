<?php

/*
Template Name: Homepage
*/
get_header();

//while ( have_posts() ){ 

    //the_post();

    $page_id=get_the_ID();
    //echo $page_id;exit;
    
    echo "<div id=\"body\">".get_body()."</div>";
//}
get_footer();

function get_body(){
	global $post;
        global $langUrl;
        global $page_id;
        //$page_id=get_the_ID();
        
	$html="<div class=\"posts_block\">";
        $overview="";
	
	$loop = new WP_Query( array( 'post_type'=>'page','post_title_equals'=>L('homepage'), 'orderby' => 'date', 'order' => 'DESC' ) );
	while ( $loop->have_posts() ) : $loop->the_post();
                $overview.="<div class=\"wrapper overview_wrapper\">";
                        $motto=get_post_meta($post->ID,'motto');
                        $overview.="<div class=\"overview_motto\">".$motto[0]."</div>";
                        $overview.=getOverviewBlock();
                $overview.="</div>";
		
                $html.=getFivePostsBlock();
        endwhile; wp_reset_query();
	$html.="<div class=\"clear\"></div></div>".$overview;
	
	/*$loop = new WP_Query( array( 'post_type' => 'page', 'post_title_like'=>L('overview'), 'posts_per_page' => -1, 'orderby' => 'date', 'order' => 'DESC' ) );
	$html.="<div class=\"wrapper overview_wrapper\">";
	while ( $loop->have_posts() ) : $loop->the_post();
		$motto=get_post_meta($post->ID,'motto');
		$html.="<div class=\"overview_motto\">".$motto[0]."</div>";
		$html.=getOverviewBlock();
	endwhile; wp_reset_query();
	$html.="</div>";*/
	
        $html.=getVideos($page_id);
	
        /*$loop = new WP_Query( array( 'post_type' => 'companies', 'posts_per_page' => -1, 'orderby' => 'date', 'order' => 'DESC' ) );
	$i=0;
        while ( $loop->have_posts()) : $loop->the_post();
            $i++;
        endwhile; 
	wp_reset_query();*/
        
        $loop = new WP_Query( array( 'post_type' => 'companies', 'posts_per_page' => -1, 'orderby' => 'date', 'order' => 'DESC' ) );
	$html.="<div class=\"wrapper\" style=\"margin-bottom:-150px\"><div class=\"homepage_companies_title\"><a href=\"".get_the_post_type_permalink('companies').$langUrl."\">".L('company')."</a></div><div class=\"homepage_companies\"><div class=\"roller\"><div class=\"gallery_wrapper first\"><div class=\"all\">";
	$j=0;
	while ( $loop->have_posts() /*&& ++$j<=$i/2*/) : $loop->the_post();
                $logo=get_field('logo');
		$html.="<div class=\"gallery_block homepage_company rtl-float-left\"><img src=\"".$logo["url"]."\" alt=\"".get_the_title()."\" /></div>";
	endwhile; 
        $html.="<div class=\"clear\"></div></div><div class=\"clear\"></div></div></div>";
        
        /*$html.="<div class=\"roller\"><div class=\"gallery_wrapper second backwards\"><div class=\"all\">";
        while ( $loop->have_posts()) : $loop->the_post();
		$logo=get_field('logo');
		$html.="<div class=\"gallery_block homepage_company rtl-float-left\"><img src=\"".$logo["url"]."\" alt=\"".get_the_title()."\" /></div>";
	endwhile; 
        $html.="<div class=\"clear\"></div></div><div class=\"clear\"></div></div></div>";
        wp_reset_query();*/
        
        //echo $page_id;exit;
        $html.=getArticles($page_id); 
	
        $html.="</div></div>";
	return $html;
}

//get_footer();

function get_post_picture(){
	$img=get_field('image');
	return isset($img["url"])?$img["url"]:"";
}

function getFivePostsBlock(){
	global $post;
	$html="";
	$post1=get_field('first_post');
	$post2=get_field('second_post');
	$post3=get_field('third_post');
	$post4=get_field('fourth_post');
	$post5=get_field('fifth_post');
	$post=$post1;
	$html.="<div class=\"first_post rtl-float-left rtl-align-left\">
		<img class=\"post_picture imargin\" src=\"".get_post_picture()."\" alt=\"\" />
		<div class=\"post_text_block_background\"></div>
                <div class=\"post_text_block rtl-align-left\">
                        <div class=\"post_type_name rtl-align-left\" style=\"background-image:url('".get_the_post_type_thumbnail($post->post_type)."')\"><a href=\"".get_the_post_type_permalink($post->post_type)."\">".get_the_post_type_name($post->post_type)."</a></div>
			<div class=\"post_title rtl-align-left\"><a href=\"".get_the_permalink()."\" target=\"_blank\">".get_the_title()."</a></div>
			<div class=\"post_description rtl-align-left\">".getFirstSentenceOfTheContent($post->post_content)."</div>
		</div>
	</div>";
	$post=$post2;
	//print_r(get_post_picture());exit;
	$html.="<div class=\"second_third_fourth_and_fifth_post rtl-float-left\"><div class=\"second_and_third_post rtl-float-left rtl-align-left\">
		<div class=\"second_post\">
			<img class=\"post_picture imargin\" src=\"".get_post_picture()."\" alt=\"\" />
			<div class=\"post_text_block_background\"></div>
			<div class=\"post_text_block\">
				<div class=\"post_type_name\" style=\"background-image:url('".get_the_post_type_thumbnail($post->post_type)."')\"><a href=\"".get_the_post_type_permalink($post->post_type)."\">".get_the_post_type_name($post->post_type)."</a></div>
				<div class=\"post_title\"><a href=\"".get_the_permalink()."\" target=\"_blank\">".get_the_title()."</a></div>
			</div>
		</div>";
	$post=$post3;
	$html.="<div class=\"third_post\">
			<img class=\"post_picture imargin\" src=\"".get_post_picture()."\" alt=\"\" />
			<div class=\"post_text_block_background\"></div>
			<div class=\"post_text_block\">
				<div class=\"post_type_name\" style=\"background-image:url('".get_the_post_type_thumbnail($post->post_type)."')\"><a href=\"".get_the_post_type_permalink($post->post_type)."\">".get_the_post_type_name($post->post_type)."</a></div>
				<div class=\"post_title\"><a href=\"".get_the_permalink()."\" target=\"_blank\">".get_the_title()."</a></div>
			</div>
		</div>
	</div>";
	$post=$post4;
	$html.="<div class=\"fourth_and_fifth_post rtl-float-left rtl-align-left\">
		<div class=\"fourth_post\">
			<img class=\"post_picture imargin\" src=\"".get_post_picture()."\" alt=\"\" />
			<div class=\"post_text_block_background\"></div>
			<div class=\"post_text_block\">
				<div class=\"post_type_name\" style=\"background-image:url('".get_the_post_type_thumbnail($post->post_type)."')\"><a href=\"".get_the_post_type_permalink($post->post_type)."\">".get_the_post_type_name($post->post_type)."</a></div>
				<div class=\"post_title\"><a href=\"".get_the_permalink()."\" target=\"_blank\">".get_the_title()."</a></div>
			</div>
		</div>";
	$post=$post5;
	$html.="<div class=\"fifth_post\">
			<img class=\"post_picture imargin\" src=\"".get_post_picture()."\" alt=\"\" />
			<div class=\"post_text_block_background\"></div>
			<div class=\"post_text_block\">
				<div class=\"post_type_name\" style=\"background-image:url('".get_the_post_type_thumbnail($post->post_type)."')\"><a href=\"".get_the_post_type_permalink($post->post_type)."\">".get_the_post_type_name($post->post_type)."</a></div>
				<div class=\"post_title\"><a href=\"".get_the_permalink()."\" target=\"_blank\">".get_the_title()."</a></div>
			</div>
		</div>
	</div><div class=\"clear\"></div></div>";
	
	return $html;
}

function getOverviewBlock(){
	$html="";
	if( have_rows('counter') ):
		$html.="<div class=\"homepage_overview_blocks\">";
		while ( have_rows('counter') ) : the_row();
			$icon=get_sub_field('icon');
			$html.="<div class=\"overview_block rtl-float-left\"><div class=\"overview_counter_icon\"><img src=\"".$icon['url']."\" alt=\"\" /></div>
				<div class=\"overview_amount\">".get_sub_field('amount')."</div>";
				if(get_fact_link(get_sub_field('amount_of_what_link'))!=""&&get_fact_link(get_sub_field('amount_of_what_link'))!=get_permalink())$html.="<div class=\"overview_amount_of_what\"><a href=\"".get_fact_link(get_sub_field('amount_of_what_link'))."\">".get_sub_field('amount_of_what')."</a></div>";
				else if(get_sub_field('amount_of_what_external_link')!=""&&get_sub_field('amount_of_what_external_link')!=get_permalink())$html.="<div class=\"overview_amount_of_what\"><a href=\"".get_sub_field('amount_of_what_external_link')."\">".get_sub_field('amount_of_what')."</a></div>";
				else $html.="<div class=\"overview_amount_of_what\">".get_sub_field('amount_of_what')."</div>";
				$html.="<div class=\"overview_amount_of_what_description\">".get_sub_field('amount_of_what_description')."</div>
			</div>";
		endwhile;
		$html.="<div class=\"clear\"></div></div>";
	else:
	endif;
	return $html;
}

?>