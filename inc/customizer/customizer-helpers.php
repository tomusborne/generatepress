<?php
// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Controls
require_once trailingslashit( dirname( __FILE__ ) ) . 'controls/class-range-control.php';
require_once trailingslashit( dirname( __FILE__ ) ) . 'controls/class-typography-control.php';
require_once trailingslashit( dirname( __FILE__ ) ) . 'controls/class-upsell-section.php';
require_once trailingslashit( dirname( __FILE__ ) ) . 'controls/class-upsell-control.php';
require_once trailingslashit( dirname( __FILE__ ) ) . 'controls/class-deprecated.php';

// Helper functions
require_once trailingslashit( dirname( __FILE__ ) ) . 'helpers.php';

// Deprecated
require_once trailingslashit( dirname( __FILE__ ) ) . 'deprecated.php';
