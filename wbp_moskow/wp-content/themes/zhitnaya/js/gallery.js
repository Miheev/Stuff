function LNGallery(options)
{
	this.init(options);
	if (!this.images[0]) return false;
	this.render();
}

LNGallery.prototype.init=function(options)
{
	var t=this;

	this.default_templates={
		"bottom_nav":{
			body:   "<div class='Gallery-nav_bottom'>"+
						"<div class='prev_image'>"+
							"<div class='name'></div>"+
							
						"</div>"+
						"<div class='big_image'>"+
							"<div class='description'></div>"+
							"<div class='name'></div>"+
						"</div>"+
						"<div class='show_all_button'></div>"+
						"<div class='next'></div>"+
						"<div class='prev'></div>"+
						"<div class='scroll_wrapper'>"+
							"<div class='scroll_images'></div>"+
						"</div>"+
						"<div class='counter'></div>"+
						"<div class='scroll_track'>"+
							"<div class='scroll_thumb'></div>"+
						"</div>"+
						"<div class='cl'></div>"+
						"<div class='full_images'>"+
							"<div class='close_full'></div>"+
						"</div>"+
						"<div class='cl'></div>"+
						
					"</div>"+
					"<div class='cl'></div>"
		}
	}

	t.templates 	= (options.template_name) ? this.default_templates[options.template_name] : options.template;  
	t.target	=  options.target;  
	t.source	=  options.source;
	t.speed		=  options.speed;	
	
	t.images=[];
	t.img = new Image();
		
	$('a',this.source).each(function(a,b)   {
		t.images.push({
			big   : b.href,
			small : $("img",b).attr("src"),
			name  : $('.name',b).html(),
			descr : $('.description',b).html()
			});
		});
	
		
	t.source.remove();
	
	t.n = undefined;		//номер текущей картинки
	t.sa = false;		//show all - флаг отображения всех картинок
	
	t.scroll_click = 0;
	t.scroll_start = 0;
	
	t.images_click = 0;
	t.images_drag = false;
	t.images_start = 0;
}


LNGallery.prototype.render=function()
{
	var t = this;
	t.scroll_width=0;	
	t.target.html(this.templates.body);
	
	t.scrl_th = $('.scroll_thumb', t.target);
	t.scrl_tr = $('.scroll_track',t.target);
	t.scrl_img = $('.scroll_images',t.target);
	t.scrl_wrp = $('.scroll_wrapper',t.target);
	t.fll_img = $('.full_images',t.target);
	t.bg_img = $(".big_image",t.target);
	
	for(var i=0;i<t.images.length;i++)
		$('.full_images, .scroll_images',t.target).append('<div class="item" data-id="'+i+'"><img src="'+t.images[i].small+'"></div>');

	t.scroll_width = parseInt(t.scrl_tr.css('width'));
	t.thumb_width =  parseInt(t.scrl_th.css('width'));
	
	t.si_width = parseInt(t.scrl_img.css('width')); //scroll images
	t.sw_width = parseInt(t.scrl_wrp.css('width')); //scroll wrapper
	
	t.small_track = (t.si_width>t.sw_width) ? false:true;
	if (t.small_track)  $(".scroll_track, .show_all_button",this.target).hide();
	
	t.ratio = (t.si_width-t.sw_width)/(t.scroll_width-t.thumb_width); //ratio>0
	
	t.hide_full();	
	t.init_actions();
	t.show_big(0);
}

LNGallery.prototype.init_actions=function(options)
{		
	var t = this;
	
	//////выбор картинки//////
	$('.scroll_images .item, .full_images .item', this.target).bind("click",function () {	   
		if(!t.images_drag)
			t.show_big(parseInt($(this).attr("data-id")));	   
		return t.images_drag = false;		
	});	
	
	 //////кнопки//////
	$('.prev', t.target).bind("click",function () {if (t.n>0) t.show_big(t.n-1);});	
	$('.next, .big_image',t.target).bind("click",function () {if (t.n<t.images.length-1) t.show_big(t.n+1);});	
	$('.show_all_button, .close_full',t.target).bind("click",function () {t.switch_full()});	
	
	//////скрол///////
	t.scrl_th.mousedown(function(e){
		t.scroll_click = true;
		t.scroll_start = e.pageX ;
	});
	////скролл изображений///	
	t.scrl_wrp.mousedown(function(e){
		t.images_click = true;		
		t.images_start = e.pageX ;
		return false;
	});		
	$('body').mouseup(function(e){
		t.scroll_click = false;
		t.images_click = false;
	});
	$('body').mousemove( function(e){
		if (t.scroll_click) {
			t.move(-(e.pageX-t.scroll_start));
			t.scroll_start = e.pageX;			
		}
		if (t.images_click) {	 
			t.images_drag = true;
			t.move((e.pageX-t.images_start)/t.ratio);
			t.images_start = e.pageX;		   
		}   
	});
	
	/////прокрутка колесом////
	if (!t.small_track) {
		
		if ( t.scrl_wrp[0].addEventListener) {
			
			if ('onwheel' in document) 
				t.scrl_wrp[0].addEventListener ("wheel",  function(){t.move()}, false);
			else if ('onmousewheel' in document) 
				t.scrl_wrp[0].addEventListener ("mousewheel", function(){t.move()}, false);
			else 
				t.scrl_wrp[0].addEventListener ("MozMousePixelScroll", function(){t.move()}, false);	   
		} else 
			t.scrl_wrp[0].attachEvent ("onmousewheel", function(){t.move()});
	}
	
	///// drag/////
	$('.scroll_thumb, .scroll_images', t.target).bind('touchstart touchmove touchend touchcancel',function(){t.drag(event);});
	
	
}

