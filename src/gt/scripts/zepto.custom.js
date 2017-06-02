App.priceFormat = function(price) {
	return '<span>￥</span>' + parseFloat(price).toFixed(2);
}

App.increase = function(){
	var item_id = arguments[0] ? parseInt(arguments[0]) : 0;
	var item_type = arguments[1] ? parseInt(arguments[1]) : 0;
	//if (item_type == 1) {

	//} else {
		var itemNumber = $('#goods-number-id-'+item_id).find("input[name='number']");
		var original = parseInt(itemNumber.val());
		var storageEvent = $('#goods-storage-'+item_id);
		
		if (storageEvent) {
			var storageNumber = parseInt(storageEvent.html());
			if ((original + 1) > storageNumber) {
				if (storageNumber > 0) {
					itemNumber.val(storageNumber);
				} else {
					itemNumber.val(original);
				}
				App.showMessage('商品库存不足');
			} else {
				itemNumber.val((original + 1));
			}
			//itemNumber.val(((original + 1) > storageNumber) ? storageNumber : (original + 1));
		} else {
			itemNumber.val(original + 1);
		}
	//}
	App.changePrice(item_id, item_type);
}

App.decrease = function(){
	var item_id = arguments[0] ? parseInt(arguments[0]) : 0;
	var item_type = arguments[1] ? parseInt(arguments[1]) : 0;
	//if (item_type == 1) {

	//} else {
		var itemNumber = $('#goods-number-id-'+item_id).find("input[name='number']");
		var original = parseInt(itemNumber.val());
		if (original > 1) {
			itemNumber.val((original - 1));
		} else {
			itemNumber.val('1');
		}
	//}
	App.changePrice(item_id, item_type);
}

App.changePrice = function() {
	var item_id = arguments[0] ? parseInt(arguments[0]) : 0;
	var item_type = arguments[1] ? parseInt(arguments[1]) : 0;

	var itemEvent = $('#goods-number-id-'+item_id).find("input[name='number']");
	var itemNumber = parseInt(itemEvent.val());

	if (item_type == 1) {
		App.load('m=cart&a=change', {'rec_id':item_id, 'goods_number':itemNumber}, 'POST');
	} else {
		var originalPrice = $('#ECS_GOODS_ORIGINAL').val();
		var selectVolume = $('#ECS_GOODS_VOLUME').find("select[name='volumepricelist'] option");
		var volumeFrice = 0;
		if (selectVolume.length) {
			selectVolume.each(function(){
				if (itemNumber >= $(this).val()) {
					volumeFrice = $(this).text();
				}
			});
		}

		var finalPrice = volumeFrice > 0 ? parseFloat(Math.min(originalPrice,volumeFrice)) : parseFloat(originalPrice);
		//var storage = parseInt($('#ECS_GOODS_STORAGE').html());

		var radioInputs = $('.spec-option').find('input[type=radio]');
		if (radioInputs.length) {
			for (var i = 0; i < radioInputs.length; i ++ ) {
				if (radioInputs[i].checked) {
					finalPrice = parseFloat(finalPrice + parseFloat(radioInputs[i].value.split(':')[1]));
				}
			}
		}

		var checkboxInputs = $('.spec-option').find('input[type=checkbox]');
		if (checkboxInputs.length) {
			for (var j = 0; j < checkboxInputs.length; j ++ ) {
				if (checkboxInputs[j].checked) {
					finalPrice = parseFloat(finalPrice + parseFloat(checkboxInputs[j].value.split(':')[1]));
				}
			}
		}

		var finalNumber = itemNumber;
		itemEvent.val(finalNumber);

		var integral = $(document.body).find("input[name='integral']");
		if (integral.length) {
			var integral_val = integral.val();
			$('#ECS_GOODS_INTEGRAL').html((integral_val * itemNumber));
			$('#ECS_GOODS_AMOUNT').html(App.priceFormat(finalPrice));
		} else {
			$('#ECS_GOODS_AMOUNT').html(App.priceFormat(finalPrice));
		}
		//$('#ECS_GOODS_TOTAL').html(App.priceFormat(finalPrice*finalNumber));
	}
}

