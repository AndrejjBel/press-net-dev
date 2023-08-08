<header class="page-header">
    <h1 class="archive-title">
        <?php the_archive_title();?>
         <sup><?php echo wp_count_posts('mass-media')->publish;?></sup>
    </h1>
</header><!-- .page-header -->

<div class="archive-search-header input-search-group mt12">
    <input type="text" name="" value="" class="input" placeholder="Search across all queries">
    <svg class="input-clear-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M5 5L19 19M5 19L19 5" stroke="#8C8C8C" stroke-width="1.5" stroke-linecap="round"></path>
    </svg>
    <svg class="input-search-icon" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M13.1648 12.9884L10.9402 10.78C11.8037 9.70246 12.2219 8.33477 12.1088 6.95814C11.9956 5.58151 11.3597 4.30059 10.3318 3.37875C9.30397 2.45692 7.96223 1.96424 6.58252 2.00202C5.20281 2.03981 3.89 2.60518 2.91403 3.58189C1.93806 4.5586 1.37312 5.8724 1.33536 7.25316C1.29761 8.63392 1.78992 9.97668 2.71105 11.0053C3.63219 12.034 4.91214 12.6704 6.28772 12.7836C7.6633 12.8968 9.02995 12.4783 10.1067 11.6141L12.3134 13.8225C12.3691 13.8787 12.4354 13.9234 12.5085 13.9538C12.5816 13.9843 12.6599 14 12.7391 14C12.8183 14 12.8966 13.9843 12.9697 13.9538C13.0428 13.9234 13.1091 13.8787 13.1648 13.8225C13.2729 13.7106 13.3333 13.5611 13.3333 13.4054C13.3333 13.2498 13.2729 13.1003 13.1648 12.9884V12.9884ZM6.74267 11.6141C5.91248 11.6141 5.10094 11.3678 4.41066 10.9062C3.72038 10.4446 3.18238 9.78855 2.86468 9.02097C2.54698 8.25339 2.46386 7.40877 2.62582 6.59392C2.78778 5.77906 3.18755 5.03057 3.77458 4.4431C4.36162 3.85562 5.10954 3.45554 5.92378 3.29346C6.73801 3.13137 7.58199 3.21456 8.34898 3.5325C9.11598 3.85044 9.77154 4.38885 10.2328 5.07965C10.694 5.77045 10.9402 6.58262 10.9402 7.41343C10.9402 8.52753 10.4979 9.59599 9.71075 10.3838C8.92357 11.1716 7.85592 11.6141 6.74267 11.6141V11.6141Z" fill="#8C8C8C"></path>
    </svg>
</div>

<div class="archive-filter mt12">
    <div class="archive-filter__item">
        <button type="button" name="button">
            <span>Categories</span>
        </button>
    </div>
    <div class="archive-filter__item">
        <button type="button" name="button">
            <span>Regions</span>
        </button>
    </div>
    <div class="archive-filter__item">
        <button type="button" name="button">
            <span>Formats</span>
        </button>
    </div>
</div>

<?php if ( have_posts() ) : ?>
<div class="archive-posts mt12 mb48">
    <?php
        while ( have_posts() ) :
            the_post();
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
