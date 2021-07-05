<?php
/**
 * The template for displaying 404 pages.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div class="inside-article">

	<?php
	/**
	 * generate_before_content hook.
	 *
	 * @since 0.1
	 *
	 * @hooked generate_featured_page_header_inside_single - 10
	 */
	do_action( 'generate_before_content' );
	?>

	<header <?php generate_do_attr( 'entry-header' ); ?>>
		<?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- HTML is allowed in filter here. ?>
		<h1 class="entry-title" itemprop="headline"><?php echo apply_filters( 'generate_404_title', __( 'Oops! That page can&rsquo;t be found.', 'generatepress' ) ); ?></h1>
	</header>

	<?php
	/**
	 * generate_after_entry_header hook.
	 *
	 * @since 0.1
	 *
	 * @hooked generate_post_image - 10
	 */
	do_action( 'generate_after_entry_header' );

	$itemprop = '';

	if ( 'microdata' === generate_get_schema_type() ) {
		$itemprop = ' itemprop="text"';
	}
	?>

	<div class="entry-content"<?php echo $itemprop; // phpcs:ignore -- No escaping needed. ?>>
		<?php
		printf(
			'<p>%s</p>',
			apply_filters( 'generate_404_text', __( 'It looks like nothing was found at this location. Maybe try searching?', 'generatepress' ) ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- HTML is allowed in filter here.
		);

		get_search_form();
		?>
	</div>

	<?php
	/**
	 * generate_after_content hook.
	 *
	 * @since 0.1
	 */
	do_action( 'generate_after_content' );
	?>

</div>
