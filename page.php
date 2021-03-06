<?php
    get_header();
    
    while (have_posts()) {
        # code...
        the_post();
?>


<!-- insert php function code of pageBanner($args) here -->
<?php
pageBanner(array(
    // 'photo'         => 'https://images.unsplash.com/photo-1525784451128-d1488f52f03e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=928&q=80'
));
?>
<!-- end of php function code of pageBanner($args) -->

<div class="container container--narrow page-section">
    <?php
    // wp_get_post_parent_id( get_the_ID() ) - used to get the id of the parent page/post.
        $theParentID = wp_get_post_parent_id( get_the_ID() );
        if( $theParentID ){?>
    <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
            <!-- get_permalink() - gets the permalink of the current page/post -->
            <a class="metabox__blog-home-link" href="<?= get_permalink($theParentID);?>"><i class="fa fa-home"
                    aria-hidden="true"></i> Back to <?= get_the_title($theParentID);?></a>
            <!-- get_the_title() - gets title of the current page/post -->
            <span class="metabox__main"><?php the_title();?></span>
        </p>
    </div>
    <?php } ?>

    <?php 

    ?>
    <?php
        // $testArray - this allows us to check if the page has children or if the page is just an independent page.
        $testArray = get_pages(array(
            'child_of' => get_the_ID()
        )); 
        if($theParentID or $testArray) {
    ?>
    <div class="page-links">
        <h2 class="page-links__title"><a href="<?= get_permalink($theParentID)?>"><?= get_the_title($theParentID);?></a>
        </h2>
        <ul class="min-list">
            <?php
                // below is an example of an associative array.
                // $animalSounds = array(
                //     'cat' => 'meow',
                //     'dog' => 'woof',
                //     'pig' => 'oink'
                // );

                if ($theParentID) {
                    $findChildrenOf = $theParentID;
                } else {
                    $findChildrenOf = get_the_ID();
                }
                wp_list_pages(array(
                    // 'title_li - is connected to the parent page's/post's title page/post.
                    'title_li'      => NULL,
                    'child_of'      => $findChildrenOf,
                    // 'sort_column' => 'menu_order' - this is to sort the menus according to the order we want it to.
                    'sort_column'   => 'menu_order'
                ));
            ?>
        </ul>
    </div>
    <?php } ?>

    <div class="generic-content">
        <p><?php the_content();?></p>
    </div>
</div>

<?php } 
    get_footer();
?>