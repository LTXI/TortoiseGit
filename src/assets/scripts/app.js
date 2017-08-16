var App_shop = {};
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
  /**
   * <div class="ShareObject ">
   <form class="share-form" >
   <input type="hidden" name="title" value="<?php echo $row->goods_name; ?>" />
   <input type="hidden" name="desc" value="<?php echo $row->goods_name.' ￥'.$final_price; ?>" />
   <input type="hidden" name="pic" value="<?php echo fixImagePath($row->goods_thumb);?>" />
   <input type="hidden" name="href" value="<?php echo JQ_URL.'#m=goods&goods_id='.$row->goods_id; ?>" />
   </form>
   <span class="share_link">分享</span>
   </div>
   * **/
  function doneShare() {
    //品牌商品分享 ---brand_goods.php
    //品牌商品详细页 ---goods_share.php
    //store_no_link.php   store_goodslist_no_link.php push_agentinfo.php
    $(document).on('click', '.ShareObject', function (e) {
      e.preventDefault();
      var form = $(e.currentTarget).find('form');
      var params = app_share.getShareParam($(form));
      //app_share.appshare(params, params.ishref);
    });

    //页面头部点击分享
    //店铺二维码 --brand-qrcode.php
    /**<div class="ShareObject ">
     <form id="share" >
     <input type="hidden" name="title" value="<?php echo $row->goods_name; ?>" />
     <input type="hidden" name="desc" value="<?php echo $row->goods_name.' ￥'.$final_price; ?>" />
     <input type="hidden" name="pic" value="<?php echo fixImagePath($row->goods_thumb);?>" />
     <input type="hidden" name="href" value="<?php echo JQ_URL.'#m=goods&goods_id='.$row->goods_id; ?>" />
     </form>
     <span class="share_link">分享</span>
     </div>
     **/
    $(document).on('click', '.jm-header .jm-wrapper .icon_share, .share_store', function (e) {
      e.stopImmediatePropagation();
      var form = $("#share");
      var params = app_share.getShareParam($(form));
      //app_share.appshare(params, params.ishref);
    });
  };
  doneShare();

  popupConfirm();

  shareControlHadler();
});

//分享begin-----
function shareControlHadler() {
  $(document).on('click', '.cancel, .m-layermsk', function (e) {
    if ($(".m-layermsk").length > 0) {
      $(".m-layermsk").remove();
    } else {
      //$("body").append(shareTempHtml());
    }
  });
}
function shareTempHtml() {
  var html = '<div class="m-layermsk m-newpopmsk">' +
    '<div class="m-window m-newpopup">' +
    '<div class="winbody">' +
    '<p class="title">分享到</p>' +
    '<ul class="share-content clearfix">' +
    '<li class="share-item" onclick="app_share.shareSelectWay(\'weixin\', \'weixin-1\');">' +
    '<i class="share-item-img icon_share_wechat"></i>' +
    '<p class="share-item-text">微信好友</p>' +
    '</li>' +
    '<li class="share-item" onclick="app_share.shareSelectWay(\'weixin\', \'weixin-2\');">' +
    '<i class="share-item-img icon_share_friends"></i>' +
    '<p class="share-item-text">朋友圈</p>' +
    '</li>' +
    '<li class="share-item" onclick="app_share.shareSelectWay(\'sinaweibo\');">' +
    '<i class="share-item-img icon_share_weibo"></i>' +
    '<p class="share-item-text">微博</p>' +
    '</li>' +
    '</ul>' +
    '<p class="cancel bdr-top">取消</p>' +
    '</div>' +
    '</div>' +
    '</div>';
  return html;
}
//分享end-----
/**确认弹框 begin------------------------------------------**/
//二次弹框确认
/*<div id="alert_mb_box" class="alert_mb_box">
 <div id="alert_mb_con" class="alert_mb_con">
 <span class="alert_mb_tit">温馨提示标题标题</span>
 <div class="alert_mb_msg">您确定要退出吗？</div>
 <div class="alert_mb_btnbox">
 <span id="alert_mb_btn_ok" class="alert_mb_btn_ok alert_mb_btn">确定</span>
 <span id="alert_mb_btn_no" class="alert_mb_btn_no alert_mb_btn">取消</span>
 </div>
 </div>
 </div>*/
