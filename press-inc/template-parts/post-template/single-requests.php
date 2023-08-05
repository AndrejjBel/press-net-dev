<div class="single-request">
    <div class="single-request__mass-media-information">
        <div class="single-request__mass-media-information__title">
            <div class="single-request__mass-media-information__title__logo">
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
            <div class="single-request__mass-media-information__title__text">
                <?php press_net_media_parent_meta($post->mass_media_parent_id); ?>
                <div class="single-request__mass-media-information__title__text__meta">
                    <span class="meta-date" title="Published"><?php the_date('d.m.y'); ?></span>
                    <span class="meta-deadline" title="Deadline">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.99999 13.4167C6.12333 13.4166 5.26691 13.1531 4.54177 12.6605C3.81663 12.1678 3.25622 11.4687 2.9332 10.6537C2.61017 9.83875 2.53944 8.94552 2.73016 8.08986C2.92088 7.23419 3.36427 6.45556 4.00283 5.85492C4.78566 5.11817 6.70833 3.79167 6.41666 0.875C9.91666 3.20833 11.6667 5.54167 8.16666 9.04167C8.74999 9.04167 9.62499 9.04167 11.0833 7.60083C11.2408 8.05175 11.375 8.5365 11.375 9.04167C11.375 10.202 10.9141 11.3148 10.0936 12.1353C9.27311 12.9557 8.16031 13.4167 6.99999 13.4167Z" fill="#FF7875"></path>
                        </svg>
                        <?php echo date("d M Y, H:i", $post->deadline);?>
                    </span>
                </div>
            </div>
            <div class="single-request__mass-media-information__title__buttons">
                <button type="button" name="button" title="Subscribe">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 20a1 1 0 1 0 0-2 1 1 0 0 0 0 2ZM4 4a16 16 0 0 1 16 16M4 11a9 9 0 0 1 9 9"></path>
                    </svg>
                </button>
                <button type="button" name="button" title="To favorites">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 4h6a2 2 0 0 1 2 2v14l-5-3-5 3V6a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
                <button type="button" name="button" title="Forward the request to someone who can answer it">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="m12.55 4 7.69 7.7-7.7 7.26v-4.7c-5.98 0-8.54 6.4-8.54 6.4C4 13.4 6.14 8.7 12.55 8.7V4Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="single-request__content mt24">
        <div class="single-request__content__title">
            <h1><?php the_title(); ?></h1>
        </div>
        <div class="single-request__content__description mt24">
            <h1><?php the_content(); ?></h1>
        </div>
        <div class="single-request__content__meta">
            <span class="meta-label">Number of signs:</span>
            <span>from <?php echo $post->signs_number_from; ?></span>
            <span>before <?php echo $post->signs_number_upto; ?></span>
        </div>
    </div>
</div>
