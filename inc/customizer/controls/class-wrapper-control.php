<?php
/**
 * Customize API: Wrapper class.
 *
 * @package GeneratePress
 */

/**
 * Customize Wrapper Control class.
 *
 * @see WP_Customize_Control
 */
class GeneratePress_Customize_Wrapper_Control extends WP_Customize_Control {
	/**
	 * Type.
	 *
	 * @access public
	 * @since 1.0.0
	 * @var string
	 */
	public $type = 'generate-wrapper-control';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @since 3.4.0
	 * @uses WP_Customize_Control::to_json()
	 */
	public function to_json() {
		parent::to_json();
		$this->json['choices'] = $this->choices;
	}

	/**
	 * Empty JS template.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	public function content_template() {}

	/**
	 * Empty PHP template.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	public function render_content() {
		$html_attributes = array(
			'class' => 'generate-customize-control-wrapper',
			'id'    => $this->id,
			'data-wrapper-type' => $this->choices['type'],
		);

		if ( ! empty( $this->choices['class'] ) ) {
			$html_attributes['class'] .= ' ' . $this->choices['class'];
		}

		$attributes_string = '';

		foreach ( $html_attributes as $attribute => $value ) {
			$attributes_string .= $attribute . '="' . esc_attr( $value ) . '" ';
		}

		$this->toggleIdScript();
		?>
		<div <?php echo $attributes_string; // phpcs:ignore -- Escaped above. ?>>
			<?php
			foreach ( $this->choices['items'] as $wrapper ) {
				?>
				<div id="<?php echo esc_attr( $wrapper . '--wrapper' ); ?>"></div>
				<?php
			}
			?>
		</div>
		<?php
	}

	/**
	 * Add a script to toggle the wrapper.
	 */
	public function toggleIdScript() {
		if ( ! empty( $this->choices['toggleId'] ) ) :
			?>
			<script>
				var liElement = document.getElementById( 'customize-control-<?php echo esc_js( $this->id ); ?>' );

				if ( liElement ) {
					liElement.setAttribute('data-toggleId', '<?php echo esc_attr( $this->choices['toggleId'] ); ?>');
				}
			</script>
			<?php
		endif;
	}
}
