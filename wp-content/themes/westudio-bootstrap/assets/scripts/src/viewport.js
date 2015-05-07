(function ($, undefined) {

  'use strict';

  /**
   * Viewport constructor
   */
  function Viewport () {
    var $window = $(window);

    this.offset = {
      top:    0,
      height: 0,
      bottom: 0
    };

    this.reset = function() {
      this.offset.height = $window.height();
      this.update();
    };

    this.update = function() {
      this.offset.top    = $window.scrollTop();
      this.offset.bottom = this.offset.top + this.offset.height;
    };

    $window.on('resize.viewport', $.proxy(this.reset, this));
    $window.on('scroll.viewport', $.proxy(this.update, this));
    $window.one('load.viewport', $.proxy(this.reset, this));
    $(document).one('ready.viewport', $.proxy(this.reset, this));
  }

  /**
   * Viewport singleton
   *
   * @type {Viewport}
   */
  $.viewport = new Viewport();

})(jQuery);
