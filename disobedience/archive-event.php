<?php get_header(); ?>
<div class="events-map">
    <div id="map"></div>
</div>
<div class="content">
<?php
    if (have_posts()):?>
    <table class="events-table">
        <thead>
            <tr>
                <th><?php disobedience_pstr('events_archive_table_city');?></th>
                <th><?php disobedience_pstr('events_archive_table_date');?></th>
                <th><?php disobedience_pstr('events_archive_table_time');?></th>
                <th><?php disobedience_pstr('events_archive_table_title');?></th>
            </tr>
        </thead>
        <tbody>
    <?
        while (have_posts()):
            the_post();
        ?>
        <tr class="events-row">
            <td><?php the_field('city')?>, <?php the_field('country');?></td>
            <td><?php the_field('start_date'); ?></td>
            <td><?php the_field('start_time'); ?></td>
            <td>
                <a class="title" href="<?php the_permalink();?>"><?php the_title();?></a>
                <?php if (get_field('organizer')): ?>
                <span class="organizer"><?php the_field('organizer');?></span>
                <?php endif; ?>
            </td>
        </tr>
        <?php
        endwhile;
    endif;
?>
        </tbody>
    </table>
</div>
<script>
    var events = [
    <?php while (have_posts()): the_post();?>
    <?php if ($loc = get_field('location')):?>
        {
            link: '<?php the_permalink();?>',
            title: '<?php the_title();?>',
            lat: <?php echo $loc['lat'];?>,
            lng: <?php echo $loc['lng'];?>,
        },
    <?php endif;?>
    <?php endwhile;?>
    ];

    function initMap() {
        var icons = ['<?php echo get_template_directory_uri();?>/images/marker-green.png'];
        initEventMap(document.getElementById('map'), events, icons);
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNTh_Ay85-bSJ5WO1v-Sknl7R_IEBMVx4&callback=initMap" async defer></script>
<?php get_footer();
