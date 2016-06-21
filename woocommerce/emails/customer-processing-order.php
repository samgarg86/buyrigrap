<?php
/**
 * Customer processing order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-processing-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



/**
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<p><h2><?php _e( "Order Details", 'woocommerce' ); ?></h2></p>

<table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%">
	<tbody>
		<tr>
			<td width="140" style="width:105.0pt;border-top:solid #e3e3e5 1.0pt;border-left:none;border-bottom:solid #e3e3e5 1.0pt;border-right:none;background:#f8f8f8;padding:12px; font-size:10.0pt;font-family:Arial,sans-serif;color:#585858">
				<strong>Confirmation number</strong>
			</td>
			<td style="border-top:solid #e3e3e5 1.0pt;border-left:none;border-bottom:solid #e3e3e5 1.0pt;border-right:none;padding:15.0pt 45.0pt 15.0pt 45.0pt;font-size:10.0pt;">
				<?php echo($order->get_order_number()) ?>
			</td>
		</tr>
		<tr>
			<td width="140" style="width:105.0pt;border-top:solid #e3e3e5 1.0pt;border-left:none;border-bottom:solid #e3e3e5 1.0pt;border-right:none;background:#f8f8f8;padding:12px; font-size:10.0pt;font-family:Arial,sans-serif;color:#585858">
				<strong>Purchase Date</strong>
			</td>
			<td style="border-top:solid #e3e3e5 1.0pt;border-left:none;border-bottom:solid #e3e3e5 1.0pt; border-right:none;padding:15.0pt 45.0pt 15.0pt 45.0pt; font-size:10.0pt;" >
				<?php printf( '<time datetime="%s">%s</time>', date_i18n( 'c', strtotime( $order->order_date ) ), date_i18n( wc_date_format(), strtotime( $order->order_date ) ) ); ?>
			</td>
		</tr>
		<tr>
			<td width="140" style="width:105.0pt;border-top:solid #e3e3e5 1.0pt;border-left:none;border-bottom:solid #e3e3e5 1.0pt;border-right:none;background:#f8f8f8;padding:12px; font-size:10.0pt;font-family:Arial,sans-serif;color:#585858">
				<strong>Purchase Amount</strong>
			</td>
			<td style="border-top:solid #e3e3e5 1.0pt;border-left:none;border-bottom:solid #e3e3e5 1.0pt; border-right:none;padding:15.0pt 45.0pt 15.0pt 45.0pt; font-size:10.0pt;" >
				$<?php echo($order-> get_total()) ?>
			</td>
		</tr>

		<?php wc_get_template( 'emails/email-addresses.php', array( 'order' => $order ) ); ?>

	</tbody>
</table>


<?php

/**
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @since 2.5.0
 */
do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

/**
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );

