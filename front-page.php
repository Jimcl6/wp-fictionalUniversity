<?php 
    get_header();
    
?>

<div class="page-banner">
    <!-- get_theme_file_uri() - this grabs the url link and add the file name and location as the argument of the get_theme_uri() function -->
    <div class="page-banner__bg-image"
        style="background-image: url(<?= get_theme_file_uri('/images/library-hero.jpg')?>)"></div>
    <div class="page-banner__content container t-center c-white">
        <h1 class="headline headline--large">Welcome!</h1>
        <h2 class="headline headline--medium">We think you&rsquo;ll like it here.</h2>
        <h3 class="headline headline--small">Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re
            interested in?</h3>
        <a href="#" class="btn btn--large btn--blue">Find Your Major</a>
    </div>
</div>

<div class="full-width-split group">
    <!-- events section -->
    <div class="full-width-split__one">
        <div class="full-width-split__inner">
            <h2 class="headline headline--small-plus t-center">Upcoming Events</h2>

            <!-- php wordpress custom query -->
            <?php 

                $today = date('Ymd');
                $homepageEvents = new WP_Query(array(
                    'posts_per_page'  => -1,
                    'post_type'       => 'events',
                    'met_key'         => 'event_date',
                    'orderby'         => 'meta_value_num',
                    'order'           => 'ASC',
                    'meta_query'      =>  array(
                        array(
                            'key'       => 'event_date',
                            'compare'   => ">=",
                            'value'     => $today,
                            'type'      => 'numeric'
                        )
                    )
                ));

                while($homepageEvents -> have_posts()) {
                    $homepageEvents -> the_post();
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
                    <p>
                        <?php 
                            if(has_excerpt()) {
                                the_excerpt();
                            } else {
                                echo wp_trim_words(get_the_content(), 20);
                            } 
                        ?>
                        <a href="<?php the_permalink();?>" class="nu gray">Learn more</a>
                    </p>
                </div>
            </div>
            <?php
                }
            ?>
            <!-- end of wordpress custom query -->

            <p class="t-center no-margin"><a href="<?= get_post_type_archive_link('events');?>"
                    class="btn btn--blue">View
                    All Events</a>
            </p>
        </div>
    </div>
    <!-- end of events section -->

    <!-- blog section -->
    <div class="full-width-split__two">
        <div class="full-width-split__inner">
            <h2 class="headline headline--small-plus t-center">From Our Blogs</h2>

            <!-- custom wordpress query -->
            <?php 
                // creation of custom wordpress query.
                // to create a custom WP query enter the following code. $variableName = new WP_Query();
                // for more information and reference to paramaters we can use for WP_Query(array()) see: https://developer.wordpress.org/reference/classes/wp_query/
                $homepagePosts = new WP_Query(array(
                    'posts_per_page' => 2,
                ));

                // 
                while ($homepagePosts -> have_posts()) {
                    $homepagePosts -> the_post();
            ?>
            <!-- end of custom wordpress query -->
            <div class="event-summary">
                <a class="event-summary__date event-summary__date--beige t-center" href="<?php the_permalink();?>">
                    <span class="event-summary__month"><?php the_time('F')?></span>
                    <span class="event-summary__day"><?php the_time('d')?></span>
                </a>
                <div class="event-summary__content">
                    <h5 class="event-summary__title headline headline--tiny"><a
                            href="<?php the_permalink(); ?>"><?php the_title();?></a>
                    </h5>
                    <p><?php 
                        if(has_excerpt()) {
                            the_excerpt();
                        } else {
                            echo wp_trim_words(get_the_content(), 18);
                        } ?><a href="<?php the_permalink(); ?>" class="nu gray">Read more</a></p>
                </div>
            </div>
            <?php
                }
                // this will reset the custom Wordpress query back to the default automatic wordpress query.
                wp_reset_postdata();
            ?>

            <p class="t-center no-margin"><a href="<?= site_url('/blog');?>" class="btn btn--yellow">View All Blog
                    Posts</a></p>
        </div>
    </div>
    <!-- end of blog section -->
</div>

<div class="hero-slider">
    <div data-glide-el="track" class="glide__track">
        <div class="glide__slides">
            <div class="hero-slider__slide" style="background-image: url(<?= get_theme_file_uri('/images/bus.jpg')?>)">
                <div class="hero-slider__interior container">
                    <div class="hero-slider__overlay">
                        <h2 class="headline headline--medium t-center">Free Transportation</h2>
                        <p class="t-center">All students have free unlimited bus fare.</p>
                        <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
                    </div>
                </div>
            </div>
            <div class="hero-slider__slide"
                style="background-image: url(<?= get_theme_file_uri('images/apples.jpg')?>)">
                <div class="hero-slider__interior container">
                    <div class="hero-slider__overlay">
                        <h2 class="headline headline--medium t-center">An Apple a Day</h2>
                        <p class="t-center">Our dentistry program recommends eating apples.</p>
                        <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
                    </div>
                </div>
            </div>
            <div class="hero-slider__slide" style="background-image: url(<?= get_theme_file_uri('images/bread.jpg')?>)">
                <div class="hero-slider__interior container">
                    <div class="hero-slider__overlay">
                        <h2 class="headline headline--medium t-center">Free Food</h2>
                        <p class="t-center">Fictional University offers lunch plans for those in need.</p>
                        <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="slider__bullets glide__bullets" data-glide-el="controls[nav]"></div>
    </div>
</div>

<?php get_footer(); ?>