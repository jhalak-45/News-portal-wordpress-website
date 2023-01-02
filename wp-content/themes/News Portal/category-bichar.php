<?php get_header(); ?>

<div class="container-fluid">
    <div class="banner w-100 justify-content-between mt-2 p-2">
        <?php dynamic_sidebar('cat-ads') ?>
    </div>
    <h3 class="h3 text-center title p-3 mt-3  text-primary">विचार </h3>

    <div class="row line">
        <div class="col one"></div>
        <div class="col two"></div>
        <div class="col three"></div>
    </div>
    <!-- query -->
    <?php
    $wp_query = new WP_Query(array(
        'post_type' => 'post',
        'category_name' => 'bichar',
        'posts_per_page' => 10,
        'paged' => $paged,
    ));
    ?>
    <?php if ($wp_query->have_posts()) : ?>
        <!-- begin loop -->
        <section class="news-container category-bichar p-2 w-100 h-auto px-auto justify-content-center">

            <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

                <div class="news card " style="width:250px;">
                    <div class="post-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium'); ?>
                        </a>
                    </div>
                    <div class="post-title">
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
    <div class="pagination p-2 w-100 justify-content-center h-auto">
        <?php wp_pagenavi(); ?>
    </div>

</div>
<?php get_footer(); ?>