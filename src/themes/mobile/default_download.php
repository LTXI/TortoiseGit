<?php defined('JQ_EXEC') or die; ?>
    <link rel="stylesheet" href="<?php echo JQ_URL; ?>styles/download.css">
	
	<div class="wrapper">
    <!--内容区-->
        <div class="content">
        <!--头部 logo-->
            <div class="header">
            <div class="help">
                <a href="http://e.jmtop.com/help/index.html">(未受信任问题 点击进入)</a>
                <span class="handicon"></span>
            </div>
                <i class="headerimgbox"></i>
                <div class="titlebox">
                    <p class="title">九件事--测试版</p>
                </div>
                
            </div>
            
            <div class="btnbox">
                    <div class="btn firstbtn">
                    <a href="itms-services://?action=download-manifest&url=https://git.oschina.net/liutx/nineneeds/raw/master/nineneeds-agency.plist" target="_blank">
                        <img src="<?php echo JQ_URL; ?>images/download/ios.png">
                    </a>
                    </div>
                    <div class="btn">
                    <a href="http://vshop.guaten.com/appdownload/nine.apk" target="_blank">
                        <img src="<?php echo JQ_URL; ?>images/download/android.png">
                    </a>
                    </div>
            </div>
            <div class="main">
                <i class="mainimgbox"></i>
            </div>
        </div>      
    </div>
<!--微信打开提示-->
    <div class="mask_wrapper" id="mask_wrapper">
        <img src="<?php echo JQ_URL; ?>images/download/open.png" class="open"></p>
    </div>
<!--横屏打开提示-->
    <div class="warn-wp">
        <div class="warn-con">
           <i class="warn-icon"></i>
          <p>为了更好的体验，请使用竖屏浏览</p>
      </div>
    </div>

<script>
$(function(){
  isWeiXin();
	function isWeiXin() {
		var ua = window.navigator.userAgent.toLowerCase();
		if (ua.match(/MicroMessenger/i) == 'micromessenger') {
			document.getElementById("mask_wrapper").style.display = "block";
		}
	};
	(function(doc) {
		function addRootTag() {
			doc.documentElement.className += " webps";
		}
		if (!/(^|;\s?)webps=A/.test(document.cookie)) {
			var image = new Image();
			image.onload = function() {
				if (image.width == 1) {
					addRootTag();
					document.cookie = "webps=A; max-age=31536000; ";
				}
			};
			image.src = 'data:image/webp;base64,UklGRkoAAABXRUJQVlA4WAoAAAAQAAAAAAAAAAAAQUxQSAwAAAARBxAR/Q9ERP8DAABWUDggGAAAABQBAJ0BKgEAAQAAAP4AAA3AAP7mtQAAAA==';
		} else {
			addRootTag();
		}
	}(document));
});
</script>
	