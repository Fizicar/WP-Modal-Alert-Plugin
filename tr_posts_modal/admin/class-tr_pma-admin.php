<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       pavle.j.srdic@gmail.com
 * @since      1.0.0
 *
 * @package    Tr_pma
 * @subpackage Tr_pma/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tr_pma
 * @subpackage Tr_pma/admin
 * @author     Pavle Srdic <pavle.j.srdic@gmail.com>
 */
class Tr_pma_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;
	/**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles($hook) {

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
        if($hook != 'settings_page_my-setting-admin') {
            return;
        }
        wp_enqueue_style( 'Select2_css', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tr_pma-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts($hook) {

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
        if($hook != 'settings_page_my-setting-admin') {
            return;
        }
        wp_enqueue_script( 'Select2_script', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tr_pma-admin.js', array( 'jquery' ), $this->version, false );
        wp_enqueue_editor();

        
	}
	
	/**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Settings Admin', 
            'TF Modal/Alert', 
            'manage_options', 
            'my-setting-admin', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'tr_modal_option' );
        ?>
        <div class="wrap">
            <h1>My Settings</h1>
            <form method="post" action="options.php" id='submit_form'>
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'tr_modal_group' );
                do_settings_sections( 'my-setting-admin' );
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'tr_modal_group', // Option group
            'tr_modal_option', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'Trintity Factory Modal/Alert plugin', // Title
            array( $this, 'print_section_info' ), // Callback
            'my-setting-admin' // Page
		);  
        
        add_settings_field(
            'post_types', 
            'Post Types', 
            array( $this, 'post_type_callback' ), 
            'my-setting-admin', 
            'setting_section_id'
        );  

		add_settings_field(
            'title', 
            'Title', 
            array( $this, 'title_callback' ), 
            'my-setting-admin', 
            'setting_section_id'
        );  

        add_settings_field(
            'content', // ID
            'Content', // Title 
            array( $this, 'content_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id' // Section           
        );      

            
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();

        if( isset( $input['post_types'] ) )
            $new_input['post_types'] = sanitize_text_field( $input['post_types'] );

        if( isset( $input['content'] ) )
            $new_input['content'] = sanitize_text_field( $input['content'] );

        if( isset( $input['title'] ) )
            $new_input['title'] = sanitize_text_field( $input['title'] );

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter your settings below:';
    }
    
    

    /** 
     * Get the settings option array and print one of its values
     */
    public function content_callback()
    {
       
        $setting = array(
            'textarea_name' => 'tr_modal_option[content]',
        );
        $the_conctent = isset( $this->options['content'] ) ? esc_attr( $this->options['content']) : '';
        wp_editor( $the_conctent , "content" ,$setting);
        
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function title_callback()
    {
        printf(
            '<input type="text" id="title" name="tr_modal_option[title]" value="%s" />',
            isset( $this->options['title'] ) ? esc_attr( $this->options['title']) : ''
        );
        
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function post_type_callback()
    {   
        $post_types = array(
            'public' => true
        );
        $all_post_type = get_post_types($post_types);

        $decodet_value = json_decode($this->options['post_types']);

        foreach ($all_post_type as $key => $value) { ?>
            <label for="<?php echo $value;?>">
            <?php echo $value;?>:
                <input type="checkbox" data-name="<?php echo $value;?>" name="post_type" id="<?php echo $value;?>" class='all_post_types'>
            </label>
        <?php
        }
        ?>
        <br>
        <select multiple id='posts_select'>
        <option value="" disabled selected>Select your option</option>
        </select>

        <?php
        printf(
            '<input style="display: none;" type="text" id="post_types" name="tr_modal_option[post_types]" value="%s" />',
            isset( $this->options['post_types'] ) ? esc_attr( $this->options['post_types']) : ''
        );
        
        
        
        
    }

}
