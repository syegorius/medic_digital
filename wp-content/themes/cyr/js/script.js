var $=jQuery,pw=0,ph=0,test=false;

function isMobile(){
	if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|BB|PlayBook|IEMobile|Windows Phone|Kindle|Silk|Opera Mini/i.test(navigator.userAgent))return true;
	else if($(window).width()<=960)return true;
	return false;
}

$(document).ready(function(){
	setTimeout(function(){
		hasPlugin('flash');
		pw=$(window).width();
		ph=$(window).height();
				
		setHeaderHTML()
		setBodyHTML()
		setHeaderSize()
		setBodySize()
		setDifSize()
		
		$('.imargin').each(function(){if($(this).parents('.video').length==0)iMargin($(this))});
		$('.video .imargin').each(function(){iMargin($(this),'a')});
		
		pw=$(window).width();
		ph=$(window).height();
				
		$(window).resize(function(){
			if(pw!=$(window).width()||ph!=$(window).height()&&!isMobile()){
				pw=$(window).width();
				ph=$(window).height();
				
				setBodyHTML()
				setHeaderSize()
				setBodySize()
				$('.imargin').each(function(){if($(this).parents('.video').length==0)iMargin($(this))});
				$('.video .imargin').each(function(){iMargin($(this),'a')});
				resizePlayer()
				setDifSize()
			}
		})
	},100)
})

function setHeaderHTML(){
	$('li.menu-item ul li.menu-item').each(function(){
		$(this).append('<div class="clear"></div>')
	})
	$('li.menu-item ul').each(function(){
		$(this).parents('li:first').addClass("no_border-bottom");
		$(this).parents('li:first').find('a:first').attr('href','#').unbind('click').bind('click',function(){return false;}).css({cursor:'default'})//.addClass("no_border-bottom");
	})
	var y=0;
	$('li.menu-item').each(function(){
		if($(this).parents('li').length==0){
			y++
			if(y==1)$(this).find('a:first').css('border-color','#b4a780')
			else if(y==2)$(this).find('a:first').css('border-color','#445665')
			else if(y==3)$(this).find('a:first').css('border-color','#7ea1b7')
			else if(y==4)$(this).find('a:first').css('border-color','#f54c00')
		}
	})
}

