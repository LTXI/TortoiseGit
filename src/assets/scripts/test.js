if ('sinaweibo' == s.id) {
  if (plus.os.name == "Android") {
    mui.toast("下载图片中，即将打开新浪微博分享...");
    var dtask = plus.downloader.createDownload();
    var localPictures = '';

    function onStateChanged(d, status) {
      switch (d.state) {
        case 4:
          if (status == 200) {
            console.log("图片下载完成：" + d.filename);
            localPictures = plus.io.convertLocalFileSystemURL(d.filename);
            msg.thumbs = [localPictures];
            msg.pictures = [localPictures];
            sendMessage();
          } else {
            mui.toast("下载图片失败");
          }
          break;
        case 1:
          console.log("下载开始");
          break;
        case 2:
          console.log("请求已响应");
          break;
        case 3:
          console.log("下载进行中");
          break;
        default:
          console.log("state: " + d.state);
          break;
      }
    }

    mui.each(msg.pictures, function (i, n) {
      var dtask = plus.downloader.createDownload(n);
      dtask.addEventListener("statechanged", onStateChanged, false);
      dtask.start();
    });
  }
}else{

}