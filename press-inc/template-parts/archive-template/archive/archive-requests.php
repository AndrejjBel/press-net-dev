<?php if ( is_user_logged_in() && press_net_current_user_type('journalist') ) { ?>
    <div class="archive-buttons-header mt12">
        <div class="archive-buttons-header__item">
            <button type="button" name="button" class="button btn-primary-smail js-open-modal" data-modal="add-request-form">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 5v14M5 12h14"></path>
                </svg>
                <span>Add request</span>
            </button>
        </div>
    </div>
<?php } ?>

<?php if ( have_posts() ) : ?>
<div class="archive-posts mt12">
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

// $elements = ['7', '11'];
// $elements_num = [];
// foreach ($elements as $element) {
//     $elements_num[] = (int)$element;
// }
// function press_net_arr_int($elements) {
//     foreach ($elements as $element) {
//         $elements_num[] = (int)$element;
//     }
// }

// array_walk($elements , 'press_net_arr_int');

// array_walk($elements, function ($elements, $row) {
//     foreach ($elements as $row) {
//         $row = (int)$row;
//     }
// });
// var_dump($elements_num);
?>

<form id="author_nonce">
    <input type="hidden" name="current_user_id" id="current_user_id" value="<?php echo $user_ID; ?>" />
    <?php wp_nonce_field( 'press_net_add_post', 'press_net_add_post' ); ?>
</form>
