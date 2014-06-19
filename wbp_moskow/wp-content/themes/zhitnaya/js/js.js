/**
 * Function: win_x
 */
function win_x()
{
	var v;
	v=window.innerWidth;
	if (!v) v=document.body.clientWidth;
	return 1*v;
}

/**
 * Function: win_y
 */
function win_y()
{
	var v;
	v=window.innerHeight;
	if (!v) v=document.body.clientHeight;
	return 1*v;
}

/**
 *
 */
function find_parent_class(base,name)
{
	while (!base.hasClass(name)) base=base.parent();
	return base;
}

/**
 * Function: set_select
 */
function set_select(list,pid) {
	var i=0;
	var j=1;
	while (list.options[i] && j) {
		if (list.options[i].value==pid) {
			list.selectedIndex=i;
			j=0;
		}
		i++;
	}
}

/**
 * Function: ajajform_add_inputs
 */
function ajajform_add_inputs(frm,inputs)
{
	for (var i=0;i<inputs.length;i++) {
		frm.ajajform("insertWidget",null,null,inputs[i]);
	}
}
/**
 * Function: ajaj_form
 *
 */
function ajaj_form(frm,callback_func)
{
	var has_file=false;
	for(i=0;i<frm.length;i++) {
		if (frm.elements[i].type=="file") has_file=true;
	}
	if (has_file) return ajaj_form_iframe(frm,callback_func);
	var params={ajaj:1};
	var i;
	var t;
	var v;
	var tmp;
	for(i=0;i<frm.length;i++) {
		t=frm.elements[i].type;
		var el=frm.elements[i];
		switch (t) {
			case 'hidden':
			case 'text':
			case 'tel':
			case 'email':
			case 'password':
			case 'textarea':
				if (!frm.vis) {
					v=el.value;
				} else if (frm.vis.value.indexOf(","+el.name+",")!=-1) {
					v=tinyMCE.get(el.name).getContent();
				} else {
					v=el.value;
				}
				params[el.name]=v;
				break;
			case 'checkbox':
				if (el.checked) params[el.name]=el.value;
				break;
			case 'select':
			case 'select-one':
				params[el.name]=el.options[el.selectedIndex].value;
				break;
			case 'radio':
				if (el.checked) params[el.name]=el.value;
				break;
			case 'button':
			case 'submit':
				break;
			default:
			alert("Unknown type "+t);
		}
	}
	$.ajax({
		type: "POST",
		url: frm.action,
		data: params,
		error: function(jqXHR, textStatus, errorThrown) { show_error_dialog({error_title:"ajaj_form error",error:jqXHR.responseText}); },
		success: function(a) {std_response(a,callback_func);}
	});
}

/**
 *
 */
function ajaj_form_iframe(frm,callback_func)
{
	if ($("#ajajiframe").length==0) {
		$("<iframe name='ajajiframe' id='ajajiframe' frameborder='0' border='0' style='border: 0px;padding: 0px; margin: 0px;' width='500' height='100'></iframe>").appendTo($("body"));
	}
	frm.target="ajajiframe";
	function push_form_hidden(name,value)
	{
		if ($("input[name='"+name+"']",frm).length) return;
		$("<input type='hidden' name='"+name+"' value='"+value+"'/>").appendTo(frm);
	}
	push_form_hidden("ajaj","1");
	push_form_hidden("is-iframe","1");
	frm.submit();
}

/**
 * Function: ajaj_post
 *
 */
function ajaj_post(href,params,callback_func)
{
	params.ajaj=1;
	$.ajax({
		type: "POST",
		url: href,
		data: params,
		error: function(jqXHR, textStatus, errorThrown) { show_error_dialog({error_title:"ajaj_form error",error:jqXHR.responseText}); },
		success: function(a) {std_response(a,callback_func);}
	});
}
/**
 * Function: ajaj_href
 *
 */
function ajaj_href(href,callback_func)
{
	if (href.href) href=href.href;
	$.ajax({
		type: "GET",
		url: href,
		error: function(jqXHR, textStatus, errorThrown) { show_error_dialog({error_title:"ajaj_form error",error:jqXHR.responseText}); },
		success: function(a) {std_response(a,callback_func);}
	});
}

