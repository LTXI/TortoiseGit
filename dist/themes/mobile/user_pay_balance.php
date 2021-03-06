<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<div id="content" class="page-content">

<div id="wrapper" class="auth_warp">
	<div class="auth_area">
		<form name="app-submit" method="post" action="" data-action="m=user&c=pay&a=balance">
		<p class="text">为保障您的账号安全，使用钱包支付订单需要对您的手机进行一次短信验证：</p>
		<p class="text"> <span class="auth">绑定手机：<em class="ph_blue"><?php echo $this->mobile; ?></em></span> </p>
		<div class="code input_wrap">
			<input type="tel" placeholder="请输入验证码" id="verify" name="verify">
			<a href="javascript:void(0)" onclick="javascript:App.getSmsCode('D');" class="code_btn" id="reFetch">获取短信验证码</a>
		</div>

		<p class="ps">如果您有任何疑问，请致电商城客服：<a href="tel:4008089303" class="ph_blue">400-808-9303</a> 咨询。</p>

		<div class="mod_btns">
			<a class="mod_btn bg_2" href="javascript:void(0);" onclick="javascript:App.submit();">确认支付</a>
		</div>
		<input type="hidden" name="mobile" value="<?php echo $this->mobile; ?>">
		<input type="hidden" name="order_id" value="<?php echo $this->order_id; ?>">
		<input type="hidden" name="submit" value="1">
		</form>
	</div>
</div>


</div>
<?php @include('footer.php'); ?>