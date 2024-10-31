<?php
/**
 * Admin Search
 *
 * @package roapc/Admin/views
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if( class_exists( 'roapc_Plugin_Pro' ) ) return;
?>
<div class="wrap">
	<h2 class='pro-only'><?php esc_html_e( 'Perform Key activation', 'racar-one-account-per-cpf' ); ?></h2>
	<p class="pro-feature"><?php echo esc_html__( 'This is only necessary when you buy the Premium Version of this plugin.', 'racar-one-account-per-cpf' ) . '  <a href="http://wa.me/5521982130264" target="_blank">' . esc_html__( 'Buy now!', 'racar-one-account-per-cpf' ) . '</a>'; ?></p>
	<form id='roapc-activation-key-form' action='' method='post'>
		<input type="text" name="roapc_activation_key" id="roapc-text-key" placeholder="<?php esc_html__( 'type or paste key here', 'racar-one-account-per-cpf' );?>" value="" disabled>
		<input type="submit" name="submit_activation_key" id="submit" class="button button-primary" value="<?php esc_html_e( 'Activate Key', 'racar-one-account-per-cpf' ); ?>" disabled>
	</form>
</div>
