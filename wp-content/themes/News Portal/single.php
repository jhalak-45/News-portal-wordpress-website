<?php get_header(); ?>

<div class="container-fluid mt-0 m-0 p-0 h-auto">
    <section class="single-container ">
        <div class="new-named">
            <div class="news-details p-3 ">
                <div class="p-2 single-page-banner">
                    <?php dynamic_sidebar('banner-1') ?>
                </div>
                <div class="title">
                    <h2 class="h2 text">
                        <?php the_title(); ?>

                    </h2>

                </div>
                <div class="post-thumbnail mb-2 mt-2 text-center img-responsive img-fluid card-group">
                    <?php the_post_thumbnail(); ?>

                </div>

                <div class="excerpt">
                    <h4 class="h4 text-primary">
                        <?php the_excerpt(); ?>

                    </h4>
                    <div class="p-2 single-page-banner w-auto h-25">
                        <?php dynamic_sidebar('banner-2') ?>
                    </div>
                </div>
                <div class="content ml-2 pl-2">
                    <p class="text">
                        <?php the_content() ?>

                    </p>

                </div>
                <div class="p-2 single-page-banner">
                    <?php dynamic_sidebar('banner-3') ?>
                </div>
            </div>
            <div class="comment-form p-2">
                <?php comment_form(); ?>

            </div>
            <div class="single-page-ads">
                <?php dynamic_sidebar('ads-banner') ?>
            </div>

        </div>
        <div class="sidebar">
            <?php get_sidebar() ?>
        </div>
    </section>

</div>
<?php get_footer(); ?>