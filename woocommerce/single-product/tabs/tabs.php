<?php
defined( 'ABSPATH' ) || exit;

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $product_tabs ) ) : ?>
	<div class="uk-container">

		<ul uk-tab uk-switcher>
			<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
			<li id="tab-title-<?php echo esc_attr( $key ); ?>">
				<a href="#tab-<?php echo esc_attr( $key ); ?>">
					<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
				</a>
			</li>
			<?php endforeach; ?>
		</ul>

		<ul class="uk-switcher uk-margin-medium-bottom">
			<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
				<li id="tab-<?php echo esc_attr( $key ); ?>" >
					<?php
					if ( isset( $product_tab['callback'] ) ) {
						call_user_func( $product_tab['callback'], $key, $product_tab );
					}
					?>
				</li>
			<?php endforeach; ?>

			<?php do_action( 'woocommerce_product_after_tabs' ); ?>
		</ul>

	</div>
<?php endif; ?>
