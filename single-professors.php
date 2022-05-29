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
<?php pageBanner();?>
<!-- end of banner section -->

<!-- content section -->

<section id="content-section">
    <div class="container container--narrow page-section">
        <div class="generic-content">
            <div class="row group">
                <div class="one-third">
                    <?php
                    // in order to for us to use the image size we added in our functions.php follow format below:
                    // the_post_thumbnail('professorPortrait'); 
                    the_post_thumbnail('professorPortrait'); 
                    ?>
                </div>
                <div class="two-thirds">
                    <?php the_content();?>
                </div>
            </div>
        </div>

        <?php 
        $relatedPrograms = get_field('related_programs');

        if($relatedPrograms) {
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium">Subject(s) Taught</h2>';
            echo '<ul class="link-list min-list">';
            foreach($relatedPrograms as $programs) {
        ?>
        <li><a href="<?= get_the_permalink($programs);?>"><?= get_the_title($programs)?></a></li>
        <?php 
            }
            echo '</ul>';
        }
        ?>


    </div>
</section>
<!-- end of content section -->


<?php
    }
    get_footer();
?>