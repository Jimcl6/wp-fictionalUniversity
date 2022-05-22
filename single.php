<?php 

while(have_posts()) {
    the_post(); ?>
<h2>
    <?php the_title(); ?>
    <!-- the_title() wordpress function that grabs title of posts. -->
</h2>
<?php the_content(); ?>
<!-- the_content() wordpress function that grabs the content of posts. -->
<?php
}
?>