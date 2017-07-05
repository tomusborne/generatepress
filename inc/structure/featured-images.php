<?php
defined( 'WPINC' ) or die;

if ( ! function_exists( 'generate_post_image' ) ) :
/**
 * Prints the Post Image to post excerpts
 */
add_action( 'generate_after_entry_header', 'generate_post_image' );
function generate_post_image() {
	// If there's no featured image, return
	if ( ! has_post_thumbnail() ) {
		return;
	}

	// If we're not on any single post/page or the 404 template, we must be showing excerpts
	if ( ! is_singular() && ! is_404() ) {
		echo apply_filters( 'generate_featured_image_output', sprintf(
			'<div class="post-image">
				<a href="%1$s" title="%2$s">
					%3$s
				</a>
			</div>',
			esc_url( get_permalink() ),
			the_title_attribute( 'echo=0' ),
			get_the_post_thumbnail( get_the_ID(), apply_filters( 'generate_page_header_default_size', 'full' ), array('itemprop' => 'image') )
		));
	}
}
endif;

if ( ! function_exists( 'generate_featured_page_header_area' ) ) :
/**
 * Build the page header
 * @since 1.0.7
 */
function generate_featured_page_header_area( $class ) {
	// Don't run the function unless we're on a page it applies to
	if ( ! is_singular() ) {
		return;
	}

	// Don't run the function unless we have a post thumbnail
	if ( ! has_post_thumbnail() ) {
		return;
	}

	?>
	<div class="<?php echo esc_attr( $class ); ?> grid-container grid-parent">
		<?php the_post_thumbnail( apply_filters( 'generate_page_header_default_size', 'full' ), array( 'itemprop' => 'image' ) ); ?>
	</div>
	<?php
}
endif;

if ( ! function_exists( 'generate_featured_page_header' ) ) :
/**
 * Add page header above content
 * @since 1.0.2
 */
add_action( 'generate_after_header', 'generate_featured_page_header' );
function generate_featured_page_header() {
	if ( function_exists( 'generate_page_header' ) ) {
		return;
	}

	if ( is_page() ) {
		generate_featured_page_header_area( 'page-header-image' );
	}
}
endif;

if ( ! function_exists( 'generate_featured_page_header_inside_single' ) ) :
/**
 * Add post header inside content
 * Only add to single post
 * @since 1.0.7
 */
add_action( 'generate_before_content', 'generate_featured_page_header_inside_single' );
function generate_featured_page_header_inside_single() {
	if ( function_exists( 'generate_page_header' ) ) {
		return;
	}

	if ( is_single() ) {
		generate_featured_page_header_area( 'page-header-image-single' );
	}
}
endif;