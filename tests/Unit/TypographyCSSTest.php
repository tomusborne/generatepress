<?php
namespace GeneratePress\Tests\Unit;
use \GeneratePress\Tests\GPTestCase;
use \Brain\Monkey;

final class TypographyCSSTest extends GPTestCase {
	public function testSeparateUnits() {
		Monkey\Functions\expect('generate_get_option')
            ->with('typography')
            ->once()
            ->andReturn(
				[
					[
						'module' => 'core',
						'selector' => 'main-title',
						'fontSize' => 13,
						'fontSizeUnit' => 'px',
						'lineHeight' => 1.5,
					],
				]
			);

		$css = \GeneratePress_Typography::get_css();
		$this->assertEquals( $css, '.main-title{font-size:13px;line-height:1.5;}' );
	}

	public function testIncludedUnits() {
		Monkey\Functions\expect('generate_get_option')
            ->with('typography')
            ->once()
            ->andReturn(
				[
					[
						'module' => 'core',
						'selector' => 'main-title',
						'fontSize' => '13px',
						'fontSizeUnit' => '',
						'lineHeight' => '1.5',
						'lineHeightUnit' => '',
						'letterSpacing' => '1px',
						'letterSpacingUnit' => '',
					],
				]
			);

		$css = \GeneratePress_Typography::get_css();
		$this->assertEquals( $css, '.main-title{font-size:13px;letter-spacing:1px;line-height:1.5;}' );
	}
}
