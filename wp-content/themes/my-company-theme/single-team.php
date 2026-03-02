<?php get_header(); ?>

<div class="team-single">
    <?php if ( have_posts() ) { ?>
        <?php while ( have_posts() ) { ?>
            <?php the_post(); ?>
            <div>
                <?php the_post_thumbnail(); ?>
                <?php the_title(); ?>
            </div>
            <div>
                <p><?php echo 'Function: ' . get_post_meta( get_the_ID(), '_team_function', true ); ?></p>
                <p><?php echo 'Email: ' . get_post_meta( get_the_ID(), '_team_email', true ); ?></p>
                <p><?php echo 'LinkedIn: ' . get_post_meta( get_the_ID(), '_team_linkedin', true ); ?></p>
            </div>
        <?php } ?>
    <?php } ?>
</div>

<?php get_footer(); ?>