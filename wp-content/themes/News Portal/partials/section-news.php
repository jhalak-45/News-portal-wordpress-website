<div class="category-title  w-100">
    <div class="title p-2">
        <div class="box "></div>
        <h3 class="h3 sidebar-title p-3 mt-3">समाचार </h3>

    </div>
    <div class="news-button mt-3 p-3 mr-0">
        <a href="news_portal/news"><i class='bx bx-chevrons-right'></i></a>
    </div>
</div>


<!-- query -->
<?php
$wp_query = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => 4,
));
?>
<?php if ($wp_query->have_posts()) : ?>
    <!-- begin loop -->
    <section class="news-container  w-100 h-auto">

        <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

            <div class="news  row w-100">
                <div class="post-thumbnail col-3">
                    <a href="<?php the_permalink(); ?>" height="100px" width="200px">
                        <?php the_post_thumbnail('thumbnail'); ?>
                    </a>
                </div>
                <div class="post-title col-9">
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