App.addToCart = function() {
	var params = {};

	params.goods_id = arguments[0] ? parseInt(arguments[0]) : 0;
	params.buynow = arguments[1] ? parseInt(arguments[1]) : 0;
	params.parent_id = arguments[2] ? parseInt(arguments[2]) : 0;
	params.number = parseInt($('.goods-num').find("input[name='number']").val());
	params.quick = 1;
	var spec = 0;
	var radioInputs = $('.spec-option').find('input[type=radio]');
	for (var i = 0; i < radioInputs.length; i ++ ) {
		if (radioInputs[i].checked) {
			spec = spec + '-' + parseInt(radioInputs[i].value.split(':')[0]);
		}
	}

	var checkboxInputs = $('.spec-option').find('input[type=checkbox]');
	for (var j = 0; j < checkboxInputs.length; j ++ ) {
		if (checkboxInputs[j].checked) {
			spec = spec + '-' + parseInt(checkboxInputs[j].value.split(':')[0]);
		}
	}
	params.spec = spec;

	params.referer = App.getHash();

	App.ajax('m=cart&a=add', params, 'POST');
}

// 取消关注（1）收藏（2）足迹（3）
App.deleteCollect = function(rec_id,type) {
	if (rec_id > 0) {
		App.load('m=user&c=attention&a=delete', {'rec_id' : rec_id,'type' :type}, 'POST');
				
	}
}

//收藏1,关注2
App.collect = function(elem, goods_id,type){
	var checkout = 0;
	if(type==1){
		if ($(elem).hasClass('icon-star')) {
			$(elem).attr('class','icon-star-empty collect-empty');
		} else {
			$(elem).attr('class','icon-star collect');
			checkout = 1;
		}
	}
	if(type==2){
		if ($(elem).hasClass('icon-heart')) {
			$(elem).attr('class','icon-heart-empty attention-empty');
		} else {
			console.log(1111);
			$(elem).attr('class','icon-heart attention');
			checkout = 1;
		}
	}
	console.log(checkout+''+type);		
	App.load('m=goods&a=collectGoods', {'goods_id': goods_id, 'checkout': checkout, 'type': type}, 'POST');

}

// 移除购物车商品
App.removeFromCart = function(rec_id) {
	if (rec_id > 0) {
		App.load('m=cart&a=remove', {'rec_id' : rec_id}, 'POST');
	}
}

// 购物车商品选择
App.cartCheck = function(elem) {
	var parent = $(elem).parent();

	var itemNum = $('.cart-section .goods').length;
	var checkNum = $('.cart-section .selected').length;

	if (parent.hasClass('goods')) {
		parent.toggleClass('selected');

		checkNum = $('.cart-section .selected').length;
		if (checkNum == itemNum) {
			$('.cart-check').addClass('selected');
		} else {
			$('.cart-check').removeClass('selected');
		}
	} else if(parent.hasClass('cart-check')) {
		if (checkNum == itemNum) {
			parent.removeClass('selected');
			$('.cart-section .goods').removeClass('selected');
		} else {
			parent.addClass('selected');
			$('.cart-section .goods').addClass('selected');
		}
	} else {
		return false;
	}


	var number_total = 0;
	var price_total = 0;
	var integral_total = 0;
	$('.cart-section .selected').each(function(){
		var price = $(this).data('price') || 0;
		var num = $(this).data('num') || 1;
		var integral = $(this).data('integral') || 0;
		number_total += num;
		price_total += price * num;
		integral_total += integral;
	});

	$('#totalPrice').html(App.priceFormat(price_total));
	$('#totalIntegral').html(integral_total);

	$('#totalNum').html('('+number_total+'件)');

	if (number_total) {
		$('#shopCartConfirm').removeClass('disabled');
	} else {
		$('#shopCartConfirm').addClass('disabled');
	}
}

