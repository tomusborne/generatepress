<?php
/**
 * Custom template tags for this theme.
 *
 * @package GeneratePress
 */
 
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'generate_paging_nav' ) ) :
/**
 * Build the pagination links
 * @since 1.3.35
 */
function generate_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => apply_filters( 'generate_pagination_mid_size', 1 ),
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&larr; Previous', 'generatepress' ),
		'next_text' => __( 'Next &rarr;', 'generatepress' ),
	) );

	if ( $links ) :

		echo $links; 

	endif;
}
endif;

if ( ! function_exists( 'generate_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function generate_content_nav( $nav_id ) {

	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';
	$category_specific = apply_filters( 'generate_category_post_navigation', false );

	?>
	<nav id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
		<h6 class="screen-reader-text"><?php _e( 'Post navigation', 'generatepress' ); ?></h6>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous"><span class="prev" title="' . __('Previous','generatepress') . '">%link</span></div>', '%title', $category_specific ); ?>
		<?php next_post_link( '<div class="nav-next"><span class="next" title="' . __('Next','generatepress') . '">%link</span></div>', '%title', $category_specific ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><span class="prev" title="<?php _e('Previous','generatepress');?>"><?php next_posts_link( __( 'Older posts', 'generatepress' ) ); ?></span></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><span class="next" title="<?php _e('Next','generatepress');?>"><?php previous_posts_link( __( 'Newer posts', 'generatepress' ) ); ?></span></div>
		<?php endif; ?>
		
		<?php generate_paging_nav(); ?>
		<?php do_action('generate_paging_navigation'); ?>

	<?php endif; ?>

	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif; // generate_content_nav

if ( ! function_exists( 'generate_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function generate_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	$args['avatar_size'] = apply_filters( 'generate_comment_avatar_size', 50 );

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:', 'generatepress' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'generatepress' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta">
				<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
				<div class="comment-author-info">
					<div class="comment-author vcard">
						<?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>
					</div><!-- .comment-author -->

					<div class="entry-meta comment-metadata">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<time datetime="<?php comment_time( 'c' ); ?>">
								<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'generatepress' ), get_comment_date(), get_comment_time() ); ?>
							</time>
						</a>
						<?php edit_comment_link( __( 'Edit', 'generatepress' ), '<span class="edit-link">| ', '</span>' ); ?>
						<?php
						comment_reply_link( array_merge( $args, array(
							'add_below' => 'div-comment',
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'before'    => '<span class="reply">| ',
							'after'     => '</span>',
						) ) );
						?>
					</div><!-- .comment-metadata -->
				</div><!-- .comment-author-info -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'generatepress' ); ?></p>
				<?php endif; ?>
			</footer><!-- .comment-meta -->

			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->
		</article><!-- .comment-body -->
	<?php
	endif;
}
endif; // ends check for generate_comment()

if ( ! function_exists( 'generate_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function generate_posted_on() 
{	
	$date = apply_filters( 'generate_post_date', true );
	$author = apply_filters( 'generate_post_author', true );
		
	$time_string = '<time class="entry-date published" datetime="%1$s" itemprop="datePublished">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) )
		$time_string .= '<time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);
	
	// If our date is enabled, show it
	if ( $date ) :
		printf( '<span class="posted-on">%1$s</span>',
			sprintf( '<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>',
				esc_url( get_permalink() ),
				esc_attr( get_the_time() ),
				$time_string
			)
		);
	endif;
	
	// If our author is enabled, show it
	if ( $author ) :
		printf( ' <span class="byline">%1$s</span>',
			sprintf( '<span class="author vcard" itemtype="http://schema.org/Person" itemscope="itemscope" itemprop="author">%1$s <a class="url fn n" href="%2$s" title="%3$s" rel="author" itemprop="url"><span class="author-name" itemprop="name">%4$s</span></a></span>',
				__( 'by','generatepress'),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( __( 'View all posts by %s', 'generatepress' ), get_the_author() ) ),
				esc_html( get_the_author() )
			)
		);
	endif;
	
}
endif;

if ( ! function_exists( 'generate_entry_meta' ) ) :
/**
 * Prints HTML with meta information for the categories, tags.
 *
 * @since 1.2.5
 */
function generate_entry_meta() 
{
	$categories = apply_filters( 'generate_show_categories', true );
	$tags = apply_filters( 'generate_show_tags', true );
	$comments = apply_filters( 'generate_show_comments', true );

	$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'generatepress' ) );
	if ( $categories_list && $categories ) {
		printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
			_x( 'Categories', 'Used before category names.', 'generatepress' ),
			$categories_list
		);
	}

	$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'generatepress' ) );
	if ( $tags_list && $tags ) {
		printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
			_x( 'Tags', 'Used before tag names.', 'generatepress' ),
			$tags_list
		);
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) && $comments ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'generatepress' ), __( '1 Comment', 'generatepress' ), __( '% Comments', 'generatepress' ) );
		echo '</span>';
	}
}
endif;

