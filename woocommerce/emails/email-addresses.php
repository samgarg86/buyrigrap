<?php
/**
 * Email Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-addresses.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

		<tr>
			<td width="140" style="width:105.0pt;border-top:solid #e3e3e5 1.0pt;border-left:none;border-bottom:solid #e3e3e5 1.0pt;border-right:none;background:#f8f8f8;padding:12px; font-size:10.0pt;font-family:Arial,sans-serif;color:#585858">
				<strong><?php _e( 'Billing address', 'woocommerce' ); ?></strong>
			</td>
			<td style="border-top:solid #e3e3e5 1.0pt;border-left:none;border-bottom:solid #e3e3e5 1.0pt;border-right:none;padding:15.0pt 45.0pt 15.0pt 45.0pt;font-size:10.0pt;">
				<?php echo $order->get_formatted_billing_address(); ?>
			</td>
		</tr>
		<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && ( $shipping = $order->get_formatted_shipping_address() ) ) : ?>
		<tr>
			<td width="140" style="width:105.0pt;border-top:solid #e3e3e5 1.0pt;border-left:none;border-bottom:solid #e3e3e5 1.0pt;border-right:none;background:#f8f8f8;padding:12px; font-size:10.0pt;font-family:Arial,sans-serif;color:#585858">
				<strong><?php _e( 'Shipping address', 'woocommerce' ); ?></strong>
			</td>
			<td style="border-top:solid #e3e3e5 1.0pt;border-left:none;border-bottom:solid #e3e3e5 1.0pt;border-right:none;padding:15.0pt 45.0pt 15.0pt 45.0pt;font-size:10.0pt;">
				<?php echo $shipping; ?>
			</td>
		</tr>
		<?php endif; ?>


