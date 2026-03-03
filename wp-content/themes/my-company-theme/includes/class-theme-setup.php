<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Theme_Setup
{
    public function __construct()
    {
        add_action('after_setup_theme', [$this, 'setup']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_slider_assets']);

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

        wp_register_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', [], '11');
        wp_register_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], '11', true);
        wp_register_script('my-theme-slider', get_template_directory_uri() . '/assets/js/slider.js', ['swiper'], '1.0', true);
    }

    public function enqueue_slider_assets()
    {
        if (is_front_page()) {
            wp_enqueue_style('swiper');
            wp_enqueue_script('swiper');
            wp_enqueue_script('my-theme-slider');
        }
    }
}
