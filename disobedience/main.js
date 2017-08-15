(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";

var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

var player;

$(document).ready(function() {
    $('.home .teaser .teaser-cta a').click(function() {
        var teaser = $('.home .teaser');

        if (player) {
            player.playVideo();
        }
        else {
            var container = $(document.createElement('div'));
            container.attr('id', 'player-container');
            teaser.append(container);

            player = new YT.Player('player-container', {
                width: teaser.width(),
                height: teaser.height(),
                videoId: 'vCOZNhIIor8',
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });

            function onPlayerReady(ev) {
              ev.target.playVideo();
            }

            var done = false;
            function onPlayerStateChange(ev) {
                if (ev.data == 0) {
                    teaser.removeClass('playing');
                }
            }
        }

        teaser.addClass('playing');

        return false;
    });

    $('.flash').each(function() {
        var elem = $(this);
        var overlay = $(document.createElement('div'));
        var grad = $(document.createElement('grad'));

        overlay.addClass('overlay');
        grad.addClass('gradient');
        elem.addClass('flashing');
        elem.append(overlay);
        overlay.append(grad);

        var flashCount = 5 + Math.ceil(Math.random() * 5);

        var nextFlash = function() {
            flashCount--;

            if (flashCount > 0) {
                var nextDelay = 60 + Math.random() * 200;
                var gradOffset = Math.round(Math.random() * 4000);

                overlay.toggle();
                grad.css({ 'left': - gradOffset + 'px' });

                setTimeout(nextFlash, nextDelay);
            }
            else {
                overlay.remove();
                elem.removeClass('flashing');
            }
        }

        nextFlash();
    });
});

function initMarker(ev, map, bounds, icons) {
    var pos = new google.maps.LatLng(ev.lat, ev.lng);

    bounds.extend(pos);

    var image = {
        url: icons[0],
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

window.initEventMap = function(domElement, events, icons) {
    // Create a map object and specify the DOM element for display.
    var map = new google.maps.Map(domElement, {
        center: {lat: -34.397, lng: 150.644},
        scrollwheel: false,
        mapTypeControl: false,
        zoom: 8,
        styles: [{"elementType":"geometry","stylers":[{"color":"#f5f5f5"}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#f5f5f5"}]},{"featureType":"administrative.country","elementType":"geometry.fill","stylers":[{"color":"#000000"}]},{"featureType":"administrative.country","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.fill","stylers":[{"color":"#bdbdbd"},{"visibility":"on"},{"weight":8}]},{"featureType":"administrative.locality","elementType":"labels.text.fill","stylers":[{"color":"#282828"},{"weight":8}]},{"featureType":"administrative.locality","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"administrative.neighborhood","elementType":"labels.text","stylers":[{"color":"#bdbdbd"},{"weight":8}]},{"featureType":"administrative.province","elementType":"labels.text.fill","stylers":[{"color":"#000000"}]},{"featureType":"administrative.province","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ff248a"}]},{"featureType":"landscape.man_made","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"landscape.man_made","elementType":"labels.text.fill","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"color":"#fe6037"}]},{"featureType":"landscape.natural.landcover","elementType":"geometry.fill","stylers":[{"color":"#ff4856"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry.fill","stylers":[{"color":"#ff28a3"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#eeeeee"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#e5e5e5"}]},{"featureType":"poi.park","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"poi.place_of_worship","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#dadada"}]},{"featureType":"road.highway","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"featureType":"road.local","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"color":"#e5e5e5"}]},{"featureType":"transit.station","elementType":"geometry","stylers":[{"color":"#eeeeee"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#c9c9c9"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]}],
    });

    var bounds = new google.maps.LatLngBounds();

    for (var i = 0; i < events.length; i++) {
        initMarker(events[i], map, bounds, icons);
    }

    map.fitBounds(bounds);
}

},{}]},{},[1]);
