<?php
/**
 * All of our footer elements.
 * These functions are wrapped in function_exists() so you can overwrite them.
 * 
 * @package GeneratePress
 */ 
 
defined( 'WPINC' ) or die;

if ( ! function_exists( 'generate_construct_footer' ) ) :
/**
 * Build our footer
 * @since 1.3.42
 */
add_action( 'generate_footer','generate_construct_footer' );
function generate_construct_footer() {
	?>
	<footer <?php generate_do_attr( 'footer-bar' ); ?>>
		<div class="inside-site-info <?php if ( 'full-width' !== generate_get_option( 'footer_inner_width' ) ) : ?>grid-container grid-parent<?php endif; ?>">
			<?php do_action( 'generate_before_copyright' ); ?>
			<div class="copyright-bar">
				<?php do_action( 'generate_credits' ); ?>
			</div>
		</div>
	</footer><!-- .site-info -->
	<?php
}
endif;

if ( ! function_exists( 'generate_footer_bar' ) ) :
/**
 * Build our footer bar
 * @since 1.3.42
 */
add_action( 'generate_before_copyright','generate_footer_bar', 15 );
function generate_footer_bar() {
	
	if ( ! is_active_sidebar( 'footer-bar' ) ) {
		return;
	}
	
	?>
	<div class="footer-bar">
		<?php dynamic_sidebar( 'footer-bar' ); ?>
	</div>
	<?php
	
}
endif;

if ( ! function_exists( 'generate_add_footer_info' ) ) :
/** 
 * Add the copyright to the footer
 * @since 0.1
 */
add_action('generate_credits','generate_add_footer_info');
function generate_add_footer_info() {
	$copyright = sprintf( '<span class="copyright">&copy; %1$s</span> &bull; <a href="%2$s" target="_blank" itemprop="url">%3$s</a>',
		date( 'Y' ),
		esc_url( 'https://generatepress.com' ),
		__( 'GeneratePress','generatepress' )
	);
	
	echo apply_filters( 'generate_copyright', $copyright );
}
endif;

if ( ! function_exists( 'generate_do_footer_widget' ) ) :
/**
 * Build our individual footer widgets.
 * Displays a sample widget if no widget is found in the area.
 * @since 1.4
 */
function generate_do_footer_widget( $widget_width, $widget ) {
?>
	<div class="footer-widget-<?php echo $widget; ?> grid-parent grid-<?php echo absint( apply_filters( "generate_footer_widget_{$widget}_width", $widget_width ) ); ?> tablet-grid-<?php echo absint( apply_filters( "generate_footer_widget_{$widget}_tablet_width", '50' ) ); ?> mobile-grid-100">
		<?php if ( ! dynamic_sidebar( 'footer-' . $widget ) ): ?>
			<aside class="widget inner-padding widget_text">
				<h4 class="widget-title"><?php _e('Footer Widget','generatepress');?></h4>			
				<div class="textwidget">
					<p><?php printf( __( 'Replace this widget content by going to <a href="%1$s"><strong>Appearance / Widgets</strong></a> and dragging widgets into this widget area.','generatepress' ), esc_url( admin_url( 'widgets.php' ) ) ); ?></p>
					<p><?php printf( __( 'To remove or choose the number of footer widgets, go to <a href="%1$s"><strong>Appearance / Customize / Layout / Footer Widgets</strong></a>.','generatepress' ), esc_url( admin_url( 'customize.php' ) ) ); ?></p>
				</div>
			</aside>
		<?php endif; ?>
	</div>
<?php
}
endif;

if ( ! function_exists( 'generate_construct_footer_widgets' ) ) :
/**
 * Build our footer widgets
 * @since 1.3.42
 */
add_action( 'generate_footer','generate_construct_footer_widgets', 5 );
function generate_construct_footer_widgets() {
	$widgets = generate_get_footer_widget_count();
	
	if ( ! empty( $widgets ) && 0 !== $widgets ) {
		$widget_width = '';
		if ( $widgets == 1 ) $widget_width = '100';
		if ( $widgets == 2 ) $widget_width = '50';
		if ( $widgets == 3 ) $widget_width = '33';
		if ( $widgets == 4 ) $widget_width = '25';
		if ( $widgets == 5 ) $widget_width = '20';
		?>
		<div id="footer-widgets" class="site footer-widgets">
			<div <?php generate_do_attr( 'inside-footer' ); ?>>
				<div class="inside-footer-widgets">
					<?php 
					if ( $widgets >= 1 ) {
						generate_do_footer_widget( $widget_width, 1 );
					}
					
					if ( $widgets >= 2 ) {
						generate_do_footer_widget( $widget_width, 2 );
					}
					
					if ( $widgets >= 3 ) {
						generate_do_footer_widget( $widget_width, 3 );
					}
					
					if ( $widgets >= 4 ) {
						generate_do_footer_widget( $widget_width, 4 );
					}
					
					if ( $widgets >= 5 ) {
						generate_do_footer_widget( $widget_width, 5 );
					}
					?>
				</div>
			</div>
		</div>
	<?php
	}
	
	do_action( 'generate_after_footer_widgets' );
}
endif;

if ( ! function_exists( 'generate_back_to_top' ) ) :
/**
 * Build the back to top button
 *
 * @since 1.3.24
 */
add_action( 'wp_footer','generate_back_to_top' );
function generate_back_to_top() {
	if ( 'enable' !== generate_get_option( 'back_to_top' ) ) {
		return;
	}
	
	echo apply_filters( 'generate_back_to_top_output', sprintf(
		'<a title="%1$s" rel="nofollow" href="#" class="generate-back-to-top" style="opacity:0;visibility:hidden;" data-scroll-speed="%2$s" data-start-scroll="%3$s">
			<i class="fa %4$s" aria-hidden="true"></i>
			<span class="screen-reader-text">%5$s</span>
		</a>',
		esc_attr__( 'Scroll back to top','generatepress' ),
		absint( apply_filters( 'generate_back_to_top_scroll_speed', 400 ) ),
		absint( apply_filters( 'generate_back_to_top_start_scroll', 300 ) ),
		esc_attr( apply_filters( 'generate_back_to_top_icon','fa-angle-up' ) ),
		__( 'Scroll back to top','generatepress' )
	));
}
endif;