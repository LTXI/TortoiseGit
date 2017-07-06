/**微信分享 begin**/
var app_share = {};
app_share.shares = null;
/**初始*/
app_share.init = function () {
  //var shares = null;
  // 监听plusready事件
  document.addEventListener("plusready", function () {
    alert("eee2222");
    plus.share.getServices(function (s) {
      app_share.shares = {};
      for (var i in s) {
        console.log(i);
        var t = s[i];
        app_share.shares[t.id] = t;
        mui.toast("shares===" + t.id + "  >  " + t);
        alert(t.id + "  >  " + t);
      }
      console.log(app_share.shares['weixin']);
      alert(app_share.shares['weixin']);
    }, function (e) {
      mui.toast("无享服务！");
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
    function () {
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
    mui.toast("无效的分享服务！");
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
      console.log("认证授权失败：" + e.code + " - " + e.message);
    });
  }
};


/**
 * 分享内容或者链接
 * @param  {JSON} msgdata 分享数据的对象
 * @param  {Boolean} ishref  是否分享链接
 */
app_share.appshare = function (msgdata, ishref) {
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

  console.log("ssss==" + ss.nativeClient);
  mui.toast("ss.nativeClient==" + ss.nativeClient);

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
  console.log("shareBts.length===" + shareBts.length);
  mui.toast("shareBts.length===" + shareBts.length);
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

$(document).ready(function() { app_share.init(); });

/**微信分享 end**/