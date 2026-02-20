<?php

require_once get_template_directory() . '/includes/class-theme-setup.php';
require_once get_template_directory() . '/includes/class-team-post-type.php';

new Theme_Setup();
new Team_Post_Type();