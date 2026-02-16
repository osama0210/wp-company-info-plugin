<?php

class CI_Media_Page
{
    public function __construct()
    {
        add_action('admin_menu', [$this, 'add_media_subpage']);
        add_action('admin_init', [$this, 'register_gallery_settings']);

        add_action('admin_enqueue_scripts', [$this, 'enqueue_media_scripts']);
    }

    public function add_media_subpage(): void
    {
        add_submenu_page(
            'company-info',
            __('Bedrijfsmedia', 'company-info'),
            __('Media', 'company-info'),
            'manage_options',
            'ci-media',
            [$this, 'render_media_page']
        );
    }

    public function render_media_page(): void
    {

        ?>
        <div class="wrap">
            <h1><?php echo esc_html__('Bedrijfsmedia', 'company-info'); ?></h1>
            <p><?php echo esc_html__('Upload en beheer afbeeldingen voor je slider.', 'company-info'); ?></p>

            <form action="options.php" method="post">
                <?php
                settings_fields('ci_gallery_group');
                $image_ids = get_option('ci_gallery_ids', '');
                ?>

                <div class="ci-media-wrapper">
                    <button type="button" class="button button-secondary" id="ci_media_button">
                        <?php _e('Selecteer Afbeeldingen', 'company-info'); ?>
                    </button>

                    <div style="margin-top: 1rem">
                        <label for="ci_gallery_ids">Geselecteerde IDs:</label><br>
                        <input type="text" name="ci_gallery_ids" id="ci_gallery_ids" value="<?php echo esc_attr($image_ids); ?>" class="regular-text">
                    </div>
                </div>


                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }

    public function register_gallery_settings(): void
    {
        register_setting('ci_gallery_group', 'ci_gallery_ids');
    }

    public function enqueue_media_scripts($hook): void
    {
        if ($hook !== 'company-info_page_ci-media') {
            return;
        }
        wp_enqueue_media();
    }
}

new CI_Media_Page();