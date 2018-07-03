<?php
/**
 * Footer elements.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'generate_construct_footer' ) ) {
	add_action( 'generate_footer', 'generate_construct_footer' );
	/**
	 * Build our footer.
	 *
	 * @since 1.3.42
	 */
	function generate_construct_footer() {
		?>
		<footer class="site-info" itemtype="https://schema.org/WPFooter" itemscope="itemscope">
			<div class="inside-site-info <?php if ( 'full-width' !== generate_get_setting( 'footer_inner_width' ) ) : ?>grid-container grid-parent<?php endif; ?>">
				<?php
				/**
				 * generate_before_copyright hook.
				 *
				 * @since 0.1
				 *
				 * @hooked generate_footer_bar - 15
				 */
				do_action( 'generate_before_copyright' );
				?>
				<div class="copyright-bar">
					<?php
					/**
					 * generate_credits hook.
					 *
					 * @since 0.1
					 *
					 * @hooked generate_add_footer_info - 10
					 */
					do_action( 'generate_credits' );
					?>
				</div>
			</div>
		</footer><!-- .site-info -->
		<?php
	}
}

if ( ! function_exists( 'generate_footer_bar' ) ) {
	add_action( 'generate_before_copyright', 'generate_footer_bar', 15 );
	/**
	 * Build our footer bar
	 *
	 * @since 1.3.42
	 */
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
}

if ( ! function_exists( 'generate_add_footer_info' ) ) {
	add_action( 'generate_credits', 'generate_add_footer_info' );
	/**
	 * Add the copyright to the footer
	 *
	 * @since 0.1
	 */
	function generate_add_footer_info() {
		$copyright = sprintf( '<span class="copyright">&copy; %1$s %2$s</span> &bull; %4$s <a href="%3$s" itemprop="url">%5$s</a>',
			date( 'Y' ),
			get_bloginfo( 'name' ),
			esc_url( 'https://generatepress.com' ),
			_x( 'Powered by', 'GeneratePress', 'generatepress' ),
			__( 'GeneratePress', 'generatepress' )
		);

		echo apply_filters( 'generate_copyright', $copyright ); // WPCS: XSS ok.
	}
}

/**
 * Build our individual footer widgets.
 * Displays a sample widget if no widget is found in the area.
 *
 * @since 2.0
 *
 * @param int $widget_width The width class of our widget.
 * @param int $widget The ID of our widget.
 */
function generate_do_footer_widget( $widget_width, $widget ) {
	$widget_width = apply_filters( "generate_footer_widget_{$widget}_width", $widget_width );
	$tablet_widget_width = apply_filters( "generate_footer_widget_{$widget}_tablet_width", '50' );
	?>
	<div class="footer-widget-<?php echo absint( $widget ); ?> grid-parent grid-<?php echo absint( $widget_width ); ?> tablet-grid-<?php echo absint( $tablet_widget_width ); ?> mobile-grid-100">
		<?php if ( ! dynamic_sidebar( 'footer-' . absint( $widget ) ) ) : ?>
			<aside class="widget inner-padding widget_text">
				<h4 class="widget-title"><?php esc_html_e( 'Footer Widget', 'generatepress' );?></h4>
				<div class="textwidget">
					<p>
						<?php
						printf( // WPCS: XSS ok.
							/* translators: 1: admin URL */
							__( 'Replace this widget content by going to <a href="%1$s"><strong>Appearance / Widgets</strong></a> and dragging widgets into this widget area.', 'generatepress' ),
							esc_url( admin_url( 'widgets.php' ) )
						);
						?>
					</p>
					<p>
						<?php
						printf( // WPCS: XSS ok.
							/* translators: 1: admin URL */
							__( 'To remove or choose the number of footer widgets, go to <a href="%1$s"><strong>Appearance / Customize / Layout / Footer Widgets</strong></a>.', 'generatepress' ),
							esc_url( admin_url( 'customize.php' ) )
						);
						?>
					</p>
				</div>
			</aside>
		<?php endif; ?>
	</div>
	<?php
}

if ( ! function_exists( 'generate_construct_footer_widgets' ) ) {
	add_action( 'generate_footer', 'generate_construct_footer_widgets', 5 );
	/**
	 * Build our footer widgets.
	 *
	 * @since 1.3.42
	 */
	function generate_construct_footer_widgets() {
		// Get how many widgets to show.
		$widgets = generate_get_footer_widgets();

		if ( ! empty( $widgets ) && 0 !== $widgets ) :

			// Set up the widget width.
			$widget_width = '';
			if ( $widgets == 1 ) {
				$widget_width = '100';
			}

			if ( $widgets == 2 ) {
				$widget_width = '50';
			}

			if ( $widgets == 3 ) {
				$widget_width = '33';
			}

			if ( $widgets == 4 ) {
				$widget_width = '25';
			}

			if ( $widgets == 5 ) {
				$widget_width = '20';
			}
			?>
			<div id="footer-widgets" class="site footer-widgets">
				<div <?php generate_inside_footer_class(); ?>>
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
		endif;

		/**
		 * generate_after_footer_widgets hook.
		 *
		 * @since 0.1
		 */
		do_action( 'generate_after_footer_widgets' );
	}
}

if ( ! function_exists( 'generate_back_to_top' ) ) {
	add_action( 'generate_after_footer', 'generate_back_to_top' );
	/**
	 * Build the back to top button
	 *
	 * @since 1.3.24
	 */
	function generate_back_to_top() {
		$generate_settings = wp_parse_args(
			get_option( 'generate_settings', array() ),
			generate_get_defaults()
		);

		if ( 'enable' !== $generate_settings['back_to_top'] ) {
			return;
		}

		echo apply_filters( 'generate_back_to_top_output', sprintf( // WPCS: XSS ok.
			'<a title="%1$s" rel="nofollow" href="#" class="generate-back-to-top" style="opacity:0;visibility:hidden;" data-scroll-speed="%2$s" data-start-scroll="%3$s">
				<span class="screen-reader-text">%5$s</span>
			</a>',
			esc_attr__( 'Scroll back to top', 'generatepress' ),
			absint( apply_filters( 'generate_back_to_top_scroll_speed', 400 ) ),
			absint( apply_filters( 'generate_back_to_top_start_scroll', 300 ) ),
			esc_attr( apply_filters( 'generate_back_to_top_icon', 'fa-angle-up' ) ),
			esc_html__( 'Scroll back to top', 'generatepress' )
		) );
	}
}
