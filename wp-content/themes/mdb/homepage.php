<?php

/*
Template Name: Homepage
*/

setLillyVars();

get_header();
while ( have_posts() ) : the_post();
//echo "<div id=\"body\">".get_body()."</div>";
endwhile;
get_footer();