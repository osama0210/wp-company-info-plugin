<?php

class CI_Shortcodes
{
    /**
     * Constructor Registers all plugin shortcodes and prepares frontend asset hooks.
     */
    public function __construct()
    {
        // Register basic info shortcodes
        add_shortcode('ci_name', [$this, 'render_name']);
        add_shortcode('ci_contact_name', [$this, 'render_contact']);
        add_shortcode('ci_address', [$this, 'render_address']);
        add_shortcode('ci_phone', [$this, 'render_phone']);
        add_shortcode('ci_email', [$this, 'render_email']);

        // Register media/slider shortcodes
        add_shortcode('ci_gallery', [$this, 'render_media']);
        add_shortcode('ci_slider', [$this, 'render_media_slider']);

        // Hook to load CSS/JS only when needed on the frontend
        add_action('wp_enqueue_scripts', [$this, 'enqueue_slider_assets']);
    }

    /**
     * Fetches database values and puts it in shortcodes hooks
     */
    public function render_name(): string {return $this->get_option_name(CI_Admin_Page::SETTING_NAME);}
    public function render_contact(): string {return $this->get_option_name(CI_Admin_Page::SETTING_CONTACT_NAME);}
    public function render_address(): string {return $this->get_option_name(CI_Admin_Page::SETTING_ADDRESS);}
    public function render_phone(): string {return $this->get_option_name(CI_Admin_Page::SETTING_PHONE);}
    public function render_email(): string {return $this->get_option_name(CI_Admin_Page::SETTING_EMAIL);}

    /**
     *  Renders a simple static gallery of the selected images.
     */
    public function render_media(): string
    {
        $image_ids = $this->get_option_name('ci_gallery_ids');

        if (empty($image_ids)) {
            return '';
        }

        $images_array = explode(',', $image_ids);

        ob_start();
        ?>
        <div class="ci-frontend-gallery" style="display: flex; gap: 15px; flex-wrap: wrap;">
            <?php foreach ($images_array as $image) : ?>
                <div>
                    <?php echo wp_get_attachment_image($image, 'large'); ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
        // 4. Return the collected HTML
        return ob_get_clean();
    }

    /**
     *  Renders the Swiper.js image slider and ensures assets are loaded.
     */
    public function render_media_slider(): string
    {
        // Manual call enqueue to ensure styles/scripts load if shortcode is used
        $this->enqueue_slider_assets();

        $image_ids = $this->get_option_name('ci_gallery_ids');

        if (empty($image_ids)) {
            return '<p>' . __('No images selected for the slider.', 'company-info') . '</p>';
        }

        $images_array = explode(',', $image_ids);

        ob_start();
        ?>
        <div class="swiper ci-main-slider">
            <div class="swiper-wrapper">
                <?php foreach ($images_array as $image) : ?>
                    <div class="swiper-slide">
                        <?php echo wp_get_attachment_image($image, 'full'); ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>

            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     *  Enqueues Swiper.js bundle and custom slider assets.
     */
    public function enqueue_slider_assets(): void
    {
        wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
        wp_enqueue_style(
                'ci_slider_style',
                CI_PLUGIN_URL . 'assets/css/slider-style.css',
                ['swiper-css'],
                '1.0.0'
        );
        wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], null, true);
        wp_enqueue_script('ci-slider-init', CI_PLUGIN_URL . 'assets/js/slider-init.js', ['swiper-js'], '1.0.0', true);
    }

    /**
     * @param string $option_name
     * @return string
     * Helper: Safely retrieves an option from the database.
     * Returns a sanitized string to prevent XSS attacks on the frontend.
     */
    private function get_option_name(string $option_name): string
    {
        $option = (string) get_option($option_name, '');
        return esc_html($option);
    }
}

add_action('init', function (){
    new CI_Shortcodes();
});