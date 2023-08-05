<?php
    global $authordata, $current_user, $user_ID;
    $author_id = $authordata->ID;
    if ( press_net_current_user_type('expert') ) {
        $post_type = 'company';
        $title_block = 'My companies';
    }
    if ( press_net_current_user_type('journalist') ) {
        $post_type = 'mass-media';
        $title_block = 'My media';
    }
?>
<div class="author-wrap__main-your-office__content__tab__profile">
    <div class="author-wrap__main-your-office__content__tab__profile__name">
        <div class="author-wrap__main-your-office__content__tab__profile__name__avatar">
            <?php echo get_avatar( $author_id, 150 ); ?>
        </div>
        <div class="author-wrap__main-your-office__content__tab__profile__name__name">
            <?php echo get_the_author(); ?>
        </div>
        <div class="author-wrap__main-your-office__content__tab__profile__name__type">
            <?php echo press_net_user_type(); ?>
        </div>
    </div>

    <div class="author-wrap__main-your-office__content__tab__profile__info">
        <div class="author-wrap__main-your-office__content__tab__profile__info__company profile-company">
            <div class="profile-company__title-block"><?php echo $title_block; ?></div>
            <div class="profile-company__items">
                <?php press_net_get_user_posts($post_type, false); ?>
            </div>
        </div>
    </div>
</div>
