(function ($) {
    Drupal.behaviors.polisjSelectDropdownAlter = {
        attach: function (context, settings) {
		    //'use strict';
            var setClickActionAlter = function (_myListMC,customForm) {
				var selectMC = $('select', $(_myListMC).parent().parent().parent());

				$('li a', _myListMC).click(function () {
					$('li a', _myListMC).removeClass('active');
					$(this).addClass('active');
                    $('option', selectMC).prop('selected', false)
                            .filter('[value="' + $(this).attr('val') + '"]')
                            .prop('selected', true);
                    $('.dropdown-toggle',customForm).html($(this).text() + '<span class="caret clearfix "></span>');
                });
                return false;
			}
			var selectOverrideBootstrap = function () {
				var customForm = $('#views-exposed-form-search-page');
                $('.custom-drop', customForm).each(function (index) {
                    setClickActionAlter($(this),customForm);
                });
            };
            selectOverrideBootstrap();
            return {
                selectOverrideBootstrap: selectOverrideBootstrap
            };
        }
    }
})(jQuery);