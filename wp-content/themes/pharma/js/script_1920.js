if(typeof $==='undefined'&&typeof window.jQuery!=='undefined')var $=jQuery
var resizing=false,$globalEl=false,rolling={},autorollers={},globalP=false,ww=0,wh=0,scrollTop=0,player=false;

function isMobile(){
	if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|BB|PlayBook|IEMobile|Windows Phone|Kindle|Silk|Opera Mini/i.test(navigator.userAgent))return true;
	else if($(window).width()<=960)return true;
	return false;
}
//alert($);
//alert(jQuery);
$(document).ready(function(){
        needTobeResized();
	if(isMobile()){
            $('body').addClass('responsive_body');
        }
	else $('body').removeClass('responsive_body');
	setHeaderWidth();
	setHeaderActions();
	setFooterWidth();
        setHPVideos()
	setPersonnelWidth();
	setCompanies();
	setGuidelineWidth();
	setHPCompanies();
	$('.gallery_wrapper').each(function(){setGalleryCarousel($(this))});
	setHPVideos()
	setPersonnelWidth();
	personnelDescription();
	setHPOverviewWidth();
	setOverviewWidth();
	setHP5PostsWidth();
	setConferences();
	subMenu();
	$('.imargin').each(function(){iMargin($(this),'a')});
	$(window).resize(function(){
		//setTimeout(function(){
                    try{
			if(!resizing&&needTobeResized()){
				resizing=true;
                                $('.all').css({margin:0})
                                $('.roller').each(function(){
                                    changeGalleryPage(this.getElementsByClass?this.getElementsByClass("page")[0]:this.getElementsByClassName("page")[0],1)
                                })
				if(isMobile())$('body').addClass('responsive_body');
                                else $('body').removeClass('responsive_body');
				setHeaderWidth();
				setHeaderActions();
				setFooterWidth();
                                setHPVideos();
				setPersonnelWidth();
				setCompanies();
                                setGuidelineWidth();
                                setHPCompanies();
				$('.gallery_wrapper').each(function(){setGalleryCarousel($(this))});
				setHPVideos();
				setPersonnelWidth();
                                //personnelDescription();
				setHPOverviewWidth();
				setOverviewWidth();
				setHP5PostsWidth();
				setConferences();
				$('.imargin').each(function(){iMargin($(this),'a')});
                                closeSubMenu()
                                //closePlayer()
                                resizePlayer()
                                /*$('.roller').each(function(){
                                    changeGalleryPage($(this).find('.page:first').get(0),1)
                                })*/
				resizing=false;
			}
                    }
                    catch(e){}
		//},500)
	})
	$('.video_play_icon,.video_name').mouseover(function(){
		if(!msie())$(this).find('img').prop("src",pathToImgFolder+"/img/play_hover.png");
		else $(this).find('img').attr("src",pathToImgFolder+"/img/play_hover.png");
		//$(this).parents('.video').find('.video_name').css("text-decoration",'underline');
	}).mouseout(function(){
		if(!msie())$(this).find('img').prop("src",pathToImgFolder+"/img/play.png");
		else $(this).find('img').attr("src",pathToImgFolder+"/img/play.png");
		//$(this).parents('.video').find('.video_name').css("text-decoration",'none');
	}).click(function(){
		loadPlayer($(this).parents('.video:first').find('input').val());
	})
})

function needTobeResized(){
    var w=$(window).width(),h=$(window).height();
    if(ww!=w){
        ww=w;
        wh=h;
        return true;
    }
    return false;
}

function setHeaderWidth(){
	$('.menu_wrapper,.logo_wrapper,.copy_wrapper,.footer_logo_wrapper,.footer_menu_wrapper,.three_lines').removeClass("responsive");//.lang_wrapper,
	$('.logo_wrapper').css({width:253,padding:"15px 37px"})
	$('.logo_wrapper img').css({width:253})
	if(!msie())$(".logo_wrapper img").prop("src",pathToImgFolder+"/img/logo.png")
	else $(".logo_wrapper img").attr("src",pathToImgFolder+"/img/logo.png")
    $(".three_lines").css("background-image",pathToImgFolder+"/img/three_lines.png").css({width:'98px',height:'98px'}).removeClass("mini_responsive")
	$('.menu_wrapper').css({width:1290}).removeClass('clicked');
	$('.title_icon').removeClass("inactive")
	$('.menu-header-menu-container,.menu-header-menu-he-container').css("margin-top",0);
	$('#header .clear:last').remove();
	$('#header').append($('.lang_wrapper:first').addClass('rtl-float-right')).append('<div class="clear"></div>');
	$('#header ul li.menu-item.lang_item').remove();
	$('.menu_wrapper li.menu-item a').css({margin:"0 28px"});
        jQuery('.menu-header-menu-container,.menu-header-menu-he-container').removeClass('inactive');
	if($(window).width()<2030){
		if(isMobile()){
			$('.title_icon').addClass("inactive")
			$(".menu_wrapper,.logo_wrapper,.copy_wrapper,.footer_logo_wrapper,.footer_menu_wrapper,.three_lines").addClass("responsive");//.lang_wrapper,
			jQuery('.menu-header-menu-container,.menu-header-menu-he-container').addClass('inactive');
			$(".menu_wrapper").css({width:0})
			$(".menu-header-menu-container,.menu-header-menu-he-container").css("margin-top","98px");
			if($('.lang_wrapper').size()>0)$('#header .menu').append("<li class=\"menu-item lang_item\"></li>").find('li.lang_item').append($('.lang_wrapper:first').removeClass('rtl-float-right'));
		}
		else $(".menu_wrapper").css({width:($(window).width()-24-$('.lang_wrapper').outerWidth()-$('.logo_wrapper').outerWidth()-1)})
		
		if($(window).width()<430||$(document).width()<430){
			if(isHe())$('.logo_wrapper').css({padding:"22px 20px 22px 0"})
                        else $('.logo_wrapper').css({padding:"22px 0px 22px 20px"})
                        //$(".logo_wrapper,.logo_wrapper img").css({width:($(window).width()-/*$('.lang_wrapper').outerWidth()-*/$('.three_lines').outerWidth()-/*51*/21)})
			//$(".logo_wrapper img").css("padding-top",((45-$(".logo_wrapper img").height())/2)+"px")
            if(!msie())$(".logo_wrapper img").prop("src",pathToImgFolder+"/img/logo_mobile.png").css({width:'auto',height:'auto'})
			else $(".logo_wrapper img").attr("src",pathToImgFolder+"/img/logo_mobile.png").css({width:'auto',height:'auto'})

			$(".three_lines").addClass("mini_responsive");//.css("background-image",pathToImgFolder+"/img/three_lines_mobile.png").css({width:'80px',height:'80px'})
                        $('.logo_wrapper').css({width:'auto'})
                        //$(".menu_wrapper").css({width:($(window).width()-$('.lang_wrapper').outerWidth()-$('.logo_wrapper').outerWidth()-$('.three_lines').outerWidth()-1)})
		}
		else if($('.menu_wrapper').height()>100)$('.menu_wrapper li a').css({margin:"0 10px"});
	}
	else if($(window).width()>2030){
		var p="10px "+(($(window).width()/2-645-255-1)/2)+"px"
		$('.logo_wrapper').css({padding:p})
	}
}


