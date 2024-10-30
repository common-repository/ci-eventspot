<?php 
/**
 * Plugin Name: CI EventSpot
 * Plugin URI: http://codeinitiator.com/constant-contact-eventspot-plugin/
 * Description: Plugin for displaying events from Constant Contact acount, 
	It will allow you to fetch all the events from your constant contact account and show them to a calendar on your website's page with its short code, 
	It will also allow you to show all your events on wordpress sidebar widget.you can also Create,
 	Publish and Cancel events from the plugin
 * Version: 1.0
 * Author: Gurcharan Singh
 * Author URI: http://codeinitiator.com/constant-contact-eventspot-plugin/
 * Requires at least: 4.4
 * Tested up to: 4.6
 * 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// add styles to the plugin
add_action( 'init', 'cies_style_and_script' );	

//add admin menu
add_action("admin_menu", "cies_addMenu");

// create widget
add_action('widgets_init', create_function('', 'return register_widget("cies_widget");'));

// short code for calendar
require (plugin_dir_path( __FILE__ ) . '/controller/es_calendar.php');

//include widget class
require (plugin_dir_path( __FILE__ ) . '/controller/es_widget.php');


function cies_addMenu() {

	add_menu_page('EventSpot', 'EventSpot', 1, 'es_dashboard', 'cies_dashboard',plugins_url("images/icon_event_lg.png",__FILE__));
	
	add_submenu_page( 'EventSpot' , 'EventSpot', 1, 'administrator', 'es_settings_page' , 'cies_manage_event_settings' );
	
	add_submenu_page( 'EventSpot' , 'EventSpot Manage Events', 1, 'administrator', 'es_manage_event' , 'cies_manage_event_func' );
	
	add_submenu_page( 'EventSpot' , 'EventSpot Help & Support', 1, 'administrator', 'es_help_page' , 'cies_manage_help_support' );
	
	add_submenu_page( 'EventSpot' , 'EventSpot Tutorial', 1, 'administrator', 'es_tutorial' , 'cies_tutorial_func' );
	
	add_submenu_page( 'EventSpot' , 'EventSpot Update Event', 1, 'administrator', 'es_update_event' , 'cies_update_event_func' );
	
}
   
//enque js and css to the plugin
function cies_style_and_script() { 


wp_register_style('es_css_style', plugins_url('css/style.css',__FILE__ ));
wp_enqueue_style('es_css_style');
wp_register_style('es_calendar', plugins_url('css/calendar.css',__FILE__ ));
wp_enqueue_style('es_calendar');
wp_register_style('es_custom_2', plugins_url('css/custom_2.css',__FILE__ ));
wp_enqueue_style('es_custom_2');

wp_enqueue_script( 'es_manage_events', plugins_url('/js/es_manage_events.js' ,__FILE__ ) , array(), '1.0.0', true );
wp_enqueue_script( 'es_modernizr_custom', plugins_url('/js/modernizr.custom.63321.js' ,__FILE__ ) , array(), '1.0.0', true );
//wp_enqueue_script( 'es_data', plugins_url('/js/data.js' ,__FILE__ ) , array(), '1.0.0', true );
wp_enqueue_script( 'es_data', plugins_url('/js/data_static.js' ,__FILE__ ) , array(), '1.0.0', true );
wp_enqueue_script( 'es_jquery_calendario', plugins_url('/js/jquery.calendario.js' ,__FILE__ ) , array(), '1.0.0', true );
wp_enqueue_script( 'es_es_custom', plugins_url('/js/es_custom.js' ,__FILE__ ) , array(), '1.0.0', true );

}

//Hooks our custom function into WP's wp_enqueue_scripts function

//dashboard page
function cies_dashboard()
{
	require (plugin_dir_path( __FILE__ ) . '/view/es_dashboard.php');
}

//tutorial page
function cies_tutorial_func()
{
	require (plugin_dir_path( __FILE__ ) . '/view/es_tutorial.php');
}


//Manage Event
function cies_manage_event_func()
{
	require (plugin_dir_path( __FILE__ ) . '/view/es_manage_event.php');
}

//Update Event
function cies_update_event_func()
{
	require (plugin_dir_path( __FILE__ ) . '/view/es_update_event.php');
}



//Help & Support
function cies_manage_help_support()
{
	require (plugin_dir_path( __FILE__ ) . '/view/es_support.php');
}	

//Settings page
function cies_manage_event_settings()
{
	
	if(sanitize_text_field($_POST['constant_contact_api_key']))
	{
		$constant_contact_api_key = sanitize_text_field($_POST['constant_contact_api_key']);
		
		$name = "constant_contact_api_key";
		$value = $constant_contact_api_key;
		
		if ( get_option( $name ) !== false ) {

			update_option( $name, $value );

		} else {

			add_option($name, $value);
		}
		
	}
	
	
	if(sanitize_text_field($_POST['constant_contact_secret_key']))
	{
		$constant_contact_secret_key = sanitize_text_field($_POST['constant_contact_secret_key']);
		
		$name = "constant_contact_secret_key";
		$value = $constant_contact_secret_key;
		if ( get_option( $name ) !== false ) {

			update_option( $name, $value );

		} else {

			add_option($name, $value);
		}
	}
	
	
	
	
	if(sanitize_text_field($_POST['constant_contact_access_token']))
	{
		$constant_contact_access_token = sanitize_text_field($_POST['constant_contact_access_token']);
		
		$name = "constant_contact_access_token";
		$value = $constant_contact_access_token;
		if ( get_option( $name ) !== false ) {

			update_option( $name, $value );

		} else {

			add_option($name, $value);
		}
	}
	
	
	
	
	$access_token_option = "constant_contact_access_token";	
	$access_token = get_option( $access_token_option );
	
	$secret_key_option = "constant_contact_secret_key";	
	$secret_key = get_option( $secret_key_option);
	
	$api_key_option = "constant_contact_api_key";	
	$api_key = get_option( $api_key_option );
	
	
	require (plugin_dir_path( __FILE__ ) . '/view/es_settings.php');
}

// dategpicker for back end
wp_enqueue_script('jquery-ui-core');
wp_enqueue_script('jquery-ui-datepicker');
wp_register_style('jquery-style', plugins_url('js/jquery-ui.css',__FILE__ ));
wp_enqueue_style('jquery-style');	
	
?>