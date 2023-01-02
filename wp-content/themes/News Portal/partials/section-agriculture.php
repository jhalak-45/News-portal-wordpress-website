<div class="category-title w-100">
    <div class="title p-2 ">
        <div class="box "></div>
        <h3 class="h3 sidebar-title p-2 mt-3">कृषि </h3>

    </div>
    <div class="news-button  mt-3 p-1 mr-0">
        <a href="category/agriculture"><i class='bx bx-chevrons-right'></i></a>
    </div>
</div>


<!-- query -->
<?php
$wp_query = new WP_Query(array(
    'post_type' => 'post',
    'category_name' => 'agriculture',
    'posts_per_page' => 3,
    'paged' => $paged,
));
?>
<?php if ($wp_query->have_posts()) : ?>
    <!-- begin loop -->
    <section class="news-container w-100 h-auto ">

        <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

            <div class="news  row w-100">
                <div class="post-thumbnail col-4">
                    <a href="<?php the_permalink(); ?>" >
                        <?php the_post_thumbnail('thumbnail'); ?>
                    </a>
                </div>
                <div class="post-title col-8">
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