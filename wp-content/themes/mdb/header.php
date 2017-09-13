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
</head>
<body>
        
        <div id="header">
            <div class="logo left">
                <a href="/"><img src="<?php echo $get_template_directory_uri ?>/img/logo_sm.png" title="" alt="" /></a>
            </div>
            <div class="rd left">
                <div class="left"><img src="<?php echo $get_template_directory_uri ?>/img/rd.png" title="" alt="Respiratory Digital" /></div>
                <div class="right">מגזין רפואי בנושא מחלות<br/> מערכת הנשימה</div>
                <div class="clear"></div>
            </div>
            
            <div class="right menu">
                
            </div>
            <div class="right az">
                <div class="az_title">בשיתוף חברת</div>
                <div class="az_logo"><img src="<?php echo $get_template_directory_uri ?>/img/az_logo_sm.png" class="imargin" title="" alt="" /></div>
            </div>
        </div>
        <div id="top" class="rel">
            <img src="<?php echo $get_template_directory_uri ?>/img/bg.jpg" class="imargin bg" title="" alt="" />
            <div class="article_links rabs">
                <?php for($i=0; $i<5; $i++): ?>
                    <div class="article_link">
                        <div>
                            <div class="red_bg right">מחקר</div><a href="#">מעכב DPP4 לינגליפטין מוריד רמת סוכר לאחר ארוחה ומשפר תפקוד של תאי B בחולי סוכרת</a>
                            <div class="clear"></div>
                        </div>
                        <div class="right article_link_note">ד״ר ישראל ישראלי</div>
                        <div class="clear"></div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>