if ( ! function_exists( 'generate_excerpt_more' ) ) :
/**
 * Prints the read more HTML to post excerpts
 */
add_filter( 'excerpt_more', 'generate_excerpt_more' );
function generate_excerpt_more( $more ) {
	return ' ... <a title="' . esc_attr( get_the_title() ) . '" class="read-more" href="'. esc_url( get_permalink( get_the_ID() ) ) . '">' . __('Read more', 'generatepress') . '</a>';
}
endif;

if ( ! function_exists( 'generate_content_more' ) ) :
/**
 * Prints the read more HTML to post content using the more tag
 */
add_filter( 'the_content_more_link', 'generate_content_more' );
function generate_content_more( $more ) {
	$more_jump = apply_filters( 'generate_more_jump','#more-' . get_the_ID() );
	return '<p class="read-more-container"><a title="' . esc_attr( get_the_title() ) . '" class="read-more content-read-more" href="'. esc_url( get_permalink( get_the_ID() ) . $more_jump ) . '">' . __('Read more', 'generatepress') . '</a></p>';
}
endif;

if ( ! function_exists( 'generate_featured_page_header_area' ) ) :
/**
 * Build the page header
 * @since 1.0.7
 */
function generate_featured_page_header_area($class)
{
	// Don't run the function unless we're on a page it applies to
	if ( ! is_singular() )
		return;
		
	// Don't run the function unless we have a post thumbnail
	if ( ! has_post_thumbnail() )
		return;
		
	?>
	<div class="<?php echo esc_attr( $class ); ?> grid-container grid-parent">
		<?php the_post_thumbnail( apply_filters( 'generate_page_header_default_size', 'full' ), array('itemprop' => 'image') ); ?>
	</div>
	<?php
}
endif;

if ( ! function_exists( 'generate_featured_page_header' ) ) :
/**
 * Add page header above content
 * @since 1.0.2
 */
add_action('generate_after_header','generate_featured_page_header', 10);
function generate_featured_page_header()
{
	if ( function_exists('generate_page_header') )
		return;

	if ( is_page() ) :
		
		generate_featured_page_header_area('page-header-image');
	
	endif;
}
endif;

if ( ! function_exists( 'generate_featured_page_header_inside_single' ) ) :
/**
 * Add post header inside content
 * Only add to single post
 * @since 1.0.7
 */
add_action('generate_before_content','generate_featured_page_header_inside_single', 10);
function generate_featured_page_header_inside_single()
{
	if ( function_exists('generate_page_header') )
		return;

	if ( is_single() ) :
	
		generate_featured_page_header_area('page-header-image-single');
	
	endif;
}
endif;

if ( ! function_exists( 'generate_post_image' ) ) :
/**
 * Prints the Post Image to post excerpts
 */
add_action( 'generate_after_entry_header', 'generate_post_image' );
function generate_post_image()
{
	// If there's no featured image, return
	if ( ! has_post_thumbnail() )
		return;
		
	// If we're not on any single post/page or the 404 template, we must be showing excerpts
	if ( ! is_singular() && ! is_404() ) {
	?>
		<div class="post-image">
			<a href="<?php the_permalink();?>" title="<?php esc_attr( the_title() ); ?>"><?php the_post_thumbnail( apply_filters( 'generate_page_header_default_size', 'full' ), array('itemprop' => 'image') ); ?></a>
		</div>
	<?php
	}
}
endif;

if ( ! function_exists( 'generate_navigation_search' ) ) :
/**
 * Add the search bar to the navigation
 * @since 1.1.4
 */
