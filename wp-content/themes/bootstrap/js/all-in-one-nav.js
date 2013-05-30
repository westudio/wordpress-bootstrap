;jQuery(function ($) {

    // Link to hash
    $('#main-menu a').each(function () {
      var $this = $(this);
      $this.attr('href', '/' + $this.data('target'));
    });

    if ($('body').hasClass('page-template-page-all-in-one-php')) {

        $(window).scrollspy({ target: '#main-menu' });
        if (window.location.hash) {
          $.scrollTo(window.location.hash);
        }

      // ScrollTo
      $(document).on('click', '#main-menu a', function(e) {
        var target = '#' + $(this).attr('data-target').split('#')[1];
        $.scrollTo(target, 1000, function () {
          window.location = target;
        });
        e.preventDefault();
      });

    }
});