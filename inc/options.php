<?php
/*
 WARNING: This is a core Generate file. DO NOT edit
 this file under any circumstances. Please do all modifications
 in the form of a child theme.
 */

/**
 * Creates the options page.
 *
 * This file is a core Generate file and should not be edited.
 *
 * @package  GeneratePress
 * @author   Thomas Usborne
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     http://www.generatepress.com
 */
 
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'generate_create_menu' ) ) :
add_action('admin_menu', 'generate_create_menu');
function generate_create_menu() 
{
	$generate_page = add_theme_page( 'GeneratePress', 'GeneratePress', 'edit_theme_options', 'generate-options', 'generate_settings_page' );
	add_action( "admin_print_styles-$generate_page", 'generate_options_styles' );
}
endif;

if ( ! function_exists( 'generate_options_styles' ) ) :
function generate_options_styles() 
{
	wp_enqueue_style( 'generate-options', get_template_directory_uri() . '/inc/css/style.css', array(), GENERATE_VERSION );
}
endif;

if ( ! function_exists( 'generate_settings_page' ) ) :
function generate_settings_page() 
{
	?>
	<div class="wrap">
		<div class="metabox-holder">
			<div class="gp-masthead clearfix">
				<div class="gp-container">
					<div class="gp-title">
						<a href="<?php echo generate_get_premium_url( 'https://generatepress.com' );?>" target="_blank">GeneratePress</a> <span class="gp-version"><?php echo GENERATE_VERSION; ?></span>
					</div>
					<div class="gp-masthead-links">
						<?php if ( generate_addons_available() ) : ?>
							<a style="font-weight: bold;" href="<?php echo generate_get_premium_url( 'https://generatepress.com/premium/' );?>" target="_blank"><?php _e('Premium','generatepress');?></a> 
						<?php endif; ?>
						<a href="<?php echo esc_url( 'https://generatepress.com/support' ); ?>" target="_blank"><?php _e( 'Support','generatepress' ); ?></a>
						<a href="<?php echo esc_url( 'https://docs.generatepress.com' ); ?>" target="_blank"><?php _e('Documentation','generatepress');?></a>  
					</div>
				</div>
			</div>
			<div class="gp-container">
				<div class="postbox-container clearfix" style="float: none;">
					<div class="grid-container grid-parent">
							
						<div class="form-metabox grid-70" style="padding-left: 0;">
							<form method="post" action="options.php">
								<?php settings_fields( 'generate-settings-group' ); ?>
								<?php do_settings_sections( 'generate-settings-group' ); ?>
								<div class="customize-button hide-on-desktop">
									<?php
									printf( '<a id="generate_customize_button" class="button button-primary" href="%1$s">%2$s</a>',
										esc_url( add_query_arg( array(
											'return' => urlencode( wp_unslash( $_SERVER['REQUEST_URI'] ) ),
										), admin_url( 'customize.php' ) ) ),
										__( 'Customize', 'generatepress' )
									);
									?>
								</div>

								<?php do_action('generate_inside_options_form'); ?>
								<?php 
								// @todo
								// This block is marked for removal in 6 months
								// December 3, 2016
								if ( ! generate_no_addons() ) : ?>
									<div class="postbox generate-metabox" id="gen-license-keys">
										<div class="inside">
											<?php do_action('generate_license_key_items'); ?>
										</div>
									</div>
								<?php endif; ?>
								
							</form>
							
							<?php
							$modules = array(
								'Backgrounds' => array(
										'url' => generate_get_premium_url( 'https://generatepress.com/downloads/generate-backgrounds/' ),
								),
								'Blog' => array(
										'url' => generate_get_premium_url( 'https://generatepress.com/downloads/generate-blog/' ),
								),
								'Colors' => array(
										'url' => generate_get_premium_url( 'https://generatepress.com/downloads/generate-colors/' ),
								),
								'Copyright' => array(
										'url' => generate_get_premium_url( 'https://generatepress.com/downloads/generate-copyright/' ),
								),
								'Disable Elements' => array(
										'url' => generate_get_premium_url( 'https://generatepress.com/downloads/generate-disable-elements/' ),
								),
								'Hooks' => array(
										'url' => generate_get_premium_url( 'https://generatepress.com/downloads/generate-hooks/' ),
								),
								'Import / Export' => array(
										'url' => generate_get_premium_url( 'https://generatepress.com/downloads/generate-import-export/' ),
								),
								'Menu Plus' => array(
										'url' => generate_get_premium_url( 'https://generatepress.com/downloads/generate-menu-plus/' ),
								),
								'Page Header' => array(
										'url' => generate_get_premium_url( 'https://generatepress.com/downloads/generate-page-header/' ),
								),
								'Secondary Nav' => array(
										'url' => generate_get_premium_url( 'https://generatepress.com/downloads/generate-secondary-nav/' ),
								),
								'Sections' => array(
										'url' => generate_get_premium_url( 'https://generatepress.com/downloads/generate-sections/' ),
								),
								'Spacing' => array(
										'url' => generate_get_premium_url( 'https://generatepress.com/downloads/generate-spacing/' ),
								),
								'Typography' => array(
										'url' => generate_get_premium_url( 'https://generatepress.com/downloads/generate-typography/' ),
								)
							);
							
							if ( generate_addons_available() ) : ?>
							<div class="postbox generate-metabox">
								<h3 class="hndle"><?php _e( 'Add-ons','generatepress' ); ?></h3>
								<div class="inside" style="margin:0;padding:0;">
									<div class="premium-addons">
										<?php foreach( $modules as $module => $info ) { ?>
										<div class="add-on activated gp-clear addon-container grid-parent">
											<div class="addon-name column-addon-name" style="">
												<a href="<?php echo $info[ 'url' ]; ?>" target="_blank"><?php echo $module; ?></a>
											</div>
											<div class="addon-action addon-addon-action" style="text-align:right;">
												<a href="<?php echo $info[ 'url' ]; ?>" target="_blank"><?php _e( 'Learn more','generatepress' ); ?></a>
											</div>
										</div>
										<div class="gp-clear"></div>
										<?php } ?>		
									</div>
								</div>
							</div>
							<?php endif; ?>
							
							<?php do_action('generate_options_items'); ?>
						</div>
							
						<div class="generate-right-sidebar grid-30" style="padding-right: 0;">
							<div class="customize-button hide-on-mobile">
								<?php
								printf( '<a id="generate_customize_button" class="button button-primary" href="%1$s">%2$s</a>',
									esc_url( add_query_arg( array(
										'return' => urlencode( wp_unslash( $_SERVER['REQUEST_URI'] ) ),
									), admin_url( 'customize.php' ) ) ),
									__( 'Customize', 'generatepress' )
								);
								?>
							</div>
							<?php do_action( 'generate_admin_right_panel' ); ?>
							<?php if ( generate_addons_available() ) : ?>
								<div class="postbox generate-metabox popular-articles">
									<h3 class="hndle"><a href="https://docs.generatepress.com" target="_blank"><?php _e( 'View all','generatepress' ); ?></a><?php _e( 'Documentation','generatepress' ); ?></h3>
									<div class="inside">
										<ul>
											<li><a href="https://docs.generatepress.com/article/adding-header-logo/" target="_blank"><?php _e( 'Adding a Logo','generatepress' ); ?></a></li>
											<li><a href="https://docs.generatepress.com/article/sidebar-layout/" target="_blank"><?php _e( 'Sidebar Layout','generatepress' ); ?></a></li>
											<li><a href="https://docs.generatepress.com/article/container-width/" target="_blank"><?php _e( 'Container Width','generatepress' ); ?></a></li>
											<li><a href="https://docs.generatepress.com/article/navigation-location/" target="_blank"><?php _e( 'Navigation Location','generatepress' ); ?></a></li>
											<li><a href="https://docs.generatepress.com/article/footer-widgets/" target="_blank"><?php _e( 'Footer Widgets','generatepress' ); ?></a></li>
										</ul>
									</div>
								</div>
							<?php endif; ?>
							<div class="postbox generate-metabox" id="gen-delete">
								<h3 class="hndle"><?php _e('Delete Customizer Settings','generatepress');?></h3>
								<div class="inside">
									<p><?php printf( __( '<strong>Warning:</strong> Deleting your <a href="%1$s">Customizer</a> settings can not be undone.','generatepress' ), admin_url('customize.php') ); ?></p>
									<p><?php _e( 'Consider using our Import/Export add-on to export your settings before deleting them.','generatepress');?></p>
									<form method="post">
										<p><input type="hidden" name="generate_reset_customizer" value="generate_reset_customizer_settings" /></p>
										<p>
											<?php 
											$warning = 'return confirm("' . __( 'Warning: This will delete your settings.','generatepress' ) . '")';
											wp_nonce_field( 'generate_reset_customizer_nonce', 'generate_reset_customizer_nonce' );
											submit_button( __( 'Delete Default Customizer Settings', 'generatepress' ), 'button', 'submit', false, array( 'onclick' => $warning ) ); 
											?>
										</p>
											
									</form>
									<?php do_action('generate_delete_settings_form');?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="gp-options-footer">
					<span><?php printf( _x( 'Made with %s by Tom Usborne', 'made with love', 'generatepress' ), '<span style="color:#D04848" class="dashicons dashicons-heart"></span>' ); ?></span>
				</div>
			</div>
		</div>
	</div>
<?php }
endif;

