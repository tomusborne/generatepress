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
	
	// Get how many widgets to show
	$widgets = generate_get_footer_widgets();
	
	if ( !empty( $widgets ) && 0 !== $widgets ) : 
	
		// Set up the widget width
		$widget_width = '';
		if ( $widgets == 1 ) $widget_width = '100';
		if ( $widgets == 2 ) $widget_width = '50';
		if ( $widgets == 3 ) $widget_width = '33';
		if ( $widgets == 4 ) $widget_width = '25';
		if ( $widgets == 5 ) $widget_width = '20';
		?>
		<div id="footer-widgets" class="site footer-widgets">
			<div <?php generate_inside_footer_class(); ?>>
				<?php if ( $widgets >= 1 ) : ?>
					<div class="footer-widget-1 grid-parent grid-<?php echo apply_filters( 'generate_footer_widget_1_width', $widget_width ); ?> tablet-grid-<?php echo apply_filters( 'generate_footer_widget_1_tablet_width', '50' ); ?> mobile-grid-100">
						<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-1')): ?>
							<aside class="widget inner-padding widget_text">
								<h4 class="widget-title"><?php _e('Footer Widget 1','generatepress');?></h4>			
								<div class="textwidget">
									<p><?php printf( __( 'Replace this widget content by going to <a href="%1$s"><strong>Appearance / Widgets</strong></a> and dragging widgets into this widget area.','generatepress' ), admin_url( 'widgets.php' ) ); ?></p>
									<p><?php printf( __( 'To remove or choose the number of footer widgets, go to <a href="%1$s"><strong>Appearance / Customize / Layout / Footer Widgets</strong></a>.','generatepress' ), admin_url( 'customize.php' ) ); ?></p>
								</div>
							</aside>
						<?php endif; ?>
					</div>
				<?php endif;
				
				if ( $widgets >= 2 ) : ?>
				<div class="footer-widget-2 grid-parent grid-<?php echo apply_filters( 'generate_footer_widget_2_width', $widget_width ); ?> tablet-grid-<?php echo apply_filters( 'generate_footer_widget_2_tablet_width', '50' ); ?> mobile-grid-100">
					<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-2')): ?>
						<aside class="widget inner-padding widget_text">
							<h4 class="widget-title"><?php _e('Footer Widget 2','generatepress');?></h4>			
							<div class="textwidget">
								<p><?php printf( __( 'Replace this widget content by going to <a href="%1$s"><strong>Appearance / Widgets</strong></a> and dragging widgets into this widget area.','generatepress' ), admin_url( 'widgets.php' ) ); ?></p>
								<p><?php printf( __( 'To remove or choose the number of footer widgets, go to <a href="%1$s"><strong>Appearance / Customize / Layout / Footer Widgets</strong></a>.','generatepress' ), admin_url( 'customize.php' ) ); ?></p>
							</div>
						</aside>
					<?php endif; ?>
				</div>
				<?php endif;
				
				if ( $widgets >= 3 ) : ?>
				<div class="footer-widget-3 grid-parent grid-<?php echo apply_filters( 'generate_footer_widget_3_width', $widget_width ); ?> tablet-grid-<?php echo apply_filters( 'generate_footer_widget_3_tablet_width', '50' ); ?> mobile-grid-100">
					<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-3')): ?>
						<aside class="widget inner-padding widget_text">
							<h4 class="widget-title"><?php _e('Footer Widget 3','generatepress');?></h4>			
							<div class="textwidget">
								<p><?php printf( __( 'Replace this widget content by going to <a href="%1$s"><strong>Appearance / Widgets</strong></a> and dragging widgets into this widget area.','generatepress' ), admin_url( 'widgets.php' ) ); ?></p>
								<p><?php printf( __( 'To remove or choose the number of footer widgets, go to <a href="%1$s"><strong>Appearance / Customize / Layout / Footer Widgets</strong></a>.','generatepress' ), admin_url( 'customize.php' ) ); ?></p>
							</div>
						</aside>
					<?php endif; ?>
				</div>
				<?php endif;
				
				if ( $widgets >= 4 ) : ?>
				<div class="footer-widget-4 grid-parent grid-<?php echo apply_filters( 'generate_footer_widget_4_width', $widget_width ); ?> tablet-grid-<?php echo apply_filters( 'generate_footer_widget_4_tablet_width', '50' ); ?> mobile-grid-100">
					<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-4')): ?>
						<aside class="widget inner-padding widget_text">
							<h4 class="widget-title"><?php _e('Footer Widget 4','generatepress');?></h4>			
							<div class="textwidget">
								<p><?php printf( __( 'Replace this widget content by going to <a href="%1$s"><strong>Appearance / Widgets</strong></a> and dragging widgets into this widget area.','generatepress' ), admin_url( 'widgets.php' ) ); ?></p>
								<p><?php printf( __( 'To remove or choose the number of footer widgets, go to <a href="%1$s"><strong>Appearance / Customize / Layout / Footer Widgets</strong></a>.','generatepress' ), admin_url( 'customize.php' ) ); ?></p>
							</div>
						</aside>
					<?php endif; ?>
				</div>
				<?php endif;
				
				if ( $widgets >= 5 ) : ?>
				<div class="footer-widget-5 grid-parent grid-<?php echo apply_filters( 'generate_footer_widget_5_width', $widget_width ); ?> tablet-grid-<?php echo apply_filters( 'generate_footer_widget_5_tablet_width', '50' ); ?> mobile-grid-100">
					<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-5')): ?>
						<aside class="widget inner-padding widget_text">
							<h4 class="widget-title"><?php _e('Footer Widget 5','generatepress');?></h4>			
							<div class="textwidget">
								<p><?php printf( __( 'Replace this widget content by going to <a href="%1$s"><strong>Appearance / Widgets</strong></a> and dragging widgets into this widget area.','generatepress' ), admin_url( 'widgets.php' ) ); ?></p>
								<p><?php printf( __( 'To remove or choose the number of footer widgets, go to <a href="%1$s"><strong>Appearance / Customize / Layout / Footer Widgets</strong></a>.','generatepress' ), admin_url( 'customize.php' ) ); ?></p>
							</div>
						</aside>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	<?php
	endif;
	do_action('generate_after_footer_widgets');
	?>
	<footer class="site-info" itemtype="http://schema.org/WPFooter" itemscope="itemscope">
		<div class="inside-site-info <?php if ( 'full-width' !== generate_get_setting( 'footer_inner_width' ) ) : ?>grid-container grid-parent<?php endif; ?>">
			<?php do_action( 'generate_credits' ); ?>
		</div>
	</footer><!-- .site-info -->
	<?php do_action( 'generate_after_footer_content' ); ?>
</div><!-- .site-footer -->

<?php wp_footer(); ?>

</body>
</html>