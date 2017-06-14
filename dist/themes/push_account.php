<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<div id="content" class="page-content">

	<div class="list_warp">
		<ul class="list">
			<li><a href="#m=push&a=wechatname">qq号码<span><?php echo isset($this->qq)?$this->qq:'未设置'; ?></span></a></li>
			<li><a href="#m=push&a=wechatname">微信号<span><?php echo isset($this->wechatname)?$this->wechatname:'未设置'; ?></span></a></li>
			<li><a href="#m=push&a=wechatqr">微信二维码上传<i class="icon-qrcode"></i><span><?php echo isset($this->wechatqr)?'':'未设置'; ?></span></a></li>
		</ul>
	</div>
</div>
<?php @include('footer.php'); ?>