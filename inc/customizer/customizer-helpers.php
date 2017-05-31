<?php
defined( 'WPINC' ) or die;

// Controls
require trailingslashit( dirname( __FILE__ ) ) . 'controls/class-range-control.php';
require trailingslashit( dirname( __FILE__ ) ) . 'controls/class-typography-control.php';
require trailingslashit( dirname( __FILE__ ) ) . 'controls/class-upsell-section.php';
require trailingslashit( dirname( __FILE__ ) ) . 'controls/class-upsell-control.php';
require trailingslashit( dirname( __FILE__ ) ) . 'controls/class-deprecated.php';

// Helper functions
require trailingslashit( dirname( __FILE__ ) ) . 'helpers.php';

// Deprecated
require trailingslashit( dirname( __FILE__ ) ) . 'deprecated.php';