var popupConfirm = function () {
  App_shop.MsgJMBox = {
    //消息提示框
    Alert: function (title, msg) {
      GenerateHtml("alert", title, msg);
      btnOk();  //alert只是弹出消息，因此没必要用到回调函数callback
      btnNo();
    },
    //消息二次确认框
    Confirm: function (title, msg, callback) {
      GenerateHtml("confirm", title, msg);
      btnOk(callback);
      btnNo();
    }
  }
  //生成Html
  var GenerateHtml = function (type, title, msg) {
    var _html = "";
    _html += '<div id="alert_mb_box" class="alert_mb_box"><div id="alert_mb_con" class="alert_mb_con"><span class="alert_mb_tit">' + title + '</span>';
    _html += '<div class="alert_mb_msg">' + msg + '</div><div class="alert_mb_btnbox">';
    if (type == "alert") {
      _html += '<span id="alert_mb_btn_ok" class="alert_mb_btn_ok alert_mb_btn mb_notice_ok">确定</span>';
    }
    if (type == "confirm") {
      _html += '<span id="alert_mb_btn_ok" class="alert_mb_btn_ok alert_mb_btn">确定</span>';
      _html += '<span id="alert_mb_btn_no" class="alert_mb_btn_no alert_mb_btn">取消</span>';
    }
    _html += '</div></div></div>';
    $("body").append(_html);
  }

  //确定按钮事件
  var btnOk = function (callback) {
    $("#alert_mb_btn_ok").click(function () {
      $("#alert_mb_box").remove();
      if (typeof (callback) == 'function') {
        callback();
      }
    });
  }
  //取消按钮事件
  var btnNo = function () {
    $("#alert_mb_btn_no").click(function () {
      $("#alert_mb_box").remove();
    });
  }
};
/**确认弹框 end------------------------------------------**/

/**微信分享 begin------------------------------------------**/
var app_share = {};
app_share.shares = null;
/**初始*/
app_share.init = function () {
  // 监听plusready事件
  document.addEventListener("plusready", function () {
    plus.share.getServices(function (s) {
      app_share.shares = {};
      for (var i in s) {
        var t = s[i];
        app_share.shares[t.id] = t;
      }
      //console.log(app_share.shares['weixin']);
    }, function (e) {
      //mui.toast("无享服务！");
      plus.nativeUI.alert('无分享服务!');
    });
  }, false);
};
/**
 * 发送分享消息
 * @param {JSON} msg
 * @param {plus.share.ShareService} s
 */
app_share.shareMessage = function (msg, s) {
  s.send(
    msg,
    function (e) {
      mui.toast("分享到\"" + s.description + "\"成功！");
    },
    function (e) { // e.code 错误编码，  e.message错误描述信息
      mui.toast("分享到\"" + s.description + "\"失败！");
      //alert("分享到\"" + s.description + "\"失败: " + e.code + " - " + e.message);
    }
  );
};

/**
 * 分享操作
 * @param {JSON} sb 分享操作对象s.s为分享通道对象(plus.share.ShareService)
 * @param {Boolean} ishref 是否分享链接
 * @param {JSON} msginfo 分享内容
 */

app_share.shareAction = function (sb, ishref, msginfo) {
  if (!sb || !sb.s) {
    plus.nativeUI.alert('无效的分享服务!');
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
    msg.thumbs = [msginfo.pic];//+ '@80w_80h_0e'
    msg.pictures = [msginfo.pic];
  }
  //发送分享消息
  var sendMessage = function () {
    // 发送分享
    if (sb.s.authenticated) {
      app_share.shareMessage(msg, sb.s);
    } else {
      sb.s.authorize(function () {
        app_share.shareMessage(msg, sb.s);
      }, function (e) {
        plus.nativeUI.alert("认证授权失败：" + e.code + " - " + e.message);
      });
    }
  }

  //微博分享
  if ('sinaweibo' == sb.s.id) {
    if (plus.os.name.toUpperCase() == "ANDROID") {
      mui.toast("即将打开新浪微博客户端");
      var dtask = plus.downloader.createDownload();
      var localPictures = '';
      function onStateChanged(d, status) {
        switch (d.state) {
          case 4:
            if (status == 200) {
              //mui.toast("图片下载完成：" + d.filename);
              localPictures = plus.io.convertLocalFileSystemURL(d.filename);
              msg.thumbs = [localPictures];
              msg.pictures = [localPictures];
              sendMessage();
            } else {
              //mui.toast("下载图片失败");
              mui.toast("打开新浪微博客户端失败");
            }
            break;
          case 1:
            //console.log("下载开始");
            break;
          case 2:
            //console.log("请求已响应");
            break;
          case 3:
            //console.log("下载进行中");
            break;
          default:
            //console.log("state: " + d.state);
            break;
        }
      }

      mui.each(msg.pictures, function (i, n) {
        var dtask = plus.downloader.createDownload(n);
        dtask.addEventListener("statechanged", onStateChanged, false);
        dtask.start();
      });
    }
    else if (plus.os.name.toUpperCase() == "IOS") { //新浪微博无法分享链接,不传递href，不能写href='',否则无法显示图片
      msg.content += msg.href;//连接加在内容后面
      msg.href = false;// 新浪微博无法分享链接
      sendMessage();
    }
  } else {
    sendMessage();
  }
};