function setHeaderActions(){
	$('#lang_sel li:first').unbind('click');
	$('.three_lines').unbind('click');
	if(isMobile()){
		$('#lang_sel li:first').bind('click',function(){
			if($(this).hasClass('clicked'))$(this).removeClass('clicked')
				else $(this).addClass('clicked')
		})
		$('.three_lines').bind('click',function(){
			var $parent=$(this).parents('#header').find('.menu_wrapper:first');
			if($parent.hasClass('clicked'))$parent.removeClass('clicked');
				else $parent.addClass('clicked')
		})
	}
}

function setFooterWidth(){
        $('.footer_menu_wrapper').removeClass("inactive")
	$('.responsive_footer_menu_wrapper').addClass("inactive")
	$('.footer_logo_wrapper').removeClass('inactive')
	$('.responsive_footer_menu_wrapper li').css("font-size","1em")
        $('.footer_menu_wrapper').css({margin:0})
	//$('#footer .copy_wrapper').addClass("rtl-float-right")
	if(currentLang=="he"){
		//$('.copy_wrapper').css({margin:"0 0 0 36px"})
		//$('.footer_logo_wrapper').css({margin:"19px 0 0 36px"})
	}
	else{
		//$('.copy_wrapper').css({margin:"0 36px 0 0"})
		//$('.footer_logo_wrapper').css({margin:"19px 36px 0 0"})
	}
	$('.responsive_footer_menu_wrapper li').css({width:'auto'})
	if(isMobile()){
		$('.footer_menu_wrapper').addClass("inactive");
		$('.responsive_footer_menu_wrapper').removeClass("inactive");
		//$('.copy_wrapper').css({margin:"0 36px"})
		//$('.footer_logo_wrapper').css({margin:"19px 36px 0 36px"})
		$('.footer_logo_wrapper').addClass('inactive');
		if($(window).width()<600||$(document).width()<600)$('.responsive_footer_menu_wrapper li').css("font-size","0.6em")
		var lsw=0;
		$('.responsive_footer_menu_wrapper li').each(function(){
			lsw+=$(this).width()+5
			//alert($(this).width())
		})
		$('.responsive_footer_menu_wrapper li').css({width:'100%'})
		//alert($('.responsive_footer_menu_wrapper li').parents(".wrapper:first").width()+"/"+lsw);
		$('.responsive_footer_menu_wrapper li').css({padding:"0 "+Math.floor((($('.responsive_footer_menu_wrapper li').parents(".wrapper:first").width()-lsw)/$('.responsive_footer_menu_wrapper li').size())/2)+"px"})
		//$('#footer .copy_wrapper').removeClass("rtl-float-right").css({margin:"0 auto"})
	}
        else $('.footer_menu_wrapper').css({margin:"0 "+(($('#footer .wrapper').width()-$('#footer .footer_menu_wrapper:last').outerWidth(true)-$('#footer .copy_wrapper').outerWidth(true)-$('#footer .footer_logo_wrapper').outerWidth(true))/2-10)+"px"})
        
        $('.former_footer').css({position:'static'})
        if($('.former_footer').height()+$('.former_footer').offset()['top']<$(window).height())$('.former_footer').css({position:'absolute',bottom:0,width:"100%"})
}

function personnelDescription(){
        
	$('.personnel_gallery_wrapper').each(function(){
        setPersonnelDescription($(this).find('.gallery_block:first'))
	})
    $('.personnel_detail .round_image').css({height:$('.personnel_detail .round_image').width()})
	//setPersonnelDescription($('.personnel_gallery_wrapper .gallery_block:first'));
	$('.personnel_gallery_wrapper .gallery_block').each(function(){
		var $this=$(this);
		$(this).unbind('click').bind('click',function(){
			setPersonnelDescription($this);
			setPersonnelWidth()
                        $('.personnel_detail .round_image').css({height:$('.personnel_detail .round_image').width()})
			iMargin($('.personnel_detail imargin'),'a')
		})
	})
}

function setPersonnelDescription($el){
	$el.parents(".personnel:first").find('.personnel_detail').html($el.html()+"<div class=\"clear\"></div>");
	//$('.personnel_detail').html($el.html()+"<div class=\"clear\"></div>");
	$el.parents(".roller:first").find(".gallery_block").removeClass("blue");
    //alert($el.outerWidth()+"/"+$el.parents('.gallery_wrapper').width())
	if(Math.floor(($el.outerWidth()+10)/$el.parents('.gallery_wrapper').width())==1){}
    else $el.addClass("blue");
}

function autoRoller($galleryWrapper){
    return $galleryWrapper.parents(".homepage_companies").size()>0
}

