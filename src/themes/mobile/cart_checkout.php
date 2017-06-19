<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<?php
// 收货人信息
$consignee = '';
if (isset($this->consignee) && is_object($this->consignee)){
	$consignee .= '<li>';
	$consignee .= '<strong>'.$this->consignee->consignee.'</strong> ';
	$consignee .= $this->consignee->mobile;
	$consignee .= '</li>';
	$consignee .= '<li>'.$this->consignee->province_name.' '.$this->consignee->city_name.' '.$this->consignee->district_name.' '.$this->consignee->address.'</li>';
}

// 商品信息
$html_goods = '';
$goods_fee = 0;
if (isset($this->goods) && count($this->goods) > 0) {
	for ($i=0, $n=count($this->goods); $i<$n; $i++)
	{
		$row = &$this->goods[$i];
		$goods_fee += $row->goods_price * $row->goods_number;
		$html_goods .= '<li class="hproduct">';
		$html_goods .= '<img class="photo" src="'.fixImagePath($row->goods_thumb).'">';
		$html_goods .= '<div class="fn">'.$row->goods_name.'</div>';
		$html_goods .= '<p class="sku_coll">编号：'.$row->goods_sn.'</p>';
		$html_goods .= '<p class="sku_coll"><!--规格：-->'.$row->goods_attr.'</p>';
		$html_goods .= '<p class="sku_price">'.price_format($row->goods_price).'</p>';
		$html_goods .= '<p class="sku_count">×'.$row->goods_number.'</p>';
		$html_goods .= '</li>';
	}
}

// 配送信息
$input_shipping = '';
if (isset($this->shipping_list) && count($this->shipping_list) > 0) {
	for ($i=0, $n=count($this->shipping_list); $i<$n; $i++)
	{
		$row = &$this->shipping_list[$i];
		if ($row->shipping_id == $this->order->shipping_id){
			$input_shipping .= '<input type="hidden" name="shipping" value="'.$row->shipping_id.'">';
			$input_shipping .= '<input type="hidden" name="shipping_'.$row->shipping_id.'" value="'.$row->shipping_fee.'">';
		}
	}
}

