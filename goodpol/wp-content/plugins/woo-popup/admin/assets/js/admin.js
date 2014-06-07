jQuery(function () {
	"use strict";
	var popupPermanent = jQuery('#woo-popup_permanent'),
		popupDates = jQuery(".woo-popup_dates");

	function isPermanent(){
		if(popupPermanent.attr('checked')){
			popupDates.fadeOut();
		}else{
			popupDates.fadeIn();
		}
	}

	isPermanent();
	popupPermanent.on('click', isPermanent);

	jQuery( "#woo-popup-from" ).datepicker({
		dateFormat : 'yy-mm-dd',
	      changeMonth: true,
	      onClose: function( selectedDate ) {
	        jQuery( "#woo-popup-to" ).datepicker( "option", "minDate", selectedDate );
	      }
    });
    jQuery( "#woo-popup-to" ).datepicker({
	      dateFormat : 'yy-mm-dd',
	      changeMonth: true,
	      onClose: function( selectedDate ) {
	        jQuery( "#woo-popup-from" ).datepicker( "option", "maxDate", selectedDate );
	      }
    });

});
