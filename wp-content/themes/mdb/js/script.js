var $=jQuery,pw=0,ph=0,test=false;



$(document).ready(function(){
	setTimeout(function(){
		//hasPlugin('flash');
		pw=$(window).width();
		ph=$(window).height();
				
                
				
                setHeaderActions();
				setRoller();
                setHeaderSize();
                wrapImages();
				//setFooterSize($(window).height());
		/*setHeaderHTML()
		setBodyHTML()
		
		setBodySize()
		setDifSize()*/
		
		$('.imargin').each(function(){
                    if($(this).parents('.video').length==0){
                        if($(this).parents('div:first').prop('class').search(/az_logo/ig)!=-1)iMargin($(this))
                        else if($(this).hasClass("bg"))iMargin($(this),"a")
                        else iMargin($(this),"f")
                    }
                });
		//$('.video .imargin').each(function(){iMargin($(this),'a')});
		
		$(window).resize(function(){
			//alert($(document).height())
			if(pw!=$(window).width()||ph!=$(window).height()&&!isMobile()){
				pw=$(window).width();
				ph=$(window).height();
				
				
                setHeaderSize()
				/*setBodyHTML()
				setBodySize()*/
				$('.imargin').each(function(){
					if($(this).parents('.video').length==0){
						if($(this).parents('div:first').prop('class').search(/az_logo/ig)!=-1)iMargin($(this))
						else if($(this).hasClass("bg"))iMargin($(this),"a")
						else iMargin($(this),"f")
					}
				});
								//var x=true;
				//$('.video .imargin').each(function(){iMargin($(this),'a')});
				//resizePlayer()
				//setDifSize()
			}
		})
		
		$('.fx.responsive_ad.onload').addClass('inactive')
		window.scrollTo(0,0)
	},isMobile()?1500:100)
})

function iMargin($img,p,func){
    try{
    $img.each(function(){
        var $this=$(this);
        var newI = new Image();
        if($this.prop('src')){
            if($.browser.opera&&$.browser.version>10)setTimeout(function(){
                newI.onload = function(){
                    iMarginSet($this,newI,false,p,func)
                }
                newI.onerror = function(){
                    iMarginSet($this,newI,true,p,func)
                }
            },500);
            newI.onload = function(){
                iMarginSet($this,newI,false,p,func)
            }
            newI.onerror = function(){
                iMarginSet($this,newI,true,p,func)
            }
            newI.src = $this.prop('src');
        }
        else iMarginSet($this,newI,true,p,func)
    })
    }
    catch(e){}
}

function iMarginSet($this,newI,error,p,func){
    try{
	
		var $parent=$this.parents().prop('tagName').toLowerCase()=='body'?$(window):$this.parents(),iw,ih,pw=$parent.width(),ph=$parent.height();
		if(error){
			$this.prop('src',pathToImgFolder+"/img/oops.png");
			iw=300
			ih=300
		}
		else{
			iw=newI.width
			ih=newI.height
		}
		//alert($this.attr("src")+"/"+p)
		if(p=='f'){
			$this.css('margin-left',(pw-iw)/2).css('margin-right',(pw-iw)/2).css('margin-top',(ph-ih)/2).css('margin-bottom',(ph-ih)/2).css('height','auto').css('width','auto');
		}
		else if(p=='a'){
			if(pw/ph<iw/ih)$this.css('margin-left',(pw-(iw*ph/ih))/2).css('margin-top',0).css('height','100%').css('width','auto');
			else $this.css('margin-top',(ph-(ih*pw/iw))/2).css('margin-left',0).css('width','100%').css('height','auto');
		}
		else if(!func){
			if(pw/ph>iw/ih)$this.css('margin-left',(pw-(iw*ph/ih))/2).css('margin-top',0).css('height','100%').css('width','auto');
			else $this.css('margin-top',(ph-(ih*pw/iw))/2).css('margin-left',0).css('width','100%').css('height','auto');
		}
		//if($this.hasClass('mouseover'))$this.addClass('inactive')
		if(func)func($this,pw,ph,iw,ih);
    }
    catch(e){}
}

function setFooterSize(h){
	//if(!h)h=ph;
	//$('.responsive_ad.fx').css({top:h-50,width:pw})
	$('.responsive_ad.fx').css({bottom:0})
}

