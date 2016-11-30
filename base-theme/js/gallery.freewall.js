var gridLayout = (function ($) {
	//'use strict';
	// FUNCTION - init
	var wall,
		init = function () {
			wall = new freewall('#freewall-container');
			setTimeout(function () {
				wallInit();
			}, 100);
		},

	// Init Wall
	wallInit = function () {
		wall.reset({
			selector: '.grid-item',
			animate: true,
			cellW: 280,
			cellH: 210,
			gutterX: 12,
			gutterY: 12,
			onResize: function () {
				wall.refresh();
			}
		});
		wall.fitWidth();
	},

	wallAddElements = function (MC) {
		wall.appendBlock(MC);
		setTimeout(function () {
			wall.refresh();
		}, 200);
	}

	return {
		init: init,
		wallAddElements:wallAddElements
	};
}(jQuery));


jQuery(document).ready(function () {
	gridLayout.init();
});
