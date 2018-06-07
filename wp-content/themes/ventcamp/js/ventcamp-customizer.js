/**
 * Communicator with customizer
 */

( function( $ ) {
    $(document).on('ready', function() {
        /*
           Init responsive view buttons
        */
        var mode = undefined;
        var fromBack = false;
        var $customizePreviewContainer = $('#customize-preview');

        $('#accordion-section-mobile_tablet').click(function(event) {
            if (!fromBack) {
                mode = 'tablet';
                $customizePreviewContainer.addClass('vc-mobile-preview vc-tablet-preview');
            } else {
                fromBack = false;
            }
        });

        $('#accordion-section-mobile_phone').click(function(event) {
            if (!fromBack) {
                mode = 'phone';
                $customizePreviewContainer.addClass('vc-mobile-preview vc-phone-preview');
            } else {
                fromBack = false;
            }
        });

        $('#accordion-section-mobile_menu').click(function(event) {
            if (!fromBack){
                mode = 'mobile-menu';
                $customizePreviewContainer.addClass('vc-mobile-preview vc-mobile-menu-preview');
            } else {
                fromBack = false;
            }
        });

        $('button.customize-section-back').click(function(event) {
            if (mode) {
                $customizePreviewContainer.removeClass('vc-mobile-preview');
                $customizePreviewContainer.removeClass('vc-' + mode + '-preview');
                mode = undefined;
                fromBack = true;
            }
        });
    });
})(jQuery);


