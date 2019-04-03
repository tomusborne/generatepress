<?php
/**
 * Post meta elements.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'generate_content_nav' ) ) {
	/**
	 * Display navigation to next/previous pages when applicable.
	 *
	 * @since 0.1
	 *
	 * @param string $nav_id The id of our navigation.
	 */
	function generate_content_nav( $nav_id ) {
		if ( ! apply_filters( 'generate_show_post_navigation', true ) ) {
			return;
		}

		global $wp_query, $post;

		// Don't print empty markup on single pages if there's nowhere to navigate.
		if ( is_single() ) {
			$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
			$next = get_adjacent_post( false, '', false );

			if ( ! $next && ! $previous ) {
				return;
			}
		}

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
			return;
		}

		$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';
		$category_specific = apply_filters( 'generate_category_post_navigation', false );
		?>
		<nav id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo esc_attr( $nav_class ); ?>">
			<span class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'generatepress' ); ?></span>

			<?php if ( is_single() ) : // navigation links for single posts.

				previous_post_link(
					'<div class="nav-previous">' . generate_get_svg_icon( 'arrow' ) . '<span class="prev" title="' . esc_attr__( 'Previous', 'generatepress' ) . '">%link</span></div>',
					'%title',
					$category_specific
				);

				next_post_link(
					'<div class="nav-next">' . generate_get_svg_icon( 'arrow' ) . '<span class="next" title="' . esc_attr__( 'Next', 'generatepress' ) . '">%link</span></div>', 
					'%title',
					$category_specific
				);

			elseif ( is_home() || is_archive() || is_search() ) : // navigation links for home, archive, and search pages.

				if ( get_next_posts_link() ) : ?>
					<div class="nav-previous">
						<?php generate_do_svg_icon( 'arrow' ); ?>
						<span class="prev" title="<?php esc_attr_e( 'Previous', 'generatepress' );?>"><?php next_posts_link( __( 'Older posts', 'generatepress' ) ); ?></span>
					</div>
				<?php endif;

				if ( get_previous_posts_link() ) : ?>
					<div class="nav-next">
						<?php generate_do_svg_icon( 'arrow' ); ?>
						<span class="next" title="<?php esc_attr_e( 'Next', 'generatepress' );?>"><?php previous_posts_link( __( 'Newer posts', 'generatepress' ) ); ?></span>
					</div>
				<?php endif;

				if ( function_exists( 'the_posts_pagination' ) ) {
					the_posts_pagination( array(
						'mid_size' => apply_filters( 'generate_pagination_mid_size', 1 ),
						'prev_text' => apply_filters( 'generate_previous_link_text', __( '&larr; Previous', 'generatepress' ) ),
						'next_text' => apply_filters( 'generate_next_link_text', __( 'Next &rarr;', 'generatepress' ) ),
					) );
				}

				/**
				 * generate_paging_navigation hook.
				 *
				 * @since 0.1
				 */
				do_action( 'generate_paging_navigation' );

			endif; ?>
		</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
		<?php
	}
}

if ( ! function_exists( 'generate_modify_posts_pagination_template' ) ) {
	add_filter( 'navigation_markup_template', 'generate_modify_posts_pagination_template', 10, 2 );
	/**
	 * Remove the container and screen reader text from the_posts_pagination()
	 * We add this in ourselves in generate_content_nav()
	 *
	 * @since 1.3.45
	 *
	 * @param string $template The default template.
	 * @param string $class The class passed by the calling function.
	 * @return string The HTML for the post navigation.
	 */
	function generate_modify_posts_pagination_template( $template, $class ) {
		if ( ! empty( $class ) && false !== strpos( $class, 'pagination' ) ) {
			$template = '<div class="nav-links">%3$s</div>';
		}

		return $template;
	}
}

/**
 * Output requested post meta.
 *
 * @since 2.3
 *
 * @param string $item The post meta item we're requesting
 * @return The requested HTML.
 */
function generate_do_post_meta_item( $item ) {
	if ( 'date' === $item ) {
		$date = apply_filters( 'generate_post_date', true );

		$time_string = '<time class="entry-date published" datetime="%1$s" itemprop="datePublished">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time>' . $time_string;
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		// If our date is enabled, show it.
		if ( $date ) {
			echo apply_filters( 'generate_post_date_output', sprintf( '<span class="posted-on">%1$s</span> ', // WPCS: XSS ok, sanitization ok.
				sprintf( '<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>',
					esc_url( get_permalink() ),
					esc_attr( get_the_time() ),
					$time_string
				)
			), $time_string );
		}
	}

	if ( 'author' === $item ) {
		$author = apply_filters( 'generate_post_author', true );

		if ( $author ) {
			echo apply_filters( 'generate_post_author_output', sprintf( '<span class="byline">%1$s</span> ', // WPCS: XSS ok, sanitization ok.
				sprintf( '<span class="author vcard" %5$s>%1$s <a class="url fn n" href="%2$s" title="%3$s" rel="author" itemprop="url"><span class="author-name" itemprop="name">%4$s</span></a></span>',
					__( 'by', 'generatepress' ),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					/* translators: 1: Author name */
					esc_attr( sprintf( __( 'View all posts by %s', 'generatepress' ), get_the_author() ) ),
					esc_html( get_the_author() ),
					generate_get_microdata( 'post-author' )
				)
			) );
		}
	}

	if ( 'categories' === $item ) {
		$categories = apply_filters( 'generate_show_categories', true );

		$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'generatepress' ) );
		if ( $categories_list && $categories ) {
			echo apply_filters( 'generate_category_list_output', sprintf( '<span class="cat-links">%3$s<span class="screen-reader-text">%1$s </span>%2$s</span> ', // WPCS: XSS ok, sanitization ok.
				esc_html_x( 'Categories', 'Used before category names.', 'generatepress' ),
				$categories_list,
				generate_get_svg_icon( 'categories' )
			) );
		}
	}

	if ( 'tags' === $item ) {
		$tags = apply_filters( 'generate_show_tags', true );

		$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'generatepress' ) );
		if ( $tags_list && $tags ) {
			echo apply_filters( 'generate_tag_list_output', sprintf( '<span class="tags-links">%3$s<span class="screen-reader-text">%1$s </span>%2$s</span> ', // WPCS: XSS ok, sanitization ok.
				esc_html_x( 'Tags', 'Used before tag names.', 'generatepress' ),
				$tags_list,
				generate_get_svg_icon( 'tags' )
			) );
		}
	}

	if ( 'comments-link' === $item ) {
		$comments = apply_filters( 'generate_show_comments', true );

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) && $comments ) {
			echo '<span class="comments-link">';
				generate_do_svg_icon( 'comments' );
				comments_popup_link( __( 'Leave a comment', 'generatepress' ), __( '1 Comment', 'generatepress' ), __( '% Comments', 'generatepress' ) );
			echo '</span> ';
		}
	}
}

