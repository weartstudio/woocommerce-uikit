<?php
/**
 * The template for displaying product content within loops
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<div <?php wc_product_class('', $product ); ?>>
	<div class="uk-card uk-card-small uk-border uk-height-1-1">
		<?php
		/**
		 * Hook: woocommerce_before_shop_loop_item.
		 *
		 * @hooked woocommerce_template_loop_product_link_open - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item' );

		/**
		 * Hook: woocommerce_before_shop_loop_item_title.
		 *
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item_title' );
		?>
		<img src="<?php the_post_thumbnail_url() ?>" class="card-img-top">
		<div class="uk-card-body uk-text-center uk-paragraph-margin-remove">

			<?php // price
				if ( $price_html = $product->get_price_html() ) : ?>
					<span class="price"><?php echo $price_html; ?></span>
				<?php endif;
			?>

			<h2 class="uk-card-title uk-alt-heading uk-text-uppercase uk-margin-top">
				<?php
				the_title();
				do_action( 'woocommerce_shop_loop_item_title' );
				?>
			</h2>


			<?php // rating
				if ( wc_review_ratings_enabled() ) {
					echo wc_get_rating_html( $product->get_average_rating() );
				}
			?>

			<?php echo apply_filters( 'woocommerce_short_description', $product->get_short_description() ) ?>

			<?php
			do_action( 'woocommerce_after_shop_loop_item_title' );

			/**
			 * Hook: woocommerce_after_shop_loop_item.
			 *
			 * @hooked woocommerce_template_loop_product_link_close - 5
			 * @hooked woocommerce_template_loop_add_to_cart - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item' );
			?>
		</div>
	</div><!-- uk-card -->
</div>
