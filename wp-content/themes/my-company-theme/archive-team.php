<?php get_header(); ?>

<div class="team-archive">
    <?php if ( have_posts() ) { ?>
        <?php while ( have_posts() ) { ?>
            <?php the_post(); ?>
            <div class="team-card">
                <?php the_post_thumbnail(); ?>
                <h2><?php the_title(); ?></h2>
                <p><?php echo get_post_meta( get_the_ID(), '_team_function', true ); ?></p>

                <a href="<?php the_permalink(); ?>">
                    <?php _e( 'Read more', 'my-company-theme' ); ?>
                </a>
            </div>
        <?php } ?>
    <?php } ?>
</div>

<?php get_footer(); ?>
