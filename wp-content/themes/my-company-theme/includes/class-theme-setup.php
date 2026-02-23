<?php

class Theme_Setup
{
    public function __construct()
    {
        add_action('after_setup_theme', [$this, 'setup']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);

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

    public function enqueue_assets()
    {
        wp_enqueue_style('my-company-theme', get_template_directory_uri() . '/assets/css/style.css', [], '1.0');
    }

}