// 记录结算商品序号
App.checkout = function() {
	var rec_ids = new Array();

	if (arguments[0]) {
		rec_ids.push(parseInt(arguments[0]));
	} else {
		$('.cart-section .selected').each(function(){
			rec_ids.push($(this).data('id'));
		});
	}

	//console.log(goods_ids);
	App.load('m=cart&a=checknum', {'rec_ids' : rec_ids}, 'POST');
}

// 表单提交
App.submit = function() {
	var params = {};
	var form_name = arguments[0] ? arguments[0] : '';
	var form_elem;
	if (form_name) {
		form_elem = $(document.body).find("form[name='"+form_name+"']");
	} else {
		form_elem = $(document.body).find('form').first();
	}

	if (!form_elem.length) {
		return false;
	}

	var inputs = form_elem.find('[name]');
	for (i = 0; i < inputs.length; i ++ )
	{
		var elem = inputs[i];
		if (elem.type == 'radio' || elem.type == 'checkbox') {
			if (elem.checked) {
				params[elem.name] = elem.value;
			}
		} else {
			params[elem.name] = elem.value;
		}
	}

	var from_action = form_elem.data('action') || form_elem.attr('action');
	var from_method = form_elem.attr('method');
	
	App.load(from_action, params, from_method);
	return false;
}

App.toggle = function(elem) {
	var toggle;
	if ($(elem).hasClass('list')) {
		$('.content-list.pro_list').removeClass('pro_type_list').addClass('pro_type_grid');
		$(elem).removeClass('list');
		toggle = 'grid';
	} else {
		$('.content-list.pro_list').removeClass('pro_type_grid').addClass('pro_type_list');
		$(elem).addClass('list');
		toggle = 'list';
	}

	App.ajax('m=category&a=toggle', {'toggle' : toggle}, 'POST');
}

App.filter = function(elem) {
	var params = {};
	params.order = $(elem).data('order');
	params.sort = $(elem).data('sort');
	params.sign = App.getHash();

	App.load('m=category&a=filter', params, 'POST');
}

App.regionChanged = function(region_elem, region_type, region_name) {
	var region_id = $(region_elem).find('option').not(function(){ return !this.selected }).val();

	var option = $('<option>').val(0).text('请选择');

	$('#'+region_name+'').empty().append(option);

	if (region_type == 2) {
		$('#district').empty().append(option);
	}
	
	App.ajax('m=user&a=changeregion', {'region_id': region_id, 'region_type': region_type, 'region_name': region_name}, 'POST');
}

