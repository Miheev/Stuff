var mediaq= 0;
var mediawidthmobile = 480;
var mediawidthmin = 768;
var mediawidth1 = 870;
var mediawidthmax = 1140;

(function ($) {

    Drupal.theme.prototype.omegaD1Hfix = function () {
        // Create an anchor element with jQuery.
        if ($('[class*="l-region--sidebar"]').height() - $('.l-content').height() < 0) {
            $('[class*="l-region--sidebar"]').height($('.l-content').innerHeight());
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
                      $('.craftman').transition({x: -50},1200, 'easeInOutCubic').delay(1000).transition({x: 0},1500, 'easeInOutCubic');
                  },
                  graund: function(){
                      $('.ground-cube-top .bk_top_left').transition({y: -100},1500, 'cubic-bezier(.045,.090,.090,.045)').delay(1500).transition({y: 0},1500, 'cubic-bezier(.045,.090,.090,.045)').delay(1500);;
                      $('.ground-cube-down .bk_right_down').transition({y: -100},1500, 'cubic-bezier(.045,.090,.090,.045)').delay(1500).transition({y: 0},1500, 'cubic-bezier(.045,.090,.090,.045)').delay(1500);;

                      $('.ground-cube-top .bk_top_right').transition({y: 90},1600, 'cubic-bezier(.045,.090,.090,.045)').delay(1600).transition({y: 0},1600, 'cubic-bezier(.045,.090,.090,.045)');
                      $('.ground-cube-down .bk_left_down').transition({y: 150},1400, 'cubic-bezier(.045,.090,.090,.045)').delay(1400).transition({y: 0},1400, 'cubic-bezier(.045,.090,.090,.045)');
                  }
              }

              effects.craft();
              effects.graund();

              tc= setInterval(effects.craft,5000);
              tg= setInterval(effects.graund,5000);
          });
      }
  }

  Drupal.behaviors.omegaD1HfixExec = {
    attach: function(c, s) {
        setTimeout(Drupal.theme('omegaD1Hfix'), 0);
        //setTimeout(Drupal.theme('omegaD1Hfix'), 100);

        $(window).resize(function(){
            setTimeout(Drupal.theme('omegaD1Hfix'), 0);
            //setTimeout(Drupal.theme('omegaD1Hfix'), 100);
        });
    }
  }

})(jQuery);