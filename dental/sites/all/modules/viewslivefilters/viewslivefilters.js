// $Id: viewslivefilters.js,v 1.1 2009/07/12 20:14:23 ximo Exp $

/**
 * @file
 * Views Live Filters - Automatically applies exposed filters when changed.
 *
 * Authors:
 *   Joakim Stai (http://drupal.org/user/88701)
 *   Jakob Persson (http://drupal.org/user/37564)
 *
 * Sponsors:
 *   SF Bio (http://www.sf.se)
 *   NodeOne (http://www.nodeone.se)
 */

Drupal.behaviors.viewsLiveFilters = function() {
  $('.view-filters form:not(.viewsLiveFilters-processed)').each(function() {
    var form = this;
    var timeout = undefined;
    var delay = 1000;

    // Add throbber to element's label
    var throb = function(elem) {
      $(elem).after('<span class="views-throbbing">&nbsp</span>');
    };

    // Remove form's submit button.
    $(':submit, .submit-button', form).hide();

    // Submit form immediately when a form element's value changes.
    $('.views-exposed-widget .form-item :input', form).bind('change', function() {
      throb(this);
      $(form).submit();
    });

    // Submit form after a delay when user types into a text element.
    $('.views-exposed-widget .form-text', form).bind('keyup', function() {
      if (timeout) {
        clearTimeout(timeout);
      }
      var elem = this;
    	timeout = setTimeout(function() {
    	  timeout = undefined;
        throb(elem);
    	  $(form).submit();
    	}, delay);
    });

  }).addClass('viewsLiveFilters-processed');
}
