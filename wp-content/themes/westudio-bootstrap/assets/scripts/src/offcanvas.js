jQuery(function ($) {
  $(document).on('click', '[data-toggle="offcanvas"]', function () {
    var $offcanvas = $($(this).attr('data-target'));
    $offcanvas.toggleClass('active');
  });
});
