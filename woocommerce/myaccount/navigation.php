<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );
?>

<!-- desktop nav -->
<nav class="uk-visible@m uk-flex uk-flex-between uk-container uk-container-xlarge woocommerce-MyAccount-navigation">
	<ul class="uk-tab uk-tab-bottom">
		<?php
		// ebből a listából el kéne tüntetni a kijelentkezés gombot, illetve a "vezérlőpultot", és az adataimnak kéne az elsőnek lenni (ahogyan figmában van)
		foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
				<a class="" href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
	<div>
		<!-- ide pedig be kéne állítani a kijelentkezéshez az url-t -->
		<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'customer-logout' ) ); ?>" class="uk-flex uk-link-reset logout-link">
			<span class="uk-align-center uk-button uk-inline uk-link-reset uk-margin-remove uk-padding-remove-horizontal uk-text-normal uk-text-uppercase"><?php _e('Kijelentkezés', 'finecart'); ?></span>
			<span uk-icon="icon:ft-exit;ratio:1;" class="uk-margin-small-left uk-flex uk-flex-middle"></span>
		</a>
	</div>
</nav>

<!-- mobile nav -->
<nav class="uk-hidden@m">
	<span class="uk-button uk-button-secondary uk-text-left uk-width-expand uk-flex uk-flex-middle"><span class="uk-margin-right"><?php the_title(); ?></span> <span uk-icon="icon: chevron-down"></span></span>
	<div uk-dropdown="mode: click;">
		<ul class="uk-nav uk-dropdown-nav">
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
			</li>
		<?php endforeach; ?>

			<li class="<?php echo wc_get_account_menu_item_classes( 'customer-logout' ); ?>">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'customer-logout' ) ); ?>" class="logout-link">
					<?php echo __( 'Logout', 'woocommerce' ); ?>
				</a>
			</li>

		</ul>
	</div>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
