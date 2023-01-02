<div class="category-title  w-100">
    <div class="title p-2 ">
        <div class="box "></div>
        <h3 class="h3 sidebar-title p-3 mt-3">बिचार </h3>

    </div>
    <div class="news-button mt-3 p-1 mr-0">
        <a href="category/bichar"><i class='bx bx-chevrons-right'></i></a>
    </div>
</div><?php get_header(); ?>


<!-- query -->
<?php
$wp_query = new WP_Query(array(
    'post_type' => 'post',
    'category_name' => 'bichar',
    'posts_per_page' => 2,
    'paged' => $paged,
));
?>
<?php if ($wp_query->have_posts()) : ?>
    <!-- begin loop -->
    <section class="news-container section-bichar p-2 w-100 h-auto px-auto justify-content-center ">

        <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

            <div class="news h-auto p-2 justify-content-center">
                <div class="post-thumbnail">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('medium'); ?>
                    </a>
                </div>
                <div class="post-title">
                    <h5 class="h5 text-dark" style="font-size: 16px;">
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
