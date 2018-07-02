<?php
/**
 * Builds our admin page.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'generate_create_menu' ) ) {
	add_action( 'admin_menu', 'generate_create_menu' );
	/**
	 * Adds our "GeneratePress" dashboard menu item
	 *
	 * @since 0.1
	 */
	function generate_create_menu() {
		$generate_page = add_theme_page( 'GeneratePress', 'GeneratePress', apply_filters( 'generate_dashboard_page_capability', 'edit_theme_options' ), 'generate-options', 'generate_settings_page' );
		add_action( "admin_print_styles-$generate_page", 'generate_options_styles' );
	}
}

if ( ! function_exists( 'generate_options_styles' ) ) {
	/**
	 * Adds any necessary scripts to the GP dashboard page
	 *
	 * @since 0.1
	 */
	function generate_options_styles() {
		wp_enqueue_style( 'generate-options', get_template_directory_uri() . '/css/admin/style.css', array(), GENERATE_VERSION );
	}
}

if ( ! function_exists( 'generate_settings_page' ) ) {
	/**
	 * Builds the content of our GP dashboard page
	 *
	 * @since 0.1
	 */
	function generate_settings_page() {
		?>
		<div class="wrap">
			<div class="metabox-holder">
				<div class="gp-masthead clearfix">
					<div class="gp-container">
						<div class="gp-title">
							<a href="<?php echo generate_get_premium_url( 'https://generatepress.com' ); // WPCS: XSS ok, sanitization ok. ?>" target="_blank">GeneratePress</a> <span class="gp-version"><?php echo GENERATE_VERSION; // WPCS: XSS ok ?></span>
						</div>
						<div class="gp-masthead-links">
							<?php if ( ! defined( 'GP_PREMIUM_VERSION' ) ) : ?>
								<a style="font-weight: bold;" href="<?php echo generate_get_premium_url( 'https://generatepress.com/premium/' ); // WPCS: XSS ok, sanitization ok. ?>" target="_blank"><?php esc_html_e( 'Premium', 'generatepress' );?></a>
							<?php endif; ?>
							<a href="<?php echo esc_url( 'https://generatepress.com/support' ); ?>" target="_blank"><?php esc_html_e( 'Support', 'generatepress' ); ?></a>
							<a href="<?php echo esc_url( 'https://docs.generatepress.com' ); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'generatepress' );?></a>
						</div>
					</div>
				</div>

				<?php
				/**
				 * generate_dashboard_after_header hook.
				 *
				 * @since 2.0
				 */
				do_action( 'generate_dashboard_after_header' );
				?>

				<div class="gp-container">
					<div class="postbox-container clearfix" style="float: none;">
						<div class="grid-container grid-parent">

							<?php
							/**
							 * generate_dashboard_inside_container hook.
							 *
							 * @since 2.0
							 */
							do_action( 'generate_dashboard_inside_container' );
							?>

							<div class="form-metabox grid-70" style="padding-left: 0;">
								<h2 style="height:0;margin:0;"><!-- admin notices below this element --></h2>
								<form method="post" action="options.php">
									<?php settings_fields( 'generate-settings-group' ); ?>
									<?php do_settings_sections( 'generate-settings-group' ); ?>
									<div class="customize-button hide-on-desktop">
										<?php
										printf( '<a id="generate_customize_button" class="button button-primary" href="%1$s">%2$s</a>',
											esc_url( admin_url( 'customize.php' ) ),
											esc_html__( 'Customize', 'generatepress' )
										);
										?>
									</div>

									<?php
									/**
									 * generate_inside_options_form hook.
									 *
									 * @since 0.1
									 */
									do_action( 'generate_inside_options_form' );
									?>
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
									),
								);

								if ( ! defined( 'GP_PREMIUM_VERSION' ) ) : ?>
									<div class="postbox generate-metabox">
										<h3 class="hndle"><?php esc_html_e( 'Premium Modules', 'generatepress' ); ?></h3>
										<div class="inside" style="margin:0;padding:0;">
											<div class="premium-addons">
												<?php foreach( $modules as $module => $info ) { ?>
												<div class="add-on activated gp-clear addon-container grid-parent">
													<div class="addon-name column-addon-name" style="">
														<a href="<?php echo esc_url( $info['url'] ); ?>" target="_blank"><?php echo esc_html( $module ); ?></a>
													</div>
													<div class="addon-action addon-addon-action" style="text-align:right;">
														<a href="<?php echo esc_url( $info['url'] ); ?>" target="_blank"><?php esc_html_e( 'Learn more', 'generatepress' ); ?></a>
													</div>
												</div>
												<div class="gp-clear"></div>
												<?php } ?>
											</div>
										</div>
									</div>
								<?php
								endif;

								/**
								 * generate_options_items hook.
								 *
								 * @since 0.1
								 */
								do_action( 'generate_options_items' );
								?>
							</div>

							<div class="generate-right-sidebar grid-30" style="padding-right: 0;">
								<div class="customize-button hide-on-mobile">
									<?php
									printf( '<a id="generate_customize_button" class="button button-primary" href="%1$s">%2$s</a>',
										esc_url( admin_url( 'customize.php' ) ),
										esc_html__( 'Customize', 'generatepress' )
									);
									?>
								</div>

								<?php
								/**
								 * generate_admin_right_panel hook.
								 *
								 * @since 0.1
								 */
								do_action( 'generate_admin_right_panel' );

								if ( ! defined( 'GP_PREMIUM_VERSION' ) ) : ?>
									<div class="postbox generate-metabox popular-articles">
										<h3 class="hndle"><a href="https://docs.generatepress.com" target="_blank"><?php esc_html_e( 'View all', 'generatepress' ); ?></a><?php esc_html_e( 'Documentation', 'generatepress' ); ?></h3>
										<div class="inside">
											<ul>
												<li><a href="https://docs.generatepress.com/article/adding-header-logo/" target="_blank"><?php esc_html_e( 'Adding a Logo', 'generatepress' ); ?></a></li>
												<li><a href="https://docs.generatepress.com/article/sidebar-layout/" target="_blank"><?php esc_html_e( 'Sidebar Layout', 'generatepress' ); ?></a></li>
												<li><a href="https://docs.generatepress.com/article/container-width/" target="_blank"><?php esc_html_e( 'Container Width', 'generatepress' ); ?></a></li>
												<li><a href="https://docs.generatepress.com/article/navigation-location/" target="_blank"><?php esc_html_e( 'Navigation Location', 'generatepress' ); ?></a></li>
												<li><a href="https://docs.generatepress.com/article/footer-widgets/" target="_blank"><?php esc_html_e( 'Footer Widgets', 'generatepress' ); ?></a></li>
											</ul>
										</div>
									</div>
								<?php endif; ?>

								<div class="postbox generate-metabox" id="gen-delete">
									<h3 class="hndle"><?php esc_html_e( 'Delete Customizer Settings', 'generatepress' );?></h3>
									<div class="inside">
										<p><?php esc_html_e( 'Deleting your settings can not be undone.', 'generatepress' ); ?></p>
										<form method="post">
											<p><input type="hidden" name="generate_reset_customizer" value="generate_reset_customizer_settings" /></p>
											<p>
												<?php
												$warning = 'return confirm("' . esc_html__( 'Warning: This will delete your settings.', 'generatepress' ) . '")';
												wp_nonce_field( 'generate_reset_customizer_nonce', 'generate_reset_customizer_nonce' );
												submit_button( esc_attr__( 'Delete Default Settings', 'generatepress' ), 'button', 'submit', false,
													array(
														'onclick' => esc_js( $warning )
													)
												);
												?>
											</p>

										</form>
										<?php
										/**
										 * generate_delete_settings_form hook.
										 *
										 * @since 0.1
										 */
										do_action( 'generate_delete_settings_form' );
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="gp-options-footer">
						<span>
							<?php
							printf( // WPCS: XSS ok
								/* translators: %s: Heart icon */
								_x( 'Made with %s by Tom Usborne', 'made with love', 'generatepress' ),
								'<span style="color:#D04848" class="dashicons dashicons-heart"></span>'
							);
							?>
						</span>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'generate_reset_customizer_settings' ) ) {
	add_action( 'admin_init', 'generate_reset_customizer_settings' );
	/**
	 * Reset customizer settings
	 *
	 * @since 0.1
	 */
	function generate_reset_customizer_settings() {
		if ( empty( $_POST['generate_reset_customizer'] ) || 'generate_reset_customizer_settings' !== $_POST['generate_reset_customizer'] ) {
			return;
		}

		$nonce = isset( $_POST['generate_reset_customizer_nonce'] ) ? sanitize_key( $_POST['generate_reset_customizer_nonce'] ) : '';

		if ( ! wp_verify_nonce( $nonce, 'generate_reset_customizer_nonce' ) ) {
			return;
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		delete_option( 'generate_settings' );
		delete_option( 'generate_dynamic_css_output' );
		delete_option( 'generate_dynamic_css_cached_version' );
		remove_theme_mod( 'font_body_variants' );
		remove_theme_mod( 'font_body_category' );

		wp_safe_redirect( admin_url( 'themes.php?page=generate-options&status=reset' ) );
		exit;
	}
}

if ( ! function_exists( 'generate_admin_errors' ) ) {
	add_action( 'admin_notices', 'generate_admin_errors' );
	/**
	 * Add our admin notices
	 *
	 * @since 0.1
	 */
	function generate_admin_errors() {
		$screen = get_current_screen();

		if ( 'appearance_page_generate-options' !== $screen->base ) {
			return;
		}

		if ( isset( $_GET['settings-updated'] ) && 'true' == $_GET['settings-updated'] ) {
			 add_settings_error( 'generate-notices', 'true', esc_html__( 'Settings saved.', 'generatepress' ), 'updated' );
		}

		if ( isset( $_GET['status'] ) && 'imported' == $_GET['status'] ) {
			 add_settings_error( 'generate-notices', 'imported', esc_html__( 'Import successful.', 'generatepress' ), 'updated' );
		}

		if ( isset( $_GET['status'] ) && 'reset' == $_GET['status'] ) {
			 add_settings_error( 'generate-notices', 'reset', esc_html__( 'Settings removed.', 'generatepress' ), 'updated' );
		}

		settings_errors( 'generate-notices' );
	}
}
