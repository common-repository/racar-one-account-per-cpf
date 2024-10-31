<?php 
/*
*
* class Options Page
* class_Admin_Options.php
*
*/
/**
 * Prevent direct access to the script.
 */
if( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! class_exists( 'roapc_Admin_Options' ) ) {	
	class roapc_Admin_Options {
		/**
		 * Holds the values to be used in the fields callbacks
		 */
		private $options;

		private	$menu_title = 'RaCar Plugins';
		private	$capability = 'manage_options';
		private	$menu_slug = 'racar-admin-page.php';
		private	$function_main_menu = 'racar_admin_page'; // não será usado
		private	$icon_url = 'dashicons-lightbulb'; //dashicons
		private	$position = 99; 
		
		private $sub_page_title = 'roapc Sub Página';
		// private $sub_menu_title = 'One Account Per CPF';
		private $capability_sub = 'manage_options';
		private $page_url = 'roapc-config';
		private $function_sub_page = 'roapc_options_page'; // if altering this, alter throughout this file.

		/**
		 * Start up
		 */
		public function __construct() {
			add_action( 'admin_menu', array( $this, 'racar_main_admin_menu' ) );
			add_action( 'admin_menu', array( $this, 'roapc_admin_menu' ) );
			add_action( 'admin_init', array( $this, 'remove_admin_submenu' ) );
		}

		public function racar_main_admin_menu() {
			global $roapc_plugin_name;
			$page_title = "$roapc_plugin_name Options Page";
			if( empty( $GLOBALS['admin_page_hooks']['racar-admin-page.php'] ) ) {
				add_menu_page( 
					$page_title, 
					$this->menu_title, 
					$this->capability, 
					'racar-admin-page.php', 
					array( $this , $this->function_main_menu ),// não será usado
					$this->icon_url, 
					$this->position
				);
			}	
		}
		
		public function remove_admin_submenu() {
			remove_submenu_page( 'racar-admin-page.php' , 'racar-admin-page.php' );
		}
		
		public function racar_admin_page(){
			//
		}
		public function roapc_admin_menu() {
			global $roapc_page_hook, $roapc_plugin_name, $roapc_plugin_name_short;
			$roapc_page_hook = add_submenu_page( 
				'racar-admin-page.php',
				esc_html__( 'RaCar One Account Per CPF', 'racar-one-account-per-cpf' ),
				esc_html__( 'One Account Per CPF', 'racar-one-account-per-cpf' ), //antigo $this->sub_menu_title,
				$this->capability_sub,
				$this->page_url,
				array( $this , $this->function_sub_page )
			);
		}
		
		public function roapc_options_page() { 
			global $roapc_VERSION;
			?>
				<h1><?php echo esc_html__( 'RaCar One Account Per CPF', 'racar-one-account-per-cpf' ) . ' v.' . esc_html( $roapc_VERSION );	?></h1>
				<div class="plugin-works"><?php echo esc_html__( 'The plugin is already working and will accept only account subscription with different CPF from the ones already registered in the system.', 'racar-one-account-per-cpf' ); ?></div>
			<?php 
			// Set class property
			$this->options = get_option( 'roapc_settings' );

			$active_tab = "tools-tab";
			if( isset( $_GET["tab"] ) ) {
				switch( $_GET["tab"] ) {

					case 'plugin-activation':
						$active_tab = "plugin-activation";
						break;

					default:
						$active_tab = "tools-tab";
						break;
				} 
			} else {
				$active_tab = "tools-tab";
			}
			?>
				<h2 class="nav-tab-wrapper">
	                <a href="?page=roapc-config&tab=tools-tab" class="nav-tab tools-tab <?php if($active_tab == 'tools-tab'){echo 'nav-tab-active';} ?> "><?php esc_html_e( 'Tools', 'racar-one-account-per-cpf'); ?></a>
	                <a href="?page=roapc-config&tab=plugin-activation" class="nav-tab plugin-activation <?php if($active_tab == 'plugin-activation'){echo 'nav-tab-active';} ?>"><?php esc_html_e( 'Plugin Activation', 'racar-one-account-per-cpf'); ?></a>
	            </h2>

	        <?php 
	        	if( $active_tab == 'tools-tab' ) {
	        		include_once dirname( __FILE__ ) . '/views/html-admin-search.php';
	        	} elseif( $active_tab == 'plugin-activation' ) {
	        		include_once dirname( __FILE__ ) . '/views/html-admin-activation-key.php';
	        	} else {
	        ?>
				<form action='options.php' method='post'>
					<?php 
					settings_fields( 'roapc_option_group_1' );
					do_settings_sections( 'roapc-options-page' );
					submit_button();
					?>
				</form>
			<?php 
				}
		}				
	}
}

$my_settings_page = new roapc_Admin_Options();
