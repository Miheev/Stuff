var jshover = function()
{
	var menuDiv = document.getElementById("horizontal-multilevel-menu")
	if (!menuDiv)
		return;

	var sfEls = menuDiv.getElementsByTagName("li");
	for (var i=0; i<sfEls.length; i++) 
	{
		sfEls[i].onmouseover=function()
		{
			this.className+=" jshover";
		}
		sfEls[i].onmouseout=function() 
		{
			this.className=this.className.replace(new RegExp(" jshover\\b"), "");
		}
	}
}

if (window.attachEvent) 
	window.attachEvent("onload", jshover);

    
// add open and close effects
jQuery(document).ready(function() {
    jQuery("#horizontal-multilevel-menu > li").mouseover(function() {
        $(this).attr("focus", "true");
        $(this).children("ul").fadeIn(400);
    });

    jQuery("#horizontal-multilevel-menu > li").mouseout(function() {
        $(this).attr("focus", "false");
        var me = this;
        
        // fix reopen if focused element changed
        setTimeout(function() {
            if ($(me).attr("focus") == "false") {
                $(me).children("ul").fadeOut(200);
            }
        }, 5);
    });
});