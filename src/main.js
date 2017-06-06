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