add_action( 'generate_inside_navigation','generate_navigation_search');
function generate_navigation_search()
{
	$generate_settings = wp_parse_args( 
		get_option( 'generate_settings', array() ), 
		generate_get_defaults() 
	);
		
	if ( 'enable' !== $generate_settings['nav_search'] )
		return;
			
	?>
	<form method="get" class="search-form navigation-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input type="search" class="search-field" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php esc_attr( _ex( 'Search', 'label', 'generatepress' ) ); ?>">
	</form>
	<?php
}
endif;

if ( ! function_exists( 'generate_menu_search_icon' ) ) :
/**
 * Add search icon to primary menu if set
 *
 * @since 1.2.9.7
 */
add_filter( 'wp_nav_menu_items','generate_menu_search_icon', 10, 2 );
function generate_menu_search_icon( $nav, $args ) 
{
	$generate_settings = wp_parse_args( 
		get_option( 'generate_settings', array() ), 
		generate_get_defaults() 
	);
	
	// If the search icon isn't enabled, return the regular nav
	if ( 'enable' !== $generate_settings['nav_search'] )
		return $nav;
	
	// If our primary menu is set, add the search icon
    if( $args->theme_location == 'primary' )
        return $nav . '<li class="search-item" title="' . esc_attr_x( 'Search', 'submit button', 'generatepress' ) . '"><a href="#"><i class="fa fa-fw fa-search" aria-hidden="true"></i><span class="screen-reader-text">' . _x( 'Search', 'submit button', 'generatepress' ) . '</span></a></li>';
	
	// Our primary menu isn't set, return the regular nav
	// In this case, the search icon is added to the generate_menu_fallback() function in navigation.php
    return $nav;
}
endif;

if ( ! function_exists( 'generate_mobile_menu_search_icon' ) ) :
/**
 * Add search icon to mobile menu bar
 *
 * @since 1.3.12
 */
add_action( 'generate_inside_navigation','generate_mobile_menu_search_icon' );
function generate_mobile_menu_search_icon() 
{
	$generate_settings = wp_parse_args( 
		get_option( 'generate_settings', array() ), 
		generate_get_defaults() 
	);
	
	// If the search icon isn't enabled, return the regular nav
	if ( 'enable' !== $generate_settings['nav_search'] )
		return;
	
	?>
	<div class="mobile-bar-items">
		<?php do_action( 'generate_inside_mobile_menu_bar' ); ?>
		<span class="search-item" title="<?php esc_attr( _ex( 'Search', 'submit button', 'generatepress' ) ); ?>">
			<a href="#">
				<i class="fa fa-fw fa-search" aria-hidden="true"></i>
				<span class="screen-reader-text"><?php esc_attr( _ex( 'Search', 'submit button', 'generatepress' ) ); ?></span>
			</a>
		</span>
	</div><!-- .mobile-bar-items -->
	<?php
}
endif;

if ( ! function_exists( 'generate_categorized_blog' ) ) :
/**
 * Determine whether blog/site has more than one category.
 *
 * @since 1.2.5
 *
 * @return bool True of there is more than one category, false otherwise.
 */
function generate_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'generate_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'generate_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so twentyfifteen_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so twentyfifteen_categorized_blog should return false.
		return false;
	}
}
endif;

if ( ! function_exists( 'generate_category_transient_flusher' ) ) :
/**
 * Flush out the transients used in {@see generate_categorized_blog()}.
 *
 * @since 1.2.5
 */
add_action( 'edit_category', 'generate_category_transient_flusher' );
add_action( 'save_post',     'generate_category_transient_flusher' );
function generate_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'generate_categories' );
}
endif;

if ( ! function_exists( 'generate_get_link_url' ) ) :
/**
 * Return the post URL.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since 1.2.5
 *
 * @see get_url_in_content()
 *
 * @return string The Link format URL.
 */
function generate_get_link_url() {
	$has_url = get_url_in_content( get_the_content() );

	return $has_url ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}
endif;

if ( ! function_exists( 'generate_construct_header' ) ) :
/**
 * Build the header
 * @since 1.3.42
 */
