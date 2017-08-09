<!doctype html>
<html>
    <head>
        <title><?php the_title();?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/main.css?v=170809">
        <link href="https://fonts.googleapis.com/css?family=Space+Mono" rel="stylesheet">
        <link rel="icon" href="<?php echo get_template_directory_uri();?>/images/favicon.png">
        <script src="https://use.typekit.net/rdb8ojx.js"></script>
        <script>try{Typekit.load({ async: true });}catch(e){}</script>
        <meta name="viewport" content="width=device-width">
        <script
            src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g="
            crossorigin="anonymous"></script>
        <script src="<?php echo get_template_directory_uri();?>/main.js?v=170809"></script>
    </head>
    <body <?php body_class();?>>
        <div class="lang-switch">
            <?php wp_nav_menu(array('theme_location' => 'lang-menu'));?>
        </div>
        <div class="page">
            <div class="header">
                <a class="logo" href="/">DIS_OBEDIENCE.LIVE</a>
                <div class="menu">
                    <?php wp_nav_menu(array('theme_location' => 'header-menu'));?>
                </div>
            </div>
