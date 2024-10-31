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

<div class="wrap roapc">
	<h2><?php esc_html_e( 'Perform a search for duplicates', 'racar-one-account-per-cpf' ); ?></h2>
	<p class="pro-feature"><?php echo esc_html__( 'This is Pro Feature of this plugin\'s Premium Version.', 'racar-one-account-per-cpf' ) . ' <a href="http://wa.me/5521982130264" target="_blank">' . esc_html__( 'Buy now!', 'racar-one-account-per-cpf' ) . '</a>'; ?></p>
	<form action='' method='post'>
		<input type="submit" name="submit_search" id="submit" class="button button-primary" value="<?php esc_html_e( 'Search for Duplicates', 'racar-one-account-per-cpf' ); ?>" disabled>
	</form>
</div>
