( function( blocks, element ) {
	var el = element.createElement,
		source = blocks.source;

	function SangarSlider( props ) {
		return el( 'div', { className: 'sslider-shortcode' }, '[sangar-slider id=' + props.slider + ']' );
	}

	blocks.registerBlockType( 'sslider/sangar', {
		title: 'Sangar Slider',

		icon: 'format-gallery',

		category: 'common',

		attributes: {
			slider: {
				type: 'string'
			}
		},

		edit: function( props ) {
			var slider = props.attributes.slider;
			var children = [];
			var options = [];

			function setSlider( event ) {
				var selected = event.target.querySelector( 'option:checked' );
				props.setAttributes( { slider: selected.value } );
				event.preventDefault();
			}

			if ( slider ) {
				children.push( SangarSlider( { slider: slider } ) );
			}

			options.push(
				el( 'option', null, '- Select your slider -' )
			);
			Object.keys(sangar.slider).forEach(function(key) {
				options.push(
					el( 'option', { value: key }, sangar.slider[key] )
				);
			});

			children.push(
				el( 'select', { className: 'sangar-select', value: slider, onChange: setSlider }, options )
			);

			return el( 'form', { className: 'sangar-preview', onSubmit: setSlider }, children );
		},

		save: function( props ) {
			if (typeof props.attributes.slider == 'undefined') {
				return;
			}
			return SangarSlider( { slider: props.attributes.slider } );
		}
	} );
} )(
	window.wp.blocks,
	window.wp.element
);
