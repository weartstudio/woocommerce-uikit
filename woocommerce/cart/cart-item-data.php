<?php
/**
 * Cart item data (when outputting non-flat)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-item-data.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     2.4.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="variation uk-margin-small-top">
	<?php foreach ( $item_data as $data ) : ?>
		<div class="uk-flex uk-text-light uk-text-small">
			<span class="<?php echo sanitize_html_class( 'variation-' . $data['key'] ); ?> uk-margin-small-right"><?php echo wp_filter_nohtml_kses( $data['key'] ); ?>:</span>
			<span class="<?php echo sanitize_html_class( 'variation-' . $data['key'] ); ?>"><?php echo wp_filter_nohtml_kses( wpautop( $data['display'] ) ); ?></span>
		</div>
	<?php endforeach; ?>
</div>
