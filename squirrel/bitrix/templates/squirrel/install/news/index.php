<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Белочка - Новости");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "N");
$APPLICATION->SetTitle('КП "Полёт" сообщает о новинках!');
?>
			Кондитерская фабрика "Полёт" сообщила о новинках!<br />
			 <article>
				<figure>
					<a href="#"><img src="<?=SITE_TEMPLATE_PATH?>/images/news1.png" alt="" title="" /></a>
					<figcaption>
						<h4>ШТРУДЛИКИ С МАЛИНОЙ</h4><br />
						<aside>
							<strong>Цена: 24.90 руб</strong><br />
							<strong>Артикул: ПЕЧЕНПТ-00</strong><br />
							<strong>Вес: 200 г</strong><br />
							<a href="#">описание товара</a>
						</aside><div class="clear"></div>
						<p>По мнению нашей компании этот продукт восхитителен на вкус!<br />
						Кроме того , появилось еще "Овсяное с фундуком и кленовым сиропом " фасованное 180 гр.
						</p>
					</figcaption>
				</figure>
			</article>
			<article>
				<figure>
					<a href="#"><img src="<?=SITE_TEMPLATE_PATH?>/images/news2.png" alt="" title="" /></a>
					<figcaption>
						<h4>СДОБНОЕ С КОКОСОМ</h4><br />
						<aside>
							<strong>Цена: 28.70 руб</strong><br />
							<strong>Артикул: ПЕЧЕНПТ-118</strong><br />
							<strong>Вес: 250 г</strong><br />
							<a href="#">описание товара</a>
						</aside><div class="clear"></div>
						<p>Следующая новинка фабрики "Полет": “Сдобное с кокосом”, фасованное по 250г.
						</p>
					</figcaption>
				</figure>
			</article>
			<article>
				<figure>
					<a href="#"><img src="<?=SITE_TEMPLATE_PATH?>/images/news3.png" alt="" title="" /></a>
					<figcaption>
						<h4>ОВСЯНОЕ ПЕЧЕНЬЕ с фундуком и кленовым сиропом</h4><br />
						<aside>
							<strong>Цена: 33.30 руб</strong><br />
							<strong>Артикул: ПЕЧЕНПТ-115</strong><br />
							<strong>Вес: 180 г</strong><br />
							<a href="#">описание товара</a>
						</aside><div class="clear"></div>
						<p></p>
					</figcaption>
				</figure>
			</article>
			<p><a href="#">перейти к другим новостям</a></p>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>