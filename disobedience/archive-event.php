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
                <th>City</th>
                <th>Date</th>
                <th>Start time</th>
                <th>Event title and organizers</th>
            </tr>
        </thead>
        <tbody>
    <?
        while (have_posts()):
            the_post();
        ?>
        <tr class="events-row">
            <td><?php the_field('city')?>, <?php the_field('country');?></td>
            <td><?php the_field('date'); ?></td>
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
        // Create a map object and specify the DOM element for display.
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            scrollwheel: false,
            zoom: 8,
            styles: [{"elementType":"geometry","stylers":[{"color":"#f5f5f5"}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#f5f5f5"}]},{"featureType":"administrative.country","elementType":"geometry.fill","stylers":[{"color":"#000000"}]},{"featureType":"administrative.country","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.fill","stylers":[{"color":"#bdbdbd"},{"visibility":"on"},{"weight":8}]},{"featureType":"administrative.locality","elementType":"labels.text.fill","stylers":[{"color":"#282828"},{"weight":8}]},{"featureType":"administrative.locality","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"administrative.neighborhood","elementType":"labels.text","stylers":[{"color":"#bdbdbd"},{"weight":8}]},{"featureType":"administrative.province","elementType":"labels.text.fill","stylers":[{"color":"#000000"}]},{"featureType":"administrative.province","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ff3897"}]},{"featureType":"landscape.man_made","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"landscape.man_made","elementType":"labels.text.fill","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"color":"#ff4059"}]},{"featureType":"landscape.natural.landcover","elementType":"geometry.fill","stylers":[{"color":"#ff4856"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry.fill","stylers":[{"color":"#ff48bf"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#eeeeee"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#e5e5e5"}]},{"featureType":"poi.park","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"poi.place_of_worship","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#dadada"}]},{"featureType":"road.highway","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"featureType":"road.local","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"color":"#e5e5e5"}]},{"featureType":"transit.station","elementType":"geometry","stylers":[{"color":"#eeeeee"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#c9c9c9"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]}],
        });

        var bounds = new google.maps.LatLngBounds();

        for (var i = 0; i < events.length; i++) {
            var ev = events[i];
            var pos = new google.maps.LatLng(ev.lat, ev.lng);

            bounds.extend(pos);

            var image = {
                url: '<?php echo get_template_directory_uri();?>/images/marker-green.png',
                size: new google.maps.Size(64, 90),
                scaledSize: new google.maps.Size(32, 45),
                origin: new google.maps.Point(0,0),
                anchor: new google.maps.Point(16, 44),
            };

            var marker = new google.maps.Marker({
                position: pos,
                map: map,
                icon: image,
                title: ev.title,
            });

            marker.addListener('click', function() {
                window.location = ev.link;
            });
        }

        map.fitBounds(bounds);
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNTh_Ay85-bSJ5WO1v-Sknl7R_IEBMVx4&callback=initMap" async defer></script>
<?php get_footer();
