<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<?php
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
<div id="wrapper" class="auth_warp">
	<div class="auth_area">
		<form name="app-submit" method="post" action="" data-action="m=user&c=pay&a=deposit">
		<p class="text"> <span class="auth">当前账户余额：<em class="ph_blue"><?php echo price_format($this->user_money); ?></em></span> </p>
		<p class="text">单笔最低充值金额为<b id="MinaAmountCash">￥100.00</b>元。</p>
		<div class="code input_wrap">
			<input type="tel" placeholder="请输入充值金额" id="amount" name="amount">
		</div>

	<div class="cart-warp deposit">
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

		<p class="ps">如果您有任何疑问，请致电商城客服：<a href="tel:4008089303" class="ph_blue">400-808-9303</a> 咨询。</p>

		<div class="mod_btns">
			<a class="mod_btn bg_2" href="javascript:void(0);" onclick="javascript:App.submit();">立即充值</a>
		</div>
		<input type="hidden" value="1" name="surplus_type">
		<input type="hidden" name="submit" value="1">
		</form>
	</div>
</div>
</div>
<?php @include('footer.php'); ?>