function setGalleryCarousel($galleryWrapper){
	var $test=$("<div></div>").append($galleryWrapper.find('.gallery_block:first').clone().removeClass("blue")),test=$test.html()
	//if($galleryWrapper.find('.gallery_block').size()<4)$galleryWrapper.find('.all').prepend(test+test+test+test+test);
	
        /*if(autoRoller($galleryWrapper)){
            $galleryWrapper.find(".all .clear:last").remove()
            $galleryWrapper.find('.gallery_block').each(function(){
                $galleryWrapper.find(".all").append($(this).clone())
            })
            $galleryWrapper.find(".all").append("<div class=\"clear\"></div>");
        }*/
        
	var gww=$galleryWrapper.width(),bw=$galleryWrapper.find('.gallery_block:first').width(),x=Math.floor(gww/bw),c=x>6?6:(x==0?1:x),p=(gww-bw*c)/(c-(c<2?0:1));
	//alert(gww-bw*c)
	//alert(c+"/"+bw+"/"+p+"/"+$galleryWrapper.find('.gallery_block').size()+"/"+(c==1?0:p))
	
	if(p<5&&c>1&&$('.personnel_gallery_wrapper').size()==0){
		c--;
		p=(gww-bw*c)/(c-(c<2?0:1));
	}
	if(p<0)p=0;
	
	$galleryWrapper.find(".all").css({width:(bw+p+1)*$galleryWrapper.find('.gallery_block').size()-(c==1?0:(!autoRoller($galleryWrapper)?p:-1))})
	
        if(c==1){
		$galleryWrapper.find('.gallery_block').css({padding:"0 "+p/2+"px 0 "+p/2+"px"});
	}
	else if(!isHe($galleryWrapper)&&!isBack($galleryWrapper)||isHe($galleryWrapper)&&isBack($galleryWrapper)){
		$galleryWrapper.find('.gallery_block').css({padding:"0 0 0 "+p+"px"});
		//if(!autoRoller($galleryWrapper))
                    $galleryWrapper.find('.gallery_block:first').css({padding:"0"});
	}
	else{
		$galleryWrapper.find('.gallery_block').css({padding:"0 "+p+"px 0 0"});
		//if(!autoRoller($galleryWrapper))
                    $galleryWrapper.find('.gallery_block:first').css({padding:"0"});
	}
	
	if($galleryWrapper.parents(".roller").find('.gallery_controls').size()>0)$galleryWrapper.parents(".roller").find('.gallery_controls').remove();
	
        if($galleryWrapper.find(".all").width()-$galleryWrapper.width()>p){
		if(!isHe($galleryWrapper)&&!isBack($galleryWrapper)||isHe($galleryWrapper)&&isBack($galleryWrapper)){
			var i=1,pc=Math.ceil(($galleryWrapper.find(".all").width()-10)/$galleryWrapper.width());
			//alert($galleryWrapper.find(".all").width()/$galleryWrapper.width())
			if($galleryWrapper.hasClass('infinite'))pc=0;
                        if(pc>5&&isMobile())pc=5;
			var $c="<div class=\"gallery_controls\" style=\"width:"+(30*pc+95)+"px\"><img src=\""+pathToImgFolder+"/img/prev.png\" alt=\"\" style=\"float:left\" onclick=\"changeGalleryPage(this,'prev')\" class=\"prev\" />";
			
			for(i=1;i<=pc;i++)$c+="<div style=\"float:left\" class=\"page"+(i==1?" blue":"")+"\" onclick=\"changeGalleryPage(this,"+i+")\"></div>";
			$c+="<img src=\""+pathToImgFolder+"/img/next.png\" alt=\"\" style=\"float:left\" onclick=\"changeGalleryPage(this,'next')\" class=\"next\" /><div class=\"clear\"></div></div>";
			$galleryWrapper.parents(".roller").append($c);
		
		}
		else{
                        var i=1,pc=Math.round($galleryWrapper.find(".all").width()/$galleryWrapper.width());
			//alert($galleryWrapper.find(".all").width()/$galleryWrapper.width())
			if($galleryWrapper.hasClass('infinite'))pc=0;
                        if(pc>5&&isMobile())pc=5;
			var $c="<div class=\"gallery_controls\" style=\"width:"+(30*pc+95)+"px\"><img src=\""+pathToImgFolder+"/img/next.png\" alt=\"\" style=\"float:right\" onclick=\"changeGalleryPage(this,'prev')\" class=\"prev\" />";
			
			for(i=1;i<=pc;i++)$c+="<div style=\"float:right\" class=\"page"+(i==1?" blue":"")+"\" onclick=\"changeGalleryPage(this,"+i+")\"></div>";
			$c+="<img src=\""+pathToImgFolder+"/img/prev.png\" alt=\"\" style=\"float:right\" onclick=\"changeGalleryPage(this,'next')\" class=\"next\" /><div class=\"clear\"></div></div>";
			$galleryWrapper.parents(".roller").append($c);
                }
	}
	
	$galleryWrapper.parents(".roller").find('.prev,.next').unbind("mouseover").bind("mouseover",function(){
		if(!msie())$(this).prop("src",$(this).prop("src").replace(/\.png$/ig,'_active.png'))
		else $(this).prop("src",$(this).attr("src").replace(/\.png$/ig,'_active.png'))
	}).unbind("mouseout").bind("mouseout",function(){
		if(!msie())$(this).prop("src",$(this).prop("src").replace(/_active\.png$/ig,'.png'))
		else $(this).attr("src",$(this).attr("src").replace(/_active\.png$/ig,'.png'))
	})
        
        //
        if(autoRoller($galleryWrapper)){
            //alert($galleryWrapper.prop('class'))
            
            setAutoRoller($galleryWrapper);
            //if(!$galleryWrapper.hasClass('backwards'))$galleryWrapper.find('all').css('margin-left',-1000)
        }
}

function setAutoRoller($galleryWrapper){
    //return;
    $galleryWrapper.parents(".homepage_companies").find(".gallery_controls").addClass("inactive")
	if(!msie()){
		if(!autorollers[$galleryWrapper.prop('class')]){
			autorollers[$galleryWrapper.prop('class')]=true;
			setInterval(function(){
				if(!isBack($galleryWrapper))changeGalleryPage($(".homepage_companies .roller:first .next"),'next',autoRollerFunc)
				else changeGalleryPage($(".homepage_companies .roller:last .next"),'next',autoRollerBackwardsFunc)
			},5000);
		}
	}
	else{
		if(!autorollers[$galleryWrapper.attr('class')]){
			autorollers[$galleryWrapper.attr('class')]=true;
			setInterval(function(){
				if(!isBack($galleryWrapper))changeGalleryPage($(".homepage_companies .roller:first .next"),'next',autoRollerFunc)
				else changeGalleryPage($(".homepage_companies .roller:last .next"),'next',autoRollerBackwardsFunc)
			},5000);
		}
	}
}

function autoRollerFunc(p,$el){
	//try{
    //return;
        var $all=$(".homepage_companies .gallery_wrapper.first .all"),padding1=$all.find(".gallery_block:first").css('padding')+"",padding=$all.find(".gallery_block:eq(1)").css('padding')+"",styling1=$all.find(".gallery_block:first").attr?$all.find(".gallery_block:first").attr("style"):'padding:'+$all.find(".gallery_block:first").css("padding"),styling=$all.find(".gallery_block:eq(1)").attr?$all.find(".gallery_block:eq(1)").attr("style"):'padding:'+$all.find(".gallery_block:eq(1)").css("padding")
        if(styling.clone)styling=styling.clone()
        if(styling1.clone)styling1=styling1.clone()
        $all.find(".clear:last").remove()
        if(!msie()){
			$all.find(".gallery_block:eq(1)").prop('style',styling1)
			$all.css({margin:0}).append($all.find(".gallery_block:first").prop('style',styling)).append("<div class=\"clear\"></div>");
		}
		else{
			$all.find(".gallery_block:eq(1)").attr('style',styling1)
			$all.css({margin:0}).append($all.find(".gallery_block:first").attr('style',styling)).append("<div class=\"clear\"></div>");
		}
        
        if(padding&&padding1){
            $all.find(".gallery_block:last").css('padding',padding)
            $all.find(".gallery_block:first").css('padding',padding1)
        }
        //$all.find(".gallery_block:last img").each(function(){iMargin($(this))});
        //alert($all.get(0).outerHTML)
        //$all.css({margin:0});
        //alert($all.css('margin'))
        //$all.replaceWith($all.clone())
        /*setTimeout(function(){
            $(".homepage_companies .gallery_wrapper.first .all").css({margin:0})
        },3000)*/
        if(!msie())rolling[$el.parents('.roller').find('.gallery_wrapper').prop("class")]=false;
		else rolling[$el.parents('.roller').find('.gallery_wrapper').attr("class")]=false;
	//}
	//catch(e){}
}

