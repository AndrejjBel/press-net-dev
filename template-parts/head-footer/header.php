<header id="masthead" class="site-header<?php if ( is_front_page() ) echo ' color-home'; ?>">
    <div class="header-generale container">
        <div class="header-generale__branding">
            <?php
            the_custom_logo();
            if ( is_front_page() ) :
                ?>
                <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
                <?php
            else :
                ?>
                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <?php
            endif;
            ?>
        </div><!-- .site-branding -->

        <nav id="site-navigation" class="header-generale__navigation">
            <button class="menu-clouse" aria-expanded="false">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289Z" fill="#6B8194"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z" fill="#6B8194"></path>
                </svg>
            </button>
            <?php
            $icon = '<svg width="14" height="14" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                        <path d="M360.5 217.5l-152 143.1C203.9 365.8 197.9 368 192 368s-11.88-2.188-16.5-6.562L23.5 217.5C13.87 208.3 13.47 193.1 22.56 183.5C31.69 173.8 46.94 173.5 56.5 182.6L192 310.9l135.5-128.4c9.562-9.094 24.75-8.75 33.94 .9375C370.5 193.1 370.1 208.3 360.5 217.5z"/>
                    </svg>';
            wp_nav_menu(
                array(
                    'theme_location' => 'menu-1',
                    'menu_id'        => 'primary-menu',
                    'container_class' => 'primary-nav-menu',
                    'after' => $icon
                )
            );
            ?>
            <div class="header-generale__info mobile-only"></div><!-- .header-generale__info -->
        </nav><!-- #site-navigation -->
        <div class="header-generale__info">
            <?php if ( is_user_logged_in() ) { ?>
                <div class="header-generale__info__avatar">
                    <?php echo get_avatar( wp_get_current_user()->ID, 32 ); ?>
                    <div class="header-generale__info__avatar__nav">
                        <div class="header-generale__info__avatar__nav__content">
                            <div class="header-generale__info__avatar__nav__content__title">
                                <?php echo press_net_get_userdata('display_name'); ?>
                            </div>
                            <div class="header-generale__info__avatar__nav__content__account">Basic account</div>
                            <div class="header-generale__info__avatar__nav__content__nav">
                                <ul>
                                    <li><a href="<?php echo press_net_get_user_link_lk(''); ?>" data-tab="profile">Profile and settings</a></li>
                                    <li><a href="<?php echo press_net_get_user_link_lk('referer'); ?>" data-tab="referer">Referral program</a></li>
                                </ul>
                                <ul>
                                    <li><a href="<?php echo wp_logout_url(); ?>" title="Logout">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <a href="/signup" class="header-generale__info__link btn-primary btn-nav reg-link">Registration</a>
                <a href="/login" class="header-generale__info__link btn-primary btn-nav">Login</a>
            <?php } ?>
        </div><!-- .header-generale__info -->
        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
            <svg width="28" height="28" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path d="M0 80C0 71.16 7.164 64 16 64H432C440.8 64 448 71.16 448 80C448 88.84 440.8 96 432 96H16C7.164 96 0 88.84 0 80zM0 240C0 231.2 7.164 224 16 224H432C440.8 224 448 231.2 448 240C448 248.8 440.8 256 432 256H16C7.164 256 0 248.8 0 240zM432 416H16C7.164 416 0 408.8 0 400C0 391.2 7.164 384 16 384H432C440.8 384 448 391.2 448 400C448 408.8 440.8 416 432 416z"/>
            </svg>

        </button>
    </div>
</header><!-- #masthead -->
<div class="header-fixed-height"></div>
<?php if ( !is_front_page() && is_page() ) { ?>
    <!-- <section class="page-title-area" style="background-image: url(<?php //echo get_template_directory_uri();?>/img/page_title_bg.jpg);">
        <div class="page-title-area__content container">
            <h1><?php //the_title(); ?></h1>
            <div class="page-title-area__content__breadcrumb">
                <?php //if ( function_exists( 'dimox_breadcrumbs' ) ) dimox_breadcrumbs(); ?>
            </div>
        </div>
    </section> -->
<?php } ?>