function setHeaderSize(){
	$('.sub-menu').removeClass('hidden')
	$('body').removeClass("responsive");
	$('.three_lines,.close').addClass('inactive')
	$('.menu_wrapper').removeClass('inactive');
	$('.top_lilly').removeClass('inactive')
	$('.header_block').removeClass('fx').css("border-bottom",'none').css({top:0})
	$('#header .top_logo').css({margin:'18px 75px 0 0'})
	$('#header li.menu-item a,#header li.menu-item').css('padding','')
	$('.top_logo').css('padding-top',0)
	$('#header li.menu-item a').css({width:'auto'}).css('line-height','')
	$('.heder_bottom_line').removeClass('inactive')
	$('#body').css({height:'auto'})
	
	if(isMobile()){
		$('body').addClass("responsive");
		$('.menu_wrapper').addClass('inactive');
		$('#header .top_logo').css('margin','')
		$('.header_block').css("border-bottom",'6px solid #ddd')
		$('.heder_bottom_line').addClass('inactive')
		//alert($('.header_block').height()+"/"+$('.responsive .top_logo').height())
		$('.responsive .top_logo').css('padding-top',($('.header_block').height()-$('.responsive .top_logo').height())/2)
		if($('.responsive .top_logo').height()==0){
			var interval=setInterval(function(){
				if($('.responsive .top_logo').height()!=0){
					$('.responsive .top_logo').css('padding-top',($('.header_block').height()-$('.responsive .top_logo').height())/2)
					clearInterval(interval)
				}
			},500)
		}
		$('#header li.menu-item a span').each(function(){if($(this).parents('li').size()==1)$(this).css({padding:'0'})})
		$('.responsive .three_lines').removeClass('inactive').unbind('click').bind('click',function(){
			$('.header_block').addClass('fx').css({top:$('#wpadminbar').size()>0?$('#wpadminbar').height():0})
			$('.menu_wrapper,.responsive .close').removeClass('inactive');
			$(this).addClass('inactive')
			
			$('#header li.menu-item a').each(function(){liASize(this,39)})
			var h=0;
			$('.menu_wrapper li').each(function(){h+=$(this).outerHeight()})
			$('#body').css({height:h})
		})
		
		$('.responsive .close').unbind('click').bind('click',function(){
			$('.header_block').removeClass('fx').css({top:0})
			$('.menu_wrapper,.responsive .close').addClass('inactive');
			$('.responsive .three_lines').removeClass('inactive')
			$('#body').css({height:'auto'})
		})
	}
	else if($(window).width()<=1160){
		$('.top_lilly').addClass('inactive');
		$('#header .top_logo').css({margin:'18px 55px 0 0'})
		//$('#header li.menu-item a span').css({padding:'0 0 0 14px;'})
		$('#header li.menu-item a span').each(function(){if($(this).parents('li').size()==1)$(this).css({padding:'0 24px'})})
		$('#header ul li.menu-item ul a').each(function(){liASize(this,14)})
	}
	else{
		$('#header li.menu-item a span').each(function(){if($(this).parents('li').size()==1)$(this).css({padding:'0 44px'})})
		$('#header ul li.menu-item ul a').each(function(){liASize(this,44)})
	}
	
	/*$('h1').each(function(){
		var $this=$(this)
		setTimeout(function(){
			$this.css('line-height','')
			if($this.find('.wrapper').height()>$this.height()+$this.height()/5)$this.css('line-height',($this.height()/2)+"px");
			if($this.find('.wrapper').height()>$this.height()+$this.height()/5)$this.css('line-height',($this.height()/3)+"px");
			if($this.find('.wrapper').height()>$this.height()+$this.height()/5)$this.css('line-height',($this.height()/4)+"px");
		},100)
	})*/
	
	$('.sub-menu').addClass('hidden')
}

function setBodyHTML(){
	$('.right_block').html($('li.menu-item ul:last').parents('li:first').html())
	$('.right_block a:first').addClass("first_a").addClass('title').css({cursor:'default',width:'auto'}).css('line-height','').attr("href","#").unbind('click').bind('click',function(){return false;})
	$('.title').css({color:''})
	$('.left_block').css({color:''})
	$('.view_presentation a').css({color:''})
	$('.title_image_wrapper a').unbind('click').bind('click',function(){document.location.href=$(this).attr('href')}).css({cursor:'pointer'});;
	
	if(isMobile()){
		$('.right_block a:first').addClass('rtl-float-left');
		$('.right_block a:first').before('<div class="paper_image rtl-float-left"><img class="imargin inactive" src="'+pathToImgFolder+'/img/icons/resources.png" alt="Resources"></div>');
		$('.right_block a:first').after('<div class="clear"></div>');
		$('.wrapper').each(function(){
			if($(this).find('.left_blocks').length>0){
				var x=parseInt($(this).attr('class').replace(/^[\s\S]*?w([0-9]+)[\s\S]*?$/ig,"$1"))
				$(this).find('.clear_to_remove').remove();
				$(this).find('.left_blocks').after('<div class="clear clear_to_remove"></div>')
				$(this).find('.clear_to_remove').after($('.references_wrapper.r'+x+':first'))
			}
		})
		$('.wrapper:has(.left_blocks):last').append($('.right_block')).append('<div class="clear"></div>')
		$('.title').each(function(){
			var color=$(this).parents('.bged:first,.very_paper:first').find('.paper_description:first').find('span:first').css("color");
			$(this).find('a').css({color:color})
		})
		$('.left_block').each(function(){
			var color=$(this).find('.paper_description:first').find('span:first').css("color");
			$(this).css('border-color',color)
		})
		$('.view_presentation a').each(function(){
			var color=$(this).parents('.bged:first,.very_paper:first').find('.paper_description:first').find('span:first').css("color");
			$(this).css('color',color)
		})
		$('.title_image_wrapper a').unbind('click').bind('click',function(){return false}).css({cursor:'default'});
	}
	else{
		$('.right_block .paper_image').remove();
		$('.wrapper').each(function(){
			if($(this).find('.left_blocks').length>0){
				var x=parseInt($(this).attr('class').replace(/^[\s\S]*?w([0-9]+)[\s\S]*?$/ig,"$1"))
				//$(this).find('.left_blocks').after('<div class="clear clear_to_remove"></div>')
				$(this).find('.clear_to_remove').remove();
				$(this).after($('.references_wrapper.r'+x))
			}
		})
		$('.wrapper:has(.left_blocks):first').append($('.right_block')).append('<div class="clear"></div>')
		//$('.wrapper:has(.left_blocks):first').find('.clear:last').remove()
		if($('.right_block').prev().hasClass('clear'))$('.right_block').prev().remove()
	}
	
	$('.video_play_icon,.video_name,.watch_now').click(function(){
		loadPlayer($(this).parents('.gallery_block:first').find('input').val());
	})
	
	//if(isMobile())$('.right_block').before('<div class="clear clear_to_remove"></div>').before($('.references_wrapper'))
	//else $('.right_block').parents('.wrapper:first').after($('.references_wrapper')).find('.clear_to_remove').remove()
	
	/*$('.mouseout').unbind('mouseover').bind('mouseover',function(){
		$(this).addClass('inactive')
		$(this).parents('a:first').find('.mouseover').removeClass('inactive');
	})
	$('.mouseover').unbind('mouseout').bind('mouseout',function(){
		$(this).addClass('inactive')
		$(this).parents('a:first').find('.mouseout').removeClass('inactive');
	})*/
}	

