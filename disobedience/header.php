<!doctype html>
<html>
    <head>
        <title><?php the_title();?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/main.css">
        <link href="https://fonts.googleapis.com/css?family=Space+Mono" rel="stylesheet">
        <link rel="icon" href="<?php echo get_template_directory_uri();?>/images/favicon.png">
        <meta name="viewport" content="width=device-width">
        <script
            src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g="
            crossorigin="anonymous"></script>
        <script src="<?php echo get_template_directory_uri();?>/main.js"></script>
    </head>
    <body <?php body_class();?>>
        <div class="page">
            <div class="header">
                <a href="/"><img class="logo" alt="Troja Scenkonst"
                    src="<?php echo get_template_directory_uri();?>/images/logo.png"></a>
                <div class="menu">
                    <?php wp_nav_menu(array('theme_location' => 'header-menu'));?>
                </div>
            </div>
