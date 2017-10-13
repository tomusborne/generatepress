<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package GeneratePress
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

	<section id="primary" <?php generate_content_class(); ?>>
		<main id="main" <?php generate_main_class(); ?>>
		<?php
		do_action( 'generate_before_main_content' );

		if ( have_posts() ) {
			do_action( 'generate_archive_title' );

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/* Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );

			endwhile;

			generate_content_nav( 'nav-below' );
		} else {
			get_template_part( 'no-results', 'archive' );
		}

		do_action( 'generate_after_main_content' ); ?>
		</main><!-- #main -->
	</section><!-- #primary -->

<?php
do_action( 'generate_sidebars' );
get_footer();
