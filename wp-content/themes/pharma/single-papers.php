<?php

$page_id=get_the_ID();
    
$file=file_to_download();

get_header();
echo "<div id=\"body\">".get_single_body().$file."</div>";
echo getVideos($page_id);
echo getArticles($page_id);
get_footer();