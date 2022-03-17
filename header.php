<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<nav class="uk-navbar-container" uk-navbar>
    
    <div class="uk-navbar-left">
        <a class="uk-navbar-item uk-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo( 'name' ); ?>">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo-full.svg' ); ?>" alt="<?php bloginfo('name') ?>"></span>
        </a>

        <?php wp_nav_menu( array(
                'menu'              => 'primary',
                'theme_location'    => 'primary',
                'depth'             => 1,
                'container'         => '',
                'menu_class'        => 'uk-navbar-nav uk-visible@s',
                'fallback_cb'       => 'uikitNavWalker::fallback',
                'walker'            => new uikitNavWalker())
        ); ?>
    </div>

    <div class="uk-navbar-right">
        <ul class="uk-iconnav">
            <li><a href="#" uk-icon="ft-search" class="uk-icon-button"></a></li>
            <li><a href="#" uk-icon="ft-heart" class="uk-icon-button"></a></li>
            <li><a href="<?php the_permalink( wc_get_page_id( 'myaccount' ) ) ?>" uk-icon="ft-avatar" class="uk-icon-button"></a></li>
            <li class="uk-position-relative uk-margin-small-right">
                <a href="<?php echo esc_url( wc_get_cart_url() ) ?>" uk-icon="ft-cart" class="uk-icon-button">
                    <span class="uk-badge uk-position-absolute uk-background-secondary uk-text-bold" style="left: 3px;bottom: -5px;" id="cart-counter"><?php esc_attr_e( WC()->cart->get_cart_contents_count() ); ?></span>
                </a>
            </li>
        </ul>
    </div>


</nav>

<main id="main-content-container" style="min-height: 100vh">