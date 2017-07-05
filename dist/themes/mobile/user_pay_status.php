<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<?php
$icon_html = '';
$btn_html = '';
$order_sn = '';
if ($this->order_type == PAY_ORDER) {
	$order_sn = '<div><p>订单编号：</p>'.$this->order_sn.'</div>';
	if ($this->order_status == OS_CONFIRMED && $this->pay_status) {
		$title = '支付成功';
		$paytit = '<p>付款金额：</p><b>'.price_format($this->money_paid).'</b>';
		$msg = '您的订单在线支付成功，请等待发货。';
		$icon_html .= '<div class="icon-msg green">';
		$icon_html .= '<i class="icon-ok"></i>';
		$icon_html .= '</div>';
		$btn_html .= '<a class="btn-green" href="#m=user">个人中心</a>';
	} else {
		$title = '支付失败';
		$paytit = '<p>应付金额：</p><b>'.price_format($this->order_amount).'</b>';
		$msg = '您的订单在线支付失败，请尝试重新支付或者联系网站客服。';
		$icon_html .= '<div class="icon-msg red">';
		$icon_html .= '<i class="icon-remove"></i>';
		$icon_html .= '</div>';
		$btn_html .= '<a class="btn-red" href="javascript:void(0);" data-href="m=user&c=pay&a=submit&order_id='.$this->order_id.'">重新支付</a>';
	}
	$btn_html .= '<a class="btn-grey" href="#m=user&c=order&a=detail&order_id='.$this->order_id.'">查看订单</a>';
} else {
	if ($this->is_paid == 1){
		$title = '充值成功';
		$paytit = '<p>充值金额：</p><b>'.price_format($this->order_amount).'</b>';
		$msg = '您的充值在线支付成功，金额已经转为金币存入您的账户。';
		$icon_html .= '<div class="icon-msg green">';
		$icon_html .= '<i class="icon-ok"></i>';
		$icon_html .= '</div>';
		$btn_html .= '<a class="btn-green" href="#m=user&c=wallet&a=deposit">继续充值</a>';
	} else {
		$title = '支付失败';
		$paytit = '<p>充值金额：</p><b>'.price_format($this->order_amount).'</b>';
		$msg = '您的充值在线支付失败，请尝试重新充值或者联系网站客服。';
		$icon_html .= '<div class="icon-msg red">';
		$icon_html .= '<i class="icon-remove"></i>';
		$icon_html .= '</div>';
		$btn_html .= '<a class="btn-red" href="#m=user&c=wallet&a=deposit">重新充值</a>';
	}
	$btn_html .= '<a class="btn-grey" href="#m=user&c=wallet&a=balance">我的账户</a>';
}
?>
<div id="content" class="page-content">
	<div class="msg-warp">
		<div class="icon-area">
			<?php echo $icon_html; ?>
		</div>
		<div class="text-area">
			<h2 class="msg-title"><?php echo $title; ?></h2>
			<p class="msg-desc"><?php echo $msg; ?></p>
		</div>
		<div class="order_state">
			<div class="order_info">
				<div class="inner">
					<?php echo $order_sn; ?>
					<div><?php echo $paytit; ?></div>
					<div><p>支付方式：</p><?php echo $this->pay_name; ?></div>
				</div>
			</div>
		</div>
		<div class="opr-area">
			<p class="btn-area">
				<?php echo $btn_html; ?>
			</p>
		</div>
	</div>
</div>
<?php @include('footer.php'); ?>