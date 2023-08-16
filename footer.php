<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Press_network
 */

global $current_user;

if ( !is_page( ['login', 'email-verification', 'signup', 'forgot', 'recovery-password'] ) ) {
    get_template_part( 'template-parts/head-footer/footer' );
}
?>

</div><!-- #page -->

<?php
wp_footer();
?>

<form id="form-all">
    <?php wp_nonce_field( 'press-network', 'press-network' ); ?>
    <input type="hidden" name="current_user" id="current_user" value="<?php echo $current_user->ID; ?>">
    <input type="hidden" name="post_type" id="post_type" value="<?php echo $post->post_type; ?>">
</form>

</body>
</html>
