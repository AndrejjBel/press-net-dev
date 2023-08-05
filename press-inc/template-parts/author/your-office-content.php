<div class="author-wrap__main-your-office__content__tab <?php press_net_get_param('profile'); ?>" id="profile">
    <?php get_template_part( 'press-inc/template-parts/author/tabs/profile' ); ?>
</div>

<div class="author-wrap__main-your-office__content__tab <?php press_net_get_param('about'); ?>" id="about">
    <?php get_template_part( 'press-inc/template-parts/author/tabs/about' ); ?>
</div>

<?php if ( is_user_logged_in() && press_net_current_user_type('journalist') ) { ?>
    <div class="author-wrap__main-your-office__content__tab <?php press_net_get_param('media'); ?>" id="media">
        <?php get_template_part( 'press-inc/template-parts/author/tabs/media' ); ?>
    </div>

    <div class="author-wrap__main-your-office__content__tab <?php press_net_get_param('journalists'); ?>" id="journalists">
        <?php get_template_part( 'press-inc/template-parts/author/tabs/journalists' ); ?>
    </div>
<?php } ?>

<?php if ( is_user_logged_in() && press_net_current_user_type('expert') ) { ?>
    <div class="author-wrap__main-your-office__content__tab <?php press_net_get_param('companies'); ?>" id="companies">
        <?php get_template_part( 'press-inc/template-parts/author/tabs/companies' ); ?>
    </div>

    <div class="author-wrap__main-your-office__content__tab <?php press_net_get_param('speakers'); ?>" id="speakers">
        <?php get_template_part( 'press-inc/template-parts/author/tabs/speakers' ); ?>
    </div>
<?php } ?>

<div class="author-wrap__main-your-office__content__tab <?php press_net_get_param('portfolio'); ?>" id="portfolio">
    <?php get_template_part( 'press-inc/template-parts/author/tabs/portfolio' ); ?>
</div>

<div class="author-wrap__main-your-office__content__tab <?php press_net_get_param('referer'); ?>" id="referer">
    <?php get_template_part( 'press-inc/template-parts/author/tabs/referer' ); ?>
</div>
