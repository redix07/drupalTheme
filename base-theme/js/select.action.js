(function ($) {
    Drupal.behaviors.polisjSelectDropdown = {
        attach: function (context, settings) {
            //'use strict';
            var setClickAction = function (_myListMC,customForm) {
                var selectMC = $('select', $(_myListMC).parent().parent());
                // set active li > a item to selected option
                var aciveID  = $(selectMC).find(":selected").attr('value');
                $('li a', _myListMC).filter('[val="' + aciveID + '"]').parent().addClass('active');
                // add click event
                $('li a', _myListMC).click(function () {
                    $('li', _myListMC).removeClass('active');
                    $(this).parent().addClass('active');
                    $('option', selectMC).prop('selected', false)
                        .filter('[value="' + $(this).attr('val') + '"]')
                        .prop('selected', true);
                    $(selectMC).delay(100).change();
                    return false;
                });
            }
            var selectOverride = function () {
                var customForm = $('#views-exposed-form-user-pj-block');
                $('.custom-over-select', customForm).each(function (index) {
                    setClickAction($(this),customForm);
                });
            };
            selectOverride();
            return {
                selectOverride: selectOverride
            };
        }
    }
})(jQuery);