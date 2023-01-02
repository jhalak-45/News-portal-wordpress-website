<?php get_header()?>
<div class="container-fluid">
<div class="banner w-100 justify-content-between mt-2 p-2">
        <?php dynamic_sidebar('cat-ads') ?>
    </div>
    <h3 class="h3 text-center title p-3 mt-3  text-primary"><?php the_title()?></h3>

    <div class="row line">
        <div class="col one"></div>
        <div class="col two"></div>
        <div class="col three"></div>
    </div>
<div class="video-container p-2">
    <?php the_content()?>
</div>
</div>
<?php get_footer()?>