<?php get_header(); ?>
<div class="events-map flash">
    <div id="map"></div>
    <div class="legends">
        <div class="legend green">
            <?php disobedience_pstr('events_map_legend_green');?>
        </div>
        <div class="legend blue">
            <?php disobedience_pstr('events_map_legend_blue');?>
        </div>
        <div class="legend purple">
            <?php disobedience_pstr('events_map_legend_purple');?>
        </div>
    </div>
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
            <tr class="events-row<?php if (!disobedience_event_is_current()):?> past-event<?php endif;?>">
                <td class="location"><?php the_field('city')?>, <?php the_field('country');?></td>
                <td class="date"><?php the_field('start_date'); ?></td>
                <td class="time"><?php the_field('start_time'); ?></td>
                <td class="title">
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
            icon: '<?php echo disobedience_event_icon($event);?>',
        },
    <?php endif;?>
    <?php endwhile;?>
    ];

    function initMap() {
        initEventMap(document.getElementById('map'), events);
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNTh_Ay85-bSJ5WO1v-Sknl7R_IEBMVx4&callback=initMap" async defer></script>
<?php get_footer();
