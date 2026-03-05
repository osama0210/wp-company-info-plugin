<?php

class Team_Api
{
    public function __construct()
    {
        add_action('admin_menu', [$this, 'register_page']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_scripts']);

    }

    public function register_page()
    {
        add_menu_page(
                'Team APi',
                'Team API',
                'manage_options',
                'team-api',
                [$this, 'render_page']
        );
    }

    public function render_page()
    {
        ?>
        <div class="wrap">
            <h1><?php _e('Add Team Member', 'my-company-theme'); ?></h1>

            <form id="team-form">
                <input type="text" id="team-title" placeholder="Name"/>
                <input type="text" id="team-function" placeholder="Function"/>
                <input type="text" id="team-email" placeholder="Email"/>
                <input type="text" id="team-linkedin" placeholder="LinkedIn"/>
                <button type="submit">Add Member</button>
            </form>
            <div id="team-response"></div>
        </div>
        <?php
    }

    public function enqueue_scripts()
    {
        $screen = get_current_screen();
        if ($screen->id === 'toplevel_page_team-api') {
            wp_enqueue_script('team-api', get_template_directory_uri() . '/assets/js/team-api.js', [], '1.0', true);
            wp_localize_script('team-api', 'wpApiSettings', [
                    'nonce' => wp_create_nonce('wp_rest'),
                    'url' => rest_url('wp/v2/team'),
            ]);
        }
    }

}
