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
      $(".header-nav-bar").toggle();
      e.stopImmediatePropagation();
    });
    $(document).on('click', function (e) {
      $(".header-nav-bar").hide();
    });
  })();

  //滚动事件，改变头部背景
  (function scroll() {
    var headerEle = $(".jm-header.header-fixed.transparent-bg.scroll");
    var target = $(".new-twitter .banner");
    $(window).scroll(function (e) {
      //头部高度
      var targetHight = target.height();
      var initOpacity = 0.3;
      var scrollTop = $(window).scrollTop();
      var scale = scrollTop / targetHight;
      headerEle.removeClass('bottom-line');
      if (scale > 1) {
        scale = 1;
        headerEle.addClass('bottom-line');
      } else if (scale < initOpacity) {
        scale = initOpacity;
      }
      headerEle.css({opacity: scale});
      //console.log(scale+"  "+scrollTop +"   "+ targetHight);
    });
  })();
/**
 * <div class="ShareObject ">
 <form id="share" class="share-form" >
 <input type="hidden" name="title" value="<?php echo $row->goods_name; ?>" />
 <input type="hidden" name="desc" value="<?php echo $row->goods_name.' ￥'.$final_price; ?>" />
 <input type="hidden" name="pic" value="<?php echo fixImagePath($row->goods_thumb);?>" />
 <input type="hidden" name="href" value="<?php echo JQ_URL.'#m=goods&goods_id='.$row->goods_id; ?>" />
 </form>
 <span class="share_link">分享</span>
 </div>
 * **/
   function doneShare() {
     //品牌商品分享 ---brand_goods.php 品牌商品详细页 ---goods_share.php
     $(document).on('click','.ShareObject', function (e) {
       e.preventDefault();
       var form = $(e.currentTarget).find('form');
       var params = app_share.getShareParam($(form));
       app_share.appshare(params, params.ishref);
     });
     //页面头部点击分享
     //店铺二维码 --brand-qrcode.php
     $(document).on('click','.jm-header .jm-wrapper .icon_share, .share_store', function (e) {
       e.preventDefault();
       var form = $("#share");
       var params = app_share.getShareParam($(form));
       app_share.appshare(params, params.ishref);
     });
   };
  doneShare();
});






/**微信分享 begin**/
var app_share = {};
app_share.shares = null;
/**初始*/
app_share.init = function () {
  // 监听plusready事件
  document.addEventListener("plusready", function () {
    //mui.toast("eee2222");
    plus.share.getServices(function (s) {
      app_share.shares = {};
      //mui.toast("sss=="+s);
      for (var i in s) {
        var t = s[i];
        app_share.shares[t.id] = t;
      }
    }, function (e) {
      mui.toast('无分享服务');
    });
  }, false);
};
/**
 * 发送分享消息
 * @param {JSON} msg
 * @param {plus.share.ShareService} s
 */
app_share.shareMessage =function (msg, s) {
  s.send(
    msg,
    function (e) {
      mui.toast("分享到\"" + s.description + "\"成功！ ");
    },
    function (e) {
      mui.toast("分享到\"" + s.description + "\"失败！ ");
    }
  );
};

/**
 * 分享操作
 * @param {JSON} sb 分享操作对象s.s为分享通道对象(plus.share.ShareService)
 * @param {Boolean} ishref 是否分享链接
 * @param {JSON} msginfo 分享内容
 */

app_share.shareAction = function(sb, ishref, msginfo) {
  if (!sb || !sb.s) {
    mui.toast('无效的分享服务');
    return;
  }
  var msg = {
    content: msginfo.content,
    extra: {
      scene: sb.x
    }
  };
  if (ishref) {
    msg.title = msginfo.title;
    msg.href = msginfo.href;
    msg.content = msginfo.content;
    msg.thumbs = [msginfo.pic];
    msg.pictures = [msginfo.pic];
  }
  // 发送分享
  if (sb.s.authenticated) {
    app_share.shareMessage(msg, sb.s);
  } else {
    sb.s.authorize(function () {
      app_share.shareMessage(msg, sb.s);
    }, function (e) {
      //plus.nativeUI.alert("认证授权失败：" + e.code + " - " + e.message);
      mui.toast('认证授权失败');
    });
  }
};

/**
 * 分享内容或者链接
 * @param  {JSON} msgdata 分享数据的对象
 * @param  {Boolean} ishref  是否分享链接
 */
app_share.appshare = function (msgdata, ishref) {
  //mui.toast('appshare begin');
  // 分享参数
  if (ishref) {
    var msginfo = {
      title: msgdata.title,
      href: msgdata.href,
      content: msgdata.desc,
      pic: msgdata.pic
    };
  } else {
    var msginfo = {
      content: msgdata.desc
    };
  }

  var shareBts = [];
  // 更新分享列表
  var ss = app_share.shares['weixin'];
  ss && ss.nativeClient && (shareBts.push({
    title: '微信朋友圈',
    s: ss,
    x: 'WXSceneTimeline'
  }), shareBts.push({
    title: '微信好友',
    s: ss,
    x: 'WXSceneSession'
  }));

  // 弹出分享列表
  shareBts.length > 0 ? plus.nativeUI.actionSheet({
        title: '分享',
        cancel: '取消',
        buttons: shareBts
      },
      function (e) {
        (e.index > 0) && app_share.shareAction(shareBts[e.index - 1], ishref, msginfo);
      }
    ) : plus.nativeUI.alert('当前环境无法支持分享操作!');
};
/**隐藏域表单*/
app_share.getShareParam = function($form){
  var title =$form.find("input[name='title']").val();
  var desc =$form.find("input[name='desc']").val();
  var pic =$form.find("input[name='pic']").val();
  var href =$form.find("input[name='href']").val();
  var ishref = (href == null || href =="") ? false : true;
  var params = {
    'title': title,
    'href': href,
    'desc': desc,
    'pic': pic,
    'ishref': ishref
  };
  app_share.appshare(params, params.ishref);
}

$(document).ready(function() { app_share.init(); });

/**
 * 公用的分享触发方法
 * title  标题
 * desc   描述
 * pic    图片
 * href   连接
 */
function ShareHandleParam(title, desc, pic, href){
  console.log("ShareHandleParam()");
  var ishref = (href == null || href =="") ? false : true;
  var params = {
    'title': title,
    'href': href,
    'desc': desc,
    'pic': pic,
    'ishref':ishref
  };
  app_share.appshare(params, params.ishref);
}

/**微信分享 end **/
