<?php 
    get_header();
    while(have_posts()) {
        the_post(); 
?>

<!-- note to self: when creating a custom post type always keep in check of the name since the name has the exactly the same when calling it from the custom plugin. -->

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
                <p><?php the_archive_description();?></p>
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
                <a class="metabox__blog-home-link" href="<?= get_post_type_archive_link('programs')?>"><i
                        class="fa fa-home" aria-hidden="true"></i> All Programs</a>
                <!-- get_the_title() - gets title of the current page/post -->

                <!-- the the_author_posts_link(); - this grabs the author of the wordpress post.-->
                <!-- the_time() - grabs when the time/date of the wordpress post was published, in order to apply a better format for date and time of wordpress post please see: https://wordpress.org/support/article/formatting-date-and-time/ for more information -->
                <span class="metabox__main"><?php the_title();?></span>
            </p>
        </div>
        <!-- end of meta box section -->
        <div class="generic-content">
            <?php the_content();?>
        </div>


        <?php

        // related professors
        $relatedProfessors = new WP_Query(array(
            'posts_per_page'  => -1,
            'post_type'       => 'professors',
            'orderby'         => 'title',
            'order'           => 'ASC',
            'meta_query'      =>  array(
                array(
                    'key'       => 'related_programs',
                    'compare'   => 'LIKE',
                    'value'     => '"' . get_the_ID('') . '"'
                )
            )
        ));
        
        if($relatedProfessors->have_posts()) 
        {
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium">' . get_the_title() . ' Professors</h2>';
;
            while($relatedProfessors -> have_posts()) {
                $relatedProfessors -> the_post();
        ?>
        <li class="professor-card__list-item">
            <a class="professor-card" href="<?php the_permalink();?>">
                <img src="<?php the_post_thumbnail_url('professorLandscape');?>" alt="" class="professor-card__image">
                <span class="professor-card__name"><?php the_title();?></span>
            </a>
        </li>
        <?= '</ul>';?>
        <?php
            }
        }
        

        // note: wp_reset_postdate() should always be present when creating multiple custom wordpress queries.
        wp_reset_postdata();

        ?>
        <?php
        // related programs
        $today = date('Ymd');
        $homepageEvents = new WP_Query(array(
            'posts_per_page'  => 2,
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
                ),
                array(
                    'key'       => 'related_programs',
                    'compare'   => 'LIKE',
                    'value'     => '"' . get_the_ID('') . '"'
                ),
                
            )
        ));
        
        if($homepageEvents->have_posts()) 
        {
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium">Upcoming ' . get_the_title() . ' Events</h2>';

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
        }
        ?>

    </div>
</section>
<!-- end of content section -->


<?php
    }
    get_footer();
?>