function autoRollerBackwardsFunc(p,$el){
	if(msie())return;
    //return;
	if(!msie()){
        var $all=$(".homepage_companies .gallery_wrapper.backwards .all"),styling1=$all.find(".gallery_block:first").attr?$all.find(".gallery_block:first").attr("style"):'padding:'+$all.find(".gallery_block:first").css("padding"),styling=$all.find(".gallery_block:eq(1)").attr?$all.find(".gallery_block:eq(1)").attr("style"):'padding:'+$all.find(".gallery_block:eq(1)").css("padding")
        $all.find(".clear:last").remove()
        $all.find(".gallery_block:eq(1)").prop('style',styling1)
        $all.find(".clear:last").remove()
        $all.find(".gallery_block:eq(1)").prop('style',styling1)
        $all.css({margin:0}).append($all.find(".gallery_block:first").prop('style',styling)).append("<div class=\"clear\"></div>");
        $all.replaceWith($all.clone())
        rolling[$el.parents('.roller').find('.gallery_wrapper').prop("class")]=false;
	}
	else{
		var $all=$(".homepage_companies .gallery_wrapper.backwards .all"),styling1=$all.find(".gallery_block:first").attr?$all.find(".gallery_block:first").attr("style"):'padding:'+$all.find(".gallery_block:first").css("padding"),styling=$all.find(".gallery_block:eq(1)").attr?$all.find(".gallery_block:eq(1)").attr("style"):'padding:'+$all.find(".gallery_block:eq(1)").css("padding")
        $all.find(".clear:last").remove()
        $all.find(".gallery_block:eq(1)").attr('style',styling1)
        $all.find(".clear:last").remove()
        $all.find(".gallery_block:eq(1)").attr('style',styling1)
        $all.css({margin:0}).append($all.find(".gallery_block:first").attr('style',styling)).append("<div class=\"clear\"></div>");
        $all.replaceWith($all.clone())
        rolling[$el.parents('.roller').find('.gallery_wrapper').attr("class")]=false;
	
	}
}

/*function infiniteRollerFunc(page){
    var $galleryWrapper=$globalEl?$globalEl.parents('.roller').find('.infinite'):$('.infinite:first'),gww=$galleryWrapper.width(),bw=$galleryWrapper.find('.gallery_block:first').width(),$all=$galleryWrapper.find('.all'),m=isHe($galleryWrapper)||isBack($galleryWrapper)?Math.abs(parseInt(($all.css("margin-right")+"").replace(/\s*px$/ig,""))):Math.abs(parseInt(($all.css("margin-left")+"").replace(/\s*px$/ig,""))),
            //mb=!isHe($galleryWrapper)&&!isBack($galleryWrapper)?Math.abs(parseInt($all.css("margin-right").replace(/\s*px$/ig,""))):Math.abs(parseInt($all.css("margin-left").replace(/\s*px$/ig,""))),
            x=Math.floor(gww/bw),c=x>6?6:(x==0?1:x),p=(gww-bw*c)/(c-(c<2?0:1)),styling=$all.find(".gallery_block:eq(1)").attr?$all.find(".gallery_block:eq(1)").attr("style"):'padding:'+$all.find(".gallery_block:eq(1)").css("padding")
    //alert($all.width()+"-"+m+"/"+$galleryWrapper.width()+"="+($all.width()-m)/$galleryWrapper.width())
    if($all.width()-m<$galleryWrapper.width()&&(($all.width()-m)/$galleryWrapper.width())>0.1){
        //alert($all.find(".gallery_block:eq(1)").attr("style"))
        $all.find('.clear:last').remove();
        $all.find('.gallery_block').each(function(){
            //$all.append($(this).clone().css({padding:padding}));
            $all.append($(this).clone().prop("style",styling));
        })
        $all.append("<div class=\"clear\"></div>");
        $all.css({width:(bw+p+1)*$galleryWrapper.find('.gallery_block').size()-(c==1?0:(!autoRoller($galleryWrapper)?p:-1))})
    }
    if(m>10&&page=='prev'){
        var styling1=$all.find(".gallery_block:first").attr?$all.find(".gallery_block:first").attr("style"):'padding:'+$all.find(".gallery_block:first").css("padding")
        if(styling1.clone)styling1=styling1.clone()
        //alert(styling1+"/"+styling)
        //$all.find(".gallery_block:eq(1)").prop("style",styling)
        $all.find('.gallery_block:first').prop("style",styling);
        $all.prepend($all.find('.gallery_block:last').prop("style",styling1)).css(isHe($galleryWrapper)||isBack($galleryWrapper)?'margin-right':'margin-left',0)
        
    }
    /*alert(mb+"%"+$galleryWrapper.width()+"<"+$galleryWrapper.width()+"||"+(mb/$galleryWrapper.width()))
    if((mb%$galleryWrapper.width())<$galleryWrapper.width()||mb/$galleryWrapper.width()>0.98&&mb/$galleryWrapper.width()<1.1){
        //$(".gallery_block").get().reverse()
        var i=0;
        $($all.find('.gallery_block').get().reverse()).each(function(){
            //$all.append($(this).clone().css({padding:padding}));
            var $clone=$(this).clone();
            i+=$clone.outerWidth();
            $all.prepend($clone.prop("style",styling));
        })
        $all.css({width:(bw+p+1)*$galleryWrapper.find('.gallery_block').size()-(c==1?0:(!autoRoller($galleryWrapper)?p:-1))})
        if(isHe($galleryWrapper)||isBack($galleryWrapper))$all.css('margin-left',parseInt($all.css('margin-left').replace(/\s*px/ig,""))-i)
        else $all.css('margin-left',parseInt($all.css('margin-right').replace(/\s*px/ig,""))-i)
    }*/
    /*if($globalEl){
        $('.infinite').each(function(){
            rolling[$(this).prop("class")]=false;
        })
    }
    else rolling={}
    $globalEl=false;
}*/

