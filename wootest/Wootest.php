<?php 
/**
* Plugin Name: WooTest

* Plugin URI:         https://WooTest
 * Description:       WooTest
 * Version:           1.0.0
 * Author:            Ed

*/

register_activation_hook( __FILE__, 'Wootest_activate' );

function Wootest_activate() {
	
	if ( !class_exists( 'WooCommerce' ) ) {
		wp_die( __( 'Please activate WooCommerce.', 'my-plugin' ), 'Plugin dependency check', array( 'back_link' => true ) );
	}

	file_put_contents(__DIR__.'/my_loggg.txt', ob_get_contents());

}


/* Settings */

$options['plugin_name'] = 'wootest'; 
$options['plugin_prefix'] = 'wootest'; 
$options['plugin_path'] = plugin_dir_path( __DIR__ ); 
$options['redirect_slug'] = 'films'; 
$options['redirect_title'] = 'Selected Films'; 

$woo_fields['subtitle'] = array('id' => $options['plugin_prefix'].'_subtitle', 'label' => 'Subtitle', 'type' => 'textfield', 'placeholder' => 'please enter subtitle...', 'description' => 'Subtitle is..', 'value' => false); 

$woo_fields['some_test_field'] = array('id' => $options['plugin_prefix'].'_some_test_field', 'label' => 'Some test field', 'type' => 'textfield', 'placeholder' => 'please enter some test field info here..', 'description' => 'Some test info is...', 'value' => false); 	

$woo_fields['some_test_field2'] = array('id' => $options['plugin_prefix'].'_some_test_field2', 'label' => 'Some test field2', 'type' => 'textfield', 'placeholder' => 'please enter some test field info here2..', 'description' => 'Some test info is2...', 'value' => false); 

$user_fields['skype'] = array('id' => $options['plugin_prefix'].'_skype', 'label' => 'Skype', 'type' => 'textfield', 'placeholder' => 'please enter skype...', 'description' => 'Skype is..', 'value' => false); 

$user_fields['skype2'] = array('id' => $options['plugin_prefix'].'_skype2', 'label' => 'Skype2', 'type' => 'textfield', 'placeholder' => 'please enter skype2...', 'description' => 'Skype2 is..', 'value' => false);

$user_fields['skype3'] = array('id' => $options['plugin_prefix'].'_skype3', 'label' => 'Skype3', 'type' => 'textfield', 'placeholder' => 'please enter skype3...', 'description' => 'Skype3 is..', 'value' => false);

// Go..
require_once( plugin_dir_path( __FILE__ ).'/classes/WootestFields.php');
require_once( plugin_dir_path( __FILE__ ).'/classes/Wootest.php');

$Wootest = new Wootest($options, $user_fields, $woo_fields);