function setBodySize(){
	var mh=0,bw=0,x=0;
	$('.bged,.right_block').css({height:'auto'})
	$('.right_block .menu-image-title').css({padding:0})
	if(!isMobile()){
		$('.paper_references').css({width:$('.first_col:first').width()-23+6}).removeClass('inactive')
		$('.paper_references:last').css({width:$('.first_col:first').width()-23-6})
		$('.open_paper_text,.close_paper_text,.close_paper_references,.paper_references_title,.view_presentation').addClass('inactive')
		$('.paper_description').css('padding-bottom','')
	
		$('.paper_text,.paper_description').removeClass('inactive')
		$('.bged,.right_block').each(function(){
			if($(this).outerHeight()>mh)mh=$(this).outerHeight();
		})
		$('.bged,.right_block').css({height:mh})
		$('.paper_image').css({width:'100%',height:125,margin:'0 auto 31px'})
		$('.gallery_block').css({width:'31.7%',margin:'0 0 0 2.3%'})
		$('.very_paper_file iframe').css({height:$('input[name="height"]').val()})
	}
	else{
		$('.paper_references,.paper_references_title').css({width:'100%'})
		$('.paper_text,.paper_description,.close_paper_text,.paper_references,.close_paper_references').addClass('inactive')
		if($('.paper_description').parents('.very_paper:first').length>0){
			$('.paper_description').removeClass('inactive')
			$('.paper_description').css('padding-bottom',50)
		}
		$('.open_paper_text,.view_presentation').removeClass('inactive');
		
		$('.paper_image,.videos_image').each(function(){
			var index=$(window).width()<400?0.2:0.15,piw=$('.paper_image,.videos_image').parents('div:first').width()*index,mr=piw/2.5,mt=$(this).next().prop('tagName').toLowerCase()=='a'?25:0
			$(this).css({width:piw,height:piw}).css('margin',mt+'px '+mr+'px 0 0').next().css({height:piw}).css('line-height',piw+'px')
		})
		$('.title,.first_a').each(function(){
			var $p=$(this).parents('div:first'),$i=$p.find('.paper_image,.videos_image')
			$(this).css({width:$p.width()-$i.outerWidth(true)-1})
			setElLineHeight(this)
		})
		$('.right_block .round').each(function(){
			if($(this).width()>0){
				var mr=$('.paper_image').parents('div:first').width()*0.15;
				$(this).css({margin:'/*38*/19px 20px 0 '+(mr+mr/2.5)+'px'})
			}
		})
		$('.gallery_block').css({width:'100%',margin:0})
		$('.very_paper_file iframe').css({height:$(window).width()*2})
	}
	
	
	
	//test=true
	$('.right_block li.menu-item a').each(function(){liASize(this,$('body').hasClass('responsive')?0:23)})
	//test=false;
	//$('.responsive .right_block .first_a.title,.responsive .right_block ul li a').each(function(){liASize(this)})
	//$('.responsive .title_image_wrapper .title').each(function(){liASize(this)})
	
	if(isMobile()){
		
		/*$('.paper_image').each(function(){
			var piw=$('.paper_image').parents('div:first').width()*0.15,mr=piw/2.5,mt=$(this).next().prop('tagName').toLowerCase()=='a'?48:0
			$(this).css({width:piw,height:piw}).css('margin',mt+'px '+mr+'px 0 0').next().css({height:piw}).css('line-height',piw+'px')
			//$('.responsive .title_image_wrapper .title').each(function(){liASize(this)})
		})*/
	}
	//else 
	
	$('.video_text').each(function(){
		$(this).css({width:$(this).parents('.video_name:first').width()-$(this).parents('.video_name:first').find('.video_icon').outerWidth(true)-1})
	})
}