App.changTotal = function(){
	var $content = $('.page-content');
	var total_fee = 0;

	var goods_fee = 0;
	var goods = $content.find("input[name='goods_fee']");
	if (goods.length) {
		goods_fee = parseFloat(goods.val());
	}

	var shipping_fee = 0;
	//var shipping = jm.content.find("input[name='shipping']:checked");
	var shipping = $content.find("input[name='shipping']");
	if (shipping.length) {
		var shipping_hidden = $content.find("input[name='shipping_"+shipping.val()+"']");
		if (shipping_hidden.length) {
			shipping_fee = parseFloat(shipping_hidden.val());
		}
	}

	var pack_fee = 0;
	var pack = $content.find("input[name='pack']:checked");
	if (pack.length) {
		var pack_hidden = $content.find("input[name='"+pack.attr('id')+"']");
		if (pack_hidden.length) {
			pack_fee = parseFloat(pack_hidden.val());
		}
	}

	var card_fee = 0;
	var card = $content.find("input[name='card']:checked");
	if (card.length) {
		var card_hidden = $content.find("input[name='"+card.attr('id')+"']");
		if (card_hidden.length) {
			card_fee = parseFloat(card_hidden.val());
		}
	}

	var payment_fee = 0;
	var payment = $content.find("input[name='payment']:checked");
	if (payment.length) {
		var payment_hidden = $content.find("input[name='"+payment.attr('id')+"']");
		if (payment_hidden.length) {
			payment_fee = parseFloat(payment_hidden.val());
		}
	}

	var pay_integral = 0;
	var integral = $content.find("input[name='integral']");
	if (integral.length) {
		if (integral.is(':checked')) {
			pay_integral = parseFloat(integral.val());
		}
	}

	$('#pay_integral').remove();
	if (pay_integral > 0) {
		var elem_html = '';
		elem_html = '<div class="s-item" id="pay_integral">';
		elem_html += '<div class="sitem-l">积分抵扣</div>';
		elem_html += '<div class="sitem-r">-'+App.priceFormat(pay_integral)+'</div>';
		elem_html += '</div>';
		$('#price_list_wrapper').append(elem_html);
	}

	var wechat_card_fee = 0;
	var wechat_card = $content.find("input[name='wechat_card_fee']");
	if (wechat_card.length) {
		wechat_card_fee = parseFloat(wechat_card.val());
	}

	$('#pay_wechat_card').remove();
	if (wechat_card_fee > 0) {
		var elem_html = '';
		elem_html = '<div class="s-item" id="pay_wechat_card">';
		elem_html += '<div class="sitem-l">微信卡券</div>';
		elem_html += '<div class="sitem-r">-'+App.priceFormat(wechat_card_fee)+'</div>';
		elem_html += '</div>';
		$('#price_list_wrapper').append(elem_html);
	}

	var discount_fee = 0;
	var discount = $content.find("input[name='discount']");
	if (discount.length) {
		discount_fee = parseFloat(discount.val());
	}

	$('#pay_discount').remove();
	if (discount_fee > 0) {
		var elem_html = '';
		elem_html = '<div class="s-item" id="pay_discount">';
		elem_html += '<div class="sitem-l">优惠折扣</div>';
		elem_html += '<div class="sitem-r">-'+App.priceFormat(discount_fee)+'</div>';
		elem_html += '</div>';
		$('#price_list_wrapper').append(elem_html);
	}


	total_fee = (goods_fee + pack_fee + card_fee + shipping_fee + payment_fee - pay_integral - wechat_card_fee - discount_fee);

	if (total_fee < 0) {
		total_fee = 0;
	}

	$('#price_total_final').html(App.priceFormat(total_fee));
	return false;
}

App.refresh = function() {
	var hash = App.getHash();;
	App.ajax(hash);
}


App.getSmsCode = function(flag) {
	var loginElem = $('.auth_area');
	var re = /^(1[34578][0-9]{9})$/;
	if (loginElem.length) {
		var mobile = loginElem.find("input[name='mobile']").val();
		if (mobile == '') {
			App.dialog.show('notice', '请填写您的手机号！', [], 2000);
			return false;
		}
		if (!re.test(mobile)) {
			App.dialog.show('notice', '请填写正确的手机号！', [], 2000);
			return false;
		}

		App.ajax('m=user&c=account&a=sendsms', {'mobile':mobile, 'sendtype':flag}, 'POST');
		App.smsSended(60, flag);
	}
}

//转让积分手机验证
App.getSmsCodeByMF = function(mobile,flag) {
	var loginElem = $('.auth_area');
	if (loginElem.length) {
		App.ajax('m=user&c=account&a=sendsms', {'mobile':mobile, 'sendtype':flag}, 'POST');
		App.smsSended(60, flag);
	}
}

