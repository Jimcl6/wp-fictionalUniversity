<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset');?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head();?>
</head>


<body <?php body_class(); ?>>
    <!-- body_class() - wordpress function that give the body tag class names relative to our wordpress page attributes. -->

    <!-- bloginfo() - a function that grabs the details of the wordpress website. see: https://developer.wordpress.org/reference/functions/bloginfo/ for more info on bloginfo() -->
    <!-- bloginfo('name') - grabs the site's title -->
    <!-- <h1><?php //bloginfo('name');?></h1> -->

    <!-- bloginfo('description') - grabs the site's tagline. -->
    <!-- <h2><?php //bloginfo('description')?></h2> -->

    <header class="site-header">
        <div class="container">
            <h1 class="school-logo-text float-left">
                <a href="<?php echo site_url();?>"><strong>Fictional</strong> University</a>
            </h1>
            <span class="js-search-trigger site-header__search-trigger"><i class="fa fa-search"
                    aria-hidden="true"></i></span>
            <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
            <div class="site-header__menu group">
                <nav class="main-navigation">
                    <?php
                        // code for dynamic wordpress menu footer
                        // wp_nav_menu(array(
                        //     'theme_location' => 'headerMenuLocation',                           
                        // ));
                    ?>
                    <ul>
                        <li
                            <?php if(is_page('about-us') or wp_get_post_parent_id(0) == 17) echo 'class="current-menu-item"';?>>
                            <a href="<?php echo site_url('/about-us'); ?>">About Us</a>
                        </li>
                        <li <?php if(get_post_type() == 'programs') echo 'class="current-menu-item"';?>><a
                                href="<?= get_post_type_archive_link('programs'); ?>">Programs</a></li>
                        <li
                            <?php if(get_post_type() == 'events' or is_page('past-events')) echo 'class="current-menu-item"';?>>
                            <a href="<?= site_url('/events'); ?>">Events</a>
                        </li>
                        <li <?php if(is_page('')) echo 'class="curent-menu-item"';?>><a
                                href="<?= site_url('/'); ?>">Campuses</a></li>
                        <!-- get_post_type() -->
                        <li <?php if(get_post_type() == 'post') echo 'class="current-menu-item"';?>><a
                                href="<?= site_url('/blog'); ?>">Blog</a></li>
                    </ul>
                </nav>
                <div class="site-header__util">
                    <a href="#" class="btn btn--small btn--orange float-left push-right">Login</a>
                    <a href="#" class="btn btn--small btn--dark-orange float-left">Sign Up</a>
                    <span class="search-trigger js-search-trigger"><i class="fa fa-search"
                            aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
    </header>