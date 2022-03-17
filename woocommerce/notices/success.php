<?php
/**
 * Show messages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/notices/success.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! $notices ) {
	return;
}

?>


<?php	foreach ( $notices as $notice ) : ?>

	<div data-uk-alert class="woocommerce-message uk-alert-success" <?php echo wc_get_notice_data_attr( $notice ); ?> role="alert" >
		<a class="uk-alert-close" data-uk-close></a>
		<div class="uk-flex uk-flex-middle">
			<div class="uk-margin-small-bottom uk-visible@s">
				<span data-uk-icon="icon:ft-success;ratio:1;" class="uk-margin-right"></span>
			</div>
			<div class="uk-text-bold">
					<p class="uk-margin-remove-top uk-margin-small-bottom">
					<?php echo wc_kses_notice( $notice['notice'] ); ?>
					</p>
			</div>
		</div>
	</div>

<?php	endforeach; ?>
