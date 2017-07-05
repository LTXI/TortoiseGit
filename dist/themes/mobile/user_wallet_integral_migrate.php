<?php defined('JQ_PATH') or die; ?>
<?php @include('header.php'); ?>
<div id="content" class="page-content">
	<div class="order-topbar">
		<div class="topbar-tabs">
			<ul id="nav">
				<li><a href="#m=user&c=wallet&a=integral">我的积分</a></li>
				<li class="cur"><a href="#m=user&c=wallet&a=bindCheck">积分转让</a></li>
				<li><a href="#m=user&c=wallet&a=integralDetail">积分明细</a></li>
			</ul>
		</div>
	</div>
	<div id="wrapper" class="auth_warp" style="margin-top: 0.21rem;">
		<div class="auth_area">
			<form name="app-submit" method="post" action="" data-action="m=user&c=wallet&a=integralMigrate">
				<p class="text"> <span class="auth">可用积分数量：<em class="ph_blue"><?php echo $this->user->pay_points; ?></em></span> </p>
				<p class="text"> <span class="auth">当前账户：<em class="ph_blue"><?php echo $this->user->user_name; ?></em></span> </p>
				<p class="text">账号为手机号，最低转让积分数为1，必须为整数。</p>
				<div class="code input_wrap">
					<input type="tel" placeholder="请输入对方在商城绑定的手机号" id="third_username" name="third_username">
				</div>
				<div class="code input_wrap">
					<input type="number" placeholder="请输入要转让积分数量" id="point" name="point" min="1">
				</div>
				<div class="code input_wrap">
					<input type="number" placeholder="请输入验证码" id="verify" name="verify" min="0">
					<a href="javascript:void(0)" onclick="javascript:App.getSmsCodeByMF(<?php echo $this->user->user_name; ?>,'D');" class="code_btn" id="reFetch">获取短信验证码</a>
				</div>
				<p class="ps">如果您有任何疑问，请致电商城客服：<a href="tel:4008089303" class="ph_blue">400-808-9303</a> 咨询。</p>
				<div class="mod_btns">
					<a class="mod_btn bg_2" href="javascript:void(0);" onclick="javascript:App.submit();">提交</a>
				</div>
				<input type="hidden" value="1" name="surplus_type">
				<input type="hidden" name="submit" value="1">
			</form>
		</div>
	</div>
</div>
<?php @include('footer.php'); ?>
