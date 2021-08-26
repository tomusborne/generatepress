<?php

/**
 * The migration for the new Typography system.
 * It will update old settings to the new version.
 */
class GeneratePress_Typography_System_Migration extends GeneratePress_Abstract_Migration
{
	protected $version = '3.1.0-alpha-1';

	public function run()
	{
		$current_settings = $this->get_settings();

		$current_settings['font_manager'][] = [
			"fontFamily" => "Lato",
			"googleFont" => true,
			"googleFontApi" => 1,
			"googleFontCategory" => "sans-serif",
			"googleFontVariants" => "100, 100italic, 300, 300italic, regular, italic, 700, 700italic, 900, 900italic"
		];

		$current_settings['typography'][] = [
			"selector" => "body",
			"customSelector" => "",
			"fontFamily" => "Lato",
			"fontWeight" => "",
			"textTransform" => "",
			"fontSize" => 18,
			"fontSizeTablet" => "",
			"fontSizeMobile" => "",
			"fontSizeUnit" => "px",
			"lineHeight" => "",
			"lineHeightTablet" => "",
			"lineHeightMobile" => "",
			"lineHeightUnit" => "",
			"letterSpacing" => "",
			"letterSpacingTablet" => "",
			"letterSpacingMobile" => "",
			"letterSpacingUnit" => "px",
			"marginBottomUnit" => "em",
			"module" => "core",
			"group" => "base"
		];

		$this->update_settings( $current_settings );
	}
}
