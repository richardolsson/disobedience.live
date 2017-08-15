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
    console.log(events);
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

},{}]},{},[1])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJzcmMvbWFpbi5qcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTtBQ0FBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSIsImZpbGUiOiJnZW5lcmF0ZWQuanMiLCJzb3VyY2VSb290IjoiIiwic291cmNlc0NvbnRlbnQiOlsiKGZ1bmN0aW9uIGUodCxuLHIpe2Z1bmN0aW9uIHMobyx1KXtpZighbltvXSl7aWYoIXRbb10pe3ZhciBhPXR5cGVvZiByZXF1aXJlPT1cImZ1bmN0aW9uXCImJnJlcXVpcmU7aWYoIXUmJmEpcmV0dXJuIGEobywhMCk7aWYoaSlyZXR1cm4gaShvLCEwKTt2YXIgZj1uZXcgRXJyb3IoXCJDYW5ub3QgZmluZCBtb2R1bGUgJ1wiK28rXCInXCIpO3Rocm93IGYuY29kZT1cIk1PRFVMRV9OT1RfRk9VTkRcIixmfXZhciBsPW5bb109e2V4cG9ydHM6e319O3Rbb11bMF0uY2FsbChsLmV4cG9ydHMsZnVuY3Rpb24oZSl7dmFyIG49dFtvXVsxXVtlXTtyZXR1cm4gcyhuP246ZSl9LGwsbC5leHBvcnRzLGUsdCxuLHIpfXJldHVybiBuW29dLmV4cG9ydHN9dmFyIGk9dHlwZW9mIHJlcXVpcmU9PVwiZnVuY3Rpb25cIiYmcmVxdWlyZTtmb3IodmFyIG89MDtvPHIubGVuZ3RoO28rKylzKHJbb10pO3JldHVybiBzfSkiLCJ2YXIgdGFnID0gZG9jdW1lbnQuY3JlYXRlRWxlbWVudCgnc2NyaXB0Jyk7XG50YWcuc3JjID0gXCJodHRwczovL3d3dy55b3V0dWJlLmNvbS9pZnJhbWVfYXBpXCI7XG5cbnZhciBmaXJzdFNjcmlwdFRhZyA9IGRvY3VtZW50LmdldEVsZW1lbnRzQnlUYWdOYW1lKCdzY3JpcHQnKVswXTtcbmZpcnN0U2NyaXB0VGFnLnBhcmVudE5vZGUuaW5zZXJ0QmVmb3JlKHRhZywgZmlyc3RTY3JpcHRUYWcpO1xuXG52YXIgcGxheWVyO1xuXG4kKGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbigpIHtcbiAgICAkKCcuaG9tZSAudGVhc2VyIC50ZWFzZXItY3RhIGEnKS5jbGljayhmdW5jdGlvbigpIHtcbiAgICAgICAgdmFyIHRlYXNlciA9ICQoJy5ob21lIC50ZWFzZXInKTtcblxuICAgICAgICBpZiAocGxheWVyKSB7XG4gICAgICAgICAgICBwbGF5ZXIucGxheVZpZGVvKCk7XG4gICAgICAgIH1cbiAgICAgICAgZWxzZSB7XG4gICAgICAgICAgICB2YXIgY29udGFpbmVyID0gJChkb2N1bWVudC5jcmVhdGVFbGVtZW50KCdkaXYnKSk7XG4gICAgICAgICAgICBjb250YWluZXIuYXR0cignaWQnLCAncGxheWVyLWNvbnRhaW5lcicpO1xuICAgICAgICAgICAgdGVhc2VyLmFwcGVuZChjb250YWluZXIpO1xuXG4gICAgICAgICAgICBwbGF5ZXIgPSBuZXcgWVQuUGxheWVyKCdwbGF5ZXItY29udGFpbmVyJywge1xuICAgICAgICAgICAgICAgIHdpZHRoOiB0ZWFzZXIud2lkdGgoKSxcbiAgICAgICAgICAgICAgICBoZWlnaHQ6IHRlYXNlci5oZWlnaHQoKSxcbiAgICAgICAgICAgICAgICB2aWRlb0lkOiAndkNPWk5oSUlvcjgnLFxuICAgICAgICAgICAgICAgIGV2ZW50czoge1xuICAgICAgICAgICAgICAgICAgICAnb25SZWFkeSc6IG9uUGxheWVyUmVhZHksXG4gICAgICAgICAgICAgICAgICAgICdvblN0YXRlQ2hhbmdlJzogb25QbGF5ZXJTdGF0ZUNoYW5nZVxuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0pO1xuXG4gICAgICAgICAgICBmdW5jdGlvbiBvblBsYXllclJlYWR5KGV2KSB7XG4gICAgICAgICAgICAgIGV2LnRhcmdldC5wbGF5VmlkZW8oKTtcbiAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgdmFyIGRvbmUgPSBmYWxzZTtcbiAgICAgICAgICAgIGZ1bmN0aW9uIG9uUGxheWVyU3RhdGVDaGFuZ2UoZXYpIHtcbiAgICAgICAgICAgICAgICBpZiAoZXYuZGF0YSA9PSAwKSB7XG4gICAgICAgICAgICAgICAgICAgIHRlYXNlci5yZW1vdmVDbGFzcygncGxheWluZycpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH1cbiAgICAgICAgfVxuXG4gICAgICAgIHRlYXNlci5hZGRDbGFzcygncGxheWluZycpO1xuXG4gICAgICAgIHJldHVybiBmYWxzZTtcbiAgICB9KTtcbn0pO1xuXG5mdW5jdGlvbiBpbml0TWFya2VyKGV2LCBtYXAsIGJvdW5kcywgaWNvbnMpIHtcbiAgICB2YXIgcG9zID0gbmV3IGdvb2dsZS5tYXBzLkxhdExuZyhldi5sYXQsIGV2LmxuZyk7XG5cbiAgICBib3VuZHMuZXh0ZW5kKHBvcyk7XG5cbiAgICB2YXIgaW1hZ2UgPSB7XG4gICAgICAgIHVybDogaWNvbnNbMF0sXG4gICAgICAgIHNpemU6IG5ldyBnb29nbGUubWFwcy5TaXplKDY0LCA5MCksXG4gICAgICAgIHNjYWxlZFNpemU6IG5ldyBnb29nbGUubWFwcy5TaXplKDMyLCA0NSksXG4gICAgICAgIG9yaWdpbjogbmV3IGdvb2dsZS5tYXBzLlBvaW50KDAsMCksXG4gICAgICAgIGFuY2hvcjogbmV3IGdvb2dsZS5tYXBzLlBvaW50KDE2LCA0NCksXG4gICAgfTtcblxuICAgIHZhciBtYXJrZXIgPSBuZXcgZ29vZ2xlLm1hcHMuTWFya2VyKHtcbiAgICAgICAgcG9zaXRpb246IHBvcyxcbiAgICAgICAgbWFwOiBtYXAsXG4gICAgICAgIGljb246IGltYWdlLFxuICAgICAgICB0aXRsZTogZXYudGl0bGUsXG4gICAgfSk7XG5cbiAgICBtYXJrZXIuYWRkTGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24oKSB7XG4gICAgICAgIHdpbmRvdy5sb2NhdGlvbiA9IGV2Lmxpbms7XG4gICAgfSk7XG59XG5cbndpbmRvdy5pbml0RXZlbnRNYXAgPSBmdW5jdGlvbihkb21FbGVtZW50LCBldmVudHMsIGljb25zKSB7XG4gICAgLy8gQ3JlYXRlIGEgbWFwIG9iamVjdCBhbmQgc3BlY2lmeSB0aGUgRE9NIGVsZW1lbnQgZm9yIGRpc3BsYXkuXG4gICAgY29uc29sZS5sb2coZXZlbnRzKTtcbiAgICB2YXIgbWFwID0gbmV3IGdvb2dsZS5tYXBzLk1hcChkb21FbGVtZW50LCB7XG4gICAgICAgIGNlbnRlcjoge2xhdDogLTM0LjM5NywgbG5nOiAxNTAuNjQ0fSxcbiAgICAgICAgc2Nyb2xsd2hlZWw6IGZhbHNlLFxuICAgICAgICBtYXBUeXBlQ29udHJvbDogZmFsc2UsXG4gICAgICAgIHpvb206IDgsXG4gICAgICAgIHN0eWxlczogW3tcImVsZW1lbnRUeXBlXCI6XCJnZW9tZXRyeVwiLFwic3R5bGVyc1wiOlt7XCJjb2xvclwiOlwiI2Y1ZjVmNVwifV19LHtcImVsZW1lbnRUeXBlXCI6XCJsYWJlbHMuaWNvblwiLFwic3R5bGVyc1wiOlt7XCJ2aXNpYmlsaXR5XCI6XCJvZmZcIn1dfSx7XCJlbGVtZW50VHlwZVwiOlwibGFiZWxzLnRleHQuZmlsbFwiLFwic3R5bGVyc1wiOlt7XCJjb2xvclwiOlwiIzYxNjE2MVwifV19LHtcImVsZW1lbnRUeXBlXCI6XCJsYWJlbHMudGV4dC5zdHJva2VcIixcInN0eWxlcnNcIjpbe1wiY29sb3JcIjpcIiNmNWY1ZjVcIn1dfSx7XCJmZWF0dXJlVHlwZVwiOlwiYWRtaW5pc3RyYXRpdmUuY291bnRyeVwiLFwiZWxlbWVudFR5cGVcIjpcImdlb21ldHJ5LmZpbGxcIixcInN0eWxlcnNcIjpbe1wiY29sb3JcIjpcIiMwMDAwMDBcIn1dfSx7XCJmZWF0dXJlVHlwZVwiOlwiYWRtaW5pc3RyYXRpdmUuY291bnRyeVwiLFwiZWxlbWVudFR5cGVcIjpcImxhYmVscy50ZXh0LnN0cm9rZVwiLFwic3R5bGVyc1wiOlt7XCJ2aXNpYmlsaXR5XCI6XCJvZmZcIn1dfSx7XCJmZWF0dXJlVHlwZVwiOlwiYWRtaW5pc3RyYXRpdmUubGFuZF9wYXJjZWxcIixcImVsZW1lbnRUeXBlXCI6XCJsYWJlbHMudGV4dFwiLFwic3R5bGVyc1wiOlt7XCJ2aXNpYmlsaXR5XCI6XCJvZmZcIn1dfSx7XCJmZWF0dXJlVHlwZVwiOlwiYWRtaW5pc3RyYXRpdmUubGFuZF9wYXJjZWxcIixcImVsZW1lbnRUeXBlXCI6XCJsYWJlbHMudGV4dC5maWxsXCIsXCJzdHlsZXJzXCI6W3tcImNvbG9yXCI6XCIjYmRiZGJkXCJ9LHtcInZpc2liaWxpdHlcIjpcIm9uXCJ9LHtcIndlaWdodFwiOjh9XX0se1wiZmVhdHVyZVR5cGVcIjpcImFkbWluaXN0cmF0aXZlLmxvY2FsaXR5XCIsXCJlbGVtZW50VHlwZVwiOlwibGFiZWxzLnRleHQuZmlsbFwiLFwic3R5bGVyc1wiOlt7XCJjb2xvclwiOlwiIzI4MjgyOFwifSx7XCJ3ZWlnaHRcIjo4fV19LHtcImZlYXR1cmVUeXBlXCI6XCJhZG1pbmlzdHJhdGl2ZS5sb2NhbGl0eVwiLFwiZWxlbWVudFR5cGVcIjpcImxhYmVscy50ZXh0LnN0cm9rZVwiLFwic3R5bGVyc1wiOlt7XCJ2aXNpYmlsaXR5XCI6XCJvZmZcIn1dfSx7XCJmZWF0dXJlVHlwZVwiOlwiYWRtaW5pc3RyYXRpdmUubmVpZ2hib3Job29kXCIsXCJlbGVtZW50VHlwZVwiOlwibGFiZWxzLnRleHRcIixcInN0eWxlcnNcIjpbe1wiY29sb3JcIjpcIiNiZGJkYmRcIn0se1wid2VpZ2h0XCI6OH1dfSx7XCJmZWF0dXJlVHlwZVwiOlwiYWRtaW5pc3RyYXRpdmUucHJvdmluY2VcIixcImVsZW1lbnRUeXBlXCI6XCJsYWJlbHMudGV4dC5maWxsXCIsXCJzdHlsZXJzXCI6W3tcImNvbG9yXCI6XCIjMDAwMDAwXCJ9XX0se1wiZmVhdHVyZVR5cGVcIjpcImFkbWluaXN0cmF0aXZlLnByb3ZpbmNlXCIsXCJlbGVtZW50VHlwZVwiOlwibGFiZWxzLnRleHQuc3Ryb2tlXCIsXCJzdHlsZXJzXCI6W3tcInZpc2liaWxpdHlcIjpcIm9mZlwifV19LHtcImZlYXR1cmVUeXBlXCI6XCJsYW5kc2NhcGUubWFuX21hZGVcIixcImVsZW1lbnRUeXBlXCI6XCJnZW9tZXRyeS5maWxsXCIsXCJzdHlsZXJzXCI6W3tcImNvbG9yXCI6XCIjZmYyNDhhXCJ9XX0se1wiZmVhdHVyZVR5cGVcIjpcImxhbmRzY2FwZS5tYW5fbWFkZVwiLFwiZWxlbWVudFR5cGVcIjpcImxhYmVscy50ZXh0XCIsXCJzdHlsZXJzXCI6W3tcInZpc2liaWxpdHlcIjpcIm9mZlwifV19LHtcImZlYXR1cmVUeXBlXCI6XCJsYW5kc2NhcGUubWFuX21hZGVcIixcImVsZW1lbnRUeXBlXCI6XCJsYWJlbHMudGV4dC5maWxsXCIsXCJzdHlsZXJzXCI6W3tcInZpc2liaWxpdHlcIjpcIm9mZlwifV19LHtcImZlYXR1cmVUeXBlXCI6XCJsYW5kc2NhcGUubmF0dXJhbFwiLFwiZWxlbWVudFR5cGVcIjpcImdlb21ldHJ5LmZpbGxcIixcInN0eWxlcnNcIjpbe1wiY29sb3JcIjpcIiNmZTYwMzdcIn1dfSx7XCJmZWF0dXJlVHlwZVwiOlwibGFuZHNjYXBlLm5hdHVyYWwubGFuZGNvdmVyXCIsXCJlbGVtZW50VHlwZVwiOlwiZ2VvbWV0cnkuZmlsbFwiLFwic3R5bGVyc1wiOlt7XCJjb2xvclwiOlwiI2ZmNDg1NlwifV19LHtcImZlYXR1cmVUeXBlXCI6XCJsYW5kc2NhcGUubmF0dXJhbC50ZXJyYWluXCIsXCJlbGVtZW50VHlwZVwiOlwiZ2VvbWV0cnkuZmlsbFwiLFwic3R5bGVyc1wiOlt7XCJjb2xvclwiOlwiI2ZmMjhhM1wifV19LHtcImZlYXR1cmVUeXBlXCI6XCJwb2lcIixcImVsZW1lbnRUeXBlXCI6XCJnZW9tZXRyeVwiLFwic3R5bGVyc1wiOlt7XCJjb2xvclwiOlwiI2VlZWVlZVwifV19LHtcImZlYXR1cmVUeXBlXCI6XCJwb2lcIixcImVsZW1lbnRUeXBlXCI6XCJsYWJlbHMudGV4dC5maWxsXCIsXCJzdHlsZXJzXCI6W3tcImNvbG9yXCI6XCIjNzU3NTc1XCJ9XX0se1wiZmVhdHVyZVR5cGVcIjpcInBvaS5wYXJrXCIsXCJlbGVtZW50VHlwZVwiOlwiZ2VvbWV0cnlcIixcInN0eWxlcnNcIjpbe1wiY29sb3JcIjpcIiNlNWU1ZTVcIn1dfSx7XCJmZWF0dXJlVHlwZVwiOlwicG9pLnBhcmtcIixcImVsZW1lbnRUeXBlXCI6XCJsYWJlbHMudGV4dFwiLFwic3R5bGVyc1wiOlt7XCJ2aXNpYmlsaXR5XCI6XCJvZmZcIn1dfSx7XCJmZWF0dXJlVHlwZVwiOlwicG9pLnBhcmtcIixcImVsZW1lbnRUeXBlXCI6XCJsYWJlbHMudGV4dC5maWxsXCIsXCJzdHlsZXJzXCI6W3tcImNvbG9yXCI6XCIjOWU5ZTllXCJ9XX0se1wiZmVhdHVyZVR5cGVcIjpcInBvaS5wbGFjZV9vZl93b3JzaGlwXCIsXCJlbGVtZW50VHlwZVwiOlwibGFiZWxzLnRleHRcIixcInN0eWxlcnNcIjpbe1widmlzaWJpbGl0eVwiOlwib2ZmXCJ9XX0se1wiZmVhdHVyZVR5cGVcIjpcInJvYWRcIixcImVsZW1lbnRUeXBlXCI6XCJnZW9tZXRyeVwiLFwic3R5bGVyc1wiOlt7XCJjb2xvclwiOlwiI2ZmZmZmZlwifV19LHtcImZlYXR1cmVUeXBlXCI6XCJyb2FkLmFydGVyaWFsXCIsXCJzdHlsZXJzXCI6W3tcInZpc2liaWxpdHlcIjpcIm9mZlwifV19LHtcImZlYXR1cmVUeXBlXCI6XCJyb2FkLmFydGVyaWFsXCIsXCJlbGVtZW50VHlwZVwiOlwibGFiZWxzLnRleHQuZmlsbFwiLFwic3R5bGVyc1wiOlt7XCJjb2xvclwiOlwiIzc1NzU3NVwifV19LHtcImZlYXR1cmVUeXBlXCI6XCJyb2FkLmhpZ2h3YXlcIixcImVsZW1lbnRUeXBlXCI6XCJnZW9tZXRyeVwiLFwic3R5bGVyc1wiOlt7XCJjb2xvclwiOlwiI2RhZGFkYVwifV19LHtcImZlYXR1cmVUeXBlXCI6XCJyb2FkLmhpZ2h3YXlcIixcImVsZW1lbnRUeXBlXCI6XCJsYWJlbHNcIixcInN0eWxlcnNcIjpbe1widmlzaWJpbGl0eVwiOlwib2ZmXCJ9XX0se1wiZmVhdHVyZVR5cGVcIjpcInJvYWQuaGlnaHdheVwiLFwiZWxlbWVudFR5cGVcIjpcImxhYmVscy50ZXh0LmZpbGxcIixcInN0eWxlcnNcIjpbe1wiY29sb3JcIjpcIiM2MTYxNjFcIn1dfSx7XCJmZWF0dXJlVHlwZVwiOlwicm9hZC5sb2NhbFwiLFwic3R5bGVyc1wiOlt7XCJ2aXNpYmlsaXR5XCI6XCJvZmZcIn1dfSx7XCJmZWF0dXJlVHlwZVwiOlwicm9hZC5sb2NhbFwiLFwiZWxlbWVudFR5cGVcIjpcImxhYmVscy50ZXh0LmZpbGxcIixcInN0eWxlcnNcIjpbe1wiY29sb3JcIjpcIiM5ZTllOWVcIn1dfSx7XCJmZWF0dXJlVHlwZVwiOlwidHJhbnNpdC5saW5lXCIsXCJlbGVtZW50VHlwZVwiOlwiZ2VvbWV0cnlcIixcInN0eWxlcnNcIjpbe1wiY29sb3JcIjpcIiNlNWU1ZTVcIn1dfSx7XCJmZWF0dXJlVHlwZVwiOlwidHJhbnNpdC5zdGF0aW9uXCIsXCJlbGVtZW50VHlwZVwiOlwiZ2VvbWV0cnlcIixcInN0eWxlcnNcIjpbe1wiY29sb3JcIjpcIiNlZWVlZWVcIn1dfSx7XCJmZWF0dXJlVHlwZVwiOlwid2F0ZXJcIixcImVsZW1lbnRUeXBlXCI6XCJnZW9tZXRyeVwiLFwic3R5bGVyc1wiOlt7XCJjb2xvclwiOlwiI2M5YzljOVwifV19LHtcImZlYXR1cmVUeXBlXCI6XCJ3YXRlclwiLFwiZWxlbWVudFR5cGVcIjpcImxhYmVscy50ZXh0LmZpbGxcIixcInN0eWxlcnNcIjpbe1wiY29sb3JcIjpcIiM5ZTllOWVcIn1dfV0sXG4gICAgfSk7XG5cbiAgICB2YXIgYm91bmRzID0gbmV3IGdvb2dsZS5tYXBzLkxhdExuZ0JvdW5kcygpO1xuXG4gICAgZm9yICh2YXIgaSA9IDA7IGkgPCBldmVudHMubGVuZ3RoOyBpKyspIHtcbiAgICAgICAgaW5pdE1hcmtlcihldmVudHNbaV0sIG1hcCwgYm91bmRzLCBpY29ucyk7XG4gICAgfVxuXG4gICAgbWFwLmZpdEJvdW5kcyhib3VuZHMpO1xufVxuIl19
