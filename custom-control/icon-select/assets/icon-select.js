wp.customize.controlConstructor[ 'icon' ] = wp.customize.Control.extend({

	ready: function() {

		'use strict';

		var control = this;

		this.container.on( 'change', 'input', function() {
			control.setting.set( jQuery( this ).val() );
		});

	}

});