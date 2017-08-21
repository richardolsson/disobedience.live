<?php
    $menu_locations = get_nav_menu_locations();
    $menu_id = $menu_locations['header-menu'];
    $menu_items = wp_get_nav_menu_items($menu_id);
?>
<!doctype html>
<html>
    <head>
        <?php wp_head();?>
        <title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/main.css?v=1708211237">
        <link href="https://fonts.googleapis.com/css?family=Space+Mono" rel="stylesheet">
        <link rel="icon" href="<?php echo get_template_directory_uri();?>/images/favicon.png">
        <script src="https://dist.bambuser.net/player/lib/bambuser-video-iframeapi/latest/bambuser-video-iframeapi.min.js"></script>
        <script src="https://use.typekit.net/rdb8ojx.js"></script>
        <script>try{Typekit.load({ async: true });}catch(e){}</script>
        <meta name="viewport" content="width=device-width">
        <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
        <script src="<?php echo get_template_directory_uri();?>/main.js?v=1708210944"></script>
    </head>
    <body <?php body_class();?>>
        <div class="lang-switch">
            <?php wp_nav_menu(array('theme_location' => 'lang-menu'));?>
        </div>
        <div class="page">
            <div class="header">
                <a class="logo" href="/">DIS<span>_</span>OBEDIENCE.LIVE</a>
                <div class="menu">
                    <ul class="menu menu-main-menu">
                    <?php foreach ($menu_items as $item):
                        $cur_url = home_url(add_query_arg(array(),$wp->request)) . '/';
                        $is_cur = ($cur_url == $item->url);
                        $url = $item->url;
                        $tpl = get_post_meta($item->object_id, '_wp_page_template', true);
                        if ($tpl == 'page-about.php' && is_front_page()) {
                            $url = get_home_url().'/#intro';
                        }
                        elseif ($tpl == 'page-addevent.php' && is_front_page()) {
                            $url = get_home_url().'/#events';
                        }
                        elseif ($tpl == 'default') {
                            $url = get_home_url().'/#stream';
                        }
                        elseif ($item->type == 'post_type_archive') {
                            if ($item->object == 'activist') {
                                $url = get_home_url().'/#activists';
                            }
                            elseif ($item->object == 'event' && is_front_page()) {
                                $url = get_home_url().'/#events';
                            }
                            elseif ($item->object == 'voice' && is_front_page()) {
                                $url = get_home_url().'/#voices';
                            }
                        }
                    ?>
                        <li id="menu-item-<?php echo $item->ID;?>"
                            class="menu-item<?php if ($is_cur):?> current-menu-item<?php endif;?>">
                            <a href="<?php echo $url;?>"><?php echo $item->title;?></a>
                        </li>
                    <?php endforeach;?>
                    </ul>
                </div>
            </div>
