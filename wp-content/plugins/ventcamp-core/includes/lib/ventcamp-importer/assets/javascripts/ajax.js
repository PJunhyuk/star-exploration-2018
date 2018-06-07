/*
 * AJAX functionality for dome importer.
 */

( function( $, plugin ) {
    "use strict";

    /**
     * Class for handling ajax requests/responses
     */
    var AjaxifiedImporter = {

        /**
         * AjaxifiedImporter Constructor
         *
         * @param config Parameters, such as ajax nonce, action and so on
         */
        init: function( config ) {
            // Set form
            this.demoform = $(".ventcamp-import");
            // Set and compile template
            this.template = Handlebars.compile( $('#template').html() );
            // Set container
            this.container = $('.statuses');
            // Set buttons
            this.import_btn = this.demoform.find("button[name='import']");
            // Is it initial run?
            this.initial = true;

            // Get a new data and add to the alert div
            this.data = {
                action      : config.action,
                _ajax_nonce : config._ajax_nonce
            };

            // Attach on click events to import button
            this.bindImportAction();
        },

        /**
         * Don't load the page; Send an ajax post request with specified action instead.
         */
        bindImportAction: function () {
            // Save context
            var self = this;

            // A function to be executed on click
            Importer.import.onclick = function (event) {
                // Check if user clicked okay
                if ( Importer.showMessageOnButtonClick( event ) ) {
                    // Don't load the page, use ajax request instead
                    event.preventDefault();

                    // Change button appearance
                    self.changeImportButtonState( 'importing' );

                    // Hide form intro text and show status table
                    $('#importer-intro').hide();
                    $('#importer-status').show();

                    // Serialize the data in the form
                    var serializedData = self.demoform.serialize();

                    // Parameters for ajax request
                    var action = {
                        action      : plugin.action,
                        _ajax_nonce : plugin._ajax_nonce,
                        // Pass the form data to the backend
                        formdata    : serializedData
                    };

                    // Send an ajax request to start import
                    jQuery.post( plugin.ajaxurl, action );

                    // Start ajax requests
                    self.ajaxPolling();
                }
            };
        },

        /**
         * Change the appearance of the button depending on current task
         *
         * @param state Name of state
         */
        changeImportButtonState: function ( state ) {
            // A shortcut for button
            var btn = this.import_btn;

            switch ( state ) {
                /*
                    Importer is working; disable button and add animation
                 */
                case 'importing' :
                    // Add importing class
                    btn.addClass( 'importing' )
                        // Disable button
                        .prop( "disabled", true )
                        // Change button text after post
                        .html( 'Importing<span>.</span><span>.</span><span>.</span>' );

                    break;

                /*
                    Importing is finished; enable button again and change text to "Finished!"
                 */
                case 'finished' :
                    // Enable button
                    btn.prop( "disabled", false )
                        // Set button text to 'Finished'
                        .text( 'Finished!' );

                    break;
            }
        },

        /**
         * Set an interval and make an ajax request every second
         */
        ajaxPolling: function() {
            var self = this;

            // Now start a get process to get the stats every 1 second
            this.pollInterval = window.setInterval( function () {
                jQuery.post( plugin.ajaxurl, self.data, function( response ) {
                    // Check if data property is defined
                    if ( response.hasOwnProperty('data') ) {
                        self.processDataStatus( response.data );
                    } else {
                        // Something goes wrong, exit now
                        console.log( 'Something goes wrong, no data in response: ' + response );
                    }
                } );
            }, 1000);
        },

        /**
         * Attach results to handlebars template
         */
        render: function( context ) {
            // Apply context
            var html = this.template({
                statuses: context.statuses
            });
            // Apply compiled html to container
            this.container.html( html );
        },

        /**
         * Depending on current state, call appropriate function
         */
        processDataStatus: function ( data ) {
            if ( data.hasOwnProperty('current') ) {
                // Check current status
                switch (data.current) {
                    // If current status is finished
                    case 'finished' :
                        // Update status table
                        this.render(data);
                        // Change appearance of the button
                        this.changeImportButtonState('finished');
                        // Post is complete so stop execution
                        window.clearInterval(this.pollInterval);
                        break;

                    // If is in initial or reset state
                    case 'reset' :
                    case 'initial' :
                        // Render only once
                        if (this.initial) {
                            this.render(data);
                        }
                        this.initial = false;
                        break;

                    // Working state
                    case 'working' :
                        this.render(data);
                        break;
                }
            } else {
                // Something goes wrong, exit now
                console.log( 'Something goes wrong, no current property in data: ' + data );
            }
        }
    };

    // Init our class
    AjaxifiedImporter.init( plugin );

} )( jQuery, ajaxifiedObject || {} );
