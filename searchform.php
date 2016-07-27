<?php
/**
 * The template for displaying search forms in Generate
 *
 * @package GeneratePress
 */
?>
<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php apply_filters( 'generate_search_label', _ex( 'Search for:', 'label', 'generatepress' ) ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo apply_filters( 'generate_search_placeholder', _x( 'Search &hellip;', 'placeholder', 'generatepress' ) ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php apply_filters( 'generate_search_label', _ex( 'Search for:', 'label', 'generatepress' ) ); ?>">
	</label>
	<input type="submit" class="search-submit" value="<?php echo apply_filters( 'generate_search_button', _x( 'Search', 'submit button', 'generatepress' ) ); ?>">
</form>