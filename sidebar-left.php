<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div <?php generate_do_attr( 'left-sidebar' ); ?>>
	<div class="inside-left-sidebar">
		<?php
		/**
		 * generate_before_left_sidebar_content hook.
		 *
		 * @since 0.1
		 */
		do_action( 'generate_before_left_sidebar_content' );

		if ( ! dynamic_sidebar( 'sidebar-2' ) ) {
			generate_do_default_sidebar_widgets( 'left-sidebar' );
		}

		/**
		 * generate_after_left_sidebar_content hook.
		 *
		 * @since 0.1
		 */
		do_action( 'generate_after_left_sidebar_content' );
		?>
	</div>
</div>
