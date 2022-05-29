<?php get_header();?>

<!-- banner section -->
<?php pageBanner(array(
    'subtitle'       => 'Keep up with our latest posts',
    'title'          => 'Welcome to our blog!'
)); ?>
<!-- end of banner section -->

<!-- content section -->
<div class="container container--narrow page-section">
    <!-- to grab our wordpress post listing start off with the wordpress loop. see below for an example. -->
    <?php 
        while (have_posts()) {
            the_post();
    ?>
    <div class="post-item">
        <h2 class="headline headline--medium headline--post-title"><a
                href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>

        <div class="metabox">
            <!-- the the_author_posts_link(); - this grabs the author of the wordpress post.-->
            <!-- the_time() - grabs when the time/date of the wordpress post was published, in order to apply a better format for date and time of wordpress post please see: https://wordpress.org/support/article/formatting-date-and-time/ for more information -->
            <p>Posted by: <?php the_author_posts_link(); ?> on <?php the_time('F j, Y');?> in
                <?= get_the_category_list(', '); ?></p>
        </div>

        <div class="generic-content">
            <!-- the_excerpt() - used to show only parts of the content of out wordpress posts. best to be used on blog listings or blog template part for homepage. -->
            <?php the_excerpt();?>
            <p><a class="btn btn--blue" href="<?= the_permalink(); ?>">Continue Reading &raquo;</a></p>
        </div>
    </div>
    <?php
        }

        echo paginate_links();
    ?>
</div>
<!-- end of content section -->

<?php get_footer();?>