/**
 * Function: std_response
 */
function std_response(rtext,callback_func)
{
	var ret;
	if (typeof rtext == "string") {
		try {
			eval("ret="+rtext+";");
		} catch(e) {
			show_error_dialog({error:rtext,error_title:"Internal server error"});
			return undefined;
		}
	} else {
		ret=rtext;
	}
	if (ret.error_code) {
		show_error_dialog(ret.error);
		return;
	} else if (ret.redirect) {
		var dst=ret.redirect.url.match(/^(|http:\/\/[\w\.]+)(\/[^#]*)/)[2];
		if (dst==document.location.pathname+document.location.search) {
			document.location=ret.redirect.url;
			document.location.reload(true);
		} else {
			document.location=ret.redirect.url;
		}
	} else if (ret.refresh) {
		if (document.location.search && document.location.search=="?do-logoff=1") {
			document.location.search="";
		} else {
			document.location.reload();
		}
	} else if (ret.call) {
		eval(ret.call+'(ret)');
		if (callback_func) callback_func(ret);
	} else if (callback_func) {
		callback_func(ret);
	}
	return ret;
}

/**
 * Function: show_error_dialog
 */
function show_error_dialog(ret)
{
	if (typeof ret=="string") {
		var ret2;
		try {
			eval("ret2="+ret+";");
		} catch(e) {
			ret2={error:ret};
		}
		ret=ret2;
	}
	if (!ret.error.match(/<br\s*\/?>/i)) ret.error=ret.error.replace(/\n/g,'<br/>');
	var d=$('<div><div style="text-overflow: auto; max-height: 500px;"></div></div>');
	d.attr('title',ret.error_title);
	$("div",d).html(ret.error);
	d.appendTo($('body'));
	d.dialog({maxHeight: 550,width: 800,close: function() { d.dialog("destroy");d.remove(); }});
}

function generic_error_fields(errors,basepath)
{
	$(basepath+" .err").html("");
	for (var k in errors) {
		$(basepath+" ."+k+" .err").html(errors[k]);
	}
}

var FormFuncs={};

FormFuncs.write_error=function(obj)
{
	generic_error_fields(obj.errors,".Form-index");
}

FormFuncs.written=function(obj)
{
	$(".Form-index .form").hide();
	$(".Form-index.form").hide();
	$(".Form-index .message-ok").show("blink");
	$(".Form-index.message-ok").show("blink");
}

var GuestbookFuncs={};

GuestbookFuncs.write_error=function(obj)
{
	generic_error_fields(obj.errors,".Guestbook-index");
}

GuestbookFuncs.written=function(obj)
{
	$(".Guestbook-index .form").hide();
	$(".Guestbook-index .message-ok").show("blink");
}

GuestbookFuncs.redirect=function(obj)
{
	// TODO
}


var CartFuncs=new function() {
	this.cart_action="/cart/";
	this.market_action="/market/";
};

CartFuncs.test=function() { console.log(this); }

CartFuncs.init=function(caction,maction)
{
	if (caction) this.cart_action=caction;
	if (maction) this.market_action=maction;
}

CartFuncs.market_set=function(market_item_id,amount)
{
	var div=$("<div class='cart-shadow'></div>").appendTo($("body"));
	var div=$("<div class='cart-progress'></div>").appendTo($("body"));
	amount=amount.toString().replace(/\+/,"%2B");
	var url=this.market_action+'?ajaj=1&mode=set_cart_amount&item_id='+market_item_id+'&amount='+amount;
	ajaj_href(url);
}

CartFuncs.login_error=function(obj)
{
	generic_error_fields(obj.errors,".cart-login");
}

CartFuncs.profile_upd_error=function(obj)
{
	generic_error_fields(obj.errors,".cart-profile-upd");
}

CartFuncs.register_error=function(obj)
{
	generic_error_fields(obj.errors,".cart-register");
}

CartFuncs.updated=function(obj)
{
	$(".cart-shadow").remove();
	$(".cart-progress").remove();
	$(".Cart-snippet").show();
	$(".Cart-snippet .calc_items_changer").text(obj.cart.calc_amount);
	$(".Cart-snippet .calc_summ_changer").text(obj.cart.calc_summ);
	if (obj.cart.calc_amount) $(".Cart-snippet").show(); else $(".Cart-snippet").hide();

}

/**
 * Constructor: Gallery
 * Parameters:
 *		rootdiv - $(".something")
 *		options - Object
 *		options.mode
 *					= slider
 *					= previewslider
 *					= gallery
 *		options.bigwidth
 *		options.bigheight
 *		options.previewwidth
 *		options.previewheight
 */
function Gallery(rootdiv,options)
{
	if (!options) options={};
	var stdoptions={
		mode:"gallery",
		bigwidth:800,
		bigheight:0,
		previewwidth:64,
		previewheight:48,
		previewpadding:2
	};
	this.rootdiv=rootdiv;
	for (var k in stdoptions) if (!options[k]) options[k]=stdoptions[k];
	this.options=options;
	this.init();
	if (this.images.length==0) return;
	this.render();
	this.go(this.n);
}

Gallery.prototype.init=function()
{
	var t=this;
	this.images=[];
	$("a",this.rootdiv).each(function(i,a) {
		t.images.push({big:$(a).attr("href"),preview:$("img",a).attr("src"),text:$("img",a).attr("alt"),bigheight:t.options.bigheight});
	});
	this.n=0;
}

Gallery.prototype.render=function()
{
	switch (this.options.mode || "gallery") {
		case "slider":
			break;
		case "gallery":
			this.render_gallery();
			break;
	}
}

Gallery.prototype.render_gallery=function()
{
	var t=this;
	this.rootdiv.empty().addClass("gallery-mode");
	this.rootdiv.append('<div class="bigimage"><div class="img"></div><div class="text"></div><div class="prev"></div><div class="next"></div></div></div><div class="smallimages"><div class="active"></div></div>');
	var si=$(".smallimages",this.rootdiv);
	$(".bigimage",this.rootdiv).css({width:t.options.bigwidth,height:t.options.bigheight});

	var imageslen=(t.options.previewpadding*2+t.options.previewwidth)*t.images.length;
/*	if (t.options.bigwidth>imageslen) {
		this.lpad=Math.round((t.options.bigwidth-imageslen)/2);
		si.css({width:t.options.bigwidth-this.lpad,"padding-left":this.lpad});
	} else {
		this.lpad=0;
		si.css({width:t.options.bigwidth});
	}*/
	si.css({width:t.options.bigwidth});
	$(".active",div).css({width:t.options.previewwidth,height:t.options.previewheight});
	for (var i=0;i<this.images.length;i++) {
		var img=this.images[i];
		var div=$('<div class="preview"><div class="img"></div><div class="text"></div></div>').appendTo(si);
		$(".img",div).css({"background-image":'url('+img.preview+')'}).addClass("item-"+i);
		$(".text",div).text(img.text);
	}
	$(".smallimages .img",this.rootdiv).css({width:t.options.previewwidth,height:t.options.previewheight}).bind("click",function() {t.go(this.className.match(/item-(\d+)/)[1]*1);});

	$(".prev",this.rootdiv).bind("click",function() { t.prev(); });
	$(".next",this.rootdiv).bind("click",function() { t.next(); });
}

Gallery.prototype.go=function(n)
{
	var t=this;
	this.n=n;
	if (t.images[n].bigheight) {
		$(".bigimage",this.rootdiv).animate({height:t.images[n].bigheight},800);
	} else {
		var img=new Image();
		img.src=t.images[n].big;
		img.onload=function() {
			t.images[n].bigheight=img.height;
			$(".bigimage",this.rootdiv).animate({height:t.images[n].bigheight},400);
		};
	}
	var pos=$(".smallimages .item-"+n,this.rootdiv).position();
	$(".smallimages .active",this.rootdiv).stop().animate({left:pos.left-t.options.previewpadding,top:pos.top-t.options.previewpadding},800);
	$(".bigimage .img",this.rootdiv).stop();
	$(".bigimage .img",this.rootdiv).animate({opacity:0},400,undefined,function() {
		$(this).css({"background-image":"url("+t.images[n].big+")"}).animate({opacity:1},400);
	});
}

Gallery.prototype.next=function()
{
	this.go((this.n+1)%this.images.length);
}

Gallery.prototype.prev=function()
{
	this.go((this.n-1)%this.images.length);
}

Gallery.prototype.stop=function()
{
	this.stopped=1;
}

Gallery.prototype.run=function()
{
	this.stopped=0;
}

Gallery.prototype.expand=function()
{

}

/**
 * Constructor: MarketFuncs
 */

var MarketFuncs=new function() {
	this.market_action="/market/";
}

MarketFuncs.init=function(action_src) {
	this.action_src=action_src;
}

MarketFuncs.filters_init=function(category_id)
{
	var t=this;
	this.category_id=category_id;
	$( ".Market-filters .filter-range" ).each(function(i,tag) {
		var min=$(".min",tag).attr("data-orig")*1;
		var max=$(".max",tag).attr("data-orig")*1;
		var v1=$(".min",tag).val()*1;
		var v2=$(".max",tag).val()*1;
		var range=$(".range",tag);
		range.slider({
			range: true,
			min: min,
			max: max,
			values: [ v1, v2 ],
			slide: function( event, ui ) {
				$(".min",tag).val( ui.values[ 0 ] );
				$(".max",tag).val( ui.values[ 1 ] );
			},
			change: function(event,ui) {
				t.filters_changed();
			}
		});
	});
	$(".filter-checkbox li").bind("click",function() { $(this).toggleClass("A"); t.filters_changed(); });
	$(".filter-radio li").bind("click",function() { $("li",this.parentNode).removeClass("A");$(this).addClass("A"); t.filters_changed(); });
	$(".filter-text input").bind("keyup",function() { t.filters_changed(); });
}

MarketFuncs.filters_changed=function()
{
	var t=this;
	clearTimeout(this._filters_apply_timeout);
	this._filters_apply_timeout=setTimeout(function() { t.filters_apply();},1000);
}

MarketFuncs.filters_apply=function()
{
	var data=this.filters_gen_hash();
	this.filters_gen_url(data);
}

MarketFuncs.filters_gen_hash=function()
{
	var t=this;
	var data={
		category_id:this.category_id,
		enums:{},
		menums:{},
		ranges:{},
		texts:{},
		manufacturers:null,
		sort:"",
		fid:"",
		name_like:"",
		price:null
	};
	$(".Market-filters .filter-range").each(function(i,tag) {
		var name=tag.className.match(/filterid-(\w+)/)[1];
		var origmin=$(".min",tag).attr("data-orig")*1;
		var origmax=$(".max",tag).attr("data-orig")*1;
		var min=$(".min",tag).val()*1;
		var max=$(".max",tag).val()*1;
		if (min==origmin && max==origmax) return;
		if (name.match(/^\d+$/)) {
			data.ranges[name]={min:min,max:max};
		} else {
			data[name]={min:min,max:max};
		}
	});

	$(".Market-filters .filter-text,.PseudoMarket-filters .filter-text").each(function(i,tag) {
		var name=tag.className.match(/filterid-(\w+)/)[1];
		var v=$("input",tag).val();
		if (name.match(/^\d+$/)) {
			data.texts[name]=v;
		} else {
			data[name]=v;
		}
	});

	$(".Market-filters .filter-radio").each(function(i,tag) {
		var name=tag.className.match(/filterid-(\w+)/)[1];
		var v=$(".A",tag).attr("data-value");
		if (name.match(/^\d+$/)) {
			data.ranges[name]=v;
		} else {
			data[name]=v;
		}
	});
	
	$(".Market-filters .filter-checkbox").each(function(i,tag) {
		var name=tag.className.match(/filterid-(\w+)/)[1];
		var v={};
		var cnt=0;
		var cntA=0;
		$(".item",tag).each(function(j,li) {
			cnt++;
			if ($(li).hasClass("A")) {
				v[$(li).attr("data-value")]=1;
				cntA++;
			}
		});
		if (cntA==0 || cntA==cnt) return;
		if (name.match(/^\d+$/)) {
			data.enums[name]=v;
		} else {
			data[name]=v;
		}
	});
	return data;
}

MarketFuncs.filters_gen_url=function(data)
{
//	console.log(data);
//	var url=this.market_action+'?ajaj=1&mode=fetch_items';
	var url;
	if (this.action_src) {
		url=this.action_src+"?ajaj=1&only_items=1";
	} else {
		url=this.market_action+'?ajaj=1&only_items=1';
	}
	var shorturl="";

	function add_range(name,v)
	{
		shorturl+="&"+name+"="+v.min+".."+v.max;
	}
	function add_checkbox(name,object)
	{
		shorturl+="&"+name+"=";
		var ii=0;
		for (var val in object) {if (ii) shorturl+=",";shorturl+=val;ii++;}
	}
	function add_text(k,v) {
		if (v=="") return;
		shorturl+="&"+k+"="+v;
	}
	for (var k in data) {
		if (!data[k]) continue;
		switch (k) {
			case "manufacturers":
				add_checkbox("manufacturers",data[k]);
				continue;
				break;
			case "price":
				add_range("price",data[k]);
				continue;
				break;
			case "name":
			case "fid":
				add_text(k,data[k]);
				continue;
			case "enums":
				for (var kk in data[k]) add_checkbox("enum-"+kk,data[k][kk]);
				continue;
				break;
			case "menums":
//				console.log("MarketFuncs.filters_gen_url - menums TODO");
				continue;
				break;
			case "texts":
				for (var kk in data[k]) add_text("text-"+kk,data[k][kk]);
				continue;
				break;
			case "ranges":
				for (var kk in data[k]) add_range("range-"+kk,data[k][kk]);
				continue;
				break;
		}
		if (typeof data[k]=="object") throw new Error("MarketFuncs.filters_gen_url - unknown field, typeof object - "+k);
		shorturl+="&"+k+"="+data[k];

	}
	if (shorturl) url+=shorturl;
	var histurl=shorturl.replace(/category_id=\d*&/,"");
	if (window.history.pushState) window.history.pushState({market:shorturl},window.title,window.location.pathname+shorturl.replace(/^&/,"?"));
	ajaj_href(url);
}

MarketFuncs.filters_done=function(d)
{
	var tmp=$(d.html);
	$(".Market-category-items").html($(".Market-category-items",tmp).html());
	$(".Market-paginator").html($(".Market-paginator",tmp).html());
}


/**
 * Constructor: ContentSlider
 * Parameters:
 *		options - Object of
 *		options.box
 *		options.slides
 *		options.marks
 */
function ContentSlider(options)
{
	var t=this;
	var defaults={
		work:true,
		now:0,
		height: 0,
		timeout_first:8000,
		timeout_secondplus: 7000
	};
	for (var k in defaults) this[k]=defaults[k];
	for (var k in options) this[k]=options[k];
	this.init();
	setTimeout(function() {t.next(); }, this.timeout_first);
}

ContentSlider.prototype.next=function()
{
	var t=this;
	if (!this.work) return;
	this.set(this.now+1);
	this.work=true;
	setTimeout(function() {t.next(); }, this.timeout_secondplus);
}

ContentSlider.prototype.set=function(i)
{
	this.work=false;
	this.now=i%this.slides.length;
	this.slides.stop();
	for (var i=0;i<this.slides.length;i++) {
		if (i==this.now) {
			$(this.slides[i]).show().css({opacity:0}).animate({opacity:1});
		} else {
			$(this.slides[i]).animate({opacity:0});
		}
	}
	if (this.marks) {
		this.marks.removeClass("markA");
		$(this.marks[this.now]).addClass("markA");
	}
}

ContentSlider.prototype.init=function()
{
	var t=this;
	for (var i=0;i<this.slides.length;i++) {
		var img=new Image();
		img.src=$(".preview",this.slides[i]).css("background-image").replace(/url\(['"]?/,"").replace(/['"]?\)/,"");
		img.onload=function() { t.grow_height(img); }
	}
	if (this.marks) {
		for (var i=0;i<this.marks.length;i++) $(this.marks[i]).bind("click",{i:i},function(e) { t.set(e.data.i); });
	}
	$(".img",this.box).width(this.box.width());
}

ContentSlider.prototype.grow_height=function(img)
{
	if (img.height>this.height) {
		this.height=img.height;
		if (this.box) {
			this.box.css({"min-height":this.height});
			$(".img",this.box).css({"height":this.height});
		}
	}
}

