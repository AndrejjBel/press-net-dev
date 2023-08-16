<footer id="colophon" class="site-footer">
    <div class="footer-generale">
        <div class="footer-generale__content container">
            <div class="footer-generale__content__subscribe">
                <h2 class="site-title"><?php bloginfo( 'name' ); ?></h2>
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

<?php
get_template_part( 'template-parts/popup/add-request' );
get_template_part( 'template-parts/popup/assign-work-journalists' );
get_template_part( 'template-parts/popup/invite-employee' );
