<?php

if( class_exists( 'Vc_Manager' ) ){
    if( !class_exists( 'Vc_Column_Offset' ) ){
        require_once( WP_PLUGIN_DIR . '/js_composer/include/params/column_offset/column_offset.php' );
        
    }
    class Vc_Five_Columns_Column_Offset extends Vc_Column_Offset {
    	public function __construct( $settings, $value ) {
    		$this->settings = $settings;
    		$this->value = $value;
    
    		$this->column_width_list = array(
    			__( '1 column - 1/12', 'vc-five-columns' )     => '1',
    			__( '2 columns - 1/6', 'vc-five-columns' )     => '2',
    			__( '3 columns - 1/4', 'vc-five-columns' )     => '3',
    			__( '4 columns - 1/3', 'vc-five-columns' )     => '4',
    			__( '5 columns - 5/12', 'vc-five-columns' )    => '5',
    			__( '6 columns - 1/2', 'vc-five-columns' )     => '6',
    			__( '7 columns - 7/12', 'vc-five-columns' )    => '7',
    			__( '8 columns - 2/3', 'vc-five-columns' )     => '8',
    			__( '9 columns - 3/4', 'vc-five-columns' )     => '9',
    			__( '10 columns - 5/6', 'vc-five-columns' )    => '10',
    			__( '11 columns - 11/12', 'vc-five-columns' )  => '11',
    			__( '12 columns - 1/1', 'vc-five-columns' )    => '12',
    			__( '2.4 columns - 12/5', 'vc-five-columns' )  => '24/10',
    		);
    	}
    
    }
    
    function vc_five_columns_column_offset_form_field( $settings, $value ) {
    	$column_offset = new Vc_Five_Columns_Column_Offset( $settings, $value );
    
    	return $column_offset->render();
    }


}