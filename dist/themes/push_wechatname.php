<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<div id="content" class="page-content">
<div id="wrapper" class="auth_warp">
	<div class="auth_area">
		<form name="app-submit" method="post" action="" data-action="m=push&a=wechatname" style="margin-top: 0.5rem;">
		<div>
		<span class="tbl-cell tbl-left">微信号：</span>
			<span class="tbl-cell tbl-right" style="text-align:left;">
					<input placeholder="请输入微信号" id="wname" name="wname" value="<?php echo isset($this->wechatname)?$this->wechatname:''; ?>">
			</span>
		</span>
		</div>
		<div>
		<span class="tbl-cell tbl-left">QQ号码：</span>
			<span class="tbl-cell tbl-right" style="text-align:left;">
					<input placeholder="请输入QQ号码" id="qq" name="qq" value="<?php echo isset($this->qq)?$this->qq:''; ?>">
			</span>
		</span>
		</div>
		<div class="mod_btns">
			<a class="mod_btn bg_2" href="javascript:void(0);" onclick="javascript:App.submit();">确定</a>
		</div>
		<input type="hidden" name="submit" value="1">
		</form>
	</div>
</div>

</div>
<?php @include('footer.php'); ?>