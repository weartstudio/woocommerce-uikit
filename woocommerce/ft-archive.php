<?php 
defined( 'ABSPATH' ) || exit;
get_header( 'shop' ); 
do_action( 'woocommerce_before_main_content' ); ?>

<section class="uk-background-muted uk-background-cover" <?php ft_woocommerce_category_featured_image() ?>>
	<div class="uk-container uk-container-xlarge">
		<div class="uk-section">
			<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
				<h1 class="uk-text-success uk-text-uppercase"><?php woocommerce_page_title(); ?></h1>
			<?php endif; ?>
		</div>
		<div class="uk-margin-bottom" uk-grid>
				<div class="uk-width-auto uk-margin-auto-left">
					<?php woocommerce_catalog_ordering() ?>
				</div>
		</div>
	</div>
</section>


<div class="uk-container uk-container-xlarge uk-margin-medium-top">
    <div uk-grid>

        <?php if ( is_active_sidebar( 'ft-shop' )  ) : 
					dynamic_sidebar('ft-shop');
        endif; ?>
				
        <?php if ( have_posts() ) : ?> 
            <div class="uk-width-expand">

							<?php if ( woocommerce_product_loop() ) : ?>

								<?php do_action( 'woocommerce_before_shop_loop' ); ?>
								<?php woocommerce_product_loop_start() ?>
									<?php if ( wc_get_loop_prop( 'total' ) ) : ?>
										<?php while ( have_posts() ) : the_post(); ?>
											<?php wc_get_template_part( 'content', 'product' ); ?>
										<?php endwhile; ?>
									<?php endif; ?>
								<?php woocommerce_product_loop_end() ?>

								<?php do_action( 'woocommerce_after_shop_loop' ); ?>

								<hr class="uk-margin-remove-bottom">
								
								<div class="uk-section uk-section-small">
									<?php woocommerce_product_archive_description() ?>
								</div>

							<?php	else : do_action( 'woocommerce_no_products_found' );	endif; ?>

            </div>
        <?php endif; ?>
        
    </div>
</div>

<?php 
do_action( 'woocommerce_after_main_content' );
get_footer( 'shop' );

// image
function ft_woocommerce_category_featured_image() {
  
	if ( is_product_category() ){
			global $wp_query;
			
			// get the query object
			$cat = $wp_query->get_queried_object();
			// get the thumbnail id using the queried category term_id
			$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true ); 
			// Get the attachment image information. Set the thumbnail size you want here.
			$category_img = wp_get_attachment_image_src( $thumbnail_id, 'full', false );

			if ( $category_img ) {
					echo 'style="background-image: url(' . $category_img[0] . ');"';
			}
			wp_reset_postdata();

	} elseif (is_shop()) {
			// Help from https://gist.github.com/Bradley-D/7287723
			// Featured Image 
			// get the shop ID
			$post_id = get_option( 'woocommerce_shop_page_id' );
			// Set the url 
			$featured_image = get_the_post_thumbnail_url( $post_id, 'full' );;
			if ( $featured_image ) {
					echo 'style="background-image: url(' . $featured_image . ');"';
			}

	}
}
