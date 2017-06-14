<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<?php
$list = '';
if (count($this->rows) > 0) {
	for ($i=0, $n=count($this->rows); $i<$n; $i++)
	{
		$row = &$this->rows[$i];
		$sStyle = '';
		$sPoint = $row->pay_points;
		if ($row->pay_points > 0) {
			$sTitle = '收入';
			$sPoint = '+'.$row->pay_points;
			$sStyle = 'color:green;';
		} else {
			$sTitle = '支出';
		}
		$list .= '<div class="listDetail_div">';
		$list .= '	<div class="listDetail_div1">';
		$list .= '		<div class="listDetail_content">';
		$list .= '		<div class="listDetail_content_num" style="'.$sStyle.'">'.$sPoint.'</div>';
		$list .= '		<h3 class="listDetail_content_title">'.$sTitle.'</h3>';

		$list .= '			<div class="listDetail_content_word">'.$row->change_desc.'</div>';
		$list .= '			<div class="listDetail_content_time">'.local_date('Y-m-d H:i:s', $row->change_time).'</div>';
		$list .= '		</div>';
		$list .= '	</div>';
		$list .= '</div>';
	}
}else{
	$list = '<div class="order_nothing">暂无明细!<div/>';
}
?>
<div id="content" class="page-content">
	<div class="order-topbar">
		<div class="topbar-tabs">
			<ul id="nav">
				<li><a href="#m=user&c=wallet&a=integral">我的积分</a></li>
				<li><a href="#m=user&c=wallet&a=bindCheck">积分转让</a></li>
				<li class="cur"><a href="#m=user&c=wallet&a=integralDetail">积分明细</a></li>
			</ul>
		</div>
	</div>

	<div class="content-list">
		<?php echo $list; ?>
	</div>
</div>
<?php @include('footer.php'); ?>