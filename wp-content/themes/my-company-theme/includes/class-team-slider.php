<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Team_Slider
{
    public function __construct()
    {
        add_shortcode('team_slider', [$this, 'render_slider']);
    }

    public function render_slider(): string
    {
        $output = '<div class="swiper">';
        $output .= '<div class="swiper-wrapper">';

        $query = new WP_Query(array(
            'post_type' => 'team',
            'posts_per_page' => -1,
        ));

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $output .= '<div class="swiper-slide">';
                $output .= '<h2>' . get_the_title() . '</h2>';
                $output .= get_the_post_thumbnail();
                $output .= '</div>';
            }
            $output .= '</div>';
            $output .= '<div class="swiper-button-next"></div>';
            $output .= '<div class="swiper-button-prev"></div>';
            $output .= '</div>';

            wp_reset_postdata();
        }

        return $output;
    }
}