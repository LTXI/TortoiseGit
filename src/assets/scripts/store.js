/**
 * Created by LIUTX on 2017/5/24.
 */
var jmApp = {};
$(function () {

  backtop();
  navBar();

  //返回顶部
  function backtop() {
    const TOPH = 200;

    $(window).scroll(function () {
      var scroH = $(window).scrollTop();
      if (scroH > TOPH) {
        $('#jm-backtop').addClass('none');
      } else {
        $('#jm-backtop').removeClass('none');
      }
    });
    $("#jm-backtop").click(function () {
      var speed = 200;//滑动的速度
      $('body,html').animate({scrollTop: 0}, speed);
      return false;
    });
  }

  //底部导航栏
  function navBar() {
    $("#footer .footer_inner a").on('click', function (e) {
      var elm = $(e.currentTarget);
      console.log(elm.hasClass('on'));
      if (elm.hasClass('on')) {
        return;
      }
      $("#footer .footer_inner a").removeClass('on');
      elm.addClass('on');
    })
  }
});
