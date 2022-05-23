<?php get_header();?>

<!-- banner section -->
<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?= get_theme_file_uri('/images/ocean.jpg')?>)">
    </div>
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title">Welcome to our blog!</h1>
        <div class="page-banner__intro">
            <p>Keep up with our latest news.</p>
        </div>
    </div>
</div>
<!-- end of banner section -->

<!-- content section -->
<div class="container container--narrow page-section">
    <!-- to grab our wordpress post listing start off with the wordpress loop. see below for an example. -->
    <?php 
        while (have_posts()) {
            the_post();
    ?>
    <div class="post-item">
        <h2><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>

        <div class="metabox">
            <p>Posted by: Jed Llorente on 5.22.2022 in News</p>
        </div>

        <div class="generic-content">
            <!-- the_excerpt() - used to show only parts of the content of out wordpress posts. best to be used on blog listings or blog template part for homepage. -->
            <?php the_excerpt();?>
            <p><a href="<?= the_permalink(); ?>">Continue Reading &raquo;</a></p>
        </div>
    </div>
    <?php
        }
    ?>
</div>
<!-- end of content section -->

<?php get_footer();?>