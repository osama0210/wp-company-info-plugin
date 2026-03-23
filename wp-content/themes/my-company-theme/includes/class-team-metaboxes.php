<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Team_Meta
{
    public function __construct()
    {
        add_action('add_meta_boxes', [$this, 'register_meta_box']);
        add_action('save_post', [$this, 'save_meta_box']);
    }

    public function register_meta_box()
    {
        add_meta_box(
            'team-info',
            __('Team Info', 'my-company-theme'),
            [$this, 'render_meta_box'],
            'team'
        );
    }

    public function render_meta_box($post)
    {
        $function = get_post_meta($post->ID, 'team_function', true);
        $email = get_post_meta($post->ID, 'team_email', true);
        $linkedin = get_post_meta($post->ID, 'team_linkedin', true);

        wp_nonce_field('team_meta_box', 'team_meta_box_nonce');

        ?>
        <label><?php _e('Function', 'my-company-theme'); ?></label>
        <input type="text" name="team_function" value="<?php echo esc_attr($function); ?>">

        <label><?php _e('Email', 'my-company-theme'); ?></label>
        <input type="email" name="team_email" value="<?php echo esc_attr($email); ?>">

        <label><?php _e('LinkedIn', 'my-company-theme'); ?></label>
        <input type="url" name="team_linkedin" value="<?php echo esc_attr($linkedin); ?>">
        <?php
    }

    public function save_meta_box($post_id)
    {
        if (get_post_type($post_id) !== 'team') {
            return;
        }

        if (!isset($_POST['team_meta_box_nonce']) || !wp_verify_nonce($_POST['team_meta_box_nonce'], 'team_meta_box')) {
            return;
        }

        if (isset($_POST['team_function'])) {
            update_post_meta($post_id, 'team_function', sanitize_text_field($_POST['team_function']));
        }

        if (isset($_POST['team_email'])) {
            update_post_meta($post_id, 'team_email', sanitize_email($_POST['team_email']));
        }

        if (isset($_POST['team_linkedin'])) {
            update_post_meta($post_id, 'team_linkedin', esc_url_raw($_POST['team_linkedin']));
        }

    }
}