 <title>@@title</title>
 <meta charset="utf-8">
 <!--指定浏览器内核，主要针对360等双核浏览器-->
 <meta name="renderer" content="webkit">
 <!-- 优先使用 IE 最新版本和 Chrome -->
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
 <!-- 360浏览器 开启急速模式-->
<meta name="renderer" content="webkit">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0 user-scalable=no"">
<!-- 页面描述 -->
<meta name="description" content="不超过150个字符">
<!-- 页面关键词 -->
<meta name="keywords" content="">
<!-- 网页作者 -->
<meta name="author" content="name, email@gmail.com">
 <!-- 搜索引擎抓取 -->
 <meta name="robots" content="all">
<!--WebApp全屏模式   隐藏地址栏。-->
 <meta content="yes" name="apple-mobile-web-app-capable">
 <!--制定iphone中safari顶端的状态条的样式（default:白色，black:黑色，black-translucent：半透明）-->
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<!--忽略页面中的数字识别为电话号码-->
<meta name="format-detection" content="telephone=no">
<!--同样还有一个email识别-->
<meta name="format-detection" content="email=no">
<!--当然两者可以写在一起-->
<meta name="format-detection" content="telphone=no, email=no">
<meta name="HandheldFriendly" content="true>
<!--强制百度跳转进入原网页，不对站点进行转码-->
<meta http-equiv="Cache-Control" content="no-siteapp">
<!--图标icon-->
<!--<link rel="shortcut icon" type="image/ico" href="E:/work/yunshop/dist/favicon.ico"/>-->
<!--iso系统图标默认的图标-->
<link rel="apple-touch-icon" href="icon-57.png"/>
<!--iso系统图标默认的圆角和高亮效果修改-->
<link rel="apple-touch-icon-precomposed" href="icon-57.png"/>
<!--计算font-size-->
<script >
document.addEventListener('DOMContentLoaded', function () {
(function initFontSize() {
		var resizeEvent = 'orientationchange' in window ? 'orientationchange' : 'resize';

		function changeSize() {
			const designWidth = 640; //设计稿尺寸是640px
			const designWidth2 = 1080;
			var html = document.documentElement; //根元素
			var deviceWidth = html.clientWidth; //屏幕逻辑宽度
			var base = 100;

			if (deviceWidth > designWidth2) {
				deviceWidth = designWidth2;
			}
			html.style.fontSize = (deviceWidth / designWidth) * base + "px";
			//console.log(html.style.fontSize);
			//alert(html.style.fontSize+"==="+deviceWidth); 
		}
		changeSize();
		window.addEventListener(resizeEvent, changeSize, false);
	})();
});
</script>

