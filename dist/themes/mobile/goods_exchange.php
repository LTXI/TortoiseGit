<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<div id="content" class="page-content">

<div class="exchange_banner">
	<img src="<?php echo JQ_URL; ?>images/dzx.jpg">
</div>

<div class="exchange_form">
	<form name="app-submit" method="post" action="" data-action="m=goods&a=exchange">
	<div class="input">
		<label>兑换卡号</label>
		<input type="text" name="card_num" placeholder="">
		 <span tag="clear"></span>
	</div>
	<div class="input">
		<label>兑换密码</label>
		<input type="password" name="card_pwd" placeholder="">
		 <span tag="clear"></span>
	</div>

	<div class="mod_btns" style="margin:0.31rem 0;">
		<a class="mod_btn bg_1" href="javascript:void(0);" onclick="javascript:App.submit();">立即兑换</a>
	</div>

	<input type="hidden" name="submit" value="1">
	</form>


	<div class="submit-tips">
		<div class="submit-tips-title">温馨提示：</div>
		<ul class="submit-tips-list">
			<li>1. 每年10月国庆后蟹最为肥美，建议10、11、12月提货。</li>
			<li>2. 本卡提货有效期：2015年阳澄湖正式开湖（约9月下旬）&mdash;&mdash;2017年1月10日，务必在有效期内使用（国庆、中秋等特大节日顺丰快递休息除外）。</li>
			<li>3. 收到大闸蟹请放在冰箱保鲜层（3-5℃）保存，不可放入水中。</li>
			<li>4. 请提前72小时预约提货。正常我们会在48小时送货上门，保持电话畅通。</li>
			<li>5. 因大闸蟹是鲜活水产，到货时会有2钱左右的重量误差，属正常范围，敬请谅解。</li>
			<li>6. 本卡不记名、不挂失、不兑现，在法律允许范围内，本公司拥有最终解释权。</li>
		</ul>
	</div>
</div>

</div>
<?php @include('footer.php'); ?>