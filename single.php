<?php 
    get_header();
    while(have_posts()) {
        the_post(); 
?>

<!-- <h2>
    <?//php the_title(); ?>
     the_title() wordpress function that grabs title of posts.
</h2> -->

<?php //the_content(); ?>
<!-- the_content() wordpress function that grabs the content of posts. -->

<!-- banner section -->
<section id="banner-section">
    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?= get_theme_file_uri('/images/ocean.jpg')?>)">
        </div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"><?php the_title();?></h1>
            <div class="page-banner__intro">
                <p>DONT FORGET TO REPLACE ME LATER</p>
            </div>
        </div>
    </div>
</section>
<!-- end of banner section -->

<!-- content section -->
<section id="content-section">
    <div class="container container--narrow page-section">
        <!-- meta box section -->
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <!-- get_permalink() - gets the permalink of the current page/post -->
                <a class="metabox__blog-home-link" href="<?= site_url('/blog')?>"><i class="fa fa-home"
                        aria-hidden="true"></i> Blog Home</a>
                <!-- get_the_title() - gets title of the current page/post -->

                <!-- the the_author_posts_link(); - this grabs the author of the wordpress post.-->
                <!-- the_time() - grabs when the time/date of the wordpress post was published, in order to apply a better format for date and time of wordpress post please see: https://wordpress.org/support/article/formatting-date-and-time/ for more information -->
                <span class="metabox__main">Posted by: <?php the_author_posts_link(); ?> on <?php the_time('F j, Y');?>
                    in
                    <?= get_the_category_list(', '); ?></span>
            </p>
        </div>
        <!-- end of meta box section -->
        <div class="generic-content">
            <?php the_content();?>
        </div>
    </div>
</section>
<!-- end of content section -->


<?php
    }
    get_footer();
?>