function setHeaderSize(){
    
	//if($('#warning').hasClass('active'))showDif("warning")
	//if(!$('#result').hasClass('inactive'))showDif("result")
	//else{
		//$('.page_reference.red_bg').css({display:'inline-block'})
		$('#top').css({height:ph<693?693:ph})
		$('body').removeClass("responsive");
		$('.logo img').prop("src",pathToImgFolder+"/img/logo_sm.png");
		$('.az').css({width:172,margin:0})
		$('.az .az_logo').css({width:162})
		//$('.az_logo img').prop("src",pathToImgFolder+"/img/az_logo_sm.png");
		$('.rd img').prop("src",pathToImgFolder+"/img/rd.png");
		//alert(pw+"/"+$('#header .logo').outerWidth()+"/"+$('#header .az').outerWidth()+"/"+$('#header .menu').outerWidth())
		//$('.page_details').css({top:($('#top').outerHeight()-$('.page_details').outerHeight())/2,left:($('#top').outerWidth()-$('.page_details').outerWidth())/2})
		$('.whatsup').addClass('inactive')
		$('.print').removeClass('inactive')
		//alert($(window).height()-75-($('#wpadminbar').size()>0?$('#wpadminbar').height():0))
		$('.article_links').addClass("fx").css({height:$(window).height()-75-($('#wpadminbar').size()>0?$('#wpadminbar').height():0)}).css('padding-bottom',64)
		$('.article_links_static').addClass('inactive')
		$('#header').append($('.rd.left').css('margin-top',-1))
		$('.g-recaptcha').css({margin:'0 auto',width:300})
		//$('.responsive_ad.fx').css({width:pw})
		//alert($('body').width())
		$('.rd').css({width:$('body').width()-$('#header .logo').outerWidth()-$('#header .az').outerWidth()-$('#header .menu').outerWidth()-40+1})
		$('.email a').attr("href","#").attr("target","");
		showHideArticleLinks(true)
		
		if(isMobile()){
			//$('#top').css({height:ph<394?394:ph})
			$('#top').css({height:$('#article').size()>0?ph/3:ph-200})
			$('body').addClass("responsive");
			$('.logo img').prop("src",pathToImgFolder+"/img/logo_xs.png");
			//$('.az_logo img').prop("src",pathToImgFolder+"/img/az_logo_xs.png");
			$('.rd img').prop("src",pathToImgFolder+"/img/rd_xs.png");
			$('.az').css({width:pw-$('#header .logo').outerWidth()-$('#header .menu').outerWidth(),margin:'0 0 0 -10px'})
			$('.az .az_logo').css({width:pw-$('#header .logo').outerWidth()-$('#header .menu').outerWidth()-10})
			//alert($('.page_details').outerHeight())
			$('.article_links').removeClass("fx").css('padding-bottom',$('#article').size()>0?64:64).css({height:'auto'})
			$('.article_links_static').removeClass("fx").removeClass('inactive').css({height:'auto'})
			$('.whatsup').removeClass('inactive')
			$('.print').addClass('inactive')
			showHideArticleLinks(true,true)
			$('#header').after($('#header .rd.left').css('margin-top',($('#wpadminbar').size()>0?$('#wpadminbar').height()*0:0)+50))
			//$('.g-recaptcha').css({margin:'0 '+(($('.left.half:last').width()-304)/2)+'px'})
			$('.email a').attr("href","mailto:?subject="+encodeURIComponent($('h1.article_title').html())+"&body=לקריאת הכתבה: "+encodeURIComponent(window.location.href)).attr("target","_blank");
		}
		
		
	//}
	//setTimeout(function(){
		if($('#wpadminbar').size()>0){
			$('.dif,#header').css({top:$('#wpadminbar').height()})
			$('.article_links').css({top:$('#wpadminbar').height()+(isMobile()?48:75)})
		}
		else{
			$('.dif,#header').css({top:0})
			$('.article_links').css({top:isMobile()?48:75})
		}
	//},1000)
	
	if($('#warning').hasClass('active'))showDif("warning")
	if(!$('#result').hasClass('inactive'))showDif("result")
		
	$('.page_details').bind('click',function(){
		document.location.href=$('.page_details a').prop("href")
	})
	$('.page_details').css({top:($('#top').outerHeight()-$('.page_details').outerHeight())/2,left:($('#top').outerWidth()-$('.page_details').outerWidth())/2})
	
	/*if(!show_mobile_banner){
		$('#footer').css('margin-bottom',0);
		$('#mobile_banner').remove()
	}*/
	if(!isMobile())$('#footer').css('margin-bottom',0);
	else iMargin($('#mobile_banner img'),false,function($e,pw,ph,iw,ih){
			$('#footer').css('margin-bottom',ih*((pw-0)/iw));
		})
	/*if(!show_splash_banner){
		$('#splash').remove()
	}*/
}

function setHeaderActions(){
    if(!$('.article_link').hasClass('no_roller'))setTop($('.article_link:first'),true)
    $('.article_link').each(function(){
        $(this).bind('mouseover',function(){
            $('.article_link').removeClass('hover')
        })
    })
}

