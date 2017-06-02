'use strict'
$(function() {

	//font-size的取值要通过js计算
	/**
	 * 设计稿尺寸都是640px的，iphone5的deviceWidth是320px，那么计算出来的font-size值就是 320 / 640 = 0.5，
	 * 因为得出的font-size太小，不方便计算，且有的浏览器可能不兼容太小字号，所以将font-size放大100倍，
	 * 所以最终计算出来的font-size为 320 / 640 * 100 = 50(px) html.style.fontSize = windowWidth / 6.4 + 'px';;
	 */
	(function initFontSize() {
		var resizeEvent = 'orientationchange' in window ? 'orientationchange' : 'resize';

		function changeSize() {
			const designWidth = 640; //设计稿尺寸是640px
			var html = document.documentElement; //根元素
			var deviceWidth = html.clientWidth; //屏幕逻辑宽度
			var base = 100; //便于计算，扩大100倍

			if (deviceWidth > designWidth) {
				deviceWidth = designWidth;
			}
			html.style.fontSize = (deviceWidth / designWidth) * base + "px";
			//console.log(html.style.fontSize);
		}
		changeSize();
		window.addEventListener(resizeEvent, changeSize, false);
	})();
});