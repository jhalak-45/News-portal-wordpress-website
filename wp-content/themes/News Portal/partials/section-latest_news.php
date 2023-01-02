<?php
        $wp_query = new WP_Query(array(
            'post_type' => 'post',

            'posts_per_page' => 3,
        ));
        ?>
        <?php if ($wp_query->have_posts()) : ?>
            <section class="news-container px-auto m-0 latest-news">

                <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

                    <div class="news  row mt-1 w-100 p-0" style="height:auto">
                        <div class="post-thumbnail col-4">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('thumbnail'); ?>
                            </a>
                        </div>
                        <div class="post-title col-8">
                            <h5 class="h5 text-dark">
                                <a href="<?php the_permalink(); ?>">
                                    <p class="text-dark" style="font-size: 15px ; color:black"><?php the_title(); ?></p>
                                </a>
                            </h5>
                            <p>
                                <i class='bx bx-time-five'></i> <?php echo get_the_date() ?>
                            </p>
                        </div>
                    </div>
                <?php endwhile; ?>

            <?php endif; ?>
            </section>
    </div>