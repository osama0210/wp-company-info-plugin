<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class Team_Post_Type
{
    public function __construct()
    {
        add_action('init', [$this, 'cpt_register']);
    }

    public function cpt_register()
    {
        register_post_type('team', array(
                'labels' => array(
                    'name' => __('Team Members', 'my-company-theme'),
                    'singular_name' => __('Team Member', 'my-company-theme'),
                ),
                'show_in_rest' => true,
                'rest_controller_class' => 'WP_REST_Posts_Controller',
                'public' => true,
                'has_archive' => true,
                'supports' => array('title', 'thumbnail'),
                'menu_icon' => 'dashicons-groups',
            )

        );
        register_post_meta('team', '_team_function', [
            'show_in_rest' => true,
            'single' => true,
            'type' => 'string',
        ]);

        register_post_meta('team', '_team_email', [
            'show_in_rest' => true,
            'single' => true,
            'type' => 'string',
        ]);

        register_post_meta('team', '_team_linkedin', [
            'show_in_rest' => true,
            'single' => true,
            'type' => 'string',
        ]);
    }
}
