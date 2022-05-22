<?php

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
        // title_tag - This feature enables plugins and themes to manage the document title tag. This should be used in place of wp_title() function.
    add_theme_support('title-tag');
}

add_action('after_setup_theme', 'university_features');