<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<div class="uk-container uk-container-fluid uk-margin-top">
	<div class="uk-grid-small uk-padding-vertical" uk-grid>

		<form class="uk-width-2-3@l woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
			<?php do_action( 'woocommerce_before_cart_table' ); ?>

			<header class="uk-text-uppercase uk-text-muted uk-text-center uk-text-small uk-visible@m">
				<div class="uk-grid-small" uk-grid>
					<div class="uk-width-small"></div>
					<div class="uk-width-expand uk-h3 uk-text-muted">
						<div class="uk-grid-small uk-child-width-expand uk-card-body uk-card-small" uk-grid>
							<div class="uk-width-expand@s uk-h3 uk-text-muted uk-text-left"><?php esc_html_e( 'Product', 'woocommerce' ); ?></div>
							<div class="uk-h3 uk-text-muted uk-width-small"><?php esc_html_e( 'Price', 'woocommerce' ); ?></div>
							<div class="tm-quantity-column uk-h3 uk-text-muted uk-width-small"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></div>
							<div class="uk-width-small"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></div>
							<div class="uk-width-auto"><div style="width: 20px;"></div></div>
						</div>
					</div>
				</div>
			</header>


			<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

						$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
							$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
							?>

						<div class="uk-card uk-card-default uk-padding-small uk-overflow-hidden uk-margin-small-bottom  <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
							<div class="uk-flex-middle" uk-grid>
								<div class="uk-width-small@s uk-width-1-3">
									<div class="uk-text-center uk-text-left@m uk-grid-small uk-flex uk-flex-middle uk-flex-center uk-child-width-1-1" uk-grid>
										<div class="cart-thumbnail">
											<?php
											$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image('original'), $cart_item, $cart_item_key );

											if ( ! $product_permalink ) {
												echo $thumbnail; // PHPCS: XSS ok.
											} else {
												printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
											}
											?>
										</div>
									</div>
								</div>

								<div class="uk-width-expand@s uk-width-2-3">
									<div class="uk-flex-middle uk-grid-small uk-child-width-1-1 uk-child-width-expand@m uk-text-center@m uk-text-left" uk-grid>
										<div class="uk-width-expand@m uk-text-left@s uk-text-center">
											<div class="uk-hidden@s uk-padding-small uk-padding-remove-top"></div>
											<h3 class="uk-margin-remove-top uk-margin-remove-bottom uk-text-left">
												<span class="uk-display-inline-block uk-link-reset">
													<?php
													if ( ! $product_permalink ) {
														echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
													} else {
														echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a class="uk-link-reset" href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
													}

													do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

													// Meta data.
													echo wc_get_formatted_cart_item_data( $cart_item, false ); // PHPCS: XSS ok.

													// Backorder notification.
													if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
														echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
													}
													?>
												</span>
											</h3>
										</div>
										<div class="uk-width-small@m uk-width-1-1">
											<div class="uk-h3 uk-margin-remove">
												<span class="uk-text-muted uk-hidden@m">
													<?php esc_html_e( 'Price', 'woocommerce' ); ?>: </span><?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?>
											</div>
										</div>
										<div class="tm-cart-quantity-column uk-width-small@m uk-width-1-1">
											<?php
											if ( $_product->is_sold_individually() ) {
												$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
											} else {
												$product_quantity = woocommerce_quantity_input(
													array(
														'input_name'   => "cart[{$cart_item_key}][qty]",
														'input_value'  => $cart_item['quantity'],
														'max_value'    => $_product->get_max_purchase_quantity(),
														'min_value'    => '0',
														'product_name' => $_product->get_name(),
													),
													$_product,
													false
												);
											}

											echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
											?>
										</div>
										<div class="uk-width-small@m uk-width-1-1">
											<div class="uk-h3 uk-margin-remove">
												<span class="uk-text-muted uk-hidden@m">
													<?php esc_html_e( 'Subtotal', 'woocommerce' ); ?>: </span><?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
											</div>
										</div>
										<div class="uk-width-auto@m uk-width-1-1 product-remove">
											<?php
											echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
												'woocommerce_cart_item_remove_link',
												sprintf(
													'<a href="%s" class="remove uk-icon-button" uk-icon="close"  aria-label="%s" data-product_id="%s" data-product_sku="%s"></a>',
													esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
													esc_html__( 'Remove this item', 'woocommerce' ),
													esc_attr( $product_id ),
													esc_attr( $_product->get_sku() )
												),
												$cart_item_key
											);
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
					} ?>
					<?php
				}
			}
			?>

			<?php do_action( 'woocommerce_cart_contents' ); ?>


			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
				
			<?php do_action( 'woocommerce_after_cart_table' ); ?>
		</form>

		<div class="uk-width-1-3@l cart-collaterals">
			<?php
				/**
				 * Cart collaterals hook.
				 *
				 * @hooked woocommerce_cross_sell_display
				 * @hooked woocommerce_cart_totals - 10
				 */
				do_action( 'woocommerce_cart_collaterals' );
			?>
		</div>

	</div>
</div>


<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>



<?php do_action( 'woocommerce_after_cart' ); ?>
