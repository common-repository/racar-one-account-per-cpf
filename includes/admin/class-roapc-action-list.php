<?php
/*
*
* class PLUGIN´S ACTION LIST
* class-roapc_Action_List.php
*
*/
/**
 * Prevent direct access to the script.
 */
if( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! class_exists( 'roapc_Action_List' ) ) {	
	class roapc_Action_List {

		function __construct() {
			add_filter( 'plugin_action_links' , array( $this , 'add_plugin_action_links' ) , 10 , 2 );
		}
		
		
		public function add_plugin_action_links( $links , $file ) {
			global $roapc_basename;
			// static $this_plugin;
			global $roapc_OPTIONSON;

			// if( ! $this_plugin ) {
			// 	$this_plugin = $roapc_basename;
			// }

			// check to make sure we are on the correct plugin
			// if( $file == $this_plugin ) {	
			if( $file == $roapc_basename ) {	
				$plugin_links = array();
				// check if plugin has options page and add address
				if( TRUE === $roapc_OPTIONSON ) {
					// link to what ever you want
					//$plugin_links[] = '<a href="' . get_bloginfo('wpurl') . '/wp-admin/widgets.php">Widgets</a>';
					$plugin_links[] = '<a href="' . get_bloginfo('wpurl') . '/wp-admin/admin.php?page=roapc-config">' . esc_html__( 'Settings' , 'racar-one-account-per-cpf') . '</a>';
					// add the links to the list of links already there
					
				}
				foreach( $plugin_links as $link ) {
					array_unshift( $links , $link );
				}
				// This will be the last link on line
				$links[] = '<a href="https://www.paypal.me/RafaCarvalhido" class="racar-donate" target="_blank">' . esc_html__( 'Donate' , 'racar-one-account-per-cpf') . '</a>';
			}
			return $links;
		}
	}
}

$roapc_Action_List = new roapc_Action_List();