<?php defined('JQ_EXEC') or die; ?>
<?php
$fromesb_hidden = get_cookie('fromesb_hidden');
?>
<div id="header" class="page-header">
<?php
if (empty($fromesb_hidden)) {
$session =& JQ::session();
$model_wechat =& JQ::instance('model.wechat');
if (JQ_WECHAT && !$model_wechat->getSubscribe($session->get('userid'))) {
	$parent_id = $model_wechat->getParentId($session->get('userid'));
	if ($parent_id) {
		$parentInfo = $model_wechat->getParentInfo($parent_id);
		$parentInfo->alias = !empty($parentInfo->alias) ? $parentInfo->alias : 'ID：'.$parentInfo->user_id;
		$parentInfo->avatar = fixImagePath($parentInfo->avatar);
	} else {
		$parentInfo = new stdClass();
		$parentInfo->avatar = JQ_URL.'images/gt_logo.png';
		$parentInfo->alias = '商城';
	}
?>
<div class="fromesb" id="fromesb-wechat">
	<i class="icons-close" id="fromesb-close" onclick="javascript:App.fromesbClose();"></i>
	<span class="fromesb-header"><img src="<?php echo $parentInfo->avatar; ?>"></span>
	<p class="fromesb-text">来自<span class="color-green"><?php echo $parentInfo->alias; ?></span>的推荐<br>立即关注，抢夺地盘</p>
	<a class="fromesb-btn" href="http://mp.weixin.qq.com/s?__biz=MzA4NjIzMTg5Mw==&mid=503185444&idx=1&sn=d2e853536a39d855c46762a9c1d64ff5#rd">点击关注</a>
</div>
<?php
}
}
?>
</div>