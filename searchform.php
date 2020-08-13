<?php
/**
 * The template for displaying search forms in Generate
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo apply_filters( 'generate_search_label', _x( 'Search for:', 'label', 'generatepress' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr( apply_filters( 'generate_search_placeholder', _x( 'Search &hellip;', 'placeholder', 'generatepress' ) ) ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php echo esc_attr( apply_filters( 'generate_search_label', _x( 'Search for:', 'label', 'generatepress' ) ) ); ?>">
	</label>
	<?php
	if ( generate_is_using_flexbox() ) {
		printf(
			'<button class="search-submit" aria-label="%1$s">%2$s</button>',
			esc_attr( apply_filters( 'generate_search_button', _x( 'Search', 'submit button', 'generatepress' ) ) ),
			generate_get_svg_icon( 'search' ) // phpcs:ignore -- Escaping not necessary here.
		);
	} else {
		printf(
			'<input type="submit" class="search-submit" value="%s">',
			apply_filters( 'generate_search_button', _x( 'Search', 'submit button', 'generatepress' ) ) // phpcs:ignore -- Escaping not necessary here.
		);
	}
	?>
</form>
