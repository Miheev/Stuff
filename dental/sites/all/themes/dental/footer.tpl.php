  <div id="dental-bottom-container">
    <div id="dental-bottom">
      <div id="dental-bottom-menu">
        <?php echo $menu['bottom'] ?>
      </div>
      <div id="dental-bottom-bottom">
        <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width: 100%">
           <tr>
            <td align="left" valign="top">
			<? print @seo_links_footer(); ?>				
			<?php echo $footer ?>
            </td>
			
            <td align="right" valign="top" class="dental-copy">
                  <a target="_blank" href="http://pf27.ru/">Создание сайта</a>&nbsp;–&nbsp;Перфоманс&nbsp;<span><a target="_blank" href="http://pf27.ru/"><img alt="Создание и продвижение сайта в Хабаровске" title="Создание и продвижение сайта в Хабаровске" src="http://pf27.ru/copyrights/12/sozdanie-i-prodvizhenie-sajta-v-habarovske.png"></a></span><br>
<!--              --><?php //print "Создано <a href = 'http://pf27.ru'>Перфоманс</a>";//echo $footer_message ?>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <!-- Yandex.Metrika counter --><script type="text/javascript">(function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter16449319 = new Ya.Metrika({id:16449319, enableAll: true}); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="//mc.yandex.ru/watch/16449319" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
  <?php print $closure ?>
  </body>
</html>