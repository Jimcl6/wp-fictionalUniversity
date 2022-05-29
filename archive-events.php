<?php get_header();?>

<!-- banner section -->
<?php pageBanner(array(
    'title'         => 'All Events',
    'subtitle'      => 'See what is going on in our world.'
));?>
<!-- end of banner section -->

<!-- content section -->
<div class="container container--narrow page-section">
    <!-- to grab our wordpress post listing start off with the wordpress loop. see below for an example. -->

    <?php 
        // start off with the while loop. while(have_posts()) {
        while (have_posts()) {
            // the_post() - this should echo out the posts from our wordpress posts/page admin panel.
            the_post();
    ?>
    <div class="event-summary">
        <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
            <span class="event-summary__month">
                <?php
                    $eventDate = new DateTime(get_field('event_date'));
                    echo $eventDate->format('M');
                ?>
            </span>
            <span class="event-summary__day">
                <?php
                    $eventDay = new DateTime(get_field('event_date'));
                    echo $eventDay->format('d');
                ?>
            </span>
        </a>
        <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny"><a
                    href="<?php the_permalink();?>"><?php the_title();?></a></h5>
            <p><?= wp_trim_words(get_the_content(), 18); ?> <a href="<?php the_permalink();?>" class="nu gray">Learn
                    more</a></p>
        </div>
    </div>
    <?php
        }
        echo paginate_links();
    ?>
    <hr class="section-break">
    <p>Looking for a recap of past Events? <a href="<?= site_url('/past-events')?>">Check out our past events
            archive</a>
    </p>
</div>


<!-- end of content section -->

<?php get_footer();?>