<?php $meta_btn = press_net_subscribe_user_post_archive_is($post->ID, 'subscribe_media');?>
<div class="archive-posts__item">
    <div class="archive-posts__item__logo">
        <img src="<?php echo press_net_has_post_thumbnail($post->ID)['thumb_url']; ?>" alt="">
    </div>
    <div class="archive-posts__item__title">
        <a href="<?php the_permalink();?>" class="archive-posts__item__link" title="Go to <?php the_title(); ?>"><?php the_title(); ?></a>
    </div>
    <div class="archive-posts__item__meta">
        <?php press_net_meta_smi();?>
    </div>
    <div class="archive-posts__item__buttons">
        <button type="button" name="button" class="js-assign-work js-open-modal"
            title="Order advertising in this media"
            data-modal="assign-work-journalists" data-overlay="all" data-post="<?php echo $post->ID;?>">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18ZM9 12h6M12 9v6"></path>
            </svg>
        </button>
        <button type="button" name="button" title="<?php echo $meta_btn['title']; ?>"
            class="js-btn-subscribe<?php echo $meta_btn['btn_class']; ?>"
            data-post="<?php echo $post->ID;?>" data-post-type="subscribe_media" data-subscr="archive">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 20a1 1 0 1 0 0-2 1 1 0 0 0 0 2ZM4 4a16 16 0 0 1 16 16M4 11a9 9 0 0 1 9 9"></path>
            </svg>
        </button>
    </div>
</div>
