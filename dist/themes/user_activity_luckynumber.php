<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<?php
$list = '';
if (count($this->rows) > 0) {
	for ($i=0, $n=count($this->rows); $i<$n; $i++)
	{
		$row = &$this->rows[$i];

		$luck_open = ' open';
		$lucky_more = '';
		if ($row->status == 1) {
			$lucky_level = '';
			switch ($row->prizes)
			{
				case 0 :
					$lucky_level = '特等奖';
					break;
				case 1 :
					$lucky_level = '一等奖';
					break;
				case 2 :
					$lucky_level = '二等奖';
					break;
				case 3 :
					$lucky_level = '三等奖';
					break;
				case 4 :
					$lucky_level = '四等奖';
					break;
				case 5 :
					$lucky_level = '鼓励奖';
					break;
			}

			if ($row->is_paid) {
				$lucky_paid = '<em class="co_blue">已结算</em>';
			} else {
				$lucky_paid = '未结算';
			}

			$lucky_status = '<em class="co_green">已开奖</em>';
			$lucky_more .= '<div class="oh_more">';
			$lucky_more .= '<p><span>开奖时间：</span>'.local_date('Y-m-d H:i:s', $row->open_time).'</p>';
			//$lucky_more .= '<p><span>所获奖项：</span>'.$lucky_level.'</p>';
			$lucky_more .= '<p><span>获得奖金：</span><em class="co_red">'.price_format($row->money).'</em></p>';
			$lucky_more .= '<p><span>结算状态：</span>'.$lucky_paid.'</p>';
			$lucky_more .= '</div>';
		} else {
			$luck_open = '';
			$lucky_status = '<em class="co_red">未开奖</em>';
		}

		$list .= '<div class="lucky_box">';
		$list .= '<div class="lucky_head'.$luck_open.'">';
		$list .= '<div class="oh_content" onclick="javascript:$(this).toggleClass(\'active\');">';
		$list .= '<div class="oh_common">';
		$list .= '<p class="big"><span>幸运号码：</span><em class="co_big">'.$row->lucky_sn.'</em></p>';
		$list .= '<p><span>开奖状态：</span>'.$lucky_status.'</p>';
		$list .= '<p><span>所属期别：</span>'.$row->issue.'</p>';
		$list .= '<p><span>所属订单：</span>'.$row->order_sn.'</p>';
		$list .= '</div>';
		$list .= $lucky_more;
		$list .= '</div>';
		$list .= '</div>';
		$list .= '</div>';
	}
} else {
	$list .= '<div class="lucky_nothing">您暂时还没有幸运号码。</div>';
}
?>
<div id="content" class="page-content">
	<div class="order-topbar">
		<div class="topbar-tabs">
			<ul id="nav">
				<li><a href="#m=user&c=activity&a=luckyintro">中奖概况</a></li>
				<li class="cur"><a href="#m=user&c=activity&a=luckynumber">幸运号码</a></li>
			</ul>
		</div>
	</div>
	<div class="content-list lucky-list">
	<?php echo $list; ?>
	</div>
</div>
<?php @include('footer.php'); ?>