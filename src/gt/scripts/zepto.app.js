var App = {};

// AJAX URL
App.baseurl = 'index.php';

// 是否首次加载
App.firstload = true;

// 当前页Hash
App.nowHash = location.hash.replace(/^#/, "");

// 实时获取Hash
App.getHash = function() { return location.hash.replace(/^#/, ""); }

// 监控Hash变化
App.hashChange = App.onHashChange;
App.onHashChange = function(func) {
	if (App.hashChange) {
		App.hashChange = function() {
			func(App.getHash());
		}
	} else {
		setTimeout(function change() {
			if (App.getHash() !== App.nowHash) {
				func(App.getHash());
				App.nowHash = App.getHash();
			}
			setTimeout(change, 50);
		}, 50);
	}
}

// 载入动画 状态
App.loading = {};
App.loading.completed = false;

// 显示 载入动画
App.loading.show = function() {
	if (!App.loading.completed) {
		if (!$('#loadingToast').length) {
			var weui_loading = $('<div />').addClass('weui_loading');
			for (var i=0, len=12; i<len; i++) {
				$('<div />').addClass('weui_loading_leaf').addClass('weui_loading_leaf_' + i).appendTo(weui_loading);
			}
			var weui_toast_content = $('<p />').addClass('weui_toast_content').text('数据加载中');
			var weui_toast = $('<div />').addClass('weui_toast').append(weui_loading).append(weui_toast_content);
			var weui_mask_transparent = $('<div />').addClass('weui_mask_transparent');
			var weui_loading_toast = $("<div />", {id : 'loadingToast'}).addClass('weui_loading_toast').append(weui_mask_transparent).append(weui_toast);
			$(document.body).append(weui_loading_toast);
		} else {
			$('#loadingToast').show();
		}
	}
}

// 关闭 载入动画
App.loading.close = function() {
	App.loading.completed = true;
	$('#loadingToast').remove();
}

// 消息弹窗
App.dialog = {};
App.dialog.show = function() {
	App.dialog.close();
	var type = arguments[0] ? arguments[0] : 'notice';
	var desc = arguments[1] ? arguments[1] : '请检查您访问的网址是否正确，如有任何意见或建议，请及时反馈给我们。';
	var btns = arguments[2] ? arguments[2] : [];
	var time = arguments[3] ? arguments[3] : 0;

	var mask = $('<div />').addClass('mask');
	var icon = $('<i />').addClass('icon');
	if (type && type != 'notice') {
		icon.addClass('icon_'+type);
	}

	var msg = $('<p />').html(desc);
	var content = $('<div />').addClass('content').append(icon).append(msg);
	if (btns.length) {
		var btn_area = $('<p />').addClass('btns');
		for(var i in btns) {
			var btn = $('<a />').addClass('btn').addClass('btn_' + i).attr('href', btns[i].href);
			if (btns[i].click) {
				btn.attr('onclick', btns[i].click);
			}
			btn.text(btns[i].name).appendTo(btn_area);
		}
		content.append(btn_area);
	}
	$('<div />').addClass('page-dialog').append(mask).append(content).appendTo($('body'));

	if (time > 0) {
		setTimeout(function(){
			App.dialog.close();
		}, time);
	}
}
App.dialog.close = function() {
	$('.page-dialog').remove();
}

// 消息提示
App.message = function() {
	var type = arguments[0] ? arguments[0] : 'success';
	var title = arguments[1] ? arguments[1] : '操作成功';
	var desc = arguments[2] ? arguments[2] : '';
	var btns = arguments[3] ? arguments[3] : [];

	var weui_icon_msg = $('<i />').addClass('weui_icon_'+type).addClass('weui_icon_msg');
	var weui_icon_area = $('<div />').addClass('weui_icon_area').append(weui_icon_msg);

	var weui_msg_title = $('<h2 />').addClass('weui_msg_title').text(title);
	var weui_msg_desc = $('<p />').addClass('weui_msg_desc').html(desc);
	var weui_text_area = $('<div />').addClass('weui_text_area').append(weui_msg_title).append(weui_msg_desc);

	var weui_btn_area = $('<p />').addClass('weui_btn_area');
	for(var i in btns) {
		$('<a />').addClass('weui_btn').addClass('weui_btn_' + btns[i].type).attr('href', btns[i].href).text(btns[i].name).appendTo(weui_btn_area);
	}
	var weui_opr_area = $('<div />').addClass('weui_opr_area').append(weui_btn_area);

	var weui_msg = $('<div />').addClass('weui_msg').append(weui_icon_area).append(weui_text_area).append(weui_opr_area);
	$('body').html(weui_msg);
}

// 载入页面
App.load = function() {
	var sign = arguments[0] ? arguments[0] : '';
	var params = arguments[1] ? arguments[1] : {};
	var method = (arguments[2] && arguments[2].toUpperCase() == 'POST') ? 'POST' : 'GET';
	var callback = arguments[3] ? arguments[3] : '';

	var hash = App.getHash();

	// 加载动画延迟显示
	App.loading.completed = false;
	setTimeout(function(){ App.loading.show(); }, 300);

	App.ajax(sign, params, method, callback);
}

// 默认页码
App.page = App.pages = 1;

// AJAX请求
App.ajax = function() {
	var sign = arguments[0] ? arguments[0] : '';
	var params = arguments[1] ? arguments[1] : {};
	var method = (arguments[2] && arguments[2].toUpperCase() == 'POST') ? 'POST' : 'GET';
	var callback = arguments[3] ? arguments[3] : '';

	var search_params = window.location.search;
	if (search_params) {
		params.search_params = search_params;
	}

	$.ajax({
		type    : method,
		url     : sign ? App.baseurl + '?' + sign : App.baseurl,
		data    : params,
		dataType: 'json',
		timeout : 30000,
		error   : App.ajaxError,
		success : (callback ? callback : App.ajaxSuccess)
	});
}

// AJAX请求失败
App.ajaxError = function(XMLHttpRequest, textStatus, errorThrown) {
	App.loading.close();
	/*
	alert(XMLHttpRequest.status);
	alert(XMLHttpRequest.readyState);
	alert(textStatus);
	*/
	var type = 'warn';
	var title = '错误';
	var desc = '';
	var btns = [];

	if (typeof XMLHttpRequest === 'number') {
		desc = textStatus;
	}

	if (typeof XMLHttpRequest === 'object') {
		switch(XMLHttpRequest.status) {
			case 200:
				title = textStatus = 'parsererror' ? '解析错误' : '未知错误';
				//desc = '<div style="text-align:left;">'+XMLHttpRequest.responseText+'</div>';
				desc = '请检查您访问的网址是否正确，如有任何意见或建议，请及时反馈给我们。';
				break;
			case 404:
				title = '页面不存在';
				desc = '请检查您访问的网址是否正确，如有任何意见或建议，请及时反馈给我们。';
				break;
			default:
				desc = '网络连接失败，请检查网络连接设置。';
				break;
		}
	}

	App.message(type, title, desc, btns);
}

// AJAX请求成功
App.ajaxSuccess = function(data) {
	if (!data) {
		return;
	}

	if (data.errcode && data.errcode > 0) {
		data.errmsg = data.errmsg || '未知错误';
		return App.ajaxError(data.errcode, data.errmsg);
	}
	// 关闭载入动画
	App.loading.close();

	// 是否首次加载
	if (App.firstload) {
		$('.screen-wrapper').remove();
		App.firstload = false;
	}

	// 回调操作
	data.handle = data.handle || 'none';

	App.page = data.page || 1;
	App.pages = data.pages || 1;

	// 按条件执行
	switch(data.handle) {
		case 'callback':
			if (data.target) {
				window.eval(data.target+'(('+JSON.stringify(data)+'))');
			}

			if (data.callback) {
				window.eval(data.callback);
			}
			break;
		case 'dialog':
			var type = data.type || '';
			var timeout = data.timeout || 0;
			var message = data.message || '';
			var btns = data.btns || [];
			
			App.dialog.show(type, message, btns, timeout);
			break;
		case 'redirect':
			if (data.target) {
				window.location.href = data.target;
				return;
			}

			if (data.redirect) {
				var hash = data.redirect.replace(/^#/, "");
				if (hash == App.getHash()) {
					App.ajax(hash, {}, 'GET');
				} else {
					window.location.hash = data.redirect;
				}
				return;
			}
			break;
		case 'element':
			if (data.title) {
				document.title = data.title;
			}

			App.element(data);

			if (data.page && data.page >1) {
				App.page = data.page;
				data.pages = data.pages || data.page;
				App.pages = data.pages > data.page ? data.pages : data.page;
				$('.loading-more').remove();
			} else {
				$('html, body').scrollTop(0);
			}

			if (data.callback) {
				var timeout = data.timeout || 0;
				setTimeout(function(){ window.eval(data.callback); }, timeout);
			}
			break;
		case 'none':
		default:
			break;
	}

	App.afterload();
}

// DOM 内容操作
App.element = function(data) {
	data.target = data.target || 'body';
	data.action = data.action || 'override';

	switch(data.action) {
		case 'append':
			if (data.content) {
				$(data.target).append(data.content);
			}
			break;
		case 'prepend':
			if (data.content) {
				$(data.target).prepend(data.content);
			}
			break;
		case 'override':
		default:
			if (data.content) {
				$(data.target).html(data.content);
			}
			break;
	}
}

// 参数初始化
App.preload = function() {
	var Dpr = 1, uAgent = window.navigator.userAgent;
	var isIOS = uAgent.match(/iphone/i);
	var isYIXIN = uAgent.match(/yixin/i);
	var is2345 = uAgent.match(/Mb2345/i);
	var ishaosou = uAgent.match(/mso_app/i);
	var isSogou = uAgent.match(/sogoumobilebrowser/ig);
	var isLiebao = uAgent.match(/liebaofast/i);
	var isGnbr = uAgent.match(/GNBR/i);
	var wWidth = (screen.width > 0) ? (window.innerWidth >= screen.width || window.innerWidth == 0) ? screen.width : window.innerWidth : window.innerWidth, wDpr, wFsize;
	var wHeight = (screen.height > 0) ? (window.innerHeight >= screen.height || window.innerHeight == 0) ? screen.height : window.innerHeight : window.innerHeight;
	if (window.devicePixelRatio) {
		wDpr = window.devicePixelRatio;
	} else {
		wDpr = isIOS ? wWidth > 818 ? 3 : wWidth > 480 ? 2 : 1 : 1;
	}
	if(isIOS) {
		wWidth = screen.width;
		wHeight = screen.height;
	}
	// if(window.orientation==90||window.orientation==-90){
	//     wWidth = wHeight;
	// }else if((window.orientation==180||window.orientation==0)){
	// }
	if(wWidth > wHeight){
		//wWidth = wHeight;
	}
	wFsize = wWidth > 1080 ? 144 : wWidth / 7.5;
	wFsize = wFsize > 32 ? wFsize : 32;
	window.screenWidth_ = wWidth;
	if (isYIXIN || is2345 || ishaosou || isSogou || isLiebao || isGnbr) {
		setTimeout(function(){
			wWidth = (screen.width > 0) ? (window.innerWidth >= screen.width || window.innerWidth == 0) ? screen.width : window.innerWidth : window.innerWidth;
			wHeight = (screen.height > 0) ? (window.innerHeight >= screen.height || window.innerHeight == 0) ? screen.height : window.innerHeight : window.innerHeight;
			wFsize = wWidth > 1080 ? 144 : wWidth / 7.5;
			wFsize = wFsize > 32 ? wFsize : 32;
			document.getElementsByTagName('html')[0].dataset.dpr = wDpr;
			document.getElementsByTagName('html')[0].style.fontSize = wFsize + 'px';
			//document.getElementById("fixed").style.display="none";
		}, 500);
	} else {
		document.getElementsByTagName('html')[0].dataset.dpr = wDpr;
		document.getElementsByTagName('html')[0].style.fontSize = wFsize + 'px';
		//document.getElementById("fixed").style.display="none";
	}
	/*
	if (!uAgent.match(/MicroMessenger/i) && (uAgent.match(/Windows NT/i) || uAgent.match(/Macintosh/i))) {
		window.location.href = 'http://www.guaten.com';
	}
	*/
	//alert("fz="+wFsize+";dpr="+window.devicePixelRatio+";UA="+uAgent+";width="+wWidth+";sw="+screen.width+";wiw="+window.innerWidth+";wsw="+window.screen.width+window.screen.availWidth);
}
App.preload();

App.loadmore = function() {
	if (App.page < App.pages) {
		if (!$('.page-content').find('.loading-more').length) {
			$('<div />').addClass('loading-more').html('<i></i>').appendTo($('.page-content'));
			App.ajax(App.getHash(), {page:(App.page+1)}, 'GET');
		}
	}
}

// 内容加载之后
App.afterload = function() {
	$('a[data-href]').off().on('click', function(e) {
		var href = this.dataset.href.replace(/^#/, "");
		var method = this.dataset.method || 'GET';
		var params = this.dataset.params || {};
		var callback = this.dataset.callback || '';

		App.load(href, params, method, callback);
		e.preventDefault();
	});

	$(document).on('scroll', function() {
		var scrollTop = document.documentElement.scrollTop | document.body.scrollTop;
		var iElem = $('.content-list');
		if (iElem.length) {
			var cHeight = window.innerHeight;
			var iHeight = $(document).height();
			var iPosition = iElem.position().top;

			var tHeight = scrollTop + iPosition;
			if (cHeight + scrollTop + 50 > iHeight) {
				App.loadmore();
			}
		}
		var sticky = $('#header-sticky');
		var fiexd = $('#sticky-warp');
		if (sticky.length && fiexd.length) {
			scrollTop >= sticky.offset().top ? fiexd.addClass('fixed') : fiexd.removeClass('fixed'); 
		}
	});

	if ($('#sticky-warp'.length)) {
		$('#sticky-warp div').click(function(){
			var index = $('#sticky-warp div').index(this);
			$('#sticky-warp div').removeClass('cur').eq(index).addClass('cur');
			var moveWidth = -100*index  + '%';
			$('.detail-list').css({
				'-moz-transform': 'translate('+moveWidth+',0)',
				'-webkit-transform':'translate('+moveWidth+',0)',
				'-o-transform':'translate('+moveWidth+',0)',
				'-ms-transform':'translate('+moveWidth+',0)',
				'transform':'translate('+moveWidth+',0)'
			});
			$('.goods-detial').height($('.detail-item').eq(index).height());
		});
	}

	if ($('.swiper-container').length) {
		App.swiper = [];
		$('.swiper-container').each(function(i){
			if ($(this).find('.swiper-wrapper').length) {
				var params = $(this).find('.swiper-wrapper').data('params');
				App.swiper[i] = $(this).swiper(params);
			}
		});
	}
}

// 页面初始化
App.init = function() {
	App.ajax(App.getHash());
}

// 监控Hash变化
App.onHashChange(function(getHash){
	App.load(getHash);
});

// 监控浏览器窗口
$(window).on('resize', function(){
	App.preload();
	App.afterload();
});

$(document).ready(function() { App.init(); });