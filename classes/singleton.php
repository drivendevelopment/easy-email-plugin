<?php

namespace Easy_Email;

// Disable direct load
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Singleton base class.
 */
abstract class Singleton {

    /**
	 * Holds an instance of the class.
	 *
     * @var Singleton
     */
    protected static $instance;

    abstract protected function __construct();

    /**
	 * Returns the singleton instance of the plugin.
     *
     * @return Singleton
	 */
    public static function get_instance() {
		if ( empty( static::$instance ) ) {
			static::$instance = new static();
		}

		return static::$instance;
	}
}
