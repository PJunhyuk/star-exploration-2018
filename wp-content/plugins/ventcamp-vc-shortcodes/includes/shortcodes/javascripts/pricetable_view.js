(function($) {
    /**
     * Custom backend view for displaying pricetable values
     */
    window.VcPricetableView = vc.shortcode_view.extend( {
        elementTemplate: false,
        $wrapper: false,
        changeShortcodeParams: function ( model ) {
            var params;

            window.VcPricetableView.__super__.changeShortcodeParams.call( this, model );
            params = _.extend( {}, model.get( 'params' ) );
            // Assign backbone template
            if ( ! this.elementTemplate ) {
                this.elementTemplate = this.$el.find( '.vc_pricetable-element-container' ).html();
            }
            // Get parent container
            if ( ! this.$wrapper ) {
                this.$wrapper = this.$el.find( '.wpb_element_wrapper' );
            }
            // Update template values
            if ( _.isObject( params ) ) {
                var template = vc.template( this.elementTemplate, vc.templateOptions.custom );
                this.$wrapper.find( '.vc_pricetable-element-container' ).html( template( { params: params } ) );
            }
        }
    } );
})(window.jQuery);