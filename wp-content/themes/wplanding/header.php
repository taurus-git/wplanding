<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Title</title>
    <?php wp_head(); ?>
</head>
<body>
<div id="wrapper">
    <header id="header" class="header">
        <div class="wrap wrap-1628">
            <div class="header-box" id="header-box" style="">
                <a href="#" class="header-logo">
                    <img width="165" height="40" src="<?php bloginfo('template_url') ?>/assets/images/logo-header.png" class="custom-logo" alt="Hyperion" itemprop="logo">
                </a>
                <nav class="menu">
                    <a href="#" class="nav-opener">
                        <div class="nav-opener-icon">
                            <div class="line line_1"></div>
                            <div class="line line_2"></div>
                            <div class="line line_3"></div>
                        </div>
                    </a>
                    <?php
                    wp_nav_menu( [
                        'theme_location' => 'header-menu',
                    ] );
                    ?>
                </nav>
            </div>
        </div>
    </header>
    <div id="event-header">
        <div class="block-visual">
            <h1>Foundations for innovation</h1>
            <div class="block-title">
                <span>27th of September</span>
                <strong>Malta</strong>
            </div>
            <div class="block-logos">
                <span>Hosted by</span>
                <a href="#"><img src="<?php bloginfo('template_url') ?>/assets/images/logo-2.png" alt="image description" width="269" height="122"></a>
                <span>and</span>
                <a href="#"><img src="<?php bloginfo('template_url') ?>/assets/images/logo-1.png" alt="image description" width="149" height="140"></a>
            </div>
            <a href="#" class="btn-registr">Registration</a>
        </div>
    </div>
    <div id="event-main">