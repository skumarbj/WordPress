( function( api ) {

	// Extends our custom "vlogger-video-blog" section.
	api.sectionConstructor['vlogger-video-blog'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );