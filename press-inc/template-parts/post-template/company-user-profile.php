<div class="profile-company__items__item">
    <div class="profile-company__items__item__title">
        <?php if ( $post->post_type == COMPANY ) {
            the_title();
        } elseif ( $post->post_type == MEDIA ) {
            the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' );
        } elseif ( $post->post_type == PORTFOLIO ) {
            if ( $post->portfolio_link ) {
                the_title( '<a href="http://' . $post->portfolio_link . '" rel="bookmark">', '</a>' );
            } else {
                the_title();
            }
        }
        ?>
    </div>
    <div class="profile-company__items__item__job-title">
        <?php if ( $post->post_type == COMPANY || $post->post_type == MEDIA ) {
            echo $post->job_title;
        } elseif ( $post->post_type == PORTFOLIO ) {
            echo wp_date( 'd.m.Y', $post->portfolio_date );
        }
        ?>
    </div>
</div>
