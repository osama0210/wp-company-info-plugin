<?php

class CI_Media_Page
{
    /**
     * CI_Media_Page constructor,
     * register data settings and loads assets (JS/CSS).
     */
    public function __construct()
    {
        // Registers the Media subpage under the Company Info menu.
        add_action('admin_menu', [$this, 'add_media_subpage']);
        // Defines the settings (database rows) needed for slider images.
        add_action('admin_init', [$this, 'register_gallery_settings']);
        // Enqueues the WP media library and custom JS.
        add_action('admin_enqueue_scripts', [$this, 'enqueue_media_scripts']);
    }

    /**
     * Registers Media subpage to uploads images.
     */
    public function add_media_subpage(): void
    {
        add_submenu_page(
            'company-info',
                __('Company media', 'company-info'),
            __('Media', 'company-info'),
            'manage_options',
            'ci-media',
                [$this, 'render_media_page'] // callback
        );
    }

    /**
     * Renders HTML for Media subpage.
     * Display the Media Library trigger button, hidden inputs
     * for storing IDs, and image previews.
     */
    public function render_media_page(): void
    {
        ?>
        <div class="wrap">
            <h1><?php esc_html_e('Company media', 'company-info'); ?></h1>
            <p><?php esc_html_e('Upload and manage images for your slider.', 'company-info'); ?></p>

            <form action="options.php" method="post">
                <?php
                settings_errors();
                settings_fields('ci_gallery_group');
                $image_ids = get_option('ci_gallery_ids', '');
                ?>

                <div class="ci-media-wrapper">
                    <!-- Trigger button to open default WP upload media popup.-->
                    <button type="button"
                            class="button button-secondary"
                            id="ci_media_button">
                        <?php _e('Select Images', 'company-info'); ?>
                    </button>

                    <input type="hidden"
                           name="ci_gallery_ids"
                           id="ci_gallery_ids"
                           value="<?php echo esc_attr($image_ids); ?>">

                    <div id="ci-image-preview" style="margin-top: 1rem">
                        <?php
                        if (!empty($image_ids)) {
                            $images_array = explode(',', $image_ids);
                            foreach ($images_array as $image) {
                                // Converts ID back to a thumbnail image tag
                                echo wp_get_attachment_image($image, 'thumbnail', false);
                            }
                        }
                        ?>
                    </div>
                </div>
                <?php submit_button(); ?>

            </form>
        </div>
        <?php
    }

    /**
     * Registers the image setting in the database.
     * This allows 'ci_gallery_ids' to be saved securely via options.php.
     */
    public function register_gallery_settings(): void
    {
        register_setting('ci_gallery_group', 'ci_gallery_ids');
    }

    /**
     * Enqueues WP Media Library and custom JS files.
     */
    public function enqueue_media_scripts($hook): void
    {
        if (strpos($hook, 'ci-media') === false) {
            return;
        }
        wp_enqueue_media();
        wp_enqueue_script(
                'ci-media-uploader',
                plugins_url('assets/js/media-uploader.js', dirname(__FILE__)),
                ['jquery'],
                '1.0.0',
                true
        );
    }
}

new CI_Media_Page();