add_action( 'generate_header','generate_construct_header' );
function generate_construct_header() {
	?>
	<header itemtype="http://schema.org/WPHeader" itemscope="itemscope" id="masthead" <?php generate_header_class(); ?>>
		<div <?php generate_inside_header_class(); ?>>
			<?php do_action( 'generate_before_header_content' ); ?>
			<?php generate_header_items(); ?>
			<?php do_action( 'generate_after_header_content' ); ?>
		</div><!-- .inside-header -->
	</header><!-- #masthead -->
	<?php
}
endif;

if ( ! function_exists( 'generate_header_items' ) ) :
/**
 * Build the header contents
 *
 * Wrapping this into a function allows us to customize the order
 *
 * @since 1.2.9.7
 */
function generate_header_items() 
{
	// Header widget
	generate_construct_header_widget();
	
	// Site title and tagline
	generate_construct_site_title();
	
	// Site logo
	generate_construct_logo();
}
endif;

if ( ! function_exists( 'generate_construct_logo' ) ) :
/**
 * Build the logo
 *
 * @since 1.3.28
 */
function generate_construct_logo()
{
	$generate_settings = wp_parse_args( 
		get_option( 'generate_settings', array() ), 
		generate_get_defaults() 
	);
	
	// Get our logo URL if we're using the custom logo
	$logo_url = ( function_exists( 'the_custom_logo' ) && get_theme_mod( 'custom_logo' ) ) ? wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' ) : false;
	
	// Get our logo from the custom logo or our GP setting
	$logo = ( $logo_url ) ? $logo_url[0] : $generate_settings['logo'];
	
	// If we don't have a logo, bail
	if ( empty( $logo ) )
		return;
	
	do_action( 'generate_before_logo' );
	
	// Print our HTML
	printf( 
		'<div class="site-logo">
			<a href="%1$s" title="%2$s" rel="home">
				<img class="header-image" src="%3$s" alt="%2$s" title="%2$s" />
			</a>
		</div>',
		apply_filters( 'generate_logo_href' , esc_url( home_url( '/' ) ) ),
		apply_filters( 'generate_logo_title', esc_attr( get_bloginfo( 'name', 'display' ) ) ),
		apply_filters( 'generate_logo', esc_url( $logo ) )
	);
	
	do_action( 'generate_after_logo' );
}
endif;

if ( ! function_exists( 'generate_construct_site_title' ) ) :
/**
 * Build the site title and tagline
 *
 * @since 1.3.28
 */
