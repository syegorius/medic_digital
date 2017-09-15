var $=jQuery,pw=0,ph=0,test=false;

function isMobile(){
	if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|BB|PlayBook|IEMobile|Windows Phone|Kindle|Silk|Opera Mini/i.test(navigator.userAgent))return true;
	else if($(window).width()<=960)return true;
	return false;
}

$(document).ready(function(){
	setTimeout(function(){
		//hasPlugin('flash');
		pw=$(window).width();
		ph=$(window).height();
				
                setHeaderSize();           
		/*setHeaderHTML()
		setBodyHTML()
		
		setBodySize()
		setDifSize()*/
		
		$('.imargin').each(function(){
                    if($(this).parents('.video').length==0){
                        if($(this).prop("src").search(/az_logo_xs/ig)!=-1)iMargin($(this))
                        else if($(this).hasClass("bg"))iMargin($(this),"a")
                        else iMargin($(this),"f")
                    }
                });
		//$('.video .imargin').each(function(){iMargin($(this),'a')});
		
		$(window).resize(function(){
			if(pw!=$(window).width()||ph!=$(window).height()&&!isMobile()){
				pw=$(window).width();
				ph=$(window).height();
				
                                setHeaderSize()
				/*setBodyHTML()
				setBodySize()*/
				$('.imargin').each(function(){
                                    if($(this).parents('.video').length==0){
                                        if($(this).prop("src").search(/az_logo_xs/ig)!=-1)iMargin($(this))
                                        else if($(this).hasClass("bg"))iMargin($(this),"a")
                                        else iMargin($(this),"f")
                                    }
                                });
				//$('.video .imargin').each(function(){iMargin($(this),'a')});
				//resizePlayer()
				//setDifSize()
			}
		})
	},100)
})

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
		//alert($this.attr("src")+"/"+p)
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

function setHeaderSize(){
    $('body').removeClass("responsive");
    $('.logo img').prop("src",pathToImgFolder+"/img/logo_sm.png");
    $('.az').css({width:172,margin:0})
    $('.az_logo img').prop("src",pathToImgFolder+"/img/az_logo_sm.png");
    $('.rd img').prop("src",pathToImgFolder+"/img/rd.png");
    $('.rd').css({width:pw-$('#header .logo').outerWidth()-$('#header .az').outerWidth()-$('#header .menu').outerWidth()-40+1})
    $('.page_details').css({top:($('#top').outerHeight()-$('.page_details').outerHeight())/2,left:($('#top').outerWidth()-$('.page_details').outerWidth())/2})
    $('.article_links').addClass("abs")
    
    if(isMobile()){
	$('body').addClass("responsive");
        $('.logo img').prop("src",pathToImgFolder+"/img/logo_xs.png");
        $('.az_logo img').prop("src",pathToImgFolder+"/img/az_logo_xs.png");
        $('.rd img').prop("src",pathToImgFolder+"/img/rd_xs.png");
        $('.az').css({width:pw-$('#header .logo').outerWidth()-$('#header .menu').outerWidth(),margin:'0 0 0 -10px'})
        $('.page_details').css({top:($('#top').outerHeight()-$('.page_details').outerHeight())/2,left:($('#top').outerWidth()-$('.page_details').outerWidth())/2})
        $('.article_links').removeClass("abs")
    }
    
    if($('#wpadminbar').size()>0){
        $('.dif').css({top:$('#wpadminbar').height()})
    }
    else{
        $('.dif').css({top:0})
    }
}

function showHideArticleLinks(){
    if($('.article_links').hasClass('inactive'))$('.article_links').removeClass('inactive')
    else $('.article_links').addClass('inactive')
}

function print(elem){
    var mywindow = window.open('', 'PRINT', 'height=400,width=600');

    mywindow.document.write('<html><head><title>' + document.title  + '</title>');
    mywindow.document.write('</head><body >');
    mywindow.document.write('<h1>' + document.title  + '</h1>');
    var $e=$(elem).clone();
    $e.find('.article_social').remove();
    $e.find('.ad').remove();
    mywindow.document.write($e.html());
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();

    return true;
}