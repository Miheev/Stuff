<span class="callme_viewform" style="cursor: pointer;"><img src="http://konditerka.com/zvonok.png" title="Обратный звонок" alt="мы вам перезвоним"  /><span></span></span> <?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?> 
<div>
  <br />
</div>

<div>
  <br />
</div>

<?php if (preg_match('/sladkie_podarki/', $APPLICATION->GetCurPage())) : ?>
    <div><a id="bxid_836171" href="http://www.konditerka.com/sladkie_podarki/" ><img id="bxid_189116" src="/bitrix/templates/squirrel_inner_copy/images/sladpodarkjpg.jpg" title="Новогодние подарки" border="0" alt="np.jpg" width="200" height="83"  /></a></div>
<?php elseif (preg_match('/newyear/', $APPLICATION->GetCurPage())) : ?>
    <div><a id="bxid_836171" href="http://www.konditerka.com/newyear/" ><img id="bxid_189116" src="http://www.konditerka.com/upload/medialibrary/985/9852f7ada77ca7018e1b296aa631f92b.jpg" title="Новогодние подарки" border="0" alt="np.jpg" width="200" height="83"  /></a></div>
<?php else : ?>
    <div><a id="bxid_836171" href="http://www.konditerka.com/catalog/" ><img id="bxid_189116" src="/bitrix/templates/squirrel_inner_copy/images/katalogjpg.jpg" title="Новогодние подарки" border="0" alt="np.jpg" width="200" height="83"  /></a></div>
<?php endif; ?>
