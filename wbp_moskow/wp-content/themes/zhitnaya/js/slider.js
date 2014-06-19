(function ($) {
var SlideSpeed = 900;
var TimeOut = 5000;
$(document).ready(function(e) {
	$('.slide').hide().eq(0).show();
	var slideNum = 0;
	var slideTime;
	slideCount = $(".slides .slide").size();
	var animSlide = function(arrow){
		clearTimeout(slideTime);
		$('.slide').eq(slideNum).fadeOut(SlideSpeed);
		if(arrow == "next"){
			if(slideNum == (slideCount-1)){slideNum=0;}
			else{slideNum++}
			}
		else if(arrow == "prew")
		{
			if(slideNum == 0){slideNum=slideCount-1;}
			else{slideNum-=1}
		}
		else{
			slideNum = arrow;
			}
		$('.slide').eq(slideNum).fadeIn(SlideSpeed, rotator);
		// $(".control-slide.active").removeClass("active");
		// $('.control-slide').eq(slideNum).addClass('active');
		}
	// var $linkArrow = $('<a class="prew" href="#">&lt;</a><a class="next" href="#">&gt;</a>')
	// .prependTo('.slider-content');		
	// $('.next').click(function(){
	// 	animSlide("next");
	// 	return false;
	// 	})
	// $('.prew').click(function(){
	// 	animSlide("prew");
	// 	return false;
	// 	})
	// var $adderSpan = '';
	// $('.slide').each(function(index) {
	// 		$adderSpan += '<span class = "control-slide">' + index + '</span>';
	// 	});
	// $('<div class ="slider-controls">' + $adderSpan +'</div>').appendTo('.slider');
	// $(".control-slide:first").addClass("active");
	// $('.control-slide').click(function(){
	// var goToNum = parseFloat($(this).text());
	// animSlide(goToNum);
	// });
	var pause = false;
	var rotator = function(){
			if(!pause){slideTime = setTimeout(function(){animSlide('next')}, TimeOut);}
			}
	// $('.slider').hover(	
	// 	function(){clearTimeout(slideTime); pause = true;},
	// 	function(){pause = false; rotator();
	// 	});
	rotator();
});
})(jQuery);