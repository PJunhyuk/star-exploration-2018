/**
 * JS script for Ventcamp Demo Importer
 */

"use strict";

/**
 * Importer class
 */
var Importer = {

    /**
     * Importer Constructor
     */
    init: function (config) {
        // Only if importer is defined
        if (document.importer !== undefined) {
            // Get all content selection radio buttons
            this.content_radio = document.importer.content_type;
            // Set reset and import buttons
            this.import = document.importer.import;
            this.reset = document.importer.reset;
            // Default style and don't import options
            this.no_style = document.getElementById("no_style");
            this.default_style = document.getElementById("default");

            // Attach on click events on buttons
            this.import.onclick = this.showMessageOnButtonClick;
            this.reset.onclick = this.showMessageOnButtonClick;

            // Attach on click event
            this.onContentTypeChange();
        }
    },

    /**
     * When user chooses all content to import, then select default style.
     * Otherwise select "don't import style" option.
     */
    onContentTypeChange: function () {
        // Save context
        var self = this;

        // Loop throught the all radio buttons
        for (var i = 0; i < this.content_radio.length; i++) {
            // When user select a new content type
            this.content_radio[i].onclick = function () {
                // Check if user selected not the all content
                if (this.value !== 'all_content') {
                    // Select "don't import style" option
                    self.no_style.checked = true;
                } else {
                    // Select default style
                    self.default_style.checked = true;
                }
            };
        }
    },

    /**
     * On button click event handler. Shows a confirm alert.
     *
     * @param event The event object
     * @returns {boolean} True if user confirmed action and false otherwise
     */
    showMessageOnButtonClick: function (event) {
        // Alert message
        var message;
        // Get the name of the button
        var name = event.target.name;

        // Check the name of the button
        if (name === 'reset') {
            // Set import message
            message = "WARNING!\r\nThis will erase ALL your wordpress content (except plugins) and reset it to " +
                "default clean state. \r\nDo not login in any popups until page finishes loading COMPLETELY\r\n" +
                "Are you sure to continue?";

        } else if (name === 'import') {
            // Set reset message
            message = "Please leave the browser open and wait until the page loading finishes completely " +
                "(can take up to several minutes)!";
        } else {
            console.error("Unknown button name, no action has been taken");
            return false;
        }

        // Check if user clicked okay or cancel
        if (confirm(message)) {
            return true;
        } else {
            // Prevent importer from submitting form data
            event.preventDefault();
            event.stopPropagation();
            return false;
        }
    }
};

// Init our class
Importer.init();