/**
 * KIRKI CONTROL: TYPOGRAPHY
 */
wp.customize.controlConstructor['typography'] = wp.customize.Control.extend( {
	ready: function() {
		var control = this;
		var compiled_value = {};

		window.control = this;

		// get initial values and pre-populate the object
		var getValues = function () {
			if ( control.container.has( '.uppercase' ).size() ) {
				if ( control.setting._value['uppercase'] ) compiled_value['uppercase'] = true;
				else compiled_value['uppercase'] = false;
			}

			if ( control.container.has( '.italic' ).size() ) {
				if ( control.setting._value['italic'] ) compiled_value['italic'] = true;
				else compiled_value['italic'] = false;
			}

			if ( control.container.has( '.underline' ).size() ) {
				if ( control.setting._value['underline'] ) compiled_value['underline'] = true;
				else compiled_value['underline'] = false;
			}

			if ( control.container.has( '.strikethrough' ).size() ) {
				if ( control.setting._value['strikethrough'] ) compiled_value['strikethrough'] = true;
				else compiled_value['strikethrough'] = false;
			}

			if ( control.container.has( '.font-family' ).size() ) {
				compiled_value['font-family']    = control.setting._value['font-family'] + '';
			}

			if ( control.container.has( '.font-size' ).size() ) {
				compiled_value['font-size']      = control.setting._value['font-size'] + '';
			}

			if ( control.container.has( '.font-weight' ).size() ) {
				compiled_value['font-weight']    = control.setting._value['font-weight'] + '';
			}

			if ( control.container.has( '.line-height' ).size() ) {
				compiled_value['line-height']    = control.setting._value['line-height'] + '';
			}

			if ( control.container.has( '.letter-spacing' ).size() ) {
				compiled_value['letter-spacing'] = control.setting._value['letter-spacing'] + '';
			}
		};

		getValues();

		// use selectize
		jQuery( '.customize-control-typography select' ).selectize();

		// bold
		if ( control.container.has( '.uppercase' ).size() ) {
			this.container.on( 'change', '.uppercase input', function() {
				var uppercase = false;

				if ( jQuery( this ).is( ':checked' ) ) uppercase = true;
				compiled_value = jQuery.extend({}, compiled_value, { 'uppercase': uppercase });
				control.setting.set( compiled_value );
				getValues();
			});
		}

		// italic
		if ( control.container.has( '.italic' ).size() ) {
			this.container.on( 'change', '.italic input', function() {
				var italic = false

				if ( jQuery( this ).is( ':checked' ) ) italic = true;
				compiled_value = jQuery.extend({}, compiled_value, { 'italic': italic });
				control.setting.set( compiled_value );
				getValues();
			});
		}

		// underline
		if ( control.container.has( '.underline' ).size() ) {
			this.container.on( 'change', '.underline input', function() {
				var underline = false

				if ( jQuery( this ).is( ':checked' ) ) underline = true;
				compiled_value = jQuery.extend({}, compiled_value, { 'underline': underline });
				control.setting.set( compiled_value );
				getValues();
			});
		}

		// strikethrough
		if ( control.container.has( '.strikethrough' ).size() ) {
			this.container.on( 'change', '.strikethrough input', function() {
				var strikethrough = false

				if ( jQuery( this ).is( ':checked' ) ) strikethrough = true;
				compiled_value = jQuery.extend({}, compiled_value, { 'strikethrough': strikethrough });
				control.setting.set( compiled_value );
				getValues();
			});
		}

		// font-family
		if ( control.container.has( '.font-family' ).size() ) {
			this.container.on( 'change', '.font-family select', function() {
				compiled_value = jQuery.extend({}, compiled_value, { 'font-family': jQuery( this ).val() });
				control.setting.set( compiled_value );
				getValues();
			});
		}

		// font-size
		if ( control.container.has( '.font-size' ).size() ) {
			this.container.on( 'change', '.font-size input', function() {
				var font_size_units_value   = control.container.find('.font-size select' ).val();

				compiled_value = jQuery.extend({}, compiled_value, { 'font-size': jQuery( this ).val() + font_size_units_value });
				control.setting.set( compiled_value );
				getValues();
			});

			this.container.on( 'change', '.font-size select', function() {
				var font_size_numeric_value = control.container.find('.font-size input[type=number]' ).val();

				compiled_value = jQuery.extend({}, compiled_value, { 'font-size': font_size_numeric_value + jQuery( this ).val() });
				control.setting.set( compiled_value );
				getValues();
			});
		}

		// font-weight
		if ( control.container.has( '.font-weight' ).size() ) {
			this.container.on( 'change', '.font-weight select', function() {
				compiled_value = jQuery.extend({}, compiled_value, { 'font-weight': jQuery( this ).val() });
				control.setting.set( compiled_value );
				getValues();
			});
		}

		// line-height
		if ( control.container.has( '.line-height' ).size() ) {
			this.container.on( 'change', '.line-height input', function() {
				compiled_value = jQuery.extend({}, compiled_value, { 'line-height': jQuery( this ).val() });
				control.setting.set( compiled_value );
				getValues();
			});
		}

		// letter-spacing
		if ( control.container.has( '.letter-spacing' ).size() ) {
			this.container.on( 'change', '.letter-spacing input', function() {
				var letter_spacing_units_value   = control.container.find('.letter-spacing select' ).val();

				compiled_value = jQuery.extend({}, compiled_value, { 'letter-spacing': jQuery( this ).val() + letter_spacing_units_value });
				control.setting.set( compiled_value );
				getValues();
			});
			this.container.on( 'change', '.letter-spacing select', function() {
				var letter_spacing_numeric_value = control.container.find('.letter-spacing input[type=number]' ).val();

				compiled_value = jQuery.extend({}, compiled_value, { 'letter-spacing': letter_spacing_numeric_value + jQuery( this ).val() });
				control.setting.set( compiled_value );
				getValues();
			});
		}
	}
});
