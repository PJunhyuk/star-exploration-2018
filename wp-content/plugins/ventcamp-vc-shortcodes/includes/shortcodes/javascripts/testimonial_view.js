(function($) {
    /**
     * Custom backend view for displaying testimonial values
     */
    window.VcTestimonialView = vc.shortcode_view.extend( {
        elementTemplate: false,
        $wrapper: false,
        changeShortcodeParams: function ( model ) {
            var params;

            window.VcTestimonialView.__super__.changeShortcodeParams.call( this, model );
            params = _.extend( {}, model.get( 'params' ) );
            // Assign backbone template
            if ( ! this.elementTemplate ) {
                this.elementTemplate = this.$el.find( '.vc_testimonial-element-container' ).html();
            }
            // Get parent container
            if ( ! this.$wrapper ) {
                this.$wrapper = this.$el.find( '.wpb_element_wrapper' );
            }
            // Update template values
            if ( _.isObject( params ) ) {
                var template = vc.template( this.elementTemplate, vc.templateOptions.custom );
                this.$wrapper.find( '.vc_testimonial-element-container' ).html( template( { params: params } ) );
            }
        }
    } );
})(window.jQuery);