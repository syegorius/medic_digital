<?php

//isInsideFrame();
//error_reporting(E_ALL);

if(get_field('redirect')){
	header("location: ".get_field('redirect'));
	exit;
}
setLillyVars();

$page_id=get_the_ID();
    
get_header();
//$file=file_to_download();
while ( have_posts() ) : the_post();
echo "<script type=\"text/javascript\">PDFJS.workerSrc='pdf.worker.js';</script><div id=\"body\"><div class=\"wrapper body_wrapper\">".get_single_body()."</div></div>";
endwhile;
get_footer();

function get_single_body(){
	$img=get_field('image');
	$rImg=get_field('responsive_image');
	if(!isset($img['url'])&&isset($rImg['url']))$img=$rImg;
	$h=get_field('document_height');
	
	$file = get_field('file');
	if(!$file)$file = array('url'=>get_field('file_external_link'));
    if(!isset($file['url']))$file['url']='';
	
	if(!preg_match("/\.pdf($|\?.*?$)/iu",$file['url'])&&!preg_match("/\.((png|jpg|jpeg|gif|ppt|doc|xls)[x]?)($|\?.*?$)/iu",$file['url']))$rtlfls=" style=\"width:100%\"";
	else $rtlfls="";
	
	$html="<div class=\"rtl-float-left very_paper\"".$rtlfls.">
				<div class=\"title_image_wrapper\">".
					(isset($img["url"])&&$img["url"]||isset($rImg["url"])&&$rImg["url"]?"<div class=\"paper_image rtl-float-left\">
						<img class=\"imargin\" src=\"".$img["url"]."\" alt=\"".get_the_title()."\" />
						<img class=\"imargin inactive\" src=\"".$rImg["url"]."\" alt=\"".get_the_title()."\" />
					</div>":"").
					"<div class=\"title inactive rtl-float-left\">
						<span>".get_the_title()."</span>
					</div>
					<div class=\"clear\"></div>
				</div>
				<div class=\"paper_description\">".get_field('pdf_description')."</div>
			</div>";
	$html.='<input type="hidden" name="height" value="'.($h>0?$h:1000).'" />';
	if(preg_match("/\.html($|\?.*?$)/iu",$file['url'])){
		$html.='<div class="rtl-float-right very_paper_file">'.file_get_contents($file['url']).'</div>';
	}
	else if(preg_match("/\.(jp[e]g|gif|png)($|\?.*?$)/iu",$file['url'])){
		$html.='<div class="rtl-float-right very_paper_file"><img src="'.$file['url'].'" alt="" style="width:100%" /></div>';
	}
	else if(preg_match("/\.pdf($|\?.*?$)/iu",$file['url'])){
		/*$html.='<script>
			if(/iPad|iPhone|iPod/.test(navigator.userAgent)&&!window.MSStream)document.write(\'<div class="rtl-float-right very_paper_file"><p style="padding-bottom:100px;font-size:24px;">It appears you do not have a PDF plugin for this browser. No biggie... you can <a href="'.$file['url'].'">click here to download the PDF file.</a></p></div>\')
			else if(!hasPlugin(\'pdf\'))document.write(\'<div class="rtl-float-right very_paper_file"><object data="'.$file['url'].'#scrollbar=0" type="application/pdf" width="100%" height="'.($h>0?$h:1000).'" style="width:100%;height:'.($h>0?$h:1000).'px"><p style="padding-bottom:100px;font-size:24px;">It appears you do not have a PDF plugin for this browser. No biggie... you can <a href="'.$file['url'].'">click here to download the PDF file.</a></p></object></div>\')
			else document.write(\'<div class="rtl-float-right very_paper_file"><iframe name="no_scrollbars" id="no_scrollbars" src="'.$file['url'].'" width="100%" height="'.($h>0?$h:1000).'" style="width:100%;height:'.($h>0?$h:1000).'px" frameborder="0"></iframe></div>\')
		</script>';*/

		if(preg_match("/^[\s\r\n]*(http[s]?:)?\/\//iu",$file['url'])&&!preg_match("/^(http[s]?:)?\/\/(www)?".$_SERVER['HTTP_HOST']."($|[\/\?])/iu",$file['url'])){
			$uploads = wp_upload_dir(null);
			$saved_file_name=preg_replace("/[^a-z\._]/iu","",$file["url"]);
			copy($file["url"], $uploads["path"]."/".$saved_file_name);
			$file["url"]=$uploads["url"]."/".$saved_file_name;
			//echo $file["url"];exit;
		}
		
		$html.='<div class="rtl-float-right very_paper_file" style="position:relative;height:'.($h>0?$h:1000).'px;overflow:hidden"><div class="abs" style="width:100%"><div style="padding-bottom:100px;font-size:24px;">It appears you do not have a PDF plugin for this browser. No biggie... you can <a href="'.$file['url'].'" style="display:inline">click here to download the PDF file.</a></div></div><div class="abs" style="width:100%">'.do_shortcode("[pdfjs-viewer url=\"".preg_replace("/^\s*http[s]?:\/\/(www)?".$_SERVER['HTTP_HOST']."/iu","",$file['url'])."\" viewer_width=100% viewer_height=".($h>0?$h:1000)." fullscreen=true download=true print=true]").'</div></div>';

		//$html. = '<div class="rtl-float-right very_paper_file">'.convertPDF2HTML($file['url']).'</div>';

		//$html.='<div class="rtl-float-right very_paper_file"><iframe name="no_scrollbars" id="no_scrollbars" src="'.$file['url'].'" width="100%" height="'.($h>0?$h:5000).'" style="width:100%;height:'.($h>0?$h:5000).'px" frameborder="0" onload="javascript:resizeIframe(this);"></iframe></div>';
		//$html.='<div class="rtl-float-right very_paper_file"><embed src="'.$file['url'].'#scrollbar=0" width="100%" height="'.($h>0?$h:5000).'" style="width:100%;height:'.($h>0?$h:5000).'px" title="" /></div>';
	}
	else if(preg_match("/\.((ppt|doc|xls)[x]?)($|\?.*?$)/iu",$file['url']))$html.="<div class=\"rtl-float-right very_paper_file\"><iframe id=\"iframed_file\" name=\"iframed_file\" src=\"//view.officeapps.live.com/op/embed.aspx?src=".urlencode($file['url'])."\" style=\"width:100%;height:".($h>0?$h:5000)."px\" frameborder=\"0\"></iframe></div>";//&embedded=true&rand=".rand(0,100000000)."
	else {}
	//$html.="<div class=\"rtl-float-right very_paper_file\"><iframe id=\"iframed_file\" name=\"iframed_file\" src=\"https://docs.google.com/gview?embedded=true&url=".$file['url']."\" style=\"width:100%;height:".($h>0?$h:5000)."px\" frameborder=\"0\"></iframe></div>";//&embedded=true&rand=".rand(0,100000000)."
	//$html.="<div class=\"rtl-float-right very_paper_file\"><iframe src=\"https://docviewer.yandex.ru/?url=".$file['url']."&rand=".rand(0,100000000)."\" style=\"width:100%;height:".($h>0?$h:1000)."px\" frameborder=\"0\"></iframe></div>";
	//$html.="<div class=\"rtl-float-right very_paper_file\"><iframe src=\"?framed=".urlencode($file['url'])."\" style=\"width:100%;height:".($h>0?$h:1000)."px\" frameborder=\"0\"></iframe></div>";
	//$html.='<div class="rtl-float-right very_paper_file"><iframe name="no_scrollbars" id="no_scrollbars" src="'.$file['url'].'" style="width:100%;" frameborder="0"></iframe></div>';
	//$html.='<div class="rtl-float-right very_paper_file"><embed src="'.$file['url'].'" width="100%" alt="" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html"></div>';
	$html.="<div class=\"clear\"></div>";
	
	/*$html.='<script>
		function reloadIFrame(){
			document.getElementById("iframed_file").src=document.getElementById("iframed_file").src;
		}

		timerId=setInterval("reloadIFrame();", 5000);

		$(document).ready(function() {
			$("#iframed_file").on("load",function(){
				clearInterval(timerId);
				console.log("Finally Loaded");
			});
		});
		</script>';*/
	return $html;
}

/*function get_single_body(){
    echo "<div id=\"page_title\"><div class=\"wrapper\"><h1 class=\"rtl-float-left\">".get_the_title()."</h1><div class=\"clear\"></div></div></div>";
    echo "<div class=\"wrapper\"><div class=\"content\">".get_the_content()."</div></div>";
}*/

//execute command in linux: $sCmd = "$sLibreOfficeBin --headless --invisible --nologo --nofirststartwizard --convert-to html --outdir $sTmpFolder "old_file.ppt";

