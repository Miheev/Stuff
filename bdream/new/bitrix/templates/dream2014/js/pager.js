$(document).ready(function(){
    var currentPage = 2;
    var curpage = 2;
    var path = "/member/ajax.php?ajax=Y&"+window.location.href.slice(window.location.href.indexOf('?') + 1);

    $(".show-more").click(function(e){
		curpage++;
		path = "/member/ajax.php?ajax=Y&"+window.location.href.slice(window.location.href.indexOf('?') + 1)+"&PAGEN_1="+curpage;
        $.get(path, {PAGEN_1: currentPage++}, function(data){
            $(".true-dreams").append(data);
        });
        e.preventDefault();
    });
	
	
});

$(function() {
	var ajaxSend = false;
	function addVote(btnID, resultID, hide_vote)
	{
		if(ajaxSend)
			return;
		
		if(!hide_vote)
			hide_vote = "N";

		dream_id = $(btnID).attr("rel");
		if(dream_id && dream_id!="undefined")
		{
			ajaxSend = true;
				$.ajax({
					   type: "POST",
					   url: "../voting/add_vote.php",
					   data: "DREAM_ID="+dream_id+"&HIDE="+hide_vote,
					   success: function(data){
						   ajaxSend = false;
						   switch (data) {
						   		case "error_authorize":
						   			/*Сюда обработчик*/
						   			alert("error_authorize");
						   		break;
						   		case "error_vote":
						   			/*Сюда обработчик*/
						   			alert("Вы уже проголосавали");
						   		break;
						   		case "error_exists":
						   			/*Сюда обработчик*/
						   			alert("error_exists");
						   		break;
						   		case "error_add":
						   			/*Сюда обработчик*/
						   			alert("error_add");
						   		break;
						   		default:
						   			$(resultID).text(data);
						   		
						   }
							 
					  }
			});
		}
	}
	
	$("body").on("click", "#mainVotingBtn",function(){
		
		addVote("#mainVotingBtn", "#mainVotingSum", "N");
		return false;
		
	});

   $("div.member_list").on("click", ".member_dream_id",function(){
	   var obj = $(this);
	   if(!($(this).hasClass("activeMember")))
		   {
			   $(".member_dream_id").removeClass("activeMember");
			   $(this).addClass("activeMember");
		   		ajaxSend = true;
		   		
			   var user_id = $(this).attr("rel");
			   $("#member_dream").html("Загрузка...");
			   $.ajax({
				   type: "POST",
				   url: "../member/member_dream.php",
				   data: "USER_ID="+user_id,
				   success: function(data){
					    $("#member_dream").html(data);
					    ajaxSend = false;
					    
					    $(".arrowGreen").remove();
					   	obj.after("<div class='arrowGreen'></div>");
				   }
				 });  
		   }
   });
   

   
   $("body").on("click", ".voting_dream_id",function(){
	   if(!ajaxSend && !($(this).hasClass("activeVotingDrim")))
	   {
	   			ajaxSend = true;
	   			$(".voting_dream_id").removeClass("activeVotingDrim");
	   			$(this).addClass("activeVotingDrim");
			   var user_id = $(this).attr("rel");
			   $("#voting_dream").html("Загрузка...");
			   $.ajax({
				   type: "POST",
				   url: "../voting/voting_dream.php",
				   data: "USER_ID="+user_id,
				   success: function(data){
				     $("#voting_dream").html(data);
				     ajaxSend = false;
				   }
				 }); 
	   }
   });
   
   $("body").on("click", ".add_voting", function() {
	   if(!ajaxSend)
	   {
		   var dream_id = $(this).attr("rel");
		   if(dream_id && dream_id!="undefined")
		   {
				ajaxSend = true;
			   var hide = $(".hide_vote").prop("checked");
			   if(hide)
				   {
				   		var hide_vote = "Y";
				   }
			   else
				   {
				   		var hide_vote = "N";
				   }
			   var objBtn = $(this).html("Загрузка...");
			   $.ajax({
				   type: "POST",
				   url: "../voting/add_vote.php",
				   data: "DREAM_ID="+dream_id+"&HIDE="+hide_vote,
				   success: function(data){
					 ajaxSend = false;
					 if(data=="error_authorize")
						 {
						 	alert("Для голосования необходимо аторизоваться");
						 	objBtn.html("Голосовать");
						 }
					 else
						 {
						 	if(data=="error_vote")
						 		{
						 			objBtn.html("Голос принят");
						 			objBtn.attr("rel", "");
						 		}
						 	else
						 		{
						 			if(data=="error_exists")
						 				{
						 					objBtn.html("Голосовать");
						 				}
						 			else
						 				{
						 					if(data=="error_add")
						 						{
						 							objBtn.html("Голосовать");
						 						}
						 					else
						 						{
						 						 	$(".add_voting").html("Голос принят");
						 						 	objBtn.attr("rel", "");
						 							$(".vote_count_"+dream_id+" span").text(data);
						 							 $.ajax({
						 								   type: "POST",
						 								   url: "../voting/voting_avatar_list.php",
						 								   data: "DREAM_ID="+dream_id,
						 								   success: function(data){
						 									   if(data)
						 										   {
						 										   		$(".vote_list").html(data);
						 										   }
						 								   }
						 							 });
						 						}
						 				}
						 		}
						 }
				    
				   }
				 });
		   }
	   
	   }
   });
   
   $(".addComment").click(function(){
	   var useHelp = false;
	   var helpId = "";
	   var i=0;
	   $("input.helpOption").each(function(indx, element){
			   if($(element).prop("checked"))
				   {
				   		if(i>0)
				   			{
				   				helpId = helpId+", ";
				   			}
				   		helpId = helpId+$(element).val();
				   		useHelp = true;
				   		i++;
				   }
			});
	   
	   if(useHelp && helpId)
		   {
			   	var comment = $(".helpComment").val();
			   	var dreamId = $(".helpDreamId").val();
			   	if(!ajaxSend)
			   		{
			   			ajaxSend = true;
				   		$.ajax({
							   type: "POST",
							   url: "../realization/add_help_realization.php",
							   data: "AR_ACTION="+helpId+"&COMMENT="+comment+"&DREAM_ID="+dreamId,
							   success: function(data){							   
								   if(data=="error_authorize")
									 {
									 	
									 }
								   else
									 {
									   if(data=="error_exists")
						 				{
										   
						 				}
									   	else
										   {
									   		if(data=="error_add")
					 						{
					 							
					 						}
									   		else
									   			{
									   				$(".commentList").html(data);
									   				$("input.helpOption").removeAttr("checked");
									   				$(".helpComment").val("");
									   			}
										   }
									 }
									 
									 
							   }
						 }); /*Конец ajax*/
				   		
				   		ajaxSend = false;
			   		}
		   }
	   
	   return false;
   });
 
   

   
   
   $(".personalEdit").click(function(){
	   	var getId = $(this).attr("href");
	   	var classControll = $(this).hasClass("personalEditActive");
	   	var getClass = $(this).attr("rel");
	   	if(classControll)
	   		{
				$("#"+getId).hide();
				$("."+getId+"_nature").show();
				$(this).removeClass("personalEditActive");
				$(this).text("Редактировать");
				$(this).prev(".personalTranslate").show();
				
				$.ajax({
                    url:     "/personal/save_edit.php", //Адрес подгружаемой страницы
                    type:     "POST", //Тип запроса
                    dataType: "html", //Тип данных
                    data: 'PROP='+getClass+'&'+$("."+getClass+"_FORM").serialize(), 
                    success: function(response) { 
                    	if(response=="error")
                    		{
                    			
                    		}
                    	else
                    		{
                    			if(response=="error_exists")
                    				{
                    					
                    				}
                    			else
                    				{
                    					$("."+getId+"_nature").html(response);
                    				}
                    		}
                    }
                    
                });
	   		}
	   	else
	   		{
		   		$("#"+getId).show();
				$("."+getId+"_nature").hide();
				$(this).addClass("personalEditActive");
				$(this).text("Сохранить");	
				$(this).prev(".personalTranslate").hide();
	   		}
	   return false;
   });
});

