/**
 * Our previewer script, sends 'previewer-is-ready' event to the customizer
 */

( function ( wp, $ ) {
    "use strict";

    // Exit if wp/wp.customize isn't initialized
    if ( !wp || !wp.customize ) {
        return;
    }

    var api = wp.customize, OldPreview;

    // Extend customizer with our custom previewer class
    api.ventcampCustomizerPreview = {
        /**
         * Init function
         */
        init: function () {
            // Store local 'this' for callback functions
            var self = this;

            /* When previewer initialized and active, the 'active' event will be triggered */
            this.preview.bind( 'active', function () {
                // Load webfont script and after it's loaded, send ready event
                self.invokeWebfontScript(function () {
                    // Send a 'previewer-is-ready' event to customizer
                    self.preview.send( 'previewer-is-ready', window.customizerCustomData );
                });
            } );
        },

        /**
         * Add Webfont loader script to the page
         */
        invokeWebfontScript: function (callback) {
            var webFont = document.createElement("script");
                webFont.type = "text/javascript";

            // Wait until webfont script is loaded
            if (webFont.readyState) {  // IE
                webFont.onreadystatechange = function() {
                    if (webFont.readyState == "loaded" ||
                        webFont.readyState == "complete") {
                        webFont.onreadystatechange = null;
                        callback();
                    }
                };
            } else {  // Other browsers
                webFont.onload = function() {
                    callback();
                };
            }

            var protocol = ('https:' == document.location.protocol ? 'https' : 'http');
            webFont.src  = protocol + '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';

            // Append webfont script to the page
            document.getElementsByTagName("head")[0].appendChild(webFont);
        },

        /**
         * Load font using WebFont library
         *
         * @param fontName Name of the font
         *
         * @returns {boolean}
         */
        loadFont: function (fontName) {
            // Don't load default system fonts
            if ( !fontName ||
                fontName == 'Roboto' ||
                fontName == 'Georgia,Times,"Times New Roman",serif' ||
                fontName == 'Helvetica,Arial,sans-serif' ||
                fontName == 'Monaco,"Lucida Sans Typewriter","Lucida Typewriter","Courier New",Courier,monospace' ) {
                return false;
            }

            // Load font
            WebFont.load({
                google: {
                    families: [ fontName ]
                }
            });
        }
    };

    /**
     * Get the instance of Preview and extend with our custom function
     */
    OldPreview = api.Preview;
    api.Preview = OldPreview.extend( {
        initialize: function ( params, options ) {
            // Save local function in our custom class
            api.ventcampCustomizerPreview.preview = this;

            // Call the initialize function
            OldPreview.prototype.initialize.call( this, params, options );
        }
    } );

    // Execute the init function when document is ready
    $( function () {
        // Initialize our Preview
        api.ventcampCustomizerPreview.init();
    } );

} )( window.wp, jQuery );