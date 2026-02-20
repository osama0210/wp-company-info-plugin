<?php

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
        $function = get_post_meta($post->ID, '_team_function', true);
        $email = get_post_meta($post->ID, '_team_email', true);
        $linkedin = get_post_meta($post->ID, '_team_linkedin', true);

        ?>
        <label><?php _e('Function', 'my-company-theme'); ?></label>
        <input type="text" name="_team_function" value="<?php echo esc_attr($function); ?>">

        <label><?php _e('Email', 'my-company-theme'); ?></label>
        <input type="email" name="_team_email" value="<?php echo esc_attr($email); ?>">

        <label><?php _e('LinkedIn', 'my-company-theme'); ?></label>
        <input type="url" name="_team_linkedin" value="<?php echo esc_attr($linkedin); ?>">
        <?php
    }

    public function save_meta_box()
    {

    }
}