/**
 * @package Customizer
 * @version 0.7
 */

jQuery(document).ready(function ($) {

/**
 *
 * AJAX requests setup
 *
 **/
$.ajaxSetup ({ cache: false });
var ajax_load = "loading...";
var loadUrl = $.cookie('customizerCookie');

function customizerAjax( dataString, callBack ){ $.ajax({ type: "POST", url: loadUrl, data: dataString, success: callBack }); }
function customizerAjaxJSON( dataString, callBack ){ $.ajax({ type: "POST", url: loadUrl, data: dataString, dataType: 'json', success: callBack }); }
/* > */

/**
 *
 * jQuery Injections and Actions
 *
 **/

/* Form set outside of the main form to prevent form nesting */
$('#customize-controls').after('<form id="customizer_add_section_form" action=""></form><form id="customizer_add_control_form" action=""></form>');

//Add container for ajax call of Add Section
$('#customize-theme-controls > ul').append('<div id="customizer_result"></div>');

/* Add (x) buttons to all sections except the default ones */
$('.customize-section-title, .customize-control').not("#customize-control-blogname, #customize-control-blogdescription, #customize-control-header_textcolor, #customize-info, #customize-section-title_tagline, #customize-section-colors, #customize-section-header_image, #customize-section-nav, #customize-control-nav_menu_locations-primary, #customize-control-show_on_front, #customize-section-static_front_page, #customize-section-background_image")
	.prepend('<span class="x" title="delete">&times;</span>');

/* (x) Delete Section */
$('.customize-section-title .x').on( 'click', function(e){
	e.stopPropagation();

	// get section ID
	var customizer_section = $(this).parent().parent().attr('id');
	var customizer_section = customizer_section.substring(18);

	var section_del = confirm ("Delete section " + customizer_section + "?");

	if (section_del) {
		var dataString = 'r=removeSection&rid='+customizer_section;
		customizerAjax(dataString,function() { $('#customize-section-'+customizer_section).fadeOut('fast');	});
	}
});

$('.customize-control .x').on( 'click', function(e){
	e.stopPropagation();
	var customizer_control = $(this).parent().attr('id');
	var customizer_control = customizer_control.substring(18);

	var control_del = confirm ("Delete control " + customizer_control + "?");
	if (control_del) {

		var dataString = 'r=removeControl&rid='+customizer_control;

		customizerAjax(dataString,function() {
			customizerAjax(dataString,function() { $('#customize-control-'+customizer_control).fadeOut('fast');	});
		});

	}
});

//On each customize section expand

$('#customize-theme-controls').on('click', '.control-section .accordion-section-title', function(){
	if ( !$(this).parent().hasClass('open') ){
		//opening
		$('.customizer_control_adder').remove();
		$(this).parent().append('<div id="customizer_control_adder" class="customizer_control_adder"><a class="button-header" id="customizer_add_control">+ Add Control</a></div>', customizer_add_control_callback() );
	} else {
		//closing
		$('.customizer_control_adder').remove();
	}
});

/*																ADD CONTROL																*/

//When add control button is clicked
function customizer_add_control_callback() {

	$('#customize-theme-controls').on('click','#customizer_add_control',function(e){
		var customizer_section = $(this).parent().parent().attr('id');
		var customizer_section = customizer_section.substring(18);

		if(!$(this).hasClass('expanded')){

			var dataString = 'r=addControl';
			$(this).parent().html(ajax_load).load(loadUrl, dataString, function(){

				//Autocomplete
				$('#customizer_add_id').suggest($.cookie('customizerCookie') +"?r=suggest",{
					onSelect: function() {
						//alert("You selected: " + this.value);
					}
				});

				$('#customizer_add_type').change(
				//KEEP IT IN A SEPARATE FUNCTION - oh god! It's a duplicate!
				function(){
					var type =  $(this).val();
					if ( type == 'radio' || type == 'select' ) {
						$('#customizer_add_type_after').html('<div id="customizer_extra_fields2"><label for="customizer_add_type_values"><span class="customize-control-title">Values for '+type+' input type</span><input type="text" name="customizer_add_type_values" id="customizer_add_type_values" placeholder="value:label, value:label&hellip;"></label></div>');
					} else { $('#customizer_extra_fields2').remove(); }
				});

				/////////////////// -------------->
				 $('#customizer_add_control_form').validate({
				  submitHandler: function(form) {
						customizer_s_submit(form);
						function customizer_s_submit(){

							var customizer_control_id = $("input#customizer_add_id").val();
							var customizer_control_label = $("input#customizer_add_label").val();
							var customizer_control_type = $("#customizer_add_type").val();
							var customizer_control_type_val = $("#customizer_add_type_values").val();

							var dataString = 'customizer_action=post_control&cid=' + customizer_control_id
														 + '&label=' + customizer_control_label
														 + '&type=' + customizer_control_type
														 + '&typeval=' + customizer_control_type_val
														 + '&sid=' + customizer_section
														 ;
														 //alert(dataString);
							//initial validation
							if ( customizer_control_id && customizer_control_label && customizer_control_type ){
								customizerAjax(dataString, function() { window.location.reload(); });
								return false;
							} else {
								alert('Please populate all required fields');
							}
						}

					}
				 });

			});

		}

		e.stopImmediatePropagation();
		$(this).addClass('expanded');
	});
}

$("#customizer_result").html(ajax_load).load(loadUrl, null, function(){
		customizer_section_controls();
});

/*																ADD SECTION																*/

function customizer_section_controls() {
	//assign click action to Add Section button
	$('#customizer_add_section').on( 'click',  function(e){
		e.preventDefault();

		//allow to be clicked only once
		if ( $('#ajax_target_new_section').length && $('#customizer_add_section').hasClass('collapsed') ){
			$('#ajax_target_new_section').slideDown('fast');
			$(this).removeClass('collapsed').addClass('expanded');
		} else if ( !($(this).hasClass('expanded')) ){

			//Set Ajax request for the content of 'Add Section'
			$(this).after('<div id="ajax_target_new_section"></div>');
			var dataString = 'r=addSection';
			$("#ajax_target_new_section").html(ajax_load).load(loadUrl, dataString, function(){

				/* On type change */
				$('#customizer_add_first_type').change(

				//KEEP IT IN A SEPARATE FUNCTION
				function(){
					var type =  $(this).val();
					if ( type == 'radio' || type == 'select' ) {
						$('#customizer_add_first_type_after').html('<div id="customizer_extra_fields"><label for="customizer_add_first_type_values"><span class="customize-control-title">Values for '+type+' input type</span><input type="text" name="customizer_add_first_type_values" id="customizer_add_first_type_values" placeholder="value:label, value:label&hellip;"></label></div>');
					} else { $('#customizer_extra_fields').remove(); }
				});

				$("#customizer_add_section_form").validate({
				  submitHandler: function(form) {
					customizer_submit(form);
					function customizer_submit(){

					//setup ajax variables
					var customizer_post_id = $("input#customizer_add_section_ID").val();
					var customizer_post_title = $("input#customizer_add_section_title").val();
					var customizer_post_description = $("input#customizer_add_section_description").val();
					var customizer_post_priority = $("input#customizer_add_section_priority").val();
					var customizer_first_prefix = $("#customizer_add_first_prefix").val();
					var customizer_first_id = $("input#customizer_add_first_id").val();
					var customizer_first_label = $("input#customizer_add_first_label").val();
					var customizer_first_type = $("#customizer_add_first_type").val();
					var customizer_first_type_val = $("#customizer_add_first_type_values").val();

					//Define dataString to be published with AJAX
					var dataString = 'customizer_action=post_section&sid='+ customizer_post_id
												 + '&title=' + customizer_post_title
												 + '&desc=' + customizer_post_description
												 + '&priority=' + customizer_post_priority
												 + '&cid=' + customizer_first_id
												 + '&label=' + customizer_first_label
												 + '&type=' + customizer_first_type
												 + '&typeval=' + customizer_first_type_val
												 ;

					// post if all required fields have been populated
					if ( customizer_post_id && customizer_post_title && customizer_first_id && customizer_first_label && customizer_first_type ) {
						customizerAjax(dataString, function() { window.location.reload(); });
						return false; 
					} else {
						alert('Please populate all required fields');
					}
				 }
				}
			  });

			});
			$(this).removeClass('collapsed').addClass('expanded');
		} else {
			$(this).removeClass('expanded').addClass('collapsed');
			$('#ajax_target_new_section').slideUp('fast');
		}

	});
}

//
//
// in Customizer Options
//
//

if($('#customizer_is_serialized').attr('checked')){
} else {
	$('#customizer_serialized_option').parent().parent().hide();
}

$('#customizer_is_serialized').change(function(){
	if($(this).attr('checked')){
		$('#customizer_serialized_option').parent().parent().fadeIn('slow');
	} else {
		$('#customizer_serialized_option').parent().parent().fadeOut('slow');
	}
});

//
//
// in Customizer Pro Options
//
//

$('#upload_csv_button').on( 'click', function() {
 formfield = $('#upload_csv').attr('name');
 tb_show('', 'media-upload.php?type=file&amp;TB_iframe=true');
 return false;
});

//if we are looking at the customizer window
if ($('#customize-controls').length) {
	window.send_to_editor = function(html) {

	 fileurl = $(html).attr('href');
	 $('#upload_csv').val(fileurl);
	 tb_remove();
	 $('#customizer_import_container').slideDown('slow');
	}
}


$('#customizer_csv_go').on( 'click', function(e){
	e.preventDefault;
	if ( !$('#upload_csv').val() ) {
		alert('Please select a file');
	} else if ( !$('#upload_csv').val().toLowerCase().match(".csv$") ) {
		alert('Only CSV files are accepted');
	} else {

		//Passed Validation
		var csv_prompt = confirm ("Are You Sure?\n This will overwrite current settings!");

		if ( csv_prompt ){
			var dataString = "r=csv&f="+$('#upload_csv').val();
			customizerAjax(dataString, function() { alert('Import Complete'); });
		}
	}
});

$('#customizer_reset_button').on( 'click', function(e){
	e.preventDefault();
	var dataString = "r=reset";
	var reset_prompt = confirm ("Are You Sure?\nThis will remove all Sections and Controls created by Customizer!\nSettings will not be affected.");

	if (reset_prompt){
		customizerAjax(dataString, function() { alert('All Sections and Controls added by Customizer have been removed'); });
	}
});

/*
 * ID Field Validation
 * 
 * Don't allow to add incorrect ID's
 */
$('#customize-controls').on('blur', '.customizer-type-id', function(){
	Text = convertToSlug ( $(this).val() );
	$(this).val(Text);
});

/*
 * Autopopulate Section ID with Title
 * 
 */
$('#customize-controls').on('blur', '#customizer_add_section_title', function(){
	Text = convertToSlug ( $(this).val() );
	if ( !$('#customizer_add_section_ID').val() ){
		$('#customizer_add_section_ID').val(Text);
	}
});

/*
 * Autopopulate Control ID with Title
 * 
 */
$('#customize-controls').on('blur', '#customizer_add_label', function(){
	Text = convertToSlug ( $(this).val() );
	if ( !$('#customizer_add_id').val() ){
		$('#customizer_add_id').val(Text);
	}
});

/*
 * Autopopulate Control ID with Title
 * 
 */
$('#customize-controls').on('blur', '#customizer_add_first_label', function(){
	Text = convertToSlug ( $(this).val() );
	if ( !$('#customizer_add_first_id').val() ){
		$('#customizer_add_first_id').val(Text);
	}
});

/*
 * Make all the Customizer fields sortable
 * 
 */
$('#customize-theme-controls > ul').sortable(
	{
		axis: 						'y',
		containment: 			".wp-full-overlay-sidebar-content",
		items: 						">li.control-section",
		cancel: 					"input,select,label,textarea,#accordion-section-title_tagline,#accordion-section-colors,#accordion-section-header_image,#accordion-section-background_image,#accordion-section-nav,#accordion-section-static_front_page,#accordion-section-featured_content",
		update: 					function(e, ui){
												sortElementsAndAddDataPriority(e,ui);
											},
	}
);

function customizerAssignPriorities(){
	// add priority to all default tabs
	$('#accordion-section-title_tagline')			.attr('data-priority','20');
	$('#accordion-section-colors')						.attr('data-priority','40');
	$('#accordion-section-header_image')			.attr('data-priority','60');
	$('#accordion-section-background_image')	.attr('data-priority','80');
	$('#accordion-section-nav')								.attr('data-priority','100');
	$('#accordion-section-static_front_page')	.attr('data-priority','120');
	$('#accordion-section-featured_content')	.attr('data-priority','130');


	/* this shouldn't really belong here, for testing purposes only: */
	$('#accordion-section-baseek_customizer_layout').attr('data-priority','200');
	$('#accordion-section-baseek_customizer_graphics').attr('data-priority','210');

	dataString = "r=priorities";
	customizerAjaxJSON(dataString,function(customizerPrioritiesPHP) { 

		var customizerPriorities = JSON.parse( $.cookie('customizerPriority') );
		if ( customizerPriorities && customizerPrioritiesPHP ){
			for(var name in customizerPrioritiesPHP) {
				if ( customizerPrioritiesPHP[name] ){
					$("#accordion-section-"+name).attr( 'data-priority', customizerPrioritiesPHP[name] );
				} else {
					$("#accordion-section-"+name).attr( 'data-priority', customizerPriorities[name] );
				}
			}
		}
		
	});

}

function sortElementsAndAddDataPriority(e,ui){
	sortedElement 				= ui.item;  // sorted object
	aboveSortedElement  	= sortedElement.prev(); // object above the sorted one
	belowSortedElement  	= sortedElement.next(); // object below the sorted one
	
	var sortPos = parseInt( aboveSortedElement.attr('data-priority') ) + 1;
	if (sortPos) {
		sortedElement.attr('data-priority', sortPos );
		var nextPos = parseInt( belowSortedElement.attr('data-priority') );
		if ( nextPos && (nextPos == sortPos) ) {
			increaseSortingPriority( belowSortedElement, nextPos, e, ui );
		}	else if ( belowSortedElement && belowSortedElement.next() ){
			increaseSortingPriority( belowSortedElement.next(), parseInt( belowSortedElement.next().attr('data-priority') ), e, ui );
		}
	}

	addDataPriorities();
}

function addDataPriorities(){
	// create an object with all priorities attached
	var allPriorities = {}

	// add all objects except for the default WP ones
	$('#customize-theme-controls .control-section').not('#accordion-section-title_tagline, #accordion-section-colors, #accordion-section-header_image, #accordion-section-background_image, #accordion-section-nav, #accordion-section-static_front_page, #accordion-section-featured_content').each(function(){
		allPriorities[$(this).attr('id').substring(18)] = $(this).attr('data-priority');
	});

	// take over save button
	$('#save').removeAttr('disabled').addClass('customizer-save-takeover').val('Save').on( 'click', function(e){
		// save allPriorities into Cookie
		$.cookie( 'customizerPriority', JSON.stringify(allPriorities), { expires: 10, path: '/' } );
	});
}

customizerAssignPriorities();
addDataPriorities();

//  - - - - - - - - - - end of $ scope - - - - - - - - - - 
});

// Makes the text suitable for ID
function convertToSlug(Text) {
	return Text.toLowerCase()
				.replace(/^\s\s*/, '')
				.replace(/\s\s*$/, '')
        .replace(/ /g,'_')
        .replace(/-/g,'_')
        .replace(/[^\w-]+/g,'')
        ;
}

function increaseSortingPriority( sortedElement, sortedPriority, e, ui ){
	if ( sortedPriority != undefined ){
		sortedElement.attr('data-priority', sortedPriority + 1 );
		var nextSortedElement = sortedElement.next();
		if ( parseInt( nextSortedElement.attr('data-priority') ) == sortedPriority ){
			increaseSortingPriority( nextSortedElement, sortedPriority + 1, e, ui );
		}
	}
}