App.smsSended = function(timeout, flag){
	if (timeout <= 0) {
		$('#reFetch').attr('onclick', 'App.getSmsCode(\''+flag+'\');')
		$('#reFetch').removeClass('btn-gray').addClass('btn-red');
		$('#reFetch').html('获取短信验证码');
		return false;
	}

	$('#reFetch').attr('onclick', 'javascript:void(0);')
	$('#reFetch').removeClass('btn-red').addClass('btn-gray');
	$('#reFetch').html(timeout + 's');

	timeout--;

	setTimeout('App.smsSended('+timeout+', \''+flag+'\')', 1000);
}

App.getVerifyCode = function(flag, type) {
	var params = {};
	var loginElem = $('.auth_area');
	var re = /^(1[34578][0-9]{9})$/;
	if (loginElem.length) {
		var mobileElem = loginElem.find("input[name='mobile']");
		if (mobileElem.length) {
			params.moblie = mobileElem.val();
			if (params.moblie == '') {
				App.dialog.show('notice', '请填写您的手机号！', [], 2000);
				return false;
			}
			if (!re.test(params.moblie)) {
				App.dialog.show('notice', '请填写正确的手机号！', [], 2000);
				return false;
			}
		}

		params.sendflag = flag;
		params.sendtype = type;

		//App.ajax('m=user&c=account&a=sendVerifyCode', params, 'POST');
		App.verifyCodeSended(60, flag, type);
	}
}

App.verifyCodeSended = function(timeout, flag, type){
	var code_btns = $('.auth_area .code_btn');
	for (var i = 0; i < code_btns.length; i ++ ) {
		var code_btn = $(code_btns[i]);

		var dType = code_btn.data('type');

		code_btn.attr('onclick', 'javascript:void(0);')
		code_btn.removeClass('btn-red').addClass('btn-gray');
		code_btn.html(timeout + 's');

		if (timeout <= 0) {
			code_btn.attr('onclick', 'javascript:App.getVerifyCode(\''+flag+'\', \''+dType+'\');')
			//code_btn.removeClass('btn-gray').addClass('btn-red');
			code_btn.removeClass('btn-gray');
			code_btn.html(dType == 'voice' ? '发送语音' : '发送短信');
		}
	}

	if (timeout > 0) {
		timeout--;
		setTimeout('App.verifyCodeSended('+timeout+', \''+flag+'\', \''+type+'\')', 1000);
	}
}

App.addCard = function(data) {
	wx.addCard({
		cardList: [{
			cardId: data.cardId,
			cardExt: '{"code": "", "openid": "", "timestamp": "'+data.timestamp+'", "nonce_str": "'+data.nonce_str+'", "signature":"'+data.signature+'"}'
		}],
		success: function (res) {
			/*
			alert('已添加卡券：' + JSON.stringify(res.cardList));
			res.cardList = JSON.parse(res.cardList);
			var wxcard_id = res.cardList[0]['card_id'];
			var wxcard_code = res.cardList[0]['card_code'];
			App.load('m=user&c=activity&a=giftcardupdate', {'card_id': card_id, 'wxcard_id': wxcard_id, 'wxcard_code': wxcard_code}, 'POST');
			*/
			App.dialog.show('success', '礼券已经成功放入微信卡包！', [{'name':'确定', 'href':'javascript:App.ajax(App.getHash());'}]);
		},
		cancel: function (res) {
			App.load('m=user&c=activity&a=removeWxCardId', {'card_id': data.card_id}, 'POST');
			//alert(JSON.stringify(res))
		}
	});
}

App.openCard = function(wxCardId, wxCardCode) {
	wx.openCard({
		cardList: [{
			cardId: wxCardId,
			code: wxCardCode
		}],
		cancel: function (res) {
			alert(JSON.stringify(res))
		}
	});
}

