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
    googletag.defineSlot('/50454183/MedicDigitalMagazine/Giga540x646', [540, 646], 'div-gpt-ad-<?php echo get_option('dfp_id') ?>-0').addService(googletag.pubads());
    googletag.defineSlot('/50454183/MedicDigitalMagazine/MobileStripe320x50', [320, 50], 'div-gpt-ad-<?php echo get_option('dfp_id') ?>-1').addService(googletag.pubads());
    googletag.defineSlot('/50454183/MedicDigitalMagazine/Splash320x480', [320, 480], 'div-gpt-ad-<?php echo get_option('dfp_id') ?>-2').addService(googletag.pubads());
    googletag.defineSlot('/50454183/MedicDigitalMagazine/Stripe160x646', [646,160], 'div-gpt-ad-<?php echo get_option('dfp_id') ?>-3').addService(googletag.pubads());
    googletag.pubads().enableSingleRequest();
    <?php
        $title_words=preg_split("/[^\p{Hebrew}a-z]+/iu",get_the_title());
        //foreach($title_words as $word)echo "googletag.pubads().setTargeting('Magazine','".$word."');\r\n";
        echo "googletag.pubads().setTargeting('Magazine','House');\r\n";
    ?>
    googletag.enableServices();
  });
</script>

</head>
<body>
    <div id="all" class="rel">
        