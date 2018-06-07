(function ( $ ) {
    var Shortcodes = vc.shortcodes;

    window.VentCampButton = vc.shortcode_view.extend( {
        buttonTemplate: false,
        $wrapper: false,
        events: function () {
            return _.extend( {
                'click .ventcamp_button': 'buttonClick'
            }, window.VcToggleView.__super__.events );
        },
        buttonClick: function ( e ) {
            e.preventDefault();
        },
        changeShortcodeParams: function ( model ) {
            var params;

            params = _.extend( {}, model.get( 'params' ) );

            if ( ! this.$wrapper ) {
                this.$wrapper = this.$el.find( '.wpb_element_wrapper' );
            }
            if ( _.isObject( params ) ) {
                if ( params.title && _.isEmpty( params.title.trim() ) ) {
                    params.title = '<span>&nbsp;</span>';
                }


                $element = $("<a class='ventcamp_button ventcamp_button-" + params.style + " ventcamp_button-" + params.size + "'>"+ params.title +"</a>");

                if ( 'default' === params.style || 'alt' === params.style ) {

                } else if ( 'custom' === params.style ) {
                    $element
                        .css( {
                            'background-color': params.custom_background,
                            'border-color': params.custom_border_color,
                            'border-width' : params.custom_border_width,
                            'border-radius' : params.custom_border_radius,
                            'color': params.custom_text
                        } )
                        .hover(
                        function () {
                            $( this ).css( {
                                'background-color': params.custom_hover_background,
                                'border-color': params.custom_hover_border_color,
                                'border-width' : params.custom_hover_border_width,
                                'border-radius' : params.custom_hover_border_radius,
                                'color': params.custom_hover_text
                            } );
                        }, function () {
                            $( this ).css( {
                                'background-color': params.custom_background,
                                'border-color': params.custom_border_color,
                                'border-width' : params.custom_border_width,
                                'border-radius' : params.custom_border_radius,
                                'color': params.custom_text
                            } );
                        }
                    );
                }

                this.$wrapper.find( '.ventcamp_button-container' ).html( $element );
            }
        }
    } );

    // Speakers box
    window.VCTemplateView = vc.shortcode_view.extend( {
        itemTemplate: false,
        $wrapper: false,
        // events: function () {
        //  return _.extend( {
        //      'click .ventcamp_button': 'buttonClick'
        //  }, window.VcToggleView.__super__.events );
        // },
        changeShortcodeParams: function ( model ) {
            var params;

            window.VCTemplateView.__super__.changeShortcodeParams.call(this, model);
            params = _.extend( {}, model.get( 'params' ) );

            if ( ! this.$wrapper ) {
                this.$wrapper = this.$el.find( '.wpb_element_wrapper' );
            }
            if ( ! this.itemTemplate) {
                this.itemTemplate = this.$wrapper.html();
            }
            if ( _.isObject( params ) ) {
                $element = _.template( this.itemTemplate, { params: params }, vc.templateOptions.custom );

                this.$wrapper.html( $element );
            }
        }
    } );

    // Vivaco Row Design Helpers in Backend Editor
    if ( window.VcRowView ) {
        window.VcRowView.prototype.buildDesignHelpers = function () {
            var model = this.model,
                imgId = model.getParam('vsc_bg_image'),
                color = model.getParam('vsc_bg_color'),
                video = model.getParam('vsc_youtube_url'),
                rowId = model.getParam('vsc_id');

            var $elem = this.$el,
                $controls = $elem.find('> .vc_controls'),
                $columnToggle = $controls.find('.column_toggle');

            if ( imgId ) {
                data = {
                    action: 'wpb_single_image_src',
                    content: imgId,
                    size: 'thumbnail',
                    _vcnonce: window.vcAdminNonce
                }

                function getImgSrcDoneHandler (url) {
                    if ( url ) {
                        elClass = ' class="vc_row_image"';
                        title = ' title="' + window.i18nLocale.row_background_image + '"';
                        style = ' style="background-image: url(' + url + ');"';

                        $controls.find('.vc_row_image').remove();
                        $('<span' + elClass + title + style + '></span>').insertAfter($columnToggle);
                    }
                };

                $.ajax({
                    type: 'POST',
                    url: window.ajaxurl,
                    dataType: 'html',
                    data: data
                }).done(getImgSrcDoneHandler);
            }

            if ( rowId ) {
                elClass = ' class="vc_row-hash-id"';
                rowId = rowId.replace(/\s/g, '');

                $controls.find('.vc_row-hash-id').remove();
                $('<span' + elClass + '>#' + rowId + '</span>').insertAfter($columnToggle);
            }

            if ( video ) {
                elClass = ' class="vc_row_video"';
                title = ' title="Row background video"';

                $controls.find('.vc_row_video').remove();
                $('<span' + elClass + title + '></span>').insertAfter($columnToggle);
            }

            if ( color ) {
                style = 'style="background-color: ' + color + '"'
                title = 'title="' + window.i18nLocale.row_background_color + '"'

                $controls.find('.vc_row_color').remove();
                $('<span class="vc_row_color" ' + style + ' ' + title + '></span>').insertAfter($columnToggle);
            }
        }
    }

})( window.jQuery );
