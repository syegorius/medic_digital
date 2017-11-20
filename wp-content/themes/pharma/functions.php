<?php

load_theme_textdomain("pharma");
include "wpml-integration.php";
include "langs.php";
include "menu-customizer.php";

$langUrl=isset($_REQUEST['lang'])?"?lang=".$_REQUEST['lang']:'';

function modify_jquery_version() {
    if(!is_admin()){
        wp_deregister_script('jquery');
        wp_register_script('jquery','http://ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.min.js', false, '2.0.s');
        wp_enqueue_script('jquery');
    }
}
add_action('init', 'modify_jquery_version');

function pharma_israel_script_enqueue(){
	wp_enqueue_style("pharma_israel_style",get_template_directory_uri()."/css/style.css",array(),"1.0.0","all");
	wp_enqueue_script("pharma_israel_script_1920",get_template_directory_uri()."/js/script_1920.js",array( 'jquery' ),"1.0.0");
	//wp_enqueue_script("pharma_israel_jquery","http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js",array(),"1.0.0");
	//wp_enqueue_script("pharma_israel_script_1920",get_template_directory_uri()."/js/script_1920.js",array( 'pharma_israel_jquery' ),"1.0.0");
	if(isHe())wp_enqueue_style("pharma_israel_rtl",get_template_directory_uri()."/css/rtl.css",array(),"1.0.0","all");
}

add_action("wp_enqueue_scripts","pharma_israel_script_enqueue");

function pharma_israel_theme_setup(){
	add_theme_support("menus");
	register_nav_menu("primary","Primary Header Menu");
	register_nav_menu("secondary","Footer Menu");
}

add_action("init","pharma_israel_theme_setup");

add_action('admin_head','styles_admin');

function styles_admin(){
    if(isHe()){
        echo "<style>input,textarea{direction:rtl}</style>";
    }
}

add_filter( 'posts_where', 'title_like_posts_where', 10, 2 );
function title_like_posts_where( $where, &$wp_query ) {
    global $wpdb;
    if ( $post_title_like = $wp_query->get( 'post_title_like' ) ) {
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'' . esc_sql( $wpdb->esc_like( $post_title_like ) ) . '%\'';
    }
    return $where;
}

add_filter( 'posts_where', 'title_equals_posts_where', 10, 2 );
function title_equals_posts_where( $where, &$wp_query ) {
    global $wpdb;
    if ( $post_title_like = $wp_query->get( 'post_title_equals' ) ) {
        $where .= ' AND ' . $wpdb->posts . '.post_title = \'' . esc_sql( $wpdb->esc_like( $post_title_like ) ) . '\'';
    }
    return $where;
}

function isHe(){
	return isset($_GET['lang'])&&$_GET['lang']=="he"||ICL_LANGUAGE_CODE=="he";
}

function getFirstSentenceOfTheContent($content){
	return preg_replace("/^([^\.\r\n]*?)[\.\r\n].*$/iu","$1",preg_replace("/<[^>]*>/iu","",$content));
}

function get_the_post_type_permalink($post_type){
	return "/".L($post_type.'_link').'/'.(isset($_GET['lang'])?'?lang='.$_GET['lang']:"");
}

function get_the_post_type_name($post_type){
	return L($post_type);
}

function get_the_post_type_thumbnail($post_type){
	return get_template_directory_uri()."/img/".heToEn($post_type).".png";
}

function get_fact_link($post_object){
    return get_permalink($post_object->ID);
}

function get_single_body(){
    echo "<div id=\"page_title\"><div class=\"wrapper\"><h1 class=\"rtl-float-left\">".get_the_title()."</h1><div class=\"clear\"></div></div></div>";
    echo "<div class=\"wrapper\"><div class=\"content\">".do_shortcode(get_the_content())."</div></div>";
}

function file_to_download(){
    $file = get_field('file');
    if( !$file ) $file = array('url'=>get_field('file_external_link'));
    
    if( isset($file['url']) ){
        if(trim(preg_replace("/<[^>]*>/iu","",get_the_content())))return "<div class=\"wrapper\"><a class=\"attachment\" href=".$file['url'].">".$file['filename']."</a></div>";
        else /*if(preg_match("/\.pdf[\?]*$/iu",$file['url']))*/{
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="' . basename($file['url']) . '"');
            header('Content-Transfer-Encoding: Binary');
            readfile($file['url']);
        }
        /*else{
            header('Content-Type: application/octet-stream');
            header("Content-Transfer-Encoding: Binary"); 
            header("Content-disposition: attachment; filename=\"" . basename($file['url']) . "\""); 
            readfile($file['url']);
        }*/
    }
    
}

function my_posts_where( $where ) {
	
	$where = str_replace("meta_key = 'pages_%", "meta_key LIKE 'pages_%", $where);

	return $where;
}

