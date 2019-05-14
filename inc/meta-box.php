<?php
/**
 * Builds our main Layout meta box.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'admin_enqueue_scripts', 'generate_enqueue_meta_box_scripts' );
/**
 * Adds any scripts for this meta box.
 *
 * @since 2.0
 *
 * @param string $hook The current admin page.
 */
function generate_enqueue_meta_box_scripts( $hook ) {
	if ( in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {
		$post_types = get_post_types( array( 'public' => true ) );
		$screen = get_current_screen();
		$post_type = $screen->id;

		if ( in_array( $post_type, ( array ) $post_types ) ) {
			wp_enqueue_style( 'generate-layout-metabox', get_template_directory_uri() . '/css/admin/meta-box.css', array(), GENERATE_VERSION );
		}
	}
}

add_action( 'add_meta_boxes', 'generate_register_layout_meta_box' );
/**
 * Generate the layout metabox
 *
 * @since 2.0
 */
function generate_register_layout_meta_box() {
	if ( ! current_user_can( apply_filters( 'generate_metabox_capability', 'edit_theme_options' ) ) ) {
		return;
	}

	if ( ! defined( 'GENERATE_LAYOUT_META_BOX' ) ) {
		define( 'GENERATE_LAYOUT_META_BOX', true );
	}

	$post_types = get_post_types( array( 'public' => true ) );

	foreach ( $post_types as $type ) {
		if ( 'attachment' !== $type ) {
			add_meta_box(
				'generate_layout_options_meta_box',
				esc_html__( 'Layout', 'generatepress' ),
				'generate_do_layout_meta_box',
				$type,
				'side'
			);
		}
	}
}

/**
 * Build our meta box.
 *
 * @since 2.0
 *
 * @param object $post All post information.
 */
function generate_do_layout_meta_box( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'generate_layout_nonce' );
	$stored_meta = (array) get_post_meta( $post->ID );
	$stored_meta['_generate-sidebar-layout-meta'][0] = ( isset( $stored_meta['_generate-sidebar-layout-meta'][0] ) ) ? $stored_meta['_generate-sidebar-layout-meta'][0] : '';
	$stored_meta['_generate-footer-widget-meta'][0] = ( isset( $stored_meta['_generate-footer-widget-meta'][0] ) ) ? $stored_meta['_generate-footer-widget-meta'][0] : '';
	$stored_meta['_generate-full-width-content'][0] = ( isset( $stored_meta['_generate-full-width-content'][0] ) ) ? $stored_meta['_generate-full-width-content'][0] : '';
	$stored_meta['_generate-disable-headline'][0] = ( isset( $stored_meta['_generate-disable-headline'][0] ) ) ? $stored_meta['_generate-disable-headline'][0] : '';

	$tabs = apply_filters( 'generate_metabox_tabs',
		array(
			'sidebars' => array(
				'title' => esc_html__( 'Sidebars', 'generatepress' ),
				'target' => '#generate-layout-sidebars',
				'class' => 'current',
			),
			'footer_widgets' => array(
				'title' => esc_html__( 'Footer Widgets', 'generatepress' ),
				'target' => '#generate-layout-footer-widgets',
				'class' => '',
			),
			'disable_elements' => array(
				'title' => esc_html__( 'Disable Elements', 'generatepress' ),
				'target' => '#generate-layout-disable-elements',
				'class' => '',
			),
			'container' => array(
				'title' => esc_html__( 'Page Builder Container', 'generatepress' ),
				'target' => '#generate-layout-page-builder-container',
				'class' => '',
			),
		)
	);
	?>
	<script>
		jQuery(document).ready(function($) {
			$( '.generate-meta-box-menu li a' ).on( 'click', function( event ) {
				event.preventDefault();
				$( this ).parent().addClass( 'current' );
				$( this ).parent().siblings().removeClass( 'current' );
				var tab = $( this ).attr( 'data-target' );

				// Page header module still using href.
				if ( ! tab ) {
					tab = $( this ).attr( 'href' );
				}

				$( '.generate-meta-box-content' ).children( 'div' ).not( tab ).css( 'display', 'none' );
				$( tab ).fadeIn( 100 );
			});
		});
	</script>
	<div id="generate-meta-box-container">
		<ul class="generate-meta-box-menu">
			<?php
			foreach ( ( array ) $tabs as $tab => $data ) {
				echo '<li class="' . esc_attr( $data['class'] ) . '"><a data-target="' . esc_attr( $data['target'] ) . '" href="#">' . esc_html( $data['title'] ) . '</a></li>';
			}

			do_action( 'generate_layout_meta_box_menu_item' );
			?>
		</ul>
		<div class="generate-meta-box-content">
			<div id="generate-layout-sidebars">
				<div class="generate_layouts">
					<label for="meta-generate-layout-global" style="display:block;margin-bottom:10px;">
						<input type="radio" name="_generate-sidebar-layout-meta" id="meta-generate-layout-global" value="" <?php checked( $stored_meta['_generate-sidebar-layout-meta'][0], '' ); ?>>
						<?php esc_html_e( 'Default', 'generatepress' );?>
					</label>

					<label for="meta-generate-layout-one" style="display:block;margin-bottom:3px;" title="<?php esc_attr_e( 'Right Sidebar', 'generatepress' );?>">
						<input type="radio" name="_generate-sidebar-layout-meta" id="meta-generate-layout-one" value="right-sidebar" <?php checked( $stored_meta['_generate-sidebar-layout-meta'][0], 'right-sidebar' ); ?>>
						<?php esc_html_e( 'Content', 'generatepress' );?> / <strong><?php echo esc_html_x( 'Sidebar', 'Short name for meta box', 'generatepress' ); ?></strong>
					</label>

					<label for="meta-generate-layout-two" style="display:block;margin-bottom:3px;" title="<?php esc_attr_e( 'Left Sidebar', 'generatepress' );?>">
						<input type="radio" name="_generate-sidebar-layout-meta" id="meta-generate-layout-two" value="left-sidebar" <?php checked( $stored_meta['_generate-sidebar-layout-meta'][0], 'left-sidebar' ); ?>>
						<strong><?php echo esc_html_x( 'Sidebar', 'Short name for meta box', 'generatepress' ); ?></strong> / <?php esc_html_e( 'Content', 'generatepress' );?>
					</label>

					<label for="meta-generate-layout-three" style="display:block;margin-bottom:3px;" title="<?php esc_attr_e( 'No Sidebars', 'generatepress' );?>">
						<input type="radio" name="_generate-sidebar-layout-meta" id="meta-generate-layout-three" value="no-sidebar" <?php checked( $stored_meta['_generate-sidebar-layout-meta'][0], 'no-sidebar' ); ?>>
						<?php esc_html_e( 'Content (no sidebars)', 'generatepress' );?>
					</label>

					<label for="meta-generate-layout-four" style="display:block;margin-bottom:3px;" title="<?php esc_attr_e( 'Both Sidebars', 'generatepress' );?>">
						<input type="radio" name="_generate-sidebar-layout-meta" id="meta-generate-layout-four" value="both-sidebars" <?php checked( $stored_meta['_generate-sidebar-layout-meta'][0], 'both-sidebars' ); ?>>
						<strong><?php echo esc_html_x( 'Sidebar', 'Short name for meta box', 'generatepress' ); ?></strong> / <?php esc_html_e( 'Content', 'generatepress' );?> / <strong><?php echo esc_html_x( 'Sidebar', 'Short name for meta box', 'generatepress' ); ?></strong>
					</label>

					<label for="meta-generate-layout-five" style="display:block;margin-bottom:3px;" title="<?php esc_attr_e( 'Both Sidebars on Left', 'generatepress' );?>">
						<input type="radio" name="_generate-sidebar-layout-meta" id="meta-generate-layout-five" value="both-left" <?php checked( $stored_meta['_generate-sidebar-layout-meta'][0], 'both-left' ); ?>>
						<strong><?php echo esc_html_x( 'Sidebar', 'Short name for meta box', 'generatepress' ); ?></strong> / <strong><?php echo esc_html_x( 'Sidebar', 'Short name for meta box', 'generatepress' ); ?></strong> / <?php esc_html_e( 'Content', 'generatepress' );?>
					</label>

					<label for="meta-generate-layout-six" style="display:block;margin-bottom:3px;" title="<?php esc_attr_e( 'Both Sidebars on Right', 'generatepress' );?>">
						<input type="radio" name="_generate-sidebar-layout-meta" id="meta-generate-layout-six" value="both-right" <?php checked( $stored_meta['_generate-sidebar-layout-meta'][0], 'both-right' ); ?>>
						<?php esc_html_e( 'Content', 'generatepress' );?> / <strong><?php echo esc_html_x( 'Sidebar', 'Short name for meta box', 'generatepress' ); ?></strong> / <strong><?php echo esc_html_x( 'Sidebar', 'Short name for meta box', 'generatepress' ); ?></strong>
					</label>
				</div>
			</div>
			<div id="generate-layout-footer-widgets" style="display: none;">
				<div class="generate_footer_widget">
					<label for="meta-generate-footer-widget-global" style="display:block;margin-bottom:10px;">
						<input type="radio" name="_generate-footer-widget-meta" id="meta-generate-footer-widget-global" value="" <?php checked( $stored_meta['_generate-footer-widget-meta'][0], '' ); ?>>
						<?php esc_html_e( 'Default', 'generatepress' );?>
					</label>

					<label for="meta-generate-footer-widget-zero" style="display:block;margin-bottom:3px;" title="<?php esc_attr_e( '0 Widgets', 'generatepress' );?>">
						<input type="radio" name="_generate-footer-widget-meta" id="meta-generate-footer-widget-zero" value="0" <?php checked( $stored_meta['_generate-footer-widget-meta'][0], '0' ); ?>>
						<?php esc_html_e( '0 Widgets', 'generatepress' );?>
					</label>

					<label for="meta-generate-footer-widget-one" style="display:block;margin-bottom:3px;" title="<?php esc_attr_e( '1 Widget', 'generatepress' );?>">
						<input type="radio" name="_generate-footer-widget-meta" id="meta-generate-footer-widget-one" value="1" <?php checked( $stored_meta['_generate-footer-widget-meta'][0], '1' ); ?>>
						<?php esc_html_e( '1 Widget', 'generatepress' );?>
					</label>

					<label for="meta-generate-footer-widget-two" style="display:block;margin-bottom:3px;" title="<?php esc_attr_e( '2 Widgets', 'generatepress' );?>">
						<input type="radio" name="_generate-footer-widget-meta" id="meta-generate-footer-widget-two" value="2" <?php checked( $stored_meta['_generate-footer-widget-meta'][0], '2' ); ?>>
						<?php esc_html_e( '2 Widgets', 'generatepress' );?>
					</label>

					<label for="meta-generate-footer-widget-three" style="display:block;margin-bottom:3px;" title="<?php esc_attr_e( '3 Widgets', 'generatepress' );?>">
						<input type="radio" name="_generate-footer-widget-meta" id="meta-generate-footer-widget-three" value="3" <?php checked( $stored_meta['_generate-footer-widget-meta'][0], '3' ); ?>>
						<?php esc_html_e( '3 Widgets', 'generatepress' );?>
					</label>

					<label for="meta-generate-footer-widget-four" style="display:block;margin-bottom:3px;" title="<?php esc_attr_e( '4 Widgets', 'generatepress' );?>">
						<input type="radio" name="_generate-footer-widget-meta" id="meta-generate-footer-widget-four" value="4" <?php checked( $stored_meta['_generate-footer-widget-meta'][0], '4' ); ?>>
						<?php esc_html_e( '4 Widgets', 'generatepress' );?>
					</label>

					<label for="meta-generate-footer-widget-five" style="display:block;margin-bottom:3px;" title="<?php esc_attr_e( '5 Widgets', 'generatepress' );?>">
						<input type="radio" name="_generate-footer-widget-meta" id="meta-generate-footer-widget-five" value="5" <?php checked( $stored_meta['_generate-footer-widget-meta'][0], '5' ); ?>>
						<?php esc_html_e( '5 Widgets', 'generatepress' );?>
					</label>
				</div>
			</div>
			<div id="generate-layout-page-builder-container" style="display: none;">
				<p class="page-builder-content" style="color:#666;font-size:13px;margin-top:0;">
					<?php esc_html_e( 'Choose your page builder content container type. Both options remove the content padding for you.', 'generatepress' ) ;?>
				</p>

				<p class="generate_full_width_template">
					<label for="default-content" style="display:block;margin-bottom:10px;">
						<input type="radio" name="_generate-full-width-content" id="default-content" value="" <?php checked( $stored_meta['_generate-full-width-content'][0], '' ); ?>>
						<?php esc_html_e( 'Default', 'generatepress' );?>
					</label>

					<label id="full-width-content" for="_generate-full-width-content" style="display:block;margin-bottom:10px;">
						<input type="radio" name="_generate-full-width-content" id="_generate-full-width-content" value="true" <?php checked( $stored_meta['_generate-full-width-content'][0], 'true' ); ?>>
						<?php esc_html_e( 'Full Width', 'generatepress' );?>
					</label>

					<label id="generate-remove-padding" for="_generate-remove-content-padding" style="display:block;margin-bottom:10px;">
						<input type="radio" name="_generate-full-width-content" id="_generate-remove-content-padding" value="contained" <?php checked( $stored_meta['_generate-full-width-content'][0], 'contained' ); ?>>
						<?php esc_html_e( 'Contained', 'generatepress' );?>
					</label>
				</p>
			</div>
			<div id="generate-layout-disable-elements" style="display: none;">
				<?php if ( ! defined( 'GENERATE_DE_VERSION' ) ) : ?>
					<div class="generate_disable_elements">
						<label for="meta-generate-disable-headline" style="display:block;margin: 0 0 1em;" title="<?php esc_attr_e( 'Content Title', 'generatepress' );?>">
							<input type="checkbox" name="_generate-disable-headline" id="meta-generate-disable-headline" value="true" <?php checked( $stored_meta['_generate-disable-headline'][0], 'true' ); ?>>
							<?php esc_html_e( 'Content Title', 'generatepress' );?>
						</label>

						<?php if ( ! defined( 'GP_PREMIUM_VERSION' ) ) : ?>
							<span style="display:block;padding-top:1em;border-top:1px solid #EFEFEF;">
								<a href="<?php echo generate_get_premium_url( 'https://generatepress.com/downloads/generate-disable-elements' ); // WPCS: XSS ok, sanitization ok. ?>" target="_blank"><?php esc_html_e( 'Premium module available', 'generatepress' ); ?></a>
							</span>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php do_action( 'generate_layout_disable_elements_section', $stored_meta ); ?>
			</div>
			<?php do_action( 'generate_layout_meta_box_content', $stored_meta ); ?>
		</div>
	</div>
    <?php
}

