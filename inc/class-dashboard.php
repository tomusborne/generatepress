<?php
/**
 * Build our admin dashboard.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * This class adds HTML attributes to various theme elements.
 */
class GeneratePress_Dashboard {
	/**
	 * Class instance.
	 *
	 * @access private
	 * @var $instance Class instance.
	 */
	private static $instance;

	/**
	 * Initiator
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Get started.
	 */
	public function __construct() {
		// Load our old dashboard if we're using an old version of GP Premium.
		if ( defined( 'GP_PREMIUM_VERSION' ) && version_compare( GP_PREMIUM_VERSION, '2.1.0-alpha.1', '<' ) ) {
			require_once get_template_directory() . '/inc/dashboard.php';

			return;
		}

		add_action( 'admin_menu', array( $this, 'add_menu_item' ) );
		add_filter( 'admin_body_class', array( $this, 'set_admin_body_class' ) );
		add_action( 'in_admin_header', array( $this, 'add_header' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'generate_admin_dashboard', array( $this, 'start_customizing' ) );
		add_action( 'generate_admin_dashboard', array( $this, 'go_pro' ), 15 );
		add_action( 'generate_admin_dashboard', array( $this, 'reset' ), 100 );
	}

	/**
	 * Add our dashboard menu item.
	 */
	public function add_menu_item() {
		add_theme_page(
			esc_html__( 'GeneratePress', 'generatepress' ),
			esc_html__( 'GeneratePress', 'generatepress' ),
			apply_filters( 'generate_dashboard_page_capability', 'edit_theme_options' ),
			'generate-options',
			array( $this, 'page' )
		);
	}

	/**
	 * Get our dashboard pages so we can style them.
	 */
	public static function get_pages() {
		return apply_filters(
			'generate_dashboard_screens',
			array(
				'appearance_page_generate-options',
			)
		);
	}

	/**
	 * Add a body class on GP dashboard pages.
	 *
	 * @param string $classes The existing classes.
	 */
	public function set_admin_body_class( $classes ) {
		$dashboard_pages = self::get_pages();
		$current_screen = get_current_screen();

		if ( in_array( $current_screen->id, $dashboard_pages ) ) {
			$classes .= ' generate-dashboard-page';
		}

		return $classes;
	}

	/**
	 * Build our Dashboard header.
	 */
	public static function header() {
		?>
		<div class="generatepress-dashboard-header">
			<div class="generatepress-dashboard-header__title">
				<h1>
					<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600"><path d="M485.2 427.8l-99.1-46.2 15.8-34c5.6-11.9 8.8-24.3 10-36.7 3.3-33.7-9-67.3-33.2-91.1-8.9-8.7-19.3-16.1-31.3-21.7-11.9-5.6-24.3-8.8-36.7-10-33.7-3.3-67.4 9-91.1 33.2-8.7 8.9-16.1 19.3-21.7 31.3l-15.8 34-30.4 65.2c-.7 1.5-.1 3.3 1.5 4l65.2 30.4 34 15.8 34 15.8 68 31.7 74.7 34.8c-65 45.4-152.1 55.2-228.7 17.4C90.2 447.4 44.1 313.3 97.3 202.6c53.3-110.8 186-158.5 297.8-106.3 88.1 41.1 137.1 131.9 129.1 223.4-.1 1.3.6 2.4 1.7 3l65.6 30.6c1.8.8 3.9-.3 4.2-2.2 22.6-130.7-44-265.4-170.5-323.5-150.3-69-327-4.1-396.9 145.8-70 150.1-5.1 328.5 145.1 398.5 114.1 53.2 244.5 28.4 331.3-52.3 17.9-16.6 33.9-35.6 47.5-56.8 1-1.5.4-3.6-1.3-4.3l-65.7-30.7zm-235-109.6l15.8-34c8.8-18.8 31.1-26.9 49.8-18.1s26.9 31 18.1 49.8l-15.8 34-34-15.8-33.9-15.9z" fill="currentColor" /></svg>
					<?php echo esc_html( get_admin_page_title() ); ?>
				</h1>
			</div>

			<?php self::navigation(); ?>
		</div>
		<?php
	}

	/**
	 * Build our Dashboard menu.
	 */
	public static function navigation() {
		$screen = get_current_screen();

		$tabs = apply_filters(
			'generate_dashboard_tabs',
			array(
				'dashboard' => array(
					'name' => __( 'Dashboard', 'generatepress' ),
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
		<div class="generatepress-dashboard-header__navigation">
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

	/**
	 * Add our Dashboard headers.
	 */
	public function add_header() {
		$dashboard_pages = self::get_pages();
		$current_screen = get_current_screen();

		if ( in_array( $current_screen->id, $dashboard_pages ) ) {
			self::header();

			/**
			 * generate_dashboard_after_header hook.
			 *
			 * @since 2.0
			 */
			do_action( 'generate_dashboard_after_header' );
		}
	}

	/**
	 * Add our scripts to the page.
	 */
	public function enqueue_scripts() {
		$dashboard_pages = self::get_pages();
		$current_screen = get_current_screen();

		if ( in_array( $current_screen->id, $dashboard_pages ) ) {
			wp_enqueue_style(
				'generate-dashboard',
				get_template_directory_uri() . '/assets/dist/style-dashboard.css',
				array( 'wp-components' ),
				GENERATE_VERSION
			);

			if ( 'appearance_page_generate-options' === $current_screen->id ) {
				wp_enqueue_script(
					'generate-dashboard',
					get_template_directory_uri() . '/assets/dist/dashboard.js',
					array( 'wp-api', 'wp-i18n', 'wp-components', 'wp-element', 'wp-api-fetch' ),
					GENERATE_VERSION,
					true
				);

				wp_set_script_translations( 'generate-dashboard', 'generatepress' );

				wp_localize_script(
					'generate-dashboard',
					'generateDashboard',
					array(
						'hasPremium' => defined( 'GP_PREMIUM_VERSION' ),
						'customizeSectionUrls' => array(
							'siteIdentitySection' => admin_url( 'customize.php?autofocus[section]=title_tagline' ),
							'colorsSection' => admin_url( 'customize.php?autofocus[section]=generate_colors_section' ),
							'typographySection' => admin_url( 'customize.php?autofocus[section]=generate_typography_section' ),
							'layoutSection' => admin_url( 'customize.php?autofocus[panel]=generate_layout_panel' ),
						),
					)
				);
			}
		}
	}

	/**
	 * Add the HTML for our page.
	 */
	public function page() {
		?>
		<div class="wrap">
			<div class="generatepress-dashboard">
				<?php do_action( 'generate_admin_dashboard' ); ?>
			</div>
		</div>
		<?php
	}

	/**
	 * Add the container for our start customizing app.
	 */
	public function start_customizing() {
		echo '<div id="generatepress-dashboard-app"></div>';
	}

	/**
	 * Add the container for our start customizing app.
	 */
	public function go_pro() {
		echo '<div id="generatepress-dashboard-go-pro"></div>';
	}

	/**
	 * Add the container for our reset app.
	 */
	public function reset() {
		echo '<div id="generatepress-reset"></div>';
	}
}

GeneratePress_Dashboard::get_instance();