/**
 * 分享内容或者链接
 * @param  {JSON} msgdata 分享数据的对象
 * @param  {Boolean} ishref  是否分享链接
 */
//信息再包装
var cur_msginfo = {};
app_share.appshare = function (msgdata, ishref) {

  cur_msginfo = {};
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
  cur_msginfo = {
    ishref: ishref,
    msginfo: msginfo
  }

  //弹出分享列表框, 点击是否在shareSelectWay()处理
  $("body").append(shareTempHtml());
};

/**
 * @param shareWay 分享服务标识 :
 * "sinaweibo" - 表示新浪微博；
 * "tencentweibo" - 表示腾讯微博；
 * "weixin" - 表示微信；
 * "qq" - 表示腾讯QQ。
 * @param subShareWay  微信分两种：区分微信好友和微信朋友圈
 */
app_share.shareSelectWay = function (shareWay, subShareWay) {

  if (app_share.shares == null) {
    plus.nativeUI.alert('当前环境无法支持分享操作!');
    return;
  }
  var ss = app_share.shares[shareWay];
  if (!ss) {
    plus.nativeUI.alert('当前环境无法支持分享操作!');
  } else {
    if (shareWay == null || shareWay == undefined) {
      return;
    }
    //微信
    var shareServiceWrapInfo = {};
    //ShareMessageExtra 可取值： "WXSceneSession"分享到微信的“我的好友”； "WXSceneTimeline"分享到微信的“朋友圈”中； "WXSceneFavorite"分享到微信的“我的收藏”中。 默认值为"WXSceneSession"。
    if (shareWay == "weixin") {
      if (subShareWay == "weixin-1") {//微信好友
        shareServiceWrapInfo = {
          title: '微信好友',
          s: ss,
          x: 'WXSceneSession'//ShareMessageExtra 仅微信中使用， 新浪微博不用
        }
      } else if (subShareWay == "weixin-2") {//微信朋友圈
        shareServiceWrapInfo = {
          title: '微信朋友圈',
          s: ss,
          x: 'WXSceneTimeline'
        }
      }
    } else if (shareWay == "sinaweibo") {
      shareServiceWrapInfo = {
        title: '新浪微博',
        s: ss,
        x: ''//ShareMessageExtra 仅微信中使用， 新浪微博不用
      }
    }
    app_share.shareAction(shareServiceWrapInfo, cur_msginfo.ishref, cur_msginfo.msginfo);
  }
};

/**隐藏域表单*/
app_share.getShareParam = function ($form) {
  var title = $form.find("input[name='title']").val();
  var desc = $form.find("input[name='desc']").val();
  var pic = $form.find("input[name='pic']").val();
  var href = $form.find("input[name='href']").val();
  var ishref = (href == null || href == "") ? false : true;
  var params = {
    'title': title,
    'href': href,
    'desc': desc,
    'pic': pic,
    'ishref': ishref
  };
  app_share.appshare(params, params.ishref);
}

$(document).ready(function () {
  app_share.init();
});

/**
 * 公用的分享触发方法
 * title  标题
 * desc   描述
 * pic    图片
 * href   连接
 * e    event
 */
function ShareHandleParam(title, desc, pic, href, e) {
  var e = e || window.event;
  if (e != null) {
    e.stopImmediatePropagation();
  }
  var ishref = (href == null || href == "") ? false : true;
  var params = {
    'title': title,
    'href': href,
    'desc': desc,
    'pic': pic,
    'ishref': ishref
  };
  /**params.desc = "九件app,以人为本，按需消费，基于社交的精致生活和创业平台";
   params.href = "http://www.nineneeds.com/#m=default&a=downloadAgent";
   params.pic = "http://www.nineneeds.com/images/201707/thumb_img/412_thumb_G_1500492303607.jpg";
   params.ishref=true;
   **/

  app_share.appshare(params, params.ishref);
}

/**微信分享 end ------------------------------------------**/
