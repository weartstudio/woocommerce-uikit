<?php

Class MenusHandler extends Singleton
{

    public function __construct()
    {
        add_action( 'after_setup_theme', array( $this, 'registerNavMenus' ) );

    }

    public function registerNavMenus()
    {
        register_nav_menus(
            array(
                'primary'       => 'Primary',
            )
        );
    }

}

MenusHandler::getInstance();