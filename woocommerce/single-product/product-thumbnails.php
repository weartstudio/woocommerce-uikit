<?php 
defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$attachment_ids = $product->get_gallery_image_ids();

$img_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($product->get_id()), 'thumbnail' )[0];
$img_url = wp_get_attachment_url( get_post_thumbnail_id($product->get_id()) );
$img_large = wp_get_attachment_image_src( get_post_thumbnail_id($product->get_id()), 'large' )[0];

	if( $img_url == '' ){
		$img_url = esc_url( get_template_directory_uri() ).'/assets/img/placeholder.jpg';
		$img_large = esc_url( get_template_directory_uri() ).'/assets/img/placeholder.jpg';
	}
?>

<div class="uk-position-relative uk-width-1-1 uk-height-1-1" uk-slider>

	<div class="uk-position-relative uk-height-1-1 slider-items-container">
		<ul class="uk-slider-items uk-height-1-1" uk-lightbox="animation: fade">

			<?php 
			// first
			ft_big_thumbnail_display( $img_large, 0, $img_url );
			// additional images
			$attachment_ids = $product->get_gallery_image_ids();
			if ( $attachment_ids && has_post_thumbnail() ) :
			foreach ( $attachment_ids as $attachment_id ) :
				$img_full = wp_get_attachment_url( $attachment_id );
				$img_large = wp_get_attachment_image_src( $attachment_id, 'large' )[0];
				ft_big_thumbnail_display( $img_large, 0, $img_url );
			endforeach; endif; ?>

		</ul>

		<?php if ( $attachment_ids ) {?>
			<div class="uk-slidenav-container">
				<a class="uk-position-center-left uk-position-small uk-link-reset" href="#" uk-slider-item="previous"><span
						uk-icon="ft-prev"></span></a>
				<a class="uk-position-center-right uk-position-small uk-link-reset" href="#" uk-slider-item="next"><span
						uk-icon="ft-next"></span></a>
			</div>
		<?php }?>
	</div>

	<?php if ( $attachment_ids && has_post_thumbnail() ) { ?>
	<div class="uk-position-relative uk-margin-small-top uk-width-1-1">
		<ul class="thumbnails uk-thumbnav uk-child-width-1-5@l" uk-grid>

			<?php 
			ft_thumnail_display($img_thumbnail,0);
			$id=1; foreach ( $attachment_ids as $attachment_id ) {
					$img_url = wp_get_attachment_image_src( $attachment_id, 'thumbnail' )[0];
					ft_thumnail_display($img_url, $id);
			$id++;	}	?>

		</ul>
	</div>
	<?php	} ?>

</div>

<?php 
// helper functions

// display 'small' thumbnail image items
function ft_thumnail_display($img, $id){
	?>
	<li uk-slider-item="<?php echo  esc_attr($id) ?>">
		<a href="#img">
			<img src="<?php echo esc_url( $img ); ?>">
		</a>
	</li>
	<?php 
}

// main 'big' tumbnail image items
function ft_big_thumbnail_display( $img, $id, $img_url ){
	?>
	<li class="uk-height-1-1">
		<a href="<?php echo $img_url; ?>"	class=" uk-display-block uk-width-1-1 uk-height-1-1 uk-text-center uk-text-left@m" data-caption="<?php echo esc_html( get_the_title() ); ?>">
			<img src="<?php echo $img; ?>" class="uk-height-auto uk-height-1-1@l object-fit-cover">
		</a>
	</li>
	<?php 
}