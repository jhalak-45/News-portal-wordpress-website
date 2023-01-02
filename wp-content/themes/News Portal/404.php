<?php get_header()?>

<div class="container-fluid error-container h-auto w-100">
    <div class="p-3 text-center mb-2">
        <div class="p-0 mb-0">
            <img src="<?php echo get_template_directory_uri() . '/error-image.gif' ?>" class="img-fluid mb-0">
        </div>
        <div class="button-box mt-0 p-2 ">
            <a href="<?php echo site_url(); ?>" class="link">
                <button class="btn btn-primary">Go to Home</button>
            </a>
        </div>
    </div>
</div>
<?php get_footer()?>