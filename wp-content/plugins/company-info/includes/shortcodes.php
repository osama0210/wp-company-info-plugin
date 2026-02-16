<?php

class CI_Shortcodes
{
    public function __construct()
    {
        add_shortcode('ci_name', [$this, 'render_name']);
        add_shortcode('ci_contact_name', [$this, 'render_contact']);
        add_shortcode('ci_address', [$this, 'render_address']);
        add_shortcode('ci_phone', [$this, 'render_phone']);
        add_shortcode('ci_email', [$this, 'render_email']);
    }

    public function render_name(): string {return $this->get_option_name(CI_Admin_Page::SETTING_NAME);}
    public function render_contact(): string {return $this->get_option_name(CI_Admin_Page::SETTING_CONTACT_NAME);}
    public function render_address(): string {return $this->get_option_name(CI_Admin_Page::SETTING_ADDRESS);}
    public function render_phone(): string {return $this->get_option_name(CI_Admin_Page::SETTING_PHONE);}
    public function render_email(): string {return $this->get_option_name(CI_Admin_Page::SETTING_EMAIL);}

    private function get_option_name(string $option_name): string
    {
        $option = (string) get_option($option_name, '');
        return esc_html($option);
    }
}

add_action('init', function (){
    new CI_Shortcodes();
});