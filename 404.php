<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package GeneratePress
 */

get_header(); ?>


	<div id="primary" <?php generate_content_class(); ?>>
		<main id="main" <?php generate_main_class(); ?>>
			<?php do_action('generate_before_main_content'); ?>
			<div class="inside-article">
				<?php do_action( 'generate_before_content'); ?>
				<header class="entry-header">
					<h1 class="entry-title" itemprop="headline"><?php echo apply_filters( 'generate_404_title', __( 'Oops! That page can&rsquo;t be found.', 'generatepress' ) ); ?></h1>
				</header><!-- .entry-header -->
				<?php do_action( 'generate_after_entry_header'); ?>
				<div class="entry-content" itemprop="text">
					<p>
						<?php echo apply_filters( 'generate_404_text', __( 'It looks like nothing was found at this location. Maybe try searching?', 'generatepress' ) ); ?>
					</p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
				<?php do_action( 'generate_after_content'); ?>
			</div><!-- .inside-article -->
			<?php do_action('generate_after_main_content'); ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php 
do_action('generate_sidebars');
get_footer(); 