function hideText(e,scrollTop){
	$(e).parents('.bged:first').find('.paper_text,.paper_description').addClass('inactive');
	$(e).parents('.bged:first').find('.open_paper_text').removeClass('inactive');
	$(e).addClass('inactive');
	//if(scrollTop!=0)
		window.scrollTo(0,scrollTop)
}

function showText(e){
	var scrollTop=$(window).scrollTop()
	$(e).parents('.bged:first').find('.paper_text,.paper_description').removeClass('inactive');
	$(e).parents('.bged:first').find('.close_paper_text').removeClass('inactive').attr("onclick","hideText(this,"+scrollTop+")");
	$(e).addClass('inactive');
}

function showReferences(e){
	var scrollTop=$(window).scrollTop()
	if($(e).parents('.wrapper:first').find('.paper_references').hasClass('inactive')){
		$(e).parents('.wrapper:first').find('.close_paper_references,.paper_references').removeClass('inactive');
		$(e).parents('.wrapper:first').find('.close_paper_references').attr("onclick","hideReferences(this,"+scrollTop+")");
	}
	else $(e).parents('.wrapper:first').find('.close_paper_references,.paper_references').addClass('inactive');
}

function hideReferences(e,scrollTop){
	$(e).parents('.wrapper:first').find('.close_paper_references,.paper_references').addClass('inactive');
	//if(scrollTop!=0)
		window.scrollTo(0,scrollTop)
}

