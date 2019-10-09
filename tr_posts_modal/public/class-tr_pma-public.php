<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       pavle.j.srdic@gmail.com
 * @since      1.0.0
 *
 * @package    Tr_pma
 * @subpackage Tr_pma/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Tr_pma
 * @subpackage Tr_pma/public
 * @author     Pavle Srdic <pavle.j.srdic@gmail.com>
 */
class Tr_pma_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		
		
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tr_pma_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tr_pma_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tr_pma-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tr_pma_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tr_pma_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tr_pma-public.js', array( 'jquery' ), $this->version, false );

	}

	// Custom Code
	public function tr_modal_frontend() {

		global $post;
		$current_page_id = $post->ID;

		$options = get_option('tr_modal_option');
		$current_post_type = get_post_type();

		
		$all_post_types= json_decode($options['post_types']);
		$title = $options['title'];
		$content = $options['content'];


		if(isset($all_post_types->{$current_page_id})){ ?>
			<div id="the_modal">
				<div class="modal_inner">
					<h1><?php echo $title; ?></h1>
					<div class="modal_content">
						<?php echo $content ; ?>
					</div>
					<div id="close_modal">X</div>
				</div>
			</div>
			
			<?php
			}
			
		
		
	 }

	 

}
