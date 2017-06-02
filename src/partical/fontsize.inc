<script >
document.addEventListener('DOMContentLoaded', function () {
(function initFontSize() {
		var resizeEvent = 'orientationchange' in window ? 'orientationchange' : 'resize';

		function changeSize() {
			const designWidth = 750; //设计稿尺寸是640px
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