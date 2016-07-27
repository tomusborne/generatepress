<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package GeneratePress
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php generate_article_schema( 'CreativeWork' ); ?>>
	<div class="inside-article">
		<?php do_action( 'generate_before_content'); ?>
		
		<?php if ( generate_show_title() ) : ?>
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>
			</header><!-- .entry-header -->
		<?php endif; ?>
		
		<?php do_action( 'generate_after_entry_header'); ?>
		<div class="entry-content" itemprop="text">
			<?php the_content(); ?>
			<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'generatepress' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->
		<?php do_action( 'generate_after_content'); ?>
	</div><!-- .inside-article -->
</article><!-- #post-## -->