function generate_construct_site_title()
{
	$generate_settings = wp_parse_args( 
		get_option( 'generate_settings', array() ), 
		generate_get_defaults() 
	);
	
	// Get the title and tagline
	$title = get_bloginfo( 'title' );
	$tagline = get_bloginfo( 'description' );
	
	// If the disable title checkbox is checked, or the title field is empty, return true
	$disable_title = ( '1' == $generate_settings[ 'hide_title' ] || '' == $title ) ? true : false; 
	
	// If the disable tagline checkbox is checked, or the tagline field is empty, return true
	$disable_tagline = ( '1' == $generate_settings[ 'hide_tagline' ] || '' == $tagline ) ? true : false;
	
	// Site title and tagline
	if ( false == $disable_title || false == $disable_tagline ) : ?>
		<div class="site-branding">
			<?php if ( false == $disable_title ) : ?>
				<?php if ( is_front_page() && is_home() ) : ?>
					<h1 class="main-title" itemprop="headline"><a href="<?php echo apply_filters( 'generate_site_title_href', esc_url( home_url( '/' ) ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="main-title" itemprop="headline"><a href="<?php echo apply_filters( 'generate_site_title_href', esc_url( home_url( '/' ) ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php endif; ?>
			<?php endif;
				
			if ( false == $disable_tagline ) : ?>
				<p class="site-description"><?php echo html_entity_decode( get_bloginfo( 'description', 'display' ) ); ?></p>
			<?php endif; ?>
		</div>
	<?php endif;
}
endif;

if ( ! function_exists( 'generate_construct_header_widget' ) ) :
/**
 * Build the header widget
 *
 * @since 1.3.28
 */
function generate_construct_header_widget()
{
	if ( is_active_sidebar('header') ) : ?>
		<div class="header-widget">
			<?php dynamic_sidebar( 'header' ); ?>
		</div>
	<?php endif;
}
endif;

if ( ! function_exists( 'generate_back_to_top' ) ) :
/**
 * Build the back to top button
 *
 * @since 1.3.24
 */
add_action( 'wp_footer','generate_back_to_top' );
function generate_back_to_top()
{
	$generate_settings = wp_parse_args( 
		get_option( 'generate_settings', array() ), 
		generate_get_defaults() 
	);
	
	if ( 'enable' !== $generate_settings[ 'back_to_top' ] )
		return;
	
	$icon = apply_filters( 'generate_back_to_top_icon','fa-angle-up' );
	$scroll_speed = apply_filters( 'generate_back_to_top_scroll_speed', 400 );
	$start_scroll = apply_filters( 'generate_back_to_top_start_scroll', 300 );
	?>
	<a title="<?php esc_attr_e( 'Scroll back to top','generatepress' ); ?>" rel="nofollow" href="#" class="generate-back-to-top" style="opacity:0;visibility:hidden;" data-scroll-speed="<?php echo absint( $scroll_speed ); ?>" data-start-scroll="<?php echo absint( $start_scroll ); ?>"><i class="fa <?php echo esc_attr( $icon );?>" aria-hidden="true"></i><span class="screen-reader-text"><?php _e( 'Scroll back to top','generatepress' ); ?></span></a>
	<?php
}
endif;

if ( ! function_exists( 'generate_archive_title' ) ) :
/**
 * Build the archive title
 *
 * @since 1.3.24
 */
add_action( 'generate_archive_title','generate_archive_title' );
function generate_archive_title()
{
	?>
	<header class="page-header<?php if ( is_author() ) echo ' clearfix';?>">
		<?php do_action( 'generate_before_archive_title' ); ?>
		<h1 class="page-title">
			<?php
				if ( is_category() ) :
					single_cat_title();

				elseif ( is_tag() ) :
					single_tag_title();

				elseif ( is_author() ) :
					/* Queue the first post, that way we know
					 * what author we're dealing with (if that is the case).
					*/
					the_post();
					echo get_avatar( get_the_author_meta( 'ID' ), 75 );
					printf( '<span class="vcard">' . get_the_author() . '</span>' );
					/* Since we called the_post() above, we need to
					 * rewind the loop back to the beginning that way
					 * we can run the loop properly, in full.
					 */
					rewind_posts();

				elseif ( is_day() ) :
					printf( __( 'Day: %s', 'generatepress' ), '<span>' . get_the_date() . '</span>' );

				elseif ( is_month() ) :
					printf( __( 'Month: %s', 'generatepress' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

				elseif ( is_year() ) :
					printf( __( 'Year: %s', 'generatepress' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

				elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
					_e( 'Asides', 'generatepress' );

				elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
					_e( 'Images', 'generatepress');

				elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
					_e( 'Videos', 'generatepress' );

				elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
					_e( 'Quotes', 'generatepress' );

				elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
					_e( 'Links', 'generatepress' );

				else :
					_e( 'Archives', 'generatepress' );

				endif;
			?>
		</h1>
		<?php do_action( 'generate_after_archive_title' ); ?>
		<?php
			// Show an optional term description.
			$term_description = term_description();
			if ( ! empty( $term_description ) ) :
				printf( '<div class="taxonomy-description">%s</div>', $term_description );
			endif;
			
			if ( get_the_author_meta('description') && is_author() ) : // If a user has filled out their decscription show a bio on their entries
				echo '<div class="author-info">' . get_the_author_meta('description') . '</div>';
			endif;
		?>
		<?php do_action( 'generate_after_archive_description' ); ?>
	</header><!-- .page-header -->
	<?php
}
endif;

if ( ! function_exists( 'generate_post_meta' ) ) :
/**
 * Build the post meta
 *
 * @since 1.3.29
 */
add_action( 'generate_after_entry_title', 'generate_post_meta' );
function generate_post_meta()
{
	if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php generate_posted_on(); ?>
		</div><!-- .entry-meta -->
	<?php endif;
}
endif;

if ( ! function_exists( 'generate_footer_meta' ) ) :
/**
 * Build the footer post meta
 *
 * @since 1.3.30
 */
add_action( 'generate_after_entry_content', 'generate_footer_meta' );
function generate_footer_meta()
{
	if ( 'post' == get_post_type() ) : ?>
		<footer class="entry-meta">
			<?php generate_entry_meta(); ?>
			<?php if ( is_single() ) generate_content_nav( 'nav-below' ); ?>
		</footer><!-- .entry-meta -->
	<?php endif;
}
endif;

if ( ! function_exists( 'generate_pingback_header' ) ) :
/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 * @since 1.3.42
 */
add_action( 'wp_head', 'generate_pingback_header' );
function generate_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
endif;

if ( ! function_exists( 'generate_construct_footer_widgets' ) ) :
/**
 * Build our footer widgets
 * @since 1.3.42
 */
add_action( 'generate_footer','generate_construct_footer_widgets', 5 );
function generate_construct_footer_widgets() {
	// Get how many widgets to show
	$widgets = generate_get_footer_widgets();
	
	if ( !empty( $widgets ) && 0 !== $widgets ) : 
	
		// Set up the widget width
		$widget_width = '';
		if ( $widgets == 1 ) $widget_width = '100';
		if ( $widgets == 2 ) $widget_width = '50';
		if ( $widgets == 3 ) $widget_width = '33';
		if ( $widgets == 4 ) $widget_width = '25';
		if ( $widgets == 5 ) $widget_width = '20';
		?>
		<div id="footer-widgets" class="site footer-widgets">
			<div <?php generate_inside_footer_class(); ?>>
				<div class="inside-footer-widgets">
					<?php if ( $widgets >= 1 ) : ?>
						<div class="footer-widget-1 grid-parent grid-<?php echo absint( apply_filters( 'generate_footer_widget_1_width', $widget_width ) ); ?> tablet-grid-<?php echo absint( apply_filters( 'generate_footer_widget_1_tablet_width', '50' ) ); ?> mobile-grid-100">
							<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-1')): ?>
								<aside class="widget inner-padding widget_text">
									<h4 class="widget-title"><?php _e('Footer Widget 1','generatepress');?></h4>			
									<div class="textwidget">
										<p><?php printf( __( 'Replace this widget content by going to <a href="%1$s"><strong>Appearance / Widgets</strong></a> and dragging widgets into this widget area.','generatepress' ), esc_url( admin_url( 'widgets.php' ) ) ); ?></p>
										<p><?php printf( __( 'To remove or choose the number of footer widgets, go to <a href="%1$s"><strong>Appearance / Customize / Layout / Footer Widgets</strong></a>.','generatepress' ), esc_url( admin_url( 'customize.php' ) ) ); ?></p>
									</div>
								</aside>
							<?php endif; ?>
						</div>
					<?php endif;
					
					if ( $widgets >= 2 ) : ?>
					<div class="footer-widget-2 grid-parent grid-<?php echo absint( apply_filters( 'generate_footer_widget_2_width', $widget_width ) ); ?> tablet-grid-<?php echo absint( apply_filters( 'generate_footer_widget_2_tablet_width', '50' ) ); ?> mobile-grid-100">
						<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-2')): ?>
							<aside class="widget inner-padding widget_text">
								<h4 class="widget-title"><?php _e('Footer Widget 2','generatepress');?></h4>			
								<div class="textwidget">
									<p><?php printf( __( 'Replace this widget content by going to <a href="%1$s"><strong>Appearance / Widgets</strong></a> and dragging widgets into this widget area.','generatepress' ), esc_url( admin_url( 'widgets.php' ) ) ); ?></p>
									<p><?php printf( __( 'To remove or choose the number of footer widgets, go to <a href="%1$s"><strong>Appearance / Customize / Layout / Footer Widgets</strong></a>.','generatepress' ), esc_url( admin_url( 'customize.php' ) ) ); ?></p>
								</div>
							</aside>
						<?php endif; ?>
					</div>
					<?php endif;
					
					if ( $widgets >= 3 ) : ?>
					<div class="footer-widget-3 grid-parent grid-<?php echo absint( apply_filters( 'generate_footer_widget_3_width', $widget_width ) ); ?> tablet-grid-<?php echo absint( apply_filters( 'generate_footer_widget_3_tablet_width', '50' ) ); ?> mobile-grid-100">
						<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-3')): ?>
							<aside class="widget inner-padding widget_text">
								<h4 class="widget-title"><?php _e('Footer Widget 3','generatepress');?></h4>			
								<div class="textwidget">
									<p><?php printf( __( 'Replace this widget content by going to <a href="%1$s"><strong>Appearance / Widgets</strong></a> and dragging widgets into this widget area.','generatepress' ), esc_url( admin_url( 'widgets.php' ) ) ); ?></p>
									<p><?php printf( __( 'To remove or choose the number of footer widgets, go to <a href="%1$s"><strong>Appearance / Customize / Layout / Footer Widgets</strong></a>.','generatepress' ), esc_url( admin_url( 'customize.php' ) ) ); ?></p>
								</div>
							</aside>
						<?php endif; ?>
					</div>
					<?php endif;
					
					if ( $widgets >= 4 ) : ?>
					<div class="footer-widget-4 grid-parent grid-<?php echo absint( apply_filters( 'generate_footer_widget_4_width', $widget_width ) ); ?> tablet-grid-<?php echo absint( apply_filters( 'generate_footer_widget_4_tablet_width', '50' ) ); ?> mobile-grid-100">
						<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-4')): ?>
							<aside class="widget inner-padding widget_text">
								<h4 class="widget-title"><?php _e('Footer Widget 4','generatepress');?></h4>			
								<div class="textwidget">
									<p><?php printf( __( 'Replace this widget content by going to <a href="%1$s"><strong>Appearance / Widgets</strong></a> and dragging widgets into this widget area.','generatepress' ), esc_url( admin_url( 'widgets.php' ) ) ); ?></p>
									<p><?php printf( __( 'To remove or choose the number of footer widgets, go to <a href="%1$s"><strong>Appearance / Customize / Layout / Footer Widgets</strong></a>.','generatepress' ), esc_url( admin_url( 'customize.php' ) ) ); ?></p>
								</div>
							</aside>
						<?php endif; ?>
					</div>
					<?php endif;
					
					if ( $widgets >= 5 ) : ?>
					<div class="footer-widget-5 grid-parent grid-<?php echo absint( apply_filters( 'generate_footer_widget_5_width', $widget_width ) ); ?> tablet-grid-<?php echo absint( apply_filters( 'generate_footer_widget_5_tablet_width', '50' ) ); ?> mobile-grid-100">
						<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-5')): ?>
							<aside class="widget inner-padding widget_text">
								<h4 class="widget-title"><?php _e('Footer Widget 5','generatepress');?></h4>			
								<div class="textwidget">
									<p><?php printf( __( 'Replace this widget content by going to <a href="%1$s"><strong>Appearance / Widgets</strong></a> and dragging widgets into this widget area.','generatepress' ), esc_url( admin_url( 'widgets.php' ) ) ); ?></p>
									<p><?php printf( __( 'To remove or choose the number of footer widgets, go to <a href="%1$s"><strong>Appearance / Customize / Layout / Footer Widgets</strong></a>.','generatepress' ), esc_url( admin_url( 'customize.php' ) ) ); ?></p>
								</div>
							</aside>
						<?php endif; ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php
	endif;
	do_action( 'generate_after_footer_widgets' );
}
endif;

if ( ! function_exists( 'generate_construct_footer' ) ) :
/**
 * Build our footer
 * @since 1.3.42
 */
add_action( 'generate_footer','generate_construct_footer' );
function generate_construct_footer() {
	?>
	<footer class="site-info" itemtype="http://schema.org/WPFooter" itemscope="itemscope">
		<div class="inside-site-info <?php if ( 'full-width' !== generate_get_setting( 'footer_inner_width' ) ) : ?>grid-container grid-parent<?php endif; ?>">
			<?php do_action( 'generate_before_copyright' ); ?>
			<div class="copyright-bar">
				<?php do_action( 'generate_credits' ); ?>
			</div>
		</div>
	</footer><!-- .site-info -->
	<?php
}
endif;

if ( ! function_exists( 'generate_footer_bar' ) ) :
/**
 * Build our footer bar
 * @since 1.3.42
 */
add_action( 'generate_before_copyright','generate_footer_bar', 15 );
function generate_footer_bar() {
	if ( ! is_active_sidebar( 'footer-bar' ) )
		return;
	?>
	<div class="footer-bar">
		<?php dynamic_sidebar( 'footer-bar' ); ?>
	</div>
	<?php
}
endif;