// 积分信息
$html_integral = '';
$pay_integral = $this->pay_integral;
if (isset($this->allow_use_integral) && $this->allow_use_integral == 1 && $this->order_max_integral > 0 & $this->your_integral > 0){
	$html_integral .= '<li class="switch">';
	$html_integral .= '<input type="checkbox" id="integral" name="integral" value="'.$pay_integral.'" checked="true" onclick="javascript:App.changTotal();">';
	$html_integral .= '<label for="integral">';
	$html_integral .= '<div class="buy_dou">';
	$html_integral .= '<strong>'.JQ::config('integral_name').'</strong>';
	$html_integral .= '<span>共有<b>'.$this->your_integral.'</b>'.JQ::config('integral_name').'，';
	$html_integral .= '本单可用<b>'.$pay_integral.'</b>'.JQ::config('integral_name').'。</span>';
	$html_integral .= '</div>';
	$html_integral .= '<i></i>';
	$html_integral .= '</label>';
	$html_integral .= '</li>';
} else {
	$integral_text = '';
	if ($this->your_integral == 0){
			$integral_text .= '您没有'.JQ::config('integral_name').'，不可用';
	} else {
		if ($this->order_max_integral == 0){
			$integral_text .= '本订单不支持'.JQ::config('integral_name').'支付，不可用';
		} else {
			$integral_text .= JQ::config('integral_name').'余额不足，不可用</div>';
		}
	}
	$html_integral .= '<li>';
	$html_integral .= '<strong>'.JQ::config('integral_name').'</strong>';
	$html_integral .= '<div class="dou"><em>'.$integral_text.'</em></div>';
	$html_integral .= '<span class="tips_dou"></span>';
	$html_integral .= '</li>';
}
// 支付信息
$html_pay = '';
if (isset($this->payment_list) && count($this->payment_list) > 0) {
	for ($i=0, $n=count($this->payment_list); $i<$n; $i++)
	{
		$row = &$this->payment_list[$i];
		$checked = ($row->pay_id == $this->order->pay_id || $n == 1) ? ' checked="true"' : '';
		$html_pay .= '<li class="switch">';
		$html_pay .= '<input name="payment" id="payment_'.$row->pay_id.'" type="radio" value="'.$row->pay_id.'"'.$checked.'>';
		$html_pay .= '<label for="payment_'.$row->pay_id.'"><span>'.$row->pay_name.'</span><i></i></label>';
		$html_pay .= '</li>';

		$html_pay .= '<input type="hidden" name="payment_'.$row->pay_id.'" value="'.$row->pay_fee.'">';
	}
}
?>
<div id="content" class="page-content">
<form name="app-submit" method="post" action="" data-action="m=cart&a=submit">
<input type="hidden" name="discount" value="<?php echo $this->total['discount']; ?>">
<input type="hidden" name="goods_fee" value="<?php echo $goods_fee; ?>">
<?php echo $input_shipping; ?>
	<div class="cart-warp address_defalut">
		<h4>收货信息</h4>
		<a href="#m=user&c=address&checkout=1">
		<ul>
			<?php echo $consignee; ?>
			<!--
			<li><strong>沈飞</strong> 138****9435</li>
			<li>江苏南京市鼓楼区中山北路30号城市名人酒店40楼</li>
			-->
			<li class="error" style="display: none;">请选择乡镇/街道</li>
		</ul>
		</a>
	</div>

	<div class="cart-warp">
		<h4>产品信息</h4>
		<ul>
			<?php echo $html_goods; ?>
			<!--
			<li class="hproduct">
				<img class="photo" src="//img10.360buyimg.com/n4/g13/M04/14/1A/rBEhU1L9t_0IAAAAAAnGxjKZGK0AAIh_QCXWsMACcbe278.png">
				<div class="fn">七匹狼夹克男装2016春装新款双面夹克男商务茄克衫外套 D2 黑色 175/92A(XL码) </div>
				<p class="sku_coll">编号：1031032515</p>
				<p class="sku_coll">规格：黑色，175/92A(XL码)</p>
				<p class="sku_price">¥479.00</p>
				<p class="sku_count">×1</p>
			</li>
			<li class="hproduct noclick">
				<img class="photo" src="//img10.360buyimg.com/n4/g13/M04/14/1A/rBEhU1L9t_0IAAAAAAnGxjKZGK0AAIh_QCXWsMACcbe278.png">
				<div class="fn">七匹狼夹克男装2016春装新款双面夹克男商务茄克衫外套 D2 黑色 175/92A(XL码) </div>
				<p class="sku_coll">编号：1031032515</p>
				<p class="sku_coll">规格：黑色，175/92A(XL码)</p>
				<p class="sku_price">¥479.00</p>
				<p class="sku_count">×1</p>
			</li>
			-->
		</ul>
	</div>

	<div class="buy_discount">
		<ul>
			<!--<li id="tabInvoices"><strong>发票信息</strong><span>个人&nbsp;明细</span></li>
			<div id="conponListTab" style="display: none;"></div>-->
			<?php if (JQ_WECHAT) : ?>
			<li onclick="javascript:App.load('m=cart&a=cardParam');">
				<strong>优惠券</strong>
				<span><em id="selectCard" class="disabled">请选择</em></span>
			</li>
			<?php endif; ?>
			<?php echo $html_integral; ?>
			<!--
			<li class="switch">
				<input type="checkbox" checked id="checkbox-3-2" style="display:none;">
				<label for="checkbox-3-2">
					<div class="buy_dou">
						<strong>积分</strong>
						<span>共有878584积分，本单可用800积分。</span>
					</div>
					<i class="radio" tag="check"></i>
				</label>
			</li>
			<li asset_tag="bean">
				<strong>积分</strong>
				<div class="dou">  <em>您还没有积分，不可用</em>  </div>
				<span class="tips_dou"></span>
			</li>
			-->
		</ul>
	</div>

	<div class="cart-warp payment">
		<!--<h4>支付方式</h4>-->
		<ul>
			<?php echo $html_pay; ?>
			<!--
			<li class="switch">
				<input type="radio" id="checkbox-3-0" style="display:none;">
				<label for="checkbox-3-0"><span style="">瓜藤钱包</span><i></i></label>
			</li>
			<li class="switch">
				<input type="radio" checked id="checkbox-3-1" style="display:none;">
				<label for="checkbox-3-1"><span>微信支付</span><i></i></label>
			</li>
			<li class="switch">
				<input type="radio" id="checkbox-3-2" style="display:none;">
				<label for="checkbox-3-2"><span>快钱支付</span><i></i></label>
			</li>
			-->
		</ul>
	</div>

	<div class="buy_msg">
		<h4>订单附言</h4>
		<div class="textarea">
				<textarea maxlength="120" id="postscript" name="postscript" cols="80" placeholder="限45字，可留空，请勿填写无关信息"></textarea>
		</div>
	</div>

	<div class="cart-warp payarea">
		<div class="s-item">
			<div class="sitem-l">商品金额</div>
			<div class="sitem-r"><?php echo price_format($this->total['goods_price']); ?></div>
		</div>
		<div id="price_list_wrapper">
		<?php if ($this->total['shipping_fee'] > 0) { ?>
		<div class="s-item" id="shipping_fee">
			<div class="sitem-l">配送费用</div>
			<div class="sitem-r"><?php echo price_format($this->total['shipping_fee']); ?></div>
		</div>
		<?php } ?>
		<?php if ($this->total['discount'] > 0) { ?>
		<div class="s-item" id="pay_discount">
			<div class="sitem-l">优惠折扣</div>
			<div class="sitem-r">-<?php echo price_format($this->total['discount']); ?></div>
		</div>
		<?php } ?>
		<?php if ($pay_integral > 0) { ?>
		<div class="s-item" id="pay_integral">
			<div class="sitem-l"><?php echo JQ::config('integral_name'); ?>抵扣</div>
			<div class="sitem-r">-<?php echo price_format($pay_integral); ?></div>
		</div>
		<?php } ?>
		</div>
		<div class="s-item">
			<div class="sitem-l">应付总额</div>
			<div class="sitem-r" id="price_total_final"><?php echo price_format($this->total['amount']); ?></div>
		</div>
		<a href="javascript:void(0);" onclick="javascript:App.submit();" class="paybtn">支付订单</a>
	</div>
<input type="hidden" name="submit" value="1">
</form>
</div>
<?php @include('footer.php'); ?>