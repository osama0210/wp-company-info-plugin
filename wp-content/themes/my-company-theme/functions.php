<?php

require_once get_template_directory() . '/includes/class-theme-setup.php';
require_once get_template_directory() . '/includes/class-team-post-type.php';
require_once get_template_directory() . '/includes/class-team-metaboxes.php';
require_once get_template_directory() . '/includes/class-team-slider.php';

new Theme_Setup();
new Team_Post_Type();
new Team_Meta();
new Team_Slider();