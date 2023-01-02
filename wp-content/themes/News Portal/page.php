<?php get_header(); ?>

<div class="container-fluid">
    <!-- query -->
    <?php
    $wp_query = new WP_Query(array(
        'post_type' => 'post',

        'posts_per_page' => 10,
    ));
    ?>
    <?php if ($wp_query->have_posts()) : ?>
        <!-- begin loop -->
        <section class="news-container p-2 w-100 h-auto px-auto">

            <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

                <div class="news  row">
                    <div class="post-thumbnail col-4">
                        <a href="<?php the_permalink(); ?>" height="100px" width="200px">
                            <?php the_post_thumbnail('thumbnail'); ?>
                        </a>
                    </div>
                    <div class="post-title col-8">
                        <h5 class="h5 text-dark">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h5>
                        <p>
                            <i class='bx bx-time-five'></i> <?php echo get_the_date() ?>
                        </p>
                    </div>
                </div>
            <?php endwhile; ?>
        </section>
    <?php endif; ?>

</div>
<?php wp_reset_postdata(); ?>
<!-- End Second Column -->

<?php get_footer(); ?>