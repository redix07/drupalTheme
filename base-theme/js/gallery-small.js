var gridLayout = (function( $ ) {
  //'use strict';
  // FUNCTION - init
  var wall,
  init = function() {
	  	  wall = new freewall('.freewall-container');	
		  setTimeout(function() {
		  wallInit();
		}, 100);
  }, 
  
  // FUNCTION - hoverAction
  wallInit = function() {
	wall.reset({
		selector: '.grid-item',
		animate: true,
		cellW: 'auto',
		cellH: 226,
		gutterX: 6,
		gutterY: 6,
		onResize: function() {
			wall.refresh();
		}
	});
	wall.fitWidth();
	// for scroll bar appear;
	$(window).trigger("resize");
  }
  
  return {
    init: init, 
  };
}( jQuery ));



jQuery(document).ready(function() {
  gridLayout.init();
});