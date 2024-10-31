<?php 
/**
 * Plugin Name: RaCar One Account Per CPF
 * Plugin URI:  https://profissionalwp.dev.br/
 * Description: It makes sure that only one account may have a CPF number during registration. Requires the plugin 'Brazilian Market on WooCommerce' (aka Extra Checkout Fields for Brazil).
 * Version:     1.0.0
 * Author:      Rafa Carvalhido
 * Author URI:  https://profissionalwp.dev.br/blog/contato/rafa-carvalhido/
 * Text Domain: racar-one-account-per-cpf
 * Domain Path: /languages
 * Requires at least: 4.9.8
 * Tested up to: 6.5.5
 * WC requires at least: 7.2.0
 * WC tested up to: 9.0.2
 * Requires Plugins: woocommerce, woocommerce-extra-checkout-fields-for-brazil
 * License: GPLv2 or later
 * Copyright © 2019-2024 Rafa Carvalhido
 * @package RaCar One Account Per CPF
 */
/*
RaCar One Account Per CPF is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
RaCar One Account Per CPF is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with RaCar One Account Per CPF.
*/

	/*=========================================================================*/ 
	/* SECURITY CHECKS */
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	if ( ! defined( 'WPINC' ) ) die; // If this file is called directly, abort.
	
	//if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
	if( wp_doing_ajax() ) {
		return;
	}
	

	//start plugin
	if ( ! class_exists( 'roapc_Plugin' ) ) {
		include_once dirname( __FILE__ ) . '/includes/class-roapc-plugin.php';
		add_action( 'plugins_loaded', array( 'roapc_Plugin', 'init' ) );
	}
	
	
	/*=========================================================================*/
	// SYSTEM VARIABLES

	$roapc_plugin_name = "RaCar One Account Per CPF";
	// $roapc_plugin_name = __( 'RaCar One Account Per CPF', 'racar-one-account-per-cpf' );
	$roapc_plugin_name_short = 'One Account Per CPF';
	$roapc_VERSION = '0.3.6';
	
	$roapc_NOME_STYLESHEET = 'roapc-stylesheet';
	//the below returns http://site-name.com/wp-contents/plugins/plugin-folder/css/
	$roapc_DIR_STYLESHEET = plugins_url('css/', __FILE__ );
	$roapc_EXT_STYLESHEET = '.css';
	
	$roapc_NOME_JAVASCRIPT = 'roapc-javascript';
	$roapc_DIR_JAVASCRIPT = plugins_url('js/', __FILE__ );
	$roapc_EXT_JAVASCRIPT = '.js';
	
	$roapc_OPTIONSON = TRUE;
	// $roapc_OPTIONSON = FALSE;
		
	$roapc_NOME_ADMIN_STYLESHEET = 'roapc-admin-style';
	$roapc_DIR_ADMIN_STYLESHEET = plugins_url('includes/admin/css/', __FILE__ );
	$roapc_EXT_ADMIN_STYLESHEET = '.css';
	
	$roapc_NOME_ADMIN_JAVASCRIPT = 'roapc-admin-javascript';
	$roapc_DIR_ADMIN_JAVASCRIPT = plugins_url('includes/admin/js/', __FILE__ );
	$roapc_EXT_ADMIN_JAVASCRIPT = '.js';



	if ( ! defined( 'roapc_PLUGIN_FILE' ) ) {
		define( 'roapc_PLUGIN_FILE', __FILE__ );
		//complete\path-to-site\wp-content\plugins\racar-clear-cart-for-woocommerce\racar-clear-cart-for-woocommerce.php
	}
	if ( ! defined( 'roapc_PLUGIN_FOLDER' ) ) {
		define( 'roapc_PLUGIN_FOLDER', plugin_dir_path( __FILE__ ) );// Example: /home/user/public_html/wp-content/plugins/my-plugin/
	}

	//the below returns plugin-folder/this-file.php // Deixa sempre on
	$roapc_basename = plugin_basename( __FILE__ );


	//the below returns plugin-folder
	// $roapc_basename_dirname = basename( dirname( __FILE__ ) ); //not used now
	
	/*=========================================================================*/
	
	/*

	v.0.2.1 - inserindo função da versão PRO racar_search_for_duplicate_CPF(), habilitando página de admin

	*/
?>