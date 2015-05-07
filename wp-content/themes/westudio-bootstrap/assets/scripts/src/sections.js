(function ($) {

  var $sections = $('.page-wrapper');

  function reset() {
    $sections.css('min-height', $(window).height());
  }

  $(window).on('resize', reset);
  $(window).on('load', reset);
  $(document).on('ready', reset);

})(jQuery);
