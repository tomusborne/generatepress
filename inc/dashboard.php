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
		$generate_page = add_theme_page( esc_html__( 'GeneratePress', 'generatepress' ), esc_html__( 'GeneratePress', 'generatepress' ), apply_filters( 'generate_dashboard_page_capability', 'edit_theme_options' ), 'generate-options', 'generate_settings_page' );
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
		wp_enqueue_style( 'generate-options', get_template_directory_uri() . '/assets/css/admin/style.css', array(), GENERATE_VERSION );
	}
}

/**
 * Get a list of our Dashboard pages.
 *
 * @since 3.1.0
 */
function generate_get_dashboard_pages() {
	return apply_filters(
		'generate_dashboard_screens',
		array(
			'appearance_page_generate-options',
		)
	);
}

add_filter( 'admin_body_class', 'generate_set_admin_body_classes' );
/**
 * Add admin body classes when needed.
 *
 * @since 1.2.0
 * @param string $classes The existing classes.
 */
function generate_set_admin_body_classes( $classes ) {
	$dashboard_pages = generate_get_dashboard_pages();
	$current_screen = get_current_screen();

	if ( in_array( $current_screen->id, $dashboard_pages ) ) {
		$classes .= ' generate-dashboard-page';
	}

	return $classes;
}

/**
 * Build our Dashboard header.
 *
 * @since 3.1.0
 */
function generate_do_dashboard_header() {
	?>
	<div class="gpress-dashboard-header">
		<div class="gpress-dashboard-header-title">
			<h1>
				<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600"><path d="M485.2 427.8l-99.1-46.2 15.8-34c5.6-11.9 8.8-24.3 10-36.7 3.3-33.7-9-67.3-33.2-91.1-8.9-8.7-19.3-16.1-31.3-21.7-11.9-5.6-24.3-8.8-36.7-10-33.7-3.3-67.4 9-91.1 33.2-8.7 8.9-16.1 19.3-21.7 31.3l-15.8 34-30.4 65.2c-.7 1.5-.1 3.3 1.5 4l65.2 30.4 34 15.8 34 15.8 68 31.7 74.7 34.8c-65 45.4-152.1 55.2-228.7 17.4C90.2 447.4 44.1 313.3 97.3 202.6c53.3-110.8 186-158.5 297.8-106.3 88.1 41.1 137.1 131.9 129.1 223.4-.1 1.3.6 2.4 1.7 3l65.6 30.6c1.8.8 3.9-.3 4.2-2.2 22.6-130.7-44-265.4-170.5-323.5-150.3-69-327-4.1-396.9 145.8-70 150.1-5.1 328.5 145.1 398.5 114.1 53.2 244.5 28.4 331.3-52.3 17.9-16.6 33.9-35.6 47.5-56.8 1-1.5.4-3.6-1.3-4.3l-65.7-30.7zm-235-109.6l15.8-34c8.8-18.8 31.1-26.9 49.8-18.1s26.9 31 18.1 49.8l-15.8 34-34-15.8-33.9-15.9z" fill="currentColor" /></svg>
				<?php echo esc_html( get_admin_page_title() ); ?>
			</h1>
		</div>

		<?php generate_do_dashboard_navigation(); ?>
	</div>
	<?php
}

/**
 * Build our Dashboard menu.
 *
 * @since 3.1.0
 */
function generate_do_dashboard_navigation() {
	$screen = get_current_screen();

	$tabs = apply_filters(
		'generate_dashboard_tabs',
		array(
			'dashboard' => array(
				'name' => __( 'Dashboard', 'generate' ),
				'url' => admin_url( 'themes.php?page=generate-options' ),
				'class' => 'appearance_page_generate-options' === $screen->id ? 'active' : '',
			),
		)
	);

	if ( ! defined( 'GP_PREMIUM_VERSION' ) ) {
		$tabs['premium'] = array(
			'name' => __( 'Premium', 'generatepress' ),
			'url' => 'https://generatepress.com/premium',
			'class' => '',
			'external' => true,
		);
	}

	$tabs['support'] = array(
		'name' => __( 'Support', 'generatepress' ),
		'url' => 'https://generatepress.com/support',
		'class' => '',
		'external' => true,
	);

	$tabs['documentation'] = array(
		'name' => __( 'Documentation', 'generatepress' ),
		'url' => 'https://docs.generatepress.com',
		'class' => '',
		'external' => true,
	);
	?>
	<div class="gpress-dashboard-navigation">
		<?php
		foreach ( $tabs as $tab ) {
			printf(
				'<a href="%1$s" class="%2$s"%4$s>%3$s</a>',
				esc_url( $tab['url'] ),
				esc_attr( $tab['class'] ),
				esc_html( $tab['name'] ),
				! empty( $tab['external'] ) ? 'target="_blank" rel="noreferrer noopener"' : ''
			);
		}
		?>
	</div>
	<?php
}