function changeGalleryPage(el,p,fn){
	if($(el).size()==0)return;
	if(!msie()){
        if(!autoRoller($(el).parents(".roller").find(".gallery_wrapper")))if(rolling[$(el).parents('.roller').find('.gallery_wrapper').prop("class")])return;
        //if(autoRoller($(el).parents(".roller").find(".gallery_wrapper")))
		rolling[$(el).parents('.roller').find('.gallery_wrapper').prop("class")]=true;
	}
	else{
		if(!autoRoller($(el).parents(".roller").find(".gallery_wrapper")))if(rolling[$(el).parents('.roller').find('.gallery_wrapper').attr("class")])return;
        //if(autoRoller($(el).parents(".roller").find(".gallery_wrapper")))
		rolling[$(el).parents('.roller').find('.gallery_wrapper').attr("class")]=true;
	}
	var $el=$(el),$p=$el.parents(".roller").find(".all"),m=0,gww=$el.parents(".roller").find(".gallery_wrapper").width(),i=1,max=$el.parents(".roller").find(".all").width();
        var pad=0,page=p;
        if($el.parents(".roller").find(".gallery_wrapper").find('.gallery_block:eq(1)').size()>0)pad=parseFloat(($el.parents(".roller").find(".gallery_wrapper").find('.gallery_block:eq(1)').css('padding-left')+"").replace(/(^-|px$)/ig,""))+parseFloat(($el.parents(".roller").find(".gallery_wrapper").find('.gallery_block:eq(1)').css('padding-right')+"").replace(/(^-|px$)/ig,""));
	else pad=parseFloat(($el.parents(".roller").find(".gallery_wrapper").find('.gallery_block:first').css('padding-left')+"").replace(/(^-|px$)/ig,""))+parseFloat(($el.parents(".roller").find(".gallery_wrapper").find('.gallery_block:first').css('padding-right')+"").replace(/(^-|px$)/ig,""));
            
	$el.parents(".roller").find('.gallery_controls div').removeClass("blue");
	if(pad+$el.parents(".roller").find(".gallery_wrapper").find('.gallery_block').width()>gww)pad=0;
        //alert($el.parents(".roller").find(".gallery_wrapper").find('.gallery_block').width()+"/"+$el.parents(".roller").find(".gallery_wrapper").width())
        if(autoRoller($el.parents(".roller").find(".gallery_wrapper"))||$el.parents(".roller").find(".infinite").size()>0||gww<$el.parents(".roller").find(".gallery_wrapper").find('.gallery_block').width())gww=$el.parents(".roller").find(".gallery_wrapper").find('.gallery_block').width();
	//alert(autoRoller($el.parents(".roller").find(".gallery_wrapper"))+"/"+$el.parents(".roller").find(".infinite").size()+"/"+gww+"/"+$el.parents(".roller").find(".gallery_wrapper").find('.gallery_block').width())	
        
        //if(!$globalEl)$globalEl=$el;
        //else $globalEl=false;
        
        if($el.parents('.roller').find('.infinite').size()>0){
            var $all=$el.parents('.roller').find('.all'),ml=parseInt(($all.css('margin-left')+"").replace(/\s*px$/ig,"")),mr=parseInt(($all.css('margin-right')+"").replace(/\s*px$/ig,""));
            var styling=$all.find(".gallery_block:eq(1)").attr?$all.find(".gallery_block:eq(1)").attr("style"):'padding:'+$all.find(".gallery_block:eq(1)").css("padding"),styling1=$all.find(".gallery_block:first").attr?$all.find(".gallery_block:first").attr("style"):'padding:'+$all.find(".gallery_block:first").css("padding")
            if(!isHe($el.parents(".roller").find(".gallery_wrapper"))&&!isBack($el.parents(".roller").find(".gallery_wrapper"))){
                //alert($all.width()+"/"+($all.width()-Math.abs(ml))+"/"+$el.parents(".roller").find(".gallery_wrapper").width())
                if(p=='prev'&&ml<10&&ml>-10){
                    $all.find('.gallery_block').prop('style',styling);
                    $all.prepend($all.find('.gallery_block:last').prop('style',styling1)).css('margin-left',ml-gww-pad)
                }
                else if(p=='next'&&($all.width()-Math.abs(ml))<$el.parents(".roller").find(".gallery_wrapper").width()+10){
                    $all.find('.clear:last').remove();
                    $all.append($all.find('.gallery_block:first').prop('style',styling)).append('<div class="clear"></div>').css('margin-left',ml+gww+pad)
                    $all.find('.gallery_block:first').prop('style',styling1);
                }
            }
            else{
                if(p=='prev'&&mr<10&&mr>-10){
                    $all.find('.gallery_block').prop('style',styling);
                    $all.prepend($all.find('.gallery_block:last').prop('style',styling1)).css('margin-right',mr-gww-pad)
                }
                else if(p=='next'&&($all.width()-Math.abs(mr))<$el.parents(".roller").find(".gallery_wrapper").width()+10){
                    $all.find('.clear:last').remove();
                    $all.append($all.find('.gallery_block:first').prop('style',styling)).append('<div class="clear"></div>').css('margin-right',mr+gww+pad)
                    $all.find('.gallery_block:first').prop('style',styling1);
                }
            }
        }
        
        if(!fn)/*if($el.parents('.roller').find('.infinite').size()>0)fn=infiniteRollerFunc;
            else*/ fn=function(p,$el){
                //alert($el.parents('.roller').find('.gallery_wrapper').html())
                var key=$el.parents('.roller').find('.gallery_wrapper').prop("class");
                if(key&&rolling[key])rolling[key]=false;
                else rolling={}
            }
        
        if(!isHe($el.parents(".roller").find('.gallery_wrapper'))&&!isBack($el.parents(".roller").find('.gallery_wrapper'))||isHe($el.parents(".roller").find('.gallery_wrapper'))&&isBack($el.parents(".roller").find('.gallery_wrapper'))){
		if(p>0)m=(gww+pad)*(p-1);
		else if('prev'==p){
                    m=parseInt($el.parents(".roller").find(".all").css("margin-left").replace(/(^-|px$)/ig,""))-gww-pad;
                }
                else if('next'==p){
                    m=parseInt($el.parents(".roller").find(".all").css("margin-left").replace(/(^-|px$)/ig,""));
                    /*if((Math.abs(max)-Math.abs(m))/$el.parents(".roller").find(".gallery_wrapper").width()>1&&(Math.abs(max)-Math.abs(m))/$el.parents(".roller").find(".gallery_wrapper").width()<1.1){
                        rolling[$(el).parents('.roller').find('.gallery_wrapper').prop("class")]=false;
                        return;
                    }*/
                    m=m+gww+pad;
                }
                //alert($el.parents(".roller").find(".all").css("margin-left")+(Math.abs(m)<Math.abs(max))+"/"+(Math.abs(m)/Math.abs(max)<0.98)+"/"+(m>=-10)+"/"+(Math.abs(m)/Math.abs(max)))
		
                if(Math.abs(m)<Math.abs(max)&&Math.abs(m)/Math.abs(max)<0.98&&(m>=-10||$el.parents(".roller").find('.gallery_wrapper').hasClass("infinite"))){
                    $p.animate({margin:"0 0 0 "+(-m)+"px"},1000,false,function(){fn(page,$el)});
                }
		else{
                    if('prev'==p)m+=gww+pad;
                    else if('next'==p)m-=gww+pad;
                    //alert(rolling[$(el).parents('.roller').find('.gallery_wrapper').prop("class")]+"/"+$(el).parents('.roller').find('.gallery_wrapper').prop("class"))
        
                    rolling[$(el).parents('.roller').find('.gallery_wrapper').prop("class")]=false;
                }
		
	}
	else{
                //$p.replaceWith($p.clone())
                if(p>0)m=(gww+pad)*(p-1);
		else if('prev'==p){
                    m=parseInt($el.parents(".roller").find(".all").css("margin-right").replace(/(^-|px$)/ig,""))-gww-pad;
                }
		else if('next'==p){
                    m=parseInt($el.parents(".roller").find(".all").css("margin-right").replace(/(^-|px$)/ig,""));
                    /*if((Math.abs(max)-Math.abs(m))/$el.parents(".roller").find(".gallery_wrapper").width()>1&&(Math.abs(max)-Math.abs(m))/$el.parents(".roller").find(".gallery_wrapper").width()<1.1){
                        rolling[$(el).parents('.roller').find('.gallery_wrapper').prop("class")]=false;
                        return;
                    }*/
                    m=m+gww+pad;
                }
		
                if(Math.abs(m)<Math.abs(max)&&Math.abs(m)/Math.abs(max)<0.98&&(m>=-10||$el.parents(".roller").find('.gallery_wrapper').hasClass("infinite"))){
                    $p.animate({margin:"0 "+(-m)+"px 0 0"},1000,false,function(){fn(page,$el)});
                }
                else{
                    if('prev'==p)m+=gww+pad;
                    else if('next'==p)m-=gww+pad;
                    rolling[$(el).parents('.roller').find('.gallery_wrapper').prop("class")]=false;
                }
		
        }
	
	p=Math.round(m/(gww+pad)+1);
	if(p<2)p=1;
	$el.parents(".roller").find('.gallery_controls div').each(function(){
		if(i==p)$(this).addClass("blue");
		i++;
	});
	
	ap=Math.round(max/gww)
	
	//var $prev=$el.parents(".roller").find('.prev'),$next=$el.parents(".roller").find('.next');
	if(!isHe()){
		/*if(p>1&&false)$prev.prop("src",pathToImgFolder+"/img/prev_active.png");
		else */
		//$prev.prop("src",pathToImgFolder+"/img/prev.png");
		/*if(p<al&&false)$next.prop("src",pathToImgFolder+"/img/next_active.png");
		else */
		//$next.prop("src",pathToImgFolder+"/img/next.png");
	}
	else{
		/*if(p>1&&false)$prev.prop("src",pathToImgFolder+"/img/next_active.png");
		else*/ 
		//$prev.prop("src",pathToImgFolder+"/img/next.png");
		/*if(p<ap&&false)$next.prop("src",pathToImgFolder+"/img/prev_active.png");
		else*/
		//$next.prop("src",pathToImgFolder+"/img/prev.png");
	}
        
        if($el.parents('.personnel').size()>0&&Math.round(gww/$el.parents(".roller").find(".gallery_wrapper .gallery_block:first").outerWidth())==1){
            var j=0;
            $el.parents(".roller").find('.personnel_gallery_wrapper .gallery_block').each(function(){
                    var $this=$(this);
                    if(++j==p){
                        setPersonnelDescription($this);
                        setPersonnelWidth()
                        $('.personnel_detail .round_image').css({height:$('.personnel_detail .round_image').width()})
                        iMargin($('.personnel_detail imargin'),'a')
                    }
            })
        }
}

