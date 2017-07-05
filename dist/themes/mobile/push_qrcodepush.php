<?php defined('JQ_EXEC') or die; ?>
<?php
$avatar = !empty($this->avatar) ? fixImagePath($this->avatar) : JQ_URL.'images/avatar.jpg';
?>
<div class="mod_qr_layer" onclick="javascript:$(this).remove();">
	<div class="inner">
		<div class="infos">
			<div class="face"><img src="<?php echo $avatar; ?>"></div>
			<div class="content">
				<p class="name"><em id="userName">来自推客 <?php echo $this->alias; ?> 的邀请</em></p>
			</div>
		</div>
		<div class="qrcode"><img src="<?php echo $this->qrcode_url; ?>"></div>
		<div class="tips">微信扫一扫上面二维码图案，享受折扣</div>
	</div>
</div>