(function ($) {
  'use strict';

  /* Open wp.media frame and collect selected IDs */
  $(document).on('click', '.hgc-select', function () {
    var $wrap  = $(this).closest('.hgc-wrap');
    var $input = $wrap.find('.hgc-input');

    var frame = wp.media({
      title   : 'Wybierz zdjęcia i filmy',
      button  : { text: 'Użyj wybranych' },
      multiple: true,
      library : { type: ['image', 'video'] },
    });

    /* Pre-select previously saved items */
    frame.on('open', function () {
      var sel = frame.state().get('selection');
      $input.val().split(',').filter(Boolean).forEach(function (id) {
        var attachment = wp.media.attachment(id);
        attachment.fetch();
        sel.add(attachment ? [attachment] : []);
      });
    });

    /* Save IDs and refresh thumbnails */
    frame.on('select', function () {
      var models = frame.state().get('selection').models;
      var ids    = models.map(function (a) { return a.id; }).join(',');

      $input.val(ids).trigger('change');
      refreshThumbs($wrap, models);

      $wrap.find('.hgc-select').text('✎ Zmień wybór (' + models.length + ')');
      if (!$wrap.find('.hgc-clear').length) {
        $wrap.find('.hgc-actions').append(
          '<button type="button" class="button hgc-clear">&#10005;</button>'
        );
      }
    });

    frame.open();
  });

  /* Clear all */
  $(document).on('click', '.hgc-clear', function () {
    var $wrap = $(this).closest('.hgc-wrap');
    $wrap.find('.hgc-input').val('').trigger('change');
    $wrap.find('.hgc-thumbs').empty();
    $wrap.find('.hgc-select').text('+ Dodaj zdjęcia / filmy');
    $(this).remove();
  });

  function refreshThumbs($wrap, models) {
    var $thumbs = $wrap.find('.hgc-thumbs').empty();
    models.forEach(function (a) {
      var mime = a.get('mime') || '';
      if (mime.indexOf('video') === 0) {
        $thumbs.append('<div class="hgc-thumb hgc-thumb-video"><span>&#9654;</span></div>');
      } else {
        var sizes = a.get('sizes') || {};
        var url   = sizes.thumbnail ? sizes.thumbnail.url : a.get('url');
        $thumbs.append('<div class="hgc-thumb"><img src="' + url + '" alt=""></div>');
      }
    });
  }

}(jQuery));
