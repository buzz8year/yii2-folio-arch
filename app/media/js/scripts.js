$(function(){

    $('.form-control').focus(function(){
      if ($(this).parent().hasClass('has-error')) {
        $(this).parent().find('.help-block').animate({ opacity: 0 },500);
      }
    });
    $('.form-control').blur(function(){
      if ($(this).parent().hasClass('has-error')) {
        $(this).parent().find('.help-block').animate({ opacity: 1 },500);
      }
    });

    $('.to-address').click(function(){

      $('.telephone').animate({ left: '200%', opacity: 0 }, 500);
      $('.address').animate({ left: 0, opacity: 1 }, 500);
      $('.a-footer.pull-right .to-telephone').show();
      $('.a-footer.pull-right .to-feedback').hide();
      $(this).hide();
    });

    $('.to-feedback').click(function(){
      $('.telephone').animate({ left: '-100%', opacity: 0 }, 500);
      $('.feedback').animate({ left: 0, opacity: 1 }, 500);
      $('.a-footer.pull-left .to-telephone').show();
      $('.a-footer.pull-left .to-address').hide();
      $(this).hide();
    });

    $('.pull-right .to-telephone').click(function(){
      $('.address').animate({ left: '-100%', opacity: 0 }, 500);
      $('.telephone').animate({ left: 0, opacity: 1 }, 500);
      $('.a-footer.pull-left .to-address').show();
      $('.a-footer.pull-right .to-feedback').show();
      $(this).hide();
    });

    $('.pull-left .to-telephone').click(function(){
      $('.feedback').animate({ left: '200%', opacity: 0 }, 500);
      $('.telephone').animate({ left: 0, opacity: 1 }, 500);
      $('.a-footer.pull-right .to-feedback').show();
      $('.a-footer.pull-left .to-address').show();
      $(this).hide();
    });

    // if ($('.nav-cstm').find('> div.active > div.subnav').length == 0) {
    //   $('.nav-cstm').find('> div:first-of-type > div.subnav').show();
    // }

    $('.nav-cstm > div').on('mouseover', function(){
      if ($(this).find('.subnav').length != 0) {
        $('.subnav').hide();
        $(this).find('.subnav').show();
      }
    });
    $('.nav-cstm > div > div.subnav').on('mouseleave', function(){
      $(this).hide();
      $('.active .subnav').show();
      // if ($('.nav-cstm').find('> div.active > div.subnav').length == 0) {
      //   $('.nav-cstm').find('> div:first-of-type > div.subnav').show();
      // }else{
      //   $('.active .subnav').show();
      // }
    });

    $('.nav-mobi > div').each(function(){
      if ($(this).find('.subnav').length != 0) $(this).addClass('subzero');
      // $(this).find('a').attr('data-toggle','collapse');
      // $(this).find('a').attr('href','#'+i);
      // $(this).find('.subnav').addClass('collapse');
      // $(this).find('.subnav').attr('id',i);
    });

    $('.nav-mobi > div.subzero > a').on('click', function(e){
      e.preventDefault();
    });

    $('.nav-mobi > div').on('click', function(){
      if ($('.nav-mobi').find('.open').length == 0) $('.nav-mobi > div').addClass('off');
      $('.subzero.open').toggleClass('off');
      if ($(this).hasClass('off')) $(this).toggleClass('off');
      $('.subzero.open').not(this).removeClass('open').find('.subnav').slideUp();
      if ($(this).find('.subnav').length != 0) $(this).toggleClass('open').find('.subnav').slideToggle();
      if ($('.nav-mobi').find('.open').length == 0) $('.nav-mobi > div').removeClass('off');
    });

    $('.fltr-close').on('click', function(){
      $('body').removeClass('fix');
      $('#navbar-menu').removeClass('in').hide();
      $('.nav-filter, .fltr-close').removeClass('x');
      $('.nav-mobi > div.open').click();
    });

    $('.text-vert a').on('click', function(){
      $('html, body').animate({scrollTop: ($('.magic-wrap > div:first-of-type').offset().top)}, 1000);
    });

    // $('.navbar-toggle').on('click', function(){
    //   $('body').addClass('fix');
    // })

    $('#feedback').on('submit', function(e){
        e.stopImmediatePropagation();
        var form = $(this);

        $.ajax({
            url: form.attr('action'),
            type: 'post',
            data: form.serialize(),
            success: function(json) {
                if (json == 'true') {
                    $('#feed-success').modal({show:true});
                    $('#feedback')[0].reset();
                    setTimeout(function() {
                        $("#feed-success").modal('hide');
                    }, 3000);
                }else{
                  form.yiiActiveForm('submitForm');
                }
            }
        });

        return false;
    });

});
