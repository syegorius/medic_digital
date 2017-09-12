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