App.chooseCard = function(data) {
	/*
	var cardType = $(elem).find("input[name='cardType']").val();
	var timestamp = $(elem).find("input[name='timestamp']").val();
	var nonceStr = $(elem).find("input[name='nonceStr']").val();
	var cardSign = $(elem).find("input[name='cardSign']").val();
	*/
	wx.chooseCard({
		/*shopId: '',
		cardId: '',
		cardType: data.cardType,*/
		timestamp: data.timestamp,
		nonceStr: data.nonceStr,
		signType: 'SHA1',
		cardSign: data.cardSign,
		success: function (res) {
			res.cardList = JSON.parse(res.cardList);
			card_id = res.cardList[0]['card_id'];
			encrypt_code = res.cardList[0]['encrypt_code'];
			App.load('m=cart&a=selectCard', {'card_id': card_id, 'encrypt_code': encrypt_code}, 'POST');
			/*
			jm.parseCard(res.cardList[0]);
			card_id = res.cardList[0]['card_id'];
			encrypt_code = res.cardList[0]['encrypt_code'];
			
			res.cardList = JSON.parse(res.cardList);
			encrypt_code = res.cardList[0]['encrypt_code'];
			alert('已选择卡券：' + JSON.stringify(res.cardList));
			decryptCode(encrypt_code, function (code) {
				codes.push(code);
			});
			*/
		}
	});
}

App.search = function() {
	var text = $('#topSearchTxt').val();
	if (text == '') {
		return false;
	}
	window.location.hash = '#m=search&keyword='+encodeURI(text);
}

//寻找招募会员
App.searchOne = function() {
	var text = $('#topSearchTxt').val();
	if (text == '') {
		return false;
	}
	window.location.hash = '#m=user&c=agentpush&a=find&name='+encodeURI(text);
}

// 对会员发起招募
App.agentInvite = function(obj_id,type=1) {
	if (obj_id > 0) {
		App.load('m=user&c=agentpush&a=agentInvite', {'obj_id' : obj_id,'type' : type}, 'POST');	
	}
}

// 会员对发起的招募进行处理
App.agentDeal = function(inv_id,type) {
	if (inv_id > 0) {
		App.load('m=user&c=agentpush&a=deal', {'inv_id' : inv_id,'type' : type}, 'POST');	
	}
}

App.fromesbClose = function() {
	$('#fromesb-wechat').remove();
	App.ajax('m=user&a=fromesbClose');
}

App.gonggaoClose = function() {
	$('#fromesb-guanggao').remove();
	App.ajax('m=user&a=gonggaoClose');
}

App.WXPay = function(data) {
	wx.chooseWXPay({
		timestamp: data.timeStamp,
		nonceStr: data.nonceStr,
		package: data.package,
		signType: data.signType,
		paySign: data.paySign,
		success: function (res) {
			switch(res.err_msg) {
				case 'get_brand_wcpay_request:ok':
					if (data.respond) {
						var hash = App.getHash();
						if (hash == data.respond) {
							App.ajax(data.respond, {}, 'GET');
						} else {
							window.location.hash = '#'+data.respond;
						}
						return false;
					}
					break;
				case 'get_brand_wcpay_request:fail':
					alert('错误：'+res.err_desc);
					break;
				case 'get_brand_wcpay_request:cancel':
				default:
					break;
			}
		}
	});
	/*
	WeixinJSBridge.invoke(
		'getBrandWCPayRequest', {
			'appId' : data.content.appId,
			'timeStamp' : data.content.timeStamp,
			'nonceStr' : data.content.nonceStr,
			'package' : data.content.package,
			'signType' : data.content.signType,
			'paySign' : data.content.paySign
		},
		function(res) {
			switch(res.err_msg) {
				case 'get_brand_wcpay_request:ok':
					if (data.respond) {
						var hash = jm.hash.replace(/^#/,"");
						if (hash == data.respond) {
							jm.request(data.respond, 'GET', {});
						} else {
							window.location.hash = '#'+data.respond;
						}
						return false;
					}
					break;
				case 'get_brand_wcpay_request:fail':
					alert('错误：'+res.err_desc);
					break;
				case 'get_brand_wcpay_request:cancel':
				default:
					break;
			}
			WeixinJSBridge.log(res.err_msg);
			alert(res.err_code+res.err_desc+res.err_msg);
		}
	);*/
}

