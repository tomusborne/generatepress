<?php
/**
 * Comment structure.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'generate_comment' ) ) {
	/**
	 * Template for comments and pingbacks.
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @param object $comment The comment object.
	 * @param array  $args The existing args.
	 * @param int    $depth The thread depth.
	 */
	function generate_comment( $comment, $args, $depth ) {
		$args['avatar_size'] = apply_filters( 'generate_comment_avatar_size', 50 );

		if ( 'pingback' === $comment->comment_type || 'trackback' === $comment->comment_type ) : ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<div class="comment-body">
				<?php esc_html_e( 'Pingback:', 'generatepress' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'generatepress' ), '<span class="edit-link">', '</span>' ); ?>
			</div>

		<?php else : ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" <?php generate_do_element_classes( 'comment-body', 'comment-body' ); ?>>
				<footer class="comment-meta">
					<?php
					if ( 0 != $args['avatar_size'] ) { // phpcs:ignore
						echo get_avatar( $comment, $args['avatar_size'] );
					}
					?>
					<div class="comment-author-info">
						<div <?php generate_do_element_classes( 'comment-author' ); ?>>
							<?php printf( '<cite itemprop="name" class="fn">%s</cite>', get_comment_author_link() ); ?>
						</div>

						<div class="entry-meta comment-metadata">
							<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
								<time datetime="<?php comment_time( 'c' ); ?>" itemprop="datePublished">
									<?php
										printf(
											/* translators: 1: date, 2: time */
											_x( '%1$s at %2$s', '1: date, 2: time', 'generatepress' ), // phpcs:ignore
											get_comment_date(), // phpcs:ignore
											get_comment_time() // phpcs:ignore
										);
									?>
								</time>
							</a>
							<?php edit_comment_link( __( 'Edit', 'generatepress' ), '<span class="edit-link">| ', '</span>' ); ?>
						</div>
					</div>

					<?php if ( '0' == $comment->comment_approved ) : // phpcs:ignore ?>
						<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'generatepress' ); ?></p>
					<?php endif; ?>
				</footer>

				<div class="comment-content" itemprop="text">
					<?php
					/**
					 * generate_before_comment_content hook.
					 *
					 * @since 2.4
					 */
					do_action( 'generate_before_comment_text', $comment, $args, $depth );

					comment_text();

					/**
					 * generate_after_comment_content hook.
					 *
					 * @since 2.4
					 */
					do_action( 'generate_after_comment_text', $comment, $args, $depth );
					?>
				</div>
			</article>
			<?php
		endif;
	}
}

add_action( 'generate_after_comment_text', 'generate_do_comment_reply_link', 10, 3 );
/**
 * Add our comment reply link after the comment text.
 *
 * @since 2.4
 * @param object $comment The comment object.
 * @param array  $args The existing args.
 * @param int    $depth The thread depth.
 */
function generate_do_comment_reply_link( $comment, $args, $depth ) {
	comment_reply_link(
		array_merge(
			$args,
			array(
				'add_below' => 'div-comment',
				'depth'     => $depth,
				'max_depth' => $args['max_depth'],
				'before'    => '<span class="reply">',
				'after'     => '</span>',
			)
		)
	);
}

add_filter( 'comment_form_defaults', 'generate_set_comment_form_defaults' );
/**
 * Set the default settings for our comments.
 *
 * @since 2.3
 *
 * @param array $defaults The existing defaults.
 * @return array
 */
function generate_set_comment_form_defaults( $defaults ) {
	$defaults['comment_field'] = sprintf(
		'<p class="comment-form-comment"><label for="comment" class="screen-reader-text">%1$s</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required></textarea></p>',
		esc_html__( 'Comment', 'generatepress' )
	);

	$defaults['comment_notes_before'] = null;
	$defaults['comment_notes_after']  = null;
	$defaults['id_form']              = 'commentform';
	$defaults['id_submit']            = 'submit';
	$defaults['title_reply']          = apply_filters( 'generate_leave_comment', __( 'Leave a Comment', 'generatepress' ) );
	$defaults['label_submit']         = apply_filters( 'generate_post_comment', __( 'Post Comment', 'generatepress' ) );

	return $defaults;
}

add_filter( 'comment_form_default_fields', 'generate_filter_comment_fields' );
/**
 * Customizes the existing comment fields.
 *
 * @since 2.1.2
 * @param array $fields The existing fields.
 * @return array
 */
function generate_filter_comment_fields( $fields ) {
	$commenter = wp_get_current_commenter();
	$required = get_option( 'require_name_email' );

	$fields['author'] = sprintf(
		'<label for="author" class="screen-reader-text">%1$s</label><input placeholder="%1$s%3$s" id="author" name="author" type="text" value="%2$s" size="30" />',
		esc_html__( 'Name', 'generatepress' ),
		esc_attr( $commenter['comment_author'] ),
		$required ? ' *' : ''
	);

	$fields['email'] = sprintf(
		'<label for="email" class="screen-reader-text">%1$s</label><input placeholder="%1$s%3$s" id="email" name="email" type="email" value="%2$s" size="30" />',
		esc_html__( 'Email', 'generatepress' ),
		esc_attr( $commenter['comment_author_email'] ),
		$required ? ' *' : ''
	);

	$fields['url'] = sprintf(
		'<label for="url" class="screen-reader-text">%1$s</label><input placeholder="%1$s" id="url" name="url" type="url" value="%2$s" size="30" />',
		esc_html__( 'Website', 'generatepress' ),
		esc_attr( $commenter['comment_author_url'] )
	);

	return $fields;
}

add_action( 'generate_after_do_template_part', 'generate_do_comments_template', 15 );
/**
 * Add the comments template to pages and single posts.
 *
 * @since 3.0.0
 * @param string $template The template we're targeting.
 */
function generate_do_comments_template( $template ) {
	if ( 'single' === $template || 'page' === $template ) {
		// If comments are open or we have at least one comment, load up the comment template.
		// phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison -- Intentionally loose.
		if ( comments_open() || '0' != get_comments_number() ) :
			/**
			 * generate_before_comments_container hook.
			 *
			 * @since 2.1
			 */
			do_action( 'generate_before_comments_container' );
			?>

			<div class="comments-area">
				<?php comments_template(); ?>
			</div>

			<?php
		endif;
	}
}
