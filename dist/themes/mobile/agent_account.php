<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<div id="content" class="page-content">

	<div class="list_warp">
		<ul class="list">
			<li><a href="#m=agent&a=wechatname">QQ交流群<span><?php echo isset($this->qq)?$this->qq:'未设置'; ?></span></a></li>
			<li><a href="#m=agent&a=wechatname">微信号<span><?php echo isset($this->wechatname)?$this->wechatname:'未设置'; ?></span></a></li>
			<li><a href="#m=agent&a=wechatqr">微信二维码<span><?php echo isset($this->wechatqr)?'':'未设置'; ?></span></a></li>
			
			<?php if($this->status==0):?>
			<li><a >资料内容：等待客服审核<span></span></a></li>
			<?php elseif($this->status==2):?>
			<li><a >资料内容：审核不通过，原因：<?php echo $this->remarks;?><span></span></a></li>
			<?php endif;?>
			
		</ul>
	</div>
</div>
<?php @include('footer_app.php'); ?>