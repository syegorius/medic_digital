<!doctype html><html debug="true">
<head>
<script type="text/javascript" src="compatibility.js"></script>
<!--<script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script>-->
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php is_front_page() ? bloginfo('name') : wp_title(''); ?></title>
<script type="text/javascript">var currentLang="<?php //echo ICL_LANGUAGE_CODE; ?>en",pathToImgFolder="<?php echo get_template_directory_uri(); ?>"</script>
<?php wp_head(); ?>
</head>
<body>
<header>
	<div id="header">
		<div class="wrapper">
			<div class="rtl-float-left header_block">
				<div class="three_lines inactive rtl-float-left"><!--&#9776;--></div>
				<div class="close inactive rtl-float-left"><img src="<?php echo get_template_directory_uri(); ?>/img/close.png" alt="" /></div>
				
				<div class="rtl-float-left top_logo"><a href="/" ><img class="top-logo" src="<?php echo get_template_directory_uri(); ?>/img/top-logo.png" alt="" /></a></div>
				<div class="clear"></div>
			</div>
			<div class="menu_wrapper">
				<?php echo wp_nav_menu(array("theme_location"=>"primary",''=>false,'walker'=>new customize_menu_walker())); ?>
			</div>
			<div class="rtl-float-right top_lilly"><a href="/" ><img src="<?php echo get_template_directory_uri(); ?>/img/top-lilly.png" alt="" /></a></div>
			<div class="clear"></div>
		</div>
	</div>
	
</header>
<div class="heder_bottom_line"></div>