App.goodsChange = function(event){
	var mParent = $(event).parent();
	if (mParent.hasClass('show')) {
		mParent.removeClass('show');
	} else {
		mParent.addClass('show');
	}
}

/* *
 * 给定一个剩余时间（s）动态显示一个剩余时间.
 * 当大于一天时。只显示还剩几天。小于一天时显示剩余多少小时，多少分钟，多少秒。秒数每秒减1 *
 */

// 初始化变量
var auctionDate = 0;
var _GMTEndTime = 0;
var showTime = "leftTime";
var _day = 'day';
var _hour = 'hour';
var _minute = 'minute';
var _second = 'second';
var _end = 'end';

var cur_date = new Date();
var startTime = cur_date.getTime();
var Temp;
var timerID = null;
var timerRunning = false;

function showtime()
{
	now = new Date();
	var ts = parseInt((startTime - now.getTime()) / 1000) + auctionDate;
	var dateLeft = 0;
	var hourLeft = 0;
	var minuteLeft = 0;
	var secondLeft = 0;
	var hourZero = '';
	var minuteZero = '';
	var secondZero = '';
	if (ts < 0) {
		ts = 0;
		CurHour = 0;
		CurMinute = 0;
		CurSecond = 0;
	} else {
		dateLeft = parseInt(ts / 86400);
		ts = ts - dateLeft * 86400;
		hourLeft = parseInt(ts / 3600);
		ts = ts - hourLeft * 3600;
		minuteLeft = parseInt(ts / 60);
		secondLeft = ts - minuteLeft * 60;
	}

	if (hourLeft < 10) {
		hourZero = '0';
	}
	if (minuteLeft < 10) {
		minuteZero = '0';
	}
	if (secondLeft < 10) {
		secondZero = '0';
	}

	if (dateLeft > 0) {
		Temp = dateLeft + _day +' '+ hourZero + hourLeft + _hour +' ' + minuteZero + minuteLeft + _minute +' ' + secondZero + secondLeft + _second;
	} else {
		if (hourLeft > 0) {
			Temp = hourLeft + _hour +' ' + minuteZero + minuteLeft + _minute +' ' + secondZero + secondLeft + _second;
		} else {
			if (minuteLeft > 0) {
				Temp = minuteLeft + _minute +' ' + secondZero + secondLeft + _second;
			} else {
				if (secondLeft > 0) {
			  Temp = secondLeft + _second;
				} else {
			  Temp = '';
				}
			}
		}
	}

	if (auctionDate <= 0 || Temp == '') {
		Temp = "<strong>" + _end + "</strong>";
		stopclock();
	}

	if (document.getElementById(showTime)) {
		document.getElementById(showTime).innerHTML = Temp;
	}

	timerID = setTimeout("showtime()", 1000);
	timerRunning = true;
}

var timerID = null;
var timerRunning = false;
function stopclock()
{
	if (timerRunning) {
	clearTimeout(timerID);
	}
	timerRunning = false;
}

function macauclock()
{
	stopclock();
	showtime();
}

function onload_leftTime(now_time)
{
	/* 第一次运行时初始化语言项目 */
	try {
		_GMTEndTime = gmt_end_time;
		// 剩余时间
		_day = day;
		_hour = hour;
		_minute = minute;
		_second = second;
		_end = end;
	} catch (e) {}

	if (_GMTEndTime > 0) {
		if (now_time == undefined) {
			var tmp_val = parseInt(_GMTEndTime) - parseInt(cur_date.getTime() / 1000 + cur_date.getTimezoneOffset() * 60);
		} else {
			var tmp_val = parseInt(_GMTEndTime) - now_time;
		}
		if (tmp_val > 0) {
			auctionDate = tmp_val;
		}
	}

	macauclock();
	try {
		initprovcity();
	} catch (e) {}
}
