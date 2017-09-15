<!doctype html><html debug="true">
<head>
<script type="text/javascript" src="compatibility.js"></script>
<!--<script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script>-->
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php is_front_page() ? bloginfo('name') : wp_title(''); ?></title>
<?php $get_template_directory_uri=get_template_directory_uri(); ?>
<script type="text/javascript">var currentLang="<?php //echo ICL_LANGUAGE_CODE; ?>en",pathToImgFolder="<?php echo $get_template_directory_uri; ?>"</script>
<?php wp_head(); ?>



<script async='async' src='https://www.googletagservices.com/tag/js/gpt.js'></script>
<script>
  var googletag = googletag || {};
  googletag.cmd = googletag.cmd || [];
</script>
 
<script>
  googletag.cmd.push(function() {
    googletag.defineSlot('/50454183/MedicDigital-Mobile', [646, 160], 'div-gpt-ad-<?php echo get_option('dfp_id') ?>-0').addService(googletag.pubads());
    googletag.defineSlot('/50454183/MedicDigital-Splash', [646, 540], 'div-gpt-ad-<?php echo get_option('dfp_id') ?>-1').addService(googletag.pubads());
    googletag.defineSlot('/50454183/MedicDigital-stripe', [160, 600], 'div-gpt-ad-<?php echo get_option('dfp_id') ?>-2').addService(googletag.pubads());
    googletag.pubads().enableSingleRequest();
    googletag.enableServices();
  });
</script>



</head>
<body>
    <div id="all" class="rel">
        <div id="header">
            <div class="logo left">
                <a href="/"><img src="<?php echo $get_template_directory_uri ?>/img/logo_sm.png" title="" alt="" /></a>
            </div>


            <div class="right menu" onclick="showHideArticleLinks()">

            </div>
            <div class="right az">
                <div class="az_title">בשיתוף חברת</div>
                <div class="az_logo"><img src="<?php echo $get_template_directory_uri ?>/img/az_logo_sm.png" class="imargin" title="" alt="" /></div>
            </div>
            <div class="rd left">
                <div class="left"><img src="<?php echo $get_template_directory_uri ?>/img/rd.png" title="" alt="Respiratory Digital" /></div>
                <div class="right">מגזין רפואי בנושא מחלות<br/> מערכת הנשימה</div>
                <div class="clear"></div>
            </div>
        </div>