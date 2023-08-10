<?php global $authordata, $current_user;
$meta_btn = press_net_subscribe_user_post_single_is($post->ID, 'subscribe_media');
?>
<div class="single-mass-media">
    <div class="single-mass-media__basic-information block-item">
        <div class="single-mass-media__basic-information__title">
            <div class="single-mass-media__basic-information__title__logo">
                <svg width="50" height="50" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="60" height="60" fill="white"/>
                    <circle cx="30" cy="30" r="30" fill="#EFF4FA"/>
                    <path d="M22.2724 29.6914H16.169V37.9819C16.169 40.169 17.9491 42 20.1871 42H38.294C41.1422 42 43.431 39.7112 43.431 36.8629V18.4H22.2724V29.6914ZM18.0509 38.0328V31.5733H22.2724V37.9819C22.2724 39.1517 21.306 40.0672 20.1871 40.0672C19.0681 40.0672 18.0509 39.2026 18.0509 38.0328ZM24.1543 20.2819H41.4983V36.8629C41.4983 38.6431 40.0233 40.1181 38.2431 40.1181H23.544C23.9509 39.5078 24.1543 38.7957 24.1543 38.0328V30.6578V29.6914V20.2819Z" fill="#BDC2C9"/>
                    <path d="M28.5285 25.3681H33.0043C33.5129 25.3681 33.9707 24.9612 33.9707 24.4017C33.9707 23.8422 33.5129 23.4862 33.0043 23.4862H28.5285C28.0198 23.4862 27.5621 23.8931 27.5621 24.4526C27.5621 25.0121 27.969 25.3681 28.5285 25.3681Z" fill="#BDC2C9"/>
                    <path d="M28.5285 29.0302H37.2767C37.7854 29.0302 38.2431 28.6233 38.2431 28.0638C38.2431 27.5043 37.8362 27.0974 37.2767 27.0974H28.5285C28.0198 27.0974 27.5621 27.5043 27.5621 28.0638C27.5621 28.6233 27.969 29.0302 28.5285 29.0302Z" fill="#BDC2C9"/>
                    <path d="M28.5285 32.6922H37.2767C37.7854 32.6922 38.2431 32.2853 38.2431 31.7259C38.2431 31.1664 37.8362 30.7595 37.2767 30.7595H28.5285C28.0198 30.7595 27.5621 31.1664 27.5621 31.7259C27.5621 32.2853 27.969 32.6922 28.5285 32.6922Z" fill="#BDC2C9"/>
                    <path d="M28.5285 36.3543H37.2767C37.7854 36.3543 38.2431 35.9474 38.2431 35.3879C38.2431 34.8284 37.8362 34.4216 37.2767 34.4216H28.5285C28.0198 34.4216 27.5621 34.8284 27.5621 35.3879C27.5621 35.9474 27.969 36.3543 28.5285 36.3543Z" fill="#BDC2C9"/>
                </svg>
            </div>
            <div class="single-mass-media__basic-information__title__text">
                <h1><?php the_title(); ?></h1>
            </div>
        </div>

        <div class="single-mass-media__basic-information__meta">
            <div class="single-mass-media__basic-information__meta__item">
                <span>Website: </span>
                <span><a href="https://<?php echo $post->website;?>"><?php echo $post->website;?></a></span>
            </div>
            <div class="single-mass-media__basic-information__meta__item">
                <span>Editorial office: </span>
                <span><?php echo $post->city;?></span>
            </div>
            <div class="single-mass-media__basic-information__meta__item">
                <span>Subject: </span>
                <?php press_net_media_subject();?>
            </div>
        </div>

        <div class="single-mass-media__basic-information__buttons">
            <button type="button" name="btn-subscribe-media"
                id="btn-subscribe-media"
                class="button btn-primary-smail mb10 js-btn-subscribe"
                data-post="<?php echo $post->ID;?>" data-post-type="subscribe_media" data-subscr="single">
                <span class="subscr subscribe<?php echo $meta_btn['subscribe'];?>">Subscribe to this media</span>
                <span class="subscr unfollow<?php echo $meta_btn['unfollow'];?>">Unfollow this media</span>
            </button>

            <button type="button" name="btn-invite-editorial" id="btn-invite-editorial"
                class="button btn-primary-smail-revers js-open-modal"
                data-modal="invite-employee" data-overlay="all">
                <span>Invite editorial staff</span>
            </button>
        </div>
    </div>

    <div class="single-mass-media__media-inquiries block-item">
        <div class="block-item__title">Media inquiries</div>
        <?php press_net_media_requests_list($post->ID);?>
    </div>

    <div class="single-mass-media__authors block-item">
        <div class="block-item__title">Authors</div>

        <div class="single-mass-media__authors__item">
            <div class="single-mass-media__authors__item__avatar">
                <?php echo get_avatar( $authordata->ID, 150 ); ?>
            </div>
            <div class="single-mass-media__authors__item__name">
                <a href="<?php echo get_author_posts_url( $authordata->ID );?>" title="Go to user"><?php echo $authordata->display_name;?></a>
            </div>
        </div>

    </div>
</div>
