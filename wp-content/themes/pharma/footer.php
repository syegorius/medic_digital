<div class="former_footer">
	<div id="footer">
		<div class="wrapper">
			<div class="responsive_footer_menu_wrapper">
				<?php wp_nav_menu(array("theme_location"=>"secondary")); ?>
			</div>
			<div class="copy_wrapper rtl-float-right">
				<?php echo L('copy_sign'); ?>
			</div>
			<div class="footer_logo_wrapper rtl-float-left">
				<a href="/"><img src="<?php echo get_template_directory_uri(); ?>/img/logo_footer.png" alt="" /></a>
			</div>
			<div class="footer_menu_wrapper rtl-float-left">
				<?php wp_nav_menu(array("theme_location"=>"secondary")); ?>
                        </div>
			<div class="clear"></div>
		</div>
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>