<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<div id="content" class="page-content" style="background-color:#FFF;">

<!--
<div id="wrapper">
	<ul class="steps_status"> <li class="step step_start done"><i></i>身份验证</li> <li class="step cur"><i></i>验证手机</li> <li class="step step_end"><i></i>设置支付密码</li> </ul>

	<div class="auth_area">
		<form onsubmit="javascript:return false;"> <p class="text">您的京东账号存在被盗用的风险，为了您的账号安全，需要对您已绑定的手机进行一次短信验证：</p> <p class="text"> <span class="auth">绑定手机：<em class="ph_blue">138*****435</em></span> </p> <div class="code input_wrap"> <input type="tel" placeholder="请输入验证码" id="verifyCode"> <a href="javascript:void(0)" class="code_btn" id="reFetch">获取短信验证码</a></div><p class="ps">为确保账户安全，需进行手机验证，如该手机号您已不再使用，请致电京东客服：<a href="tel:4006065500" class="ph_blue">400-606-5500</a>转7转2 处理。</p> <div class="mod_btns"> <input type="submit" class="mod_btn bg_2" value="提交" id="nextBtn"> </div> </form>
	</div>
</div>
-->
<div id="wrapper"><ul class="steps_status"> <li class="step step_start done"><i></i>身份验证</li> <li class="step done"><i></i>验证手机</li> <li class="step step_end cur"><i></i>设置支付密码</li> </ul> <div class="auth_area"> <form onsubmit="javascript:return false;"> <div class="input_wrap double"> <input type="password" placeholder="设置密码" id="password" maxlength="20"> <input type="password" placeholder="密码确认" id="password1" maxlength="20"> </div> <p class="text">提示：支付密码是由字母、数字及符号组成的6-20位字符，请注意区分大小写！</p> <div class="mod_btns"> <input type="submit" class="mod_btn bg_2" value="提交" id="nextBtn"> </div> </form> </div></div>









</div>
<?php @include('footer.php'); ?>