if ( ! function_exists( 'generate_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 *
	 * @since 0.1
	 */
	function generate_posted_on() {
		$items = apply_filters( 'generate_header_entry_meta_items', array(
			'date',
			'author',
		) );

		foreach ( $items as $item ) {
			if ( 'date' === $item ) {
				generate_do_post_meta_item( 'date' );
			}

			if ( 'author' === $item ) {
				generate_do_post_meta_item( 'author' );
			}

			if ( 'categories' === $item ) {
				generate_do_post_meta_item( 'categories' );
			}

			if ( 'tags' === $item ) {
				generate_do_post_meta_item( 'tags' );
			}

			if ( 'comments-link' === $item ) {
				generate_do_post_meta_item( 'comments-link' );
			}
		}
	}
}

if ( ! function_exists( 'generate_entry_meta' ) ) {
	/**
	 * Prints HTML with meta information for the categories, tags.
	 *
	 * @since 1.2.5
	 */
	function generate_entry_meta() {
		$items = apply_filters( 'generate_footer_entry_meta_items', array(
			'categories',
			'tags',
			'comments-link',
		) );

		foreach ( $items as $item ) {
			if ( 'date' === $item ) {
				generate_do_post_meta_item( 'date' );
			}

			if ( 'author' === $item ) {
				generate_do_post_meta_item( 'author' );
			}

			if ( 'categories' === $item ) {
				generate_do_post_meta_item( 'categories' );
			}

			if ( 'tags' === $item ) {
				generate_do_post_meta_item( 'tags' );
			}

			if ( 'comments-link' === $item ) {
				generate_do_post_meta_item( 'comments-link' );
			}
		}
	}
}

if ( ! function_exists( 'generate_excerpt_more' ) ) {
	add_filter( 'excerpt_more', 'generate_excerpt_more' );
	/**
	 * Prints the read more HTML to post excerpts.
	 *
	 * @since 0.1
	 *
	 * @param string $more The string shown within the more link.
	 * @return string The HTML for the more link.
	 */
	function generate_excerpt_more( $more ) {
		return apply_filters( 'generate_excerpt_more_output', sprintf( ' ... <a title="%1$s" class="read-more" href="%2$s">%3$s%4$s</a>',
			the_title_attribute( 'echo=0' ),
			esc_url( get_permalink( get_the_ID() ) ),
			__( 'Read more', 'generatepress' ),
			'<span class="screen-reader-text">' . get_the_title() . '</span>'
		) );
	}
}

if ( ! function_exists( 'generate_content_more' ) ) {
	add_filter( 'the_content_more_link', 'generate_content_more' );
	/**
	 * Prints the read more HTML to post content using the more tag.
	 *
	 * @since 0.1
	 *
	 * @param string $more The string shown within the more link.
	 * @return string The HTML for the more link
	 */
	function generate_content_more( $more ) {
		return apply_filters( 'generate_content_more_link_output', sprintf( '<p class="read-more-container"><a title="%1$s" class="read-more content-read-more" href="%2$s">%3$s%4$s</a></p>',
			the_title_attribute( 'echo=0' ),
			esc_url( get_permalink( get_the_ID() ) . apply_filters( 'generate_more_jump','#more-' . get_the_ID() ) ),
			__( 'Read more', 'generatepress' ),
			'<span class="screen-reader-text">' . get_the_title() . '</span>'
		) );
	}
}

if ( ! function_exists( 'generate_post_meta' ) ) {
	add_action( 'generate_after_entry_title', 'generate_post_meta' );
	/**
	 * Build the post meta.
	 *
	 * @since 1.3.29
	 */
	function generate_post_meta() {
		$post_types = apply_filters( 'generate_entry_meta_post_types', array(
			'post',
		) );

		if ( in_array( get_post_type(), $post_types ) ) : ?>
			<div class="entry-meta">
				<?php generate_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php endif;
	}
}

if ( ! function_exists( 'generate_footer_meta' ) ) {
	add_action( 'generate_after_entry_content', 'generate_footer_meta' );
	/**
	 * Build the footer post meta.
	 *
	 * @since 1.3.30
	 */
	function generate_footer_meta() {
		$post_types = apply_filters( 'generate_footer_meta_post_types', array(
			'post',
		) );

		if ( in_array( get_post_type(), $post_types ) ) : ?>
			<footer class="entry-meta">
				<?php
				generate_entry_meta();

				if ( is_single() ) {
					generate_content_nav( 'nav-below' );
				}
				?>
			</footer><!-- .entry-meta -->
		<?php endif;
	}
}
