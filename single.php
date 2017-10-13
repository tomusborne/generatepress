<?php
/**
 * The Template for displaying all single posts.
 *
 * @package GeneratePress
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

	<div id="primary" <?php generate_content_class();?>>
		<main id="main" <?php generate_main_class(); ?>>
		<?php
		do_action( 'generate_before_main_content' );

		while ( have_posts() ) : the_post();

			get_template_part( 'content', 'single' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || '0' != get_comments_number() ) : ?>
				<div class="comments-area">
					<?php comments_template(); ?>
				</div>
			<?php endif;

		endwhile; // end of the loop.

		do_action( 'generate_after_main_content' ); ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
do_action( 'generate_sidebars' );
get_footer();
