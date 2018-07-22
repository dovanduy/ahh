/* global document */
/* global jQuery */

(function ($) {

    'use strict';

    $(document).ready(function() {
        $('.mace-video-playlist').each(function() {
            var $playlist = $(this);
            var $player   = $playlist.find('.mace-video-player');
            var $items    = $playlist.find('.mace-video-item');
            $($items[0]).addClass('mace-video-current');
            var player    = false;

            // Load player.
            $player.mediaelementplayer({
                success: function(mediaElement, originalNode, instance) {
                    player = instance;
                }
            });

            $items.on('click', function() {
                var $item = $(this);
                $items.removeClass('mace-video-current');
                $item.addClass('mace-video-current');
                var config = $item.data('mace-video-config');

                if (player) {
                    player.setSrc(config.url);
                    player.setPoster(config.poster);
                    player.setCurrentTime(0);

                    player.load();
                    player.play();
                }
            });
        });
    });

})(jQuery);

