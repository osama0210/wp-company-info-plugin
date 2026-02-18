<?php
class CI_Dashboard_Widget
{

    /**
     * Initializes the class and registers WP hooks.
     * This run automatically when the class is instantiated.
     */
    public function __construct()
    {
        add_action('wp_dashboard_setup', [$this, 'add_dashboard_widget']);
    }

    /**
     * Registers a custom widget.
     * Uses render_dashboard_widget to define the id, title etc...
     */
    public function add_dashboard_widget(): void
    {
        wp_add_dashboard_widget(
            'ci_widget',
            __('Company Information', 'company-info'),
            [$this, 'render_dashboard_widget']
        );
    }

    /**
     * Renders the HTML content for the dashboard widget.
     * Fetches company data from the options table and esc output for security.
     */
    public function render_dashboard_widget(): void
    {
        ?>
        <ul>
            <li>
                <strong><?php _e('Company Name', 'company-info'); ?>:</strong>
                <?php echo esc_html(get_option(CI_Admin_Page::SETTING_NAME, '')); ?>
            </li>
            <li>
                <strong><?php _e('Name', 'company-info'); ?>:</strong>
                <?php echo esc_html(get_option(CI_Admin_Page::SETTING_CONTACT_NAME, '')); ?>
            </li>
            <li>
                <strong><?php _e('Address', 'company-info'); ?>:</strong>
                <?php echo esc_html(get_option(CI_Admin_Page::SETTING_ADDRESS, '')); ?>
            </li>
            <li>
                <strong><?php _e('Phone Number', 'company-info'); ?>:</strong>
                <?php echo esc_html(get_option(CI_Admin_Page::SETTING_PHONE, '')); ?>
            </li>
            <li>
                <strong><?php _e('Email Address', 'company-info'); ?>:</strong>
                <?php echo esc_html(get_option(CI_Admin_Page::SETTING_EMAIL, '')); ?>
            </li>
        </ul>
        <?php
    }
}

new CI_Dashboard_Widget();