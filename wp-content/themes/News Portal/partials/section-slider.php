<div id="carouselExampleDark" class="carousel carousel-dark slide h-100" data-bs-ride="carousel" data-bs-interval="3000">

    <div class="carousel-inner">
        <?php
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 6,
        );
        $latest = new WP_Query($args);
        if ($latest->have_posts()) {
            $i = 0;
            while ($latest->have_posts()) : $latest->the_post();
                $i++;
        ?>
                <div class="<?php if ($i == 1) echo 'active' ?> carousel-item">

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="carousel-img text-center mb-4">
                            <img class="carousel-image" height="500px" width="100%" src="<?php echo get_the_post_thumbnail_url(null, 'large'); ?>" alt="<?php the_title(); ?>">
                            <div class="carousel-caption d-none d-md-block">
                                <div id="pop-up-div">
                                    <h3 class="carousel-text text-light "><?php the_title(); ?></h3>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
        <?php
            endwhile;
            wp_reset_postdata();
        }
        ?>

    </div>
    <div class="carousel-indicators w-auto pop-up-div mb-0">
        <button type="button"  data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button"  data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button"  data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <!-- <span class="visually-hidden">Previous</span> -->
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <!-- <span class="visually-hidden">Next</span> -->
    </button>

</div>