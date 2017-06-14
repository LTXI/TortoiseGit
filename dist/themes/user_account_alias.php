<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<div id="content" class="page-content">

<div id="wrapper" class="auth_warp">
	<div class="auth_area">
		<form name="app-submit" method="post" action="" data-action="m=user&c=account&a=alias" style="margin-top: 0.5rem;">

		<span class="tbl-cell tbl-left">昵称：</span>
			<span class="tbl-cell tbl-right" style="text-align:left;">
					<input placeholder="请输入昵称" id="alias" name="alias" value="<?php echo $this->alias; ?>">
			</span>
		</span>
		<p class="ps">如果您有任何疑问，请致电商城客服：<a href="tel:4008089303" class="ph_blue">400-808-9303</a> 咨询。</p>

		<div class="mod_btns">
			<a class="mod_btn bg_2" href="javascript:void(0);" onclick="javascript:App.submit();">确定</a>
		</div>
		<input type="hidden" name="mobile" value="<?php echo $this->user_name; ?>">
		<input type="hidden" name="submit" value="1">
		</form>
	</div>
</div>



</div>
<?php @include('footer.php'); ?>