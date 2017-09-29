    <div id="footer">
        <img src="<?php echo get_template_directory_uri() ?>/img/logo_footer.png" alt="" title="" />
        &copy; 2017 מולי רפואה מקוונת בע"מ - כל הזכויות שמורות
    </div>
</div>
<?php wp_footer(); ?>
<form class="dif abs <?php echo get_lilly_login_form_class() ?>" id="warning" method="post" action="<?php echo (isset($_SERVER['HTTPS']) ? "https://" : "http://") .$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]; ?>">
	<div class="w">
		<div class="login_form_logo"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="" class="imargin" /></div>
		<div class="center rtl caution black">
			<div class="center bold">ברוכים הבאים</div>
                        <div class="center">
                        התכנים באתר זה מיועדים לרופאים  ,רוקחים ואנשי צוות רפואי.
                        </div>
                        <div class="center">
                        לכניסה יש למלא את הקוד שצורף לניוזלטר   :
                        </div>
		</div>
                <input name="lilly_email" type="text" class="ltr email" placeholder="שם משתמש" style="text-align:center" />
		<input name="lilly_password" type="password" class="ltr password" placeholder="סיסמה" style="text-align:center" />
		<input name="submit" type="submit" class="rtl pointer" value="כניסה" />
		<div class="red error center rtl caution"><?php echo get_lilly_login_error() ?></div>
	</div>
</form>
</body>
</html>