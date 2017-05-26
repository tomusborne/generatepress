<?php
defined( 'WPINC' ) or die;

// Controls
require trailingslashit( dirname( __FILE__ ) ) . 'controls/class-range-control.php';
require trailingslashit( dirname( __FILE__ ) ) . 'controls/class-typography-control.php';
require trailingslashit( dirname( __FILE__ ) ) . 'controls/class-upsell-section.php';
require trailingslashit( dirname( __FILE__ ) ) . 'controls/class-upsell-control.php';
require trailingslashit( dirname( __FILE__ ) ) . 'controls/class-deprecated.php';

// Sanitize
require trailingslashit( dirname( __FILE__ ) ) . 'sanitize.php';

// Deprecated
require trailingslashit( dirname( __FILE__ ) ) . 'deprecated.php';