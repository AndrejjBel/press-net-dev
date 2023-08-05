<div class="author-wrap__main-for-all-office__content mb24">
    <div class="author-wrap__main-for-all-office__content__title mb20">My requests</div>
    <div class="author-wrap__main-for-all-office__content__items">
        <?php press_net_author_requests_list(); ?>
    </div>
</div>

<div class="author-wrap__main-for-all-office__content">
    <div class="author-wrap__main-for-all-office__content__title mb20">My media</div>
    <div class="author-wrap__main-for-all-office__content__items">
        <?php press_net_get_user_posts(MEDIA, ''); ?>
    </div>
</div>
