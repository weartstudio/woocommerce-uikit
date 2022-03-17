<?php

// display errors for debugging
if(isset($_GET['debug'])){
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

// globals
$currentTheme = wp_get_theme();
define('THEME_DIR', get_template_directory());
define('THEME_URI', get_template_directory_uri());
define('THEME_URI_CHILD', get_stylesheet_directory_uri());
define('THEME_TEXTDOMAIN', $currentTheme->get('TextDomain'));

// textdomain load automatically
load_theme_textdomain( 'THEME_TEXTDOMAIN', get_template_directory().'/languages' );

$includes = glob( get_template_directory() . "/includes/*.php");
if(is_array($includes)){
    foreach($includes as $include){
        require_once($include);
    }
}
