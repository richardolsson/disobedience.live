<!doctype html>
<html>
    <head>
        <?php wp_head();?>
        <title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/main.css?v=1708161119">
        <link href="https://fonts.googleapis.com/css?family=Space+Mono" rel="stylesheet">
        <link rel="icon" href="<?php echo get_template_directory_uri();?>/images/favicon.png">
        <script src="https://use.typekit.net/rdb8ojx.js"></script>
        <script>try{Typekit.load({ async: true });}catch(e){}</script>
        <meta name="viewport" content="width=device-width">
        <script
            src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g="
            crossorigin="anonymous"></script>
        <script src="<?php echo get_template_directory_uri();?>/main.js?v=1708151147"></script>
    </head>
    <body <?php body_class();?>>
        <div class="lang-switch">
            <?php wp_nav_menu(array('theme_location' => 'lang-menu'));?>
        </div>
        <div class="page">
            <div class="header">
                <a class="logo" href="/">DIS<span>_</span>OBEDIENCE.LIVE</a>
                <div class="menu">
                    <?php wp_nav_menu(array('theme_location' => 'header-menu'));?>
                </div>
            </div>
