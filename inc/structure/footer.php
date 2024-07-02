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
		<footer <?php generate_do_attr( 'site-info' ); ?>>
			<div <?php generate_do_attr( 'inside-site-info' ); ?>>
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
		</footer>
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
		$copyright = sprintf(
			'<span class="copyright">&copy; %1$s %2$s</span> &bull; %4$s <a href="%3$s"%6$s>%5$s</a>',
			date( 'Y' ), // phpcs:ignore
			get_bloginfo( 'name' ),
			esc_url( 'https://generatepress.com' ),
			_x( 'Built with', 'GeneratePress', 'generatepress' ),
			__( 'GeneratePress', 'generatepress' ),
			'microdata' === generate_get_schema_type() ? ' itemprop="url"' : ''
		);

		echo apply_filters( 'generate_copyright', $copyright ); // phpcs:ignore
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
	$widget_classes = sprintf(
		'footer-widget-%s',
		absint( $widget )
	);

	if ( ! generate_is_using_flexbox() ) {
		$widget_width = apply_filters( "generate_footer_widget_{$widget}_width", $widget_width );
		$tablet_widget_width = apply_filters( "generate_footer_widget_{$widget}_tablet_width", '50' );

		$widget_classes = sprintf(
			'footer-widget-%1$s grid-parent grid-%2$s tablet-grid-%3$s mobile-grid-100',
			absint( $widget ),
			absint( $widget_width ),
			absint( $tablet_widget_width )
		);
	}
	?>
	<div class="<?php echo $widget_classes; // phpcs:ignore ?>">
		<?php dynamic_sidebar( 'footer-' . absint( $widget ) ); ?>
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

			// If no footer widgets exist, we don't need to continue.
			if ( ! is_active_sidebar( 'footer-1' ) && ! is_active_sidebar( 'footer-2' ) && ! is_active_sidebar( 'footer-3' ) && ! is_active_sidebar( 'footer-4' ) && ! is_active_sidebar( 'footer-5' ) ) {
				return;
			}

			// Set up the widget width.
			$widget_width = '';

			if ( 1 === (int) $widgets ) {
				$widget_width = '100';
			}

			if ( 2 === (int) $widgets ) {
				$widget_width = '50';
			}

			if ( 3 === (int) $widgets ) {
				$widget_width = '33';
			}

			if ( 4 === (int) $widgets ) {
				$widget_width = '25';
			}

			if ( 5 === (int) $widgets ) {
				$widget_width = '20';
			}
			?>
			<div id="footer-widgets" class="site footer-widgets">
				<div <?php generate_do_attr( 'footer-widgets-container' ); ?>>
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

		echo apply_filters( // phpcs:ignore
			'generate_back_to_top_output',
			sprintf(
				'<a title="%1$s" aria-label="%1$s" rel="nofollow" href="#" class="generate-back-to-top" data-scroll-speed="%2$s" data-start-scroll="%3$s" role="button">
					%5$s
				</a>',
				esc_attr__( 'Scroll back to top', 'generatepress' ),
				absint( apply_filters( 'generate_back_to_top_scroll_speed', 400 ) ),
				absint( apply_filters( 'generate_back_to_top_start_scroll', 300 ) ),
				esc_attr( apply_filters( 'generate_back_to_top_icon', 'fa-angle-up' ) ),
				generate_get_svg_icon( 'arrow-up' )
			)
		);
	}
}
