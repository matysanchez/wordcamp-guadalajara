<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width" />
    <?php wp_head(); ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-150327458-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-150327458-1');
    </script>
</head>

<body <?php body_class(); ?>>
    <header id="header">
        <div class="full-container">
            <div class="logo">
                <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_html(get_bloginfo('name')); ?>" rel="home">
                    <?php
                    $custom_logo_id = get_theme_mod('custom_logo');
                    $image = wp_get_attachment_image_src($custom_logo_id, 'full');
                    if (empty($image[0])) {
                        echo esc_html(get_bloginfo('name'));
                    } else {
                        echo '<img class="logo" src="' . $image[0] . '" title="Matías Sanchez Moises">';
                    }
                    ?>
                    <?php  ?>
                </a>
            </div>
            <nav id="page-nav">
                <label for="hamburger">&#9776;</label>
                <input type="checkbox" id="hamburger" />
                <?php wp_nav_menu(array('theme_location' => 'main-menu', 'container' => false)); ?>
            </nav>
            <div class="clearfix"></div>
        </div>
    </header>