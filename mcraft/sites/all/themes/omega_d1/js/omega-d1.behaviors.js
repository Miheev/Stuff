var mediaq= 0;
var mediawidthmobile = 480;
var mediawidthmin = 768;
var mediawidth1 = 870;
var mediawidthmax = 1140;

(function ($) {

  /**
   * The recommended way for producing HTML markup through JavaScript is to write
   * theming functions. These are similiar to the theming functions that you might
   * know from 'phptemplate' (the default PHP templating engine used by most
   * Drupal themes including Omega). JavaScript theme functions accept arguments
   * and can be overriden by sub-themes.
   *
   * In most cases, there is no good reason to NOT wrap your markup producing
   * JavaScript in a theme function.
   */
  Drupal.theme.prototype.omegaD1ExampleButton = function (path, title) {
    // Create an anchor element with jQuery.
    return $('<a class="test" href="' + path + '" title="' + title + '">' + title + '</a>');
  };

  /**
   * Behaviors are Drupal's way of applying JavaScript to a page. In short, the
   * advantage of Behaviors over a simple 'document.ready()' lies in how it
   * interacts with content loaded through Ajax. Opposed to the
   * 'document.ready()' event which is only fired once when the page is
   * initially loaded, behaviors get re-executed whenever something is added to
   * the page through Ajax.
   *
   * You can attach as many behaviors as you wish. In fact, instead of overloading
   * a single behavior with multiple, completely unrelated tasks you should create
   * a separate behavior for every separate task.
   *
   * In most cases, there is no good reason to NOT wrap your JavaScript code in a
   * behavior.
   *
   * @param context
   *   The context for which the behavior is being executed. This is either the
   *   full page or a piece of HTML that was just added through Ajax.
   * @param settings
   *   An array of settings (added through drupal_add_js()). Instead of accessing
   *   Drupal.settings directly you should use this because of potential
   *   modifications made by the Ajax callback that also produced 'context'.
   */
  Drupal.behaviors.omegaD1ExampleBehavior = {
    attach: function (context, settings) {
      // By using the 'context' variable we make sure that our code only runs on
      // the relevant HTML. Furthermore, by using jQuery.once() we make sure that
      // we don't run the same piece of code for an HTML snippet that we already
      // processed previously. By using .once('foo') all processed elements will
      // get tagged with a 'foo-processed' class, causing all future invocations
      // of this behavior to ignore them.
      $('.some-selector', context).once('foo', function () {
        // Now, we are invoking the previously declared theme function using two
        // settings as arguments.
        var $anchor = Drupal.theme('omegaD1ExampleButton', settings.myExampleLinkPath, settings.myExampleLinkTitle);

        // The anchor is then appended to the current element.
        $anchor.appendTo(this);
      });
    }
  };

    /**
     * Main behaviors
     * @type {{attach: attach}}
     */
  Drupal.behaviors.omegaD1ArtEffect = {
      attach: function(c, s) {
          $('.l-page', c).once('tranc', function(){
              if (!$.support.transition)
                  $.fn.transition = $.fn.animate;


              effects= {
                  craft: function(){
                      $('.craftman').transition({x: -50},1000).delay(500).transition({x: 0},1000);
                  },
                  graund: function(){
                      $('.ground-cube-top .bk_top_left').transition({y: -100},1000).delay(500).transition({y: 0},1000);
                      $('.ground-cube-down .bk_right_down').transition({y: -100},1000).delay(500).transition({y: 0},1000);

                      $('.ground-cube-top .bk_top_right').transition({y: 90},1200).delay(450).transition({y: 0},1000);
                      $('.ground-cube-down .bk_left_down').transition({y: 150},1200).delay(450).transition({y: 0},1000);
                  }
              }

              effects.craft();
              effects.graund();

              tc= setInterval(effects.craft,5000);
              tg= setInterval(effects.graund,3000);
          });
      }
  }

})(jQuery);