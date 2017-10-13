<?php
/**
 * The template for displaying the footer.
 *
 * @package GeneratePress
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

	</div><!-- #content -->
</div><!-- #page -->
<?php do_action( 'generate_before_footer' ); ?>
<div <?php generate_footer_class(); ?>>
	<?php
	do_action( 'generate_before_footer_content' );
	do_action( 'generate_footer' );
	do_action( 'generate_after_footer_content' );
	?>
</div><!-- .site-footer -->

<?php wp_footer(); ?>

</body>
</html>
