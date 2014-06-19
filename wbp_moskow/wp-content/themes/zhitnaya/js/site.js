var moreinfo_toggle= true;

$( document ).ready( function(){
	// cut news date
	var date = $( "#Guestbook-index .date" ),
		 dateA = date.toArray(),
		 dateL = dateA.length;
	for (var i = 0 ; i < dateL ; i++) {
		var dateHtml = date.eq( i ).html(),
			 dateCut = dateHtml.substring(0,10);
		date.eq( i ).html( dateCut );
	}
	$(function() {
		$( "#date" ).datepicker();
	});
	//vtour
	$(document)
	.on("click", "#openModalv1", function() {
		$("body").css({"position":"relative"}).append('<div id="shadow" style="z-index:500; position:absolute; top:0; left:0; width:100%; bottom:0; background:#000; opacity:.5;"></div>').append('<div id="modal" style="z-index:501; position:fixed; top: 100px; width: 600px; height:500px; background-color: #fff; border-radius: 5px;left: 50%; margin-left: -300px;"><span id="closeModal" style="position:absolute; top:10px; right:10px; font-size:24px; line-height:12px; cursor:pointer">&#215;</span><iframe src="/vtour/tour.html" border="0" frameborder="0" width="550" height="450" style="margin: 25px 0 0 25px;"></iframe></div>');
	})
	.on("click", "#openModalv2", function() {
		$("body").css({"position":"relative"}).append('<div id="shadow" style="z-index:500; position:absolute; top:0; left:0; width:100%; bottom:0; background:#000; opacity:.5;"></div>').append('<div id="modal" style="z-index:501; position:fixed; top: 100px; width: 600px; height:500px; background-color: #fff; border-radius: 5px;left: 50%; margin-left: -300px;"><span id="closeModal" style="position:absolute; top:10px; right:10px; font-size:24px; line-height:12px; cursor:pointer">&#215;</span><iframe src="/vtour3/wrtour.html" border="0" frameborder="0" width="550" height="450" style="margin: 25px 0 0 25px;"></iframe></div>');
	})
	.on("click", "#openModalv3", function() {
		$("body").css({"position":"relative"}).append('<div id="shadow" style="z-index:500; position:absolute; top:0; left:0; width:100%; bottom:0; background:#000; opacity:.5;"></div>').append('<div id="modal" style="z-index:501; position:fixed; top: 100px; width: 600px; height:500px; background-color: #fff; border-radius: 5px;left: 50%; margin-left: -300px;"><span id="closeModal" style="position:absolute; top:10px; right:10px; font-size:24px; line-height:12px; cursor:pointer">&#215;</span><iframe src="/vtour2/wrpanorama.html" border="0" frameborder="0" width="550" height="450" style="margin: 25px 0 0 25px;"></iframe></div>');
	})
	.on("click", "#closeModal", function() {
		$("body").css({"overflow":"visible"})
		$("#modal").remove(); 
		$("#shadow").remove();
	})
	.on("click", "#shadow", function() {
		$("body").css({"overflow":"visible"})
		$("#modal").remove(); 
		$("#shadow").remove();
	});

    //Cut Index Event text by half
    $('.slider + div table td p, .slides > ul p').each(function(){
        txtmax= 300;
        txt= $(this).text().trim();
        if (txt.length < txtmax+50) return;
        tmp= txt.substr(txtmax, txtmax+20).search(' ');

        $(this).empty()
            .append(txt.substr(0, txtmax+tmp));
//            .after('<p class="moreinfo-text">'+ txt.substr(txtmax+tmp) +'</p><a href="#" class="moreinfo">Подробнее</a>');
    });
//    $('.moreinfo').click(function(e){
//        e.preventDefault();
//
//        $(this).prev().slideToggle();
//        $(this).text(
//                (moreinfo_toggle)? "Свернуть": "Подробнее"
//            );
//        moreinfo_toggle= !moreinfo_toggle;
//
//    });

});