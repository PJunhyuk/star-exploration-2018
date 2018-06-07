var VentcampVideoBackground;

;(function($){

    $(document).on('ready', function () {
        if ( window.ventcampThemeOptions ) {
            VentcampVideoBackground.init(ventcampThemeOptions);
        } else {
            VentcampVideoBackground.init();
        }
    });

    // Main theme functions start
    VentcampVideoBackground = {
        defaults: {
            log: false,
            mobileMenuMaxWidth: 768
        },

        mobileDevice: false,

        log: function (msg) {
            if ( this.options.log ) console.log('%Ventcamp Log: ' + msg, 'color: #fe4918');
        },

        // check if site is loaded from mobile device
        checkMobile: function () {
            if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || $(window).width() < this.options.mobileMenuMaxWidth ) {
                this.mobileDevice = true;

                this.log('Mobile device');
            } else {
                this.mobileDevice = false;

                this.log('Desktop')
            }

            return this.mobileDevice;
        },

        videoBackgroundInit: function () {
            var _this = this,
                height = window.innerHeight - $('.menu-wrapper').outerHeight();

            $('.ytpb-row').each( function() {
                var $div = $(this),
                    paddingTop = parseInt($div.css('padding-top')),
                    paddingBottom = parseInt($div.css('padding-bottom')),
                    videoUrl = $div.data('videoUrl'),
                    vid,
                    $player,
                    controlsTemplate;

                if ( !(videoUrl && this.id) ) {
                    console.log('no video url!');
                    return false;
                }

                $div.css('min-height', $div.outerHeight());
                $div.children().not('.row-overlay').first().css({ 'padding-top': paddingTop, 'padding-bottom': paddingBottom });
                $div.style('padding-top', '0', 'important');
                $div.style('padding-bottom', '0', 'important');

                /(?:youtu\.be\/|youtube\.com\/(?:watch\?(?:.*&)?v=|(?:embed|v)\/))([^\?&"'>]+)/.test(videoUrl);

                vid = RegExp.$1;

                if ( vid ) {
                    $div.css({
                        'background-image': 'url("https://img.youtube.com/vi/' + vid + '/maxresdefault.jpg")',
                        'background-size': 'cover',
                        '-webkit-background-size': 'cover'
                    });
                }

                if ( !_this.checkMobile() ) {
                    $player = $div.YTPlayer();

                    if ( $div.attr('data-controls') != 'none' ) {
                        controlsTemplate = '<div class="video-controls"><i class="yt-play-btn-big"' + ( ( $div.attr('data-autoplay') == 'true' ) ? ' style="display: none"' : '' ) + '></i><div class="bottom"><div class="controls-container ' + $div.attr('data-controls') + '"><i class="yt-play-toggle' + ( ( $div.attr('data-autoplay') == 'false' ) ? ' active' : '' ) + '"></i><i class="yt-mute-toggle ' + ( ( $div.attr('data-mute') == 'true' ) ? ' active' : '' ) + '"></i><div class="yt-volume-slider"></div></div></div><div>'

                        $div.append(controlsTemplate);

                        var $playBtn = $div.find('.yt-play-btn-big'),
                            $playToggle = $div.find('.yt-play-toggle'),
                            $muteToggle = $div.find('.yt-mute-toggle'),
                            $volumeSlider = $div.find('.yt-volume-slider');

                        $volumeSlider.slider({
                            range: 'min',
                            min: 0,
                            max: 100,
                            step: 5,
                            value: 50,
                            slide: function ( event, ui ) {
                                $player.YTPSetVolume(ui.value);
                            }
                        });

                        // Play video on click
                        $playBtn.on('click', function () {
                            $player.YTPPlay();
                        });

                        // When user clicks on the 'play' button
                        $playToggle.click(function() {
                            // If video is playing
                            if ( $player.YTPGetPlayer().getPlayerState() === 1 ) {
                                $player.YTPPause();
                            } else {
                                $player.YTPPlay();
                            }
                        });

                        // Hide play button on play
                        $player.on("YTPPlay", function (e) {
                            $playBtn.fadeOut(200);
                            // Change icon to pause
                            $playToggle.removeClass('active');
                        });

                        // Show play button on pause
                        $player.on("YTPPause", function (e) {
                            $playBtn.fadeIn(200);
                            // Change icon to play
                            $playToggle.addClass('active');
                        });

                        $muteToggle.on('click', function () {
                            if ( $(this).is('.active') ) {
                                $muteToggle.removeClass('active');
                            } else {
                                $muteToggle.addClass('active');
                            }

                            $player.YTPToggleVolume();
                        });
                    }

                } else {
                    $div.css('min-height', height).addClass('no-video-bg');
                }
            });

            this.log( 'Init row video background');
        },

        init: function (options) {
            this.options = $.extend(this.defaults, options, $('body').data());

            this.log('Init');

            this.checkMobile();
            this.videoBackgroundInit();

            // Refresh window height block
            Ventcamp.windowHeightBlock();
        }
    };

})( jQuery );
