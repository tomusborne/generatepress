<?php
/**
 * Add HTML attributes to our theme elements.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * This class adds HTML attributes to various theme elements.
 */
class GeneratePress_HTML_Attributes {
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
	 *  Constructor
	 */
	public function __construct() {
		add_filter( 'generate_parse_attr', array( $this, 'parse_attributes' ), 10, 3 );
	}

	/**
	 * Parse the attributes.
	 *
	 * @since 3.1.0
	 * @param array  $attributes The current attributes.
	 * @param string $context The context in which attributes are applied.
	 * @param array  $settings Custom settings passed to the filter.
	 */
	public function parse_attributes( $attributes, $context, $settings ) {
		switch ( $context ) {
			case 'top-bar':
				return $this->top_bar( $attributes );

			case 'inside-top-bar':
				return $this->inside_top_bar( $attributes );

			case 'header':
				return $this->site_header( $attributes );

			case 'inside-header':
				return $this->inside_site_header( $attributes );

			case 'menu-toggle':
				return $this->menu_toggle( $attributes );

			case 'navigation':
				return $this->primary_navigation( $attributes );

			case 'inside-navigation':
				return $this->primary_inner_navigation( $attributes );

			case 'mobile-menu-control-wrapper':
				return $this->mobile_menu_control_wrapper( $attributes );

			case 'site-info':
				return $this->site_info( $attributes );

			case 'inside-site-info':
				return $this->inside_site_info( $attributes );

			case 'entry-header':
				return $this->entry_header( $attributes );

			case 'page-header':
				return $this->page_header( $attributes );

			case 'site-content':
				return $this->site_content( $attributes );

			case 'page':
				return $this->page( $attributes );

			case 'content':
				return $this->content( $attributes );

			case 'main':
				return $this->main( $attributes );

			case 'post-navigation':
				return $this->post_navigation( $attributes );

			case 'left-sidebar':
				return $this->left_sidebar( $attributes );

			case 'right-sidebar':
				return $this->right_sidebar( $attributes );

			case 'footer-widgets-container':
				return $this->footer_widgets_container( $attributes );

			case 'comment-body':
				return $this->comment_body( $attributes, $settings );

			case 'comment-meta':
				return $this->comment_meta( $attributes );

			case 'footer-entry-meta':
				return $this->footer_entry_meta( $attributes );
		}

		return $attributes;
	}

	/**
	 * Add attributes to our top bar.
	 *
	 * @since 3.1.0
	 * @param array $attributes The existing attributes.
	 */
	public function top_bar( $attributes ) {
		$classes = generate_get_element_classes( 'top_bar' );

		if ( $classes ) {
			$attributes['class'] .= ' ' . join( ' ', $classes );
		}

		return $attributes;
	}

	/**
	 * Add attributes to our inside top bar container.
	 *
	 * @since 3.1.0
	 * @param array $attributes The existing attributes.
	 */
	public function inside_top_bar( $attributes ) {
		$attributes['class'] .= ' inside-top-bar';

		if ( 'contained' === generate_get_option( 'top_bar_inner_width' ) ) {
			$attributes['class'] .= ' grid-container';

			if ( ! generate_is_using_flexbox() ) {
				$attributes['class'] .= ' grid-parent';
			}
		}

		return $attributes;
	}

	/**
	 * Add attributes to our site header.
	 *
	 * @since 3.1.0
	 * @param array $attributes The existing attributes.
	 */
	public function site_header( $attributes ) {
		$attributes['id'] = 'masthead';
		$attributes['aria-label'] = esc_attr__( 'Site', 'generatepress' );

		return $attributes;
	}

	/**
	 * Add attributes to our inside site header container.
	 *
	 * @since 3.1.0
	 * @param array $attributes The existing attributes.
	 */
	public function inside_site_header( $attributes ) {
		$classes = generate_get_element_classes( 'inside_header' );

		if ( $classes ) {
			$attributes['class'] .= ' ' . join( ' ', $classes );
		}

		return $attributes;
	}

	/**
	 * Add attributes to our menu toggle.
	 *
	 * @since 3.1.0
	 * @param array $attributes The existing attributes.
	 */
	public function menu_toggle( $attributes ) {
		$attributes['class'] .= ' menu-toggle';
		$attributes['aria-controls'] = 'primary-menu';
		$attributes['aria-expanded'] = 'false';

		return $attributes;
	}

	/**
	 * Add attributes to our main navigation.
	 *
	 * @since 3.1.0
	 * @param array $attributes The existing attributes.
	 */
	public function primary_navigation( $attributes ) {
		$attributes['id'] = 'site-navigation';
		$attributes['aria-label'] = esc_attr__( 'Primary', 'generatepress' );

		return $attributes;
	}

	/**
	 * Add attributes to our main navigation.
	 *
	 * @since 3.1.0
	 * @param array $attributes The existing attributes.
	 */
	public function primary_inner_navigation( $attributes ) {
		$classes = generate_get_element_classes( 'inside_navigation' );

		if ( $classes ) {
			$attributes['class'] .= ' ' . join( ' ', $classes );
		}

		return $attributes;
	}

	/**
	 * Add attributes to our main navigation.
	 *
	 * @since 3.1.0
	 * @param array $attributes The existing attributes.
	 */
	public function mobile_menu_control_wrapper( $attributes ) {
		$attributes['id'] = 'mobile-menu-control-wrapper';
		$attributes['class'] .= ' main-navigation mobile-menu-control-wrapper';
		$attributes['aria-label'] = esc_attr__( 'Mobile Toggle', 'generatepress' );

		return $attributes;
	}

