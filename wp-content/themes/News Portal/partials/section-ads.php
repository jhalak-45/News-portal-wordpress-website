<div class="social">
    <h2 class="title p-2 mt-2 text-danger">Follow Us </h2>
    <div class="social-links p-2">
        <div class="facebook p-1">
            <a href="<?php the_field('facebook_link',70)?>" class="text-light"><i class='bx bxl-facebook' style='color:#ffffff'></i></a>
        </div>
        <div class="twitter p-1">
            <a href="<?php the_field('twitter_link',70)?>" class="text-light"><i class='bx bxl-twitter' style='color:#ffffff'></i></a>

        </div>
        <div class="youtube p-1">
            <a href="<?php the_field('youtube_link',70)?>" class="text-light"><i class='bx bxl-youtube' style='color:white'></i></a>

        </div>
        <div class="instagram p-1">
            <a href="<?php the_field('instagram_link',70)?>" class="text-light"><i class='bx bxl-instagram' style='color:#ffffff'></i></a>

        </div>

    </div>
</div>
<div class="ads p-2 mt-1">
    <h2 class="title p-2 mt-2 text-danger">Advertisement </h2>
    <div class="front-page-ads mt-0">
        <?php dynamic_sidebar('front-page-ads') ?>

    </div>
</div>