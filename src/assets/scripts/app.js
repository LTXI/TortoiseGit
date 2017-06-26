$(function () {

  $(".app-page-footer a").on('click', function (e) {
    $(".app-page-footer a").removeClass('on');
    $(e.currentTarget).addClass("on");
  });

  //新底部导航切换
  (function newAppFooterNavbar() {
    $(".new-app-page-footer a").on('click', function (e) {
      $(".new-app-page-footer a").removeClass('on');
      $(e.currentTarget).addClass("on");
    });
  })();

  //头部导航
  (function topHeaderNav() {
    $(document).on('click', '.icon_header-nav-short', function (e) {
      //console.log($(e.target) + "1111");
      $(".header-nav-bar").toggle();
      e.stopImmediatePropagation();
    });
    $(document).on('click', function (e) {
      // console.log($(e.target) + "22222");
      $(".header-nav-bar").hide();
    });
  })();

  //滚动事件，改变头部背景
  (function scroll() {
    var headerEle = $(".jm-header.header-fixed.transparent-bg.scroll");
    var target = $(".new-twitter .banner");
    $(window).scroll(function (e) {
      //头部高度
      var targetHight =target.height();
      var initOpacity = 0.3;
      var scrollTop = $(window).scrollTop();
      var scale = scrollTop / targetHight;
      headerEle.removeClass('bottom-line');
      if(scale > 1){
        scale = 1;
        headerEle.addClass('bottom-line');
      }else if(scale < initOpacity) {
        scale = initOpacity;
      }
     headerEle.css({ opacity:scale});
      //console.log(scale+"  "+scrollTop +"   "+ targetHight);
    });
  })();

});
