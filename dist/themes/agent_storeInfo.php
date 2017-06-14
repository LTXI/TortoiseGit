<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<div id="content" class="page-content">

	<div class="list_warp">
		<ul class="list">
			<li><a href="#m=agent&a=editStore&obj=store_name">店铺名称<span><?php echo isset($this->store_name)?$this->store_name:'未设置'; ?></span></a></li>
			<li><a href="#m=agent&a=editStore&obj=store_phone">联系电话<span><?php echo isset($this->store_phone)?$this->store_phone:'未设置'; ?></span></a></li>
			<li><a href="#m=agent&a=editStoreLogo">店铺LOGO<span><?php echo isset($this->store_logo)?'':'未设置'; ?></span></a></li>
			<li><a href="#m=agent&a=editStore&obj=store_describe">店铺简介<span><?php echo isset($this->store_describe)?'':'未设置'; ?></span></a></li>
		</ul>
	</div>
</div>
<?php @include('agent_footer.php'); ?>