function isHe($galleryWrapper){
	//return $galleryWrapper.hasClass("he");
	return currentLang=="he"
}

function isBack($galleryWrapper){
	return $galleryWrapper.hasClass('backwards');
	return currentLang=="he"
}

function setHPOverviewWidth(){
	var b=$('.homepage_overview_blocks').width();
	$('.overview_block').css({width:"31.7%",padding:"0 "+(b*0.024)+"px 30px 0"});
	$('.overview_block:first').css({width:"31.7%",padding:"0 0 30px 0"});
	//$('.overview_wrapper .overview_counter_icon').css({width:215,height:215})
	//$('.overview_wrapper .homepage_overview_blocks,.overview_wrapper  .overview_motto').removeClass("responsive");
	if(isMobile()){
		$('.overview_block').css({width:/*$('.homepage_overview_blocks').width()-30*/"100%",padding:"0 0 30px 0"});
		//$('.overview_counter_icon').css({width:$('.overview_counter_icon').parents('div:first').width()*2/3,height:$('.overview_counter_icon').parents('div:first').width()*2/3})
		//$('.overview_wrapper .homepage_overview_blocks,.overview_wrapper .overview_motto').addClass("responsive");
	}
}

function setOverviewWidth(){
	$('.overview').prepend($('.overview_content'));
	$('.overview_content').css({width:"65%"})
	$('.overview_icons').css({width:"31%"})
        if(isHe())$('.overview_icons').css("margin-right","29px")
        else $('.overview_icons').css("margin-left","29px")
	if(isMobile()){
		$('.overview').prepend($('.overview_icons'));
		$('.overview_content,.overview_icons').css('width','100%')
                $('.overview_icons').css("margin-left","0").css("margin-right","0")
	}
}

function loadPlayer(file){
    	scrollTop=document.getElementsByTagName("body")[0].scrollTop;
	closePlayer();
        $('body').css({height:$(window).height()-($('#wpadminbar').size()>0?$('#wpadminbar').height():0),overflow:'hidden'})
        var bw=$(window).width(),bh=$(window).height(),w=$(window).width()-60,h=$(window).height()-60;
	if(w>640)w=640;
	if(h>480)h=480;
        if(h>$(window).height()-$('#wpadminbar').height()-60)h=$(window).height()-$('#wpadminbar').height()-60;
	if(h/w>3/4)h=w*3/4
        /*if(isMobile()){
            $('body').append('<div class="player"><div class="close" style="margin-right:0;"><img src="'+pathToImgFolder+'/img/close.png" alt="" onclick="closePlayer()" /></div><div class="clear"></div><div class="player_wrapper"><div id="player"></div><script type="text/javascript">player=jwplayer("player");player.setup({file:"'+file+'",width:"'+w+'",height:"'+h+'",autostart:true});</script></div></div>')
            $('.player').prepend("<div style=\"height:"+((bh-0-h)/2)+"px\"></div>");
            $('.player_wrapper').addClass("left").css({float:"left"}).before("<div class=\"left\" style=\"width:"+((bw-w)/2-1)+"px;height:"+h+"px\"></div>").after("<div class=\"left\" style=\"width:"+((bw-w)/2)+"px;height:"+h+"px\"></div>").next().after("<div class=\"clear\" style=\"height:"+((bh-0-h)/2)+"px !important\"></div>")//.css({margin:(((bh-0-h)/2))+"px "+((bw-w)/2)+"px "+((bh-60-h)/2)+"px",top:0,left:0});
            if($('#wpadminbar').size()>0&&!isMobile())$('.player').css({top:$('#wpadminbar').height()})
        }
        else{*/
            $('body').append('<div class="player"><div class="close"><img src="'+pathToImgFolder+'/img/close.png" alt="" onclick="closePlayer()" /></div><div class="clear"></div><div id="player"></div><script type="text/javascript">player=jwplayer("player");player.setup({file:"'+file+'",width:"'+w+'",height:"'+h+'",autostart:true});</script></div>')
            //alert(bw+"/"+w)
            $('.player').css({padding:(((bh-30-h)/2))+"px "+((bw-w)/2)+"px "+((bh-30-h)/2)+"px",top:0,left:0});
            if($('#wpadminbar').size()>0&&!isMobile())$('.player').css({top:$('#wpadminbar').height()})
        //}
}

function closePlayer(){
	$('.player').remove();
        $('body').css({height:'auto',overflow:'visible'})
        if(scrollTop!=0)window.scrollTo(0,scrollTop)
}

