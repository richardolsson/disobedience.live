<!doctype html>
<html>
    <head>
        <title><?php the_title();?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/main.css">
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,500,700|Taviraj:400i" rel="stylesheet">
        <link rel="icon" href="<?php echo get_template_directory_uri();?>/images/favicon.png">
        <meta name="viewport" content="width=device-width">
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
