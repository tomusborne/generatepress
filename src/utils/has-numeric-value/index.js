/**
 * Check if we have a numeric value.
 *
 * @param {string} value The value to check.
 * @return {boolean} Whether a value exists.
 */
export default function hasNumericValue( value ) {
	return value || 0 === value;
}
