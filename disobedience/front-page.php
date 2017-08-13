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

    $activists = get_posts(array(
        'post_type' => 'activist',
        'fields' => 'ids',
    ));

    $voices = get_posts(array(
        'post_type' => 'voice',
        'fields' => 'ids',
    ));

    $intro = apply_filters('the_content', get_the_content());
?>
<div class="content">
    <div class="hero">
    </div>
    <div class="message">
    </div>
    <div class="intro">
        <h1 style="background-image: url(<?php echo get_the_post_thumbnail_url();?>)"><?php the_title();?></h1>
        <div class="post-content page-content">
            <?php echo $intro; ?>
        </div>
    </div>
    <div class="activists">
        <h2>Four activists</h2>
        <ul class="activist-list">
        <?php foreach ($activists as $id): $url = get_the_permalink($id); ?>
            <li class="activist-item">
                <a href="<?php echo $url;?>"
                    class="thumb-link"><?php echo get_the_post_thumbnail($id, 'activist-thumbnail');?></a>
                <h3><a href="<?php echo $url;?>"><?php echo get_the_title($id);?></a></h3>
                <p><?php echo get_excerpt_by_id($id);?></p>
            </li>
        <?php endforeach; ?>
        </ul>
    </div>
    <div class="voices">
        <h2>Other voices</h2>
        <div class="gradient"></div>
        <p>
            Hear the thoughts of people affected by the action:
        </p>
        <p>
        <?php foreach ($voices as $id): $url = get_the_permalink($id); ?>
            <?php echo get_the_title($id);?><br>
        <?php endforeach; ?>
        </p>
        <p class="cta">
            <a href="<?php echo get_post_type_archive_link('voice');?>">Hear their voices</a>
        </p>
    </div>
    <div class="events">
        <h2>Public screenings</h2>
        <p>
            There are public screenings happening all over the place.<br>
            Find one close to your or organize your own.
        </p>
        <div id="map">
        </div>

        <a href="/events" class="cta">View list of events</a>
        <a href="<?php echo $add_event_url;?>" class="cta">Add a screening event</a>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNTh_Ay85-bSJ5WO1v-Sknl7R_IEBMVx4&callback=initMap" async defer></script>
<?php get_footer();?>
