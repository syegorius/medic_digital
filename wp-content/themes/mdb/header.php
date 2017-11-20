<!doctype html><html debug="true">
<head>



<script async='async' src='https://www.googletagservices.com/tag/js/gpt.js'></script>

<script>
  var googletag = googletag || {};
  googletag.cmd = googletag.cmd || [];
</script>
 
<script>
  googletag.cmd.push(function() {
    /*googletag.defineSlot('/50454183/MedicDigitalMagazine/Giga540x646', [540, 646], 'div-gpt-ad-<?php echo get_option('dfp_id') ?>-0').addService(googletag.pubads());
    googletag.defineSlot('/50454183/MedicDigitalMagazine/MobileStripe320x50', [320, 50], 'div-gpt-ad-<?php echo get_option('dfp_id') ?>-1').addService(googletag.pubads());
    googletag.defineSlot('/50454183/MedicDigitalMagazine/Splash320x480', [320, 480], 'div-gpt-ad-<?php echo get_option('dfp_id') ?>-2').addService(googletag.pubads());
    googletag.defineSlot('/50454183/MedicDigitalMagazine/Stripe160x646', [160,646], 'div-gpt-ad-<?php echo get_option('dfp_id') ?>-3').addService(googletag.pubads());
    */
	
	//googletag.defineSlot('/50454183/MedicDigitalMagazine/Giga540x646', [646, 540], 'div-gpt-ad-1507640039462-0').addService(googletag.pubads());
    //googletag.defineSlot('/50454183/MedicDigitalMagazine/Stripe160x646', [646, 160], 'div-gpt-ad-1507640039462-1').addService(googletag.pubads());
    	
	googletag.defineSlot('/50454183/MedicDigitalMagazine/Giga540x646', [646, 540], 'div-gpt-ad-<?php echo get_option('dfp_id') ?>-0').addService(googletag.pubads());
    googletag.defineSlot('/50454183/MedicDigitalMagazine/MobileStripe320x50', [320, 50], 'div-gpt-ad-<?php echo get_option('dfp_id') ?>-1').addService(googletag.pubads());
    googletag.defineSlot('/50454183/MedicDigitalMagazine/Splash320x480', [320, 480], 'div-gpt-ad-<?php echo get_option('dfp_id') ?>-2').addService(googletag.pubads());
    googletag.defineSlot('/50454183/MedicDigitalMagazine/Stripe160x646', [646, 160], 'div-gpt-ad-<?php echo get_option('dfp_id') ?>-3').addService(googletag.pubads());
   
	
	googletag.pubads().enableSingleRequest();
    <?php
        $title_words=preg_split("/[^\p{Hebrew}a-z]+/iu",get_the_title());
        //foreach($title_words as $word)echo "googletag.pubads().setTargeting('Magazine','".$word."');\r\n";
        //echo "googletag.pubads().setTargeting('Magazine','test');\r\n";
		//echo "googletag.pubads().setTargeting('Magazine',['second-post','test','post1']);\r\n";
		echo "googletag.pubads().setTargeting('Magazine','".preg_replace("/(^[\/]+)|([\/]+$)/iu","",$_SERVER['REQUEST_URI'])."');\r\n";
    ?>
    googletag.enableServices();
	//googletag.addService(googletag.pubads()).setTargeting('Magazine',['second-post','test','post1']);
  });
</script>


<!--<script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script>-->
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php is_front_page() ? bloginfo('name') : wp_title(''); ?></title>
<?php $get_template_directory_uri=get_template_directory_uri(); ?>
<script type="text/javascript">var currentLang="<?php //echo ICL_LANGUAGE_CODE; ?>en",pathToImgFolder="<?php echo $get_template_directory_uri; ?>"</script>
<?php wp_head(); ?>



<script>
<?php
/*$show_splash_banner=get_field("show_splash_banner");
$show_mobile_banner=get_field("show_mobile_banner");
if(!is_array($show_splash_banner)||!isset($show_splash_banner[0]))echo 'var show_splash_banner=false;';
else echo 'var show_splash_banner=true;';
if(!is_array($show_mobile_banner)||!isset($show_mobile_banner[0]))echo 'var show_mobile_banner=false;';
else echo 'var show_mobile_banner=true;';*/
?>

function isMobile(){
	if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|BB|PlayBook|IEMobile|Windows Phone|Kindle|Silk|Opera Mini/i.test(navigator.userAgent))return true;
	else if($(window).width()<=1152)return true;
	return false;
}
</script>
<script src='https://www.google.com/recaptcha/api.js'></script>

</head>
<body class="responsive">
	<!--<div class='fx responsive_ad' id="mobile_banner"><div id='div-gpt-ad-<?php echo get_option('dfp_id') ?>-1' style='height:50px; width:320px;'>
		<script>
		googletag.cmd.push(function() { googletag.display('div-gpt-ad-<?php echo get_option('dfp_id') ?>-1'); });
		</script>
	</div></div>
	<div class='fx responsive_ad onload' id="splash"><div id='div-gpt-ad-<?php echo get_option('dfp_id') ?>-2' style='height:480px; width:320px;'>
        <script>
        googletag.cmd.push(function() { googletag.display('div-gpt-ad-<?php echo get_option('dfp_id') ?>-2'); });
        </script>
    </div></div>
	<script>
	if(isMobile()){
		var splash=document.getElementById("splash");
		splash.style.paddingTop=((window.innerHeight-480)/2)+"px";
		splash.style.paddingBottom=((window.innerHeight-480)/2)+"px";
	}
	else{
		document.getElementById("splash").innerHTML='';
	}
	</script>-->
	<?php global $banners; ?>
	<?php if(isset($banners['mobile'])): ?>
		<div class='fx responsive_ad' id="mobile_banner"><div style="width:100%">
			<?php echo isset($banners['mobile']['link'])?'<a href="'.$banners['mobile']['link'].'" target="_blank"  style="display:block">':'' ?>
			<img src="<?php echo $banners['mobile']['img'] ?>" style="width:100%" alt="" />
			<?php echo isset($banners['mobile']['link'])?'</a>':'' ?>
		</div></div>
	<?php endif; ?>
	<?php if(isset($banners['splash'])): ?>
		<div class='fx responsive_ad onload' id="splash"><div style="width:100%">
			<?php echo isset($banners['splash']['link'])?'<a href="'.$banners['splash']['link'].'" target="_blank" style="display:block">':'' ?>
			<img src="<?php echo $banners['splash']['img'] ?>" alt="" style="display:inline-block" />
			<?php echo isset($banners['splash']['link'])?'</a>':'' ?>
		</div></div>
	<?php endif; ?>
	<script>
	if(isMobile()){
		if($('#splash img').size()>0){
			var splash=document.getElementById("splash");
			splash.style.height=window.innerHeight+"px";
			if(splash.getElementsByTagName("a")&&splash.getElementsByTagName("a")[0])splash.getElementsByTagName("a")[0].style.height=window.innerHeight+"px";
			if(splash.getElementsByTagName("div")&&splash.getElementsByTagName("div")[0])splash.getElementsByTagName("div")[0].style.height=window.innerHeight+"px";
			iMargin($('#splash img'))
		}
		if($('#mobile_banner img').size()>0){
			iMargin($('#mobile_banner img'),false,function($e,pw,ph,iw,ih){
				$('#footer').css('margin-bottom',ih*(pw/iw));
			})
		}
	}
	else{
		document.getElementById("splash").innerHTML='';
	}
	</script>
    <div id="all" class="rel">
        