function resizePlayer(){
    if($('.player').size()>0)try{
        $('body').css({height:$(window).height()-($('#wpadminbar').size()>0?$('#wpadminbar').height():0),overflow:'hidden'})
        var bw=$(window).width(),bh=$(window).height(),w=$(window).width()-60,h=$(window).height()-60;
	if(w>640)w=640;
	if(h>480)h=480;
        if(h>$(window).height()-$('#wpadminbar').height()-60)h=$(window).height()-$('#wpadminbar').height()-60;
	if(h/w>3/4)h=w*3/4
        
        /*if(isMobile()){
            $('body').append('<div class="player"><div class="close" style="margin-right:0;"><img src="'+pathToImgFolder+'/img/close.png" alt="" onclick="closePlayer()" /></div><div class="clear"></div><div class="player_wrapper"><div id="player"></div><script type="text/javascript">player=jwplayer("player");player.setup({file:"'+file+'",width:"'+w+'",height:"'+h+'",autostart:true});</script></div></div>')
            $('.player').prepend("<div style=\"height:"+((bh-0-h)/2)+"px\"></div>");
            $('.player_wrapper').addClass("left").css({float:"left"}).before("<div class=\"left\" style=\"width:"+((bw-w)/2-1)+"px;height:"+h+"px\"></div>").after("<div class=\"left\" style=\"width:"+((bw-w)/2)+"px;height:"+h+"px\"></div>").next().after("<div class=\"clear\" style=\"height:"+((bh-0-h)/2)+"px !important\"></div>")//.css({margin:(((bh-0-h)/2))+"px "+((bw-w)/2)+"px "+((bh-60-h)/2)+"px",top:0,left:0});
            if($('#wpadminbar').size()>0&&!isMobile())$('.player').css({top:$('#wpadminbar').height()})
        }
        else{*/
            //$('body').append('<div class="player"><div class="close"><img src="'+pathToImgFolder+'/img/close.png" alt="" onclick="closePlayer()" /></div><div class="clear"></div><div id="player"></div><script type="text/javascript">player=jwplayer("player");player.setup({file:"'+file+'",width:"'+w+'",height:"'+h+'",autostart:true});</script></div>')
            player.resize(w,h)
            $('.player').css({padding:(((bh-30-h)/2))+"px "+((bw-w)/2)+"px "+((bh-30-h)/2)+"px",top:0,left:0});
            if($('#wpadminbar').size()>0&&!isMobile())$('.player').css({top:$('#wpadminbar').height()})
        //}
    }
    catch(e){}
}

function iMargin($img,p){
    //try{
    $img.each(function(){
        var $this=$(this);
        var newI = new Image();
        if($this.attr('src')){
            if($.browser&&$.browser.opera&&$.browser.version>10||!$.browser)setTimeout(function(){
                newI.onload = function(){
                    iMarginSet($this,newI,false,p)
                }
                newI.onerror = function(){
                    iMarginSet($this,newI,true,p)
                }
            },500);
            newI.onload = function(){
                iMarginSet($this,newI,false,p)
            }
            newI.onerror = function(){
                iMarginSet($this,newI,true,p)
            }
            newI.src = $this.attr('src');
        }
        else iMarginSet($this,newI,true,p)
    })
    //}
    //catch(e){}
}

function iMarginSet($this,newI,error,p){
    try{
		
		
		//if(!msie())
			var $parent=$this.parents().prop('tagName').toLowerCase()=='body'?$(window):$this.parents(),iw,ih,pw=$parent.width(),ph=$parent.height();
		//else var $parent=$this.parents().attr('tagName').toLowerCase()=='body'?$(window):$this.parents(),iw,ih,pw=$parent.width(),ph=$parent.height();
		//alert($this.attr('src'))
		if(error){
			$this.attr('src',pathToImgFolder+"/img/oops.png");
			iw=300
			ih=300
		}
		else{
			iw=newI.width
			ih=newI.height
		}
		
		if(p=='f')$this.css('margin-left',(pw-iw)/2).css('margin-top',(ph-ih)/2).css('height','auto').css('width','auto');
		else if(p=='a'){
			if(pw/ph<iw/ih)$this.css('margin-left',(pw-(iw*ph/ih))/2).css('margin-top',0).css('height','100%').css('width','auto');
			else $this.css('margin-top',(ph-(ih*pw/iw))/2).css('margin-left',0).css('width','100%').css('height','auto');
		}
		else{
			
			if(pw/ph>iw/ih)$this.css('margin-left',(pw-(iw*ph/ih))/2).css('margin-top',0).css('height','100%').css('width','auto');
			else $this.css('margin-top',(ph-(ih*pw/iw))/2).css('margin-left',0).css('width','100%').css('height','auto');
		}
    }
    catch(e){}
}

function setHP5PostsWidth(){
	$('.first_post,.second_third_fourth_and_fifth_post').css({width:"50%",margin:0});
	$('.second_and_third_post').css({width:"33.3%",height:636,margin:"0 10px"})//.css("margin-bottom",0)
	$('.fourth_and_fifth_post').css({width:"66.6%",height:636}).css("margin-bottom",0)
	$('.second_third_fourth_and_fifth_post').css({height:636,margin:"0"})
	$('.second_post,.third_post,.fourth_post,.fifth_post').css({height:314})
    $('.first_post').css({height:638})
	//$('.posts_block div').removeClass('float_none');
	if(msie()){
		$('.second_third_fourth_and_fifth_post').css({width:"49%",margin:0});
		$('.fourth_and_fifth_post').css({width:"64%",height:636})
	}
	if(isMobile()){
		$('.first_post,.second_third_fourth_and_fifth_post').css({width:"100%"}).css("margin-bottom","8px");
		//if(isHe())$('.second_third_fourth_and_fifth_post').css("margin-right","-8px");
		//else $('.second_third_fourth_and_fifth_post').css("margin-left","-8px");
		$('.second_and_third_post,.fourth_and_fifth_post').css({width:"100%",height:"auto"}).css("margin-bottom","10px")
		$('.second_third_fourth_and_fifth_post').css({height:"auto"})
		$('.second_and_third_post').css({margin:"0 0 10px"})
		$('.first_post,.second_post,.third_post,.fourth_post,.fifth_post').css({height:318})
		//if(msie())$('.posts_block div').addClass('float_none');
	}
}

function setHPCompanies(){
	//$('.homepage_company').css({margin:"0 2% 100px",width:"12.5%"})
        //if(isMobile())$('.homepage_company').css({margin:"0 3% 100px",width:"27%"})
	$('.homepage_company').css({width:"160px"})
	if(isMobile())$('.homepage_company').css({width:($('.homepage_company').parents('.gallery_wrapper:first').width()-48)/3})
        $('.homepage_company img').each(function(){iMargin($(this))});
}

function setCompanies(){
	$('.company').css({width:"20.4%"}).css("max-width","270px")
        if(!isHe())$('.company').css({margin:"0 4.6% 0 0"})
        else $('.company').css({margin:"0 0 0 4.6%"})
        $('.company_list .clear').remove()
        $('.company_list').append('<div class="clear"></div>')
	var i=0;
        if(isMobile()){
            $('.company').css({width:"100%",margin:0}).css("max-width","100%")
            $('.company').each(function(){
                if(++i%2==0)$(this).after('<div class="clear"></div>');
            })
        }
        else $('.company').each(function(){
            if(++i%4==0)$(this).after('<div class="clear"></div>');
        })
	$('.company img').each(function(){iMargin($(this))});
}

function setConferences(){
	$('.conference').css({width:"28.3%"})
	if(isMobile())$('.conference').css({width:"90%"})
}

