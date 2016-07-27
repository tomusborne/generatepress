<?php
/**
 * Display the classes for the sidebar.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 */
function generate_right_sidebar_class( $class = '' ) {
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', generate_get_right_sidebar_class( $class ) ) . '"';
}

/**
 * Retrieve the classes for the sidebar.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 */
function generate_get_right_sidebar_class( $class = '' ) {

	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);

	return apply_filters('generate_right_sidebar_class', $classes, $class);
}

/**
 * Display the classes for the sidebar.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 */
function generate_left_sidebar_class( $class = '' ) {
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', generate_get_left_sidebar_class( $class ) ) . '"';
}

/**
 * Retrieve the classes for the sidebar.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 */
function generate_get_left_sidebar_class( $class = '' ) {

	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);

	return apply_filters('generate_left_sidebar_class', $classes, $class);
}

/**
 * Display the classes for the content.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 */
function generate_content_class( $class = '' ) {
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', generate_get_content_class( $class ) ) . '"';
}

/**
 * Retrieve the classes for the content.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 */
function generate_get_content_class( $class = '' ) {

	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);

	return apply_filters('generate_content_class', $classes, $class);
}

/**
 * Display the classes for the header.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 */
function generate_header_class( $class = '' ) {
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', generate_get_header_class( $class ) ) . '"';
}

/**
 * Retrieve the classes for the content.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 */
function generate_get_header_class( $class = '' ) {

	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);

	return apply_filters('generate_header_class', $classes, $class);
}

/**
 * Display the classes for inside the header.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 */
function generate_inside_header_class( $class = '' ) {
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', generate_get_inside_header_class( $class ) ) . '"';
}

/**
 * Retrieve the classes for inside the header.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 */
function generate_get_inside_header_class( $class = '' ) {

	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);

	return apply_filters('generate_inside_header_class', $classes, $class);
}

/**
 * Display the classes for the container.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 */
function generate_container_class( $class = '' ) {
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', generate_get_container_class( $class ) ) . '"';
}

/**
 * Retrieve the classes for the content.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 */
function generate_get_container_class( $class = '' ) {

	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);

	return apply_filters('generate_container_class', $classes, $class);
}

/**
 * Display the classes for the navigation.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 */
function generate_navigation_class( $class = '' ) {
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', generate_get_navigation_class( $class ) ) . '"';
}

/**
 * Retrieve the classes for the navigation.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 */
function generate_get_navigation_class( $class = '' ) {

	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);

	return apply_filters('generate_navigation_class', $classes, $class);
}

/**
 * Display the classes for the navigation.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 */
function generate_menu_class( $class = '' ) {
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', generate_get_menu_class( $class ) ) . '"';
}

/**
 * Retrieve the classes for the navigation.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 */
function generate_get_menu_class( $class = '' ) {

	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);

	return apply_filters('generate_menu_class', $classes, $class);
}

/**
 * Display the classes for the footer.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 */
function generate_footer_class( $class = '' ) {
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', generate_get_footer_class( $class ) ) . '"';
}

/**
 * Retrieve the classes for the footer.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 */
function generate_get_footer_class( $class = '' ) {

	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);

	return apply_filters('generate_footer_class', $classes, $class);
}

/**
 * Display the classes for the <main> container.
 *
 * @since 1.1.0
 * @param string|array $class One or more classes to add to the class list.
 */
function generate_main_class( $class = '' ) {
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', generate_get_main_class( $class ) ) . '"';
}

/**
 * Retrieve the classes for the footer.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 */
function generate_get_main_class( $class = '' ) {

	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);

	return apply_filters('generate_main_class', $classes, $class);
}