			<footer class="footer" role="contentinfo">

				<div id="inner-footer" class="wrap cf">
                    <div class="hr"></div>

					<nav role="navigation">
						<?php wp_nav_menu(array(
    					'container' => '',                              // remove nav container
    					'container_class' => 'footer-links cf',         // class of container (should you choose to use it)
    					'menu' => __( 'Footer Links', 'bonestheme' ),   // nav name
    					'menu_class' => 'nav footer-nav cf',            // adding custom nav class
    					'theme_location' => 'footer-links',             // where it's located in the theme
    					'before' => '',                                 // before the menu
        			'after' => '',                                  // after the menu
        			'link_before' => '',                            // before each link
        			'link_after' => '',                             // after each link
        			'depth' => 0,                                   // limit the depth of the nav
    					'fallback_cb' => 'bones_footer_links_fallback'  // fallback function
						)); ?>
					</nav>

					<div class="cf">
                        <div class="source-org copyright"><a href="#">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>.</a></div>
                        <div class="contacts">
                            <strong>Контактная информация</strong><br />
                            Тел.: <a href="tel:+79242066202">+7-914-206-6202</a><br />
                            Адрес: <a href="http://info@forexgrant.ru">info@forexgrant.ru</a><br />
                            Skype: <a href="callto:forexgrant_info">forexgrant_info</a>
                        </div>
                    </div>
				</div>

			</footer>

		</div>

		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>

	</body>

</html> <!-- end of site. what a ride! -->