if ( ! function_exists( 'generate_reset_customizer_settings' ) ) :
/**
 * Reset customizer settings
 */
add_action( 'admin_init', 'generate_reset_customizer_settings' );
function generate_reset_customizer_settings() {

	if( empty( $_POST['generate_reset_customizer'] ) || 'generate_reset_customizer_settings' !== $_POST['generate_reset_customizer'] )
		return;

	if( ! wp_verify_nonce( sanitize_key( $_POST['generate_reset_customizer_nonce'] ), 'generate_reset_customizer_nonce' ) )
		return;

	if( ! current_user_can( 'manage_options' ) )
		return;

	delete_option('generate_settings');
	
	wp_safe_redirect( admin_url( 'themes.php?page=generate-options&status=reset' ) ); exit;

}
endif;

if ( ! function_exists( 'generate_admin_errors' ) ) :
/**
 * Add our admin notices
 */
add_action( 'admin_notices', 'generate_admin_errors' );
function generate_admin_errors() 
{
	$screen = get_current_screen();
	if ( 'appearance_page_generate-options' !== $screen->base )
		return;
		
	if ( isset( $_GET['settings-updated'] ) && 'true' == $_GET['settings-updated'] ) {
		 add_settings_error( 'generate-notices', 'true', __( 'Settings saved.', 'generatepress' ), 'updated' );
	}
	
	if ( isset( $_GET['status'] ) && 'imported' == $_GET['status'] ) {
		 add_settings_error( 'generate-notices', 'imported', __( 'Import successful.', 'generatepress' ), 'updated' );
	}
	
	if ( isset( $_GET['status'] ) && 'reset' == $_GET['status'] ) {
		 add_settings_error( 'generate-notices', 'reset', __( 'Settings removed.', 'generatepress' ), 'updated' );
	}

	settings_errors( 'generate-notices' );
}
endif;