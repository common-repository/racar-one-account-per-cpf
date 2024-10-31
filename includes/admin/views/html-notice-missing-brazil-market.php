<?php
/**
 * Missing WooCommerce notice.
 *
 * @package roapc/Admin/views
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$is_installed = false;
global $roapc_plugin_name;

if ( function_exists( 'get_plugins' ) ) {
	$all_plugins  = get_plugins();
	$is_installed = ! empty( $all_plugins['woocommerce-extra-checkout-fields-for-brazil/woocommerce-extra-checkout-fields-for-brazil.php'] );
}

?>

<div class="error">
	<p><strong><?php esc_html_e( 'RaCar One Account Per CPF' , 'racar-one-account-per-cpf' ); ?></strong> <?php esc_html_e( 'depends on Brazilian Market on WooCommerce to be installed and active in order to work!', 'racar-one-account-per-cpf' ); ?></p>

	<?php if ( $is_installed && current_user_can( 'install_plugins' ) ) : ?>
		<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'plugins.php?action=activate&plugin=woocommerce-extra-checkout-fields-for-brazil/woocommerce-extra-checkout-fields-for-brazil.php&plugin_status=all' ), 'activate-plugin_woocommerce-extra-checkout-fields-for-brazil/woocommerce-extra-checkout-fields-for-brazil.php' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Activate Brazilian Market on WooCommerce', 'racar-one-account-per-cpf' ); ?></a></p>
	<?php else :
		if ( current_user_can( 'install_plugins' ) ) {
			$url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=woocommerce-extra-checkout-fields-for-brazil' ), 'install-plugin_woocommerce-extra-checkout-fields-for-brazil' );
		} else {
			$url = 'http://wordpress.org/plugins/woocommerce-extra-checkout-fields-for-brazil/';
		}
	?>
		<p><a href="<?php echo esc_url( $url ); ?>" class="button button-primary"><?php esc_html_e( 'Install Brazilian Market on WooCommerce', 'racar-one-account-per-cpf' ); ?></a></p>
	<?php endif; ?>
</div>
