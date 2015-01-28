jQuery(function ($) {

  var $window       = $(window),
      windowHeight  = $window.height(),
      windowWidth   = $window.width(),
      scrolling     = false,
      scrollTop     = $window.scrollTop(),
      scrollDir     = 'down', // up|down
      $body         = $('body'),
      $menu         = $('#main-menu'),
      $wrapper      = $('.page-wrapper'),
      $current      = $wrapper.first(),
      $welcome      = $wrapper.first(),
      welcomeHeight = $welcome.height(),
      $header       = $('.layout-header'),
      headerHeight  = $header.height(),
      headerState   = 'top'; // top | bottom | absolute

  function setCurrent ($target)
  {
    var id = $target.attr('id');

    $current = $target;
    $target.attr('id', id+'-tmp');
    window.location.hash = id;
    $target.attr('id', id);
  }

  function menu () {

    if (scrollTop >= Math.max(windowHeight, welcomeHeight) - headerHeight) {
      if (headerState !== 'top') {
        $header.css({
          position: 'fixed',
          top: 0,
          bottom: 'auto'
        });
        headerState = 'top';
      }
    } else if (scrollTop + windowHeight - headerHeight < welcomeHeight - headerHeight) {
      if (headerState !== 'bottom') {
        $header.css({
          position: 'fixed',
          top: 'auto',
          bottom: 0
        });
        headerState = 'bottom';
      }
    } else {
      if (headerState !== 'absolute') {
        $header.css({
          position: 'absolute',
          top: (Math.max(windowHeight, welcomeHeight) - headerHeight) + 'px',
          bottom: 'auto'
        });
        headerState = 'absolute';
      }
    }

  }

  // function move (e) {
  //   if (scrolling) {
  //     e.preventDefault();
  //     // e.stopPropagation();
  //     return;
  //   }

  //   if (scrollDir === 'down') {
  //     next();
  //   } else {
  //     prev();
  //   }
  // }

  // function prev () {
  //   var $prev = $current.prev('.page-wrapper');
  //   if (!scrolling && $prev.length) {
  //     jump($prev);
  //   }
  // }

  function next () {
    var $next = $current.next('.page-wrapper');
    if (!scrolling && $next.length) {
      jump($next);
    }
  }

  function jump ($target) {
    var $wrapper, $link;

    if (!$target || $target.length === 0) {
      return;
    }

    if ($target.is('.page-wrapper')) {
      if (!scrolling) {
        _scroll($target);
      }
    }
    else if ($target.is('.tab-pane')) {
      $wrapper = $target.closest('.page-wrapper');
      $link    = $wrapper.find();
      _scroll($wrapper);
    }
  }

  function _scroll ($target) {
    if ($target.length === 0 || scrolling) {
      return;
    }

    $window.scrollspy('process');
    scrolling = true;
    $.scrollTo($target, 1000, function () {
      setCurrent($target);
      setTimeout(function () {
        scrolling = false;
      }, 100);
    });
  }

  function onPaginate (e) {
    var $this = $(e.target),
        $main = $this.closest('.layout-main'),
        url   = $this.attr('href');

    if (!url) {
      return;
    }

    e.preventDefault();

    jump($main.closest('.page-wrapper'));

    $main.fadeOut(0.15, function () {
      $main.load(url+' .layout-main .page', function () {
        $main.fadeIn(0.15);
      });
    });
  }

  function onSubmit (e) {
    var $form = $(e.target),
        $main = $form.closest('.layout-main');

    e.preventDefault();

    jump($main.closest('.page-wrapper'));

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
  }

  function onResize (e) {
    windowHeight = $window.height();
    windowWidth = $window.width();
    welcomeHeight = $welcome.height();
    $wrapper.css('min-height', windowHeight);
    setTimeout(function () { $window.scrollspy('refresh'); }, 100);
    menu();
  }

  function onScroll () {
    var newScrollTop = $window.scrollTop();

    scrollDir = newScrollTop >= scrollTop ? 'down' : 'up';
    scrollTop = newScrollTop;

    menu();
    // move(e);
  }

  $('.btn-next-page').click(function (e) {
    e.preventDefault();
    next();
  });

  if ($body.hasClass('page-template-page-all-php')) {

    // Scroll to to page
    $body.on('click', '#main-menu a', function (e) {
      var $this   = $(this),
          $target = $($this.attr('data-target'));

      e.preventDefault();
      if ($menu.is('.in')) {
        $('#main-menu').collapse('hide');
      }
      jump($target);
    });

    // Home link
    $body.on('click', 'a[rel=home]', function (e) {
      e.preventDefault();
      jump($wrapper.first());
    });

    // Pagination
    $body.on('click', '.pagination a', onPaginate);

    // Submit
    $body.on('submit', onSubmit);

    // Scroll to opened tab's page
    $body.on('show.bs.tab', function (e) {
      var $this   = $(e.target),
          $target = $($this.attr('href'));

      jump($target);
    });

    // Scroll Spy
    $window.scrollspy({ target: '#main-menu', offset: headerHeight });

    $body.on('activate.bs.scrollspy', function (e) {
      var $active = $(e.target),
          $link   = $active.children('a'),
          $target = $($link.attr('data-target'));

      if ($target) {
        setCurrent($target);
      }
    });

    // Resize
    $window.resize(onResize);
    onResize();

    $window.scroll(onScroll);

    // Handle hash
    if (window.location.hash) {
      setTimeout(function () { jump($(window.location.hash)); }, 100);
    }

  }
});