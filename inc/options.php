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

// create custom plugin settings menu
add_action('admin_menu', 'generate_create_menu');
function generate_create_menu() 
{
	
	$generate_page = add_theme_page( 'GeneratePress', 'GeneratePress', 'edit_theme_options', 'generate-options', 'generate_settings_page' );
	
	add_action( "admin_print_scripts-$generate_page", 'generate_options_scripts' );
	add_action( "admin_print_styles-$generate_page", 'generate_options_styles' );
}

function generate_options_scripts() 
{
	// Something will go here one day...
}

function generate_options_styles() 
{
     wp_enqueue_style( 
        'generate-options', 
        get_template_directory_uri() . '/inc/css/style.css'
    );
	
	wp_enqueue_style( 
		'generate-style-grid', 
		get_template_directory_uri() . '/css/unsemantic-grid.css', 
		false, 
		GENERATE_VERSION, 
		'all' 
	);
}

function generate_settings_page() 
{
	?>
	<div class="wrap">
		<div class="metabox-holder">
			<div class="postbox-container" style="float: none;max-width:1120px;">
				<div class="grid-container grid-parent">
						
					<div class="form-metabox grid-70" style="padding-left:0;">
						<form method="post" action="options.php">
							<?php settings_fields( 'generate-settings-group' ); ?>
							<?php do_settings_sections( 'generate-settings-group' ); ?>
							<div class="customize-button hide-on-desktop">
								<a id="generate_customize_button" class="button button-primary" href="<?php echo admin_url('customize.php'); ?>"><?php _e('Customize','generatepress');?></a>  
							</div>
							<div class="postbox generate-metabox" id="gen-1">
								<h3 class="hndle">GeneratePress <?php echo GENERATE_VERSION; ?></h3>
								<div class="inside">
									<p>
										<span><?php printf( _x( 'Made with %s by Tom Usborne', 'made with love', 'generatepress' ), '<span style="color:#D04848" class="dashicons dashicons-heart"></span>' ); ?></span>
									</p>		
									<p>
										<?php if ( generate_addons_available() ) : ?>
											<a id="generate_addon_button" class="button button-primary" href="<?php echo esc_url('https://generatepress.com/add-ons');?>" target="_blank"><?php _e('Add-ons','generatepress');?></a> 
										<?php endif; ?>
										<a class="button button-primary" href="<?php echo esc_url( 'https://generatepress.com/support' ); ?>" target="_blank"><?php _e('Support','generatepress');?></a>  
										<a class="button button-primary" href="<?php echo esc_url( 'https://generatepress.com/knowledgebase' ); ?>" target="_blank"><?php _e('Knowledgebase','generatepress');?></a>  
										<a title="<?php _e('Please help support the ongoing development of GeneratePress by buying me a coffee :)','generatepress');?>" class="button button-secondary" target="_blank" href="<?php echo esc_url('https://generatepress.com/ongoing-development');?>"><?php _e('Buy me a coffee :)','generatepress');?></a>
									</p>
								</div>
							</div>

							<?php do_action('generate_inside_options_form'); ?>
							<?php if ( ! generate_no_addons() ) : ?>
								<div class="postbox generate-metabox" id="gen-license-keys">
									<h3 class="hndle"><?php _e('Add-on Updates','generatepress');?></h3>
									<div class="inside">
										<?php do_action('generate_license_key_items'); ?>
									</div>
								</div>
							<?php endif; ?>
							
						</form>
										
						<?php do_action('generate_options_items'); ?>
							
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
						
					<div class="generate-right-sidebar grid-30" style="padding-right:0;">
						<div class="customize-button hide-on-mobile">
							<a id="generate_customize_button" class="button button-primary" href="<?php echo admin_url('customize.php'); ?>"><?php _e('Customize','generatepress');?></a>  
						</div>
						<?php if ( generate_addons_available() ) : ?>
							<div class="postbox generate-metabox addon-metabox" id="gen-2">
								<h3 class="hndle"><?php _e('Add-ons','generatepress');?></h3>
								<div class="inside">
									<p>
										<?php 
										$addons = array(
											'0' => array(
													'name' => 'Colors',
													'url' => esc_url('https://generatepress.com/downloads/generate-colors/'),
													'img' => get_template_directory_uri() . '/inc/add-ons/images/colors.png'
								
											),
											'10' => array(
													'name' => 'Sections',
													'url' => esc_url('https://generatepress.com/downloads/generate-sections/'),
													'img' => get_template_directory_uri() . '/inc/add-ons/images/sections.png'
								
											),
											'20' => array(
													'name' => 'Typography',
													'url' => esc_url('https://generatepress.com/downloads/generate-typography/'),
													'img' => get_template_directory_uri() . '/inc/add-ons/images/typography.png'
											 ),
											'30' => array(
													'name' => 'Menu Plus',
													'url' => esc_url('https://generatepress.com/downloads/generate-menu-plus/'),
													'img' => get_template_directory_uri() . '/inc/add-ons/images/menu-plus.png'
											 ),
											'40' => array(
													'name' => 'Page Header',
													'url' => esc_url('https://generatepress.com/downloads/generate-page-header/'),
													'img' => get_template_directory_uri() . '/inc/add-ons/images/page-header.png'
											),
											'50' => array(
													'name' => 'Import / Export',
													'url' => esc_url('https://generatepress.com/downloads/generate-import-export/'),
													'img' => get_template_directory_uri() . '/inc/add-ons/images/importexport.png'
											),
											'60' => array(
													'name' => 'Copyright',
													'url' => esc_url('https://generatepress.com/downloads/generate-copyright/'),
													'img' => get_template_directory_uri() . '/inc/add-ons/images/copyright.png'
											),
											'70' => array(
													'name' => 'Disable Elements',
													'url' => esc_url('https://generatepress.com/downloads/generate-disable-elements/'),
													'img' => get_template_directory_uri() . '/inc/add-ons/images/disable-items.png'
											),
											'80' => array(
													'name' => 'Blog',
													'url' => esc_url('https://generatepress.com/downloads/generate-blog/'),
													'img' => get_template_directory_uri() . '/inc/add-ons/images/blog.png'
											),
											'90' => array(
													'name' => 'Hooks',
													'url' => esc_url('https://generatepress.com/downloads/generate-hooks/'),
													'img' => get_template_directory_uri() . '/inc/add-ons/images/hooks.png'
											),
											'100' => array(
													'name' => 'Spacing',
													'url' => esc_url('https://generatepress.com/downloads/generate-spacing/'),
													'img' => get_template_directory_uri() . '/inc/add-ons/images/spacing.png'
											),
											'110' => array(
													'name' => 'Backgrounds',
													'url' => esc_url('https://generatepress.com/downloads/generate-backgrounds/'),
													'img' => get_template_directory_uri() . '/inc/add-ons/images/backgrounds.png'
											),
											'120' => array(
													'name' => 'Secondary Nav',
													'url' => esc_url('https://generatepress.com/downloads/generate-secondary-nav/'),
													'img' => get_template_directory_uri() . '/inc/add-ons/images/secondarynav.png'
											)
										);
											
										foreach ( $addons as $addon ) {
											echo '<a title="' . $addon['name'] . '" href="' . $addon['url'] . '" target="_blank"><img src="' . $addon['img'] . '" alt="' . $addon['name'] . '" /></a>';
										}
										?>		
									</p>
								</div>
							</div>
						<?php endif; ?>
						<?php do_action( 'generate_admin_right_panel' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php }

/**
 * Reset customizer settings
 */
add_action( 'admin_init', 'generate_reset_customizer_settings' );
function generate_reset_customizer_settings() {

	if( empty( $_POST['generate_reset_customizer'] ) || 'generate_reset_customizer_settings' !== $_POST['generate_reset_customizer'] )
		return;

	if( ! wp_verify_nonce( $_POST['generate_reset_customizer_nonce'], 'generate_reset_customizer_nonce' ) )
		return;

	if( ! current_user_can( 'manage_options' ) )
		return;

	delete_option('generate_settings');
	
	wp_safe_redirect( admin_url( 'themes.php?page=generate-options&status=reset' ) ); exit;

}

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