add_filter('posts_where', 'my_posts_where');

function getVideos($page_id=false){
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
    
    $videos="";
    $loop = new WP_Query( array( 'post_type' => 'video', 'posts_per_page' => -1, 'meta_query' => $meta_query, 'orderby' => 'date', 'order' => 'DESC' ) );
    while ( $loop->have_posts() ) : $loop->the_post();
            $videos.=get_video_block($post);
    endwhile; 
    wp_reset_query();
    
    if($videos){
        $html="<div class=\"videos\"><div class=\"wrapper\"><div class=\"roller\"><div class=\"gallery_wrapper infinite video_gallery_wrapper".(isHe()?" he":"")."\"><div class=\"all\">";
        $html.=$videos;
        $html.="<div class=\"clear\"></div></div><div class=\"clear\"></div></div></div></div></div>";
    }
    return $html;
}

function get_video_block($post){
	$img=get_field('video_image');
	$file=get_field('video');
	$yt=get_field('video_from_youtube');
        if($yt)$file=$yt;
	else if(isset($file["url"])&&$file["url"])$file=$file["url"];
	return "<div class=\"gallery_block rtl-float-left\"><div class=\"video\"><input type=\"hidden\" value=\"".$file."\" /><img class=\"imargin\" src=\"".$img["url"]."\" alt=\"".get_the_title()."\" /><div class=\"video_play_icon\"><img src=\"".get_template_directory_uri()."/img/play.png\" alt=\"\" class=\"play\" /></div><div class=\"video_name\" title=\"".get_the_title()."\">".get_the_title()."</div></div></div>";
}

function getArticles($page_id=false){
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
    
    $articles="";
    $loop = new WP_Query( array( 'post_type'=>'papers', 'posts_per_page' => 9, 'meta_query' => $meta_query, 'orderby' => 'date', 'order' => 'DESC' ) );
    while ( $loop->have_posts() ) : $loop->the_post();
            $articles.=get_articles_block($post);
    endwhile; 
    wp_reset_query();
    
    if($articles){
        $html.="<div class=\"guidelines\"><div class=\"wrapper\"><div class=\"roller\"><div class=\"gallery_wrapper infinite guidelines_gallery_wrapper".(isHe()?" he":"")."\"><div class=\"all\">";
        $html.=$articles;
        $html.="<div class=\"clear\"></div></div><div class=\"clear\"></div></div></div><!--<a href=\"#\" class=\"guideline_button rtl-float-left\">".L("archive_guidelines_and_papers")."</a><div class=\"clear\"></div>--></div></div>";
    }
    return $html;
}

function get_articles_block($post){
	global $post;
	$img=get_field('image');
	return "<div class=\"gallery_block rtl-float-left\"><div class=\"guideline\"><img class=\"imargin\" src=\"".$img["url"]."\" alt=\"".get_the_title()."\" /><div class=\"guideline_background\"></div><div class=\"guideline_name rtl-align-left\"><div class=\"post_type_name rtl-align-left\" style=\"background-image:url('".get_the_post_type_thumbnail($post->post_type)."')\"><a href=\"".get_the_post_type_permalink($post->post_type)."\">".get_the_post_type_name($post->post_type)."</a></div><div class=\"guideline_title\"><a href=\"".get_post_permalink()."\" target=\"_blank\">".get_the_title()."</a></div></div></div><div class=\"guideline_description  rtl-align-left\"><div>".getFirstSentenceOfTheContent(get_the_content())."</div></div></div>";
}

add_action('admin_menu', 'pharma_create_menu');

function pharma_create_menu(){
    add_menu_page('Pharma Settings', 'Pharma Settings', 'administrator', 'pharma-settings', 'pharma_settings_page', 'dashicons-admin-settings', 62);/*plugins_url('/images/icon.png', __FILE__)*/
    add_action('admin_init', 'register_pharma_settings');
}

function register_pharma_settings(){
    register_setting('pharma-settings-group', 'logo_attachment_id');
}

function pharma_settings_page(){
    post_pharma_settings();

    $checked="";
    if(get_option('show_language'))$checked=" checked=\"checked\"";
    echo '<div class="wrap">
        <h2>Pharma-Israel General Settings</h2>
        <form method="post" action="" enctype="multipart/form-data">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Show language</th>
                    <td><input type="checkbox" name="show_language"'.$checked.' /></td>
                </tr>
            </table>
            <input type="hidden" name="pharma-settings" value="true" />
            <input type="submit" class="button-primary" value="Save changes"/>
        </form>
    </div>';
}

function post_pharma_settings(){
    if (!isset($_POST['pharma-settings']))return;

    update_option('show_language',isset($_POST['pharma-settings'])&&$_POST['show_language']=="on"?true:false);//get_option($option_name)
}