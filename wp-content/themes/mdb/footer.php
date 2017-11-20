    <div id="footer">
        <img src="<?php echo get_template_directory_uri() ?>/img/logo_footer.png" alt="" title="" />
        &copy; 2017 מולי רפואה מקוונת בע"מ - כל הזכויות שמורות
    </div>
</div>

<?php wp_footer(); ?>
<form class="dif abs <?php echo get_lilly_login_form_class() ?>" id="warning" method="post" action="<?php echo (isset($_SERVER['HTTPS']) ? "https://" : "http://") .$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>">
	<div class="w">
		<div class="login_form_logo"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="" class="imargin" /></div>
		<div class="center rtl caution black">
			<div class="center bold">ברוכים הבאים</div>
			<div class="center">
			התכנים באתר זה מיועדים לרופאים  ,רוקחים ואנשי צוות רפואי.
			</div>
			<div class="center">
			לכניסה יש למלא את הקוד שצורף לניוזלטר:
			</div>
		</div>
                <input name="lilly_email" type="text" class="ltr email" placeholder="שם משתמש" style="text-align:center" />
		<input name="lilly_password" type="password" class="ltr password" placeholder="סיסמה" style="text-align:center" />
		
		<button name="submit" type="submit" class="rtl pointer">כניסה</button>
		<div class="red error center rtl caution"><?php echo get_lilly_login_error() ?></div>
	</div>
</form>
<form class="dif abs inactive" id="mail" method="post" action="<?php echo (isset($_SERVER['HTTPS']) ? "https://" : "http://") .$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>">
	<div class="w" style="padding-bottom:0">
		<div class="close pointer" onclick="hideDif()"></div>
		<div class="login_form_logo"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="" class="imargin" /></div>
		<div style="padding:21px">
			<div class="right half">
				<div class="center rtl caution black" style="text-align:right">
					<div class="bold">שליחה במייל</div>
					<div><?php echo get_the_title() ?></div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="left half">
				<input name="visitor_name" type="text" class="ltr name" placeholder="שם השולח" style="text-align:right" />
				<input name="sent_from" type="text" class="ltr sent_from" placeholder="כתובת האימייל של השולח" style="text-align:right" />
				<input name="sent_to" type="text" class="ltr sent_to" placeholder="כתובת האימייל של הנמען" style="text-align:right" />
				<textarea name="message" placeholder="הודעה" style="text-align:right"></textarea>
			</div>
			
			<div class="clear"></div>
			<div style="padding-top:20px;width:100%;">
				<div class="left half">
					<div class="g-recaptcha" data-sitekey="6LdpyTUUAAAAAPdBh9xt529ZIEoK1OEqKn7itFIS"></div>
				</div>
				<div class="right half">
				<button name="submit" type="submit" class="rtl pointer">שלח</button>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<!--<div class="red error center rtl caution"><?php echo get_lilly_login_error() ?></div>-->
	</div>
</form>
<div class="dif abs <?php echo get_result_activity() ?>" id="result">
	<div class="w">
		<div class="close pointer" onclick="hideDif()"></div>
		<div class="login_form_logo"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="" class="imargin" /></div>
		<div class="center rtl caution black">
			<div class="center bold">Done!</div>
		</div>
	</div>
</div>
</body>
</html>