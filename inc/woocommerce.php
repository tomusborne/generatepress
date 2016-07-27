<?php
/** 
 * Remove default WooCommerce wrappers
 * @since 1.3.22
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
add_action('woocommerce_sidebar','generate_construct_sidebars');

/** 
 * Add WooCommerce starting wrappers
 * @since 1.3.22
 */
add_action('woocommerce_before_main_content', 'generate_woocommerce_start', 10);
function generate_woocommerce_start() 
{ ?>
	<div id="primary" <?php generate_content_class();?>>
		<main id="main" <?php generate_main_class(); ?>>
			<?php do_action('generate_before_main_content'); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php generate_article_schema( 'CreativeWork' ); ?>>
				<div class="inside-article">
					<?php do_action( 'generate_before_content'); ?>
					<div class="entry-content" itemprop="text">
<?php }

/** 
 * Add WooCommerce ending wrappers
 * @since 1.3.22
 */
add_action('woocommerce_after_main_content', 'generate_woocommerce_end', 10);
function generate_woocommerce_end() 
{
?>
					</div><!-- .entry-content -->
					<?php do_action( 'generate_after_content'); ?>
				</div><!-- .inside-article -->
			</article><!-- #post-## -->
			<?php do_action('generate_after_main_content'); ?>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
}