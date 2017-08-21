<?php
/*
Plugin Name: VC Five Columns
Plugin URI: http://atthemes.com/
Description: Create layout five columns for visual composer page builder
Author: TruongTuyen
Version: 1.0.0
Author URI: http://atthemes.com/
Text Domain: vc-five-columns
*/

define( 'VC_FIVE_COLUMNS_DIR', plugin_dir_path( __FILE__ ) );

class VCFiveColumns {
  
    function __construct() {
        
        add_action( 'init', array( $this, 'admin_notice' ) );
		add_action( 'vc_after_init_base', array( $this, 'add_new_vccustom' ) );
	  	add_action( 'admin_enqueue_scripts', array( $this, 'load_custom_vc_layout_admin_style' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'loadCssAndJs' ) );
        add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
        
        add_action( 'vc_after_init', array( $this, 'change_default_values' ) );
        $this->load_files();
        vc_add_shortcode_param( 'vcfc_column_offset', 'vc_five_columns_column_offset_form_field' );
        $this->remove_vc_column_param();
        $this->add_vc_column_param();
    }
    
    function add_vc_column_param(){
        $param = array(
			'type'        => 'vcfc_column_offset',
			'heading'     => __( 'Responsiveness abc', 'vc-five-columns' ),
			'param_name'  => 'offset',
			'group'       => __( 'Responsive Options', 'vc-five-columns' ),
			'description' => __( 'Adjust column for different screen sizes. Control width, offset and visibility settings.', 'vc-five-columns' ),
		);
        vc_add_param( 'vc_column', $param );
        vc_add_param( 'vc_column_inner', $param );
    }
    
    function remove_vc_column_param(){
        vc_remove_param( "vc_column", "offset" );
        vc_remove_param( "vc_column_inner", "offset" );
    }
    
    function load_files(){
        require_once VC_FIVE_COLUMNS_DIR . 'vc_params/vc_column_offset.php';
       
    }
    
    function change_default_values(){
        $new_vc_column = array(
            'type' => 'dropdown',
			'heading' => __( 'Width', 'vc-five-columns' ),
			'param_name' => 'width',
			'value' => array(
				__( '1 column - 1/12', 'vc-five-columns' ) => '1/12',
				__( '2 columns - 1/6', 'vc-five-columns' ) => '1/6',
				__( '3 columns - 1/4', 'vc-five-columns' ) => '1/4',
				__( '4 columns - 1/3', 'vc-five-columns' ) => '1/3',
				__( '5 columns - 5/12', 'vc-five-columns' ) => '5/12',
				__( '6 columns - 1/2', 'vc-five-columns' ) => '1/2',
				__( '7 columns - 7/12', 'vc-five-columns' ) => '7/12',
				__( '8 columns - 2/3', 'vc-five-columns' ) => '2/3',
				__( '9 columns - 3/4', 'vc-five-columns' ) => '3/4',
				__( '10 columns - 5/6', 'vc-five-columns' ) => '5/6',
				__( '11 columns - 11/12', 'vc-five-columns' ) => '11/12',
				__( '12 columns - 1/1', 'vc-five-columns' ) => '1/1',
                __( '2.4 columns - 12/5 (20% of 100%)', 'vc-five-columns' ) => '24/10',
			),
			'group' => __( 'Responsive Options', 'vc-five-columns' ),
			'description' => __( 'Select column width.', 'vc-five-columns' ),
			'std' => '1/1',
        );
        
        
        $new_vc_column_inner = array(
            'type' => 'dropdown',
			'heading' => __( 'Width', 'vc-five-columns' ),
			'param_name' => 'width',
			'value' => array(
				__( '1 column - 1/12', 'vc-five-columns' ) => '1/12',
				__( '2 columns - 1/6', 'vc-five-columns' ) => '1/6',
				__( '3 columns - 1/4', 'vc-five-columns' ) => '1/4',
				__( '4 columns - 1/3', 'vc-five-columns' ) => '1/3',
				__( '5 columns - 5/12', 'vc-five-columns' ) => '5/12',
				__( '6 columns - 1/2', 'vc-five-columns' ) => '1/2',
				__( '7 columns - 7/12', 'vc-five-columns' ) => '7/12',
				__( '8 columns - 2/3', 'vc-five-columns' ) => '2/3',
				__( '9 columns - 3/4', 'vc-five-columns' ) => '3/4',
				__( '10 columns - 5/6', 'vc-five-columns' ) => '5/6',
				__( '11 columns - 11/12', 'vc-five-columns' ) => '11/12',
				__( '12 columns - 1/1', 'vc-five-columns' ) => '1/1',
                __( '2.4 columns - 12/5 (20% of 100%)', 'vc-five-columns' ) => '24/10',
			),
			'group' => __( 'Responsive Options', 'vc-five-columns' ),
			'description' => __( 'Select column width.', 'vc-five-columns' ),
			'std' => '1/1',
        );
        
        vc_update_shortcode_param( 'vc_column', $new_vc_column );
        vc_update_shortcode_param( 'vc_column_inner', $new_vc_column_inner );
    }
    
    function load_textdomain(){
        load_plugin_textdomain( 'vc-five-columns', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
    }
	
  	function load_custom_vc_layout_admin_style () {
    	wp_enqueue_style( 'vc-five-columns-admin-css', plugins_url( '/css/backend.css', __FILE__ ) );
   		
	}
  	
    function add_new_vccustom() {
	    global $vc_row_layouts;
        array_push( $vc_row_layouts, array(
            'cells'      => '2410_2410_2410_2410_2410',
            'title'      => esc_html__( '20% + 20% + 20% + 20% + 20%', 'vc-five-columns' ),
            'icon_class' => 'l_2410_2410_2410_2410_2410' )
        );
    }

    public function admin_notice() {
        if ( ! class_exists( 'Vc_Manager' ) ){
            ?>
                <div class="warning notice notice-warning is-dismissible">
                    <p>
                        <?php printf( esc_html__( 'VC Five Columns requirements <a target="_blank" href="%1$s">Visual Composer</a>: Page Builder for WordPress Plugin installed', 'vc-five-columns' ), 'https://codecanyon.net/item/visual-composer-page-builder-for-wordpress/242431?ref=AtTeamWP' ); ?>
                    </p>
                </div>
            <?php
        } else if ( version_compare( WPB_VC_VERSION, '4.9' ) < 0 ) {
            ?>
                <div class="warning notice notice-warning is-dismissible">
                    <p>
                        <?php printf( esc_html__( 'VC Five Columns requirements at least <a target="_blank" href="%1$s">Visual Composer</a> version 4.9', 'vc-five-columns' ), 'https://codecanyon.net/item/visual-composer-page-builder-for-wordpress/242431?ref=AtTeamWP' ); ?>
                    </p>
                </div>
        <?php
        }
    }
 
    public function loadCssAndJs() {
	 	wp_enqueue_style( 'vc-five-columns-frontend', plugins_url( '/css/frontend.css', __FILE__ ) );
    }
}

new VCFiveColumns();

?>