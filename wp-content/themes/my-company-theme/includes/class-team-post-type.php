<?php

class Team_Post_Type
{
    public function __construct()
    {
        add_action('init', [$this, 'ct_cpt_register']);
    }

    public function ct_cpt_register()
    {
        register_post_type('team', array(
                'labels' => array(
                    'name' => __('Team Members', 'my-company-theme'),
                    'singular_name' => __('Team Member', 'my-company-theme'),
                ),
                'public' => true,
                'has_archive' => true,
                'supports' => array('title', 'thumbnail'),
                'menu_icon' => 'dashicons-groups',
            )
        );
    }
}
