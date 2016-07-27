<?php
if ( ! function_exists( 'generate_disable_elements' ) ) :
/**
 * Add any necessary CSS for disabling these elements
 * The function_exists call above is different from the function name
 * This is so the plugin function generate_disable_elements() is taken ahead of this function
 * @since 1.3.18
 */
function generate_disable_elements_css()
{
	// Don't run the function unless we're on a page it applies to
	if ( ! is_singular() )
		return;
	
	// Get the post
	global $post;
	
	// Get our option
	$disable_headline = ( isset( $post ) ) ? get_post_meta( $post->ID, '_generate-disable-headline', true ) : '';
	
	// Set up our return variable
	$return = '';
	
	// If our option is set, get the CSS
	if ( ( !empty( $disable_headline ) && false !== $disable_headline ) && ! is_single() ) :
		$return .= '.entry-header {display:none} .page-content, .entry-content, .entry-summary {margin-top:0}';
	endif;
	
	// Print our CSS
	return $return;
}
endif;

if ( ! function_exists( 'generate_de_scripts' ) ) :
/**
 * Add CSS to wp_head
 * @since 1.3.18
 */
add_action( 'wp_enqueue_scripts', 'generate_de_scripts', 50 );
function generate_de_scripts() 
{
	wp_add_inline_style( 'generate-style', generate_disable_elements_css() );
}
endif;

if ( !function_exists('generate_add_de_meta_box') ) :
/**
 * Create the metabox
 * @since 1.3.18
 */
add_action( 'add_meta_boxes', 'generate_add_de_meta_box' );
function generate_add_de_meta_box() 
{
	$post_types = get_post_types();
	foreach ($post_types as $type) {
		add_meta_box
		(  
			'generate_de_meta_box',
			__('Disable Elements','generatepress'),
			'generate_show_de_meta_box',
			$type,
			'side',
			'default'
		); 
	}
}  
endif;

if ( !function_exists( 'generate_show_de_meta_box' ) ) :
/**
 * Build our metabox
 * @since 1.3.18
 */
function generate_show_de_meta_box( $post ) 
{
    wp_nonce_field( basename( __FILE__ ), 'generate_de_nonce' );
    $stored_meta = get_post_meta( $post->ID );
	$stored_meta['_generate-disable-headline'][0] = ( isset( $stored_meta['_generate-disable-headline'][0] ) ) ? $stored_meta['_generate-disable-headline'][0] : '';
    ?>
	<div class="generate_disable_elements">
		<label for="meta-generate-disable-headline" style="display:block;margin: 1em 0;" title="<?php _e( 'Content Title','generatepress' );?>">
			<input type="checkbox" name="_generate-disable-headline" id="meta-generate-disable-headline" value="true" <?php checked( $stored_meta['_generate-disable-headline'][0], 'true' ); ?>>
			<?php _e( 'Content Title','generatepress' );?>
		</label>
		<?php if ( generate_addons_available() ) : ?>
			<span style="display:block;padding-top:1em;border-top:1px solid #EFEFEF;">
				<a href="<?php echo esc_url('https://generatepress.com/downloads/generate-disable-elements');?>" target="_blank"><?php _e( 'Add-on available', 'generatepress' ); ?></a>
			</span>
		<?php endif; ?>
	</div>
    <?php
}
endif;

if ( !function_exists( 'generate_save_de_meta' ) ) :
/**
 * Save our metabox data
 * @since 1.3.18
 */
add_action( 'save_post', 'generate_save_de_meta' );
function generate_save_de_meta( $post_id ) 
{  
	// Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'generate_de_nonce' ] ) && wp_verify_nonce( $_POST[ 'generate_de_nonce' ], basename( __FILE__ ) ) ) ? true : false;
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
        return;
    }
	
	$key   = '_generate-disable-headline';
	$value = filter_input( INPUT_POST, $key, FILTER_SANITIZE_STRING );

	if ( $value )
		update_post_meta( $post_id, $key, $value );
	else
		delete_post_meta( $post_id, $key );
}  
endif;

if ( ! function_exists( 'generate_disable_title' ) ) :
/**
 * Remove our title if set
 * @since 1.3.18
 */
add_filter( 'generate_show_title', 'generate_disable_title' );
function generate_disable_title()
{
	// Get our post
	global $post;
	
	// Get our option
	$disable_headline = ( isset( $post ) ) ? get_post_meta( $post->ID, '_generate-disable-headline', true ) : '';
	
	// If our option is set, disable the title
	if ( ! empty( $disable_headline ) && false !== $disable_headline ) :
		return false;
	endif;
	
	// If we've reached this point, our option is not set, so we should continue to show our title
	return true;
}
endif;