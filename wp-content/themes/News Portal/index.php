<?php get_header(); ?>

<div class="container-fluid mt-0 m-0 p-0">
    <h3 class="h3 text-center title p-3 mt-3  text-primary">समाचार </h3>
    <section class="news-container p-2 w-100 h-auto px-auto">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="news row">
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
                        <p class="text p-2">
                            <i class='bx bx-time-five'></i> <?php echo get_the_date() ?>
                        </p>
                    </div>
                </div>
            <?php endwhile; ?>
    </section>
<?php endif; ?>

<div class="pagination p-2 w-100 justify-content-center h-auto">
<?php wp_pagenavi(); ?>
</div>


<?php get_footer() ?>

