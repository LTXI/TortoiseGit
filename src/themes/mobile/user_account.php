<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<?php
if ($this->user_name && preg_match(MOBILE_REGEX, $this->user_name)) {
	$mobile = $this->user_name;
	$mobi_link = 'javascript:void(0);';
} else {
	$mobile = '未绑定';
	$mobi_link = '#m=user&c=account&a=binding';
}

$password = $this->password ? '已设置' : '未设置';
$parent_name = isset($this->parent_name) && !empty($this->parent_name) ? $this->parent_name :'未设置';

?>
<div id="content" class="page-content">
	<!--
	<div class="list_warp">
		<ul class="list">
			<li><a href="javascript:void(0);">个人资料</a></li>
		</ul>
	</div>
	-->

	<div class="list_warp">
		<ul class="list">
			<li><a href="#m=user&c=account&a=alias">昵称<span><?php echo $this->alias; ?></span></a></li>
			<li><a href="#m=user&c=account&a=sex">性别<span><?php if($this->sex==1){ echo '男'; }else{echo '女';}?></span></a></li>
			<!--<li><a >推荐人<span><?php echo $parent_name; ?></span></a></li>-->
			<li><a href="#m=user&c=account&a=birthday">出生日期<span><?php echo $this->birthday; ?></span></a></li>
		</ul>
	</div>


	<div class="list_warp">
		<ul class="list">
			<li><a href="<?php echo $mobi_link; ?>">手机号<span><?php echo $mobile; ?></span></a></li>
			<li><a href="#m=user&c=account&a=password">登录密码<span><?php echo $password; ?></span></a></li>
		</ul>
	</div>

	<!--
	<div class="list_warp">
		<ul class="list">
			<li><a href="javascript:void(0);">安全密码</a><span>已开启</span></li>
		</ul>
	</div>
	-->

	<div class="list_warp">
		<ul class="list">
			<li><a href="#m=user&c=address">收货地址管理</a></li>
		</ul>
	</div>
</div>
<?php @include('footer.php'); ?>