/*Проверка перечислений*/
function intval( mixed_var, base ) {
	var tmp;

	if( typeof( mixed_var ) == 'string' ){
		tmp = parseInt(mixed_var);
		if(isNaN(tmp)){
			return 0;
		} else{
			return tmp.toString(base || 10);
		}
	} else if( typeof( mixed_var ) == 'number' ){
		return Math.floor(mixed_var);
	} else{
		return 0;
	}
}


$(document).ready(function(){
    $("input[name='SUM'], input[name='indicator']").keypress(function (e)  
    { 
      if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
      {
        return false;
      }    
    });
});

$(function() {

	 $(".btnPostPay").click(function(){
		var getMoney = $("input[name='SUM']").val();
		var getType = $("input[name='TYPE']").val();
		var getDream = $("input[name='DREAM_ID']").val();
		var getPrivat = $("input[name='PRIVAT_PAY']").prop("checked");

		if(getPrivat)
		{
			getPrivat = "Y";
		}
		else
		{
			getPrivat = "";
		}	
		if(!(intval(getMoney)>0) || getType.length<=0 || getDream.length<=0)
		{
			return false;
		}

		var getCur =  $(".paySum").next("span").text();	
		if (confirm(" Вы уверены, что хотите перечислить "+getMoney+getCur)) {
			$.ajax({
				  type: "POST",
				  url: "/personal/post_money.php",
				  data: "SUM="+getMoney+"&TYPE="+getType+"&DREAM_ID="+getDream+"&PRIVAT="+getPrivat,
				  success: function(data){
				   if(data=="OK")
					   {
					   		location.reload();
					   }
				  }
			});
		}			 
		return false;
	 });
	 
	 function parseUrlQuery() {
		    var data = {};
		    if(location.search) {
		        var pair = (location.search.substr(1)).split('&');
		        for(var i = 0; i < pair.length; i ++) {
		            var param = pair[i].split('=');
		            data[param[0]] = param[1];
		        }
		    }
		    return data;
		}
	/* var position = $(".showLang").offset();
	 $(".langList").css("top", position.top);
	 $(".langList").css("left", position.left);
	 $(".showLang").click(function(){
		
		 var getSelectClass = $(".showLang .text").next().attr("class");
		 $(".langList div").show();
		 $(".langList div[rel='"+getSelectClass+"']").hide();
		 $(".langList").slideToggle("fast");
	 });
	 $(".langList div").click(function(){
		$(".langList").slideUp("fast"); 
		var getLang = $(this).attr("rel");
		console.log(getLang);
		var getName = $(this).text();
		$(".showLang .text").text(getName);
		$(".showLang .text").next().removeClass().addClass(getLang);
		var url = "";
		if(location.search) {
		        var pair = (location.search.substr(1)).split('&');
	
		        for(var i = 0; i < pair.length; i ++) {
		            var param = pair[i].split('=');
		            if(param[0]!="SET_LANG")
		            	{
		            	 	var url = "&"+param[0]+"="+param[1];
		            	}
		        }
		    }
		window.location = "?SET_LANG="+getLang+url;
	 }); 
	 
	 $(document).click( function(event){
	      if( $(event.target).closest(".showLang").length ) 
	        return;
	  	$(".langList").slideUp("fast"); 
	      event.stopPropagation();
	    });*/
	
});