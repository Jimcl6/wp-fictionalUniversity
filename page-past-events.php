<?php get_header();?>

<!-- banner section -->
<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?= get_theme_file_uri('/images/ocean.jpg')?>)">
    </div>
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title">
            Past Events
        </h1>
        <div class="page-banner__intro">
            <p>Recap of our past events.</p>
        </div>
    </div>
</div>
<!-- end of banner section -->

<!-- content section -->
<div class="container container--narrow page-section">
    <!-- to grab our wordpress post listing start off with the wordpress loop. see below for an example. -->

    <?php
    
        // custom query code for past Events page
        $today = date('Ymd');
        $pastEvents = new WP_Query(array(
            // 'paged'        => get_query_var('paged', 1), - this grabs the page number from the pagination of our custom query.
            'paged'           => get_query_var('paged', 1),
            'post_type'       => 'events',
            'met_key'         => 'event_date',
            'orderby'         => 'meta_value_num',
            'order'           => 'ASC',
            'meta_query'      =>  array(
                array(
                    'key'       => 'event_date',
                    // when grabbing date from past events in the 'compare' parameter assign the lesser than symbol(<).
                    'compare'   => "<",
                    'value'     => $today,
                    'type'      => 'numeric'
                )
            )
        ));
        // end of custom query code for past Events page

        // start off with the while loop. while(have_posts()) {
        while ($pastEvents->have_posts()) {
            // $pastEvents->the_post() - this should echo out the posts from our wordpress posts/page admin panel.
            $pastEvents->the_post();
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
        echo paginate_links(array(
            'total' => $pastEvents->max_num_pages
        ));
    ?>
</div>
<!-- end of content section -->

<?php get_footer();?>