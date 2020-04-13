( function( api ) {

	// Extends our custom "vw-blog-magazine" section.
	api.sectionConstructor['vw-blog-magazine'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );