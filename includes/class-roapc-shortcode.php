<?php 
/*
*
* class Shorcode
* class-roapc-shortcode.php
*
*/
/**
 * Prevent direct access to the script.
 */
if( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! class_exists( 'roapc_Shortcode' ) ) {	
	class roapc_Shortcode {
		
		public static function init() {
			// add_shortcode( 'roapc_shortcode_code_to_paste', array( __CLASS__ , 'get_the_shortcode' ) , 10 , 1 );
        }

		public static function get_the_shortcode( $atts ) {
			$html = '';
			/*if( $atts ) {
				$pid = $atts['id'];
				$html = '<div id="rpg-initiative-calculator">Shortcode '.$pid.' Output with</div>';
			} else {
				$html = '<div id="rpg-initiative-calculator">Shortcode Output only</div>';
			}*/
			return $html;
		}


		
	} // end of class
} //endif class

$roapc_shortcode = new roapc_Shortcode();