<?php

//var_dump(get_the_ID());exit;

if(/*count($_REQUEST)==0||count($_REQUEST)==1&&isset($_REQUEST['lang'])*/get_the_ID()<2)include "homepage.php";
else{
    $page_id=get_the_ID();
    get_header();
    echo "<div id=\"body\">".get_single_body()."</div>";
    echo getVideos($page_id);
    echo getArticles($page_id);
    get_footer();
}
