<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<div id="content" class="page-content">
<div id="wrapper" class="auth_warp">
	<div class="auth_area">
		<form name="app-submit" method="post" action="" data-action="m=user&c=wallet&a=withdraw">
		<p class="text"> <span class="auth">可提现金额：<em class="ph_blue"><?php echo price_format($this->user_money); ?></em></span> </p>
		<p class="text">提现账户为您的关联微信号，最低提现金额为<b id="MinaAmountCash">￥100.00</b>元，必须为<b id="IntTimes">100</b>的整数倍。</p>
		<div class="code input_wrap">
			<input type="tel" placeholder="请输入提现金额" id="amount" name="amount">
		</div>

		<p class="ps">如果您有任何疑问，请致电商城客服：<a href="tel:4008089303" class="ph_blue">400-808-9303</a> 咨询。</p>

		<div class="mod_btns">
			<a class="mod_btn bg_2" href="javascript:void(0);" onclick="javascript:App.submit();">提交申请</a>
		</div>
		<input type="hidden" value="1" name="surplus_type">
		<input type="hidden" name="submit" value="1">
		</form>
	</div>
</div>
</div>
<?php @include('footer.php'); ?>