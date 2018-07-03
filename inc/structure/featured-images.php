<?php
/**
 * Featured image elements.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'generate_post_image' ) ) {
	add_action( 'generate_after_entry_header', 'generate_post_image' );
	/**
	 * Prints the Post Image to post excerpts
	 */
	function generate_post_image() {
		// If there's no featured image, return.
		if ( ! has_post_thumbnail() ) {
			return;
		}

		// If we're not on any single post/page or the 404 template, we must be showing excerpts.
		if ( ! is_singular() && ! is_404() ) {
			echo apply_filters( 'generate_featured_image_output', sprintf( // WPCS: XSS ok.
				'<div class="post-image">
					<a href="%1$s">
						%2$s
					</a>
				</div>',
				esc_url( get_permalink() ),
				get_the_post_thumbnail(
					get_the_ID(),
					apply_filters( 'generate_page_header_default_size', 'full' ),
					array(
						'itemprop' => 'image',
					)
				)
			) );
		}
	}
}

if ( ! function_exists( 'generate_featured_page_header_area' ) ) {
	/**
	 * Build the page header.
	 *
	 * @since 1.0.7
	 *
	 * @param string The featured image container class
	 */
	function generate_featured_page_header_area( $class ) {
		// Don't run the function unless we're on a page it applies to.
		if ( ! is_singular() ) {
			return;
		}

		// Don't run the function unless we have a post thumbnail.
		if ( ! has_post_thumbnail() ) {
			return;
		}
		?>
		<div class="<?php echo esc_attr( $class ); ?> grid-container grid-parent">
			<?php the_post_thumbnail(
				apply_filters( 'generate_page_header_default_size', 'full' ),
				array(
					'itemprop' => 'image',
					'alt' => the_title_attribute( 'echo=0' ),
				)
			); ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'generate_featured_page_header' ) ) {
	add_action( 'generate_after_header', 'generate_featured_page_header', 10 );
	/**
	 * Add page header above content.
	 *
	 * @since 1.0.2
	 */
	function generate_featured_page_header() {
		if ( function_exists( 'generate_page_header' ) ) {
			return;
		}

		if ( is_page() ) {
			generate_featured_page_header_area( 'page-header-image' );
		}
	}
}

if ( ! function_exists( 'generate_featured_page_header_inside_single' ) ) {
	add_action( 'generate_before_content', 'generate_featured_page_header_inside_single', 10 );
	/**
	 * Add post header inside content.
	 * Only add to single post.
	 *
	 * @since 1.0.7
	 */
	function generate_featured_page_header_inside_single() {
		if ( function_exists( 'generate_page_header' ) ) {
			return;
		}

		if ( is_single() ) {
			generate_featured_page_header_area( 'page-header-image-single' );
		}
	}
}
