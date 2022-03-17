<?php 
defined( 'ABSPATH' ) || exit;

get_header( 'shop' ); 
do_action( 'woocommerce_before_main_content' );
?>

<article class="uk-container uk-container-xlarge uk-margin-medium-top uk-margin-medium-bottom">
	<?php 
		if( have_posts() ):
			while ( have_posts() ) : the_post(); 
				global $product;
				// @hooked woocommerce_output_all_notices - 10
				do_action( 'woocommerce_before_single_product' );
				if ( post_password_required() ) {	echo get_the_password_form(); return;	}	
			?>

	<?php /* top of the post */ ?>
	<div class="uk-margin-bottom uk-flex uk-flex-between uk-grid-small" uk-grid>

		<div>
			<?php woocommerce_breadcrumb();?>
		</div>

		<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ): ?>
			<div class="uk-visible@s">
				<span class="uk-text-muted uk-text-uppercase uk-h6 uk-margin-remove">
					#<?php echo $product->get_sku() ?>
				</span>
			</div>
		<?php endif; ?>
		
	</div>

	<?php /* content of the post */ ?>
	<div id="product-<?php the_ID(); ?>" <?php wc_product_class( ' ', $product ); ?>>

		<header class="uk-margin-medium-bottom" uk-grid>

			<div class="uk-width-1-2@s">
				<div class="uk-position-relative">
					<?php 
					do_action('woocommerce_product_thumbnails');
					if ( $product->is_on_sale() ) : ?>
						<span	class="uk-label uk-border-pill uk-label-warning uk-position-small uk-position-top-right onsale">
							<?php esc_html_e( 'Sale!', 'woocommerce' ) ?>
						</span>
					<?php endif;	?>
				</div>
			</div>

			<div class="uk-width-1-2@s">

				<h1 class="uk-margin-remove"><?php the_title(); ?></h1>
				<div class="text">
					<?php the_excerpt(); ?>
	
					<?php /* ár */ ?>
					<p class="uk-margin-remove <?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>">
						<?php echo $product->get_price_html(); ?>
					</p>
				</div>

				<?php /* raktár*/ ?>
				<p class="stock <?php echo esc_attr( $class ); ?>">
					<?php echo wp_kses_post( $availability ); ?>
				</p>

				<?php
							/* @hooked woocommerce_template_single_rating - 10
							 * @hooked woocommerce_template_single_add_to_cart - 30
							 * @hooked WC_Structured_Data::generate_product_data() - 60 */
							do_action( 'woocommerce_single_product_summary' );
							?>

				<?php /* for share plugins */ do_action( 'woocommerce_share' ); ?>

			</div>
		</header>

		<?php
			/* @hooked woocommerce_output_product_data_tabs - 10
				* @hooked woocommerce_upsell_display - 15
				* @hooked woocommerce_output_related_products - 20 */
			do_action( 'woocommerce_after_single_product_summary' );
		?>

	</div>

	<?php endwhile;
		endif;	
	?>
</article>

<?php 
do_action( 'woocommerce_after_main_content' );
get_footer( 'shop' );