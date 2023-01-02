<div class="container-fluid" >


<?php get_header(); ?>

<section class="container-fluid  row h-auto p-0">
    <div class="col-md-7 mr-0 mt-3">
        <?php get_template_part('partials/section', 'slider'); ?>
    </div>
    <div class="col-md-5 p-0">
        <?php get_template_part('partials/section', 'latest_news') ?>
    </div>
</section>

<section class="container-fluid row h-auto p-0">
    <div class="col-md-8">
        <?php get_template_part('partials/section', 'news') ?>
    </div>
    <div class="col-md-4 px-auto p-3 mt-1">
        <?php get_template_part('partials/section', 'ads')  ?>
    </div>
</section>
<section class="contianer-fluid banner justify-content-center px-auto pl-5">
    <?php dynamic_sidebar('front-1') ?>
</section>
<section class="container-fluid row h-auto p-0">
    <div class="col-md-6">
        <?php get_template_part('partials/section', 'education') ?>
    </div>
    <div class="col-md-6 px-auto">
        <?php get_template_part('partials/section', 'health')  ?>
    </div>
</section>
<section class="contianer-fluid banner justify-content-center  pl-5">
    <?php dynamic_sidebar('front-2') ?>
</section>
<section class="container-fluid row h-auto p-0">
    <div class="col-md-4">
        <?php get_template_part('partials/section', 'agriculture') ?>
    </div>
    <div class="col-md-5 px-auto">
        <?php get_template_part('partials/section', 'entertainment')  ?>
    </div>
    <div class="col-md-3 px-auto">
        <?php get_template_part('partials/section', 'bichar')  ?>
    </div>
</section>
<section class="contianer-fluid banner justify-content-center px-auto pl-5">
    <?php dynamic_sidebar('front-3') ?>
</section>
<section class="container-fluid row h-auto p-0">
    <div class="col-md-6">
        <?php get_template_part('partials/section', 'interview') ?>
    </div>
    <div class="col-md-6 px-auto">
        <?php get_template_part('partials/section', 'international')  ?>
    </div>
</section>
<?php get_footer(); ?>
</div>