add_action( 'in_admin_header', 'generate_do_dashboard_headers' );
/**
 * Add our Dashboard headers.
 *
 * @since 3.1.0
 */
function generate_do_dashboard_headers() {
	$dashboard_pages = generate_get_dashboard_pages();
	$current_screen = get_current_screen();

	if ( in_array( $current_screen->id, $dashboard_pages ) ) {
		generate_do_dashboard_header();

		/**
		 * generate_dashboard_after_header hook.
		 *
		 * @since 2.0
		 */
		do_action( 'generate_dashboard_after_header' );
	}
}

add_action( 'admin_enqueue_scripts', 'generate_enqueue_dashboard_scripts' );
/**
 * Add our scripts to the page.
 *
 * @since 3.1.0
 */
function generate_enqueue_dashboard_scripts() {
	$dashboard_pages = generate_get_dashboard_pages();
	$current_screen = get_current_screen();

	if ( in_array( $current_screen->id, $dashboard_pages ) ) {
		wp_enqueue_style(
			'generate-dashboard',
			get_template_directory_uri() . '/assets/css/admin/dashboard.css',
			array(),
			GENERATE_VERSION
		);
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
										printf(
											'<a id="generate_customize_button" class="button button-primary" href="%1$s">%2$s</a>',
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
										'url' => generate_get_premium_url( 'https://generatepress.com/premium/#backgrounds', false ),
									),
									'Blog' => array(
										'url' => generate_get_premium_url( 'https://generatepress.com/premium/#blog', false ),
									),
									'Colors' => array(
										'url' => generate_get_premium_url( 'https://generatepress.com/premium/#colors', false ),
									),
									'Copyright' => array(
										'url' => generate_get_premium_url( 'https://generatepress.com/premium/#copyright', false ),
									),
									'Disable Elements' => array(
										'url' => generate_get_premium_url( 'https://generatepress.com/premium/#disable-elements', false ),
									),
									'Elements' => array(
										'url' => generate_get_premium_url( 'https://generatepress.com/premium/#elements', false ),
									),
									'Import / Export' => array(
										'url' => generate_get_premium_url( 'https://generatepress.com/premium/#import-export', false ),
									),
									'Menu Plus' => array(
										'url' => generate_get_premium_url( 'https://generatepress.com/premium/#menu-plus', false ),
									),
									'Secondary Nav' => array(
										'url' => generate_get_premium_url( 'https://generatepress.com/premium/#secondary-nav', false ),
									),
									'Sections' => array(
										'url' => generate_get_premium_url( 'https://generatepress.com/premium/#sections', false ),
									),
									'Site Library' => array(
										'url' => generate_get_premium_url( 'https://generatepress.com/site-library', false ),
									),
									'Spacing' => array(
										'url' => generate_get_premium_url( 'https://generatepress.com/premium/#spacing', false ),
									),
									'Typography' => array(
										'url' => generate_get_premium_url( 'https://generatepress.com/premium/#typography', false ),
									),
									'WooCommerce' => array(
										'url' => generate_get_premium_url( 'https://generatepress.com/premium/#woocommerce', false ),
									),
								);

								if ( ! defined( 'GP_PREMIUM_VERSION' ) ) :
									?>
									<div class="postbox generate-metabox">
										<h3 class="hndle"><?php esc_html_e( 'Premium Modules', 'generatepress' ); ?></h3>
										<div class="inside" style="margin:0;padding:0;">
											<div class="premium-addons">
												<?php
												foreach ( $modules as $module => $info ) {
													?>
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

								$typography_section = 'customize.php?autofocus[section]=font_section';
								$colors_section = 'customize.php?autofocus[section]=body_section';

								if ( function_exists( 'generatepress_is_module_active' ) ) {
									if ( generatepress_is_module_active( 'generate_package_typography', 'GENERATE_TYPOGRAPHY' ) ) {
										$typography_section = 'customize.php?autofocus[panel]=generate_typography_panel';
									}

									if ( generatepress_is_module_active( 'generate_package_colors', 'GENERATE_COLORS' ) ) {
										$colors_section = 'customize.php?autofocus[panel]=generate_colors_panel';
									}
								}

								$quick_settings = array(
									'logo' => array(
										'title' => __( 'Upload Logo', 'generatepress' ),
										'icon' => 'dashicons-format-image',
										'url' => admin_url( 'customize.php?autofocus[control]=custom_logo' ),
									),
									'typography' => array(
										'title' => __( 'Customize Fonts', 'generatepress' ),
										'icon' => 'dashicons-editor-textcolor',
										'url' => admin_url( $typography_section ),
									),
									'colors' => array(
										'title' => __( 'Customize Colors', 'generatepress' ),
										'icon' => 'dashicons-admin-customizer',
										'url' => admin_url( $colors_section ),
									),
									'layout' => array(
										'title' => __( 'Layout Options', 'generatepress' ),
										'icon' => 'dashicons-layout',
										'url' => admin_url( 'customize.php?autofocus[panel]=generate_layout_panel' ),
									),
									'all' => array(
										'title' => __( 'All Options', 'generatepress' ),
										'icon' => 'dashicons-admin-generic',
										'url' => admin_url( 'customize.php' ),
									),
								);
								?>
							</div>

							<div class="generate-right-sidebar grid-30" style="padding-right: 0;">
								<div class="postbox generate-metabox start-customizing">
									<h3 class="hndle"><?php esc_html_e( 'Start Customizing', 'generatepress' ); ?></h3>
									<div class="inside">
										<ul>
											<?php
											foreach ( $quick_settings as $key => $data ) {
												printf(
													'<li><span class="dashicons %1$s"></span> <a href="%2$s">%3$s</a></li>',
													esc_attr( $data['icon'] ),
													esc_url( $data['url'] ),
													esc_html( $data['title'] )
												);
											}
											?>
										</ul>

										<p><?php esc_html_e( 'Want to learn more about the theme? Check out our extensive documentation.', 'generatepress' ); ?></p>
										<a href="https://docs.generatepress.com"><?php esc_html_e( 'Visit documentation &rarr;', 'generatepress' ); ?></a>
									</div>
								</div>

								<?php
								/**
								 * generate_admin_right_panel hook.
								 *
								 * @since 0.1
								 */
								do_action( 'generate_admin_right_panel' );
								?>

								<div class="postbox generate-metabox" id="gen-delete">
									<h3 class="hndle"><?php esc_html_e( 'Reset Settings', 'generatepress' ); ?></h3>
									<div class="inside">
										<p><?php esc_html_e( 'Deleting your settings can not be undone.', 'generatepress' ); ?></p>
										<form method="post">
											<p><input type="hidden" name="generate_reset_customizer" value="generate_reset_customizer_settings" /></p>
											<p>
												<?php
												$warning = 'return confirm("' . esc_html__( 'Warning: This will delete your settings.', 'generatepress' ) . '")';
												wp_nonce_field( 'generate_reset_customizer_nonce', 'generate_reset_customizer_nonce' );

												submit_button(
													esc_attr__( 'Reset', 'generatepress' ),
													'button-primary',
													'submit',
													false,
													array(
														'onclick' => esc_js( $warning ),
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
							printf(
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

		if ( isset( $_GET['settings-updated'] ) && 'true' === $_GET['settings-updated'] ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Only checking. False positive.
			add_settings_error( 'generate-notices', 'true', esc_html__( 'Settings saved.', 'generatepress' ), 'updated' );
		}

		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Only checking. False positive.
		if ( isset( $_GET['status'] ) && 'imported' === $_GET['status'] ) {
			add_settings_error( 'generate-notices', 'imported', esc_html__( 'Import successful.', 'generatepress' ), 'updated' );
		}

		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Only checking. False positive.
		if ( isset( $_GET['status'] ) && 'reset' === $_GET['status'] ) {
			add_settings_error( 'generate-notices', 'reset', esc_html__( 'Settings removed.', 'generatepress' ), 'updated' );
		}

		settings_errors( 'generate-notices' );
	}
}
