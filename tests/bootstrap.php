<?php
/**
 * Test bootstrap file.
 */

require_once dirname( __DIR__ ) . '/vendor/autoload.php';

use Brain\Monkey;

// Set up BrainMonkey before including any other files
Monkey\setUp();

// These need to run after setup so we can mock functions within them.
require_once dirname( __DIR__ ) . '/inc/theme-functions.php';
require_once dirname( __DIR__ ) . '/inc/defaults.php';
