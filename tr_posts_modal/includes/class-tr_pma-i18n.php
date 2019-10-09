<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       pavle.j.srdic@gmail.com
 * @since      1.0.0
 *
 * @package    Tr_pma
 * @subpackage Tr_pma/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Tr_pma
 * @subpackage Tr_pma/includes
 * @author     Pavle Srdic <pavle.j.srdic@gmail.com>
 */
class Tr_pma_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'tr_pma',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
