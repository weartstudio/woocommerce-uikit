<?php

Class ThemeSupport extends Singleton
{

    public $themeSupport = array(
        'title-tag',
        'post-thumbnails',
        'menus',
        'woocommerce'
    );

    public function __construct()
    {
        foreach($this -> themeSupport as $item)
        {
            add_theme_support( $item );
        }

        // remove gutenberg editor
        add_filter( 'use_block_editor_for_post', '__return_false', 10 );
        add_filter( 'use_block_editor_for_post_type', '__return_false', 10 );
        add_filter( 'use_widgets_block_editor', '__return_false' );

    }

}

ThemeSupport::getInstance();