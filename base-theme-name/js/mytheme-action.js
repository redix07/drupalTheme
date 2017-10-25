(function ($) {
    Drupal.behaviors.myCustomAction = {
        attach: function (context, settings) {
            $('body', context).once('foo', function () {
                if ($('body').hasClass('sticky-header')) {
                    $('.box-header-stickup').TMStickUp({})
                }
            });
        }
    };
})(jQuery);