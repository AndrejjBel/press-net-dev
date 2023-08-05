<footer id="colophon" class="site-footer">
    <div class="footer-generale">
        <div class="footer-generale__content container">
            <div class="footer-generale__content__subscribe">
                <h2 class="site-title"><?php bloginfo( 'name' ); ?></h2>
                <!-- <p class="footer-generale__content__subscribe__text">Подписывайтесь на нашу новостную рассылку</p>
                <div class="footer-generale__content__subscribe__form">
                    <input type="text" name="subscribe" value="" placeholder="Ваш E-mail">
                    <button type="button" name="button">
                        <svg width="22" height="22" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M0 128C0 92.65 28.65 64 64 64H448C483.3 64 512 92.65 512 128V384C512 419.3 483.3 448 448 448H64C28.65 448 0 419.3 0 384V128zM32 128V167.9L227.6 311.3C244.5 323.7 267.5 323.7 284.4 311.3L480 167.9V128C480 110.3 465.7 96 448 96H63.1C46.33 96 31.1 110.3 31.1 128H32zM32 207.6V384C32 401.7 46.33 416 64 416H448C465.7 416 480 401.7 480 384V207.6L303.3 337.1C275.1 357.8 236.9 357.8 208.7 337.1L32 207.6z"/>
                        </svg>
                    </button>
                </div> -->

                <!-- <div class="footer-generale__content__subscribe__text">
                    <h5>Менеджер по вопросам клиентов</h5>
                    <h5><a href="tel:+7(918)698-28-85">+7(918)698-28-85</a></h5>
                    <h5>Сервисное обслуживание</h5>
                    <h5><a href="tel:+7(918)071-17-17">+7(918)071-17-17</a></h5>
                    <h5>г.Краснодар, ул.Леваневского, 15</h5>
                </div> -->
            </div>
            <div class="footer-generale__content__menu">
                <div class="footer-generale__content__menu__item">
                    <h3 class="footer-generale__content__menu__item__title">
                        <?php echo wp_get_nav_menu_name( 'footer-1' ); ?>
                    </h3>
                    <?php
                        wp_nav_menu( array(
                        	'theme_location' => 'footer-1',
                        	'fallback_cb' => '__return_empty_string'
                        ) );
                    ?>
                </div>
                <div class="footer-generale__content__menu__item">
                    <h3 class="footer-generale__content__menu__item__title">
                        <?php echo wp_get_nav_menu_name( 'footer-2' ); ?>
                    </h3>
                    <?php
                        wp_nav_menu( array(
                        	'theme_location' => 'footer-2',
                        	'fallback_cb' => '__return_empty_string'
                        ) );
                    ?>
                </div>
                <!-- <div class="footer-generale__content__menu__item"></div> -->
            </div>
        </div>
        <div class="footer-generale__bottom">
            <div class="footer-generale__bottom__copyright-text container">
                <span><?php bloginfo( 'name' ); ?> © 2023 All rights reserved</span>
            </div><!-- .site-info -->
        </div>
    </div>
</footer><!-- #colophon -->

<div class="overlay js-overlay-modal"></div>

<?php get_template_part( 'template-parts/popup/add-request' );?>
