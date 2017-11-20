<?php
/*
Template Name: Conferences
*/
$page_id=get_the_ID();

get_header();
echo "<div id=\"page_title\"><div class=\"wrapper\"><div class=\"title_icon rtl-float-left\" style=\"background-image:url('".get_template_directory_uri()."/img/calendar.png')\"></div><h1 class=\"rtl-float-left\">".get_the_title()."</h1><div class=\"clear\"></div></div></div>";
echo "<div id=\"body\"><div class=\"wrapper\"><div class=\"conference_list\">".get_body()."</div></div></div>";
echo getVideos($page_id);
echo getArticles($page_id);
get_footer();

function get_body(){
	global $post;
	$html="";
	$i=0;
	$loop = new WP_Query( array( 'post_type' => 'event', 'posts_per_page' => -1, 'orderby' => 'date', 'order' => 'DESC' ) );
	while ( $loop->have_posts() ) : $loop->the_post();
		$conference_file="";
		if(get_field('external_file_url')){
			$conference_file="<div class=\"conference_file\">
				<div class=\"conference_file_description rtl-float-left\"><a href=\"".get_field('external_file_url')."\">".get_the_pharma_conference_description(get_field('external_file_url'))."</a></div>
				<div class=\"conference_file_icon rtl-float-left\">".get_the_pharma_conference_icon(array('url'=>get_field('external_file_url')))."</div>
				<div class=\"clear\"></div>
			</div>";
		}
		else{
			$conference_file="<div class=\"conference_file\">
				<div class=\"conference_file_description rtl-float-left\"><a href=\"".get_the_pharma_conference_description_file_url(get_field('file'))."\">".get_the_pharma_conference_description(get_field('file'))."</a></div>
				<div class=\"conference_file_icon rtl-float-left\">".get_the_pharma_conference_icon(get_field('file'))."</div>
				<div class=\"clear\"></div>
			</div>";
		}
		$html.="<div class=\"conference rtl-float-left\">
			<div class=\"conference_date\">
				<div class=\"conference_date_day rtl-float-left\">".getDay(get_field('date'))."</div>
				<div class=\"conference_date_month_year rtl-float-left\">
					<div class=\"conference_date_month rtl-float-left\">".L("month".getMonth(get_field('date')))."</div>
					<div class=\"conference_date_coma rtl-float-left\">,</div>
					<div class=\"conference_date_year rtl-float-left\">".getYear(get_field('date'))."</div>
					<div class=\"clear\"></div>
				</div>
				<div class=\"clear\"></div>
			</div>
			<div class=\"conference_title\"><a href=\"".get_the_permalink()."\">".get_the_title()."</a></div>
			<div class=\"conference_description\">".do_shortcode(get_the_content())."</div>
			".$conference_file."
		</div>";
		
		if(++$i%3==0)$html.="<div class=\"clear\"></div>";
		
		/*$html.="<div class=\"conference rtl-float-left\">
			<div class=\"conference_date\">
				<div class=\"conference_date_day rtl-float-left\">".get_the_time('d')."</div>
				<div class=\"conference_date_month_year rtl-float-left\">
					<div class=\"conference_date_month rtl-float-left\">".L("month".get_the_time('m'))."</div>
					<div class=\"conference_date_coma rtl-float-left\">,</div>
					<div class=\"conference_date_year rtl-float-left\">".get_the_time('Y')."</div>
					<div class=\"clear\"></div>
				</div>
				<div class=\"clear\"></div>
			</div>
			<div class=\"conference_title\"><a href=\"".get_the_permalink()."\">".get_the_title()."</a></div>
			<div class=\"conference_description\">".get_the_content()."</div>
			<div class=\"conference_file\">
				<div class=\"conference_file_description rtl-float-left\"><a href=\"".get_the_pharma_conference_description_file_url(get_field('file'))."\">".get_the_pharma_conference_description(get_field('file'))."</a></div>
				<div class=\"conference_file_icon rtl-float-left\">".get_the_pharma_conference_icon(get_post_meta($post->ID,'file'))."</div>
				<div class=\"clear\"></div>
			</div>
		</div>";
		
		if(++$i%3==0)$html.="<div class=\"clear\"></div>";*/
		
	endwhile; wp_reset_query();
	return $html."<div class=\"clear\"></div>";
}

function get_the_pharma_conference_icon($filename){
	$img="detail";
	if(preg_match("/\.(mp3|wav)(\?.*)?$/iu",isset($filename["url"])?$filename["url"]:$filename))$img="listen";
	else if(preg_match("/(\.(mp4|flv|mpeg)(\?.*)?$)|(youtube|vimeo)/iu",isset($filename["url"])?$filename["url"]:$filename))$img="view";
	//var_dump(preg_match("/(\.(mp4|flv|mpeg)(\?.*)?$)|(youtube|vimeo)/iu",isset($filename["url"])?$filename["url"]:$filename));
	return "<img src=\"".get_template_directory_uri()."/img/".$img.".png\" alt=\"\" />";
}

function get_the_pharma_conference_description($filename){
	return get_field("file_name");//L("details");
}

function get_the_pharma_conference_description_file_url($filename){
    return isset($filename['url'])?$filename['url']:"#";
}

function getDay($date){
    return preg_replace("/([0-9]+)[^0-9]+([0-9]+)[^0-9]+([0-9]+)/iu","$1",trim($date));
}

function getMonth($date){
    return preg_replace("/([0-9]+)[^0-9]+([0-9]+)[^0-9]+([0-9]+)/iu","$2",trim($date));
}

function getYear($date){
    return preg_replace("/([0-9]+)[^0-9]+([0-9]+)[^0-9]+([0-9]+)/iu","$3",trim($date));
}
?>