( function ( exports, $ ) {
    "use strict";

    /**
     * Add reset button to customizer, so that users can go back to default options
     */
    function addResetButton () {
        var $customizerHeaderActions = $('#customize-header-actions'),
            $resetButton = $('<input type="submit" name="ventcamp-reset" id="ventcamp-reset" class="button-secondary button">')
                .attr('value', _VCCustomizer.reset);

        $resetButton.on('click', function (event) {
            event.preventDefault();

            var data = {
                wp_customize: 'on',
                action: 'customizer_reset',
                nonce: _VCCustomizer.nonce.reset
            };

            var r = confirm(_VCCustomizer.confirm);

            if (!r) return;

            $resetButton.attr('disabled', 'disabled');

            $.post(ajaxurl, data, function () {
                // Save settings
                wp.customize.previewer.save();
                location.reload();
            });
        });

        $customizerHeaderActions.append($resetButton);
    }

    var api = wp.customize, OldPreviewer;

    // Extend customizer with our custom previewer class
    api.ventcampCustomizer = {
        customizerSettings: {}, // An array with customizer settings
        lessVariables: {},      // An array with updated less variables
        modifiedVariables: {},  // An array with new modifications
        less: {},               // Pointer to the less functions
        initialized: false,     // If previewer is loader or not
        fontChanged: false,     // If font changed, need to load it using WebFont library
        customFonts: {},        // A list of custom fonts on the page

        /**
         * Constructor of custom Ventcamp Customizer class
         *
         * @constructor
         */
        init: function () {
            // Store local 'this' for callback functions
            var self = this;

            // Listen to 'previewer-is-ready' event
            this.preview.bind( 'previewer-is-ready', function (data) {
                /*
                 Update the link to less object from previewer.
                 Customizer depends on less.js library, so
                 need to prepare it before using customizer
                 */
                self.less = window.frames[0].window.less;

                // Initialize only once
                if ( !self.initialized ) {
                    self.updateLessSettings();

                    // Class is initialized
                    self.initialized = true;
                } else {
                    // Reload all the fonts
                    self.reloadFonts();
                }

                // Re-compile stylesheet
                self.refreshStyles( self.lessVariables );
            } );
        },

        /**
         * Loop through the all settings, select ventcamp settings
         * and turn them into less variables so that they
         */
        updateLessSettings: function () {
            // Store local 'this' for each loop
            var self = this;

            // Get all customizer settings
            this.customizerSettings = api.settings.settings;

            // Loop through the all settings
            $.each(this.customizerSettings, function(setting) {
                // Select only ventcamp settings
                if ( this.transport == 'postMessage' && /ventcamp_customizer/.test(setting) ) {
                    // Depending on the type, update setting
                    self.updateSetting( setting, this.value, self.lessVariables );

                    // Update the settings in real time
                    api( setting, function( value ) {
                        // Bind variable so that if user type a new value, variable will be updated automatically
                        value.bind( function( newval ) {
                            // Update only those variables, which are needed to be updated
                            self.updateSetting( setting, newval, self.modifiedVariables );
                            self.refreshStyles( self.modifiedVariables );
                        });
                    });
                }
            });
        },

        /**
         * Turn customizer setting into less variable, so it can be compiled later
         *
         * @param setting Name of the setting
         * @param value Value
         * @param variablesArray An array with variables to save the result
         *
         * @returns {boolean} False if one of the params isn't specified
         */
        updateSetting: function (setting, value, variablesArray) {
            // If name of the setting or value isn't specified, return false
            if ( !setting || !value ) {
                return false;
            }

            // Turn ventcamp customizer setting into less variable
            var param = this.parseParamName(setting);

            // Check if value it's an array with font styles
            if ( typeof value === 'object' ) {
                // We have an array
                this.parseArray(param, value);
            } else {
                // It's a single value (color or boolean or number)
                value = this.parseValue(value);
                // Add value to the array of less variables
                variablesArray[param] = value;
            }
        },

        /**
         * Parse param name and turn it into less variable
         *
         * @param name Name of the setting
         *
         * @return string Resulting less variable
         */
        parseParamName: function (name) {
            // Regexp to match ventcamp prefixed setting
            var regexp = /ventcamp_customizer\[([\w\d_-]+)]/i,
                param  = regexp.exec(name);

            // Return resulting less variable
            return '@' + param[1];
        },

        /**
         * Parse value and depending on the type of the value,
         * turn it into value for less variable
         *
         * @param value Value of the setting
         */
        parseValue: function (value) {
            // Determine the type of the variable
            if (value === true ) {
                // Boolean
                value = 1;
            } else if (value === false) {
                // Boolean
                value = 0;
            } else if ( /^#(?:[0-9a-fA-F]{3}){1,2}$/.test(value) ) {
                // It's a color, do nothing
            } else if ( parseInt(value) ) {
                // It's a number
                value = parseInt(value);
            }

            return value;
        },

        /**
         * Parse an array of variables and turn them into less variables
         *
         * @param param Name of the setting
         * @param array An array of variables
         */
        parseArray: function (param, array) {
            var self = this;

            // Loop through the all elements
            $.each(array, function(name, value) {
                // Replace dashes with underscores and add to the param name, result for example:
                // @logotype_typography_font_weight
                var fontParam = param + '_' + name.replace('-', '_');

                // Value is boolean for params like italic, uppercase, strikethrough etc.
                // convert true and false to 1 and 0
                if ( value === true ) {
                    value = 1;
                } else if ( value === false ) {
                    value = 0;
                } else if ( typeof value === 'object' ) {
                    // We have a nested array, return
                    return;
                }

                // Watch if the new font is different from current one
                self.watchFontUpdates(fontParam, name, value);
                // Update the value
                self.lessVariables[fontParam] = value;
            });

            // If font changed, it needs to be loaded using webfont library
            if ( this.fontChanged ) {
                this.loadFont(array['font-family']);
            }

            return true;
        },

        /**
         * Check if font-family or font-weight is changed and if so, set the flag
         *
         * @param setting Name of the setting
         * @param property Name of the property
         * @param newValue The new value to compare
         */
        watchFontUpdates: function (setting, property, newValue) {
            // Check only font-family property
            if ( property === 'font-family' ) {
                // Get the old value
                var oldValue = this.lessVariables[setting];

                // Check if the new font is set, then load this font
                if (oldValue && oldValue != newValue) {
                    // Need reload
                    this.fontChanged = true;
                    // Safe font to the list of custom fonts
                    this.customFonts[setting] = newValue;
                }
            }
        },

        /**
         * Compile less stylesheets
         *
         * @param lessVariables An array of less variables to apply
         */
        refreshStyles: function ( lessVariables ) {
            this.less.modifyVars( lessVariables );
            this.less.refreshStyles();
        },

        /**
         * If page was reloaded, need to reload all fonts as well
         */
        reloadFonts: function () {
            var self = this;

            // Loop through the all custom fonts
            $.each(this.customFonts, function(setting, value) {
                // Load these custom fonts
                self.loadFont(value);
            });
        },

        /**
         * Load font using WebFont library
         *
         * @param fontName Name of the font
         *
         * @returns {boolean}
         */
        loadFont: function (fontName) {
            // Link to our previewer class
            var previewer = window.frames[0].window.wp.customize.ventcampCustomizerPreview;

            previewer.loadFont(fontName);

            this.fontChanged = false;
        }
    };

    /**
     * Get the instance of Preview and extend with our custom function
     */
    OldPreviewer = api.Previewer;
    api.Previewer = OldPreviewer.extend( {
        initialize: function ( params, options ) {
            // Save local function in our custom class
            api.ventcampCustomizer.preview = this;

            // Call the initialize function
            OldPreviewer.prototype.initialize.call( this, params, options );
        }
    } );

    // Execute the init function when document is ready
    $( function () {
        // Add reset button to customizer, so that users can go back to default options
        addResetButton();

        // Initialize our Preview
        api.ventcampCustomizer.init();
    } );

} )( wp, jQuery );