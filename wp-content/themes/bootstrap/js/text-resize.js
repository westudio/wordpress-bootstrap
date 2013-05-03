/**
 * Resize text
 *
 * Usage:
 * <code>
 *     <ul>
 *         <li><a href="#" rel="text-resizer" data-resizement="bigger">Bigger</a></li>
 *         <li><a href="#" rel="text-resizer" data-resizement="smaller">Smaller</a></li>
 *     </ul>
 *     <div class="resizable">
 *         <p>Resizable text...</p>
 *     </div>
 * </code>
 *
 * @author  Lionel Gaillard <lionel@we-studio.ch>
 * @version 0.1.1
 */
;(function ($) {

    "use strict";

    ({
        bind: function () {
            $($.proxy(this.init, this));
        },

        init: function () {
            var $resizers = $('a[rel=text-resizer], button[rel=text-resizer]');

            if ($resizers.length == 0) {
                return;
            }

            this.$textSmaller = $resizers.filter('[data-resizement="smaller"]');
            this.$textBigger = $resizers.not(this.$textSmaller);
            this.$content = $('.resizable');

            this.currentFontSize = parseInt(this.$content.css('font-size'));
            this.currentLineHeight = parseInt(this.$content.css('line-height'));

            this.$textBigger.click($.proxy(this.bigger, this));
            this.$textSmaller.click($.proxy(this.smaller, this));
        },

        bigger: function (e) {
            e.preventDefault();
            e.stopPropagation();

            this.$content.css({
                'font-size': (this.currentFontSize += 2) + 'px',
                'line-height': (this.currentLineHeight += 2) + 'px'
            });
        },

        smaller: function (e) {
            e.preventDefault();
            e.stopPropagation();

            this.$content.css({
                'font-size': (this.currentFontSize -= 2) + 'px',
                'line-height': (this.currentLineHeight -= 2) + 'px'
            });
        }
    }).bind();
})(window.jQuery);