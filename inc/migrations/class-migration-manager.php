<?php

/**
 * The migration manager is responsible to check which migrations should run on theme update.
 */
class GeneratePress_Migration_Manager {

	/**
	 * The migrations to run.
	 *
	 * @var string[]
	 */
	private static $migrations = [
		'GeneratePress_Typography_System_Migration',
	];

	/**
	 * Runs all the migrations.
	 */
	public static function migrate()
	{
		/** @var GeneratePress_Abstract_Migration $migration_instance */
		foreach ( self::$migrations as $migration ) {
			$migration_instance = new $migration;

			if ( version_compare( self::get_db_version(), $migration_instance->get_version(), '<' ) ) {
				$migration_instance->run();
			}
		}
	}

	/**
	 * Returns the current GP database version.
	 *
	 * @return false|mixed|void
	 */
	public static function get_db_version()
	{
		return get_option( 'generate_db_version', false );
	}
}
