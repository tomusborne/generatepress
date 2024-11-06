<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<div class="no-results not-found" role="alert" aria-live="polite">
	<div class="inside-article">
		<?php
		/**
		 * generate_before_content hook.
		 *
		 * @since 0.1
		 *
		 * @hooked generate_featured_page_header_inside_single - 10
		 */
		do_action( 'generate_before_content' );
		?>

		<header <?php generate_do_attr( 'entry-header' ); ?>>
			<h1 class="entry-title"><?php _e( 'Nothing Found', 'generatepress' ); ?></h1>
		</header>

		<?php
		/**
		 * generate_after_entry_header hook.
		 *
		 * @since 0.1
		 *
		 * @hooked generate_post_image - 10
		 */
		do_action( 'generate_after_entry_header' );
		?>

		<div class="entry-content">

				<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

					<p>
						<?php
						printf(
							/* translators: 1: Admin URL */
							__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'generatepress' ),
							esc_url( admin_url( 'post-new.php' ) )
						);
						?>
					</p>

				<?php elseif ( is_search() ) : ?>
					<?php
					$nothing_found_search = apply_filters(
						'generate_not_found_search',
						__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'generatepress' )	
					);
					?>
					<p><?php echo esc_html( $nothing_found_search ); ?></p>
					<?php get_search_form(); ?>

				<?php else : ?>
					<?php
					$nothing_found_other = apply_filters(
						'generate_not_found_other',
						__( 'It seems we can&rsquo;t find what you’re looking for. Perhaps searching can help.', 'generatepress' )
					);
					?>
					<p><?php echo esc_html( $nothing_found_other ); ?></p>
					<?php get_search_form(); ?>

				<?php endif; ?>

		</div>

		<?php
		/**
		 * generate_after_content hook.
		 *
		 * @since 0.1
		 */
		do_action( 'generate_after_content' );
		?>
	</div>
</div>
