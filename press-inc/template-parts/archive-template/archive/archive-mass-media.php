<header class="page-header">
    <?php the_archive_title( '<h1 class="archive-title">', '</h1>' );?>
</header><!-- .page-header -->

<?php if ( have_posts() ) : ?>
<div class="archive-posts">
    <?php
        while ( have_posts() ) : the_post();
            get_template_part( 'press-inc/template-parts/archive-template/post-type/content', get_post_type() );
        endwhile;
    ?>
</div>
<?php the_posts_navigation(); ?>

<?php
else :
    get_template_part( 'press-inc/template-parts/archive-template/post-type/content', 'none' );
endif;
?>
