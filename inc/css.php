<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'GeneratePress_CSS' ) ) :
class GeneratePress_CSS {

	protected $_selector = '';
	protected $_selector_output = '';
	protected $_css = '';
	protected $_output = '';

	public function set_selector( $selector = '' )
	{
		// Render the css in the output string everytime the selector changes
		if( $this->_selector !== '' ){
			$this->add_selector_rules_to_output();
		}
		$this->_selector = $selector;
		return $this;
	}

	public function add_property( $property, $value, $og_default = false, $unit = false )
	{
		// Make sure our defaults.css file exists
		if ( ! wp_style_is( 'generate-defaults', 'enqueued' ) ) {
			$og_default = false;
		}
		
		// If we don't have a value or our value is the same as our og default, bail
		if ( empty( $value ) || $og_default == $value )
			return false;
		
		$this->_css .= $property . ':' . $value . $unit . ';';
		return $this;
	}

	private function add_selector_rules_to_output()
	{
		if( !empty( $this->_css ) ) {
			$this->_selector_output = $this->_selector;
			$selector_output = sprintf( '%1$s{%2$s}', $this->_selector_output, $this->_css );
			
			// Add our CSS to the output if it doesn't already exist
			if (strpos($this->_output, $selector_output) === FALSE) {
				$this->_output .= $selector_output;
			}

			// Reset the css
			$this->_css = '';
		}

		return $this;
	}

	public function css_output()
	{
		// Add current selector's rules to output
		$this->add_selector_rules_to_output();

		// Output minified css
		return $this->_output;
	}

}
endif;