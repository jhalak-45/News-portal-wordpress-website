<footer class="container-fluid p-2  footer footer-expand-lg h-auto">
    <div class="inner-footer  row p-2">
        <div class="col-md-4 p-2 pl-3 cont">

            <h4 class="text-light title">
                सम्पर्क ठेगाना
            </h4>
            <div class="about mt-0 p-2">
                <h4 class="h3 text-light">
                    <a href="<?php echo site_url(); ?>" class="link"> <?php bloginfo() ?>
                    </a>
                </h4>
                <p class="text"><small class="">Address : </small> <?php the_field('address', 70) ?></p>
                <p class="text"> <small>Contact : </small> <?php the_field('phone_number', 70) ?></p>
                <p class="text"><small>Telephone : </small> <?php the_field('telephone_number', 70) ?></p>
                <p class="text"><small>Email : </small><?php the_field('email_address', 70) ?></p>
                <p class="text"><small>PAN Number: </small> <?php the_field('pan_number', 70) ?></p>
            </div>
        </div>
        <div class="col-md-6 p-2 cont">
            <h4 class="text-light title">
                हाम्रो टिम
            </h4>
            <div class="teams">
                <div class="1 cards">
                    <div class="image">
                        <img src="<?php the_field('image_of_team_member_1', 70) ?>" alt="image of member">
                    </div>
                    <div class="details">
                        <h4 class="member_title"><?php the_field('post_of_team_member_1', 70) ?></h4>
                        <h5 class="text-center"><?php the_field('name_of_team_member_1', 70) ?></h5>
                    </div>
                </div>
                <div class="1 cards">
                    <div class="image">
                        <img src="<?php the_field('image_of_team_member_2', 70) ?>" alt="image of member">
                    </div>
                    <div class="details">
                        <h4 class="member_title"><?php the_field('post_of_team_member_2', 70) ?></h4>
                        <h5 class="text-center"><?php the_field('name_of_team_member_2', 70) ?></h5>
                    </div>
                </div>
                <div class="1 cards">
                    <div class="image">
                        <img src="<?php the_field('image_of_team_member_3', 70) ?>" alt="image of member">
                    </div>
                    <div class="details">
                        <h4 class="member_title"><?php the_field('post_of_team_member_3', 70) ?></h4>
                        <h5 class="text-center"><?php the_field('name_of_team_member_3', 70) ?></h5>
                    </div>
                </div>

            </div>

        </div>
        <div class="col-md-2 p-2 cont">
            <h4 class="text-light title">
                साइट नेभिगेशन
            </h4>
            <?php dynamic_sidebar('footer-1') ?>
        </div>
    </div>
    <div class="last-footer row  w-100 p-0">
        <div class="col-md-6 pl-5 py-0">
            <p class="text-light"> <?php bloginfo() ?> &copy;All Rights Reserved 2022 </p>
        </div>
        <div class="col-md-6">
            <p class="text-light text-right">Developed by
                <a href="https://www.mohrain.com" class="link"> Mohrain Websoft Pvt. Ltd.</a>
            </p>
        </div>

    </div>
    <button type="button" class="btn btn-danger btn-floating btn-lg" id="btn-back-to-top">
        <i class="fas fa-arrow-up"></i>
    </button>

</footer>
</div>
</body>

</html>