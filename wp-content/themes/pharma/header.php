<!doctype html><html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php is_front_page() ? bloginfo('name') : wp_title(''); ?></title>
<script type="text/javascript">var currentLang="<?php echo ICL_LANGUAGE_CODE; ?>",pathToImgFolder="<?php echo get_template_directory_uri(); ?>"</script>
<!--[if !IE]>
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/font.css" />
<![endif]-->
<?php wp_head(); ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-96728064-1', 'auto');
  ga('send', 'pageview');

</script>
<!--[if IE]>
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie.css" />
<![endif]-->
</head>
<body>

	<div id="header">
		<div class="logo_wrapper rtl-float-left">
			<a href="/<?php echo $langUrl ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="" /></a>
		</div>
		
		<div class="wrapper rtl-float-left menu_wrapper">
			<div class="clear"></div>
			<?php echo wp_nav_menu(array("theme_location"=>"primary",''=>false,'walker'=>new customize_menu_walker())); ?>
			<div class="clear"></div>
		</div>
		
		<div class="three_lines inactive rtl-align-right rtl-float-right"><!--&#9776;--></div>
		<?php if(get_option('show_language')): ?>
                    <div class="lang_wrapper rtl-float-right">
                            <div class="lang_switcher">
                                    <?php do_action('wpml_add_language_selector'); ?>
                            </div>
                    </div>
                <?php endif; ?>
		<div class="clear"></div>
	</div>
