(function ($) {

  var $window   = $(window);

  var $body     = $('body');
  var $menu     = $('#main-menu');
  var $wrappers = $('.page-wrapper');
  var $current  = $wrappers.first();

  var scrolling = false;
  var syncUri   = true;

  function setCurrent ($target) {
    var id = $target.attr('id');

    if (!syncUri) {
      return;
    }

    $current = $target;
    $target.attr('id', id+'-tmp');
    window.location.hash = id;
    $target.attr('id', id);
  }

  // function prev () {
  //   var $prev = $current.prev('.page-wrapper');
  //   if (!scrolling && $prev.length) {
  //     jumpTo($prev);
  //   }
  // }

  function next () {
    var $next = $current.next('.page-wrapper');
    if (!scrolling && $next.length) {
      jumpTo($next);
    }
  }

  function jumpTo ($target, callback) {
    var $wrapper, $link;

    if (!$target || $target.length === 0) {
      return;
    }

    if ($target.is('.page-wrapper')) {
      if (!scrolling) {
        _scrollTo($target, callback);
      }

      return;
    }

    if ($target.is('.tab-pane')) {
      $wrapper = $target.closest('.page-wrapper');
      $link    = $($target.attr('id')+'-link');
      console.log($link.get(0));
      $link.tab('show');
      syncUri = false;
      _scrollTo($wrapper, function () {
        syncUri = true;
        if (callback) {
          callback();
        }
      });
    }
  }

  function _scrollTo ($target, callback) {
    if ($target.length === 0 || scrolling) {
      return;
    }

    $window.scrollspy('process');
    scrolling = true;
    $.scrollTo($target, 1000, function () {
      setCurrent($target);
      setTimeout(function () {
        scrolling = false;
        if (callback) {
          callback();
        }
      }, 100);
    });
  }

  $('.btn-next-page').click(function (e) {
    e.preventDefault();
    next();
  });

  if (!$body.hasClass('page-template-page-all-php')) {
    return;
  }

  // Scroll to to page
  $body.on('click', '#main-menu a', function (e) {
    var $this   = $(this),
        $target = $($this.attr('data-target'));

    e.preventDefault();
    if ($menu.is('.in')) {
      $('#main-menu').collapse('hide');
    }
    jumpTo($target);
  });

  // Home link
  $body.on('click', 'a[rel=home]', function (e) {
    e.preventDefault();
    jumpTo($wrappers.first());
  });

  // Pagination
  $body.on('click', '.pagination a', function (e) {
    var $this = $(e.target),
        $main = $this.closest('.layout-main'),
        url   = $this.attr('href');

    if (!url) {
      return;
    }

    e.preventDefault();

    jumpTo($main.closest('.page-wrapper'));

    $main.fadeOut(0.15, function () {
      $main.load(url+' .layout-main .page', function () {
        $main.fadeIn(0.15);
      });
    });
  });

  // Submit
  $body.on('submit', function onSubmit (e) {
    var $form = $(e.target),
        $main = $form.closest('.layout-main');

    e.preventDefault();

    jumpTo($main.closest('.page-wrapper'));

    $main.fadeOut(0.15, function () {
      $.post(
        $form.attr('action'),
        $form.serialize(),
        function (data) {
          $main.html($('.layout-main .page', data));
          $main.fadeIn(0.15);
        },
        'html'
      );
    });
  });

  // Scroll to opened tab's page
  $body.on('show.bs.tab', function (e) {
    var $this   = $(e.target),
        $target = $($this.attr('href'));

    jumpTo($target, function () {
      setCurrent($target);
    });
  });

  // Scroll Spy
  $window.scrollspy({ target: '#main-menu' });

  $body.on('activate.bs.scrollspy', function (e) {
    var $active = $(e.target),
        $link   = $active.children('a'),
        $target = $($link.attr('data-target'));

    if ($target) {
      setCurrent($target);
    }
  });

  $(document).on('ready', function () {

    // Handle hash
    if (window.location.hash) {
      jumpTo($(window.location.hash));
    }

  });

})(jQuery);
