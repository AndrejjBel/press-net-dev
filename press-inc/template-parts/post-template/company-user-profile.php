<div class="profile-company__items__item">
    <div class="profile-company__items__item__title">
        <?php if ( $post->post_type == COMPANY ) {
            the_title();
        } elseif ( $post->post_type == MEDIA ) {
            the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' );
        }
        ?>
    </div>
    <div class="profile-company__items__item__job-title">
        <?php echo $post->job_title; ?>
    </div>
</div>
