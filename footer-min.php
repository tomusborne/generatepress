<?php
/**
 * The template for displaying the footer.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * generate_after_footer hook.
 *
 * @since 2.1
 */
do_action( 'generate_minimal_footer' );

wp_footer();
?>

</body>
</html>
