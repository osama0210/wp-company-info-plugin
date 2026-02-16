<?php

class CI_Dashboard_Widget
{
    public function __construct()
    {
        add_action('wp_dashboard_setup', [$this, 'add_dashboard_widget']);
    }

    public function add_dashboard_widget(): void
    {
        wp_add_dashboard_widget(
            'ci_widget',
            __('Company Information', 'company-info'),
            [$this, 'render_dashboard_widget']
        );
    }

    public function render_dashboard_widget(): void
    {
        ?>
        <ul>
            <li><strong>Bedrijfsnaam :</strong> <?php echo esc_html(get_option(CI_Admin_Page::SETTING_NAME)) ?></li>
            <li><strong>Naam:</strong> <?php echo esc_html(get_option(CI_Admin_Page::SETTING_CONTACT_NAME)) ?></li>
            <li><strong>Adres:</strong> <?php echo esc_html(get_option(CI_Admin_Page::SETTING_ADDRESS)) ?></li>
            <li><strong>Telefoonnummer:</strong> <?php echo esc_html(get_option(CI_Admin_Page::SETTING_PHONE)) ?></li>
            <li><strong>Emailadres:</strong> <?php echo esc_html(get_option(CI_Admin_Page::SETTING_EMAIL)) ?></li>
        </ul>
        <?php
    }
}

new CI_Dashboard_Widget();