<?php
/**
 * Additional Customer Details
 *
 * This is extra customer data which can be filtered by plugins. It outputs below the order item table.
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
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<h2><?php _e( 'Customer details', 'woocommerce' ); ?></h2>
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%">
	<tbody>

    <?php foreach ( $fields as $field ) : ?>
            <tr>
            	<td width="140" style="width:105.0pt;border-top:solid #e3e3e5 1.0pt;border-left:none;border-bottom:solid #e3e3e5 1.0pt;border-right:none;background:#f8f8f8;padding:12px; font-size:10.0pt;font-family:Arial,sans-serif;color:#585858">
                <strong><?php echo wp_kses_post( $field['label'] ); ?></strong>
            </td>
            <td style="border-top:solid #e3e3e5 1.0pt;border-left:none;border-bottom:solid #e3e3e5 1.0pt;border-right:none;padding:15.0pt 45.0pt 15.0pt 45.0pt">
                <?php echo wp_kses_post( $field['value'] ); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    	</tbody>
    </table>
