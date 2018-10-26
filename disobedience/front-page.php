<?php
    $start_time = mktime(10, 0, 0, 8, 22, 2017);
    $now = mktime();
    $diff = $start_time - $now;
    $countdown_value = floor($diff / 60 / 60 / 24);
    $countdown_unit = 'day';
    if ($countdown_value < 1) {
        $countdown_value = round($diff / 60 / 60);
        $countdown_unit = 'hour';
    }
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

    $stream_live = get_field('home_stream_live', 'option');
    $stream_ch = get_field('home_stream_channel', 'option');
    if ($stream_ch == 'youtube') {
        $stream_uri = get_field('home_youtube_url', 'option');
    }
    elseif ($stream_ch == 'bambuser') {
        $stream_uri = get_field('home_stream_uri', 'option');
    }
    else {
        $stream_live = false;
    }
?>
<div class="content">
    <?php if (($stream_uri) && !empty($stream_live)):?>
    <div class="stream" id="stream">
        <div id="stream-player">
            <iframe width="560" height="315"
                src="<?php echo $stream_uri;?>" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
    <?php elseif (!empty($hero_img)):?>
    <div class="hero" id="stream">
        <img src="<?php echo $hero_img['url'];?>">
    </div>
    <?php else: ?>
    <div class="countdown" id="stream">
        <?php if ($countdown_value >= 0):?>
        <h1><?php printf('%d %s%s remaining',
            $countdown_value,
            $countdown_unit,
            $countdown_value==1? '':'s') ?></h1>
        <script>
            setTimeout(function() {
                location.reload(true);
            }, 60000);
        </script>
        <?php endif;?>
    </div>
    <?php endif;?>
    <?php if (!empty($home_msg)):?>
    <div class="message">
        <div class="message-text">
            <p id="home-msg"><?php echo $home_msg;?></p>
        </div>
    </div>
    <?php endif;?>
    <div class="intro" id="intro">
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
    <div class="activists" id="activists">
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
    <div class="voices" id="voices">
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
    <div class="events" id="events">
        <h2><?php disobedience_pstr('home_events_header');?></h2>
        <p>
            <?php disobedience_pstr('home_events_intro');?>
        </p>
        <div class="map-container flash">
            <div id="map"></div>
            <div class="legend">
                <?php disobedience_pstr('events_map_legend_green');?>
            </div>
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
            icon: '<?php echo disobedience_event_icon($event);?>',
        },
    <?php endif;?>
    <?php endforeach;?>
    ];

    function initMap() {
        initEventMap(document.getElementById('map'), events);
    }
</script>
<script>
    (function() {
        var elem = document.getElementById('home-msg');
        var url = '<?php echo admin_url('admin-ajax.php');?>';
        initHomeMsgPolling(elem, url);
    })();
</script>
<script>
$('a[href*="#"]')
    .not('[href="#"]')
    .not('[href="#0"]')
    .click(function(event) {
        // Figure out element to scroll to
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        // Does a scroll target exist?
        if (target.length) {
            // Only prevent default if animation is actually gonna happen
            event.preventDefault();
            $('html, body').animate({
                scrollTop: target.offset().top
            }, 300);
        }
    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNTh_Ay85-bSJ5WO1v-Sknl7R_IEBMVx4&callback=initMap" async defer></script>
<?php get_footer();?>
