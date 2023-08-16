<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Press_network
 */

get_header();
$post_type = $post->post_type; // get_post_type();
?>

	<main id="primary" class="site-main container">

		<?php get_template_part( 'press-inc/template-parts/archive-template/archive/archive', $post_type ); ?>

	</main><!-- #main -->

<?php
get_footer();
