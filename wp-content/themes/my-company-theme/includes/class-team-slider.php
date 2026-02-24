<?php

class Team_Slider
{
    public function __construct()
    {
        add_shortcode('team_slider', [$this, 'render_slider']);
    }

    public function render_slider(): string
    {
        $output = '';

        $query = new WP_Query(array(
            'post_type' => 'team',
            'posts_per_page' => -1,
        ));

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $output .= '<div>' . get_the_title() . '</div>';
            }
            wp_reset_postdata();
        }

        return $output;
    }
}