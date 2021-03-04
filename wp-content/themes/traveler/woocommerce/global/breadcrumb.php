<?php
/**
 * Shop breadcrumb
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $breadcrumb ) {

	echo balanceTags($wrap_before);

	foreach ( $breadcrumb as $key => $crumb ) {

		echo balanceTags($before);

		if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
			echo '<a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a>';
		} else {
			echo '<a class="last">'.esc_html( $crumb[0] ).'</a>';
		}

		echo balanceTags($after);

		if ( sizeof( $breadcrumb ) !== $key + 1 ) {
			echo balanceTags($delimiter);
		}

	}

	echo balanceTags($wrap_after);

}