<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package GeneratePress
 */
 
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;
?>

	</div><!-- #content -->
</div><!-- #page -->
<?php do_action('generate_before_footer'); ?>
<div <?php generate_footer_class(); ?>>
	<?php 
	do_action('generate_before_footer_content');
	
	?>
	<footer class="site-info" itemtype="http://schema.org/WPFooter" itemscope="itemscope">
		<div class="inside-site-info <?php if ( 'full-width' !== generate_get_setting( 'footer_inner_width' ) ) : ?>grid-container grid-parent<?php endif; ?>">
			<?php do_action( 'generate_before_copyright' ); ?>
			<div class="copyright-bar">
				<?php do_action( 'generate_credits' ); ?>
			</div>
		</div>
	</footer><!-- .site-info -->
	<?php do_action( 'generate_after_footer_content' ); ?>
</div><!-- .site-footer -->

<?php wp_footer(); ?>

</body>
</html>