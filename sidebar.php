<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// If the navigation is set in the sidebar, set variable to true.
$navigation_active = ( 'nav-right-sidebar' == generate_get_navigation_location() ) ? true : false;

// If the secondary navigation is set in the sidebar, set variable to true.
if ( function_exists( 'generate_secondary_nav_get_defaults' ) ) {
	$secondary_nav = wp_parse_args(
		get_option( 'generate_secondary_nav_settings', array() ),
		generate_secondary_nav_get_defaults()
	);

	if ( 'secondary-nav-right-sidebar' == $secondary_nav['secondary_nav_position_setting'] ) {
		$navigation_active = true;
	}
}
?>
<div id="right-sidebar" itemtype="https://schema.org/WPSideBar" itemscope="itemscope" <?php generate_right_sidebar_class(); ?>>
	<div class="inside-right-sidebar">
		<?php
		/**
		 * generate_before_right_sidebar_content hook.
		 *
		 * @since 0.1
		 */
		do_action( 'generate_before_right_sidebar_content' );

		if ( ! dynamic_sidebar( 'sidebar-1' ) ) :

			if ( false == $navigation_active ) : ?>

				<aside id="search" class="widget widget_search">
					<?php get_search_form(); ?>
				</aside>

				<aside id="archives" class="widget">
					<h2 class="widget-title"><?php esc_html_e( 'Archives', 'generatepress' ); ?></h2>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>

			<?php endif;

		endif;

		/**
		 * generate_after_right_sidebar_content hook.
		 *
		 * @since 0.1
		 */
		do_action( 'generate_after_right_sidebar_content' );
		?>
	</div><!-- .inside-right-sidebar -->
</div><!-- #secondary -->