	/**
	 * Add attributes to our footer element.
	 *
	 * @since 3.1.0
	 * @param array $attributes The existing attributes.
	 */
	public function site_info( $attributes ) {
		$attributes['class'] .= ' site-info';
		$attributes['aria-label'] = esc_attr__( 'Site', 'generatepress' );

		return $attributes;
	}

	/**
	 * Add attributes to our inside site info container.
	 *
	 * @since 3.1.0
	 * @param array $attributes The existing attributes.
	 */
	public function inside_site_info( $attributes ) {
		$attributes['class'] .= ' inside-site-info';

		if ( 'full-width' !== generate_get_option( 'footer_inner_width' ) ) {
			$attributes['class'] .= ' grid-container';

			if ( ! generate_is_using_flexbox() ) {
				$attributes['class'] .= ' grid-parent';
			}
		}

		return $attributes;
	}

	/**
	 * Add attributes to our entry headers.
	 *
	 * @since 3.1.0
	 * @param array $attributes The existing attributes.
	 */
	public function entry_header( $attributes ) {
		$attributes['class'] .= ' entry-header';
		$attributes['aria-label'] = esc_attr__( 'Content', 'generatepress' );

		return $attributes;
	}

	/**
	 * Add attributes to our page headers.
	 *
	 * @since 3.1.0
	 * @param array $attributes The existing attributes.
	 */
	public function page_header( $attributes ) {
		$attributes['class'] .= ' page-header';
		$attributes['aria-label'] = esc_attr__( 'Page', 'generatepress' );

		return $attributes;
	}

	/**
	 * Add attributes to our entry headers.
	 *
	 * @since 3.1.0
	 * @param array $attributes The existing attributes.
	 */
	public function post_navigation( $attributes ) {
		if ( is_single() ) {
			$attributes['class'] .= ' post-navigation';
			$attributes['aria-label'] = esc_attr__( 'Single Post', 'generatepress' );
		} else {
			$attributes['class'] .= ' paging-navigation';
			$attributes['aria-label'] = esc_attr__( 'Archive Page', 'generatepress' );
		}

		return $attributes;
	}

	/**
	 * Add attributes to our page container.
	 *
	 * @since 3.1.0
	 * @param array $attributes The existing attributes.
	 */
	public function page( $attributes ) {
		$attributes['id'] = 'page';

		return $attributes;
	}

	/**
	 * Add attributes to our site content container.
	 *
	 * @since 3.1.0
	 * @param array $attributes The existing attributes.
	 */
	public function site_content( $attributes ) {
		$attributes['id'] = 'content';
		$attributes['class'] .= ' site-content';

		return $attributes;
	}

	/**
	 * Add attributes to our primary content container.
	 *
	 * @since 3.1.0
	 * @param array $attributes The existing attributes.
	 */
	public function content( $attributes ) {
		$attributes['id'] = 'primary';

		return $attributes;
	}

	/**
	 * Add attributes to our primary content container.
	 *
	 * @since 3.1.0
	 * @param array $attributes The existing attributes.
	 */
	public function main( $attributes ) {
		$attributes['id'] = 'main';

		return $attributes;
	}

	/**
	 * Add attributes to our left sidebar.
	 *
	 * @since 3.1.0
	 * @param array $attributes The existing attributes.
	 */
	public function left_sidebar( $attributes ) {
		$classes = generate_get_element_classes( 'left_sidebar' );

		if ( $classes ) {
			$attributes['class'] .= ' ' . join( ' ', $classes );
		}

		$attributes['id'] = 'left-sidebar';

		return $attributes;
	}

	/**
	 * Add attributes to our right sidebar.
	 *
	 * @since 3.1.0
	 * @param array $attributes The existing attributes.
	 */
	public function right_sidebar( $attributes ) {
		$classes = generate_get_element_classes( 'right_sidebar' );

		if ( $classes ) {
			$attributes['class'] .= ' ' . join( ' ', $classes );
		}

		$attributes['id'] = 'right-sidebar';

		return $attributes;
	}

	/**
	 * Add attributes to our footer widget inner container.
	 *
	 * @since 3.1.0
	 * @param array $attributes The existing attributes.
	 */
	public function footer_widgets_container( $attributes ) {
		$classes = generate_get_element_classes( 'inside_footer' );

		if ( $classes ) {
			$attributes['class'] .= ' ' . join( ' ', $classes );
		}

		return $attributes;
	}

	/**
	 * Add attributes to our footer widget inner container.
	 *
	 * @since 3.1.0
	 * @param array $attributes The existing attributes.
	 * @param array $settings Settings passed through the function.
	 */
	public function comment_body( $attributes, $settings ) {
		$attributes['class'] .= ' comment-body';
		$attributes['id'] = 'div-comment-' . $settings['comment-id'];

		return $attributes;
	}

	/**
	 * Add attributes to our comment meta.
	 *
	 * @since 3.1.0
	 * @param array $attributes The existing attributes.
	 */
	public function comment_meta( $attributes ) {
		$attributes['class'] .= ' comment-meta';
		$attributes['aria-label'] = esc_attr__( 'Comment meta', 'generatepress' );

		return $attributes;
	}

	/**
	 * Add attributes to our footer entry meta.
	 *
	 * @since 3.1.0
	 * @param array $attributes The existing attributes.
	 */
	public function footer_entry_meta( $attributes ) {
		$attributes['class'] .= ' entry-meta';
		$attributes['aria-label'] = esc_attr__( 'Entry meta', 'generatepress' );

		return $attributes;
	}
}

GeneratePress_HTML_Attributes::get_instance();