add_action( 'save_post', 'generate_save_layout_meta_data' );
/**
 * Saves the sidebar layout meta data.
 *
 * @since 2.0
 *
 * @param int Post ID.
 */
function generate_save_layout_meta_data( $post_id ) {
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST['generate_layout_nonce'] ) && wp_verify_nonce( sanitize_key( $_POST['generate_layout_nonce'] ), basename( __FILE__ ) ) ) ? true : false;

	if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	$sidebar_layout_key   = '_generate-sidebar-layout-meta';
	$sidebar_layout_value = filter_input( INPUT_POST, $sidebar_layout_key, FILTER_SANITIZE_STRING );

	if ( $sidebar_layout_value ) {
		update_post_meta( $post_id, $sidebar_layout_key, $sidebar_layout_value );
	} else {
		delete_post_meta( $post_id, $sidebar_layout_key );
	}

	$footer_widget_key   = '_generate-footer-widget-meta';
	$footer_widget_value = filter_input( INPUT_POST, $footer_widget_key, FILTER_SANITIZE_STRING );

	// Check for empty string to allow 0 as a value.
	if ( '' !== $footer_widget_value ) {
		update_post_meta( $post_id, $footer_widget_key, $footer_widget_value );
	} else {
		delete_post_meta( $post_id, $footer_widget_key );
	}

	$page_builder_container_key   = '_generate-full-width-content';
	$page_builder_container_value = filter_input( INPUT_POST, $page_builder_container_key, FILTER_SANITIZE_STRING );

	if ( $page_builder_container_value ) {
		update_post_meta( $post_id, $page_builder_container_key, $page_builder_container_value );
	} else {
		delete_post_meta( $post_id, $page_builder_container_key );
	}

	// We only need this if the Disable Elements module doesn't exist
	if ( ! defined( 'GENERATE_DE_VERSION' ) ) {
		$disable_content_title_key   = '_generate-disable-headline';
		$disable_content_title_value = filter_input( INPUT_POST, $disable_content_title_key, FILTER_SANITIZE_STRING );

		if ( $disable_content_title_value ) {
			update_post_meta( $post_id, $disable_content_title_key, $disable_content_title_value );
		} else {
			delete_post_meta( $post_id, $disable_content_title_key );
		}
	}

	do_action( 'generate_layout_meta_box_save', $post_id );
}
