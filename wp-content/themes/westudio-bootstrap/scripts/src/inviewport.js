(function ($, undefined) {

  'use strict';


  /**
   * Window's jQuery object
   *
   * @type {jQuery}
   */
  var $window = $(window);

  /**
   * Next unique ID
   *
   * @type {Number}
   */
  var uid = 1;


  /**
   * InViewport Constructor
   *
   * @param {Element} el
   * @param {Object}  options
   */
  function InViewport (el, options) {
    this.$element = $(el);
    this.options  = $.extend({}, this.DEFAULTS, options);
    this.uid      = uid++;
    this.visible  = false;
    this.offset   = {
      top:    0,
      height: 0,
      bottom: 0
    };

    $window.on(this.namespacize('resize'), $.proxy(this.reset, this));
    $window.on(this.namespacize('scroll'), $.proxy(this.update, this));

    this.reset();
  }

  /**
   * Default options
   *
   * @type {Object}
   */
  InViewport.prototype.DEFAULTS = {

    /**
     * Top margin
     *
     * @type {Number|Object|Function}
     */
    top: 0,

    /**
     * Bottom margin
     *
     * @type {Number|Object|Function}
     */
    bottom: 0,

    /**
     * Class name to toggle.
     *
     * @type {String}
     */
    className: 'inviewport',

    /**
     * If `once` is true, `className` will not be toggle off
     * after appearing in the viewport for the first time.
     *
     * @type {Boolean}
     */
    once: false

  };

  /**
   * Destroy
   *
   * @return {void}
   */
  InViewport.prototype.destroy = function () {
    $window.off(this.namespacize('resize'));
    $window.off(this.namespacize('scroll'));
    this.options = null;
    this.$element.data('inviewport', null);
    this.$element = null;
  };

  /**
   * Refresh
   *
   * Refresh offset, size, then update.
   *
   * @return {void}
   */
  InViewport.prototype.reset = function () {
    if (this.visible) {
      this.leave();
    }

    this.offset.top    = this.$element.offset().top;
    this.offset.height = this.$element.height();
    this.offset.bottom = this.offset.top + this.offset.height;

    this.update();
  };

  /**
   * Update
   *
   * Toggle `className` if element is visible inside the viewport.
   *
   * @return {void}
   */
  InViewport.prototype.update = function() {
    var options = this.options;
    var top     = this.top();
    var bottom  = this.bottom();
    var visible = $.viewport.offset.top <= this.offset.bottom - bottom && this.offset.top + top <= $.viewport.offset.top + $.viewport.offset.height;

    if (visible && this.visible) {
      this._trigger('inside');
    }

    if (visible === this.visible) {
      return;
    }

    if (visible) {
      this.enter();
    } else {
      this.leave();
    }
  };

  /**
   * Pin
   *
   * @return {void}
   */
  InViewport.prototype.enter = function() {
    var $el = this.$element;

    if (this.visible) {
      return;
    }

    if (this._trigger('entering').isDefaultPrevented()) {
      return;
    }

    this.visible = true;
    $el.addClass(this.options.className);

    this._trigger('entered');

    if (this.options.once) {
      this.destroy();
    }
  };

  /**
   * Unpin
   *
   * @return {void}
   */
  InViewport.prototype.leave = function() {
    var $el  = this.$element;

    if (!this.visible) {
      return;
    }

    if (this._trigger('leaving').isDefaultPrevented()) {
      return;
    }

    this.visible = false;
    $el.removeClass(this.options.className);

    this._trigger('left');
  };

  /**
   * Namespacize event's name
   *
   * @param  {String}  name
   * @param  {Boolean} unique
   * @return {String}
   */
  InViewport.prototype.namespacize = function(name, unique) {
    if (unique === undefined) {
      unique = true;
    }
    return name + '.viewport' + (unique ? '.' + this.uid : '');
  };

  /**
   * Trigger event
   *
   * @param  {String} type
   * @return {jQuery.Event}
   *
   * @private
   */
  InViewport.prototype._trigger = function(type) {
    var e = $.Event(this.namespacize(type, false));

    this.$element.trigger(e, [this.offset, $.viewport.offset]);

    return e;
  };

  /**
   * Get top
   *
   * @return {Number}
   */
  InViewport.prototype.top = function() {
    var top = this.options.top;

    if (typeof top === 'number') {
      return top;
    }

    if (typeof top === 'function') {
      return top(this.$element, this.offset, $.viewport.offset);
    }

    return 0;
  };

  /**
   * Get bottom
   *
   * @return {Number}
   */
  InViewport.prototype.bottom = function() {
    var bottom = this.options.bottom;

    if (typeof bottom === 'number') {
      return bottom;
    }

    if (typeof bottom === 'function') {
      return bottom(this.$element, this.offset, $.viewport.offset);
    }

    return 0;
  };

  /**
   * Plugin
   *
   * @param  {Object|String|undefined} o
   * @return {void}
   */
  $.fn.inviewport = function (o) {
    return this.each(function () {
      var $this    = $(this);
      var instance = $this.data('inviewport');
      var options  = $.extend({}, $this.data(), typeof o === 'object' && o);
      var method   = typeof o === 'string' && o;

      if (!instance) {
        $this.data('inviewport', instance = new InViewport(this, options));
      }

      if (method) {
        instance[method].call(instance);
      }
    });
  };


  // DATA API
  // --------

  $window.on('load', function () {
    $('[data-spy=viewport]').each(function () {
      $(this).inviewport();
    });
  });

})(jQuery);
