<?php 
/**
 *  
 * includes/class-roapc-plugin.php
 *  
 * @package RaCar Plugin Name
 */

if( ! class_exists( 'roapc_Plugin' ) ) {
	class roapc_Plugin {
	
		public static function init() {
			if( class_exists( 'WC_Payment_Gateway' ) ) { //enable if there are any dependencies like woo
				self::includes();

				add_action( 'init', array( __CLASS__ , 'roapc_load_textdomain' ) );
				add_action( 'woocommerce_register_post', array( __CLASS__ , 'racar_verify_cpf_on_register' ), 10, 3 );
				add_action( 'woocommerce_register_form_start', array( __CLASS__ , 'racar_add_cpf_field_to_registration' ) );
				add_action( 'woocommerce_created_customer', array( __CLASS__ , 'racar_save_cpf_field' ) );

				//only front end
				if( false === is_admin() ) {
					// add_action( 'wp_enqueue_scripts', array( __CLASS__ , 'roapc_register_frontend_resources' ) );
				}

				//only back end
				if( true === is_admin() ) {
					add_action( 'admin_enqueue_scripts' , array( __CLASS__ , 'register_admin_resources' ) ) ;
				}
			} else { // woo is not active
				add_action( 'admin_notices', array( __CLASS__, 'woocommerce_missing_notice' ) );
			}

			if( ! class_exists( 'Extra_Checkout_Fields_For_Brazil' ) ) { //Brazilian Market not active
				add_action( 'admin_notices', array( __CLASS__, 'brazil_market_missing_notice' ) );
			}
		}



	
		/**
		 * Includes.
		 */
		private static function includes() {
			if( false === is_admin() ) {
                // include_once 'class-roapc-shortcode.php';
			}

			if( true === is_admin() ) {
				global $roapc_OPTIONSON;
				if( $roapc_OPTIONSON AND ! class_exists( 'roapc_Plugin_Pro' ) ) {
					include_once 'admin/class-roapc-admin-options.php';
					include_once 'admin/class-roapc-action-list.php';
				}
			}
		}

		/**
		 * Front end Resources
		 * @since release
		 */
		public static function roapc_register_frontend_resources(){
			self::roapc_frontend_script_files();
			self::roapc_frontend_style_files();
		}
		
		/**
		 * Front end Scripts
		 * @since release
		 */
		public static function roapc_frontend_script_files() {
			global $roapc_NOME_JAVASCRIPT;
			global $roapc_DIR_JAVASCRIPT;
			global $roapc_EXT_JAVASCRIPT;
			wp_register_script( $roapc_NOME_JAVASCRIPT, $roapc_DIR_JAVASCRIPT.$roapc_NOME_JAVASCRIPT.$roapc_EXT_JAVASCRIPT );
			wp_enqueue_script( $roapc_NOME_JAVASCRIPT );
			
		}
		/**
		 * Front end Styles
		 * @since release
		 */
		public static function roapc_frontend_style_files() {
			global $roapc_NOME_STYLESHEET;
			global $roapc_DIR_STYLESHEET;
			global $roapc_EXT_STYLESHEET;
			// Respects SSL, Style.css is relative to the current file
			wp_register_style( $roapc_NOME_STYLESHEET, $roapc_DIR_STYLESHEET.$roapc_NOME_STYLESHEET.$roapc_EXT_STYLESHEET );
			wp_enqueue_style( $roapc_NOME_STYLESHEET );
		}

		
		/**
		 * Admin Resources
		 * @since release
		 */
		public static function register_admin_resources( $hook ) {
			// global $roapc_page_hook;
			// if( $hook != $roapc_page_hook ) return;
			// self::roapc_register_admin_scripts();
			self::roapc_register_admin_styles();
		}

		/**
		 * Admin Styles
		 * @since release
		 */
		public static function roapc_register_admin_styles() {
			global $roapc_NOME_ADMIN_STYLESHEET;
			global $roapc_DIR_ADMIN_STYLESHEET;
			global $roapc_EXT_ADMIN_STYLESHEET;
			wp_register_style( $roapc_NOME_ADMIN_STYLESHEET, $roapc_DIR_ADMIN_STYLESHEET.$roapc_NOME_ADMIN_STYLESHEET.$roapc_EXT_ADMIN_STYLESHEET , array() , '0.9' );
			wp_enqueue_style( $roapc_NOME_ADMIN_STYLESHEET );
		}
		
		/**
		 * Admin Scripts
		 * @since release
		 */
		public static function roapc_register_admin_scripts() {
			global $roapc_NOME_ADMIN_JAVASCRIPT;
			global $roapc_DIR_ADMIN_JAVASCRIPT;
			global $roapc_EXT_ADMIN_JAVASCRIPT;
			wp_register_script( $roapc_NOME_ADMIN_JAVASCRIPT, $roapc_DIR_ADMIN_JAVASCRIPT.$roapc_NOME_ADMIN_JAVASCRIPT.$roapc_EXT_ADMIN_JAVASCRIPT , array( 'jquery'/*, 'wp-color-picker'*/ ) , '1.0' , true );
			wp_enqueue_script( $roapc_NOME_ADMIN_JAVASCRIPT );
		}
		
		
		/**
		 * Load plugin textdomain.
		 *
		 * @since release
		 */
		public static function roapc_load_textdomain() {
			$textdomain_loaded = load_plugin_textdomain( 'racar-one-account-per-cpf', false, basename( dirname( __DIR__ ) ) . '/languages' ); //roapc-plugin-main-folder/languages
		}


		/**
		 * WooCommerce missing notice.
		 * @since release
		 */
		public static function woocommerce_missing_notice() {
			include dirname( __FILE__ ) . '/admin/views/html-notice-missing-woocommerce.php';
		}
		/**
		 * Brazil Market missing notice.
		 * @since release
		 */
		public static function brazil_market_missing_notice() {
			include dirname( __FILE__ ) . '/admin/views/html-notice-missing-brazil-market.php';
		}

		/**
		 * Verifies if CPF exists in database
		 * @since release
		 */
		public static function racar_cpf_exists( $cpf ) {
		    $users = get_users( array(
		    	'fields'		=> array( 'ID', 'display_name', 'user_login' ),
		        'meta_key'		=> 'billing_cpf',
		        'meta_value'	=> $cpf,
		        'meta_compare'	=> '=',
		    ) );

		    switch( count( $users ) ) {
		        case 0:
		            $response = 0;
		            break;
		        case 1:
		            $response = $users[0]->ID;
		            break;
		        
		        default:
		            $response = array();
		            foreach( $users as $user ) {
		            	$response[$user->ID] = array( 
							'display_name'	=> $user->display_name,
							'user_login'	=> $user->user_login,
		            	);
		            }
		            break;
		    }
		    // return $users;
		    return $response;
		}

		
		/**
		 * Validates CPF field during registration
		 * @since release
		 * WC > 7.2.0
		 */
		public static function racar_verify_cpf_on_register( $username, $email, $validation_errors ) {
			if( is_checkout() ) { //uses woocommerce registration nonce on checkout
				if( ! isset( $_REQUEST['woocommerce-process-checkout-nonce'] ) OR ! wp_verify_nonce( sanitize_text_field( wp_unslash ( $_REQUEST['woocommerce-process-checkout-nonce'] ) ), 'woocommerce-process_checkout' ) ) {
					die( __( 'Security check failed', 'racar-one-account-per-cpf' ) ); 
				}
			} else { //uses regular register nonce elsewhere
				if( ! isset( $_REQUEST['woocommerce-register-nonce'] ) OR ! wp_verify_nonce( sanitize_text_field( wp_unslash ( $_REQUEST['woocommerce-register-nonce'] ) ), 'woocommerce-register' ) ) {
					die( __( 'Security check failed', 'racar-one-account-per-cpf' ) ); 
				}
			}
			
		    if(  isset( $_POST['billing_cpf'] ) && ! empty( $_POST['billing_cpf'] ) ) {
		        $cpf_exists = self::racar_cpf_exists( esc_html( sanitize_text_field( $_POST['billing_cpf'] ) ) );
		        if( is_array( $cpf_exists ) OR 1 == $cpf_exists ) {
		        	error_log( 'Tentaram criar conta com mesmo CPF: ' . esc_html( sanitize_text_field( $_POST['billing_cpf'] ) ) );
		        	$login_msg = esc_html__( 'Please login.', 'racar-one-account-per-cpf' );
		        	if( is_checkout() ) {
		        		$login_msg = '<a href="#" class="showlogin">' . esc_html__( 'Please login.', 'racar-one-account-per-cpf' ) . '</a>';
		        	}
		            $validation_errors->add( 'billing_cpf_error', sprintf( esc_html__( 'An account has already been registered with your CPF. %s', 'racar-one-account-per-cpf' ), $login_msg ) );
		        }
		    } elseif( isset( $_POST['billing_cpf'] ) && empty( $_POST['billing_cpf'] ) ) {
				$validation_errors->add( 'billing_cpf_error', esc_html__( 'CPF is a required field.', 'racar-one-account-per-cpf' ) );
			}
		}




		/**
		 * Adds CPF field during registration in My Account
		 * @since release
		 * 
		 */
		public static function racar_add_cpf_field_to_registration() {
			wp_enqueue_script( 'woocommerce-extra-checkout-fields-for-brazil-front' );
			wp_enqueue_style( 'woocommerce-extra-checkout-fields-for-brazil-front' );
			?>
			<p class="form-row form-row-wide person-type-field validate-required is-active woocommerce-validated" id="billing_cpf_field" data-priority="23" style="">
				<label for="billing_cpf" class="">CPF&nbsp;<abbr class="required" title="obrigatório">*</abbr></label>
				<span class="woocommerce-input-wrapper">
					<input type="tel" class="input-text " name="billing_cpf" id="billing_cpf" placeholder="" value="" maxlength="14">
				</span>
			</p>
			<?php 
			// wp_nonce_field( 'roapc_nonce_action', 'roapc_nonce_value' );
		}

	
		/**
		 * Saves CPF field during registration in My Account
		 * @since release
		 * 
		 */
		public static function racar_save_cpf_field( $customer_id ) {
			if( is_checkout() ) { //uses woocommerce registration nonce on checkout
				if( ! isset( $_REQUEST['woocommerce-process-checkout-nonce'] ) OR ! wp_verify_nonce( sanitize_text_field( wp_unslash ( $_REQUEST['woocommerce-process-checkout-nonce'] ) ), 'woocommerce-process_checkout' ) ) {
					die( __( 'Security check failed', 'racar-one-account-per-cpf' ) ); 
				}
			} else { //uses regular register nonce elsewhere
				if( ! isset( $_REQUEST['woocommerce-register-nonce'] ) OR ! wp_verify_nonce( sanitize_text_field( wp_unslash ( $_REQUEST['woocommerce-register-nonce'] ) ), 'woocommerce-register' ) ) {
					die( __( 'Security check failed', 'racar-one-account-per-cpf' ) ); 
				}
			}
			if( isset( $_POST['billing_cpf'] ) ) {
				update_user_meta( $customer_id, 'billing_cpf', sanitize_text_field( $_POST['billing_cpf'] ) );
			}
		}
	}
}

	