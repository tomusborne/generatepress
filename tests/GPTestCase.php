<?php
namespace GeneratePress\Tests;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;
use Brain\Monkey;

class GPTestCase extends TestCase {
	use MockeryPHPUnitIntegration;

	protected function setUp(): void {
		parent::setUp();
		Monkey\setUp();

		global $wp_version;
        $wp_version = 'mocked_version';

		Monkey\Functions\stubs(
			[
				'wp_parse_args'        => static function ( $settings, $defaults ) {
					return \array_merge( $defaults, $settings );
				},
				'wp_strip_all_tags'    => static function( $string, $remove_breaks = false ) {
					$string = \preg_replace( '@<(script|style)[^>]*?>.*?</\\1>@si', '', $string );
					$string = \strip_tags( $string );
					if ( $remove_breaks ) {
						$string = \preg_replace( '/[\r\n\t ]+/', ' ', $string );
					}
					return \trim( $string );
				},
				'get_option' => static function( $option, $default ) {
					return $default;
				},
				'is_rtl' => static function() {
					return false;
				},
				'__' => null,
			]
		);
	}

	protected function tearDown(): void {
		parent::tearDown();
		Monkey\tearDown();
	}
}
