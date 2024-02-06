<?php
/**
 * Post meta elements.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'wp_footer', 'generate_do_search_modal' );
/**
 * Create the search modal HTML.
 */
function generate_do_search_modal() {
	if ( ! generate_get_option( 'nav_search_modal' ) ) {
		return;
	}
	?>
	<div class="gp-modal gp-search-modal" id="gp-search">
		<div class="gp-modal__overlay" tabindex="-1" data-gpmodal-close>
			<div class="gp-modal__container">
				<?php do_action( 'generate_inside_search_modal' ); ?>
			</div>
		</div>
	</div>
	<?php
}

/**
 * Create the search modal trigger.
 */
function generate_do_search_modal_trigger() {
	if ( ! generate_get_option( 'nav_search_modal' ) ) {
		return;
	}
	?>
	<span class="menu-bar-item">
		<a href="#" role="button" aria-label="<?php _e( 'Open search', 'generatepress' ); ?>" data-gpmodal-trigger="gp-search"><?php echo generate_get_svg_icon( 'search', true ); // phpcs:ignore -- Escaped in function. ?></a>
	</span>
	<?php
}

add_filter( 'generate_enable_modal_script', 'generate_enable_search_modal' );
/**
 * Enable the search modal.
 */
function generate_enable_search_modal() {
	return generate_get_option( 'nav_search_modal' );
}

add_action( 'generate_base_css', 'generate_do_search_modal_css' );
/**
 * Do the modal CSS.
 *
 * @param Object $css The existing CSS object.
 */
function generate_do_search_modal_css( $css ) {
	if ( ! generate_get_option( 'nav_search_modal' ) ) {
		return;
	}

	$css->set_selector( '.search-modal-fields' );
	$css->add_property( 'display', 'flex' );

	$css->set_selector( '.gp-search-modal .gp-modal__overlay' );
	$css->add_property( 'align-items', 'flex-start' );
	$css->add_property( 'padding-top', '25vh' );
	$css->add_property( 'background', 'var(--gp-search-modal-overlay-bg-color)' );

	$css->set_selector( '.search-modal-form' );
	$css->add_property( 'width', '500px' );
	$css->add_property( 'max-width', '100%' );
	$css->add_property( 'background-color', 'var(--gp-search-modal-bg-color)' );
	$css->add_property( 'color', 'var(--gp-search-modal-text-color)' );

	$css->set_selector( '.search-modal-form .search-field, .search-modal-form .search-field:focus' );
	$css->add_property( 'width', '100%' );
	$css->add_property( 'height', '60px' );
	$css->add_property( 'background-color', 'transparent' );
	$css->add_property( 'border', 0 );
	$css->add_property( 'appearance', 'none' );
	$css->add_property( 'color', 'currentColor' );

	$css->set_selector( '.search-modal-fields button, .search-modal-fields button:active, .search-modal-fields button:focus, .search-modal-fields button:hover' );
	$css->add_property( 'background-color', 'transparent' );
	$css->add_property( 'border', 0 );
	$css->add_property( 'color', 'currentColor' );
	$css->add_property( 'width', '60px' );

	return $css;
}

add_action( 'generate_inside_search_modal', 'generate_do_search_fields' );
/**
 * Add our search fields to the modal.
 */
function generate_do_search_fields() {
	?>
	<form role="search" method="get" class="search-modal-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label for="search-modal-input" class="screen-reader-text"><?php echo apply_filters( 'generate_search_label', _x( 'Search for:', 'label', 'generatepress' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></label>
		<div class="search-modal-fields">
			<input id="search-modal-input" type="search" class="search-field" placeholder="<?php echo esc_attr( apply_filters( 'generate_search_placeholder', _x( 'Search &hellip;', 'placeholder', 'generatepress' ) ) ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
			<button aria-label="<?php echo esc_attr( apply_filters( 'generate_search_button', _x( 'Search', 'submit button', 'generatepress' ) ) ); ?>"><?php echo generate_get_svg_icon( 'search' ); // phpcs:ignore -- Escaped in function. ?></button>
		</div>
		<?php do_action( 'generate_inside_search_modal_form' ); ?>
	</form>
	<?php
}
