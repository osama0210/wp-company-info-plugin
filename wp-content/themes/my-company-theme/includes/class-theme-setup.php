<?php

class Theme_Setup
{
    public function __construct()
    {
        add_action('after_setup_theme', [$this, 'setup']);
    }

    public function setup()
    {
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );

        register_nav_menus( [
            'primary' => __( 'Primary Menu', 'my-company-theme' ),
            'footer' => __( 'Footer Menu', 'my-company-theme' )
        ] );

        load_theme_textdomain( 'my-company-theme', get_template_directory() . '/languages' );
    }

}
