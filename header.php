<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
    <title><?php
        if ( is_single() ) { single_post_title(); }
        elseif ( is_home() || is_front_page() ) { bloginfo('name'); print ' | '; bloginfo('description'); get_page_number(); }
        elseif ( is_page() ) { single_post_title(''); }
        elseif ( is_search() ) { bloginfo('name'); print ' | Search results for ' . wp_specialchars($s); get_page_number(); }
        elseif ( is_404() ) { bloginfo('name'); print ' | Not Found'; }
        else { bloginfo('name'); wp_title('|'); get_page_number(); }
    ?></title>

    <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">

    <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

    <?php wp_head(); ?>

    <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" title="<?php printf( __( '%s latest posts', 'hbd-theme' ), wp_specialchars( get_bloginfo('name'), 1 ) ); ?>" />
    <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'hbd-theme' ), wp_specialchars( get_bloginfo('name'), 1 ) ); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
</head>
<body>
<header class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="row">
            <div class="header-logo col-xs-6 col-sm-3 text-left">
                <a href="/">
                    <img src="/wp-content/uploads/logo.png" alt="RIPRAG"/>
                </a>
            </div>
            <div class="header-middle col-xs-2 col-sm-7 text-right">
                <div class="header-catch-line hidden-xs">PRE-TIE AND STORE ALL YOUR RIGS TANGLE FREE AND<br> SPEND YOUR TIME ON THE WATER FISHING,  NOT RIGGING!</div>
                <div class="header-cart">
                    <?php
                        wp_nav_menu(array(
                            'theme_location' => 'header_navigation', // menu slug from step 1
                            'container' => false, // 'div' container will not be added
                            'menu_class' => 'nav', // <ul class="nav">
                            'fallback_cb' => 'default_header_nav', // name of default function from step 2
                        ));
                    ?>
                </div>
            </div>
            <div class="header-right col-xs-4 col-sm-offset-0 col-sm-2 text-right">
                <img src="/wp-content/uploads/as-seen-on-tv.png">
            </div>
        </div>
        <div class="header-middle visible-xs text-center">
            PRE-TIE AND STORE ALL YOUR RIGS TANGLE FREE AND SPEND YOUR TIME ON THE WATER FISHING,  NOT RIGGING!
        </div>
    </div>
</header>
