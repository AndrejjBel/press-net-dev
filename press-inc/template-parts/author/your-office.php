<?php
    global $authordata, $current_user, $user_ID;
    $author_id = $authordata->ID;
?>
<div class="author-wrap__main-your-office__nav">
    <?php get_template_part( 'press-inc/template-parts/author/your-office-nav' ); ?>
</div>
<div class="author-wrap__main-your-office__content">
    <?php get_template_part( 'press-inc/template-parts/author/your-office-content' ); ?>
</div>

<form id="author_nonce">
    <input type="hidden" name="author_archive_id" id="author_archive_id" value="<?php echo $author_id; ?>" />
    <input type="hidden" name="current_user_id" id="current_user_id" value="<?php echo $user_ID; ?>" />
    <?php wp_nonce_field( 'press_net_add_post', 'press_net_add_post' ); ?>
</form>
