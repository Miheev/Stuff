/* Первая функция это тоже самое что  serialize() только наоборот , она заполняет  форму по данным из массива. */
(function($)
{
    $.fn.deserialize = function(data, clearForm)
    {
        this.each(function(){
            deserialize(this, data, !!clearForm);
        });
    };
 
    function deserialize(element, data, clearForm)
    {
        var splits = decodeURIComponent(data).split('&'),
            i = 0,
            split = null,
            key = null,
            value = null,
            splitParts = null;
 
        if (clearForm)
        {
            $('input[type="checkbox"],input[type="radio"]', element).removeAttr('checked');
            $('select,input[type="text"],input[type="password"],input[type="hidden"],textarea', element).val('');
        }
 
        while(split = splits[i++])
        {
            splitParts = split.split('=');
            key = splitParts[0] || '';
            value = (splitParts[1] || '').replace(/\+/g, ' ');
 
            if (key != '')
            {
                $('input[type="checkbox"][name="'+ key +'"][value="'+ value +'"],input[type="radio"][name="'+ key +'"][value="'+ value +'"]', element).attr('checked', 'checked');
                $('select[name="'+ key +'"],input[type="text"][name="'+ key +'"],input[type="password"][name="'+ key +'"],input[type="hidden"][name="'+ key +'"],textarea[name="'+ key +'"]', element).val(value);
            }
        }
    }
 
})(jQuery);
 
/* Function for ours ajax inquiry  */
function ajaxpostshow(urlres, datares, wherecontent ){
       $.ajax({
           type: "POST",
           url: urlres,
           data: datares,
           dataType: "html",
           beforeSend: function(){
                var elementheight = $(wherecontent).height();
                $(wherecontent).prepend('<div class="ajaxloader"></div>');
                $('.ajaxloader').css('height', elementheight);
                $('.ajaxloader').prepend('<img class="imgcode" src="/js/ajax/ajax-loader.gif">');
            },
           success: function(fillter){
                $(wherecontent).html(fillter);
           }
      });
}
 
  /* Sending ajax inquiry with values of filters, formation of value of filters */
   $(".catalog-filter input, .catalog-filter select").live("change", function(){
       var arrayform = $(".catalog-filter form").serialize();
       location.hash = arrayform;
       var ajaxfillter = document.location.hash.substr(1);
       ajaxpostshow("/include/ajax/fillter-element.php", ajaxfillter, ".list-selection-element" );
   });
 
  /* Conclusion of values from the filter with the help ajax and hashe */
  $(document).ready(function(){
     var hash = window.location.hash.substr(1);
     if(hash != "") {
         var ajaxfillter = document.location.hash.substr(1);
         $(".catalog-filter form").deserialize(ajaxfillter, true);
         ajaxpostshow("/include/ajax/fillter-element.php", ajaxfillter, ".list-selection-element" );
     }
  });
/* Event for ajax paginal navigation */
   $(".ajax-navigation a").live("click", function(){
         var pagenum = $(this).attr('id');
         var arrayform = $(".catalog-filter form").serialize();
         var ajaxfillter = arrayform + '&' + pagenum;
         location.hash = ajaxfillter;
         ajaxpostshow("/include/ajax/fillter-element.php", ajaxfillter, ".list-selection-element" );
         return false;
   });