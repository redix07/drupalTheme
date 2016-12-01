var myCustomAction = (function( $ ) {
  //'use strict';
  var init 	= function() {
      //if ($('html').hasClass('desktop')) { //#extends-menu
      console.log(this);
      if ($('body').hasClass('sticky-header')) {
          $('.box-header-stickup').TMStickUp({})
      }
  }
  return {
    init: init
  };
}( jQuery ));

jQuery(document).ready(function() {
  myCustomAction.init();
});