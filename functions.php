<?php

// pageBanner function - best to be used on for website's page banner.
function pageBanner($args) {
    $pageBannerImage = get_field('page_banner_background_image'); 
    if(!$args['title']) {
       $args['title'] = get_the_title();
    }

    if(!$args['subtitle']) {
        $args['subtitle'] = get_field('page_banner_subtitle');
    }

    if(!$args['photo']) {
        if(get_field('page_banner_background_image')) {
            $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
        } else {
            $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
        }
    }
?>
<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?= $args['photo'];?>)">
    </div>
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?= $args['title'];?></h1>
        <div class="page-banner__intro">
            <p>
                <?=
                   $args['subtitle'] ;
                ?>
            </p>
        </div>
    </div>
</div>
<?php 
}
// end of pageBanner function

function university_files() {
 
    wp_enqueue_script('main-university-javascript', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);

    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i' );
    wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
    wp_enqueue_style( 'university_main_styles', get_theme_file_uri( '/build/style-index.css' ));
    wp_enqueue_style( 'university_extra_styles', get_theme_file_uri( '/build/index.css' ));
    
}

// add_action('wp_enqueue_scripts', 'university_files') - this is to add our JS files and css file to our wordpress website.
add_action('wp_enqueue_scripts', 'university_files');

function university_features() {
    // register_nav_menu - this is to register menu for wordpress dynamic menu for our wordpress website, and also this enables the Menu tool on our Appearance tab on wp-admin side bar menu.
    // register_nav_menu( 'headerMenuLocation', 'Header Menu Location' );
    // register_nav_menu( 'footerMenuLocationExplore', 'Footer Menu Location Explore' );
    // register_nav_menu( 'footerMenuLocationLearn', 'Footer Menu Location Learn' );

    // add_theme_support() - Registers theme support for a given feature. see: https://developer.wordpress.org/reference/functions/add_theme_support/ for more information
    // format: add_theme_support(wp_parameter);
        // title-tag - This feature enables plugins and themes to manage the document title tag. This should be used in place of wp_title() function.
        
    add_theme_support('title-tag');

    // add_theme_support('post-thumbnails') - this allows us to enable the featured image feature on our wordpress post types.
    add_theme_support('post-thumbnails');
    // add_image_size() - this allows us to enable wordpress image sizing
    // format: add_image_size('name', width(int), heigh(int), bool);
    add_image_size('professorLandscape', 400, 260, true);
    add_image_size('professorPortrait', 480, 650, true);
    add_image_size('pageBanner', 1500, 350, true);
}

add_action('after_setup_theme', 'university_features');


function university_adjust_queries($query) {

    // Programs
    if(!is_admin() AND is_post_type_archive('programs') AND $query->is_main_query()) {
        $query  ->  set('posts_per_page', -1);
        $query  ->  set('orderby', 'title');
        $query  ->  set('order', 'ASC');
    }
    

    // Events
    $today = date('Ymd');
    if(!is_admin() AND is_post_type_archive('events') AND $query->is_main_query()) {
        $query  ->  set('metakey', 'event_date');
        $query  ->  set('orderby', 'meta_value_num');
        $query  ->  set('order', 'ASC');
        $query  ->  set('meta_query', array(
            array(
                'key'       => 'event_date',
                'compare'   => ">=",
                'value'     => $today,
                'type'      => 'numeric'
            )
        ));
    }
    
}
add_action('pre_get_posts','university_adjust_queries');