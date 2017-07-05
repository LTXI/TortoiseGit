<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<div id="content" class="page-content">

<div id="wrapper" class="auth_warp">
	<div class="auth_area">
		<form name="app-submit" method="post" action="" data-action="m=user&c=account&a=binding">
		<p class="text">为保障您的账号安全，商城要求用户必须绑定手机号，绑定过程中需要对您的手机进行一次短信验证：</p>
		<div class="code input_wrap">
			<input type="tel" placeholder="请输入手机号" id="mobile" name="mobile">
		</div>
		<div class="code input_wrap">
			<input type="tel" placeholder="请输入验证码" id="verify" name="verify">
			<a href="javascript:void(0)" onclick="javascript:App.getSmsCode('A');" class="code_btn" id="reFetch">获取短信验证码</a>
		</div>

		<p class="ps">如果您有任何疑问，请致电商城客服：<a href="tel:4008089303" class="ph_blue">400-808-9303</a> 咨询。</p>

		<div class="mod_btns">
			<a class="mod_btn bg_2" href="javascript:void(0);" onclick="javascript:App.submit();">确定</a>
		</div>
		<input type="hidden" name="goods_id" value="<?php echo $this->goods_id; ?>">
		<input type="hidden" name="submit" value="1">
		</form>
	</div>
</div>



</div>
<?php @include('footer.php'); ?>