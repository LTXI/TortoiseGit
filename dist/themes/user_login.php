<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<div id="content" class="page-content">
	<form name="app-login" method="post" action="" data-action="m=user&a=login">
	<div class="login-wrap">
		<div class="item item-username">
			<input class="txt-input txt-username" type="text" name="username" placeholder="请输入手机号" autofocus="" required="">
		</div>

		<div class="item item-password">
			<input class="txt-input txt-password" type="password" name="password" autocomplete="off" placeholder="请输入密码" required="">
			<!--<b class="tp-btn btn-off J_ping" report-eventid="MLoginRegister_Plaintext"></b>-->
		</div>
		<!--
		<div class="item item-captcha">
			<div class="input-info" style="display: none;">
				<input class="txt-input txt-captcha" type="text" size="11" maxlength="6" autocomplete="off" placeholder="请输入验证码">
				<span id="captcha-img"><img src="authcode?mod=login" width="63" height="25" alt=""></span>
			</div>
			<div class="login-free login-free-selected"><b></b>一个月内免登录</div>
		</div>
		-->

		<div class="item item-btns">
			<a class="btn-login" href="javascript:void(0);" onclick="javascript:App.submit();">登录</a>
		</div>

		<div class="item item-login-option">
			<!--
			<span class="register-free">
				<a href="javascript:void(0);" class="quickReg">快速注册</a>
			</span>
			<span class="retrieve-password">
				<a href="javascript:void(0);" class="findPwd">找回密码</a>
			</span>
			-->
		</div>
	</div>
	<input type="hidden" name="loginType" value="<?php echo JRequest::getString('loginType'); ?>">
	<input type="hidden" name="submit" value="1">
	</form>
</div>
<?php @include('footer.php'); ?>