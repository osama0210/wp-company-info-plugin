<?php
defined('ABSPATH') || exit;


class CI_Admin_Page
{
    const GROUP = 'ci_settings_group';
    const SETTING_NAME = 'ci_company_name';
    const SETTING_CONTACT = 'ci_contact_name';
    const SETTING_ADDRESS = 'ci_address';
    const SETTING_PHONE = 'ci_phone';
    const SETTING_EMAIL = 'ci_email';

    public function __construct()
    {
        add_action('admin_menu', [$this, 'register_admin_menu']);
        add_action('admin_init', [$this, 'register_settings']);
    }

    /**
     * Registers a custom admin page so administrators can manage company information.
     */
    public function register_admin_menu(): void
    {
        add_menu_page(
                __('Company Information', 'company-info'), // Page title
                __('Company Info', 'company-info'), // Menu title in the sidebar
                'manage_options', // Only accessible by administrators
                'company-info',
                [$this, 'render_admin_page'], // Callback function to display the page content
                'dashicons-building',
                60
        );
    }

    /**
     * Renders the admin settings page.
     * Includes security checks to ensure only authorized admins can access the settings.
     */
    public function render_admin_page(): void
    {
        if (!current_user_can('manage_options')) {
            wp_die(esc_html__('No permission.', 'company-info'));
        }
        settings_errors(); // Displays "Settings Saved" or error messages
        ?>
        <div class="wrap">
            <h1><?php echo esc_html__('Company Info', 'company-info'); ?></h1>

            <form method="post" action="options.php">
                <?php
                // Generates security nonces and hidden fields to prevent CSRF attacks
                settings_fields('ci_settings_group');

                // Renders the registered sections and fields for this page
                do_settings_sections('company-info');

                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    /**
     * Registers the settings in the wp_options table and defines the settings section and fields.
     */
    public function register_settings(): void
    {
        // Whitelist the options in the database and apply sanitization callbacks for security
        register_setting(self::GROUP, self::SETTING_NAME, 'sanitize_text_field');
        register_setting(self::GROUP, self::SETTING_CONTACT, 'sanitize_text_field');
        register_setting(self::GROUP, self::SETTING_ADDRESS, 'sanitize_text_field');
        register_setting(self::GROUP, self::SETTING_PHONE, 'sanitize_text_field');
        register_setting(self::GROUP, self::SETTING_EMAIL, 'sanitize_email');

        // Defines a section to group the company fields together
        add_settings_section(
                'ci_main_section',
                __('Algemene Info', 'company-info'),
                [$this, 'render_section_text'],
                'company-info'
        );

        // Maps each database option to a specific input field in the UI
        add_settings_field('ci_name_field', __('Bedrijfsnaam', 'company-info'), [$this, 'render_name_input'], 'company-info', 'ci_main_section');
        add_settings_field('ci_contact_field', __('Naam', 'company-info'), [$this, 'render_contact_name_input'], 'company-info', 'ci_main_section');
        add_settings_field('ci_address_field', __('Adres', 'company-info'), [$this, 'render_address_input'], 'company-info', 'ci_main_section');
        add_settings_field('ci_phone_field', __('Telefoonnummer', 'company-info'), [$this, 'render_phone_input'], 'company-info', 'ci_main_section');
        add_settings_field('ci_email_field', __('Emailadres', 'company-info'), [$this, 'render_email_input'], 'company-info', 'ci_main_section');
    }

    /**
     * Outputs description text at the top of the settings section.
     */
    public function render_section_text(): void
    {
        echo '<p>' . esc_html__('Vul hieronder de gegevens in.', 'company-info') . '</p>';
    }

    /**
     * Callback functions to render input fields.
     * They fetch the current value from the database using get_option to populate the fields.
     */
    function render_name_input(): void {$this->render_inputs(self::SETTING_NAME);}

    function render_contact_name_input(): void {$this->render_inputs(self::SETTING_CONTACT);}

    function render_address_input(): void {$this->render_inputs(self::SETTING_ADDRESS);}

    function render_phone_input(): void {$this->render_inputs(self::SETTING_PHONE);}

    function render_email_input(): void {$this->render_inputs(self::SETTING_EMAIL, 'email');}

    private function render_inputs(string $option_name, string $input_type = 'text'): void
    {
        $value = get_option($option_name, '');
        echo '<input type="' . esc_attr($input_type) . '" name="' . esc_attr($option_name) . '" value="' . esc_attr($value) . '" class="regular-text">';
    }
}

new CI_Admin_Page();