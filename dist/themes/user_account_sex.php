<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<div id="content" class="page-content">

<div id="wrapper" class="auth_warp">
	<div class="auth_area">
		<form name="app-submit" method="post" action="" data-action="m=user&c=account&a=sex" style="margin-top: 0.5rem;">
		

		<div class="code input_wrap">
			<span class="tbl-cell tbl-left">性别:</span>
			<span class="tbl-cell tbl-right" style="text-align:left;">
			<select name="sex" id="sex" style="width:100%;">
				<option value="0" <?php if($this->sex==0) {echo 'selected="selected"';} ?>>女</option>
				<option value="1" <?php if($this->sex==1) {echo 'selected="selected"';} ?>>男</option>
			</select>
			</span></span>
		</div>
		
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