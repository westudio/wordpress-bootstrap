(function ($) {

  var $window = $(window);
  var $body   = $(document.body);

  var $wrappers = $('.page-wrapper');
  var $tabs     = $('.nav-tabs-wrapper');

  $window.on('load', function () {

    $tabs.each(function () {
      var $nav = $(this);

      $(this).data('old', {
        top: $nav.offset().top,
        width: $nav.css('width') || $nav.width()
      });
    });

    $wrappers.inviewport({
      className: 'inviewport',
      top: function () {
        return $.viewport.offset.height;
      },
      bottom: function ($wrapper, offset, viewport) {
        var $nav = $wrapper.find('.nav-tabs-wrapper');

        if ($nav.length === 0) {
          return 0;
        }

        return viewport.height - $nav.height();
      }
    });

  });

  $body.on('shown.bs.tab', function (e) {
    $wrappers.inviewport('reset');
  });

  $wrappers.on('entering.viewport', function (e) {
    var $wrapper = $(this);
    var $nav     = $wrapper.find('.nav-tabs-wrapper');

    if ($nav.length === 0) {
      return;
    }

    $nav.css({
      left: $nav.offset().left,
      'margin-top': '',
      width: $nav.css('width') || $nav.outerWidth()
    });
  });

  $wrappers.on('leaving.viewport', function (e, wrapper, viewport) {
    var $wrapper = $(this);
    var $nav     = $wrapper.find('.nav-tabs-wrapper');

    if ($nav.length === 0) {
      return;
    }

    $nav.css({
      left: '',
      'margin-top': viewport.top <= wrapper.top ? 0 : ($nav.offset().top - $nav.data('old').top),
      width: $nav.data('old').width
    });
  });

})(jQuery);