function setTop($e,noAnimation){
	if(noAnimation){
		$('#top img').prop('src',$e.find('input[name="image"]').val())
        iMargin($('#top img'),'a')
		$('.article_link:first').addClass('hover')
	}
    else $('#top img').animate({opacity:0.1},500,function(){
        $(this).prop('src',$e.find('input[name="image"]').val())
        iMargin($(this),'a')
        $(this).animate({opacity:1},500)
    })
    $('#top .page_reference').html($e.find('.red_bg').html());
    $('#top .page_title').html("<a href='"+$e.find('a').prop("href")+"'>"+$e.find('a').html()+"</a>");
    //iMargin($('#top img'),"a")
}

function showHideArticleLinks(do_not_turn,turn_off){
	$('body,html').css({height:'auto',overflow:'auto'})
    if(!turn_off&&(!do_not_turn&&$('.article_links').hasClass('inactive')||do_not_turn&&!$('.article_links').hasClass('inactive'))){
        $('.article_links').removeClass('inactive')
        $('.menu').removeClass('closed');
		if(isMobile()){
			$('.article_links').css({position:'static'})
			//if($('#article').size()>0){
				$('.article_links').css({position:'fixed'}).css('z-index',9999).css({top:(48+$('#wpadminbar').height()),height:ph-48-$('#wpadminbar').height()}).css('overflow-y','auto')
				$('body,html').css({height:$(window).height(),overflow:'hidden'})
			//}
			//else window.scrollTo(0,($('#article').size()>0?0:ph)/*+$('.rd').height()*/)
		}
		else $('.article_links').css({position:'fixed'})
    }
    else{
        //if(!isMobile()||$('#article').size()>0){
			$('.article_links').addClass('inactive')
		//}
		//else window.scrollTo(0,($('#article').size()>0?0:ph)/*+$('.rd').height()*/)
        $('.menu').addClass('closed')
    }
}

function print(elem){
    var mywindow = window.open('', 'PRINT', 'height=400,width=600');

    mywindow.document.write('<html><head><title>' + document.title  + '</title>');
    mywindow.document.write('</head><body style="font-size:16px;text-align:right;padding:50px">');
    mywindow.document.write('<h1>' + document.title  + '</h1>');
    var $e=$(elem).clone();
    $e.find('.article_social').remove();
    $e.find('.ad').remove();
    //$(mywindow).css("text-align","right").css("font-size","16px")
    
    mywindow.document.write($e.html());
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();

    return true;
}

function setRoller(){
	
    if(!$('.article_links').hasClass('inactive')&&!$('.article_link').hasClass('no_roller'))setInterval(function(){
        if($('.article_link.hover').size()==0)$('.article_link:first').addClass('hover')
        else{
            if($('.article_link.hover').next().hasClass('article_link'))$('.article_link.hover').removeClass('hover').next().addClass('hover')
            else{
                $('.article_link.hover').removeClass('hover')
                $('.article_link:first').addClass('hover')
            }
            setTop($('.article_link.hover'))
        }
    },5000)
}

function wrapImages(){
    $('.article_content img').each(function(){
        if($(this).parents('a').size()==0){
            //var oh=this.outerHTML;
            $(this).replaceWith('<a href="'+$(this).prop("src")+'" target="_blank">'+this.outerHTML+'</a>')
        }
    })
}

function showDif(id){
	if(id=="mail"&&$('.email a').attr("href")!="#")return;
	
	$('#'+id).removeClass('inactive')
	var h=$('#'+id+' .w').outerHeight(),pt=isMobile()?0:125,bh=$('#all').height();
	if(bh>h+pt){
		//alert(bh-(h+pt))
		if(id=="warning"||id=="mail"){
			if(isMobile()){
				$('#all').addClass('inactive')
				$('#'+id).css('padding-bottom',0);
			}
			else{
				$('#all').removeClass('inactive')
				$('#'+id).css('padding-bottom',bh-(h+pt));
			}
		}
		else $('#'+id).css('padding-bottom',bh-(h+pt));
		//$('body,html').css({height:ph}).css({overflow:'hidden'})
		//alert(bh)
	}
	else{
		//$('#warning').css('padding-bottom',125);
		//$('body,html').css({height:h+pt+125}).css({overflow:'hidden'})
	}
	iMargin($('.dif .login_form_logo img'),'f')
	//alert($('.left.half:last').width())
	$('.g-recaptcha')/*.css({transform:'scale(0.77)'}).css('transform-origin','0 0')*/.css({margin:'0 '+(($('.left.half:last').width()-304)/2)+'px'})
	//window.scrollTo(0,0)
}

function hideDif(){
	$('.dif').addClass('inactive')
}











































///////////////////////////////



