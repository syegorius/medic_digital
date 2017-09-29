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
        //wp_enqueue_style("cyr_bootstrap",get_template_directory_uri()."/bootstrap/css/bootstrap.min.css",array(),"1.0.0","all");
	wp_enqueue_script("cyr_script",get_template_directory_uri()."/js/script.js",array('jquery'),"1.0.0");
        //wp_enqueue_script("cyr_bootstrap_tether","https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js",array('cyr_script'),"1.0.0");
        //wp_enqueue_script("cyr_bootstrap",get_template_directory_uri()."/bootstrap/js/bootstrap.min.js",array('cyr_bootstrap_tether'),"1.0.0");
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
	
	$where = str_replace("meta_key = 'master_pages_%", "meta_key LIKE 'master_pages_%", $where);
        $where = str_replace("meta_key = 'articles_%", "meta_key LIKE 'articles_%", $where);

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
	//echo $_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI];exit;
	$lilly_password=isset($_REQUEST['lilly_password'])?$_REQUEST['lilly_password']:(isset($_COOKIE['lilly_password'])?$_COOKIE['lilly_password']:'');
        $lilly_email=isset($_REQUEST['lilly_email'])?$_REQUEST['lilly_email']:(isset($_COOKIE['lilly_email'])?$_COOKIE['lilly_email']:'');

	if($lilly_password&&$lilly_email){
		if(isset($page_id)&&$page_id&&$page_id>0){
			$meta_query = array(
				array(
					'key'=> 'password',
					'value' => $lilly_password,
					'compare' => '='
				),
                                array(
					'key'=> 'email',
					'value' => $lilly_email,
					'compare' => '='
				)
			);
		}
		else $meta_query=array();
		$loop = new WP_Query( array( 'post_type' => 'password', 'posts_per_page' => -1, 'meta_query' => $meta_query, 'orderby' => 'date', 'order' => 'DESC' ) );
		while ( $loop->have_posts() ) : $loop->the_post();
                        if(get_field('password')==$lilly_password&&get_field('email')==$lilly_email){
				$lilly_login_error='';
				$lilly_login_form_class='inactive';
				setcookie('lilly_password', $lilly_password, time()+86400*30, '/', $_SERVER["HTTP_HOST"]);
                                setcookie('lilly_email', $lilly_email, time()+86400*30, '/', $_SERVER["HTTP_HOST"]);
				
				//header('Location: '.(isset($_SERVER['HTTPS']) ? "https" : "http") . "://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]);
			}
		endwhile; 
		wp_reset_query();
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

function get_left_side_articles($hover=""){
    
    $articles=get_field("articles");
    
    if(is_array($articles)){
        $html = '<div class="article_links abs">';
        foreach($articles as $k=>$v){
            foreach($v as $article){
                $article_meta=get_post_meta($article->ID);
                $image=wp_get_attachment_metadata( $article_meta['image'][0] );
                $uf=wp_upload_dir();
                //var_dump($article);exit;
                $html.='<div class="article_link '.$hover.'">
                        <div>
                            <div class="red_bg right">'.$article_meta['reference'][0].'</div><a href="'.get_post_permalink($article->ID).'">'.$article->post_title.'</a>
                            <div class="clear"></div>
                        </div>
                        <div class="right article_link_note">'.$article_meta['author'][0].'</div>
                        <input type="hidden" name="image" value="'.$uf['baseurl'].'/'.$image['file'].'" />
                        <div class="clear"></div>
                    </div>';

            }
        }
        $html.='</div>';
    }
    return $html;
}

function get_left_side_articles_($page_ids=false){
    $html = '<div class="article_links abs">';
    
    if($page_ids){
        $meta_query = array(
            array(
                'key' => 'master_pages_%_page', // this should be the first sub-field
                'value' => $page_ids,
                'compare' => 'in'
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
    wp_reset_query();
    return $html .= '</div>';
}

add_action('admin_menu', 'medic_create_menu');

function medic_create_menu(){
    add_menu_page('Medic Settings', 'Medic Settings', 'administrator', 'medic-settings', 'medic_settings_page', 'dashicons-admin-settings', 62);/*plugins_url('/images/icon.png', __FILE__)*/
    add_action('admin_init', 'register_medic_settings');
}

function register_medic_settings(){
    register_setting('medic-settings-group', 'dfp_id');
}

function medic_settings_page(){
    post_medic_settings();

    $checked="";
    
    echo '<div class="wrap">
        <h2>Medic Digital DFP Settings</h2>
        <form method="post" action="" enctype="multipart/form-data">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">DFP ID</th>
                    <td><input type="text" name="dfp_id" value="'.get_option('dfp_id').'" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Website e-mail</th>
                    <td><input type="text" name="website_email" value="'.get_option('website_email').'" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Website phone</th>
                    <td><input type="text" name="website_phone" value="'.get_option('website_phone').'" /></td>
                </tr>
            </table>
            <input type="hidden" name="medic-settings" value="true" />
            <input type="submit" class="button-primary" value="Save changes"/>
        </form>
    </div>';
}

function post_medic_settings(){
    if (!isset($_POST['medic-settings']))return;

    update_option('dfp_id',isset($_POST['dfp_id'])&&isset($_POST['medic-settings'])?$_POST['dfp_id']:0);//get_option($option_name)
    update_option('website_email',isset($_POST['website_email'])&&isset($_POST['medic-settings'])?$_POST['website_email']:0);//get_option($option_name)
    update_option('website_phone',isset($_POST['website_phone'])&&isset($_POST['medic-settings'])?$_POST['website_phone']:0);//get_option($option_name)
}

function get_body_header(){
    $sbl=get_field('spansored_by_logo');
    return '<div id="header">
            <div class="logo left">
                <a href="/"><img src="'.get_template_directory_uri().'/img/logo_sm.png" title="" alt="" /></a>
            </div>


            <div class="right menu" onclick="showHideArticleLinks()">

            </div>
            <div class="right az">
                <div class="az_title">בשיתוף חברת</div>
                <div class="az_logo"><img src="'.$sbl['url'].'" class="imargin" title="" alt="" /></div>
            </div>
            <div class="rd left">
                <div class="left red">
                    <!--<img src="'.get_template_directory_uri().'/img/rd.png" title="" alt="" />-->
                    <div><a class="red" href="'. get_the_permalink().'">'.get_the_title().'</a></div>
                </div>
                <div class="right">'.get_the_content().'</div>
                <div class="clear"></div>
            </div>
        </div>';
}