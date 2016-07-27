<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package GeneratePress
 */
$generate_settings = wp_parse_args( 
	get_option( 'generate_settings', array() ), 
	generate_get_defaults() 
);

$navigation_active = false;

// If the navigation is set in the sidebar, set variable to true
if ( 'nav-right-sidebar' == $generate_settings['nav_position_setting'] )
	$navigation_active = true;

// If the secondary navigation is set in the sidebar, set variable to true
if ( function_exists( 'generate_secondary_nav_get_defaults' ) ) :
	$secondary_nav = wp_parse_args( 
		get_option( 'generate_secondary_nav_settings', array() ), 
		generate_secondary_nav_get_defaults() 
	);
	if ( 'secondary-nav-right-sidebar' == $secondary_nav['secondary_nav_position_setting'] )
		$navigation_active = true;
endif;
?>
	<div id="right-sidebar" itemtype="http://schema.org/WPSideBar" itemscope="itemscope" role="complementary" <?php generate_right_sidebar_class(); ?>>
		<div class="inside-right-sidebar">
			<?php do_action( 'generate_before_right_sidebar_content' ); ?>
			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
				<?php if ( false == $navigation_active ) : ?>
					<aside id="search" class="widget widget_search">
						<?php get_search_form(); ?>
					</aside>

					<aside id="archives" class="widget">
						<h4 class="widget-title"><?php _e( 'Archives', 'generatepress' ); ?></h4>
						<ul>
							<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
						</ul>
					</aside>
				<?php endif; ?>
			<?php endif; // end sidebar widget area ?>
			<?php do_action( 'generate_after_right_sidebar_content' ); ?>
		</div><!-- .inside-right-sidebar -->
	</div><!-- #secondary -->