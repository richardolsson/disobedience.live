<?php
    $start_time = mktime(12, 0, 0, 8, 22, 2017);
    $now = mktime();
    $diff = $start_time - $now;
    $days = $diff / 60 / 60 / 24;
?>
<?php get_header();?>
<?php the_post();?>
<?php
    $events = get_posts(array(
        'post_type' => 'event',
        'posts_per_page' => 1000,
    ));

    $add_event_url = null;
    $add_event_pages = get_posts(array(
        'post_type' => 'page',
        'fields' => 'ids',
        'nopaging' => true,
        'meta_key' => '_wp_page_template',
        'meta_value' => 'page-addevent.php'
    ));

    if (!empty($add_event_pages)) {
        $add_event_page = $add_event_pages[0];
        if (function_exists('pll_get_post')) {
            $add_event_page = pll_get_post($add_event_page);
        }

        $add_event_url = get_the_permalink($add_event_page);
    }

    $about_url = null;
    $about_pages = get_posts(array(
        'post_type' => 'page',
        'fields' => 'ids',
        'nopaging' => true,
        'meta_key' => '_wp_page_template',
        'meta_value' => 'page-about.php'
    ));

    if (!empty($about_pages)) {
        $about_page = $about_pages[0];
        if (function_exists('pll_get_post')) {
            $about_page = pll_get_post($about_page);
        }

        $about_url = get_the_permalink($about_page);
    }

    $activists = get_posts(array(
        'post_type' => 'activist',
        'fields' => 'ids',
    ));

    $voices = get_posts(array(
        'post_type' => 'voice',
        'fields' => 'ids',
    ));

    $intro = apply_filters('the_content', get_the_content());

    $hero_img = get_field('home_hero_image', 'option');
    $home_msg = disobedience_get_home_msg();

    $stream_uri = get_field('home_stream_uri', 'option');
    $stream_live = get_field('home_stream_live', 'option');
?>
<div class="content">
    <?php if (!empty($stream_uri) && !empty($stream_live)):?>
    <div class="stream">
        <div id="stream-player"></div>
    </div>
    <script>
        (function() {
            var elem = document.getElementById('stream-player');
            var uri = '<?php echo $stream_uri; ?>';
            var player = BambuserPlayer.create(elem, uri, {
            });

            player.play();

            // Make the video play/pause when the user clicks on the container div.
            elem.addEventListener('click', function() {
                return player.paused ? player.play() : player.pause();
            });

            if (navigator.userAgent.match(/iPad|iPhone|iPod/) && !window.MSStream) {
                player.controls = true;
            }
        })();
    </script>
    <?php elseif (!empty($hero_img)):?>
    <div class="hero">
        <img src="<?php echo $hero_img['url'];?>">
    </div>
    <?php else: ?>
    <div class="countdown">
        <h1><?php printf('%d %s remaining', $days, $days==1? 'day':'days') ?></h1>
    </div>
    <?php endif;?>
    <?php if (!empty($home_msg)):?>
    <div class="message">
        <div class="message-text">
            <p id="home-msg"><?php echo $home_msg;?></p>
        </div>
    </div>
    <?php endif;?>
    <div class="intro">
        <h1 class="flash"
            style="background-image: url(<?php echo get_the_post_thumbnail_url();?>)"><?php the_title();?></h1>
        <div class="post-content page-content">
            <?php echo $intro; ?>
        </div>
        <?php if (!empty($about_url)):?>
        <a class="cta" href="<?php echo $about_url;?>"><?php disobedience_pstr('home_intro_read_more');?></a>
        <?php endif;?>
    </div>
    <?php if (!empty($activists)):?>
    <div class="activists">
        <h2><?php disobedience_pstr('home_activists_header');?></h2>
        <ul class="activist-list">
        <?php foreach ($activists as $id): $url = get_the_permalink($id); ?>
            <li class="activist-item">
                <a href="<?php echo $url;?>"
                    class="thumb-link flash"><?php echo get_the_post_thumbnail($id, 'activist-thumbnail');?></a>
                <h3><a href="<?php echo $url;?>"><?php echo get_the_title($id);?></a></h3>
                <p><?php echo get_excerpt_by_id($id);?></p>
            </li>
        <?php endforeach; ?>
        </ul>
    </div>
    <?php endif;?>
    <?php if (!empty($voices)):?>
    <div class="voices">
        <h2><?php disobedience_pstr('home_voices_header');?></h2>
        <div class="gradient"></div>
        <p>
            <?php disobedience_pstr('home_voices_intro');?>
        </p>
        <p>
        <?php foreach ($voices as $id): $url = get_the_permalink($id); ?>
            <?php echo get_the_title($id);?><br>
        <?php endforeach; ?>
        </p>
        <p class="cta">
            <a href="<?php echo get_post_type_archive_link('voice');?>"><?php disobedience_pstr('home_voices_button');?></a>
        </p>
    </div>
    <?php endif;?>
    <div class="events">
        <h2><?php disobedience_pstr('home_events_header');?></h2>
        <p>
            <?php disobedience_pstr('home_events_intro');?>
        </p>
        <div class="map-container flash">
            <div id="map"></div>
        </div>

        <a href="/events" class="cta"><?php disobedience_pstr('home_events_list_button');?></a>
        <a href="<?php echo $add_event_url;?>" class="cta"><?php disobedience_pstr('home_events_add_button');?></a>
    </div>
</div>
<script>
    var events = [
    <?php
        foreach ($events as $event):
            $id = $event->ID;
            if ($loc = get_field('location', $id)):
    ?>
        {
            link: '<?php echo get_the_permalink($id);?>',
            title: '<?php echo get_the_title($id);?>',
            lat: <?php echo $loc['lat'];?>,
            lng: <?php echo $loc['lng'];?>,
        },
    <?php endif;?>
    <?php endforeach;?>
    ];

    function initMap() {
        var icons = ['<?php echo get_template_directory_uri();?>/images/marker-green.png'];
        initEventMap(document.getElementById('map'), events, icons);
    }
</script>
<script>
    (function() {
        var elem = document.getElementById('home-msg');
        var url = '<?php echo admin_url('admin-ajax.php');?>';
        initHomeMsgPolling(elem, url);
    })();
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNTh_Ay85-bSJ5WO1v-Sknl7R_IEBMVx4&callback=initMap" async defer></script>
<?php get_footer();?>
