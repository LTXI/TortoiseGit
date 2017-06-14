<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<?php
// 支付信息
$html_pay = '';
if (isset($this->payment_list) && count($this->payment_list) > 0) {
	for ($i=0, $n=count($this->payment_list); $i<$n; $i++)
	{
		$row = &$this->payment_list[$i];
		//$checked = ($row->pay_id == $this->order->pay_id || $n == 1) ? ' checked="true"' : '';
		$html_pay .= '<li class="switch">';
		$html_pay .= '<input name="payment" id="payment_'.$row->pay_id.'" type="radio" value="'.$row->pay_id.'">';
		$html_pay .= '<label for="payment_'.$row->pay_id.'"><span>'.$row->pay_name.'</span><i></i></label>';
		$html_pay .= '</li>';

		$html_pay .= '<input type="hidden" name="payment_'.$row->pay_id.'" value="'.$row->pay_fee.'">';
	}
}
?>
<div id="content" class="page-content">
<form name="app-submit" method="post" action="" data-action="m=user&c=pay&a=submit">
	<input type="hidden" name="order_id" value="<?php echo $this->order_id; ?>">
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

	<div class="cart-warp payarea">
		<a href="javascript:void(0);" onclick="javascript:App.submit();" class="paybtn">支付订单</a>
	</div>

<input type="hidden" name="submit" value="1">
</form>
</div>
<?php @include('footer.php'); ?>