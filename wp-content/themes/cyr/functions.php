<?php

load_theme_textdomain("pharma");
include "wpml-integration.php";
include "langs.php";
include "menu-customizer.php";

/*include "src/Base.php";
include "src/Html.php";
include "src/Pdf.php";
include "src/Config.php";*/

$langUrl=isset($_REQUEST['lang'])?"?lang=".$_REQUEST['lang']:'';

function cyr_script_enqueue(){
	wp_enqueue_style("cyr_style",get_template_directory_uri()."/css/style.css",array(),"1.0.0","all");
	wp_enqueue_script("cyr_script_1920",get_template_directory_uri()."/js/script.js",array('jquery'),"1.0.0");
	if(isHe())wp_enqueue_style("cyr_rtl",get_template_directory_uri()."/css/rtl.css",array(),"1.0.0","all");
}

add_action("wp_enqueue_scripts","cyr_script_enqueue");

function cyr_theme_setup(){
    add_theme_support("menus");
    register_nav_menu("primary","Primary Header Menu");
}

add_action("init","cyr_theme_setup");

add_action('init', 'my_rem_editor_from_post_type');
function my_rem_editor_from_post_type() {
    remove_post_type_support( 'password', 'editor' );
	remove_post_type_support( 'password', 'title' );
}

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
	return false;//isset($_GET['lang'])&&$_GET['lang']=="he"||ICL_LANGUAGE_CODE=="he";
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

function file_to_download(){
	//return;
    $file = get_field('file');
	//var_dump($file);exit;
    if( !$file ) $file = array('url'=>get_field('file_external_link'));
    if( isset($file['url']) )return $file['url'];
	
	
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

function isInsideFrame(){
	if(isset($_REQUEST['framed'])){
		echo getFromUrl('https://docviewer.yandex.ru/?url='.urldecode($_REQUEST['framed']));
		exit;
	}
}

function getFromUrl($url, $post = '', $loop = 0){
	$ch = curl_init();
	$host = preg_replace("/^http[s]?:\/\/([^\/\?\&\=]+)[\s\S]*/iu","$1",$url);
	$http = preg_replace("/^(http[s]?).*$/iu","$1",$url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_VERBOSE, 1);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_URL, $url);
	$headers = array(
				'Host: '.$host, 
				'User-agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.2.13) Gecko/20101203 Firefox/3.6.13',
				'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
				'Accept-Language: ru-ru,ru;q=0.8,en-us;q=0.5,en;q=0.3',
				'Accept-Encoding: gzip,deflate',
				'Accept-Charset: windows-1251,utf-8;q=0.7,*;q=0.7',
				'Keep-Alive:115',
				'Connection: keep-alive'
				);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_ENCODING, 1);
	if($post){
		curl_setopt($ch, CURLOPT_POST, $post?true:false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	}
	if(preg_match("/^https/iu",$url))curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	$response = curl_exec($ch);
	$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
	$headers = mb_substr($response, 0, $header_size, 'UTF-8');
	$full = mb_substr($response, $header_size, mb_strlen($response,'UTF-8'), 'UTF-8');
	curl_close($ch);
	if(preg_match("/location\s*\:/iu",$headers)){
		$location = trim(preg_replace("/^[\s\S]*?location\s*\:\s*([^\r\n]+)[\s\S]*$/iu","$1",$headers));
		if(!preg_match("/^http/iu",$location))$location=preg_replace("/^\/?/iu",$http."://".$host."/",$location);
		if($location!=$url&&$loop<5)return $this->getFromUrl($location,'',++$loop);
	}
	return $full;
}

$lilly_login_error='הסיסמה אינה נכונה, אנא פנה לנציג לילי לקבלת סיסמה חדשה';
$lilly_login_form_class='active';

function setLillyVars(){
	global $lilly_login_error;
	global $lilly_login_form_class;
	
	$lilly_password=isset($_REQUEST['lilly_password'])?$_REQUEST['lilly_password']:(isset($_COOKIE['lilly_password'])?$_COOKIE['lilly_password']:'');

	if($lilly_password){
		if(isset($page_id)&&$page_id&&$page_id>0){
			$meta_query = array(
				array(
					'key'=> 'password',
					'value' => $lilly_password,
					'compare' => '='
				)
			);
		}
		else $meta_query=array();
		$loop = new WP_Query( array( 'post_type' => 'password', 'posts_per_page' => -1, 'meta_query' => $meta_query, 'orderby' => 'date', 'order' => 'DESC' ) );
		while ( $loop->have_posts() ) : $loop->the_post();
            if(get_field('password')==$lilly_password){
				$lilly_login_error='';
				$lilly_login_form_class='inactive';
				setcookie('lilly_password', $lilly_password, time()+86400*30, '/', $_SERVER["HTTP_HOST"]);
			}
		endwhile; 
		
		if(!isset($_REQUEST['submit']))$lilly_login_error='';
	}
	else $lilly_login_error='';
}

function get_lilly_login_form_class(){
	global $lilly_login_form_class;
	return $lilly_login_form_class;
}

function get_lilly_login_error(){
	global $lilly_login_error;
	return $lilly_login_error;
}

/*function convertPDF2HTML($file){
	return"";
	$bin = new PdfToHtml;
	//$file = __DIR__.'/source/test.pdf';
	$this->assertTrue(file_exists($file));
	$this->bin->open($file);
	$this->bin->setOutputDirectory(__DIR__.'/results');

	$this->bin->generate();
	$this->assertTrue(count(scandir(__DIR__.'/results'))>=3);

	$this->bin->clearOutputDirectory();
}*/

/*function getVideos($page_id=false){
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
    add_menu_page('Pharma Settings', 'Pharma Settings', 'administrator', 'pharma-settings', 'pharma_settings_page', 'dashicons-admin-settings', 62);
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
}*/