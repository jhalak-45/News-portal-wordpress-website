<?php get_header(); ?>

<div class="container-fluid">
    <div class="title p-2">
        <div class="box"></div>
        <h3 class="h3 sidebar-title p-3 mt-3">ताजा समाचार </h3>

    </div>

    <!-- query -->
    <?php
    $wp_query = new WP_Query(array(
        'post_type' => 'post',

        'posts_per_page' => 6,
    ));
    ?>
    <?php if ($wp_query->have_posts()) : ?>
        <!-- begin loop -->
        <section class="sidebar-container p-1 w-100 h-auto px-auto">

            <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

                <div class="sidebar-news">
                    <div class="sidebar-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium'); ?>
                        </a>
                        <div class="post-title">
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
                </div>
            <?php endwhile; ?>
        </section>
    <?php endif; ?>
    <div class="hamro-patro " style="width:100%; padding:5px">
        <div class="title p-2">
            <div class="box"></div>
            <h3 class="h3 sidebar-title p-3 mt-3"> नेपाली पात्रो</h3>
        </div>
        <iframe src="https://www.hamropatro.com/widgets/calender-medium.php" frameborder="0" scrolling="no"  marginheight="0" style="border:none; overflow:hidden; width:100%; height:385px;" allowtransparency="true"></iframe>
    </div>
    <!-- <iframe loading="lazy" width="1000" height="900" src="https://neb.ntc.net.np/" frameborder="1" allowfullscreen></iframe><br /> -->


    <div class="title p-2">
        <div class="box"></div>
        <h3 class="h3 sidebar-title p-3 mt-3"> विज्ञापन </h3>

    </div>

    <!-- EXCHANGERATES.ORG.UK Nepalese Rupee EXCHANGE RATE TABLE END -->
    <div class="sidebar-ads">
        <?php dynamic_sidebar('ads-banner') ?>
    </div>
    <div class="date-converter w-100">

        <div class="title p-2">
            <div class="box"></div>
            <h3 class="h3 sidebar-title p-3 mt-3"> मिति रूपान्तरण </h3>
        </div>

        <iframe src="https://www.hamropatro.com/widgets/dateconverter.php" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" style="border:none; overflow:hidden; width:100%; height:auto;" allowtransparency="true"></iframe>

    </div>
    <div class="currency-converter">

        <div class="title p-2">
            <div class="box"></div>
            <h3 class="h3 sidebar-title p-3 mt-3"> मुद्रा रूपान्तरण </h3>
        </div>
        <!-- EXCHANGERATES.ORG.UK Nepalese Rupee CURRENCY CONVERTER START -->
        <div style="width:100% ;margin:0;padding:0;margin-top:10px;border:1px solid #2D6AB4;background:#F0F0F0;">
            <div style="width:100%;text-align:center;padding:2px 0px;background:#2D6AB4;font-family:arial;font-size:11px;color:#FFFFFF;font-weight:bold;vertical-align:middle;">
                <img src="//www.exchangerates.org.uk/images/flags/np.gif" style="padding-right:5px;">
                <a rel="nofollow" style="color:#FFFFFF;text-decoration:none;text-transform:uppercase;" href="//www.exchangerates.org.uk/Nepalese-Rupee-NPR-currency-table.html" target="_new" title="Nepalese Rupee Converter">Nepalese Rupee Converter</a>
            </div>
            <div style="padding:10px; width:100%">
                <script type="text/javascript">
                    var dcf = 'NPR';
                    var dct = 'EUR';
                    var mc = '2D6AB4';
                    var mbg = 'F0F0F0';
                    var tc = 'FFFFFF';
                    var f = 'arial';
                    var fc = '000000';
                    var tz = '0';
                </script>
                <script type="text/javascript" src="https://www.currency.me.uk/remote/ER-CCCS2-1.php"></script>
            </div>
        </div>
        <!-- EXCHANGERATES.ORG.UK Nepalese Rupee CURRENCY CONVERTER END -->
        <!-- EXCHANGERATES.ORG.UK Nepalese Rupee EXCHANGE RATE TABLE START -->
        <div style="width:100%;margin-top :10px;padding:0;border:1px solid #2D6AB4;background:#F0F0F0;">
            <div style="width:100%;text-align:center;padding:2px 0px;background:#2D6AB4;font-family:arial;font-size:11px;color:#FFFFFF;font-weight:bold;vertical-align:middle;">
                <img src="//www.exchangerates.org.uk/images/flags/np.gif" style="padding-right:5px;">
                <a rel="nofollow" style="color:#FFFFFF;text-decoration:none;text-transform:uppercase;" href="//www.exchangerates.org.uk/Nepalese-Rupee-NPR-currency-table.html" target="_new" title="Nepalese Rupee Exchange Rate">Nepalese Rupee Exchange Rate</a>
            </div>
            <div style="padding:10px; width:100%">
                <script type="text/javascript">
                    var dcf = 'NPR';
                    var dct = 'EUR';
                    var mc = '2D6AB4';
                    var mbg = 'F0F0F0';
                    var tc = 'FFFFFF';
                    var f = 'arial';
                    var fc = '000000';
                    var tz = '0';
                </script>
                <script type="text/javascript" src="https://www.currency.me.uk/remote/ER-TCS-1.php"></script>
            </div>
        </div>
    </div>
    <iframe src="https://rat32.com/nepali-calendar/addons/gold-silver-rate.php" frameborder="0" scrolling="yes" marginwidth="0" marginheight="0" style="border:none; overflow:hidden;width:100%;margin-top:10px;height:380px; " allowtransparency="true"></iframe>
</div>
<?php wp_reset_postdata(); ?>
<!-- End Second Column -->