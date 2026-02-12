<?php
defined('ABSPATH') || exit;

function ci_register_admin_menu(): void {
	add_menu_page(
		__('Company Information', 'company-info'),
		__('Company Info', 'company-info'),
		'manage_options',
		'company-info',
		'ci_render_admin_page',
		'dashicons-building',
		60
	);
}

function ci_render_admin_page(): void
{
    if (!current_user_can('manage_options')){
        wp_die(esc_html__('No permission.', 'company-info'));
    }
	echo '<div class="wrap">';
	echo '<h1>' . esc_html__('Company Info', 'company-info') . '</h1>';
	echo '<p>' . esc_html__('This is the admin page. Next we add settings fields.', 'company-info') . '</p>';
	echo '</div>';
}

add_action('admin_menu', 'ci_register_admin_menu');
