<?php get_header(); ?>

<div class="not-found">
    <h1><?php _e( 'Page not found', 'my-company-theme' ); ?></h1>
    <p><?php _e( 'The page you are looking for does not exist.', 'my-company-theme' ); ?></p>
    <a href="<?php echo home_url(); ?>">
        <?php _e( 'Back to homepage', 'my-company-theme' ); ?>
    </a>
</div>

<?php get_footer(); ?>
