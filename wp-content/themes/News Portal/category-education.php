<?php get_header(); ?>

<div class="container-fluid">
    <div class="banner w-100 justify-content-between mt-2 p-2">
        <?php dynamic_sidebar('cat-ads') ?>
    </div>
    <h3 class="h3 text-center title p-3 mt-3  text-primary">शिक्षा</h3>

    <div class="row line">
        <div class="col one"></div>
        <div class="col two"></div>
        <div class="col three"></div>
    </div>

    <!-- query -->
    <?php
    $wp_query = new WP_Query(array(
        'post_type' => 'post',
        'category_name' => 'education',
        'posts_per_page' => 10,
        'paged' => $paged,
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

    <?php wp_reset_postdata(); ?>
    <!-- End Second Column -->
    <div class="pagination p-2 w-100 justify-content-center h-auto">
        <?php wp_pagenavi(); ?>
    </div>
</div>
<?php get_footer(); ?>