function setPersonnelWidth(){
        
	$('.personnel_gallery_wrapper .gallery_block').css({width:180})
        
	if(!isHe()){
		//$('.personnel_detail .personnel_text_block').css("margin-left","7%")//.css("margin-left","90px")
		$('.personnel_detail .round_image').css("float","left")
	}
	else{
		//$('.personnel_detail .personnel_text_block').css("margin-right","7%")//.css("margin-right","90px");
		$('.personnel_detail .round_image').css("float","right")
	}
        $('.personnel_gallery_wrapper').removeClass('infinite')
	$('.personnel').each(function(){
            $(this).prepend($(this).find('.personnel_detail'))
        })
	
        if(isMobile()){
		//$('.personnel_detail .personnel_text_block').css("margin-right","0").css("margin-left","0");
		$('.personnel_detail .round_image').css("float","none").css("margin","0 auto");
                var pgwbw=Math.floor($('.personnel_gallery_wrapper').width()/3);
                pgwbw=pgwbw<180?180:pgwbw;
		$('.personnel_gallery_wrapper .gallery_block').css({width:pgwbw})
                $('.personnel_gallery_wrapper').addClass('infinite')
                
                $('.personnel').each(function(){
                    $(this).append($(this).find('.personnel_detail'))
                })
       }
        
        $('.personnel_detail .round_image').css({height:$('.personnel_detail .round_image').width()})
}

function setHPVideos(){
	$('.video_gallery_wrapper .gallery_block').css({width:'auto'})
	$('.video_gallery_wrapper .gallery_block .video,.video_gallery_wrapper .gallery_block .video_play_icon').css({width:411,height:244})
	$('.video_gallery_wrapper .gallery_block .video_play_icon img').css("margin-top","93px")
	$('.video_gallery_wrapper .all').css({height:285})
        $('.video_gallery_wrapper .video_name').each(function(){
                if(!msie())$(this).html($(this).prop('title'))
				else $(this).html($(this).attr('title'))
        })
	if(isMobile()){
		var w=Math.floor($('.video_gallery_wrapper').width())-10;
		$('.video_gallery_wrapper .gallery_block').css({width:w})
		$('.video_gallery_wrapper .gallery_block .video,.video_gallery_wrapper .gallery_block .video_play_icon').css({width:w,height:w*0.6})
		$('.video_gallery_wrapper .gallery_block .video_play_icon img').css("margin-top",((w*0.6-76)/2)+"px")
		$('.video_gallery_wrapper .all').css({height:w*0.7})
                $('.video_gallery_wrapper .video_name').each(function(){
                    if($(this).height()>$(this).parents('.video').height()/2-75){
                        var re=new RegExp("^([\\s\\S]{"+parseInt($(this).width()/10)+"})[\\s\\S]*?$","ig");
                        if(!msie())$(this).html($(this).prop('title').replace(re,"$1..."))
						else $(this).html($(this).attr('title').replace(re,"$1..."))
                    }
                })
	}
}

function subMenu(){
	$('.menu-item a').each(function(){
		$(this).unbind('click').bind('click',function(){
			if($(this).parents('li:first').find("li").size()>0){
				drawSubMenu($(this).html().replace(/((<[^>]*>)|[\r\n])+/ig,""),$(this).parents("li:first").find(".menu_item_description").html().replace(/((<[^>]*>)|[\r\n])+/ig,""),$(this).parents('li:first').find("li"));
				return false;
			}
		})
	})
}

function drawSubMenu(menuName,menuDescription,$lis){
	var $menus=$('<div class="menu_submenu_list rtl-float-left;"></div>'),$imgs=$('<div class="menu_images rtl-float-right"></div>'),$subMenu=$('<div class="submenu_wrapper"><div class="wrapper"><div class="close" onclick="closeSubMenu(this)"><img src="'+pathToImgFolder+'/img/close.png" alt="" /></div><div class="clear"></div></div></div>');
	$('.former_footer').after($subMenu);
	
	$('.submenu_wrapper .wrapper').append("<div class=\"parent_menu_name rtl-align-left\">"+menuName+"</div><div class=\"clear\"></div>");
	$('.submenu_wrapper .wrapper').append("<div class=\"parent_menu_description rtl-align-left\">"+menuDescription+"</div><div class=\"clear\"></div>");
	
	$lis.each(function(){
                $(this).find(".post_type_name a").css({margin:0})
                
		if($(this).find("a:last img").size()>0&&!isMobile()){
                    if(!$(this).find(".post_type_name").hasClass('empty'))$imgs.append('<div class="submenu_img_wrapper rtl-float-right"><img src="'+$(this).find("a:last img").attr("src")+'" alt="" /><div class="submenu_img_background"></div><div class="submenu_img_name">'+$(this).find(".post_type_name").clone().removeClass("inactive")[0].outerHTML+'<a href="'+$(this).find("a:last").attr("href")+'">'+$(this).find("a:last").html().replace(/((<[^>]*>)|[\r\n])+/ig,"")+'</div></div></div>');
                    else $imgs.append('<div class="submenu_img_wrapper rtl-float-right"><img src="'+$(this).find("a:last img").attr("src")+'" alt="" /><div class="submenu_img_background"></div><div class="submenu_img_name"><a href="'+$(this).find("a:last").attr("href")+'">'+$(this).find("a:last").html().replace(/((<[^>]*>)|[\r\n])+/ig,"")+'</div></div></div>');
                }
                else $menus.append("<div class=\"submenu_item\"><a href=\""+$(this).find("a:last").attr("href")+"\">"+$(this).find("a:last").html().replace(/((<[^>]*>)|[\r\n])+/ig,"")+"</a></div>")
	})
	
	$('.submenu_wrapper .wrapper').append("<div class=\"submenu_all\"></div>");
	$('.submenu_wrapper .wrapper .submenu_all').append($imgs);
	$('.submenu_wrapper .wrapper .submenu_all').append($menus);
	$('.submenu_wrapper .wrapper .submenu_all').append("<div class=\"clear\"></div>");
	
	$subMenu.css('min-height',$(window).height()).css('height','auto')
	if($('#wpadminbar').size()>0&&!isMobile())$subMenu.css({top:$('#wpadminbar').height()})
	$subMenu.find('.close').css({margin:"45px -62px 0 0"})
	if($(window).width()<1290+62)$subMenu.find('.close').css("margin-right",0);
	$subMenu.find('.submenu_img_wrapper').each(function(){
		$(this).css({height:$(this).width()*0.6})
	})
	iMargin($imgs.find("img"),'a')
        $('body').css({height:$('.submenu_wrapper').height()-($('#wpadminbar').size()>0?$('#wpadminbar').height():0),overflow:'hidden'})
}

function closeSubMenu(e){
	if(e)$(e).parents(".submenu_wrapper:first").remove();
        else $(".submenu_wrapper").remove();
        $('body').css({height:'auto',overflow:'visible'})
}

function setGuidelineWidth(){
	$('.guideline_button').css({margin:0})
	$('.guideline_button').css({margin:"34px "+(($('.guideline_button').parents('.wrapper:first').width()-$('.guideline_button').outerWidth())/2-10)+"px 64px"})
        $('.guideline').css({width:411});
        $('.guideline_description').css({width:409})
        if($('.gallery_wrapper').width()<411){
            $('.guideline').css({width:$('.gallery_wrapper').width()});
            $('.guideline_description').css({width:$('.gallery_wrapper').width()-2})
        }
}

function msie(){
    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");

    if (msie > 0)return true;
    return false;
}