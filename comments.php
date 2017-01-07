<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to generate_comment() which is
 * located in the inc/template-tags.php file.
 *
 * @package GeneratePress
 */
 
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

	<div id="comments">

	<?php do_action( 'generate_inside_comments' ); ?>

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php					
				$comments_number = get_comments_number();
				if ( 1 === $comments_number ) {
					printf(
						/* translators: %s: post title */
						esc_html_x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'generatepress' ),
						'<span>' . get_the_title() . '</span>'
					);
				} else {
					printf( // WPCS: XSS OK.
						/* translators: 1: number of comments, 2: post title */
						esc_html( _nx(
							'%1$s thought on &ldquo;%2$s&rdquo;',
							'%1$s thoughts on &ldquo;%2$s&rdquo;',
							$comments_number,
							'comments title',
							'generatepress'
						) ),
						number_format_i18n( $comments_number ),
						'<span>' . get_the_title() . '</span>'
					);
				}
			?>
		</h3>
		
		<?php do_action( 'generate_below_comments_title' ); ?>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'generatepress' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'generatepress' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'generatepress' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ol class="comment-list">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use generate_comment() to format the comments.
				 * If you want to override this in a child theme, then you can
				 * define generate_comment() and that will be used instead.
				 * See generate_comment() in inc/template-tags.php for more.
				 */
				wp_list_comments( array( 
					'callback' => 'generate_comment'
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'generatepress' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'generatepress' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'generatepress' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'generatepress' ); ?></p>
	<?php endif;

	$commenter = wp_get_current_commenter();
	$fields = array(
		'author' => '<input placeholder="' . __( 'Name','generatepress' ) . ' *" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" />',
		'email' => '<input placeholder="' . __( 'Email','generatepress' ) . ' *" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" />',
		'url' => '<input placeholder="' . __( 'Website','generatepress' ) . '" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />',
	);
	$defaults = array(
		'fields'		=> apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
		'must_log_in' 	=> '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%1$s">logged in</a> to post a comment.','generatepress' ), wp_login_url( get_permalink() ) ) . '</p>',
		'logged_in_as'	=> '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" class="comment-logout" title="Log out of this account">Log out?</a>','generatepress' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( get_permalink() ) ) . '</p>',
		'comment_notes_before' => null,
		'comment_notes_after'  => null,
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'title_reply'          => apply_filters( 'generate_leave_comment', __( 'Leave a Comment','generatepress' ) ),
		'title_reply_to'       => apply_filters( 'generate_leave_reply', __( 'Leave a Reply to %s','generatepress' ) ),
		'cancel_reply_link'    => apply_filters( 'generate_cancel_reply', __( 'Cancel reply','generatepress' ) ),
		'label_submit'         => apply_filters( 'generate_post_comment', __( 'Post Comment','generatepress' ) ),
	);
	comment_form($defaults); 
	?>

</div><!-- #comments -->
