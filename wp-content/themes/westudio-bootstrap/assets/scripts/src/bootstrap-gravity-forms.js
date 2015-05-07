jQuery(function($){

  'use strict';

  var $document = $(document);

  function replace () {

    // .gform_wrapper
    $('.gform_wrapper')
      .each(function () {
        var $wrapper = $(this);

        // form
        $('form', $wrapper)
          .addClass('form-horizontal');

        // .gform_body
        $('.gform_body', $wrapper)
          .addClass('clearfix')
        ;

        // .gform_footer
        $('.gform_footer', $wrapper)
          .addClass('col-sm-offset-2 col-sm-6')
          .removeClass('gform_footer')
          .each (function () {
            var $footer = $(this),
                $body   = $footer.prev(),
                $group  = $('<div class="form-group"></div>').appendTo($body);

            $footer.appendTo($group);
          })
        ;

        // ul.gform_fields
        $('.gform_fields', $wrapper)
          .addClass('list-unstyled')
          .removeClass('gform_fields')
        ;

        // li.required
        $('.gfield_contains_required', $wrapper)
          .each(function () {
            $(this)
              .removeClass('gfield_contains_required')
              .find('input, textarea, select')
                .not('input[type="checkbox"], input[type="radio"]')
                .attr('required', 'true')
            ;
          })
        ;

        // .control-label
        $('.gfield_label', $wrapper)
          .addClass('control-label col-sm-2')
          .removeClass('gfield_label')
        ;

        // .form-group, .control-group, .form-control
        $('.gfield', $wrapper)
          .each(function () {
            var $group     = $(this),
                $control   = $group.find('input, textarea, select'),
                $container = $group.find('.ginput_container')
            ;

            $group
              .addClass('form-group')
              .removeClass('gfield')
            ;

            $control
              .not('input[type="checkbox"], input[type="radio"]')
              .addClass('form-control')
              .after('<span class="help-block"></span>')
            ;

            $container
              .addClass('control-group')
              .removeClass('.ginput_container')
            ;

            if ($control.is('.small')) {
              $container.addClass('col-sm-3');
            }
            else if ($control.is('.large')) {
              $container.addClass('col-sm-10');
            }
            else {
              $container.addClass('col-sm-6');
            }
          })
        ;

        // radio, checkbox
        $('.gfield_checkbox, .gfield_radio', $wrapper)
          .each(function () {
            var $this = $(this);

            $this.after('<span class="help-block"></span>');

            if ($this.is('.gfield_checkbox')) {
              $this
                .addClass('checkbox')
                .removeClass('gfield_checkbox');
            } else {
              $this
                .addClass('radio')
                .removeClass('gfield_radio');
            }
          })
          .find('input[type=checkbox], input[type=radio]')
            .each(function () {
              var $this = $(this);
              $this.prependTo($this.siblings('label'));
            })
        ;

        // .btn
        $('.gform_button', $wrapper)
          .addClass('btn btn-primary')
          .removeClass('gform_button')
        ;

        // .has-error
        $('.gfield_error', $wrapper)
          .addClass('has-error')
          .removeClass('gfield_error')
        ;

        // .help-block
        $('.validation_message', $wrapper)
          .each(function () {
            var $this  = $(this),
                $block = $this.prev().find('.help-block');

            $block.append($this.html());
            $this.remove();
          })
        ;

        // .alert-danger
        $('.validation_error', $wrapper)
          .addClass('alert alert-danger')
          .removeClass('validation_error')
          .prepend('<button type="button" class="close" data-dismiss="alert">&times;</button>')
        ;

        // .progress-bar
        $('.gf_progressbar', $wrapper)
          .addClass('progress progress-striped active')
          .removeClass('gf_progressbar')
          .children('.gf_progressbar_percentage')
            .addClass('progress-bar progress-bar-success')
            .removeClass('gf_progressbar_percentage')
        ;
      })
    ;

    // .alert-success
    $('.gform_confirmation_wrapper')
      .addClass('alert alert-success')
      .removeClass('gform_confirmation_wrapper')
      .prepend('<button type="button" class="close" data-dismiss="alert">&times;</button>')
    ;

  }

  $document.on('ajaxComplete gform_post_render', replace);

  replace();

});