function iMargin($img,p){
    try{
    $img.each(function(){
        var $this=$(this);
        var newI = new Image();
        if($this.prop('src')){
            if($.browser.opera&&$.browser.version>10)setTimeout(function(){
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
            newI.src = $this.prop('src');
        }
        else iMarginSet($this,newI,true,p)
    })
    }
    catch(e){}
}

function iMarginSet($this,newI,error,p){
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
		
		if(p=='f')$this.css('margin-left',(pw-iw)/2).css('margin-top',(ph-ih)/2).css('height','auto').css('width','auto');
		else if(p=='a'){
			if(pw/ph<iw/ih)$this.css('margin-left',(pw-(iw*ph/ih))/2).css('margin-top',0).css('height','100%').css('width','auto');
			else $this.css('margin-top',(ph-(ih*pw/iw))/2).css('margin-left',0).css('width','100%').css('height','auto');
		}
		else{
			if(pw/ph>iw/ih)$this.css('margin-left',(pw-(iw*ph/ih))/2).css('margin-top',0).css('height','100%').css('width','auto');
			else $this.css('margin-top',(ph-(ih*pw/iw))/2).css('margin-left',0).css('width','100%').css('height','auto');
		}
		if($this.hasClass('mouseover'))$this.addClass('inactive')
    }
    catch(e){}
}

function loadPlayer(file){
	var p=isMobile()?60:60;
	scrollTop=$(window).scrollTop()
	closePlayer();
    $('body').css({height:$(window).height()-($('#wpadminbar').size()>0?$('#wpadminbar').height():0),overflow:'hidden'})
    var bw=$(window).width(),bh=$(window).height(),w=$(window).width()-p,h=$(window).height()-p;
	if(!isMobile()){
		if(w>640)w=640;
		if(h>480)h=480;
	}
    if(h>$(window).height()-$('#wpadminbar').height()-p)h=$(window).height()-$('#wpadminbar').height()-p;
	if(h/w>3/4)h=w*3/4
	if(file.search(/^(http[s]?:)*(\/\/)*(www)*vimeo\.com.*?$/ig)!=-1){
		$('body').append('<div class="player"><div class="close"><img src="'+pathToImgFolder+'/img/close.png" alt="" onclick="closePlayer()" /></div><div class="clear"></div><iframe id="vimeo_youtube_player" src="https://player.vimeo.com/video/'+file.replace(/^.*?\/([0-9]+).*?$/ig,"$1")+'" style="width:'+w+'px;height:'+h+'px" frameborder="0"></iframe></div>')
	}
	else{
	$('body').append('<div class="player"><div class="close"><img src="'+pathToImgFolder+'/img/close.png" alt="" onclick="closePlayer()" /></div><div class="clear"></div><div id="player" style="width:'+w+'px;height:'+h+'px"></div><script type="text/javascript">player=jwplayer("player");player.setup({file:"'+file+'",width:"'+w+'",height:"'+h+'",autostart:true});</script></div>')
	}
	$('.player').css({padding:(((bh-p/2-h)/2))+"px "+((bw-w)/2)+"px "+((bh-p/2-h)/2)+"px",top:0,left:0});
	if($('#wpadminbar').size()>0&&!isMobile())$('.player').css({top:$('#wpadminbar').height()})
	$('body').addClass("fx")
}

function closePlayer(){
	$('body').removeClass("fx")
	$('.player').remove();
	$('body').css({height:'auto',overflow:'visible'})
	if(scrollTop!=0)window.scrollTo(0,scrollTop)
}

function resizePlayer(){
	var p=isMobile()?60:60;
    if($('.player').size()>0)try{
        $('body').css({height:$(window).height()-($('#wpadminbar').size()>0?$('#wpadminbar').height():0),overflow:'hidden'})
        var bw=$(window).width(),bh=$(window).height(),w=$(window).width()-p,h=$(window).height()-p;
		if(!isMobile()){
			if(w>640)w=640;
			if(h>480)h=480;
		}
		if(h>$(window).height()-$('#wpadminbar').height()-p)h=$(window).height()-$('#wpadminbar').height()-p;
		if(h/w>3/4)h=w*3/4
        try{
			if($('#vimeo_youtube_player').size()>0)$('#vimeo_youtube_player').css({width:w,height:h})
			player.resize(w,h)
		}
		catch(e){}
		$('.player').css({padding:(((bh-p/2-h)/2))+"px "+((bw-w)/2)+"px "+((bh-p/2-h)/2)+"px",top:0,left:0});
		$('#player').css({width:w,height:h})
		if($('#wpadminbar').size()>0&&!isMobile())$('.player').css({top:$('#wpadminbar').height()})
		$('.player .close').removeClass('inactive')
    }
    catch(e){}
}

function liASize(e,pr){
	$(e).css('width','')
	$(e).css('line-height','')
	
	var $p=$(e).parents('li:first'),$round=$(e).parents('li:first').find('.round:first');
	$(e).css({width:$p.width()-($round.width()>0?$round.outerWidth(true):pr)-pr-1})
	
	setElLineHeight(e)
	//setTimeout(function(){setElLineHeight(e)},1000)
}

function setElLineHeight(e){
	if($(e).find('span:first').height()!=0){
		$(e).css('padding-top',0);
		if($(e).find('span,div').height()>$(e).height()+$(e).height()/2){
			if($(e).height()/2<getStyle(e,'font-size')*1.5)$(e).css('line-height',($(e).height()/2)+"px")
			else $(e).css('padding-top',$(e).height()*0.2).css('line-height',(($(e).height()-$(e).height()*0.4)/2)+"px")
			if($(e).parents('li:first').find('.round').width()>0)$(e).css('padding-top',($(e).parents('li').height()-(($(e).height()-$(e).height()*0.4)/2))/2)
			
		}
		if($(e).find('span,div').height()>$(e).height()+$(e).height()/2){
			if($(e).height()/3<getStyle(e,'font-size')*1.5)$(e).css('line-height',($(e).height()/3)+"px")
			else $(e).css('padding-top',$(e).height()*0.1).css('line-height',(($(e).height()-$(e).height()*0.2)/3)+"px")
			if($(e).parents('li:first').find('.round').width()>0)$(e).css('padding-top',($(e).parents('li').height()-(($(e).height()-$(e).height()*0.4)/2))/2)
		}
	}
}

function setDifSize(){
	$('.dif').each(function(){
		var h=$('#body').height()+$('#header').height()+$('#footer').height();
		//alert(h)
		$(this).css('padding-bottom',h-57-$(this).find('.w').outerHeight()+46)
	})
}

function showDif(id){
    hideDif(true);
    $('#'+id).removeClass('inactive');
    var p=($(window).height()-($('#'+id+' .w:first').outerHeight()+57));
    if(p<0)p=0
    $('#'+id).css('padding-top',57).css('padding-bottom',p);
 }

function resizeDif(){
    $('.dif').each(function(){
        if(!$(this).hasClass('inactive')){
            var p=($(window).height()-($(this).find('.w:first').outerHeight()+57));
            if(p<0)p=0
            $(this).css('padding-top',57).css('padding-bottom',p);
        }
    })
}

function hideDif(rf){
    $('.dif').removeClass('active');
    $('.dif').addClass('inactive');
}

function resizeIframe(obj) {
	obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
}

function hasPlugin(name){
	if (navigator.userAgent.indexOf('MSIE')!=-1) {
    	try {
			new ActiveXObject(name);
			return true;
		} catch (e) {
			return false;
		}
	}
	
	else {
			name = name.toLowerCase();
			var plugins = window.navigator.plugins;
			try{
				for (var i=0;i<plugins.length; i++)if(plugins[i]['name'].search(new RegExp(name,'ig'))!=-1){
					//tester(plugins[i])
					return true;
				}
			}catch (e) {
				return false;
			}
			
			return false;
	}
}

function tester(p,hf){
    var err=getProps(p,hf)
    alert(err.substr(0,err.length-1))
}

function getProps(obj,hf,n,t){
    if(!n)n='\n';
    if(!t)t=''
    if(t.match(/&nbsp;/))t+='&nbsp;&nbsp;&nbsp;'
    else t+='\t'
    //if(!hf)hf=1
    var s='';
    for(var i in obj){
        if(hf&&typeof obj[i]=='object')s+=t+i+':'+getProps(obj[i],hf,'',t)+n
        else s+=t+i+':'+obj[i]+','+n;
    }
    s='{'+n+s+t.substr(0,t.length-1)+'},';
    return s;
}

function getStyle(el,styleProp){
	var res="",camelize = function (str) {
		return str.replace(/\-(\w)/g, function(str, letter){
			return letter.toUpperCase();
		});
	};
	if(el.currentStyle)res=el.currentStyle[camelize(styleProp)];
	else if(document.defaultView&&document.defaultView.getComputedStyle)res=document.defaultView.getComputedStyle(el,null).getPropertyValue(styleProp);
	else res=el.style[camelize(styleProp)];
	if(res.search(/^\s*[0-9\.-]+\s*px$/ig)!=-1)return parseInt(res.replace(/^\s*([0-9\.-]+)\s*px$/ig,"$1"));
	return res;
}

////sssssssssssssssssssssssssssssssss