LNGallery.prototype.show_big=function(i)
{
	var t = this;	 
	if (i!=t.n) {		  
		$(".prev_image",t.target).css({"background-image": t.bg_img.css("background-image"),opacity:1}).animate({opacity:0},t.speed);
		t.bg_img.css({opacity:0});
		this.n = i;
		$('.counter',t.target).html('<span>'+(i+1)+'</span>'+'/'+t.images.length);
		$('.name',t.target).html(t.images[i].name);
		$('.description',t.target).html(t.images[i].descr);
		t.img.src=t.images[i].big;
		t.img.onload=function() { t.show_big_loaded(i,t.img); }
		var cur_img_pos =	(parseInt(i)+1)*$('.scroll_images img',t.target).width()+
					(parseInt(t.scrl_img.css('left'))?parseInt(t.scrl_img.css('left')):0);
	}  
	t.scroll_to_img(i);
}


LNGallery.prototype.show_big_loaded=function(i,img)
{
	var t=this;
	var anim = {};
		anim.prev={};
		anim.next={};
	if (t.bg_img.height()<img.height) {
		anim.prev.height=img.height;
		anim.next.height=img.height;
		$(".prev_image",t.target).animate(anim.prev,t.speed);
	}
	anim.next.opacity=1;
	t.bg_img.css('backgroundImage','url('+img.src+')');
	t.bg_img.animate(anim.next,t.speed);	
	t.make_active(i);
}

LNGallery.prototype.show_full=function()
{
	var t = this;
	$('.show_all_button',t.target).removeClass('off');
	t.fll_img.show(t.speed,function(e){
		
		});
	this.sa = true;
}

LNGallery.prototype.hide_full=function()
{
	var t = this;
	$('.show_all_button',t.target).addClass('off');
	t.fll_img.hide(t.speed,function(e){
		
		});
	this.sa = false;
}

LNGallery.prototype.show_scroll=function()
{
	$(".scroll_track, .scroll_wrapper",this.target).show(this.speed);
	this.show_big(this.n);	
}

LNGallery.prototype.hide_scroll=function()
{
	$(".scroll_track, .scroll_wrapper",this.target).hide(this.speed);	
}

LNGallery.prototype.make_active=function(i)
{
	var t = this;
	$('.scroll_images .item, .full_images .item',t.target).removeClass('itemA');
	$('.scroll_images .item[data-id='+i+'], .full_images .item[data-id='+i+']',t.target).addClass('itemA');
}

LNGallery.prototype.switch_full=function()
{
	var t = this;   
	if (!t.sa){t.hide_scroll();t.show_full(); }
	else	  {t.show_scroll();t.hide_full(); }
}

LNGallery.prototype.scroll_to_img=function(i)
{
	var t = this;
	var img_width = t.scrl_img.width()/t.images.length;
	var img_pos = i*img_width-t.scrl_wrp.width()/2;

	if 	(img_pos<0)	img_pos=0		
	else if (img_pos>t.si_width-t.sw_width) img_pos=t.si_width-t.sw_width;		
	t.scrl_img.animate({left:-img_pos},t.speed);	
	img_pos/=t.ratio;
	t.scrl_th.animate({left:img_pos},t.speed);
}

LNGallery.prototype.move=function(e)
{
	
	if (this.small_track) return false;
	
	e = e || window.event;
	var 	t = this,
		delta = e.deltaY || e.detail || e.wheelDelta || e*t.ratio;
	
	//console.log(t.ratio);	
	
	t.scrl_img.css('left',-scrl_pos);
	t.scroll_pos = t.scrl_img.css('left').replace(/px/,'')*1;
	
	var scrl_pos = 	t.scroll_pos+delta;
	if 	(-scrl_pos<0)	scrl_pos=0		
	else if (-scrl_pos > t.si_width-t.sw_width ) scrl_pos=-(t.si_width-t.sw_width);
	
	t.scrl_img.css('left',scrl_pos);
	
	scrl_pos/=t.ratio;
	
	t.scrl_th.css('left',-scrl_pos);
	
	event.preventDefault();
}

LNGallery.prototype.drag=function(event)
{
	var touches = event.changedTouches,
				first = touches[0],
				type = '';
	 
		switch(event.type)
		{
		  case 'touchstart':
			type = 'mousedown';
			break;
	 
		  case 'touchmove':
			type = 'mousemove';
			event.preventDefault();
			break;
	 
		  case 'touchend':
			type = 'mouseup';
			break;
		
		  default:
			return;
		}	 
		var simulatedEvent = document.createEvent('MouseEvent');
		simulatedEvent.initMouseEvent(type, true, true, window, 1, first.screenX, first.screenY, first.clientX, first.clientY, false, false, false, false, 0/*left*/, null);
		first.target.dispatchEvent(simulatedEvent);  
}

