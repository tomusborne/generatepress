<?php
/**
 * The template for displaying the footer.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

	</div>
</div>

<?php
/**
 * generate_before_footer hook.
 *
 * @since 0.1
 */
do_action( 'generate_before_footer' );
?>

<div <?php generate_do_element_classes( 'footer' ); ?>>
	<?php
	/**
	 * generate_before_footer_content hook.
	 *
	 * @since 0.1
	 */
	do_action( 'generate_before_footer_content' );

	/**
	 * generate_footer hook.
	 *
	 * @since 1.3.42
	 *
	 * @hooked generate_construct_footer_widgets - 5
	 * @hooked generate_construct_footer - 10
	 */
	do_action( 'generate_footer' );

	/**
	 * generate_after_footer_content hook.
	 *
	 * @since 0.1
	 */
	do_action( 'generate_after_footer_content' );
	?>
</div>

<?php
/**
 * generate_after_footer hook.
 *
 * @since 2.1
 */
do_action( 'generate_after_footer' );

wp_footer();
?>

</body>
</html>
