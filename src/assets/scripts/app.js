$(function () {

  $(".app-page-footer a").on('click', function (e) {
    $(".app-page-footer a").removeClass('on');
    $(e.currentTarget).addClass("on");
  })
});
