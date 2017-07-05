<?php defined('JQ_EXEC') or die; ?>
<?php $m = JRequest::getCmd('m', 'default');?>
<div id="footer" class="page-footer">
	<div class="footer_inner">
		<a<?php echo $m == 'default' ? ' class="on"' : ''; ?> href="#">
			<span class="line"><i class="icon-suitcase"></i></span>
			<span class="text">购物</span>
		</a>
		<a<?php echo $m == 'category' ? ' class="on"' : ''; ?> href="#m=category">
			<span class="line"><i class="icon-reorder"></i></span>
			<span class="text">分类</span>
		</a>
		<a<?php echo $m == 'cart' ? ' class="on"' : ''; ?> href="#m=cart">
			<span class="line"><i class="icon-shopping-cart"></i></span>
			<span class="text">购物车</span>
		</a>
		<a<?php echo $m == 'user' ? ' class="on"' : ''; ?> href="#m=user">
			<span class="line"><i class="icon-user"></i></span>
			<span class="text">个人中心</span>
		</a>
	</div>
	<div class="footer_none"><img src="<?php echo JQ::config('system.siteurl'); ?>api/cron.php?t=<?php echo gmtime(); ?>" width="0" height="0" /><img src="<?php echo JQ::instance('cnzz', 1254737580)->trackPageView(); ?>" width="0" height="0" /></div>
</div>
