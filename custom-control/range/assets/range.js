wp.customize.controlConstructor['range'] = wp.customize.Control.extend({

	ready: function() {

		'use strict';

		var control = this,
			range,
			range_input,
			value,
			this_input,
			input_default,
			changeAction,
			easy_customizer_range_input_number_timeout;

		// Update the text value
		jQuery( 'input[type=range]' ).on( 'mousedown', function() {

			range 			= jQuery( this );
			range_input 	= range.parent().children( '.range-input' );
			value 			= range.attr( 'value' );

			range_input.val( value );

			range.mousemove( function() {
				value = range.attr( 'value' );
				range_input.val( value );
			} );

		} );

		// Auto correct the number input
		function autocorrect_range_input_number( input_number, timeout ) {

			var range_input 	= input_number,
				range 			= range_input.parent().find( 'input[type="range"]' ),
				value 			= parseFloat( range_input.val() ),
				reset 			= parseFloat( range.attr( 'data-reset_value' ) ),
				step 			= parseFloat( range_input.attr( 'step' ) ),
				min 			= parseFloat( range_input.attr( 'min') ),
				max 			= parseFloat( range_input.attr( 'max') );

			clearTimeout( easy_customizer_range_input_number_timeout );

			easy_customizer_range_input_number_timeout = setTimeout( function() {

				if ( isNaN( value ) ) {
					range_input.val( reset );
					range.val( reset ).trigger( 'change' );
					return;
				}

				if ( step >= 1 && value % 1 !== 0 ) {
					value = Math.round( value );
					range_input.val( value );
					range.val( value );
				}

				if ( value > max ) {
					range_input.val( max );
					range.val( max ).trigger( 'change' );
				}

				if ( value < min ) {
					range_input.val( min );
					range.val( min ).trigger( 'change' );
				}

			}, timeout );

			range.val( value ).trigger( 'change' );

		}

		// Change the text value
		jQuery( 'input.range-input' ).on( 'change keyup', function() {

			autocorrect_range_input_number( jQuery( this ), 1000);

		} ).on( 'focusout', function() {

			autocorrect_range_input_number( jQuery( this ), 0);

		} );

		// Handle the reset button
		jQuery( '.reset-slider' ).on('click', function() {

			this_input 		= jQuery( this ).closest( 'label' ).find( 'input' );
			input_default 	= this_input.data( 'reset_value' );

			this_input.val( input_default );
			this_input.change();

		} );

		if ( 'postMessage' === control.setting.transport ) {
			changeAction = 'mousemove change';
		} else {
			changeAction = 'change';
		}

		// Change the value
		this.container.on( changeAction, 'input', function() {
			control.setting.set( jQuery( this ).val() );
		});
	}

});
