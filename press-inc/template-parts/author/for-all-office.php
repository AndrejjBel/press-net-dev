<?php
    global $authordata, $current_user, $user_ID;
    $author_id = $authordata->ID;
?>
<div class="author-wrap__main-for-all-office__info">
    <div class="author-wrap__main-for-all-office__info__name">
        <div class="author-wrap__main-for-all-office__info__name__avatar">
            <?php echo get_avatar( $author_id, 150 ); ?>
        </div>
        <div class="author-wrap__main-for-all-office__info__name__name">
            <?php echo get_the_author(); ?>
        </div>
        <div class="author-wrap__main-for-all-office__info__name__type">
            <?php echo press_net_user_type(); ?>
        </div>
        <div class="author-wrap__main-for-all-office__info__name__type">
            <?php echo $authordata->description; ?>
        </div>
    </div>
</div>

<div class="author-wrap__main-for-all-office__content">
    <?php
    if ( press_net_author_type('expert') ) {
        get_template_part( 'press-inc/template-parts/author/expert-office' );
    }
    if ( press_net_author_type('journalist') ) {
        get_template_part( 'press-inc/template-parts/author/journalists-office' );
    }
    ?>
</div>
