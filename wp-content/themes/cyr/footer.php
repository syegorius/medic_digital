<div class="clear"></div>
<footer>
	<div id="footer">
		<div class="wrapper">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/footer-logo.png" alt="" class="footer_logo" />
                        <div class="footer_text">
                            <?php echo L("footer_text") ?>
                        </div>
                        <hr />
                        <img src="<?php echo get_template_directory_uri(); ?>/img/footer-lilly.png" alt="" class="footer_lilly" />
                </div>
	</div>
</footer>
<form class="dif abs <?php echo get_lilly_login_form_class() ?>" id="warning" method="post" action="/">
	<div class="w">
		<div class=""><img src="<?php echo get_template_directory_uri(); ?>/img/top-lilly.png" alt="" /></div>
		<div class="center rtl caution">
			<span class="inline bold">הנך נכנס לאזור המוגבל לצוות רפואי בלבד.</span><br />
			הנני מצהיר בזאת כי אני בעל רישיון לעסוק ברפואה/רוקחות/סיעוד.
		</div>
		<div class="rtl center instructions">אנא הכנס את הפרטים הבאים:</div>
		<input name="lilly_password" type="password" class="ltr password" placeholder="סיסמה" style="text-align:center" />
		<div class="rtl center please_contact">אם אין לך סיסמה, אנא פנה לנציג לילי באזורך.</div>
		<input name="submit" type="submit" class="rtl pointer" value="כניסה" />
		<div class="red error center rtl"><?php echo get_lilly_login_error() ?></div>
	</div>
</form>
<?php wp_footer(); ?>
</body>
</html>