<?php defined('JQ_EXEC') or die; ?>
<div id="luckyDialog" class="msgbox">
	<div class="box">
		<div class="gift_wrp">
			<img src="<?php echo JQ_URL; ?>images/gift.png" height="120">
		</div>
		<h2>恭喜您，获得了<?php echo $this->lucky_total; ?>个抽奖幸运号！</h2>
		<!--<a href="javascript:;" class="red rule">活动规则</a>-->
		<h5>发放可能稍有延迟<br>稍后可以在 个人中心&gt;我的幸运号 查看</h5>
		<a href="javascript:void(0);" onclick="javascript:$('#luckyDialog').remove();" class="btn">知道啦</a>
	</div>
</div>