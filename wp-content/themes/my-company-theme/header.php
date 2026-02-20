<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body>
    <?php wp_body_open(); ?>

<header>
    <nav>
        <?php
        wp_nav_menu( [
            'theme_location' => 'primary',
        ] )
        ?>
    </nav>
</header>
