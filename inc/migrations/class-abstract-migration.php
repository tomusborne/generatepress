<?php

/**
 * Abstract migration containing the logic for each migration to run
 */
abstract class GeneratePress_Abstract_Migration
{
	/**
	 * @var string The GP version in which the migration was implemented.
	 */
	protected $version = '0.0.0';

	/**
	 * Returns the migration version.
	 *
	 * @return string
	 */
	public function get_version()
	{
		return $this->version;
	}

	/**
	 * Runs the migration.
	 */
	abstract public function run();

	/**
	 * Returns current GeneratePress settings.
	 *
	 * @return false|mixed|void
	 */
	protected function get_settings()
	{
		return get_option( 'generate_settings', array() );
	}

	/**
	 * Update the GeneratePress settings.
	 *
	 * @param $settings
	 * @return bool
	 */
	protected function update_settings( $settings )
	{
		return update_option( 'generate_settings', $settings );
	}
}
