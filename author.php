<?php
/**
 * The template for displaying author pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Press_network
 */

get_header();
if ( press_net_is_user_archive() ) {
?>
<div class="author-wrap container">
	<main id="author-primary" class="author-wrap__main-your-office">
		<?php get_template_part( 'press-inc/template-parts/author/your-office' ); ?>
	</main><!-- #main -->
</div>

<?php } else { ?>

<div class="author-wrap container">
	<main id="author-primary" class="author-wrap__main-for-all-office">
		<?php get_template_part( 'press-inc/template-parts/author/for-all-office' ); ?>
	</main><!-- #main -->

	<aside class="author-wrap__aside">

	</aside>
</div>

<?php
}
get_footer();
