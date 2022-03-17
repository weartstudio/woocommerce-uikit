<?php

Class AssetsHandler extends Singleton
{

    public function __construct()
    {
        add_action('wp_enqueue_scripts', array( $this, 'addScriptsStyles' ) );
    }

    public function addScriptsStyles(){
        if(!is_admin()) {

            // uikit js
            wp_enqueue_script( 'uikit-icon-js', THEME_URI . '/assets/js/uikit.min.js', ['jquery'], null, true  );
            wp_enqueue_script( 'uikit-js', THEME_URI . '/assets/js/uikit-icons.min.js', ['jquery'], null, true  );

            // js
            wp_enqueue_script( 'theme-js', THEME_URI . '/assets/js/main.js', ['jquery'], null, true  );

            // theme style
            wp_enqueue_style( 'theme-css', THEME_URI . '/assets/css/main.min.css', [], null );

            // fontAwesome
            wp_enqueue_style( 'fontawesome-fonts', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css', [], null );

        }
    }

}

AssetsHandler::getInstance();