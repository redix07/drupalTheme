var owlLayout = (function ($) {
	//'use strict';
	// FUNCTION - init
	var wall,
	init = function () {
		$("#owl-container").owlCarousel({
			itemsDesktopSmall : [980,4],
			itemsTablet: [768,3],
			itemsMobile : [429,1],

			// Navigation
			navigation : true,
			navigationText : ["prev","next"],
			rewindNav : true,
			scrollPerPage : false,

			//Pagination
			pagination : true,
			paginationNumbers: false,

			// Responsive
			responsive: true,
			responsiveRefreshRate : 200,
			responsiveBaseWidth: window
		})
	}

	return {
		init: init
	};
}(jQuery));


jQuery(document).ready(function () {
	owlLayout.init();
});
