( function( api ) {

	// Extends our custom "luxury-hotels" section.
	api.sectionConstructor['luxury-hotels'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );