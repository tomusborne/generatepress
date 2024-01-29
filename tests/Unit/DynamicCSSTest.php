<?php

namespace GeneratePress\Tests\Unit;
use \GeneratePress\Tests\GPTestCase;

final class DynamicCSSTest extends GPTestCase {
	public function testOutputCss() {
		$css = new \GeneratePress_CSS();
		$css->set_selector( '.test-class' );
		$css->add_property( 'background', '#000' );
		$css->add_property( 'color', '#fff' );
		$css->add_property( 'padding', '10px 20px 30px 40px' );

		$actual = $css->css_output();
		$expected_css = '.test-class{background:#000;color:#fff;padding:10px 20px 30px 40px;}';

		$this->assertEquals( $expected_css, $actual );
	}

	public function testShorthandValues() {
		$css = new \GeneratePress_CSS();
		$css->set_selector( '.test-class' );
		$css->add_property( 'padding', generate_padding_css( '10', '20', '30', '40' ), false, 'px' );
		$css->add_property( 'margin', generate_padding_css( '10', '0', '10', '0' ), false, 'px' );

		$actual = $css->css_output();
		$expected_css = '.test-class{padding:10px 20px 30px 40px;margin:10px 0px 10px 0px;}';

		$this->assertEquals( $expected_css, $actual );
	}

	public function testLonghandValues() {
		$css = new \GeneratePress_CSS();
		$css->set_selector( '.test-class' );
		$css->add_property( 'padding', generate_padding_css( '10', '', '30', '40' ), false, 'px' );

		$actual = $css->css_output();
		$expected_css = '.test-class{padding:10px 0px 30px 40px;}';

		$this->assertEquals( $expected_css, $actual );
	}

	public function testNumberValues() {
		$css = new \GeneratePress_CSS();
		$css->set_selector( '.test-class' );
		$css->add_property( 'font-size', '10px', false, 'em' );
		$css->add_property( 'letter-spacing', '1', false, 'px' );
		$css->add_property( 'line-height', '1' );

		$actual = $css->css_output();
		$expected_css = '.test-class{font-size:10px;letter-spacing:1px;line-height:1;}';

		$this->assertEquals( $expected_css, $actual );
	}
}
